---
date: "2021-10-09 12:00:00"
title: "For software performance, can you always trust inlining?"
---



It is easier for an optimizing compiler to spot and eliminate redundant operations if it can operate over a large block of code. Nevertheless, it is still recommended to stick with small functions. Small functions are easier to read and debug. Furthermore, you can often rely on the compiler smartly inline your small functions inside larger functions. Furthermore, if you have a just-in-time compiler (e.g., in C# and Java), the compiler may often focus its energy on functions that are called more often. Thus small functions are more likely to get optimized.

Nevertheless, you sometimes want to manually inline your code. Even the smartest compilers get it wrong. Furthermore, some optimizing compilers are simply less aggressive than others.

We have been working on a fast float-parsing library in [C# called csFastFloat](https://github.com/CarlVerret/csFastFloat). Though it is already several times faster than the standard library, the primary author (Verret) wanted to boost the performance further by using SIMD instructions. SIMD instructions are fancy instructions that allow you to process multiple words at once, unlike regular instructions. The C# language allows you to use SIMD instructions to speed up your code.

He encountered a case where using SIMD instructions failed to bring the exciting new performance he was expecting. The easy way out in the end was to &ldquo;manually inline&rdquo; the functions. I am going to review a simplified instance because I believe it is worth discussing.

I am not going to review it in detail, but the following C# function allows you to quickly determine if 16 bytes are made of ASCII digits. In ASCII, the character &lsquo;0&rsquo; has value 48 whereas the character &lsquo;9&rsquo; has value 57. The function builds two &ldquo;vectors&rdquo; made of the values 47 and 58 (repeated 16 times) and then it does 16 comparisons at once (with CompareGreaterThan and then CompareLessThan). It concludes with a couple of instructions to check whether all conditions are met to have 16 digits.
```C
unsafe static bool is_made_of_sixteen_digits(byte* chars) {
  Vector128<sbyte> ascii0 = Vector128.Create((sbyte)47);
  Vector128<sbyte> after_ascii9 = Vector128.Create((sbyte)58);
  Vector128<sbyte> raw = Sse41.LoadDquVector128((sbyte*)chars);
  var a = Sse2.CompareGreaterThan(raw, ascii0);
  var b = Sse2.CompareLessThan(raw, after_ascii9);
  var c = Sse2.Subtract(a, b); // this is not optimal
  return (Sse41.TestZ(c,c));
}
```


Let us write a function that tries to determine if I have a string that begins with 16 digits, or 32 digits. It is a made up function that I just use for illustration purposes.
```C
// return 2 if 32 digits are found
// return 1 if 16 digits are found
// otherwise return 1
unsafe static int ParseNumberString(byte* p, byte* pend) {
  if ((p + 16 <= pend) && is_made_of_sixteen_digits(p)) {
    if((p + 32 <= pend) && is_made_of_sixteen_digits(p + 16)) {
      return 2;
    }
    return 1;
  }
  return 0;
}
```


If you just write that out, C# might fail to inline the is_made_of_sixteen_digits function. Thankfully, you can tell C# that you do want it to inline the child function by labelling it with an &ldquo;AggressiveInlining&rdquo; attribute.

So far so good, right?

Let us look at the assembly output to see how it gets compiled. Do not worry, I do not expect you to read this gibberish. Just look at the lines that start with an arrow (&ldquo;-&gt;&rdquo;).
```C
<Program>$.<<Main>$>g__ParseNumberString|0_1(Byte*, Byte*)
    L0000: push ebp
    L0001: mov ebp, esp
    L0003: vzeroupper
    L0006: lea eax, [ecx+0x10]
    L0009: cmp eax, edx
    L000b: ja short L0071
    -> L000d: vmovupd xmm0, [<Program>$.<<Main>$>g__ParseNumberString|0_1(Byte*, Byte*)]
    -> L0015: vmovupd xmm1, [<Program>$.<<Main>$>g__ParseNumberString|0_1(Byte*, Byte*)]
    L001d: vlddqu xmm2, [ecx]
    L0021: vpcmpgtb xmm0, xmm2, xmm0
    L0025: vpcmpgtb xmm1, xmm1, xmm2
    L0029: vpsubb xmm0, xmm0, xmm1
    L002d: vptest xmm0, xmm0
    L0032: jne short L0071
    L0034: lea eax, [ecx+0x20]
    L0037: cmp eax, edx
    L0039: ja short L006a
    -> L003b: vmovupd xmm0, [<Program>$.<<Main>$>g__ParseNumberString|0_1(Byte*, Byte*)]
    -> L0043: vmovupd xmm1, [<Program>$.<<Main>$>g__ParseNumberString|0_1(Byte*, Byte*)]
    L004b: vlddqu xmm2, [ecx+0x10]
    L0050: vpcmpgtb xmm0, xmm2, xmm0
    L0054: vpcmpgtb xmm1, xmm1, xmm2
    L0058: vpsubb xmm0, xmm0, xmm1
    L005c: vptest xmm0, xmm0
    L0061: jne short L006a
    L0063: mov eax, 2
    L0068: pop ebp
    L0069: ret
    L006a: mov eax, 1
    L006f: pop ebp
    L0070: ret
    L0071: xor eax, eax
    L0073: pop ebp
    L0074: ret
```


What C# does is to create the &ldquo;vectors&rdquo; made of the values 47 and 58 twice each (for a total of four times).

There might be a clever way to get C# to stop being inefficient, but you can also just manually inline. That is you create one function that includes the other function. The result might look at follows:
```C
// return 2 if 32 digits are found
// return 1 if 16 digits are found
// otherwise return 1
unsafe static int ParseNumberStringInline(byte* p, byte* pend) {
  if (p + 16 <= pend) {
    Vector128<sbyte> ascii0 = Vector128.Create((sbyte)47);
    Vector128<sbyte> after_ascii9 = Vector128.Create((sbyte)58);
    Vector128<sbyte> raw = Sse41.LoadDquVector128((sbyte*)p);
    var a = Sse2.CompareGreaterThan(raw, ascii0);
    var b = Sse2.CompareLessThan(raw, after_ascii9);
    var c = Sse2.Subtract(a, b);
    if((p + 32 <= pend) && Sse41.TestZ(c,c)){
      raw = Sse41.LoadDquVector128((sbyte*)p + 16);
      a = Sse2.CompareGreaterThan(raw, ascii0);
      b = Sse2.CompareLessThan(raw, after_ascii9);
      c = Sse2.Subtract(a, b);
      if(Sse41.TestZ(c,c)) { return 2; }
    }
    return 1;
  }
  return 0;
}
```


This new code is harder to read and maybe harder to maintain. However, let us look at the compiled output:
```C
<Program>$.<<Main>$>g__ParseNumberStringInline|0_2(Byte*, Byte*)
    L0000: push ebp
    L0001: mov ebp, esp
    L0003: vzeroupper
    L0006: lea eax, [ecx+0x10]
    L0009: cmp eax, edx
    L000b: ja short L0061
    L000d: vmovupd xmm0, [<Program>$.<<Main>$>g__ParseNumberStringInline|0_2(Byte*, Byte*)]
    L0015: vmovupd xmm1, [<Program>$.<<Main>$>g__ParseNumberStringInline|0_2(Byte*, Byte*)]
    L001d: vlddqu xmm2, [ecx]
    L0021: vpcmpgtb xmm3, xmm2, xmm0
    L0025: vpcmpgtb xmm2, xmm1, xmm2
    L0029: vpsubb xmm4, xmm3, xmm2
    L002d: lea eax, [ecx+0x20]
    L0030: cmp eax, edx
    L0032: ja short L005a
    L0034: vptest xmm4, xmm4
    L0039: jne short L005a
    L003b: vlddqu xmm2, [ecx+0x10]
    L0040: vpcmpgtb xmm3, xmm2, xmm0
    L0044: vpcmpgtb xmm2, xmm1, xmm2
    L0048: vpsubb xmm4, xmm3, xmm2
    L004c: vptest xmm4, xmm4
    L0051: jne short L005a
    L0053: mov eax, 2
    L0058: pop ebp
    L0059: ret
    L005a: mov eax, 1
    L005f: pop ebp
    L0060: ret
    L0061: xor eax, eax
    L0063: pop ebp
    L0064: ret
```


I do not expect you to read this gibberish, but notice how the result is now tighter. It is also going to be slightly faster.

As a rule of thumb, if you look at the assembly output of your code, and it is shorter, it is usually the code that you will have better performance. It is simply the case that executing fewer instructions is often faster.

Though my example is a toy example, you should expect [the csFastFloat library to benefit from SIMD instructions in the near future](https://github.com/CarlVerret/csFastFloat). The preliminary numbers I have seen suggest a nice performance bump. There is a [pull request.](https://github.com/CarlVerret/csFastFloat/pull/80)

[My source code is available](https://gist.github.com/lemire/13746f1ea34ee28bdea6306f73598c65).

