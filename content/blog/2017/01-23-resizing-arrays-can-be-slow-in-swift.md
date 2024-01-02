---
date: "2017-01-23 12:00:00"
title: "Resizing arrays can be slow in Swift"
---



Swift a recent high-performance programming language. It is still primarily used develop iOS applications, but it has the potential to be a general-purpose language.

The lack of maturity of the language is still apparent. For example, it is almost [trivially easy to create source code that the Swift compiler won&rsquo;t be able to compile in a reasonable time](http://stackoverflow.com/questions/41670789/compiling-swift-source-files-issue-with-creating-dictionary/41772000#41772000).

Another pain point I have encountered is the performance of arrays. Arrays are important in programming and you want them to be fast. 

Initializing an array is efficient in Swift. The following code&hellip;
```C
var z = Array(repeating: 0, count: 1001)
z[0] = 10
```


&hellip; uses about 1.5 cycles per entry. 

But arrays in Swift are dynamic: you can grow them. And it is a lot less clear whether Swift is efficient in this case.

Let me illustrate. Suppose that you have an array containing the value 10 and then, afterward, you want to extend it with lots of zeros. This should be nearly as fast as initializing the array in one go&hellip; 

Irrespective of the programming language, given a dynamic array, I would code it like so&hellip;
```C
var z = [Int]() // z in a dynamic array (empty)
 z.append(10)
 for i in 0..<10000 { 
    z.append(0)
 }
```


On a recent Intel processor, this uses up 10 cycles per added value. That&rsquo;s a lot of cycles just to create an array filled with zeros! 

Swift arrays have the `reserveCapacity` method that we can put to good use to avoid multiple reallocations&hellip;
```C
var z = [Int]()
z.append(10)
z.reserveCapacity(1000 + 1)
for i in 0..<1000 {
   z.append(0)
}
```


We are now down to 5 cycles per entry&hellip; better but still disappointing&hellip; 

We can get the desired performance by ignoring the fact that Swift has dynamic arrays and just creating a new array instead&hellip;
```C
func extendArray(_ x : inout [Int], size: Int) 
         -> [Int] {
   var answer = Array(repeating: 0, count: size)
   for i in 0..<x.count {
     answer[i] = x[i]
   }
   x = answer
}
```


I consider these results, if they bear out, as some kind of performance bug. Any dynamic array implementation worth its salt should let you resize it as fast as you create a new array and copy the old result. If you can&rsquo;t achieve that much&hellip; make it clear in the API that your structure is not meant to be regularly resized.

[My Swift source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/01/23/arrays).

Update: Joe Groff suggest this approach: <tt>x = Array((0..<size).lazy.map { $0 &lt; x.count ? x[$0] : 0 })< tt> but my tests suggests that it is not the fastest way.

