---
date: "2017-12-12 12:00:00"
title: "If all your attributes are independent two-by-two&#8230; are all your attributes independent?"
---



Suppose that you are working on a business problem where you have multiple attributes&hellip; maybe you have a table with multiple columns such as &ldquo;age, gender, income, location, occupation&rdquo;.

You might be interested in determining whether there are relations between some of these attributes. Maybe the income depends on the gender or the age?

That is fairly easy to do. You can take the gender column and the income column and do some statistics. You can compute Pearson&rsquo;s correlation or some other measure.

If you have _N_ attributes, you have _N_ (<em>N</em>-1) / 2 distinct pairs of attributes, so there can be many pairs to check, but it is not so bad.

However, what if you have established that there is no significant relationship between any of your attributes when you take them two-by-two. Are you done?

Again, you could check for all possible sets (e.g., {age, gender, income}, {income, location, occupation}). The set of all possible sets is called the power set. It contains 2<sup><em>N</em></sup> sets. So it grows exponentially with <em>N</em>, which means that for any large value of <em>N</em>, it is not practical to check all such sets.

But maybe you think that because you checked all pairs, you are done.

Maybe not.

Suppose that _x_ and _y_ are two attributes taking random integer values. So there is no sensible dependency between _x_ and <em>y</em>. Then introduce _z_ which is given by _z_ = _x_ + <em>y</em>. Clearly, _x_ and _y_ determine <em>z</em>. But there is no pairwise dependency between any of <em>x</em>, <em>y</em>, <em>z</em>.

[To be precise, in Java, if you do the following](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/12/12/Test.java)&hellip;
```C
Random r = new Random();
for(int k = 0; k < N; k++) {
   x[k] = r.nextInt();
   y[k] = r.nextInt();
   z[k] = x[k] + y[k];
}
```


then there is no correlation between (<em>y</em>, <em>z</em>) or (<em>x</em>, <em>z</em>) even though _x_ + _y_ = <em>z</em>.

So if you look only at (<em>x</em>, <em>y</em>), (<em>y</em>, <em>z</em>) and (<em>x</em>, <em>z</em>), this tells less than you might think about (<em>x</em>, <em>y</em>, <em>z</em>).

Thus, checking relationships pairwise is only the beginning&hellip;

