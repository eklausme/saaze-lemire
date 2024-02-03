---
date: "2023-11-07 12:00:00"
title: "Generating arrays at compile-time in C++ with lambdas"
---



Suppose that you want to check whether a character in C++ belongs to a fixed set, such as &lsquo;\0&rsquo;, &lsquo;\x09&rsquo;, &lsquo;\x0a&rsquo;,&rsquo;\x0d&rsquo;, &lsquo; &lsquo;, &lsquo;#&rsquo;, &lsquo;/&rsquo;, &lsquo;:&rsquo;, &lsquo;&lt;&lsquo;, &lsquo;&gt;&rsquo;, &lsquo;?&rsquo;, &lsquo;@&rsquo;, &lsquo;[&lsquo;, &lsquo;\\&rsquo;, &lsquo;]&rsquo;, &lsquo;^&rsquo;, &lsquo;|&rsquo;. A simple way is to generate a 256-byte array of Boolean values and lookup the value. This approach is sometimes called [memoization](https://en.wikipedia.org/wiki/Memoization) (and not memorization!!!). You might do it as follows:
```C
constexpr static bool is_forbidden_host_code_point_table[] = {
  1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1,
  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0,
  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0,
  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
  0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0};
bool is_forbidden_host_code_point(char c) {
  return is_forbidden_host_code_point_table[uint8_t(c)];
}

```


It is reasonably efficient in practice. Some people might object to how the table is generated. Can you have the C++ compiler generate the array at compile-time from a function?

Using C++17, you might do it with an <tt>std::array</tt> as follows:
```C
constexpr static std::array<uint8_t, 256> is_forbidden_array = []() {
  std::array<uint8_t, 256> result{};
  for (uint8_t c : {'\0', '\x09', '\x0a','\x0d', ' ', '#', '/', ':',
    '<', '>', '?', '@', '[', '\\', ']', '^', '|'}) {
   result[c] = true;
  }
  return result;
}();

bool is_forbidden_host_code_point_array(char c) {
  return is_forbidden_array[uint8_t(c)];
}

```


These two approaches should be equivalent in practice. This might compile down to a single lookup instruction, or the equivalent.

You may want to compare it against the default (without memoization) which might be&hellip;
```C
bool is_forbidden_host_code_point_default(char c) noexcept {
  return c == '\0' || c == '\x09' || c == '\x0a'
   || c == '\x0d' || c == ' ' || c == '#'
   || c == '/'|| c == ':' || c == '<'|| c == '>'
   || c == '?' || c == '@' || c == '['|| c == '\\'
  || c == ']'|| c == '^' || c == '|';
}

```


A compiler like GCC might compile this routine to a bitset approach such as &hellip;
```C

 cmp dil, 62
ja .L2
movabs rax, 6052978675329017345
bt rax, rdi
setc al
ret
.L2:
sub edi, 63
cmp dil, 61
ja .L4
movabs rax, 2305843013240225795
bt rax, rdi
setc al
ret

```


The default approach certainly generates more instructions, and might be less efficient in some cases.

__Further reading__. [The evolution of constexpr: compile-time lookup tables in C++](https://joelfilho.com/blog/2020/compile_time_lookup_tables_in_cpp/)

