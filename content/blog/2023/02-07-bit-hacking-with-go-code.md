---
date: "2023-02-07 12:00:00"
title: "Bit Hacking (with Go code)"
---



At a fundamental level, a programmer needs to manipulate bits. Modern processors operate over data by loading in &lsquo;registers&rsquo; and not individual bits. Thus a programmer must know how to manipulate the bits within a register. Generally, we can do so while programming with 8-bit, 16-bit, 32-bit and 64-bit integers. For example, suppose that I want to set an individual bit to value 1. Let us pick the bit an index 12 in a 64-bit words. The word with just the bit at index 12 set is <code>1&lt;&lt;12</code> : the number 1 shifted to the left 12 times, or 4096. In Go, we format numbers using the <code>fmt.Printf</code> function: we use a string with formatting instructions followed by the values we want to print. We begin a formatting sequence with the letter <code>%</code> which has a special meaning (if one wants to print <code>%</code>, one most use the string <code>%%</code>). It can be followed by the letter <code>b</code> which stands for binary, the letter <code>d</code> (for decimal) or <code>x</code> (for hexadecimal). Sometimes we want to specify the minimal length (in characters) of the output, and we do so by a leading number: e.g, <code>fmt.Printf("%100d", 4096)</code> prints a 100-character string that ends with 4096 and begins with spaces. We can specify zero as a padding character rather than the space by adding it as a prefix (e.g., <code>"%0100d"</code>). In Go, we may print thus the individual bits in a word as in the following example:
```Go
package main

import "fmt"

func main() {
    var x uint64 = 1 << 12
    fmt.Printf("%064b", x)
}
```


Running this program we get a binary string representing <code>1&lt;&lt;12</code>:
```Go
0000000000000000000000000000000000000000000000000001000000000000
```


The general convention when printing numbers is that the most significant digits are printed first followed by the least significant digits: e.g., we write 1234 when we mean <code>1000 + 200 + 30 + 4</code>. Similarly, Go prints the most significant bits first, and so the number <code>1&lt;&lt;12</code> has <code>64-13=51</code> leading zeros followed by a <code>1</code> with 12 trailing zeros.

We might find it interesting to revisit how Go represents negative integers. Let us take the 64-bit integer <code>-2</code>. Using two&rsquo;s complement notation, the number should be represented as the unsigned number <code>(1&lt;&lt;64)-2</code> which should be a word made entirely one ones, except for the second last bit. We can use the fact that a _cast_ operation in Go (e.g., <code>uint64(x)</code>) preserves the binary representation:
```Go
package main

import "fmt"

func main() {
    var x int64 = -2
    fmt.Printf("%064b", uint64(x))
}
```


This program will print <code>1111111111111111111111111111111111111111111111111111111111111110</code> as expected.

Go has some relevant binary operators that we often use to manipulate bits:
```Go
&    bitwise AND
|    bitwise OR
^    bitwise XOR
&^   bitwise AND NOT
```


Furthermore, the symbol <code>^</code> is also used to flip all bits a word when used as an unary operation: <code>a ^ b</code> computes the bitwise XOR of <code>a</code> and <code>b</code> whereas <code>^a</code> flips all bits of <code>a</code>. We can verify that we have <code>a|b == (a^b) | (a&amp;b) == (a^b) + (a&amp;b)</code>.

We have other useful identities. For example, given two integers <code>a</code> and <code>b</code>, we have that <code>a+b = (a^b) + 2*(a&amp;b)</code>. In the identity <code>2*(a&amp;b)</code> represents the carries whereas <code>a^b</code> represents the addition without the carries. Consider for example <code>0b1001 + 0b01001</code>. We have that <code>0b1 + 0b1 == 0b10</code> and this is the <code>2*(a&amp;b)</code> component, whereas <code>0b1000 + 0b01000 == 0b11000</code> is captured by <code>a^b</code>. We have that <code>2*(a|b) = 2*(a&amp;b) + 2*(a^b)</code>, thus <code>a+b = (a^b) + 2*(a&amp;b)</code> becomes <code>a+b = 2*(a|b) - (a^b)</code>. These relationships are valid whether we consider unsigned or signed integers, since the operations (bitwise logical, addition and subtraction) are identical at the bits level.
<h3>Setting, clearing and flipping bits</h3>

We know how to create a 64-bit word with just one bit set to 1 (e.g., <code>1&lt;&lt;12</code>). Conversely, we can also create a word that is made of 1s except for a 0 at bit index 12 by flipping all bits: <code>^uint64(1&lt;&lt;12)</code>. Before flipping all bits of an expression, it is sometimes useful to specify its type (taking <code>uint64</code> or <code>uint32</code>) so that the result is unambiguous.

We can then use these words to affect an existing word:

1. If we want to set the 12th bit of word <code>w</code> to one: <code>w |= 1&lt;&lt;12</code>.
1. If we want to clear (set to zero) the 12th bit of word <code>w</code>: <code>w &amp;^= 1&lt;&lt;12</code> (which is equivalent to <code>w = w &amp; ^uint64(1&lt;&lt;12)</code>).
1. If we just want to flip (send zeros to ones and ones to zeros) the 12th bit: <code>w ^= 1&lt;&lt;12</code>.


We may also affect a range of bits. For example, we know that the word <code>(1&lt;&lt;12)-1</code> has all but the 11 least significant bits set to zeros, and the 11 least significant bits set to ones.

1. If we want to set the 11 least significant bits of the word <code>w</code> to ones: <code>w |= (1&lt;&lt;12)-1</code>.
1. If we want to clear (set to zero) the 11 least signficant bits of word <code>w</code>: <code>w &amp;^= (1&lt;&lt;12)-1</code>.
1. If we want to flip the 11 least signficant bits: <code>w ^= (1&lt;&lt;12)-1</code>.<br/>
The expression <code>(1&lt;&lt;12)-1</code> is general in the sense that if we want to select the 60 least significant bits, we might do <code>(1&lt;&lt;60)-1</code>. It even works with 64 bits: <code>(1&lt;&lt;64)-1</code> has all bits set to 1.


We can also generate a word that has an arbitrary range of bits set: the word <code>((1&lt;&lt;13)-1) ^ ((1&lt;&lt;2)-1)</code> has the bits from index 2 to index 12 (inclusively) set to 1, other bits are set to 0. With such a construction, we can set, clear or flip an arbitrary range of bits within a word, efficiently.

We can set any bit we like in a word. But what about querying the bit sets ? We can check the 12th bit is set in the word <code>u</code> by checking whether <code>w &amp; (1&lt;&lt;12)</code> is non-zero. Indeed, the expression <code>w &amp; (1&lt;&lt;12)</code> has value <code>1&lt;&lt;12</code> if the 12th bit is set in <code>w</code> and, otherwise, it has value zero. We can extend such a check: we can verify whether any of the bits from index 2 to index 12 (inclusively) set to 1 by computing <code>w &amp; ((1&lt;&lt;13)-1) ^ ((1&lt;&lt;2)-1)</code>. The result is zero if and only if no bit in the specified range is set to one.
<h3>Efficient and safe operations over integers</h3>

By thinking about values in terms of their bit representation, we can write more efficient code or, equivalent, have a better appreciation for what optimized binary code might look like. Consider the problem of checking if two numbers have the same sign: we want to know whether they are both smaller than zero, or both greater than or equal to zero. A naive implementation might look as follows:
```Go
func SlowSameSign(x, y int64) bool {
return ((x < 0) && (y < 0)) || ((x >= 0) && (y >= 0))
}
```


However, let us think about what distinguishes negative integers from other integers: they have their last bit set. That is, their most significant bit as an unsigned value is one. If we take the exclusive or (xor) of two integers, then the result will have its last bit set to zero if their sign is the same. That is, the result is positive (or zero) if and only if the signs agree. We may therefore prefer the following function to determine if two integers have the same sign:
```Go
func SameSign(x, y int64) bool {
    return (x ^ y) >= 0
}
```


Suppose that we want to check whether <code>x</code> and <code>y</code> differ by at most 1. Maybe <code>x</code> is smaller than <code>y</code>, but it could be larger.

Let us consider the problem of computing the average of two integers. We have the following correct function:
```Go
func Average(x, y uint16) uint16 {
    if y > x {
        return (y-x)/2 + x
    } else {
        return (x-y)/2 + y
    }
}
```


With a better knowledge of the integer representation, we can do better.

We have another relevant identity <code>x == 2*(x&gt;&gt;1) + (x&amp;1)</code>. It means that <code>x/2</code> is within <code>[(x&gt;&gt;1), (x&gt;&gt;1)+1)</code>. That is, <code>x&gt;&gt;1</code> is the greatest integer no larger than <code>x/2</code>. Conversely, we have that <code>(x+(x&amp;1))&gt;&gt;1</code> is the smallest integer no smaller than <code>x/2</code>.

We have that <code>x+y = (x^y) + 2*(x&amp;y)</code>. Hence we have that <code>(x+y)&gt;&gt;1 == ((x^y)&gt;&gt;1) + (x&amp;y)</code> (ignoring overflows in <code>x+y</code>). Hence, <code>((x^y)&gt;&gt;1) + (x&amp;y)</code> is the greatest integer no larger than <code>(x+y)/2</code>. We also have that <code>x+y = 2*(x|y) - (x^y)</code> or <code>x+y + (x^y)&amp;1= 2*(x|y) - (x^y) + (x^y)&amp;1</code> and so <code>(x+y+(x^y)&amp;1)&gt;&gt;1 == (x|y) - ((x^y)&gt;&gt;1)</code> (ignoring overflows in <code>x+y+(x^y)&amp;1</code>). It follows that <code>(x|y) - ((x^y)&gt;&gt;1)</code> is the smallest integer no smaller than <code>(x+y)/2</code>. The difference between <code>(x|y) - ((x^y)&gt;&gt;1)</code> and <code>((x^y)&gt;&gt;1) + (x&amp;y)</code> is <code>(x^y)&amp;1</code>. Hence, we have the following two fast functions:
```Go
func FastAverage1(x, y uint16) uint16 {
    return (x|y) - ((x^y)>>1)
}
```

```Go
func FastAverage2(x, y uint16) uint16 {
    return ((x^y)>>1) + (x&y)
}
```


Though we use the type <code>uint16</code>, it works irrespective of the integer size (<code>uint8</code>, <code>uint16</code>, <code>uint32</code>, <code>uint64</code>) and it also applies to signed integers (<code>int8</code>, <code>int16</code>, <code>int32</code>, <code>int64</code>).
<h3>Efficient Unicode processing</h3>

In UTF-16, we may have surrogate pairs: the first word in the pair is in the range <code>0xd800</code> to <code>0xdbff</code> whereas the second word is in the range from <code>0xdc00</code> to <code>0xdfff</code>. How may we detect efficiency surrogate pairs? If the values are stored using an <code>uint16</code> type, then it would seem that we could detect a value part of a surrogate pair with two comparisons: <code>(x&gt;=0xd800) &amp;&amp; (x&lt;=0xdfff)</code>. However, it may prove more efficient to use the fact that subtractions naturally <em>wrap-around</em>: <code>0-0xd800==0x2800</code>. Thus <code>x-0xd800</code> will range between 0 and <code>0xdfff-0xd800</code> inclusively whenever we have a value that is part of a surrogate pair. However, any other value will be larger than <code>0xdfff-0xd800=0x7fff</code>. Thus, a single comparison is needed : <code>(x-0xd800)&lt;=0x7ff</code>.<br/>
Once we have determined that we have a value that might correspond to a surrogate pair, we may check that the first value <code>x1</code> is valid (in the range <code>0xd800</code> to <code>0xdbff</code>) with the condition <code>(x-0xd800)&lt;=0x3ff</code>, and similarly for the second value <code>x2</code>: <code>(x-0xdc00)&lt;=0x3ff</code>. We may then reconstruct the code point as <code>(1<<20) + ((x-0xd800)&lt;&lt;10) + x-0xdc00</code>. In practice, you may not need to concern yourself with such an optimization since your compiler might do it for you. Nevertheless, it is important to keep in mind that what might seem like multiple comparisons could actually be implemented as a single one.
<h3>Basic SWAR</h3>

Modern processors have specialized instructions capable of operating over multiple units of data with a single instruction (called SIMD for Single Instruction Multiple Data). We can do several operations using a single instruction (or few) instructions with a technique called SWAR (<em>SIMD within a register</em>). Typically, we are given a 64-bit word <code>w</code> (<code>uint64</code>) and we want to treat it as a vector of eight 8-bit words (<code>uint8</code>).

Given a byte value (<code>uint8</code>) I can have it replicated over all bytes of a word with a single multiplication: <code>x * uint64(0x0101010101010101)</code>. For example, we have <code>0x12 * uint64(0x0101010101010101) == 0x1212121212121212</code>. This approach can be generalized in various ways. For example, we have that <code>0x7 * uint64(0x1101011101110101) == 0x7707077707770707</code>.

For convenience, let us define <code>b80</code> to be the <code>uint64</code> equal to <code>0x8080808080808080</code> and <code>b01</code> be the <code>uint64</code> equal to <code>0x0101010101010101</code>. We can check whether all bytes are smaller than 128. We first replicate the byte value with all but the most significant bit set to zero (<code>0x80 * b01</code>) or <code>b80</code>) and then we compute the bitwise AND with our 64-bit word and check whether the result is zero: <code>(w &amp; b80)) == 0</code>. It might compile to a two or three instructions on a processor.

We can check whether any byte is zero, assuming that we have checked that they are smaller than 128, with an expression such as <code>((w - b01) &amp; b80) == 0</code>. If we are not sure that they are smaller than zero, we can simply add an operation: <code>(((w - b01)|w) &amp; b80) == 0</code>. Checking that a byte is zero allows us to check whether two words, <code>w1</code> and <code>w2</code>, have a matching byte value since, when this happens, <code>w1^w2</code> has a zero byte value.

We can also design more complicated operations if we assume that all byte values are no larger than 128. For example, we may check that all byte values are no larger than a 7-bit value (<code>t</code>) by the following routine: <code>((w + (0x80 - t) * b01) &amp; b80) == 0</code>. If the value <code>t</code> is a constant, then the multiplication would be evaluated at compile time and it should be barely more expensive than checking whether all bytes are smaller than 128. In Go, we check that no byte value is larger than 77, assuming that all byte values are smaller than 128 by verifying thaat <code>b80 &amp; (w+(128-77) * b01)</code> is zero. Similarly, we can check that all byte values are at least as large a 7-bit <code>t</code>, assuming that they are also all smaller than 128: <code>((b80 - w) + t * b01) &amp; b80) == 0</code>. We can generalize further. Suppose we want to check that all bytes are at least as large at the 7-bit value <code>a</code> and no larger than the 7-bit value <code>b</code>. It suffices to check that <code>((w + b80 - a * b01) ^ (w + b80 - b * b01)) &amp; b80 == 0</code>.
<h3>Rotating and Reversing Bits</h3>

Given a word, we say that we _rotate_ the bits if we shift left or right the bits, while moving back the leftover bits at the beginning. To illustrate the concept, suppose that we are given the 8-bit integer <code>0b1111000</code> and we want to rotate it left by 3 bits. The Go language provides a function for this purpose (<code>bits.RotateLeft8</code> from the <code>math/bits</code> package): we get <code>0b10000111</code>. In Go, there is no <em>rotate right</em> operation. However, rotating left by 3 bits is the same as rotating right by 5 bits when processing 8-bit integers. Go provide rotation functions for 8-bit, 16-bit, 32-bit and 64-bit integers.

Suppose that you would like to know if two 64-bit words (<code>w1</code> and <code>w2</code>) have matching byte values, irrespective of the ordering. We know how to check that they have matching ordered byte values efficiently (e.g., <code>(((w1^w2 - b01)|(w1^w2)) &amp; b80) == 0</code>. To compare all bytes with all other bytes, we can repeat the same operation as many times as they are bytes in a word (eight times for 64-bit integers): each time, we rotate one of the words by 8 bits:
```Go
(((w1^w2 - b01)|(w1^w2)) & b80) == 0
w1 = bits.RotateLeft64(w1,8)
(((w1^w2 - b01)|(w1^w2)) & b80) == 0
w1 = bits.RotateLeft64(w1,8)
...
```


We recall that words can be interpreted as little-endian or big-endian depending on whether the first bytes are the least significant or the most significant. Go allows you to reverse the order of the bytes in a 64-bit word with the function <code>bits.ReverseBytes64</code> from the <code>math/bits</code> package. There are similar functions for 16-bit and 32-bit words. We have that <code>bits.ReverseBytes16(0xcc00) == 0x00cc</code>. Reversing the bytes in a 16-bit word, and rotating by 8 bits, are equivalent operations.

We can also reverse bits. We have that <code>bits.Reverse16(0b1111001101010101) == 0b1010101011001111</code>. Go has functions to reverse bits for 8-bit, 16-bit, 32-bit and 64-bit words. Many processors have fast instructions to reverse the bit orders, and it can be a fast operation.
<h3>Fast Bit Counting</h3>

It can be useful to count the number of bits set to 1 in a word. Go has fast functions for this purpose in the <code>math/bits</code> package for words having 8 bits, 16 bits, 32 bits and 64 bits. Thus we have that <code>bits.OnesCount16(0b1111001101010101) == 10</code>.

Similarly, we sometimes want to count the number of trailing or leading zeros. The number of trailing zeros is the number of consecutive zero bits appearing in the least significant positions.For example, the word <code>0b1</code> has no trailing zero, whereas the word <code>0b100</code> has two trailing zeros. When the input is a power of two, the number of trailing zeros is the logarithm in base two. We can use the Go functions <code>bits.TrailingZeros8</code>, <code>bits.TrailingZeros16</code><br/>
and so forth to compute the number of trailing zeros. The number of leading zeros is similar, but we start from the most significant positions. Thus the 8-bit integer <code>0b10000000</code> has zero leading zeros,<br/>
while the integer <code>0b00100000</code> has two leading zeros. We can use the functions <code>bits.LeadingZeros8</code>, <code>bits.LeadingZeros16</code><br/>
and so forth.

While the number of trailing zeros gives directly the logarithm of powers of two, we can use the number of leading zeros to compute the logarithm of any integer, rounded up to the nearest integer. For 32-bit integers, the following function provides the correct result:
```Go
func Log2Up(x uint32) int {
    return 31 - bits.LeadingZeros32(x|1)
}
```


We can also compute other logarithms. Intuitively, this ought to be possible because if <code>log_b</code> is the logarithm in base <code>b</code>, then <code>log_b (x) = \log_2(x)/\log_2(b)</code>. In other words, all logarithms are within a constant factor (e.g., <code>1/log_2(b)</code>).

For example, we might be interested in the number of decimal digits necessary to represent an integer (e.g., the integer <code>100</code> requires three digits). The general formula is <code>ceil(log(x+1))</code> where the logarithm should be taken in base 10. We can show that the following function (designed by an engineer called Kendall Willets) computes the desired number of digits for 32-bit integers:
```Go
<code>func DigitCount(x uint32) uint32 {
    var table = []uint64{
        4294967296, 8589934582, 8589934582,
        8589934582, 12884901788, 12884901788,
        12884901788, 17179868184, 17179868184,
        17179868184, 21474826480, 21474826480,
        21474826480, 21474826480, 25769703776,
        25769703776, 25769703776, 30063771072,
        30063771072, 30063771072, 34349738368,
        34349738368, 34349738368, 34349738368,
        38554705664, 38554705664, 38554705664,
        41949672960, 41949672960, 41949672960,
        42949672960, 42949672960}
    return uint32((uint64(x) + table[Log2Up(x)]) >> 32)
}
```


Though the function is a bit mysterious, its computation mostly involves computing the number of trailing zeros, and using the result to lookup a value in a table. It translates in only a few CPU instructions and is efficient.
<h3>Indexing Bits</h3>

Given a word, it is sometimes useful to compute the position of the set bits (bits set to 1). For example, given the word <code>0b11000111</code>, we would like to have the indexes 0, 1, 2, 6, 7 corresponding to the 5 bits with value 1. We can determine efficiently how many indexes we need to produce thanks to the <code>bits.OnesCount</code> functions. The <code>bits.TrailingZeros</code> functions can serve to identify the position of a bit. We may also use the fact that <code>x &amp; (x-1)</code> set to zero the least significant 1-bit of <code>x</code>. The following Go function generates an array of indexes:
```Go
func Indexes(x uint64) []int {
    var ind = make([]int, bits.OnesCount64(x))
    pos := 0
    for x != 0 {
        ind[pos] = bits.TrailingZeros64(x)
        x &= x - 1
        pos += 1
    }
    return ind
}
```


Given <code>0b11000111</code>, it produces the array <code>0, 1, 2, 6, 7</code>:
```Go
var x = uint64(0b11000111)
for _, v := range Indexes(x) {
    fmt.Println(v)
}
```


If we want to compute the bits in reverse order (<code>7, 6, 2, 1, 0</code>), we can do so with a bit-reversal function, like so:
```Go
for _, v := range Indexes(bits.Reverse64(x)) {
    fmt.Println(63 - v)
}
```

<h3>Conclusion</h3>

As a programmer, you may access, set, copy, or move individual bit values efficiently. With some care, you can avoid arithmetic overflows without much of a performance penalty. With SWAR, you can use a single word as if it was made of several subwords. Though most of these operations are only rarely needed, it is important to know that they are available.

