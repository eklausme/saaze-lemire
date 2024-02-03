---
date: "2021-10-27 12:00:00"
title: "In C, how do you know if the dynamic allocation succeeded?"
---



In the C programming language, we allocate memory dynamically (on the heap) using the malloc function. You pass malloc a size parameter corresponding to the number of bytes you need. The function returns either a pointer to the allocated memory or the NULL pointer if the memory could not be allocated.

Or so you may think. Let us write a program that allocates 1 terabytes of memory and then tries to write to this newly allocated memory:
```C
#include <stdio.h>
#include <stdlib.h>

int main() {
  size_t large = 1099511627776;
  char *buffer = (char *)malloc(large);
  if (buffer == NULL) {
    printf("error!\n");
    return EXIT_FAILURE;
  }
  printf("Memory allocated\n");
  for (size_t i = 0; i < large; i += 4096) {
    buffer[i] = 0;
  }
  free(buffer);
  return EXIT_SUCCESS;
}
```


After running and compiling this program, you would expect to either get the message &ldquo;error!&rdquo;, in which case the program terminates immediately&hellip; or else you might expect to see &ldquo;Memory allocated&rdquo; (if 1 terabyte of memory is available) in which case the program should terminate successfully.

Under both macOS/clang and Linux/GCC, I find that the program prints &ldquo;Memory allocated&rdquo; and then crashes.

What is happening?

The malloc call does allocate memory, but it will almost surely allocate &ldquo;virtual memory&rdquo;. At the margin, it could be that no physical memory is allocated at all. The system merely sets aside the address space for the memory allocation. It is when you try to use the memory that the physical allocation happens.

It may then fail.

It means that checking the memory allocation was a success is probably much less useful than you might have imagined when calling malloc.

It also leads to confusion when people ask how much memory a program uses. It is wrong to add up the calls to malloc because you get the virtual memory usage. If you use a system-level tool that reports the memory usage of your processes, you should look at the real memory usage. Here is the current memory usage of a couple of processes on my laptop currently:

process                  |memory (virtual)         |memory (real)            |
-------------------------|-------------------------|-------------------------|
qemu                     |3.94 GB                  |32 MB                    |
safari                   |3.7 GB                   |180 MB                   |


Dynamic memory is allocated in pages (e.g., 4 kB) and it is often much smaller than the virtual memory. Doing &ldquo;malloc(x)&rdquo; is not the same as taking x bytes of physical memory.

In general, it is therefore a difficult question to know whether the allocation succeeded when relying on malloc. You may only find out when you write and read to the newly allocated memory.

__Further reading__: [Hidden Costs of Memory Allocation](https://randomascii.wordpress.com/2014/12/10/hidden-costs-of-memory-allocation/)

