---
date: "2020-07-21 12:00:00"
title: "Avoid character-by-character processing when performance matters"
---



When processing strings, it is tempting to view them as arrays of characters (or bytes) and to process them as such.

Suppose that you would like to determine whether a string is ASCII. In ASCII, every character must be a byte value smaller than 128. A fine C++17 approach to check that a string is ASCII might look as follows.
```C
bool is_ascii_branchy(const std::string_view v) {
   for (size_t i = 0; i < v.size(); i++) {
     if (uint8_t(v[i]) >= 128) {
       return false;
     }
   }
   return true;
}
```


It is important to consider at the logic of this code. What you are telling the compiler is to access all characters in sequence, check whether it is an ASCII character, and bail out if not. Thus if the string contains no ASCII character, only the first character should be read.

It might be high performance code if you are expecting the strings to mostly start with non-ASCII characters. But if you are expecting the string to be almost always ASCII, then this code is not going to be optimal.

You might complain that the compiler should be able to optimize it for you, and it will, but only within the constraints of the code you provided. Compilers are typically not in the business of redesigning your algorithms.

If you are expecting ASCII inputs, then you should just run through the string  using as few steps as possible. The following code relies on the fact that our processors can process 64-bit blocks using single instructions:
```C
bool is_ascii_branchless(const std::string_view v) {
  uint64_t running = 0;
  size_t i = 0;
  for(; i + 8 <= v.size(); i+=8) {
    uint64_t payload;
    memcpy(&payload, v.data() + i, 8);
    running |= payload;
  }
  for(; i < v.size(); i++) {
      running |= v[i];
  }
  return (running & 0x8080808080808080) == 0;  
}
```


It is an optimistic function: if you encounter a non-ASCII character early on, you will end up doing a lot of needless work if the string is long.

You could try a hybrid between the two. You read 8 characters, check whether they are ASCII, and bail out if they aren&rsquo;t.
```C
bool is_ascii_hybrid(const std::string_view v) {

  size_t i = 0;
  for(; i + 8 <= v.size(); i+=8) {
    uint64_t payload;
    memcpy(&payload, v.data() + i, 8);
    if((payload & 0x8080808080808080) != 0) return false;
  }
  for(; i < v.size(); i++) {
      if((v[i] & 0x80) != 0) return false;
  }
  return true;
}
```


How do these functions compare? [I wrote a quick benchmark with short ASCII strings](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/07/21) (fewer than 128 characters). I get that the character-by-character runs at about half the speed. Your results vary, feel free to run my benchmark on your machine with your compiler.

character-by-character   |2.0 GB/s                 |
-------------------------|-------------------------|
optimistic               |3.5 GB/s                 |
hybrid                   |3.4 GB/s                 |


With some work, you can probably go much faster but be mindful of the fact that I deliberately chose a benchmark with small, fragmented, strings.

