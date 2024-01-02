---
date: "2021-06-03 12:00:00"
title: "Computing the number of digits of an integer even faster"
---



I my [previous blog post](/lemire/blog/2021/05/28/computing-the-number-of-digits-of-an-integer-quickly/), I documented how one might proceed to compute the number of digits of an integer quickly. E.g., given the integer 999, you want 3 but given the integer 1000, you want 4. It is effectively the integer logarithm in base 10.

On computers, you can quickly compute the integer logarithm in base 2, and it follows that you can move from one to the other rather quickly. You just need a correction which you can implement with a table. A very good solution found in references such as Hacker&rsquo;s Delight is as follows:
```C
    static uint32_t table[] = {9, 99, 999, 9999, 99999,
    999999, 9999999, 99999999, 999999999};
    int y = (9 * int_log2(x)) >> 5;
    y += x > table[y];
    return y + 1;
```


Except for the computation of the integer logarithm, it involves a multiplication by 9, a shift, a conditional move, a table lookup and an increment. Can you do even better? You might! Kendall Willets found an even more economical solution.
```C
int fast_digit_count(uint32_t x) {
  static uint64_t table[] = {
      4294967296,  8589934582,  8589934582,  8589934582,  12884901788,
      12884901788, 12884901788, 17179868184, 17179868184, 17179868184,
      21474826480, 21474826480, 21474826480, 21474826480, 25769703776,
      25769703776, 25769703776, 30063771072, 30063771072, 30063771072,
      34349738368, 34349738368, 34349738368, 34349738368, 38554705664,
      38554705664, 38554705664, 41949672960, 41949672960, 41949672960,
      42949672960, 42949672960};
  return (x + table[int_log2(x)]) >> 32;
}
```


If I omit the computation of the integer logarithm in base 2, it requires just a table lookup, an addition and a shift:
```C
add     rax, qword ptr [8*rcx + table]
shr     rax, 32
```


The table contains the numbers ceil(log10(2<sup>j</sup>)) * 2<sup>32</sup> + 2<sup>32</sup> &#8211; 10<sup>ceil(log10(2<sup>j</sup>))</sup> for j from 2 to 30, and then just ceil(log10(2<sup>j</sup>)) for j = 31 and j = 32. The first value is 2<sup>32</sup> .

[My implementation of Kendall&rsquo;s solution is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/06/03).

[Using modern C++, you can compute the table using constant expressions](https://godbolt.org/#z:OYLghAFBqd5QCxAYwPYBMCmBRdBLAF1QCcAaPECAM1QDsCBlZAQwBtMQBGAFlJvoCqAZ0wAFAB4gA5AAYppAFZdSrZrVDIApACYAQjt2kR7ZATx1KmWugDCqVgFcAtrRDbSV9ABk8tTADlnACNMYhAAZnDSAAdUIUJzWjtHFzcYuIS6Hz9ApxCwyKNMEzM6BgJmYgJk51d3Y0xTRPLKgmyA4NCIqKEKqprU%2Br623w68rsiASiNUB2JkDikdcN9kRywAak1wm0riZgBPbexNGQBBZdX1zC2d5F78emPTs4B6V8vaNYdN7ZsqJwEV77dSYIQAOgQz3OL1ozCcYOizAWG2Q0Wi2nCWwA7PpzhsCai6L1MOJosQNg8QCAHL4CAA2bgAfQIG1YqGA2ggVJpdMZLI24kmOLxZ0J4o2xEwBDmtA2TKZQVprDMtCZ7M5ECF21F4s02IAIi9xWhaCSyRTmA4iGyOZwZNyCOhqbT6PzWUKRcaJQSpTLiHL2eoIAqlXgVb4mQtwyHFcrVeq7Q6hZNJjrvQT9Ub8YTTebyZSnS6%2BczWbEAO6O528t2lwWkQvV10MuuYYX63U%2ByXS2XyuPhhMVrUNtvpnOZw0vLNT850jb4YCEKOzegQZvhbQCz0djOF5hmZBEs0EUkFnl7Q5/HnN90NjfHDYVILsW4GrYAVn074NEHbuN34rnsQ%2BxHDs14lgKd7aA%2BT7sGOYpdjQFJrmaeDAH46C2uoGx4K%2BGycDqOG3DYGyRIReAGAYf6dl2BJ5qyDioehmCYUIThsOwvR4WiGLhNSQ7uDhAC0nBpuENG0bBmCaJ%2BeAiTJb7bG%2BGwQLhfykZwtwAGIqTxmL8aglaCRuwpCai6L6SAQ72g2el8SAGr2ty7GsJxBCpsKIAbDIGztuOtESgYukWfZjkOmxHFgu5xHqSZ8G0dO/nin6vZSfFhJZr%2B6UEu8AIEPxxB0hAOjQf%2Bk7aIJUliRJKUBip4hbHoj7MM%2B0mfuEmlmaG8aRmsABeWo4iRokKe24QnONpHQeJU6TjCs70Bs7G%2BL%2BXr%2BbVcoLkuaCMQQECcJi3DvtVs0GlI0ysNI77yK4sjyKg0g2JRTVCLM8w3MsnDyPld2pqQADWEQABzgu%2BB3YtoMicO%2B9LvnD2LYio0jcPITggDD4KYtikScED2gAJwyBDQO8LdcikA9UjyEIIAyKQP1yNMcCwDAiAoKgTjROGoTkJQaCc9zYTAEIcLREICCoAQfADqENMQEE0jk0EviVAc0hfaQ/MIvQADytCsGrd2kFg7HqOwivyPgUpNAAbmCFseOIjTWos5N0sUDusHgQT7MQBx2FgDsEIVaNSF90z8IwLDmzwfB0AQwhiJIRtKJwKhqBoz2GF7QQ07AcIIiAeWkHbYTB4x/1/ag0SlGa0hCQ8SlaHoBiQxsQk6%2BE1PFI0teWNYAyuGnnjtLk%2BTKLE8S14PE8ZLXo%2BdGEacNE0ZTDDPy896vtAtFUC/jEvRjr/YtTKL0rT7%2BPokzHMCxcBdV03Q7lPiED9JCYyGzAMgh4QOXtCVxUrgQgJBGodQbHYAW7AKSfWFE9FuehvoWz%2BggTAzAsBhF/ADdGdNLpSBRqQNG746Zk3utIamtN6bINIMzNmswCDRGtLzCA/MubQOUCxEBh9I5MDYBwWOkdE4SAduWfY0R1bnSRlIa6pBSEU2kJ9DY5ZCAIEFG/D%2B3Av4/xUv/SuSDfrTFQegroWC8EEKISQ5%2B5CjCUIZudaYgN6ScHBNwIGENsT4xJuEbgPiKpSK7rIqxVMqEGKkdoVGXAZAyHBFE2JcS4lpzkZTfRjNpil3iBYbgQA%3D%3D%3D).

__Further reading__: [Josh Bleecher Snyder has a blog post on this topic which tells the whole story](https://commaok.xyz/post/lookup_tables/).

