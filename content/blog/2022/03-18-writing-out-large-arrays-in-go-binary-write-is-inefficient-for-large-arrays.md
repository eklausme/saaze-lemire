---
date: "2022-03-18 12:00:00"
title: "Writing out large arrays in Go: binary.Write is inefficient for large arrays"
---



Programmers often need to write data structures to disk or to networks. The data structure then needs to be interpreted as a sequence of bytes. Regarding integer values, most computer systems adopt &ldquo;[little endian](https://en.wikipedia.org/wiki/Endianness)&rdquo; encoding whereas an 8-byte integer is written out using the least significant bytes first. In the Go programming language, you can write an array of integers to a buffer as follows:
```Go
<code id="htmlViewer" style="color: #545454; font-weight: normal; background-color: #fefefe; background: #fefefe; display: block; padding: .5em;">var data []uint64
var buf *bytes.Buffer = new(bytes.Buffer)

...

err := binary.Write(buf, binary.LittleEndian, data)
```


Until recently, I assumed that the <tt>binary.Write</tt> function did not allocate memory. Unfortunately, it does. The function converts the input array to a new, temporary byte arrays.

Instead, you can create a small buffer just big enough to hold you 8-byte integer and write that small buffer repeatedly:
```Go
<code id="htmlViewer" style="color: #545454; font-weight: normal; background-color: #fefefe; background: #fefefe; display: block; padding: .5em;">var item = make([]byte, 8)
for _, x := range data {
    binary.LittleEndian.PutUint64(item, x)
    buf.Write(item)
}
```


Sadly, this might have poor performance on disks or networks where each write/read has a high overhead. To avoid this problem, you can use Go&rsquo;s buffered writer and write the integers one by one. Internally, Go will allocate a small buffer.
```Go
<code id="htmlViewer" style="color: #545454; font-weight: normal; background-color: #fefefe; background: #fefefe; display: block; padding: .5em;">writer := bufio.NewWriter(buf)
var item = make([]byte, 8)
for _, x := range data {
	binary.LittleEndian.PutUint64(item, x)
	writer.Write(item)
}
writer.Flush()
```


I wrote a [small benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/03/18) that writes an array of 100M integers to memory.

function                 |memory usage             |time                     |
-------------------------|-------------------------|-------------------------|
<tt>binary.Write</tt>    |1.5 GB                   |1.2 s                    |
one-by-one               |0                        |0.87 s                   |
buffered one-by-one      |4 kB                     |1.2 s                    |


(Timings will vary depending on your hardware and testing procedure. I used Go 1.16.)

The buffered one-by-one approach is not beneficial with respect to speed in this instance, but it would be more helpful in other cases. In my benchmark, the simple one-by-one approach is fastest and uses least memory. For small inputs, <tt>binary.Write</tt> would be faster. The ideal function might have a fast path for small arrays, and a more careful handling of the larger inputs.

