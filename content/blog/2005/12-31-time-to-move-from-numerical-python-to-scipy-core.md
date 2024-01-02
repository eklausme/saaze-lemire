---
date: "2005-12-31 12:00:00"
title: "Time to move from Numerical Python to SciPy Core"
---



If you are a Python user, and you do Numerical Analysis, it might be time to move from [Numerical Python to SciPy Core](http://numeric.scipy.org/). I [complained earlier about SciPy Core](/lemire/blog/2005/11/17/numerical-python-versus-scipy-core/), but it seems that most of the problems I pointed out (missing inline documentation and broken functions) have either been fixed, or I wrongly pointed a finger.

I still have a few issues with the new package though:

- The naming convention for the LinearAlgebra package is awful. I don&rsquo;t want to have to work with a package called &ldquo;scipy.basic.linalg&rdquo;: if you want to save space, don&rsquo;t abbreviate LinearAlgebra to linalg and add three subpackages to it. Call the package scipy.LinearAlgebra, for example. 
- There are glitches in the documentation. Both &ldquo;help(scipy.basic.linalg)&rdquo; or &ldquo;help(scipy.linalg)&rdquo; return a page describing &ldquo;scipy.basic.linalg&rdquo; as the &ldquo;Lite version of scipy.linalg&rdquo; and a list of 3 supported functions (Heigenvectors, eigenvectors, singular_value_decomposition). There are more than only 3 functions in this package!


On the positive side of things, you can now simply do &ldquo;import scipy&rdquo; to get the basic functions (like the scipy.array class). So, time to switch!

