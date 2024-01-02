---
date: "2006-02-02 12:00:00"
title: "Long File Support in GCC (C++)"
---



This is a boring technical post.

GCC 3.4 has long file support builtin for C++ see the _GLIBCXX_USE_LFS flag in &ldquo;c++config.h&rdquo;. If you check the file &ldquo;g++-v3/istream&rdquo;, you&rsquo;ll notice that the &ldquo;seek get location&rdquo; function is defined as &ldquo;seekg(off_type)&rdquo; where &ldquo;off_type&rdquo; is a typedef for &ldquo;streamoff&rdquo; which, itself, is defined as:

<code><br/>
#ifdef _GLIBCXX_HAVE_INT64_T<br/>
typedef int64_t streamoff;<br/>
#else<br/>
typedef long long streamoff;<br/>
#endif<br/>
</code>

So, when you seek get or put positions in a file, you are actually passing a 64 bits integer.

Of course, it would be surprising if GCC would not support long files by default in C++, but I&rsquo;m the curious type.

