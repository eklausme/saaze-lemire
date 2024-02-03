---
date: "2017-09-26 12:00:00"
title: "Runtime constants: Go vs. C++"
---



When programming in C++, you can rely on your compiler to do some interesting optimizations. Let us look at this simple code that sums up the values in an array (passed by pointer):
```Go
static int length = 10;

uint64_t sum(uint64_t * a) {
  uint64_t s = 0;
  for(int k = 0; k < length; k++)
      s += a[k];
  return s;
}
```


This code never says that the `length` variable is a constant. However, the `static` keyword restricts the scope of the variable. That is, the compiler can examine the &ldquo;compilation unit&rdquo; and if no part of the code modifies the variable, then it can be certain that no legal C++ code elsewhere can modify it because it simply does not know about the variable <tt>length</tt>.

Incredibly, maybe, a compiler like GNU GCC or LLVM&rsquo;s clang has no problem generating very fast assembly code that makes use of the fact that `length` can be determined to be a constant:
```Go
add     rax, qword ptr [rdi]
add     rax, qword ptr [rdi + 16]
add     rax, qword ptr [rdi + 24]
add     rax, qword ptr [rdi + 32]
add     rax, qword ptr [rdi + 40]
add     rax, qword ptr [rdi + 48]
add     rax, qword ptr [rdi + 56]
add     rax, qword ptr [rdi + 64]
add     rax, qword ptr [rdi + 72]
```


That is, the compiler recognizes that the function is just the summation of 10 values. There is no need to declare the variable to be a constant.

Of course, for this to happen, you have to turn on optimization flags.

What about Go, the programming language developed within Google and strongly inspired by C?

We can try to do something similar&hellip;
```Go
package main
import "fmt"

var length int = 10

func Sum(x[]int) int {
    totalx := 0
    for i:= 0; i < length; i++{
        totalx += x[i]
    }
    return totalx
}


func main() {
  var x = make([]int,length)
  fmt.Println(Sum(x))
}
```


From this code, the Go compiler has enough knowledge to figure out that the loop is over 10 elements. In fact, it could optimize away the main function as just printing out zero. What does it do?

If you examine the assembly (<tt>go build && go tool objdump -S -s Sum gotest</tt>), you notice that Go is unable or unwilling to do this optimization. It compiles the code &ldquo;naively&rdquo; with lots of safety checks.

[The Go wiki has a list of compiler optimizations](https://github.com/golang/go/wiki/CompilerOptimizations), and there is no such optimization on the list. The list of optimizations might not be complete, but we should not be surprised that the Go compiler can&rsquo;t make this optimization.

We could help Go somewhat by declaring `length` to be a constant by using the `const` keyword. We could expect a slightly more efficient loop. Even so, because Go does not do loop unrolling, the result is not even going to be close to what a C++ compiler can do, even with the `const` keyword.

It is worth pointing out that Go is ten years old, it is staffed by some of the best and most experienced programmers in the business, it is funded by one of the richest companies in the world. It is, reportedly, a dominant language in cloud computing.

(Before Go advocates come down hard on me, I should add that I like Go. I program in Go. But Go is not C++ or C.)

