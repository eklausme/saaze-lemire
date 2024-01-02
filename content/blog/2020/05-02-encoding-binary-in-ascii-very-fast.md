---
date: "2020-05-02 12:00:00"
title: "Encoding binary in ASCII very fast"
---



In software, we typically work with binary values. That is, we have arbitrary streams of bytes. To encode these arbitrary stream of bytes in standard formats like email, HTML, XML, JSON, we often need to convert them to a standard format like base64. [You can encode and decode base64 very quickly](https://arxiv.org/abs/1910.05109).

But what if you do not care for standards and just want to go fast and have simple code? Maybe all you care about is that the string is ASCII. That is, it must be a stream of bytes with the most significant bit of each byte set to zero. In such a case, you want to convert any 7-byte value  into an 8-byte value, and back.

I can do it in about five instructions (not counting stores and moves) both ways in standard C: five instructions to encode, and five instructions to decode. It is less than one instruction per byte. I could not convince myself that my solution is optimal.
```C
// converts any value in [0, 2**56) into a value that
// could pass as ASCII (every 8th bit is zero)
// can be inverted with convert_from_ascii
uint64_t convert_to_ascii(uint64_t x) {
  return ((0x2040810204081 * (x & 0x80808080808080)) 
         & 0xff00000000000000) +
         (x & 0x7f7f7f7f7f7f7f);
}
// converts any 8 ASCII chars into an integer in [0, 2**56),
// this inverts convert_to_ascii
uint64_t convert_from_ascii(uint64_t x) {
  return ((0x102040810204080 * (x >> 56)) 
         & 0x8080808080808080) +
         (x & 0xffffffffffffff);
}
```


Under recent Intel processors, the pdep/pext instructions may serve the same purpose. However, they are slow under AMD processors and there is no counterpart under ARM.

