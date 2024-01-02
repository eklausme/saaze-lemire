---
date: "2021-10-26 12:00:00"
title: "In C++, is empty() faster than comparing the size with zero?"
---



Most C++ programmers rely on &ldquo;STL&rdquo; for their data structures. The most popular data structure is probably [vector](https://en.cppreference.com/w/cpp/container/vector), which is just a dynamic array. The [set](https://en.cppreference.com/w/cpp/container/set) and the [map](https://en.cppreference.com/w/cpp/container/map) are other useful ones.

The STL data structures are a minimalist design. You have relatively few methods. All of them allow you to compute the size of the data structure, that is, how many elements it contains, via the <tt>size()</tt> method. In recent C++ (C++11), the <tt>size()</tt> method [must have constant-time complexity for all containers](http://www.open-std.org/jtc1/sc22/wg21/docs/papers/2014/n4296.pdf). To put it in clearer terms, the people implementing the containers can never scan the content to find out the number of elements.

These containers also have another method called <tt>empty()</tt> which simply returns true of the container is&hellip; well&hellip; empty. Obviously, an equivalent strategy would be to compare the size with zero:  <tt>mystruct.size() == 0</tt>.

Determining whether a data structure is empty is conceptually easier than determining its size. Thus, at least in theory, calling <tt>empty()</tt> could be faster.

Inspecting [the assembly output](https://godbolt.org/z/4Yfbearjo), I find that recent versions of GCC produce nearly identical code for the comparison of the size and the empty call. The exception being the [list](https://en.cppreference.com/w/cpp/container/list) data structure where the assembly is slightly different, but not in a manner that should affect performance.

Of course, there are different implementations of C++ and it is possible that other implementations could provide more efficient code when calling <tt>empty()</tt>. An interesting question is whether effort is needed from the compiler.

Travis Downs wrote a list data structure by hand, but with a size() function that is linear time. He then implemented the empty function naively:
```C
struct node {
    struct node *next;
    int payload;
};

int count_nodes(const node* p) {
    int size = 0;
    while (p) {
        p = p->next;
        size++;
    }
    return size;
}

bool is_not_empty(const node* p) {
    return count_nodes(p) > 0;
}
```


Amazingly, we find that the GCC compiler is able to compile Travis&rsquo; `is_not_empty` C++ function [to constant-time code](https://godbolt.org/z/7v86K5oqq). The compiler inlines the count_nodes function into is_empty. Then the compiler figures out that as soon as you enter the loop once with <tt>count_nodes</tt>, then size is going to be greater than zero, so there is no need to keep looping.

However, the optimisation is not robust. Suppose that I wish instead to return an unsigned type instead of Travis&rsquo; int value. The problem with an unsigned type is that I might overflow if the list is very long. With a signed integer, the compiler is allowed to assume that overflows do not happen. It could be difficult for the compiler to tell whether <tt>count_nodes()</tt> return 0 or not, if the compiler must handle overflows. To handle this potential issue, I can forcefully bound the return value of <tt>count_nodes()</tt> to be no more than 1000. If I change the code to return a standard size_t type, like so&hellip;
```C
#include <cstddef>

struct node {
    struct node *next;
    int payload;
};

size_t count_nodes(const node* p) {
    size_t size = 0;
    while (p) {
        p = p->next;
        size++;
        if(size == 1000) { 
            return 1000; 
        }
    }
    return size;
}

bool is_not_empty(const node* p) {
    return count_nodes(p) > 0;
}
```


Sadly, [GCC is now unable to optimize away the call](https://godbolt.org/z/MaEsPK8Eh). Maybe compilers are not yet all-powerful beings?

The lesson is that it is probably wise to get in the habit of calling directly <tt>empty()</tt> if you care about performance. Though it may not help much with modern STL data structures, in other code it could be different.

Of course, another argument is that the call to <tt>empty()</tt>  is shorter and cleaner.

__Credit__: This blog post was motivated by a tweet by Richard Startin.

