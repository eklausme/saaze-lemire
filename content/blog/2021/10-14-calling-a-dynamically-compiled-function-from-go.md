---
date: "2021-10-14 12:00:00"
title: "Calling a dynamically compiled function from Go"
---



Compiled programming languages are typically much faster than interpreted programming language. Indeed, the compilation step produces &ldquo;machine code&rdquo; that is ideally suited for the processor. However, most programming languages today do not allow you to change the code you compiled. It means that if you find out which function you need after the code has been compiled, you have a problem.

It happens all of the time. For example, you might have a database engine that has to do some expensive processing. The expensive work might be based on a query that is only provided long after the code has been compiled and started. It means that your performance could be limited because the code that runs the query was written without sufficient knowledge of the query.

Let us illustrate the issue and a possible solution in Go (the programming language).

Suppose that your program needs to take the power of some integer. You might write a generic function with a loop, such as the following:
```Go
func Power(x int, n int) int {
	product := 1
	for i := 0; i < n; i++ {
		product *= x
	}
	return product
}
```


However, if the power (n) is a constant, such a function is inefficient. If the constant is known at compile time, you can write an optimized function:
```Go
func Square(x int) int {
	return x * x
}
```


But what if the power is only given to you at runtime?

In Go, we are going to write out the following file (on disk):
```Go
package main

func FastFunction(x int) int {
	return x * x
}

```


The file can be created, at runtime, from with a runtime variable &lsquo;n&rsquo; indicating the power:
```Go
	file, _ := os.Create("fast.go")
	file.WriteString("package main\nfunc FastFunction(x int) int {\n  return x")
	for i := 1; i < n; i++ {
		file.WriteString(" * x")
	}
	file.WriteString("\n}\n")
        file.Close()
```


Importantly, the variable &lsquo;n&rsquo; can be any integer, including an integer provided by the user, at runtime.<br/>
We then compile the new file and load the new function as a &ldquo;plugin&rdquo;:
```Go
	exec.Command("go", "build", "-buildmode=plugin", "-o", "fast.so", "fast.go").Output() 
        plug, _ := plugin.Open("fast.so")
	fastSquare, _ := plug.Lookup("FastFunction")
	loaded, _ := fastSquare.(func(int) int)
```


And that is all! The &lsquo;loaded&rsquo; variable contains a fast and newly compiled function that I can use in the rest of my code.

Of course, writing the file on disk, compiling the result and loading the compiled function is not free. On my laptop, it takes about half a second. Yet once the function is loaded, it is appears to be as fast as the native function (see the Square function above).

I expect that Go cannot &ldquo;inline&rdquo; the resulting function inside the rest of your code. But that should not be a concern if your function is non-trivial.

Another downside of the approach I described is that it is fragile. It can fail for many reasons. It is a security risk. Thus you should only do it if it is absolutely necessary. If you are motivated by performance, it should offer a massive boost (e.g., 2x the performance).

Furthermore, once a plugin is loaded, it cannot be unloaded. If you were to use this method again and again, you might eventually run out of memory.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/10/14).

