---
date: "2005-11-17 12:00:00"
title: "Numerical Python versus SciPy core"
---



If you are like me and use Python to do actual research, you probably know about [Numerical Python](http://numeric.scipy.org/) which provides you with basic linear algebra, complex numbers, FFT and related code.

Two days ago, I had to reinstall Numerical Python and say that they are promoting a replacement called SciPy core. They warn you to stay away from the old Numerical Python. __Don&rsquo;t listen to them!__

- On my machine, the code fails its basic unit testing . The function &ldquo;linear_least_squares&rdquo; is broken. Yet, there was no warning while installing. Specifically, here&rsquo;s what I get:<br/>
<code>>>> scipy.basic.linalg.linear_least_squares(array([[1,1],[1,1]]),array([2,2]))<br/>
Traceback (most recent call last):<br/>
File "<stdin>", line 1, in ?<br/>
File "/usr/lib64/python2.4/site-packages/scipy/basic/basic_lite.py", line 457, in linear_least_squares<br/>
0,work,-1,iwork,0 )<br/>
lapack_lite.LapackError: Parameter b is not contiguous in lapack_lite.dgelsd<br/>
</stdin></code><br/>
For this reason alone, I suggest you stay away from scipy! (This was verified with version 0.6.1, but it now works with version 0.8.4.)
- The author figured out it was time to replace the good old &ldquo;import LinearAlgebra&rdquo; by &ldquo;import scipy.basic.linalg&rdquo; though he claims in the documentation that all you have to do is &ldquo;import scipy.linalg&rdquo;. Even so, I <b>want</b> &ldquo;import LinearAlgebra&rdquo;, not &ldquo;import LinAlg&rdquo; or &ldquo;import scipy.linalg&rdquo;. I think most users will agree with me. Cryptic package names are out. (Similarly, the good old &ldquo;import Numeric&rdquo; is replaced with &ldquo;import scipy.base&rdquo;&hellip; what&rsquo;s wrong with &ldquo;import scipy&rdquo;?) 
- The inline documentation for SciPy Core is still incomplete. Typing &ldquo;help(scipy.basic.linalg)&rdquo; returns an empty page whereas &ldquo;help(LinearAlgebra)&rdquo; would give you a description of the package.


__Update:__ please see a [more positive recent post about this package](/lemire/blog/2005/12/31/time-to-move-from-numerical-python-to-scipy-core/).

