---
date: "2020-04-26 12:00:00"
title: "Sampling efficiently from groups"
---



Suppose that you have to sample a student at random in a school. However, you cannot go into a classroom and just pick a student. All you are allowed to do is to pick a classroom, and then let the teacher pick a student at random. The student is then removed from the classroom. You may then have to pick a student at random, again, but with a classroom that is now missing a student. Importantly, I care about the order in which the students were picked. But I also have a limited memory: there are too many students, and I can&rsquo;t remember too many. I can barely remember how many students I have per classroom.

If the classrooms contain a variable number of students, you cannot just pick classrooms at random. If you do so, students in classrooms with lots of students are going to be less likely to be picked.

So instead, you can do it as follows. If there are _N_ students in total, pick a number _x_ between 1 and <em>N</em>. If the number _x_ is smaller or equal to the number of students in the first classroom, pick the first classroom and stop. If the number is smaller or equal to the number of students in the first two classrooms, pick the second classroom, and so forth. If you remove the student, you have to account for the fact that the sum (<em>N</em>) is reduced and the number of students in the classroom is being updated.
```C
    while(N > 0) {
            int x = r.nextInt(sum); // random integer in [0,sum)
            int runningsum = 0;
            int z = 0;
            for(; z < runninghisto.length; z++) {
                runningsum += runninghisto[z];
                if(y < runningsum) { break; }
            }
            // found z
            runninghisto[z] -= 1;
            N -= 1;
    }
```


If you have many classrooms, this algorithm can be naive because each time you must pick a classroom you may need to iterate over all classroom counts. Suppose you have K classroom: you may need to do _N_ <em>K</em> tasks to solve the problem.

Importantly, the problem is dynamic: the number of students in each classroom is not fixed. You cannot simply precompute some kind of map once and for all.

Can you do better than the naive algorithm? I can craft a &ldquo;logarithmic&rdquo; algorithm, one where the number of operations you do is the logarithm of the number of classrooms. I believe that my algorithm is efficient in practice.

So divide your classrooms into two sets of classrooms of size _R_ and _S_ so that _R_ + _S_ = <em>N</em>. Pick an integer in [0,<em>N</em>). If it is smaller than <em>R</em>, decrement _R_ and pick a buffer in the corresponding set. If it is larger than or equal to <em>R</em>, then go with the other set of buffers. So we have reduced the size of the problem in two. We can repeat the same trick recursively. Divide the two subsets of classrooms and so forth. Instead of merely maintaining the total number of students in all of the classrooms, you keep track of the counts in a tree-like manner.

<a href="https://lemire.me/blog/wp-content/uploads/2020/04/B42BA714-63E4-4D97-ACAF-5C26B738C7F9-scaled.jpeg"><img fetchpriority="high" decoding="async" class="alignnone size-full wp-image-18472" src="https://lemire.me/blog/wp-content/uploads/2020/04/B42BA714-63E4-4D97-ACAF-5C26B738C7F9-scaled.jpeg" alt width="1978" height="2560" srcset="https://lemire.me/blog/wp-content/uploads/2020/04/B42BA714-63E4-4D97-ACAF-5C26B738C7F9-scaled.jpeg 1978w, https://lemire.me/blog/wp-content/uploads/2020/04/B42BA714-63E4-4D97-ACAF-5C26B738C7F9-232x300.jpeg 232w, https://lemire.me/blog/wp-content/uploads/2020/04/B42BA714-63E4-4D97-ACAF-5C26B738C7F9-791x1024.jpeg 791w, https://lemire.me/blog/wp-content/uploads/2020/04/B42BA714-63E4-4D97-ACAF-5C26B738C7F9-768x994.jpeg 768w, https://lemire.me/blog/wp-content/uploads/2020/04/B42BA714-63E4-4D97-ACAF-5C26B738C7F9-1187x1536.jpeg 1187w, https://lemire.me/blog/wp-content/uploads/2020/04/B42BA714-63E4-4D97-ACAF-5C26B738C7F9-1583x2048.jpeg 1583w" sizes="(max-width: 1978px) 100vw, 1978px" /></a>

We can operationalize this strategy efficiently in software:

- Build an array containing the number students in each classroom.
- Replace every two counts by the sum of two counts: instead of storing the number of students in second classroom, store the number of students in the first two classrooms.
- Replace every four counts by the sum of the four counts: where the count of the fourth class was, store the sum of the number of students in the first four classrooms.
- And so forth.


In Java, it might look like this:
```C
int level = 1;
for(;(1<<level) < runninghisto.length; level++) {
  for(int z = 0;
     z + (1<<level) < runninghisto.length;
    z += 2*(1<<level)) {
       runninghisto[z + (1<<level)] += runninghisto[z];
  }
}
```


You effectively have a tree of prefixes which you can then use to find the right classroom without visiting all of the classroom counts. You visit a tree with a height that is the logarithm of the number of classrooms. At each level, you may have to decrement a counter.
```C
        while(N > 0) {
            int y = r.nextInt(sum);
            // select logarithmic time
            level = maxlevel;
            int offset = 0;
            for(; level >= 0; level -= 1) {
                if(y >= runninghisto[offset + (1<<level)]) {
                    runninghisto[offset + (1<<level)] -= 1;
                    offset += (1<<level);
                }
            }
            // found offset
            N -= 1;
        }
```


[I have written a Java demonstration of this idea](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/04/26). For simplicity, I assume that the number of classrooms is a power of two, but this limitation could be lifted by doing a bit more work. Instead of _N_ <em>K</em> operations, you can now do only _N_ log _K_ operations.

Importantly, the second approach uses no more memory than the first one. All you need is enough memory to maintain the histogram.

[My Java code includes a benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/04/26).

__Update__. If you are willing to use batch processing and use a little bit of extra memory, you might be able to do even better in some cases. Go back to the original algorithm. Instead of picking one integer in [0,<em>N</em>), pick _C_ for some number <em>C</em>. Then find out in which room each of these _k_ integers fit, as before, decrementing the counts. If you pick the _C_ integers in sorted order, a simple sequential scan should be enough. For _C_ small compared to <em>N</em>, you can pick the _C_ integers in linear time using effective reservoir sampling. Then you can shuffle the result again using Knuth&rsquo;s random shuffle, in linear time. So you get to do about _N_ <em>K</em> / _C_ operations. (Credit: Travis Downs and Richard Startin.)

__Further reading__: [Hierarchical bin buffering: Online local moments for dynamic external memory arrays](https://dl.acm.org/doi/10.1145/1328911.1328925), ACM Transactions on Algorithms.

__Follow-up__: [Sampling Whisky by Richard Startin](https://richardstartin.github.io/posts/sampling-whisky)

