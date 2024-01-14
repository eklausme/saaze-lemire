---
date: "2004-11-08 12:00:00"
title: "Funny differences between Mysql and Postgresql"
---



I hope someone can explain these funny differences between Mysql and Postgresql. (Yes, see update below.)

Here&rsquo;s an easy one&hellip; What is 11/5?
```C

select 11/5;
```


What should a SQL engine answer? Anyone knows? I could check as I used to be a member of the &ldquo;SQL&rdquo; ISO committee, but I&rsquo;m too lazy and the ISO specs are too large. Mysql gives me 2.20 whereas Postgresql gives me 2 (integer division). It seems to me like Postgresql is more in line with most programming language (when dividing integers, use integer division).

It gets even weirder&hellip; how do you round 0.5? I was always taught that the answer is 1.
```C

select round(0.5);
```


Mysql gives me 0 (which I feel is wrong) and Postgresql gives me 1 (which I feel is right).

On both counts, Mysql gives me an unexpected answer.

(The color scheme above for SQL statements shows I learned to program with Turbo Pascal.)

<b>Update:</b> Scott gave me the answer regarding Mysql rounding rule. It will alternate rounding up with rounding down, so```C

select round(1.5);
```


gives you 2 under Mysql. The idea is that rounding should not, probabilistically speaking, favor &ldquo;up&rdquo; over &ldquo;down&rdquo;. Physicists know this principle well. Joseph Scott <b>also</b> gave me the answer, and in fact he gave me quite a [detailed answer on his blog](https://josephscott.org/archives/2004/11/mysqls-funny-math/). I think Joseph&rsquo;s answer is slightly wrong. I don&rsquo;t think Mysql uses the standard C librairies because the following code:
```C

#include <cmath>
#include <iostream>
using namespace std;
int main() {
        cout  << round(0.5) << endl;
        cout  << round(1.5) <<endl;
}
```


outputs 1 and 2 on my machine (not what Mysql gives me).

