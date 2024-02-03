---
date: "2021-10-21 12:00:00"
title: "Converting binary floating-point numbers to integers"
---



You are given a floating-point number, e.g. a double type in Java or C++. You would like to convert it to an integer type&hellip; but only if the conversion is exact. In other words, you want to convert the floating-point number to an integer and check if the result is exact.

In C++, you could implement such a function using few lines of code:
```C
bool to_int64_simple(double x, int64_t *out) {
  int64_t tmp = int64_t(x);
  *out = tmp;
  return tmp == x;
}
```


The code is short in C++, and it will compile to few lines of assembly. In x64, you might get the following:
```C
        cvttsd2si rax, xmm0
        pxor    xmm1, xmm1
        mov     edx, 0
        cvtsi2sd        xmm1, rax
        mov     QWORD PTR [rdi], rax
        ucomisd xmm1, xmm0
        setnp   al
        cmovne  eax, edx
```


Technically, the code might rely on undefined behaviour.

You could do it in a different manner. Instead of working with high-level instructions, you could copy your binary floating-point number to a 64-bit word and use your knowledge of the [IEEE binary64](https://en.wikipedia.org/wiki/Double-precision_floating-point_format) standard to extract the mantissa and the exponent.

It is much more code. It also involves pesky branches. I came up with the following routine:
```C
typedef union {
  struct {
    uint64_t fraction : 52;
    uint32_t exp_bias : 11;
    uint32_t sign : 1;
  } fields;
  double value;
} binary64_float;

bool to_int64(double x, int64_t *out) {
  binary64_float number = {.value = x};
  const int shift = number.fields.exp_bias - 1023 - 52;
  if (shift > 0) {
    return false;
  }
  if (shift <= -64) {
    if (x == 0) {
      *out = 0;
      return true;
    }
    return false;
  }
  uint64_t integer = number.fields.fraction | 0x10000000000000;
  if (integer << (64 + shift)) {
    return false;
  }
  integer >>= -shift;
  *out = (number.fields.sign) ? -integer : integer;
  return true;
}
```


How does it compare with the simple and naive routine?

I just wrote a simple benchmark where I iterate over many floating-point numbers in sequence, and I try to do the conversion. I effectively measure the throughput and report the number of nanosecond per function call. My benchmark does not stress the branch predictor. Unsurprisingly, the naive and simple approach can be faster.

system                   |long version             |simple version           |
-------------------------|-------------------------|-------------------------|
ARM M1 + LLVM 12         |0.95 ns/call             |1.1 ns/call              |
Intel 7700K + LLVM 13    |1.6 ns/call              |1.2 ns/call              |


I find reassuring that the simple approach is so fast. I was concerned at first that it would be burdensome.

It is possible that my long-form routine could be improved. However, it seems unlikely that it could ever be much more efficient than the simple version.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/10/20).

