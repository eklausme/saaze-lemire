---
date: "2022-09-30 12:00:00"
title: "A review of elementary data types : numbers and strings"
---



Computer programming starts with the organization of the data into data structures. In almost all cases, we work with strings or numbers. It is critical to understand these building blocks to become an expert programmer.
<h3>Words</h3>

We often organize data using fixed blocks of memory. When these blocks are relatively small (e.g., 8 bits, 16 bits, 32 bits, 64 bits), we commonly call them &lsquo;words&rsquo;.

The notion of &lsquo;word&rsquo; is important because processors do not operate over arbitrary data types. For practical reasons, processors expect data to fit in hardware registers having some fixed size (usually 64-bit registers). Most modern processors accommodate 8-bit, 16-bit, 32-bit and 64-bit words with fast instructions. It is typical to have the granularity of the memory accesses to be no smaller than the &lsquo;byte&rsquo; (8 bits) so bytes are, in a sense, the smallest practical words.

Variable-length data structures like strings might be made of a variable number of words. Historically, strings have been made of lists of bytes, but other alternatives are common (e.g., 16-bit or 32-bit words).
<h3>Boolean values</h3>

The simplest type is probably the Boolean type. A Boolean value can take either the false or the true value. Though a single bit suffices to represent a Boolean value, it is common to use a whole byte (or more).<br/>
We can negate a Boolean value: the true value becomes the false value, and conversely. There are also binary operations:

- The result of the OR operation between two Boolean values is false if and only if both inputs are false. The OR operation is often noted <code>|</code>. E.g., <code>1 | 0 == 1</code> where we use the convention that the symbol <code>==</code> states the equality between two values.
- The result of the AND operation between two Boolean values is true if and only if both inputs are true. The AND operation is often noted <code>&amp;</code>. E.g., <code>1 &amp; 1 == 1</code>.
- The result of the XOR operation is true if and only the two inputs differ in value. The XOR operation is often noted <code>^</code>. E.g., <code>1 ^ 1 == 0</code>.
- The result of the AND NOT operation between two Boolean values is true if and only if the first Boolean value is true and the second one is false.

<h3>Integers</h3>

Integer data types are probably the most widely supported in software and hardware, after the Boolean types. We often represent integers using digits. E.g., the integer 1234 has 4 decimal digits. By extension, we use &lsquo;binary&rsquo; digits, called bits, within computers. We often write an integer using the binary notation using the <code>0b</code> prefix. E.g., the integer <code>0b10</code> is two, the integer <code>0b10110</code> is equal to <code>2^1+2^2+2^4</code> or 22. After the prefix <code>0b</code>, we enumerate the bit values, starting with the most significant bit. We may also use the hexadecimal (base 16) notation with the <code>0x</code> prefix: in that case, we use 16 different digits in the list <code>0, 1, 2, 3,..., 9, A, B, C, D, E, F</code>. These digits have values <code>0, 1, 2, 3,..., 9, 10, 11, 12, 13, 14, 15</code>. For digits represented as letters, we may use either the lower or upper cases. Thus the number <code>0x5A</code> is equal to <code>5 * 16 + 10</code> or 90 in decimal. The hexadecimal notation is convenient when working with binary values: a single digit represents a 4-bit value, two digits represent an 8-bit value, and so forth.

We might count the number of digits of an integer using the formula <code>ceil(log(x+1))</code> where the logarithm is the in the base you are interested in (e.g., base 2) and where <code>ceil</code> is the _ceiling_ function: <code>ceil(x)</code> returns the smallest integer no smaller than <code>x</code>. The product between an integer having <code>d1</code> digits and an integer having <code>d2</code> digits has either <code>d1+d2-1</code> digits or <code>d1+d2</code> digits. To illustrate, let us consider the product between two integers having three digits. In base 10, the smallest product is 100 times 100 is 10,000, so it requires 5 digits. The largest product is 999 times 999 or 998,001 so 6 digits.

For speed or convenience, we might use a fixed number of digits. Given that we work with binary computers, we are likely to use binary digits. We also need a way to represent the sign of a number (negative and positive).
<h3>Unsigned integers</h3>

Possibly the simplest number type is the unsigned integer where we use a fixed number of bits used to represent non-negative integers. Most processors support arithmetic operations over unsigned integers. The term &lsquo;unsigned&rsquo; in this instance is equivalent to &lsquo;non-negative&rsquo;: the integers can be zero or positive.

We can operate on binary integers using bitwise logical operations. For example, the bitwise AND between <code>0b101</code> and <code>0b1100</code> is <code>0b100</code>. The bitwise OR is <code>0b1111</code>. The bitwise XOR (exclusive OR) is <code>0b1001</code>.

The powers of two (1, 2, 4, 8,&hellip;) are the only numbers having a single 1-bit in their binary representation (<code>0b1</code>, <code>0b10</code>, <code>0b100</code>, <code>0b1000</code>, etc.). The numbers preceding powers of two (1,3,7,&hellip;) are the numbers made of consecutive 1-bit in the least significant positions (<code>0b1</code>, <code>0b11</code>, <code>0b111</code>, <code>0b1111</code>, etc.). A unique characteristic of powers of two is that their bitwise AND with the preceding integer is zero: e.g., 4 AND 3 is zero, 8 AND 7 is zero, and so forth.

In the Go programming language, for example, we have 8-bit, 16-bit, 32-bit and 64-bit unsigned integer types: <code>uint8</code>, <code>uint16</code>, <code>uint32</code>, <code>uint64</code>. They can represent all numbers from 0 up to (but not including) 2 to the power of 8, 16, 32 and 64. For example, an 8-bit unsigned integer can represent all integers from 0 up to 255 inclusively.

Because we choose to use a fixed number of bits, we therefore can only represent a range of integers. The result of an arithmetic operation may exceed the range (an <em>overflow</em>). For example, 255 plus 2 is 257: though both inputs (255 and 2) can be represented using 8-bit unsigned integers, the result exceeds the range.

Regarding multiplications, the product of two 8-bit unsigned integers is at most 65025 which can be represented by a 16-bit unsigned integer. It is always the case that the product of two <code>n</code>-bit integers can be represented using <code>2n</code> bits. The converse is untrue: a given <code>2n</code>-bit integer is not the product of two <code>n</code>-bit integers. As <code>n</code> becomes large, only a small fraction of all <code>2n</code>-bit integers can be written as the product of two <code>n</code>-bit integers, a result first proved by Erdős.

Typically, arithmetic operations are &ldquo;modulo&rdquo; the power of two. That is, everything is as if we did the computation using infinite-precision integers and then we only kept the (positive) remainder of the division by the power of two.

Let us elaborate. Given two integers <code>a</code> and <code>b</code> (<code>b</code> being non-zero), there are unique integers <code>d</code> and <code>r</code> where <code>r</code> is in <code>[0,b)</code> such that <code>a = d * b + r</code>. The integer <code>r</code> is the remainder and the integer <code>d</code> is the quotient.

Euclid&rsquo;s division lemma tells us that the quotient and the remainder exist and are unique. We can check uniqueness. Suppose that there is another such pair of integers (<code>d'</code> and <code>r'</code>), <code>a = d' * b + r'</code>. We can check that if <code>d'</code> is equal to <code>d</code>, then we must have that <code>r'</code> is equal to <code>r</code>, and conversely, if <code>r'</code> is equal to <code>r</code>, then <code>d'</code> is equal to <code>d</code>. Suppose that <code>r'</code> is greater than <code>r</code> (if not, just reverse the argument). Then, by subtraction, we have that <code>0 = (d'-d)*b + (r'-r)</code>. We must have that <code>r'-r</code> is in <code>[0,b)</code>. If <code>d'-d</code> is negative, then we have that <code>(d-d')*b = (r'-r)</code>, but that is impossible because <code>r'-r</code> is in <code>[0,b)</code> whereas <code>(d-d')*b</code> is greater or equal than <code>b</code>. A similar argument works when <code>d'-d</code> is positive.

In our case, the divisor (<code>b</code>) is a power of two. When the numerator (<code>a</code>) is positive, then the remainder amounts to a selection of the least significant bits. For example, the remainder of the division of 65 (or <code>0b1000001</code>) with 64 is 1.

When considering unsigned arithmetic, it often helps to think that we keep only the least significant bits (8, 16, 32 or 64) of the final result. Thus if we take 255 and we add 2, we get 257, but as an 8-bit unsigned integer, we get the number 1. Thus, using integers of the type <code>uint8</code>, we have that <code>255 + 2</code> is 1 (<code>255 + 2 == 1</code>). The power of two itself is zero: 256 is equal to zero as an <code>uint8</code> integer. If we subtract two numbers and the value would be negative, we effectively &lsquo;wrap&rsquo; around: 10 &#8211; 20 in <code>uint8</code> arithmetic is the positive remainder of (-10) divided by 256 which is 246. Another way to think of negative numbers is that we can add the power of two (say 256) as many times as needed (size its value is effectively zero) until we get a value that is between 0 and the power of two. Thus if we must evaluate <code>1-5*250</code> as an 8-bit integer, we take the result (-1249) and we add 256 as many times as needed: we have that <code>-1249+5*256</code> is 31, a number between 0 and 256. Thus <code>1-5*250</code> is 31 as an unsigned 8-bit number.

We have that <code>0-1</code>, as an 8-bit number, is 255 or <code>0b11111111</code>. <code>0-2</code> is 254, <code>0-3</code> is 253 and so forth.￼ Consider the set of integers&hellip;
```C
<code>-1024, -1023,..., -513, -512, -511, ..., -1, 0, 1, ..., 255, 256, 257,... 
</code>```


As 256-bit integers, they are mapped to<br/>
<code><br/>
0, 255, ..., 255, 0, 1, ..., 255, 0, 1, ..., 255, 0, 1, ...<br/>
</code>

Multiplication by a power of two is equivalent to shifting the bits left, possibly losing the leftmost bits. For example, 17 is <code>0b10001</code>. Multiplying it by 4, we get <code>0b1000100</code> or 68. If we were to multiply 17 by 4, we would get <code>0b100010000</code> or, as an 8-bit integer, <code>0b10000</code>. That is, as 8-bit unsigned integers, we have that <code>17 * 16</code> is 16. Thus we have that <code>17 * 16 == 1 * 16</code>.

The product of two non-zero integers may be zero. For example, <code>16*16</code> is zero as an 8-bit integer. It happens only when both integers are divisible by two. The product of two odd integers must always be odd.

We say that two numbers are &lsquo;coprime&rsquo; if their largest common divisor is 1. Odd integers are coprime with powers of two. Even integers are never coprime with a power of two.

When multiplying a non-zero integer by an odd integer using finite-bit arithmetic, we never get zero. Thus, for example, <code>3 * x</code> as an 8-bit integer is zero if and only if <code>x</code> is zero when using fixed-bit unsigned integers. It means that <code>3 * x</code> is equal to <code>3 * y</code> if and only if <code>x</code> and <code>y</code> are equal. Thus we have that the following Go code will print out all values from 0 to 255, without repetition:
```C
<code>    for i:=uint8(1); i != 0; i++ {
        fmt.Println(3*i)       
    }
</code>```


Multiplying integers by an odd integer permutes them.

If you consider powers of an odd integer, you similarly never get a zero result. However, you may eventually get the power to be one. For example, as an 8-bit unsigned integer, 3 to the power of 64 is 1. This number (64) is sometimes called the &lsquo;order&rsquo; of 3. Since this is the smallest exponent so that the result is one, we have that all 63 preceding powers give distinct results. We can show this result as follows. Suppose that 3 raised to the <code>p</code> is equal to 3 raised to the power <code>q</code>, and assume without loss of generality that <code>p&gt;q</code>, then we have that <code>3</code> to the power of <code>p-q</code> must be 1, by inspection. And if both <code>p</code> and <code>q</code> are smaller than 64, then so must b <code>p-q</code>, a contradiction. Further, we can check that the powers of an odd integer repeat after the order is reached: we have that 3 to the power 64 is 1, 3 to the power of 65 is 3, 3 to the power of 66 is 9, and so forth. It follows that the order of any odd integer must divide the power of two (e.g., 256).

How large can the order of an odd integer be? We can check that all powers of an odd integer must be odd integers and there are only 128 distinct 8-bit integers. Thus the order of an 8-bit odd integer can be at most 128. Conversely, Euler&rsquo;s theorem tells us that any odd integer to the power of the number of odd integers (e.g., 3 to the power 128) must be one. Because the values of the power of an odd integer repeat cyclicly after the order is reached, we have that the order of any odd integer must divide 128 for 8-bit unsigned integers. Generally, irrespective of the width in bits of the words, the order of an odd integer must be a power of two.

Given two non-zero unsigned integers, <code>a</code> and <code>b</code>, we would expect that <code>a+b&gt;max(a+b)</code> but it is only true if there is no overflow. When and only when there is an overflow, we have that <code>a+b&lt;min(a+b)</code> using finite-bit unsigned arithmetic. We can check for an overflow with either conditions: <code>a+b&lt;a</code> and <code>a+b&lt;b</code>.

Typically, one of the most expensive operations a computer can do with two integers is to divide them. A division can require several times more cycles than a multiplication, and a multiplication is in turn often many times more expensive than a simple addition or subtraction. However, the division by a power of two and the multiplication by a power of two are inexpensive: we can compute the integer quotient of the division of an unsigned integer by shifting the bits <em>right</em>. For example, the integer 7 (0b111) divided by 2 is 0b011 or 3. We can further divide 7 (0b111) by 4 to get 0b001 or 1. The integer remainder is given by selecting the bits that would be shifted out: the remainder of 7 divided by 4 is 7 AND 0b11 or 0b11. The remainder of the division by two is just the least significant bit. Even integers are characterized by having zero as the least significant bit. Similarly, the multiplication by a power of two is just a left shift: the integer 7 (0b111) multiplied by two is 14 (0b1110). More generally, an optimizing compiler may produce efficient code for the computation of the remainder and quotient when the divisor is fixed. Typically, [it involves at least a multiplication and a shift](https://arxiv.org/abs/1902.01961).

Given an integer <code>x</code>, we say that <code>y</code> is its multiplicative inverse if <code>x * y == 1</code>. We have that every odd integer has a multiplicative inverse because multiplication by an integer creates a permutation of all integers. We can compute this multiplicative inverse using Newton&rsquo;s method. That is, we start with a guess and from the guess, we get a better one, and so forth, until we naturally converge to the right value. So we need some formula <code>f(y)</code>, so that we can repeatedly call <code>y = f(y)</code> until <code>y</code> converges. A useful recurrence formula is <code>f(y) = y * (2 - y * x)</code>. You can verify that if <code>y</code> is the multiplicative inverse of <code>x</code>, then <code>f(y) = y</code>. Suppose that <code>y</code> is not quite the inverse, suppose that <code>x * y = 1 + z * p</code> for some odd integer <code>z</code> and some power of two <code>p</code>. If the power of two is (say) 8, then it tells you that <code>y</code> is the multiplicative inverse over the first three bits. We get <code>x * f(y) = x * y * (2 - y * x) = 2 + 2 * z * p - (1 - 2 * z * p + z * z * p * p) = 1 - z * z * p * p</code>. We can see from this result that if <code>y</code> is the multiplicative inverse over the first <code>n</code> bits, then f(y) is the multiplicative inverse over <code>2n</code> bits. That is, if <code>y</code> is the inverse &ldquo;for the first <code>n</code> bits&rdquo;, then <code>f(y)</code> is the inverse &ldquo;for the first <code>2n</code> bits&rdquo;. We double the precision each time we call the recurrence formula. It means that we can quickly converge on the inverse.

What should our initial guess for <code>y</code> be? If we use 3-bit words, then every number is its inverse. So starting with <code>y = x</code> would give us three bits of accuracy, but we can do better: <code>( 3 * x ) ^ 2</code> provides 5 bits of accuracy. The following Go program verifies the claim:
```C
<code>package main

import "fmt"

func main() {
    for x := 1; x < 32; x += 2 {
        y := (3 * x) ^ 2
        if (x*y)&0b11111 != 1 {
            fmt.Println("error")
        }
    }
    fmt.Println("Done")
}
</code>```


Observe how we capture the 5 least significant bits using the expression <code>&amp;0b11111</code>: it is a bitwise logical AND operation.

Starting from 5 bits, the first call to the recurrence formula gives 10 bits, then 20 bits for the second call, then 40 bits, then 80 bits. So, we need to call our recurrence formula 2 times for 16-bit values, 3 times for 32-bit values and 4 times for 64-bit values. The function <code>FindInverse64</code> computes the 64-bit multiplicative inverse of an odd integer:
```C
<code>func f64(x, y uint64) uint64 {
    return y * (2 - y*x)
}

func FindInverse64(x uint64) uint64 {
    y := (3 * x) ^ 2 // 5 bits
    y = f64(x, y)    // 10 bits
    y = f64(x, y)    // 20 bits
    y = f64(x, y)    // 40 bits
    y = f64(x, y)    // 80 bits
    return y
}
</code>```


We have that <code>FindInverse64(271) * 271 == 1</code>. Importantly, it fails if the provided integer is even.

We can use multiplicative inverses to replace the division by an odd integer with a multiplication. That is, if you precompute <code>FindInverse64(3)</code>, then you can compute the division by three for any multiple of three by computing the product: e.g., <code>FindInverse64(3) * 15 == 5</code>.

When we store multi-byte values such as unsigned integers in arrays of bytes, we may use one of two conventions: little- and big-endian. The little- and big-endian variants only differ by the byte order: we either start with the least significant bytes (little endian) or by the most significant bytes (big endian). Let us consider the integer 12345. An an hexadecimal value, it is 0x3039. If we store it as two bytes, we may either store it as the byte value 0x30 followed by the byte value 0x39 (big endian), or by the reverse (0x39 followed by 0x30). Most modern systems default on the little-endian convention, and there are relatively few big-endian systems. In practice, we rarely have to be concerned with the endianness of our system.
<h3>Signed integers and two&rsquo;s complement</h3>

Given unsigned integers, how do we add support for signed integers? At first glance, it is tempting to reserve a bit for the sign. Thus if we have 32 bits, we might use one bit to indicate whether the value is positive or negative, and then we can use 31 bits to store the absolute value of the integer.

Though this sign-bit approach is workable, it has downsides. The first obvious downside is that there are two possible zero values: <code>+0</code> and <code>-0</code>. The other downside is that it makes signed integers wholly distinct values as compared to unsigned integers: ideally, we would like hardware instructions that operate on unsigned integers to &lsquo;just work&rsquo; on signed integers.

Thus modern computers use two&rsquo;s complement notation to represent signed integers. To simplify the exposition, we consider 8-bit integers. We represent all positive integers up to half the range (127 for 8-bit words) in the same manner, whether using signed or unsigned integers. Only when the most significant bit is set, do we differ: for the signed integers, it is as if the unsigned value derived from all but the most significant bit is subtracted by half the range (128). For example, as an 8-bit signed value, 0b11111111 is -1. Indeed, ignoring the most significant bit, we have 0b1111111 or 127, and subtracting 128, we get -1.

<colgroup>
<col/>
<col/>
<col/> </colgroup>
<thead>
Binary                   |unsigned                 |signed                   |
-------------------------|-------------------------|-------------------------|
</thead>
0b00000000               |0                        |0                        |
0b00000001               |1                        |1                        |
0b00000010               |2                        |2                        |
0b01111111               |127                      |127                      |
0b10000000               |128                      |-128                     |
0b10000001               |129                      |-127                     |
0b11111110               |254                      |-2                       |
0b11111111               |255                      |-1                       |


In Go, you can &lsquo;cast&rsquo; unsigned integers to signed integers, and vice versa: Go leaves the binary values unchanged, but it simply reinterprets the value as unsigned and signed integers. If we execute the following code, we have that <code>x==z</code>:
```C
<code>    x := uint16(52429)
    y := int16(x)
    z := uint16(y)
</code>```


Conveniently, whether we compute the multiplication, the addition or the subtraction between two values, the result is the same (in binary) whether we interpret the bits as a signed or unsigned value. Thus we can use the same hardware circuits.

A downside of the two&rsquo;s complement notation is that the smallest negative value (-128 in the 8-bit case) cannot be safely negated. Indeed, the number 128 cannot be represented using 8-bit signed integers. This asymmetry is unavoidable because we have three types of numbers: zero, negative values and positive values. Yet we have an even number of binary values.

Like with unsigned integers, we can shift (right and left) signed integers. The left shift works like for unsigned integers at the bit level. We have that<br/>
<code><br/>
x := int8(1)<br/>
(x &lt;&lt; 1) == 2<br/>
(x &lt;&lt; 7) == -128<br/>
</code><br/>
However, right shift works differently for signed and unsigned integers. For unsigned integers, we shift in zeroes from the left; for signed integers, we either shift in zeroes (if the integer is positive or zero) or ones (if the integer and negatives). We illustrate this behaviour with an example:
```C
<code>    x := int8(-1)
    (x >> 1) == -1
    y := uint8(x)
    y == 255
    (y >> 1) == 127
</code>```


When a signed integer is positive, then dividing by a power of two or shifting right has the same result (<code>10/4 == (10&gt;&gt;2)</code>). However, when the integer is negative, it is only true when the negative integer is divisible by the power of two. When the negative integer is not divisible by the power of two, then the shift is smaller by one than the division, as illustrated by the following code:
```C
<code>    x := int8(-10)
    (x / 4) == -2
    (x >> 2) == -3
</code>```

<h3>Floating-point numbers</h3>

On computers, real numbers are typically approximated by binary floating-point numbers: a fixed-width integer <code>m</code> (the <em>significand</em>) multiplied by 2 raised to an integer exponent <code>p</code>: <code>m * 2**p</code> where <code>2**p</code> represents the number two raised to the power <code>p</code>. A signed bit is added so that both a positive and negative zero are available. Most systems today follow the IEEE 754 standard which means that you can get consistent results across programming languages and operating systems. Hence, it does not matter very much if you implement your software in C++ under Linux whereas someone else implements it in C# under Windows: if you both have recent systems, you can expect identical numerical outcomes when doing basic arithmetic and square-root operations.

A positive _normal_ double-precision floating-point number is a binary floating-point number where the 53-bit integer <code>m</code> is in the interval <code>[2**52,2**53)</code> while being interpreted as a number in <code>[1,2)</code> by virtually dividing it by <code>2**52</code>, and where the 11-bit exponent <code>p</code> ranges from <code>-1022</code> to <code>+1023</code>. Thus we can represent all values between <code>2**-1022</code> and up to but not including <code>2**1024</code>. Some values smaller than <code>2**-1022</code> can be represented as _subnormal_ values: they use a special exponent code which has the value <code>2**-1022</code> and the significand is then interpreted as a value in the interval <code>[0,1)</code>.

In Go, a <code>float64</code> number can represent all decimal numbers made of a 15-digit significand from approximately <code>-1.8 * 10**308</code> to <code>1.8 *10**308</code>. The reverse is not true: it is not sufficient to have 15 digits of precision to distinguish any two floating-point numbers: we may need up to 17 digits.

The <code>float32</code> type is similar. It can represent all numbers between <code>2**-126</code> up to, but not including, <code>2**128</code>; with special handling for some numbers smaller than <code>2**-126</code> (subnormals). The <code>float32</code> type can represent exactly all decimal numbers made of a 6-digit decimal significand but 9 digits are needed in general to identify uniquely a number.

Floating-point numbers also include the positive and negative infinity, as well as a special not-a-number value. They are identified by a reserved exponent value.

Numbers are typically serialized as decimal numbers in strings and then parsed back by the receiver. However, it is generally impossible to convert decimal numbers into binary floating-point numbers: the number <code>0.2</code> has no exact representation as a binary floating-point number. However, you should expect the system to choose the best possible approximation: <code>7205759403792794 * 2**-55</code> as a <code>float64</code> number (or about <code>0.20000000000000001110</code>). If the initial number was a <code>float64</code> (for example), you should expect the exact value to be preserved: it will work as expected in Go.
<h3>Strings</h3>

One of the earliest string standards is ASCII: it was first specified in the early 1960s. The ASCII standard is still popular. Each character is a byte, with the most significant bit set to zero. There are therefore only 128 distinct ASCII characters. It is often sufficient for simple tasks like programming. Unfortunately, the ASCII standard could only ever represent up to 128 characters: far less than needed.

Many diverging standards emerged for representing characters in software. The existence of multiple incompatible formats made the production of interoperable localized software challenging.

Engineers developed Unicode in the late 1980s as an attempt to provide a universal standard. Initially, it was believed that using 16 bits per character would be sufficient, but this belief was wrong. The Unicode standard was extended to include up to 1,114,112 characters. Only a small fraction of all possible characters have been assigned, but more are assigned over time with each Unicode revision. The Unicode standard is an extension of the ASCII standard: the first 128 Unicode characters match the ASCII characters.

Due to the original expectation that Unicode would fit in 16-bit space, a format based on 16-bit words (UTF-16) format was published in 1996. It may use either 16-bit or 32-bit per character. The UTF-16 format was adopted by programming languages such as Java, and became a default under Windows. Unfortunately, UTF-16 is not backward compatible with ASCII at a byte level. An ASCII-compatible format was proposed and formalized in 2003: UTF-8. Over time, UTF-8 became widely used for text interchange formats such as JSON, HTML or XML. Programming languages such as Go, Rust and Swift use UTF-8 by default. Both formats (UTF-8 and UTF-16) require validation: not all arrays of bytes are valid. The UTF-8 format is more expensive to validate.

ASCII characters require one byte with UTF-8 and two bytes with UTF-16. The UTF-16 format can represent all characters, except for the supplemental characters such as emojis, using two bytes. The UTF-8 format uses two bytes for Latin, Hebrew and Arabic alphabets, three bytes for Asiatic characters and 4 bytes for the supplemental characters.

UTF-8 encodes values in sequences of one to four bytes. We refer to the first byte of a sequence as a leading byte; the most significant bits of the leading byte indicates the length of the sequence:

- If the most significant bit is zero, we have a sequence of one byte (ASCII).
- If the three most significant bits are 0b110, we have a two-byte sequence.
- If the four most significant bits are 0b1110, we have a three-byte sequence.
- Finally, if the five most significant bits are 0b11110, we have a four-byte sequence.<br/>
All bytes following the leading byte in a sequence are continuation bytes, and they must have 0b10 as their most significant bits. Except for the required most significant bits, the numerical value of the character (between 0 to 1,114,112) is stored by starting with the most significant bits (in the leading byte) followed by the less significant bits in the other continuation bytes.


In the UTF-16 format, characters in 0x0000-0xD7FF and 0xE000-0xFFFF are stored as single 16-bit words. Characters in the range 0x010000 to 0x10FFFF require two 16-bit words called a surrogate pair. The first word in the pair is in the range 0xd800 to 0xdbff whereas the second word is in the range from 0xdc00 to 0xdfff. The character value is made of the 10 least significant bits of the two words, using the second word as least significant, and adding 0x10000 to the result. There are two types of UTF-16 format. In the little-endian variant, each 16-bit word is stored using the least significant bits in the first byte. The reverse is true in the big-endian variant.

When using ASCII, it is relatively easy to access the characters in random order. For UTF-16, it is possible if we assume that there are no supplemental characters, but since some characters might require 4 bytes while other 2 bytes, it is not possible to go directly to a character by its index without accessing the previous content. The UTF-8 is similarly not randomly accessible in general.

Software often depends on the chosen locale: e.g., US English, French Canadian, and so forth. Sorting strings is locale-dependent. It is not generally possible to sort strings without knowing the locale. However, it is possible to sort strings lexicographically as byte sequences (UTF-8) or as 16-bit word sequences (UTF-16). When using UTF-8, the result is then a string sort based on the characters&rsquo; numerical value.

