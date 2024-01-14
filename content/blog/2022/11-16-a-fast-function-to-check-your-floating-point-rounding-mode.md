---
date: "2022-11-16 12:00:00"
title: "A fast function to check your floating-point rounding mode"
---



> For speed, we use finite-precision number types in software. When doing floating-point computations in software, the results are usually not exact. For example, you can have the number 1.0 and the number 2<sup>-1000</sup>. They can both be represented exactly using standard double-precision IEEE floating-point numbers. However, you cannot represent their sum or difference exactly. So what does a computer do when you ask it to compute (1.0 + 2<sup>-1000</sup>) or (1.0 &#8211; 2<sup>-1000</sup>) ? It usually outputs the nearest approximation, that 1.0. In other words, it looks at all the numbers that it can represent and picks one that is nearest to the exact value. This works for most basic operations like addition, multiplication, division, subtraction.


However, it is possible to ask the processor to change the rounding mode. In some cases, you can request a specific rounding mode per instruction (e.g., with some AVX-512 instructions), but most times there is one setting valid for all instructions within the current thread. In C/C++, you can change the rounding mode to round upward (<tt>fesetround(FE_UPWARD)</tt>), downward (<tt>fesetround(FE_DOWNWARD)</tt>), toward zero (<tt>fesetround(FE_TOWARDZERO)</tt>). The default is to round to the nearest value (<tt>fesetround(FE_TONEAREST)</tt>).

Some of your code might be assuming that the rounding is to the nearest value. Maybe you want to check that it is so if you are providing a function for others to use. All you need is the following&hellip;
```C
#include <fenv.h>

bool are_we_ok() {
  return fegetround() == FE_TONEAREST;
}
```


Unfortunately, this function is not free. It might be a function call to a non-trivial instruction such as <code class="notranslate">stmxcsr</code> on x64 processors. It is fine to call it from time to time, but if you have tiny functions that only cost a few hundred instructions, it may be too expensive.

The C functions strtod()/strtof()  available on Linux contain the following switch/case code:
```C
	bc.rounding = 1;
	switch(fegetround()) {
	  case FE_TOWARDZERO:	bc.rounding = 0; break;
	  case FE_UPWARD:	bc.rounding = 2; break;
	  case FE_DOWNWARD:	bc.rounding = 3;
	}
```


It means that your software might routinely call the fegetround() function. Thankfully, there is a fast approach requiring just an addition, a subtraction and a comparison. Let x be a small value, much smaller than 1, so that <tt>1+x</tt> is very close to 1 and should be rounded to 1. Then it suffices to check that (<tt>1+x == 1-x</tt>). Indeed, when rounding up, <tt>1+x</tt> will differ from 1, it will round to a small number just slightly larger than 1. Similarly, when rounding toward zero or rounding down, <tt>1-x</tt> will get rounded to a value just under 1. Only when you round to the nearest value do you get that <tt>1+x == 1-x</tt>.

You might think that we simply can do <tt>1.0 + 1e-100 == 1.0 - 1e-100</tt>, using a function such as this one&hellip;
```C
bool rounds_to_nearest() {
  return (1.0f +  1e-38f == 1.0f - 1e-38f);
}
```


Sadly, your optimizing compiler might turn this function into a function which returns true unconditionally, irrespective of the processor&rsquo;s rounding mode.

As a workaround, the following function should do:
```C
bool rounds_to_nearest() {
  static volatile float fmin = 1e-38;
  return (fmin + 1.0f == 1.0f - fmin);
}
```


We declare the small value to be volatile: this asks the C/C++ compiler to load the variable each time it needs to access it. It prevents the compiler from optimizing away the function at compile time. The compiler is forced to recompute the function each time.

You can do slightly better performance-wise because this function loads the value 1e-38 twice. To load it just once, do&hellip;
```C
bool rounds_to_nearest() {
  static volatile float fmin = 1e-38;
  float fmini = fmin;
  return (fmini + 1.0f == 1.0f - fmini);
}
```


In my tests, on both an Apple ARM platform and on a recent Intel processor with GCC, this fast function is several times faster than a call to <tt>fegetround()</tt>. It is cheap enough that you can probably call it repeatedly without much care.

__Credit__: I took the idea from GitHub user @mwalcott3.

__Note__: Some processors have modes where all operations are done using a higher precision (e.g., 80 bits) so a `float` may use more than 32 bits internally. This means that you should choose you small factor (e.g. 1e-38) to be really small.

