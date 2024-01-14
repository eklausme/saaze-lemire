---
date: "2023-02-27 12:00:00"
title: "Regular Visual Studio versus ClangCL"
---



If you are programming in C++ using Microsoft tools, you can use the traditional Visual Studio compiler. Or you can use LLVM as a front-end (ClangCL).

Let us compare their performance characteristics with a fast string transcoding library ([simdutf](https://github.com/simdutf/simdutf)). I use an up-to-date Visual Studio (2022) with the latest ClangCL component (based on LLVM 15). For building the library, we use the latest version of CMake. I will abstain from parallelizing the build: I use default settings. Hardware-wise, I use a [Microsoft Surface Laptop Studio](https://en.wikipedia.org/wiki/Surface_Laptop_Studio): it has a [Tiger Lake Intel processor](https://ark.intel.com/content/www/us/en/ark/products/196655/intel-core-i711370h-processor-12m-cache-up-to-4-80-ghz-with-ipu.html) (i7-11370 @ 3.3 GHz).

After grabbing the  simdutf library from GitHub, I prepare the build directory for standard Visual Studio:
```C
&gt; cmake -B buildvc```


I do the same for ClangCL:
```C
&gt; cmake -B buildclangcl -T ClangCL```


You may also build directly with LLVM:
```C
&gt; cmake -B buildfastclang  -D CMAKE_LINKER="lld"   -D CMAKE_CXX_COMPILER=clang++  -D CMAKE_C_COMPILER=clang -D CMAKE_RC_COMPILER=llvm-rc```


For each build directory, I can build in Debug mode (<tt>--config Debug</tt>) or in Release mode (<tt>--config Release</tt>) with commands such as
```C
> cmake --build buildvc --config Debug
```


The project builds an extensive test suite by default. I often rely on my Apple macbook, and I build a lot of software using Amazon (AWS) nodes. I use an AWS c6i.large node (Intel Icelake running at 3,5 GHz, 2 vCPU).

The simdutf library and its testing suite build in a reasonable time as illustrated by the following table (Release builds). For comparison purposes, I also build the library using &lsquo;WSL&rsquo; on the Microsoft laptop (Windows Subsystem for Linux).

macbook air              |ARM M2 processor         |LLVM 14                  |25 s                     |
-------------------------|-------------------------|-------------------------|-------------------------|
AWS/Linux                |Intel Ice Lake processor |GCC 11                   |54 s                     |
AWS/Linux                |Intel Ice Lake processor |LLVM 14                  |54 s                     |
WSL (Microsoft Laptop)   |Intel Rocket Lake processor |GCC 11                   |1 min[*](#wslperf)       |
WSL (Microsoft Laptop)   |Intel Rocket Lake processor |LLVM 14                  |1 min[*](#wslperf)       |


On Intel processors, we build multiple kernels to support the various families of processors. On a 64-bit ARM processor, we only build one kernel. Thus the performance of the AWS/Linux system and the macbook is somewhat comparable.

Let us switch back to Windows and build the library.

&nbsp;                   |Debug                    |Release                  |
-------------------------|-------------------------|-------------------------|
Visual Studio (default)  |2 min                    |2 min 15 s               |
ClangCL                  |2 min 51 s               |3 min 12 s               |
Windows LLVM (direct with ldd) |2 min                    |2 min 4 s                |


Let us run an execution benchmark. We pick an [UTF-8 Arabic file](https://raw.githubusercontent.com/lemire/unicode_lipsum/main/lipsum/Arabic-Lipsum.utf8.txt) that we load in memory and that we transcode to UTF-16 using a fast AVX-512 algorithm. (The exact command is <tt>benchmark -P convert_utf8_to_utf16+icelake -F Arabic-Lipsum.utf8.txt</tt>).

&nbsp;                   |Debug                    |Release                  |
-------------------------|-------------------------|-------------------------|
Visual Studio (default)  |0.789 GB/s               |4.2 GB/s                 |
ClangCL                  |0.360 GB/s               |5.9 GB/s                 |
WSL GCC 11               |(omitted)                |6.3 GB/s                 |
WSL LLVM 14              |(omitted)                |5.9 GB/s                 |
AWS Server (GCC)         |(omitted)                |8.2 GB/s                 |
AWS Server (clang)       |(omitted)                |7.7 GB/s                 |


I draw the following tentative conclusions:

1. There may be a significant performance difference between Debug and Release code (e.g., between 5x to 15x difference).
1. Compiling your Windows software with ClangCL may lead to better performance (in Release mode). In my test, I get a 40% speedup with ClangCL. However, compiling with ClangCL takes much longer. I have recommended Windows users build their librairies with ClangCL and I maintain this recommendation.
1. In Debug mode, the regular Visual Studio produces more performant code and it compiles faster than ClangCL.


Thus it might make sense to use the regular Visual Studio compiler in Debug mode as it builds fast and offers other benefits while testing the code, and then ClangCL in Release mode for the performance.

You may bypass ClangCL under Windows and build directly with clang with the LLVM linker for faster builds. However, I have not verified that you get the same speed.

No matter what I do, however, I seem to be getting slower builds under Windows that I expect. I am not exactly sure why build the code takes so much longer under Windows. It is not my hardware since building with Linux under Windows, on the same laptop, is fast.

Of course, parallelizing the build is the most obvious way to speed it up. Appending <tt>-- -m</tt> to my CMake command [could help](https://stackoverflow.com/questions/43135534/cmake-and-slow-msvc-compilation) my performance. I deliberately avoided parallel builds in this experiment.

__<a name="wslperf"></a>WSL Update__. Reader Quan Anh Mai asked me whether I had made a copy of the source files in the Windows Subsystem for Linux drive, and I had not. Doing so multiplied the speed by a factor of three. I included the better timings.

