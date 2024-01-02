---
date: "2023-04-20 12:00:00"
title: "Defining interfaces in C++: concepts versus inheritance"
---



In a previous [blog post](/lemire/blog/2023/04/18/defining-interfaces-in-c-with-concepts-c20/), I showed how you could define &lsquo;an interface&rsquo; in C++ using <em>concepts</em>. For example, I can specify that a type should have the methods has_next, next and reset:
```C
template <typename T>
concept is_iterable = requires(T v) {
                        { v.has_next() } -> std::convertible_to<bool>;
                        { v.next() } -> std::same_as<uint32_t>;
                        { v.reset() };
                      };
```


I can then define a function template, taking a concept instance as a parameter:
```C
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


In that blog post, I stated that I did not take into account inheritance as a strategy. Let us do so. We can define a generic base class and a corresponding generic function:
```C
class iter_base {
public:
  virtual bool has_next() = 0;
  virtual uint32_t next() = 0;
  virtual void reset() = 0;
  virtual ~iter_base() = default;
};

size_t count_inheritance(iter_base &t) {
  t.reset();
  size_t count = 0;
  while (t.has_next()) {
    t.next();
    count++;
  }
  return count;
}

```


I can define a class that is suitable for both functions, as it satisfies the inheritance condition, as well as the concept:
```C
struct iterable_array : iter_base {
  std::vector<uint32_t> array{};
  size_t index = 0;
  void reset() { index = 0; }
  bool has_next() { return index < array.size(); }
  uint32_t next() {
    index++;
    return array[index - 1];
  }
};

```


So far so good. But what is the difference between these two expressions given that `a` is an instance of <tt>iterable_array</tt>?

- <tt>count(a)</tt>,
- <tt>count_inheritance(a)</tt>.


Given an optimizing compiler, the first function (<tt>count(a)</tt>) is likely to just immediately return the size of the backing vector. The function is nearly free.

The second function (<tt>count_inheritance(a)</tt>) does not know anything about the `iterable_array` type so it will iterate through the content naively, and might be hundreds of times more expensive.

