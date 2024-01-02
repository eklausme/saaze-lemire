---
date: "2023-03-03 12:00:00"
title: "Float-parsing benchmark: Regular Visual Studio, ClangCL and Linux GCC"
---



Windows users have choices when it comes to C++ programming. You may choose to stick with the regular Visual Studio. If you prefer, Microsoft makes available ClangCL which couples the LLVM compiler (commonly used by Apple) with the Visual Studio backend. Further, under Windows, you may easily build software for Linux using the [Windows Subsystem for Linux](https://learn.microsoft.com/en-us/windows/wsl/install).

Programmers often need to convert a string (e.g., 312.11) into a binary float-point number. It is a common task when doing data science.

I wrote a [small set of benchmark programs to measure the speed](https://github.com/lemire/simple_fastfloat_benchmark). To run, I use an up-to-date Visual Studio (2022) with the latest ClangCL component, and the latest version of CMake.

[After downloading it on your machine](https://github.com/lemire/simple_fastfloat_benchmark/archive/refs/heads/master.zip), you may build it with CMake. Under Linux, you may do:
```C
cmake -B build && cmake --build build
```


And then you can execute like so:
```C
./build/benchmarks/benchmark -f data/canada.txt
```


The Microsoft Visual Studio usage is similar except that you must specify the build type (e.g., Release):
```C
cmake -B build && cmake --build build --config Release
```


For ClangCL, it is almost identical, except that you need to add <tt>-T ClangCL</tt>:
```C
cmake -B build -T ClangCL && cmake --build build --config Release
```


Under Windows, the binary is not produced at <tt>build/benchmarks/benchmark</tt> but rather at <tt>build/benchmarks/Release/benchmark.exe</tt>, but the commands are otherwise the same. I use the default CMake flags corresponding to the Release build.

I run the benchmark on a laptop with [Tiger Lake Intel processor](https://ark.intel.com/content/www/us/en/ark/products/196655/intel-core-i711370h-processor-12m-cache-up-to-4-80-ghz-with-ipu.html) (i7-11370 @ 3.3 GHz). It is not an ideal machine for benchmarking so I indicate the error margin on the speed measurements.

Among other libraries, my benchmark puts the [fast_float library](https://github.com/fastfloat/fast_float) to the test: it is an implementation of the C++17 `from_chars` function for floats and doubles. Microsoft has its own implementation of this function which I include in the mix.

My benchmarking code remains identical (in C++) when I switch system or compiler: I simply recompile it.

Visual Studio std::from_chars |87 MB/s (+/- 20 %)       |
-------------------------|-------------------------|
Visual Studio fast_float |285 MB/s (+/- 24 %)      |
ClangCL fast_float       |460 MB/s (+/- 36 %)      |
Linux GCC11 fast_float   |1060 MB/s (+/- 28 %)     |


We can observe that there are large performance differences. All the tests run on the same machine. The Linux build runs under the Windows Subsystem for Linux, and you do not expect the subsystem to run computations faster than Windows itself. The benchmark does not involve disk access. The benchmark is not allocating new memory.

It is not the first time that I notice that the [Visual Studio compiler provides disappointing performance](/lemire/blog/2023/02/27/visual-studio-versus-clangcl/). I have yet to read a good explanation for why that is. Some people blame inlining, but I have yet to find a scenario where a release built from Visual Studio had poor inlining.

I am not ruling out methodological problems but I almost systematically find lower performance under Visual Studio when doing C++ microbenchmarks, despite using different benchmarking methodologies and libraries (e.g., Google Benchmark). It means that if there is a methodological issue, it is deeper than a mere programming typo.

