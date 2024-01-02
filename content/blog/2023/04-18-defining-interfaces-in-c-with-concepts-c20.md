---
date: "2023-04-18 12:00:00"
title: "Defining interfaces in C++ with `concepts´ (C++20)"
---



In an earlier [blog post](/lemire/blog/2023/04/14/interfaces-are-not-free-in-go/), I showed that the Go programming language allows you to write generic functions once you have defined an <em>interface</em>. Java has a very similar concept under the same name (<em>interface</em>). I gave the following example:
```C
type IntIterable interface {
    HasNext() bool
    Next() uint32
    Reset()
}

func Count(i IntIterable) (count int) {
    count = 0
    i.Reset()
    for i.HasNext() {
        i.Next()
        count++
    }
    return
}

```


From this code, all you have to do is provide a type that supports the interface (having the methods HasNext, Next and Reset with the right signature) and you can use the function Count.

What about C++? Assume that I do not want to use C++ inheritance. In conventional C++, you could just write a Count template like so:
```C
template <class T> size_t count(T &t) {
  t.reset();
  size_t count = 0;
  while (t.has_next()) {
    t.next();
    count++;
  }
  return count;
}

```


That is fine when used in moderation, but if I am a programmer and I need to use a template function I am unfamiliar with, I might have to read the code to find out what my type needs to implement to be compatible with the function template. Of course, it also limits the tools that I use to program: they cannot much about the type I am going to have in practice within the count function.

Thankfully, C++ now has the equivalent to a Go or Java interface, and it is called a _concept_ (it requires a recent compiler with support for C++20). You would implement it as so&hellip;
```C
template <typename T>
concept is_iterable = requires(T v) {
                        { v.has_next() } -> std::convertible_to<bool>;
                        { v.next() } -> std::same_as<uint32_t>;
                        { v.reset() };
                      };

template <is_iterable T> size_t count(T &t) {
  t.reset();
  size_t count = 0;
  while (t.has_next()) {
    t.next();
    count++;
  }
  return count;
}

```


It is even better than the Go equivalent because, as my example demonstrate, I do not have to require strictly that the `has_next` function return a Boolean, I can just require that it returns something that can be converted to a Boolean. In this particular example, I require that the `next` method returns a specific type (<tt>uint32_t</tt>), but I could have required, instead, to have an integer (<tt>std::is_integral&lt;T&gt;::value</tt>) or a number (<tt>std::is_arithmetic&lt;T&gt;::value</tt>).

In Go, I found that using an interface was not free: it can make the code slower. In C++, if you implement the following type and call count on it, you find that optimizing compilers are able to just figure out that they need to return the size of the inner vector. In other words: the use of a concept/template has no runtime cost. However, you pay for it up-front with greater compile-time.
```C
struct iterable_array {
    std::vector<uint32_t> array{};
    size_t index = 0;
    void reset() { index = 0; }
    bool has_next() { return index < array.size(); }
    uint32_t next() { index++; return array[index - 1]; }
};

size_t f(iterable_array & a) {
    return count(a);
}

```


In C++, you can even make the runtime cost absolutely nil by forcing compile-time computation. The trick is to make sure that your type can be instantiated as a compile-time constant, and then you just pass it to the count function. It works with a recent GCC right now, but should be eventually broadly supported. In the following code, the function just returns the integer 10.
```C
template <is_iterable T>
constexpr size_t count(T&& t) {
    return count(t);
}

struct iterable_array {
    constexpr iterable_array(size_t s) : array(s) {}
    std::vector<uint32_t> array{};
    size_t index = 0;
    constexpr void reset() { index = 0; }
    constexpr bool has_next() { return index < array.size(); }
    constexpr uint32_t next() { index++; return array[index - 1]; }
};


consteval size_t f() {
    return count(iterable_array(10));
}


```


[You can examine my source code if you would like](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/04/18).

So what are concepts good for? I think it is mostly about documenting your code. For example, in the simdjson library, we have template methods of the type <tt>get&lt;T&gt;()</tt> where `T` is meant to be one of a few select types (<tt>int64_t</tt>, <tt>double</tt>, <tt>std::string_view</tt>, etc.). Some users invariably hope for some magic and just do <tt>get&lt;mytypefromanotherlibrary&gt;()</tt> hoping that the simdjson will somehow have an adequate overload. They then get a nasty error message. By using concepts, we might limit these programming errors. In fact, IDEs and C++ editor might catch it right away.

In the next blog post, [I explain why concepts might be preferable than standard inheritance](/lemire/blog/2023/04/20/defining-interfaces-in-c-concepts-versus-inheritance/).

