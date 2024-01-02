---
date: "2022-10-26 12:00:00"
title: "Book Review : Template Metaprogramming with C++"
---



I have spent the last few years programming often in C++. The C++ langage is probably one of the hardest to master. I still learn something new every week. Furthermore, C++ is getting upgrades all the time: C++17 was a great step forward and C++20 brings even more exiting improvments.

In C++, we often use &lsquo;templates&rsquo;. As the name suggests, they allow us to create C++ functions and classes from a generic <em>recipe</em>. For example, the following template allows us to create functions that sum up two values:
```C
template <class T>
T f(T x, T y) {
    return x + y;
}
```


It gets automatically instantiated when you need it. The following function will return the sum of two integers.
```C
int g(int x, int y) {
    return f(x,y);
}
```


Templates are very powerful. They allow us to create highly efficient code, because everything happens at compile time: the optimizer can do it is work. With great power, comes great responsibility: templates can be infuriating since they may lead to unreadable error messages, and they can greatly increase the compile time. I use templates sparingly when programming in C++.

<img fetchpriority="high" decoding="async" class="alignnone size-medium wp-image-19963" style="float: right; margin: 2px;" src="https://lemire.me/blog/wp-content/uploads/2022/10/Capture-decran-le-2022-10-26-a-14.38.38-266x300.png" alt width="266" height="300" srcset="https://lemire.me/blog/wp-content/uploads/2022/10/Capture-decran-le-2022-10-26-a-14.38.38-266x300.png 266w, https://lemire.me/blog/wp-content/uploads/2022/10/Capture-decran-le-2022-10-26-a-14.38.38-907x1024.png 907w, https://lemire.me/blog/wp-content/uploads/2022/10/Capture-decran-le-2022-10-26-a-14.38.38-768x867.png 768w, https://lemire.me/blog/wp-content/uploads/2022/10/Capture-decran-le-2022-10-26-a-14.38.38.png 1102w" sizes="(max-width: 266px) 100vw, 266px" /><a href="https://www.amazon.com/Template-Metaprogramming-everything-templates-metaprogramming-ebook/dp/B09ZHZFTKV"><br/>
I spent the last few weeks reading Template Metaprogramming with C++</a> by Marius Băncilă. It is currently 50$ on Amazon.</a>

Though, technically, the book is about advanced &lsquo;template&rsquo; techniques, it is much more broad and practical. It is one of the &lsquo;good programming books&rsquo;. If you are an experienced C++ programmer, you should give it a peek. It is full of practical code.

The book reminded me of the following features.

<em>Explicit instantiation declaration</em>: In my example above, the template `f` with type `int` gets compiled as soon as I invoke it. In that particular case, it is not worrisome. However, it can be helpful to pre-compile the functions to reduce compile time in large projects, involving large pieces of code. We typically achieve the desire results in C and C++ by separating function declaration (put in a header file) and function definition (put in a source file). It is somewhat trickier to do with templates. Yet we can do so by putting the following line in the header:
```C
extern template int f(int,int);
```


Followed by the following in a source file:
```C
template int f(int,int);
```


And voilà!

<em>Lambda templates</em>. It is cumbersome in C and C++ to define a function. In C++, you can create &lsquo;lambdas&rsquo; which are effectively locally defined functions. For example, the following code first defines an &lsquo;addition&rsquo; function (called lambda) and then it applies it to add two numbers:
```C
int g(int x, int y) {
    auto lambda = [](int x, int y) -> int { return x + y; };
    return lambda(x, y);
}
```


Up until recently, you could not mix templates and lambdas, but now you can with C++20:
```C
int g(int x, int y) {
    auto lambda = []<class T>(T x, T y) -> T { return x + y; };
    return lambda(x, y);
}
```


<em>Variable templates</em>. Sometimes you need constants that depend on a type. For example, the number pi might different depending on the precision of the type you are using. That is where variable templates shine:
```C
template <typename T>
constexpr T PI = T(3.1415926535897932384626433832795028841971693993751);


std::cout << PI<double> << std::endl;
std::cout << PI<float> << std::endl;
```




There is plenty more to explore in [Băncilă&rsquo;s book](https://www.amazon.com/Template-Metaprogramming-everything-templates-metaprogramming-ebook/dp/B09ZHZFTKV).

[I posted some code examples on GitHub](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/10/26).

__Disclosure__: I got a free copy of the book from the editor in exchange for a promise that I would do a review if I liked the book. I did not agree beforehand to produce a positive review. I do not get paid if you buy the book.

