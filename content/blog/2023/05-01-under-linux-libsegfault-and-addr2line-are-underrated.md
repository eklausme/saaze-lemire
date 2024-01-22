---
date: "2023-05-01 12:00:00"
title: "Under Linux, libSegFault and addr2line are underrated"
---



Many modern programming languages like Java produce useful error messages when they fail. Some indicate where in the program (e.g., down to the line of source code) the failure occurred. Slowly, [the C++ language is moving in this direction](https://www.sandordargo.com/blog/2022/09/21/cpp23-stacktrace-library).

A particularly nasty problem in C and C++ are [segmentation faults](https://en.wikipedia.org/wiki/Segmentation_fault): they occur when you are trying to access a memory region that is not allocated. For example, this will occur if you are dereferencing a null pointer. You can mostly avoid segmentation faults in C++ by avoiding pointers, but they are instances when pointers are useful or necessary. And even if you are not causing them yourself, the software that you are using might be triggering them.

Thankfully, you can often get a useful message when you have a segmentation by linking with [the libSegFault library under Linux.](https://www.marcusfolkesson.se/blog/libsegfault/)

Let me illustrate. The following program has a segmentation fault on line six:
```C
#include <stdio.h>
#include <stdlib.h>

int go() {
  int x = 0;
  x += *((int *)NULL);
  return x;
}
int main() { return go(); }

```


I am calling this program <tt>hello</tt>. Let us compile the program with the line
```C
cc -g -o hello hello.c -lSegFault
```


I am linking against <tt>SegFault</tt>, but not otherwise modifying my code. Importantly, I do not need to modify anything else. I do not need to run my program within the scope of another program (e.g., within a debugger like gdb or ldb). As far as I know, `SegFault` has been available pretty much all the time with Linux, you do not need to install anything. In the future, it will be removed from the standard C library but, at least under Ubuntu, [it is being moved to the glibc-tools package](https://installati.one/install-glibc-tools-ubuntu-22-04/). You can also build [glibc-tools from its source code](https://github.com/zatrazz/glibc-tools).

I run the program and I get the following&hellip;
```C
Backtrace:
./hello[0x401116]
./hello[0x40112c]
/lib64/libc.so.6(+0x3feb0)[0x7faa8cc6eeb0]
/lib64/libc.so.6(__libc_start_main+0x80)[0x7faa8cc6ef60]
./hello[0x401045]
```


It does not tell me where exactly my program failed, instead I get a mysterious address (0x401116). There is a handy program under Linux called `addr2line` which will tell me where, in the source code, this address is. The error starts at address <tt>0x401116</tt>, so let me type:
```C
$ addr2line -e hello -a 0x401116
hello.c:6
```


And voilà! I get the exact location of the error. Again, this is lightweight and non-invasive, I only need my original program and the address.

The addr2line utility requires you to compile your code with debug symbols. If you try turning on optimization too much, you may not be able to get back to the line of code. However, you may use some optimization (-O1). The following works in this test:
```C
cc -g -O1 -o hello hello.c -lSegFault
```


In fact, I recommend you compile your code with the <tt>-O1</tt> flag generally when debugging.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/05/01).

__Appendix__. Some of you might be wondering, why not wait for the application to dumb cores and then load the core into a debugger like gdb or ldb? That is not always possible. Some systems do not dump cores, or the cores might required privileged access. Furthermore, it may take more steps and more time if you have to redo the steps often.

