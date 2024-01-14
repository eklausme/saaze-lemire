---
date: "2016-03-21 12:00:00"
title: "Ranged random-number generation is slow in Python&#8230;"
index: false
---

[18 thoughts on &ldquo;Ranged random-number generation is slow in Python&#8230;&rdquo;](/lemire/blog/2016/03-21-ranged-random-number-generation-is-slow-in-python)

<ol class="comment-list">
<li id="comment-232808" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d5805a69041b0faf0aace75df8e206ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d5805a69041b0faf0aace75df8e206ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Marcel Ball</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-21T17:37:07+00:00">March 21, 2016 at 5:37 pm</time></a> </div>
<div class="comment-content">
<p>Depending on the libraries they are using for Python I strongly suggest looking into PyPy (pretty much 100% compatible with anything pure python; still a bit hit-and-miss for things that go out to native code &#8211; they are working on a PyPy compatible NumPy version which is one of the big ones for scientific computing).</p>
<p>Just ran this for a comparison on my computer:</p>
<p>PyPy 4.0.1<br/>
$ pypy -m timeit -s &lsquo;import random&rsquo; &lsquo;random.randint(0, 1000)&rsquo;<br/>
100000000 loops, best of 3: 0.0117 usec per loop</p>
<p>Python 2.7.10<br/>
$ python -m timeit -s &lsquo;import random&rsquo; &lsquo;random.randint(0, 1000)&rsquo;<br/>
1000000 loops, best of 3: 0.874 usec per loop</p>
</div>
<ol class="children">
<li id="comment-232812" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-21T18:06:11+00:00">March 21, 2016 at 6:06 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. I have updated my blog post. Interestingly, you can also apparently simply switch to the randint function provided by numpy. </p>
<p>As far as my colleague is concerned, they are relying on numpy, though not for random-number generation. So PyPy is probably not the solution for them.</p>
</div>
<ol class="children">
<li id="comment-232849" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d5805a69041b0faf0aace75df8e206ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d5805a69041b0faf0aace75df8e206ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcel Ball</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-21T22:52:00+00:00">March 21, 2016 at 10:52 pm</time></a> </div>
<div class="comment-content">
<p>Yeah &#8211; PyPy, and the NumPy version for PyPy, have come a long way. Still parts of NumPy that need to be completed yet &#8211; but they&rsquo;ve been making a lot of progress.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-232809" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e26b9a3063d40dee46caf3210acdf563?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e26b9a3063d40dee46caf3210acdf563?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.southampton.ac.uk/~rp20g15/" class="url" rel="ugc external nofollow">Ryan Pepper</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-21T17:53:56+00:00">March 21, 2016 at 5:53 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve always found that the Numpy random number generators are very good if you&rsquo;re able to generate the numbers in advance and then draw from the sample. It is however much slower for generating single numbers. </p>
<p>I&rsquo;ve just tested on my own machine, and the main limiting factor seems to be the interfacing above the underlying C code, as it generates 10^10 integers in the range (0, 1000] in about 2 microseconds, and 10^4 in roughly the same time.</p>
</div>
</li>
<li id="comment-232811" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9e2af3eb210334bedb4094a38146b56b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9e2af3eb210334bedb4094a38146b56b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://janschulz.github.io" class="url" rel="ugc external nofollow">Jan Schulz</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-21T18:05:11+00:00">March 21, 2016 at 6:05 pm</time></a> </div>
<div class="comment-content">
<p>Jikes, it gets worse with a newer python:</p>
<p># python 2.7<br/>
Î» python -m timeit -s &ldquo;import random&rdquo; &ldquo;random.randint(0, 1000)&rdquo;<br/>
1000000 loops, best of 3: 1.64 usec per loop</p>
<p># python 3.5<br/>
[dev35] Î» python -m timeit -s &ldquo;import random&rdquo; &ldquo;random.randint(0, 1000)&rdquo;<br/>
100000 loops, best of 3: 2.2 usec per loop</p>
<p>Or use numpy if the problem is vectorizeable (one float -&gt; numpy array of floats), but even a single one seems to be faster:</p>
<p>[dev35] Î» python -m timeit -s &ldquo;import numpy&rdquo; &ldquo;numpy.random.randint(0, 1000)&rdquo;<br/>
1000000 loops, best of 3: 0.45 usec per loop</p>
<p># array of 1000 ints:<br/>
[dev35] Î» python -m timeit -s &ldquo;import numpy&rdquo; &ldquo;numpy.random.randint(0, 1000, 1000)&rdquo;<br/>
100000 loops, best of 3: 10.8 usec per loop</p>
</div>
</li>
<li id="comment-232813" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9e2af3eb210334bedb4094a38146b56b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9e2af3eb210334bedb4094a38146b56b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://janschulz.github.io" class="url" rel="ugc external nofollow">Jan Schulz</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-21T18:07:01+00:00">March 21, 2016 at 6:07 pm</time></a> </div>
<div class="comment-content">
<p>numba might also be a way to speed it up with a single additional line: <a href="https://jakevdp.github.io/blog/2015/02/24/optimizing-python-with-numpy-and-numba/" rel="nofollow ugc">https://jakevdp.github.io/blog/2015/02/24/optimizing-python-with-numpy-and-numba/</a></p>
</div>
</li>
<li id="comment-233105" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1495e0c0170a9621817dcd1fc0521e2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1495e0c0170a9621817dcd1fc0521e2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Petr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-23T11:43:35+00:00">March 23, 2016 at 11:43 am</time></a> </div>
<div class="comment-content">
<p>The slowdown was probably caused by Python folks recently making random() secure. See &ldquo;Python and crypto-strength random numbers by default&rdquo;<br/>
<a href="https://lwn.net/Articles/657269/" rel="nofollow ugc">https://lwn.net/Articles/657269/</a></p>
</div>
<ol class="children">
<li id="comment-233117" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-23T13:16:18+00:00">March 23, 2016 at 1:16 pm</time></a> </div>
<div class="comment-content">
<p>The problem seems to be present in versions of Python that predate this discussion by a long shot.</p>
</div>
</li>
</ol>
</li>
<li id="comment-280181" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/49c798a0da3c205612632ca6a263e5b3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/49c798a0da3c205612632ca6a263e5b3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://yellowrobot.xyz" class="url" rel="ugc external nofollow">Evalds Urtans</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-22T08:30:03+00:00">May 22, 2017 at 8:30 am</time></a> </div>
<div class="comment-content">
<p>On latest Python 2.7 numpy randint is not faster! In fact its 10x slower</p>
<p>python -m timeit -s &lsquo;import fastrand&rsquo; &lsquo;fastrand.pcg32bounded(1001)&rsquo;<br/>
10000000 loops, best of 3: 0.0994 usec per loop</p>
<p>python -m timeit -s &lsquo;import numpy&rsquo; &lsquo;numpy.random.randint(0, 1000)&rsquo;<br/>
1000000 loops, best of 3: 1.07 usec per loop</p>
</div>
</li>
<li id="comment-294588" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9e09d1864da79391326e2e28a16aed61?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9e09d1864da79391326e2e28a16aed61?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://camelcasenoodles.blogspot.com/" class="url" rel="ugc external nofollow">Nellie Tobey</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-07T00:52:52+00:00">January 7, 2018 at 12:52 am</time></a> </div>
<div class="comment-content">
<p>I can&rsquo;t say my tests are hard science, I&rsquo;ve only just started learning, but the random and randint seem to be interacting with the timeit() function in some peculiar way for me.</p>
<p>def test_spam():<br/>
foo = 41<br/>
for i in range(0, 10):<br/>
x = randint(0, 10)<br/>
spam(foo)</p>
<p>This took a little over 54 seconds by timeit()&rsquo;s calculations on my (not really old but slow) computer in powershell. Are there other timer tests to use in Python on the randint? I have only run 24 other small tests, but they all suggest something fishy is going on, and I have no idea if it&rsquo;s in my computer or the modules. </p>
</div>
<ol class="children">
<li id="comment-294589" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-07T00:55:53+00:00">January 7, 2018 at 12:55 am</time></a> </div>
<div class="comment-content">
<p>I do not understand your code. What does it do?</p>
</div>
<ol class="children">
<li id="comment-294593" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9e09d1864da79391326e2e28a16aed61?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9e09d1864da79391326e2e28a16aed61?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://camelcasenoodles.blogspot.com/" class="url" rel="ugc external nofollow">Nellie Tobey</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-07T02:42:15+00:00">January 7, 2018 at 2:42 am</time></a> </div>
<div class="comment-content">
<p>literally nothing&#8230;. I had a piece of code that crashed when I tried to use timeit on it, and I thought I traced it down to randint being used to create a Doubly linked list inside a bubble sort that was being tested. here&rsquo;s another one&#8230; that took 1600 s&#8230;.. </p>
<p>from random import randint</p>
<p>def test_spam();<br/>
foo = 41<br/>
for i in range(0, 299):<br/>
x = randint(0, 10)<br/>
spam(foo)</p>
<p>if __name__ == &lsquo;__main__&rsquo;:<br/>
import timeit<br/>
print(timeit.timeit(&ldquo;test_spam()&rdquo;, setup=&rdquo;from __main__<br/>
import test_spam&rdquo;))</p>
<p>that&rsquo;s it, just trying to see why randint and timeit crashed my original code.</p>
</div>
<ol class="children">
<li id="comment-294594" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9e09d1864da79391326e2e28a16aed61?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9e09d1864da79391326e2e28a16aed61?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://camelcasenoodles.blogspot.com/" class="url" rel="ugc external nofollow">Nellie Tobey</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-07T02:45:45+00:00">January 7, 2018 at 2:45 am</time></a> </div>
<div class="comment-content">
<p>I can&rsquo;t edit&#8230; I forgot the def spam():<br/>
def spam(x):<br/>
y = x + 1<br/>
return y</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-294598" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9e09d1864da79391326e2e28a16aed61?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9e09d1864da79391326e2e28a16aed61?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://camelcasenoodles.blogspot.com/" class="url" rel="ugc external nofollow">Nellie Tobey</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-07T06:27:16+00:00">January 7, 2018 at 6:27 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m so sorry&#8230;. I&rsquo;m new. I didn&rsquo;t know it had a default of 100000 runs&#8230;. no wonder!!! It still crashed my command but. sorry.</p>
</div>
</li>
<li id="comment-299814" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40d876b70aae3be06567d5db7f7a77da?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40d876b70aae3be06567d5db7f7a77da?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Roi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-02T11:40:58+00:00">April 2, 2018 at 11:40 am</time></a> </div>
<div class="comment-content">
<p>Can you somehow use this code to draw from a uniform distribution?</p>
</div>
<ol class="children">
<li id="comment-299817" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-02T13:12:08+00:00">April 2, 2018 at 1:12 pm</time></a> </div>
<div class="comment-content">
<p>The random numbers being generated follow a uniform distribution.</p>
</div>
<ol class="children">
<li id="comment-300272" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40d876b70aae3be06567d5db7f7a77da?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40d876b70aae3be06567d5db7f7a77da?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Roi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-08T13:48:23+00:00">April 8, 2018 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, I didn&rsquo;t phrase myself accurately. Can I use this to draw a random number from (0,1)?</p>
</div>
<ol class="children">
<li id="comment-300274" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-08T14:32:20+00:00">April 8, 2018 at 2:32 pm</time></a> </div>
<div class="comment-content">
<p>Given 32-bit uniformly distributed integers, you can generate 24-bit floats that appear at uniform locations within [0,1) by a computation such as <tt>(float)(RandomBitGenerator() &amp; 0xffffff) / (float)(1 &lt;&lt; 24)</tt>. Of course, you discard 8 bits. Python floats are 64 bits.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
