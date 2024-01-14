---
date: "2018-07-25 12:00:00"
title: "It is more complicated than I thought: -mtune, -march in GCC"
---



My favourite C compilers are GNU GCC and LLVM&rsquo;s Clang. In C, you compile for some architecture. Thus you have to tell the compiler what kind of machine you have.

In theory, you could recompile all the code for the exact machine you have, but it is slow and error prone. So we rely on prebuilt binaries, typically, and these are often not tuned specifically for our hardware. It is possible for a program to detect the hardware it is running on and automatically adapt (e.g., via runtime dispatch) but that is not often done in C.

So GCC and Clang have flags that allow you to tell them what kind of hardware you have. They are &ldquo;-march&rdquo; and &ldquo;-mtune&rdquo;. I thought I understood them, until now.

Let me run through the basics of &ldquo;-march&rdquo; and &ldquo;-mtune&rdquo; that most experienced programmers will know about.

- The first flag (&ldquo;-march&rdquo;) tells the compiler about the minimal hardware your code should run on. That is, if you write &ldquo;-march=haswell&rdquo;, then your code should run on machines that have haswell-type processors and anything better or compatible (anything that has the same instruction sets). They may not run on other machines. The GCC documentation is clear:

>  -march=cpu-type allows GCC to generate code that may not run at all on processors other than the one indicated.

- The other flag (&ldquo;-mtune&rdquo;) is just an optimization hint, e.g., if you write &ldquo;-mtune=haswell&rdquo;, you tell the compile to generate code that runs best on &ldquo;haswell&rdquo;-type processors. The GCC documentation is clear enough:

> While picking a specific cpu-type schedules things appropriately for that particular chip, the compiler does not generate any code that cannot run on the default machine type unless you use a -march=cpu-type option. For example, if GCC is configured for i686-pc-linux-gnu then -mtune=pentium4 generates code that is tuned for Pentium 4 but still runs on i686 machines.


 By default, when unspecified, &ldquo;-mtune=generic&rdquo; applies which means that the compiler will &ldquo;produce code optimized for the most common processors&rdquo;. This is somewhat ambiguous and will strictly depend on the compiler version you are using, as new processors being released might change this tuning.


Thankfully, your compiler can automatically detect your processor, it calls this automatically detected processor &ldquo;native&rdquo;. So I have been compiling my code with &ldquo;-march=native&rdquo; because I want the compiler to do the best it can do on the machine I am using. I assumed, until now, that if my processor is detected as having architecture X, doing &ldquo;-march=native&rdquo; implied &ldquo;-march=X -mtune=X&rdquo;. And that could almost be inferred from the documentation:

> Specifying -march=cpu-type implies -mtune=cpu-type.


This has lead me to believe that &ldquo;-march&rdquo; trumps &ldquo;-mtune&rdquo; meaning that if you set &ldquo;-march=native&rdquo;, then the &ldquo;-mtune&rdquo; is effectively irrelevant.
I was wrong.

Let us check using funny command lines. I use a skylake processor with GNU GCC 5.5. It is important to note that this compiler predates skylake processors.

1. I can type <tt>gcc -march=native -Q --help=target | grep -- '-march=' | cut -f3</tt> to check which processor is automatically detected. On my favourite machine, I get &ldquo;broadwell&rdquo;. That is slightly wrong, but close enough given that the compiler does not know about skylake processors.
1. One reading of the documentation is that &ldquo;-march=native&rdquo; implies &ldquo;-mtune=native&rdquo;, so let us check. I type <tt>gcc -march=native -Q --help=target | grep -- '-mtune=' | cut -f3</tt> and I get &ldquo;generic&rdquo;. Ah! The compiler has detected &ldquo;broadwell&rdquo; but it is not tuning for &ldquo;broadwell&rdquo; or for &ldquo;native&rdquo;, rather it is tuning for &ldquo;generic&rdquo;.
1. What if instead of &ldquo;-march=native&rdquo;, I type &ldquo;-march=broadwell&rdquo;. Surely it should make no difference? I type <tt>gcc -march=broadwell -Q --help=target | grep -- '-mtune=' | cut -f3</tt> and I get &ldquo;broadwell&rdquo;. So even if you have a broadwell processor that gets recognized as such, the flags &ldquo;-march=native&rdquo; and &ldquo;-march=broadwell&rdquo; differ in the sense that they impact differently the tuning.


Let me repeat this: if you have a skylake processor that gets recognized as a broadwell processor, then &ldquo;-march=broadwell&rdquo; and &ldquo;-march=native&rdquo; are different flags having a different effect on your code.

What you care about is whether it produces different binaries. Does it? Unfortunately yes, it does. [See my code sample](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/07/25).

Does it matter in practice, as far as performance goes? Probably not in actual systems, but if you are doing microbenchmarking, studying a specific function, small differences might matter.

I will keep using &ldquo;-march=native&rdquo; as it is the expedient approach, but I would really like to know how to best tune specifically for my hardware without having to do messy command-line Kung Fu.

__Credit__: The example and the key observation are due to Travis Downs.

