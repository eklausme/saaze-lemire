---
date: "2023-10-19 12:00:00"
title: "For processing strings, streams in C++ can be slow"
---



The C++ library has long been organized around stream classes, at least when it comes to reading and parsing strings. But streams can be surprisingly slow. For example, if you want to parse numbers, then this C++ routine is close to being [the worst possible choice for performance](/lemire/blog/2019/10/26/how-expensive-is-it-to-parse-numbers-from-a-string-in-c/):
```C
std::stringstream in(mystring);
while(in >> x) {
   sum += x;
}
return sum;
```


I recently learned that [some Node.js engineers prefer stream classes when building strings](https://github.com/nodejs/node/pull/50253), for performance reasons. I am skeptical.

Let us run an experiment. We shall take strings containing the &lsquo;%&rsquo; character and we build new strings where the &lsquo;%&rsquo; character is replaced by &lsquo;%25&rsquo; but the rest of the string is otherwise unchanged.

A straight-forward string construction is as follows:
```C
std::string string_escape(const std::string_view file_path) {
  std::string escaped_file_path;
  for (size_t i = 0; i < file_path.length(); ++i) {
    escaped_file_path += file_path[i];
    if (file_path[i] == '%')
      escaped_file_path += "25";
  }
  return escaped_file_path;
}

```


An optimized version using streams is as follows:
```C
std::string stream_escape(const std::string_view file_path) {
  std::ostringstream escaped_file_path;
  for (size_t i = 0; i < file_path.length(); ++i) {
    escaped_file_path << file_path[i];
    if (file_path[i] == '%')
      escaped_file_path << "25";
  }
  return escaped_file_path.str();
}

```


I envision using these functions over strings that contain few &lsquo;%&rsquo; characters. It is possible that most of the strings do not contain the &lsquo;%&rsquo;. In such cases, I can just search for the character and only do non-trivial work when one is found. The following code should do:
```C
std::string find_string_escape(std::string_view file_path) {
  // Avoid unnecessary allocations.
  size_t pos = file_path.empty() ? std::string_view::npos :
    file_path.find('%');
  if (pos == std::string_view::npos) {
   return std::string(file_path);
  }
  // Escape '%' characters to a temporary string.
  std::string escaped_file_path;
  do {
    escaped_file_path += file_path.substr(0, pos + 1);
    escaped_file_path += "25";
    file_path = file_path.substr(pos + 1);
    pos = file_path.empty() ? std::string_view::npos :
      file_path.find('%');
  } while (pos != std::string_view::npos);
  escaped_file_path += file_path;
  return escaped_file_path;
}

```


[I wrote a benchmark that uses a large collection of actual file URLs as a data source](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/10/18). The benchmark runs under macOS and Linux. I use Linux, a recent Intel server and GCC 12:

naive strings            |260 ns/string            |0.45 GB/s                |
-------------------------|-------------------------|-------------------------|
stream                   |1000 ns/string           |0.12 GB/s                |
find                     |33 ns/string             |3.49 GB/s                |


At least in this case, I find that the stream version is four times slower than  naive string processing, and it is 30 times slower than the optimized &lsquo;find&rsquo; approach.

Your results will vary depending on your system, but I generally consider the use of streams in C++ as a hint that there might be poor performance.

__Further reading__: I turned this blog post into [a pull request to Node.js](https://github.com/nodejs/node/pull/50288).

