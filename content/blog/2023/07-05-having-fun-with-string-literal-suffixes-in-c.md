---
date: "2023-07-05 12:00:00"
title: "Having fun with string literal suffixes in C++"
---



The C++11 standard introduced user-defined string suffixes. It also added [regular  expressions](https://en.wikipedia.org/wiki/Regular_expression) to the C++ language as a standard feature. I wanted to have fun and see whether we could combine these features.

Regular expressions are useful to check whether a given string matches a pattern. For example, the expression <tt>\d+</tt> checks that the string is made of one or more digits. Unfortunately, the backlash character needs to be escaped in C++, so the string <tt>\d+</tt> may need to be written as <tt>"\\d+"</tt> or you may use a raw string: a raw string literal starts with <tt>R"(</tt> and ends in <tt>)"</tt> so you can write <tt>R"(\d+)"</tt>. For complicated expressions, a raw string might be better.

A user-defined string literal is a way to specialize a string literal according to your own needs. It is effectively a convenient way to design your own &ldquo;string types&rdquo;. You can code it up as:
```C
myclass operator"" _mysuffix(const char *str, size_t len) {
  return myclass(str, len);
}
```


And once it is defined, instead of writing <tt>myclass("mystring", 8)</tt>, you can write <tt>"mystring"_mysuffix</tt>.

In any case, we would like to have a syntax such as this:

<tt>bool is_digit = "\\d+"_re("123");</tt>

I can start with a user-defined string suffix:
```C
convenience_matcher operator "" _re(const char *str, size_t) {
return convenience_matcher(str);
}

```


I want my `convenience_matcher` to construct a regular expression instance, and to call the matching function whenever a parameter is passed in parenthesis. The following class might work:
```C
#include <regex>
struct convenience_matcher {
  convenience_matcher(const char *str) : re(str) {}
  bool match(const std::string &s) {
    std::smatch base_match;
    return std::regex_match(s, base_match, re);
  }
  bool operator()(const std::string &s) { return match(s); }
  std::regex re;
};
```


And that is all. The following expressions will then return a Boolean value indicating whether we have the required pattern:
```C
 "\\d+"_re("123") // true
 "\\d+"_re("a23") // false
 R"(\d+)"_re("123") // true
 R"(\d+)"_re("a23") // false
```


I have posted a [complete example](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2023/07/05/abuse.cpp). It is just for illustration and I do not recommend using this code for anything serious. I am sure that you can do better!

