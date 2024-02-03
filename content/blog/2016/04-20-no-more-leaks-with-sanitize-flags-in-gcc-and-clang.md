---
date: "2016-04-20 12:00:00"
title: "No more leaks with sanitize flags in gcc and clang"
---



If you are programming in C and C++, you are probably wasting at least some of your time hunting down memory problems. Maybe you allocated memory and forgot to free it later.

A whole industry of tools has been built to help us trace and solve these problems. On Linux and MacOS, the state-of-the-art has been [valgrind](http://valgrind.org/). Build your code as usual, then run it while under valgrind and memory problems should be identified.

Tools are nice but a separate check breaks your workflow. If you are using recent versions of the GCC and clang compilers, there is a better option: sanitize flags.

Suppose you have the following C program:
```C
#include <stdio.h>
#include <stdlib.h>

int main(int argc, char** argv)
{
   char * buffer = malloc(1024);
   sprintf(buffer, "%d", argc);
   printf("%s",buffer);
}
```


Save this file as <tt>s.c</tt>. The program should simply print out how many arguments were entered on the command line. Notice the call to `malloc` that allocates a kilobyte of memory. There is no accompanying call to `free` and so the kilobyte of memory is &ldquo;lost&rdquo; and only recovered when the program ends.

Let us compile the program with the appropriate sanitize flags (<tt>-fsanitize=address -fno-omit-frame-pointer</tt>):
```C
gcc -ggdb -o s s.c -fsanitize=address -fno-omit-frame-pointer
```


When you run the program, you get the following:
```C
$ ./s

=================================================================
==3911==ERROR: LeakSanitizer: detected memory leaks

Direct leak of 1024 byte(s) in 1 object(s) allocated from:
&#xa0;&#xa0;&#xa0;&#xa0;#0 0x7f55516b644a in malloc (/usr/lib/x86_64-linux-gnu/libasan.so.2+0x9444a)
&#xa0;&#xa0;&#xa0;&#xa0;#1 0x40084e in main /home/dlemire/tmp/s.c:6
&#xa0;&#xa0;&#xa0;&#xa0;#2 0x7f555127eec4 in __libc_start_main (/lib/x86_64-linux-gnu/libc.so.6+0x21ec4)

SUMMARY: AddressSanitizer: 1024 byte(s) leaked in 1 allocation(s).
```


Notice how it narrows down to the line of code where the memory leak came from?

It is even nicer: the return value of the command will be non-zero meaning that if this code was run as part of software testing, you could automagically flag the code as being buggy.

While you are at it, you can add other sanitize flags such as <tt>-fsanitize=undefined</tt> to your code. The undefined sanitizer will warn you if you are relying on undefined behavior as per the C or C++ specifications.

These flags represent significant steps forward for people programming in C or C++ with gcc or clang. They make it a lot more likely that your code will be reliable.

Really, if you are using gcc or clang and you are not using these flags, you are not being serious.

Further reading: [Building better software with better tools: sanitizers versus valgrind](/lemire/blog/2019/05/16/building-better-software-with-better-tools-sanitizers-versus-valgrind/)

Update: [Microsoft Visual Studio supports AddressSanitizer (ASan).](https://devblogs.microsoft.com/cppblog/addresssanitizer-asan-for-windows-with-msvc/)

