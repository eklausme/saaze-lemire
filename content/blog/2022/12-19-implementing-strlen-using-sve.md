---
date: "2022-12-19 12:00:00"
title: "Implementing `strlen´ using SVE"
---



In C, the length of a string in marked by a 0 byte at the end of the string. Thus to determine the length of the string, one must scan it, looking for the 0 byte. Recent ARM processors have a powerful instruction set (SVE) that is well suited for such problems. It allows you to load large registers at once and to do wide comparisons (comparing many bytes at once).

Yet we do not want to read too much data. If you read beyond the string, you could hit another memory page and trigger a segmentation fault. This could crash your program.

Thankfully, SVE comes with a load instruction that would only fault on the &lsquo;first active element&rsquo;: as long as the first element you are loading is valid, then there is no fault.

With this in mind, a simple algorithm to compute the length of a C string is as follows:

1. Load a register.
1. Compare each byte in it to 0.
1. If any comparison matches, then locate the match and return the corresponding length.
1. If not, increment by the register size (given by svcntb()), and repeat.


Using intrinsics, the code looks as follows&hellip;
```C
size_t sve_strlen(const char *s) {
  size_t len = 0;
  while (true) {
    svuint8_t input = svldff1_u8(svptrue_b8(), (const uint8_t *)s + len);
    svbool_t matches = svcmpeq_n_u8(svptrue_b8(), input, 0);
    if (svptest_any(svptrue_b8(), matches)) {
      return len + svlastb_u8(svbrka_z(matches, matches), svindex_u8(0, 1));
    }
    len += svcntb();
  }
}
```


In assembly, the code looks as follows&hellip;
```C
mainloop:
        ldff1b  { z0.b }, p0/z, [x10, x8]
        add     x8, x8, x9
        cmpeq   p1.b, p0/z, z0.b, #0
        b.eq    .mainloop
```


I use BRKA (Break after first true condition) to locate the index of the first null character in the register when there is one. It creates a mask with a single true at the location where the nul appear. I then use LASTB (Extract last active element) combined with a constant (created with svindex_u8) which contains the byte values 0,1,2,3&hellip;. So if the nul appears at index 3, BRKA sets index 3 as true, then LASTB will extract the value at index 3 in the constant created with svindex_u8. Because the underlying register size is no larger than 256 bytes, we know that svindex_u8 cannot overflow (and wrap around 254,255, 0, 1, &hellip;).

Denis Yaroshevskiy proposed an alternative implementation which is simpler in how it handles the computation of the first nul in the register. Instead of my complicated approach, he recommends BRKB (Break before first true condition) which creates a mask where everything true prior to the first null character, and then he recommends calling CNTP (Count active elements).
```C
size_t sve_strlen(const char *s) {
  size_t len = 0;
  while (true) {
    svuint8_t input = svldff1_u8(svptrue_b8(), (const uint8_t *)s + len);
    svbool_t matches = svcmpeq_n_u8(svptrue_b8(), input, 0);
    if (svptest_any(svptrue_b8(), matches)) {
      svbool_t before_nuls = svbrkb_z(svptrue_b8(), matches);
      return len + svcntp_b8(before_nuls, before_nuls);
    }
    len += svcntb();
  }
}
```


Benchmarking against your system&rsquo;s strlen function is difficult methodologically. Nevertheless, we can measure the number of instructions retired for sizeable strings as an indication of the relative speed. Using GCC 11 on a graviton 3 system (Amazon), I get the following metrics for sizeable inputs:

system&rsquo;s strlen    |0.23 instructions per byte |
-------------------------|-------------------------|
SVE                      |0.15 instructions per byte |
SVE (Yaroshevskiy)       |0.15 instructions per byte |


My methodology is not fine enough to distinguish between my SVE approach and Yaroshevskiy&rsquo;s proposal. His proposal is simpler, however.

Though I do not advocate adopting SVE as a replacement for strlen at this time, the potential is interesting, considering that I threw together my implementation in minutes.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/12/19).

__Credit__: Thanks to Denis Yaroshevskiy for inviting me to look at non-faulting loads.

__Update__: It turns out that strlen was one of the examples that ARM used in its slides presenting SVE. At a glance, [their implementation looks like mine](https://www.stonybrook.edu/commcms/ookami/support/_docs/5%20-%20Advanced%20SVE.pdf) but with more sophistication.

