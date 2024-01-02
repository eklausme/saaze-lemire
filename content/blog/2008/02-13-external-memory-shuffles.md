---
date: "2008-02-13 12:00:00"
title: "External-Memory Shuffles?"
---



We need to shuffle the lines in very large variable-length-record [flat files](https://en.wikipedia.org/wiki/Flat_file).

We can load the files in MySQL and do &ldquo;select * from mytable order by rand().&rdquo;

However, loading the data in a DBMS and dumping it out is cumbersome. So, we do an in-memory shuffle block by block. It comes close to a full random shuffle, but I am worried it might not be good enough.

Anyone knows of a fast way to do a full external-memory shuffle using only Ruby, Perl, Python, and other Unix utilities?

__A crazy idea__: Let n be the number of lines. Shuffle the numbers between 1 and n, in-memory. Then preprend these numbers at the beginning of each line, do external-memory sorting with the Unix command sort, and remove the random numbers from the final file. This will scale up to about 100 million lines on a PC.

It might be possible to generate random numbers from a large set, thus making collisions very unlikely, thereby avoiding a shuffle of numbers altogether.

__Definitive solution?__ There is a GNU command called shuf, but it works only for small files. However, the new sort command has a &#8211;random-sort flag. To install a recent sort on on MacOS, do the following:<br/>
<code><br/>
wget http://ftp.gnu.org/gnu/coreutils/coreutils-6.9.tar.bz2<br/>
tar xvjf coreutils-6.9.tar.bz2<br/>
cd coreutils-6.9<br/>
mkdir osxbuild &amp;&amp; cd osxbuild<br/>
../configure --prefix=/usr/local/stow/coreutils-6.9<br/>
jm_cv_func_svid_putenv=yes &amp;&amp; make<br/>
sudo cp src/sort /usr/local/bin/<br/>
sudo cp ../man/sort .1 /usr/local/share/man/man1/<br/>
</code>

However, sort &#8211;random-sort will only shuffle properly if no line is repeated. You need to first pass your file through cat -n to ensure that all lines are unique, then conclude with cut to remove the counter added by cat. Here is a command that does the trick:

<code><br/>
cat -n myfile.csv | sort --random-sort | cut -f 2-<br/>
</code>

It may not generate a perfect shuffle, but it should be close.

__Update__:  I have written a [follow-up blog post](/lemire/blog/2010/03/15/external-memory-shuffling-in-linear-time/).

