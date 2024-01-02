---
date: "2006-03-07 12:00:00"
title: "Opening lots and lots of files under Linux"
---



Suppose you want a program, or a process to be precise, to open 10,000 files simultaneously. For some reason, I thought that, by default, this would be possible, but it seems that Linux sets the the default limit to 1024 files on most distributions we checked.

First of all, check how many files your system allows you to open simulateneously:

<code># cat /proc/sys/fs/file-max<br/>
101066<br/>
</code>

On my system, as you can see, a process should be able to open 100,000 files simultaneously without a problem. If your number is much lower, you may need to do some [extra work](http://lists.centos.org/pipermail/centos/2005-February/002655.html). 

Unfortunately, there are security settings above and beyond this number. To get around them, add the following line to &ldquo;/etc/security/limits.conf&rdquo;:

<code>* - nofile 100000</code>

Then, you need to log in again (fresh, not within X). To make sure it worked, type

<code>#ulimit -n<br/>
100000<br/>
</code>

As you can see, it worked for me.

To make double sure it works, you might try to run the following C++ program:

<code>#include &lt;fstream><br/>
#include &lt;string><br/>
#include &lt;iostream><br/>
#include &lt;fstream><br/>
#include &lt;sstream><br/>
#include &lt;vector><br/>
using namespace std;<br/>
int main() {<br/>
fstream lfs[10000];<br/>
for (int k = 0 ; k &lt; 10000; ++k) {<br/>
stringstream strs;<br/>
strs &lt;&lt; "stupidtest" &lt;&lt; k;<br/>
lfs[k].open(strs.str().c_str(),ios::out);<br/>
assert(lfs[k].good());<br/>
if(lfs[k].good()) {<br/>
cout &lt;&lt; "file created "&lt;&lt;strs.str()&lt;&lt; " ok!" &lt;&lt; endl;<br/>
}<br/>
}<br/>
for (int k = 0 ; k &lt; 10000; ++k) {<br/>
stringstream strs;<br/>
strs &lt;&lt; "stupidtest" &lt;&lt; k;<br/>
if(lfs[k].good()) {<br/>
cout &lt;&lt; "file "&lt;&lt;strs.str()&lt;&lt; " still ok!" &lt;&lt; endl;<br/>
}<br/>
lfs[k] &lt;&lt; k;<br/>
if(lfs[k].good()) {<br/>
cout &lt;&lt; "file "&lt;&lt;strs.str()&lt;&lt; " still ok<br/>
after write!" &lt;&lt; endl;<br/>
}<br/>
}<br/>
for (int k = 0 ; k &lt; 10000; ++k) {<br/>
lfs[k].close();<br/>
}<br/>
}</code>

