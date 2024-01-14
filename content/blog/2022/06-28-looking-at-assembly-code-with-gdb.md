---
date: "2022-06-28 12:00:00"
title: "Looking at assembly code with gdb"
---



Most of us write code using higher level languages (Go, C++), but if you want to understand the code that matters to your processor, you need to look at the &lsquo;assembly&rsquo; version of your code. Assembly is a just a series of instructions.

At first, assembly code looks daunting, and I discourage you from writing sizeable programs in assembly. However, with little training, you can learn to count instructions and spot branches. It can help you gain a deeper insight into how your program works. Let me illustrate what you can learn by look at assembly. Let us consider the following C++ code:
```C
long f(int x) {
    long array[] = {1,2,3,4,5,6,7,8,999,10};
    return array[x];
}

long f2(int x) {
    long array[] = {1,2,3,4,5,6,7,8,999,10};
    return array[x+1];
}
```


This code contains two 80 bytes arrays, but they are identical. Is this a source of worry? If you look at the assembly code produced by most compilers, you will find that exactly identical constants are generally &lsquo;compressed&rsquo; (just one version is stored). If I compile these two functions with gcc or clang compilers using the -S flag, I can plainly see the compression because the array occurs just once: (Do not look at all the instructions&hellip; just scan the code.)
```C
	.text
	.file	"f.cpp"
	.globl	_Z1fi                           // -- Begin function _Z1fi
	.p2align	2
	.type	_Z1fi,@function
_Z1fi:                                  // @_Z1fi
	.cfi_startproc
// %bb.0:
	adrp	x8, .L__const._Z2f2i.array
	add	x8, x8, :lo12:.L__const._Z2f2i.array
	ldr	x0, [x8, w0, sxtw #3]
	ret
.Lfunc_end0:
	.size	_Z1fi, .Lfunc_end0-_Z1fi
	.cfi_endproc
                                        // -- End function
	.globl	_Z2f2i                          // -- Begin function _Z2f2i
	.p2align	2
	.type	_Z2f2i,@function
_Z2f2i:                                 // @_Z2f2i
	.cfi_startproc
// %bb.0:
	adrp	x8, .L__const._Z2f2i.array
	add	x8, x8, :lo12:.L__const._Z2f2i.array
	add	x8, x8, w0, sxtw #3
	ldr	x0, [x8, #8]
	ret
.Lfunc_end1:
	.size	_Z2f2i, .Lfunc_end1-_Z2f2i
	.cfi_endproc
                                        // -- End function
	.type	.L__const._Z2f2i.array,@object  // @__const._Z2f2i.array
	.section	.rodata,"a",@progbits
	.p2align	3
.L__const._Z2f2i.array:
	.xword	1                               // 0x1
	.xword	2                               // 0x2
	.xword	3                               // 0x3
	.xword	4                               // 0x4
	.xword	5                               // 0x5
	.xword	6                               // 0x6
	.xword	7                               // 0x7
	.xword	8                               // 0x8
	.xword	999                             // 0x3e7
	.xword	10                              // 0xa
	.size	.L__const._Z2f2i.array, 80

	.ident	"Ubuntu clang version 14.0.0-1ubuntu1"
	.section	".note.GNU-stack","",@progbits
	.addrsig
```


However, if you modify even slightly the constants, then this compression typically does not happen (e.g., if you try to append one integer value to one of the arrays, the code will duplicate the arrays in full).

To assess the performance of a code routine, my first line of attack is always to count instructions. Keeping everything the same, if you can rewrite your code so that it generates fewer instructions, it should be faster. I also like to spot conditional jumps because that is often where your code can suffer, if the branch is hard to predict.

It is easy to convert a whole set of functions to assembly, but it becomes unpractical as your projects become larger. Under Linux, the standard &lsquo;debugger&rsquo; (<tt>gdb</tt>) is a great tool to look selectively at the assembly code produced by the compile. Let us consider my previous blog post, [Filtering numbers quickly with SVE on Amazon Graviton 3 processors](/lemire/blog/2022/06/23/filtering-numbers-quickly-with-sve-on-amazon-graviton-3-processors/). In that blog post, I present several functions which I have implemented in a [short C++ file](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2022/06/23/filter.cpp). To examine the result, I simply load the compiled binary into <tt>gdb</tt>:
```C
$ gdb ./filter
```


Then I can examine functions&hellip; such as the `remove_negatives` function:
```C
(gdb) set print asm-demangle
(gdb) disas remove_negatives
Dump of assembler code for function remove_negatives(int const*, long, int*):
   0x00000000000022e4 <+0>:	mov	x4, #0x0                   	// #0
   0x00000000000022e8 <+4>:	mov	x3, #0x0                   	// #0
   0x00000000000022ec <+8>:	cntw	x6
   0x00000000000022f0 <+12>:	whilelt	p0.s, xzr, x1
   0x00000000000022f4 <+16>:	nop
   0x00000000000022f8 <+20>:	ld1w	{z0.s}, p0/z, [x0, x3, lsl #2]
   0x00000000000022fc <+24>:	cmpge	p1.s, p0/z, z0.s, #0
   0x0000000000002300 <+28>:	compact	z0.s, p1, z0.s
   0x0000000000002304 <+32>:	st1w	{z0.s}, p0, [x2, x4, lsl #2]
   0x0000000000002308 <+36>:	cntp	x5, p0, p1.s
   0x000000000000230c <+40>:	add	x3, x3, x6
   0x0000000000002310 <+44>:	add	x4, x4, x5
   0x0000000000002314 <+48>:	whilelt	p0.s, x3, x1
   0x0000000000002318 <+52>:	b.ne	0x22f8 <remove_negatives(int const*, long, int*)+20>  // b.any
   0x000000000000231c <+56>:	ret
End of assembler dump.
```


At address 52, we conditionally go back to address 20. So we have a total of 9 instructions in our main loop. From my benchmarks (see previous blog post), I use 1.125 instructions per 32-bit word, which is consistent with each loop processing 8 32-bit words.

Another way to assess performance is to look at branches. Let us disassemble <tt>remove_negatives_scalar</tt>, a branchy function:
```C
(gdb) disas remove_negatives_scalar
Dump of assembler code for function remove_negatives_scalar(int const*, long, int*):
   0x0000000000002320 <+0>:	cmp	x1, #0x0
   0x0000000000002324 <+4>:	b.le	0x234c <remove_negatives_scalar(int const*, long, int*)+44>
   0x0000000000002328 <+8>:	add	x4, x0, x1, lsl #2
   0x000000000000232c <+12>:	mov	x3, #0x0                   	// #0
   0x0000000000002330 <+16>:	ldr	w1, [x0]
   0x0000000000002334 <+20>:	add	x0, x0, #0x4
   0x0000000000002338 <+24>:	tbnz	w1, #31, 0x2344 <remove_negatives_scalar(int const*, long, int*)+36>
   0x000000000000233c <+28>:	str	w1, [x2, x3, lsl #2]
   0x0000000000002340 <+32>:	add	x3, x3, #0x1
   0x0000000000002344 <+36>:	cmp	x4, x0
   0x0000000000002348 <+40>:	b.ne	0x2330 <remove_negatives_scalar(int const*, long, int*)+16>  // b.any
   0x000000000000234c <+44>:	ret
End of assembler dump.
```


We see the branch at address 24 (instruction <tt>tbnz</tt>), it conditionally jumps over the next two instructions. We had an equivalent &lsquo;branchless&rsquo; function called <tt>remove_negatives_scalar_branchless</tt>. Let us see if it is indeed branchless:
```C
(gdb) disas remove_negatives_scalar_branchless
Dump of assembler code for function remove_negatives_scalar_branchless(int const*, long, int*):
   0x0000000000002350 <+0>:	cmp	x1, #0x0
   0x0000000000002354 <+4>:	b.le	0x237c <remove_negatives_scalar_branchless(int const*, long, int*)+44>
   0x0000000000002358 <+8>:	add	x4, x0, x1, lsl #2
   0x000000000000235c <+12>:	mov	x3, #0x0                   	// #0
   0x0000000000002360 <+16>:	ldr	w1, [x0], #4
   0x0000000000002364 <+20>:	str	w1, [x2, x3, lsl #2]
   0x0000000000002368 <+24>:	eor	x1, x1, #0x80000000
   0x000000000000236c <+28>:	lsr	w1, w1, #31
   0x0000000000002370 <+32>:	add	x3, x3, x1
   0x0000000000002374 <+36>:	cmp	x0, x4
   0x0000000000002378 <+40>:	b.ne	0x2360 <remove_negatives_scalar_branchless(int const*, long, int*)+16>  // b.any
   0x000000000000237c <+44>:	ret
End of assembler dump.
(gdb)
```


Other than the conditional jump produced by the loop (address 40), the code is indeed branchless.

In this particular instance, with one small binary file, it is easy to find the functions I need. What if I load a large binary with many compiled functions?

Let me examine the [benchmark binary from the simdutf library](https://github.com/simdutf/simdutf). It has many functions, but let us assume that I am looking for a function that might validate UTF-8 inputs. I can use <tt>info functions</tt> to find all functions matching a given pattern.
```C
(gdb) info functions validate_utf8
All functions matching regular expression "validate_utf8":

Non-debugging symbols:
0x0000000000012710  event_aggregate simdutf::benchmarks::BenchmarkBase::count_events<simdutf::benchmarks::Benchmark::run_validate_utf8(simdutf::implementation const&, unsigned long)::{lambda()#1}>(simdutf::benchmarks::Benchmark::run_validate_utf8(simdutf::implementation const&, unsigned long)::{lambda()#1}, unsigned long) [clone .constprop.0]
0x0000000000012b54  simdutf::benchmarks::Benchmark::run_validate_utf8(simdutf::implementation const&, unsigned long)
0x0000000000018c90  simdutf::fallback::implementation::validate_utf8(char const*, unsigned long) const
0x000000000001b540  simdutf::arm64::implementation::validate_utf8(char const*, unsigned long) const
0x000000000001cd84  simdutf::validate_utf8(char const*, unsigned long)
0x000000000001d7c0  simdutf::internal::unsupported_implementation::validate_utf8(char const*, unsigned long) const
0x000000000001e090  simdutf::internal::detect_best_supported_implementation_on_first_use::validate_utf8(char const*, unsigned long) const
```


You see that the <tt>info functions</tt> gives me both the function name as well as the function address. I am interested in <tt>simdutf::arm64::implementation::validate_utf8</tt>. At that point, it becomes easier to just refer to the function by its address:
```C
(gdb) disas 0x000000000001b540
Dump of assembler code for function simdutf::arm64::implementation::validate_utf8(char const*, unsigned long) const:
   0x000000000001b540 <+0>:	stp	x29, x30, [sp, #-144]!
   0x000000000001b544 <+4>:	adrp	x0, 0xa0000
   0x000000000001b548 <+8>:	cmp	x2, #0x40
   0x000000000001b54c <+12>:	mov	x29, sp
   0x000000000001b550 <+16>:	ldr	x0, [x0, #3880]
   0x000000000001b554 <+20>:	mov	x5, #0x40                  	// #64
   0x000000000001b558 <+24>:	movi	v22.4s, #0x0
   0x000000000001b55c <+28>:	csel	x5, x2, x5, cs  // cs = hs, nlast
   0x000000000001b560 <+32>:	ldr	x3, [x0]
   0x000000000001b564 <+36>:	str	x3, [sp, #136]
   0x000000000001b568 <+40>:	mov	x3, #0x0                   	// #0
   0x000000000001b56c <+44>:	subs	x5, x5, #0x40
   0x000000000001b570 <+48>:	b.eq	0x1b7b8 <simdutf::arm64::implementation::validate_utf8(char const*, unsigned long) const+632>  // b.none
   0x000000000001b574 <+52>:	adrp	x0, 0x86000
   0x000000000001b578 <+56>:	adrp	x4, 0x86000
   0x000000000001b57c <+60>:	add	x6, x0, #0x2f0
   0x000000000001b580 <+64>:	adrp	x0, 0x86000
...
```


I have cut short the output because it is too long. When single functions become large, I find it more convenient to redirect the output to a file which I can process elsewhere.
```C
gdb -q ./benchmark -ex "set pagination off" -ex "set print asm-demangle" -ex "disas 0x000000000001b540" -ex quit > gdbasm.txt
```


Sometimes I am just interested in doing some basic statistics such as figuring out which instructions are used by the function:
```C
$ gdb -q ./benchmark -ex "set pagination off" -ex "set print asm-demangle" -ex "disas 0x000000000001b540" -ex quit | awk '{print $3}' | sort |uniq -c | sort -r | head
     32 and
     24 tbl
     24 ext
     18 cmhi
     17 orr
     16 ushr
     16 eor
     14 ldr
     13 mov
     10 movi
```


And we see that the most common instruction in this code is <tt>and</tt>. It reassures me that the code was properly compiled. I can do some research on all the generated instructions and they all seem like adequate choices given the code that I produce.

The general lesson is that looking at the generated assembly is not so difficult and with little training, it can make you a better programmer.

__Tip__: It helps sometimes to disable pagination (<tt>set pagination off</tt>).

__Useful script__: I often write automated script in bash to locate addresses such as this one:
```C

ADDRESS=$(gdb -q ./tests/wpt_tests -ex "info functions parse_url[^]]*$" -ex quit | grep -o "0x[0-9a-fA-F]*")
gdb -q ./tests/wpt_tests -ex "set pagination off" -ex "set print asm-demangle" -ex "disas "$ADDRESS -ex quit
```


