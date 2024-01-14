---
date: "2020-04-26 12:00:00"
title: "Sampling efficiently from groups"
index: false
---

[17 thoughts on &ldquo;Sampling efficiently from groups&rdquo;](/lemire/blog/2020/04-26-sampling-efficiently-from-groups)

<ol class="comment-list">
<li id="comment-502985" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/94f14771a2d96015679f27a3baf791df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/94f14771a2d96015679f27a3baf791df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Melvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-27T06:46:17+00:00">April 27, 2020 at 6:46 am</time></a> </div>
<div class="comment-content">
<p>Vose&rsquo;s Alias method (see <a href="https://www.keithschwarz.com/darts-dice-coins/" rel="nofollow ugc">https://www.keithschwarz.com/darts-dice-coins/</a>) is another approach. It works in constant time with linear time preprocessing using only simple data structures.</p>
</div>
<ol class="children">
<li id="comment-503022" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-27T12:15:48+00:00">April 27, 2020 at 12:15 pm</time></a> </div>
<div class="comment-content">
<p>As you may notice in my blog post, I remove the students from the classrooms (without replacement). Do you know how to apply the Alias method to this scenario?</p>
<p>My expectation is that the Alias is not applicable to the scenario I describe.</p>
</div>
<ol class="children">
<li id="comment-503025" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/94f14771a2d96015679f27a3baf791df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/94f14771a2d96015679f27a3baf791df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Melvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-27T12:38:41+00:00">April 27, 2020 at 12:38 pm</time></a> </div>
<div class="comment-content">
<p>Apologies for the confusion, I did indeed miss out the fact that you are sampling without replacement. The dynamic case is an interesting one, thanks for introducing it.</p>
</div>
<ol class="children">
<li id="comment-503031" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-27T14:15:19+00:00">April 27, 2020 at 2:15 pm</time></a> </div>
<div class="comment-content">
<p>I was aware of the Alias method: I should have included it in the post to avoid confusion.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-503035" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f3aaf1d652b51904e4502dcede3ae2a8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f3aaf1d652b51904e4502dcede3ae2a8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">hernan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-27T14:39:27+00:00">April 27, 2020 at 2:39 pm</time></a> </div>
<div class="comment-content">
<p>Thanks as usual for the informative blog post! Very minor point, but I believe you can remove these lines 34+35 from your sample Java program <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2020/04/26/sample.java#L34" rel="nofollow ugc">here</a></p>
<p><code>int l = 0;<br/>
while((1&lt;&lt;l) &lt; histo.length) { l++; }<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-503169" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-28T12:00:49+00:00">April 28, 2020 at 12:00 pm</time></a> </div>
<div class="comment-content">
<p>I fixed it.</p>
</div>
</li>
</ol>
</li>
<li id="comment-503133" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jackrabbit.apache.org/oak/docs/index.html" class="url" rel="ugc external nofollow">Thomas Müller Graf</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-28T07:49:43+00:00">April 28, 2020 at 7:49 am</time></a> </div>
<div class="comment-content">
<p>This problem sounds related to <a href="https://en.wikipedia.org/wiki/Arithmetic_coding#Adaptive_arithmetic_coding" rel="nofollow ugc">adaptive arithmetic coding</a>, and the newer <a href="https://en.wikipedia.org/wiki/Asymmetric_numeral_systems" rel="nofollow ugc">asymmetric numeral systems (ANS)</a>.</p>
</div>
</li>
<li id="comment-503136" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b53e3475ab7164b049dd404ab0a89a0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b53e3475ab7164b049dd404ab0a89a0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-28T08:42:18+00:00">April 28, 2020 at 8:42 am</time></a> </div>
<div class="comment-content">
<p>Perhaps I am missing something fundamental in the problem description, but it seems to me that (a) repeatedly selecting students at random from classrooms, each of whose probability of being chosen is proportional to the number of students remaining in it, is identical to (b) simply making a list of all students, regardless of classroom, and shuffling that list randomly.</p>
<p>That is, it looks like the probabilities have been carefully defined so that each student always has a 1/k chance of being chosen, where k is total number of unchosen students at each iteration. How is that different from a straight shuffle or permutation operation?</p>
</div>
<ol class="children">
<li id="comment-503171" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-28T12:05:55+00:00">April 28, 2020 at 12:05 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;simply making a list of all students, regardless of classroom, and shuffling that list randomly&rdquo; => This requires N units of storage.</p>
<p>&ldquo;How is that different from a straight shuffle or permutation operation?&rdquo; => You are not allowed to do memory allocation beyond the maintenance of the histogram.</p>
</div>
<ol class="children">
<li id="comment-503265" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b53e3475ab7164b049dd404ab0a89a0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b53e3475ab7164b049dd404ab0a89a0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-28T19:55:33+00:00">April 28, 2020 at 7:55 pm</time></a> </div>
<div class="comment-content">
<p>Aha! I see. So the classrooms <em>must</em> be treated as black boxes. That is, we don&rsquo;t know the names or identities of the students in the rooms until after they are chosen; at the outset, we only know the number of students in each room, or the cardinality of each set we&rsquo;re drawing from. It is then up to the teacher (or some agent of the room) to choose a student at random when we choose a room.</p>
<p>So the goal is to use at most O(<em>K</em>) space, where <em>K</em> is the number of classrooms?</p>
<p>And the solution presented in the post runs in O(<em>N</em> log <em>K</em>) time, and we seek to know whether an alternative solution runs in less time or if this is already optimal?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-503269" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-28T20:10:45+00:00">April 28, 2020 at 8:10 pm</time></a> </div>
<div class="comment-content">
<p><em>And the solution presented in the post runs in O(N log K) time, and we seek to know whether an alternative solution runs in less time or if this is already optimal?</em></p>
<p>We know that if you are given a bit more storage, you can do better than O(N log K) time. It seems that O(N) is entirely within reach, but with extra storage. I&rsquo;d be interested to know whether one can do better using only the K units of storage (please don&rsquo;t turn it into O(K) units).</p>
</div>
<ol class="children">
<li id="comment-503281" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b53e3475ab7164b049dd404ab0a89a0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b53e3475ab7164b049dd404ab0a89a0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-28T21:26:09+00:00">April 28, 2020 at 9:26 pm</time></a> </div>
<div class="comment-content">
<p>Here is a thought: If we let S[k] be the number of students in classroom k (1 ≤ k ≤ K), then depending on the shape of the curve traced by the tuples (k,S[k]), it may be possible to model the curve in such a way that S[k] can be roughly predicted from k, and vice-versa.</p>
<p>That is, given a random number n (1 ≤ n ≤ N), we can compute two boundaries k₁ and k₂ from which to encapsulate a binary search for the exact k from which the cumulative sum of S[k] terms represent the value n.</p>
<p>Ultimately, however, this is still a binary search for the ordinal number of classroom implied by n—and thus still O(N log K)—and is probably not likely to be faster in practice, unless the shape of the curve of classroom sizes is ideally modelable.</p>
</div>
<ol class="children">
<li id="comment-503283" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-28T21:32:00+00:00">April 28, 2020 at 9:32 pm</time></a> </div>
<div class="comment-content">
<p>Actually, Todd, I think that this may well work in practice.</p>
<p><a href="https://en.wikipedia.org/wiki/Interpolation_search" rel="nofollow ugc">https://en.wikipedia.org/wiki/Interpolation_search</a></p>
<p>I am just not quite sure how to adapt it.</p>
<p>Do you have, by any chance, workable pseudocode?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-503428" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d26034a16369272528e8f323c5f3660?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d26034a16369272528e8f323c5f3660?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">randomPoster</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-29T08:58:05+00:00">April 29, 2020 at 8:58 am</time></a> </div>
<div class="comment-content">
<p>Your benchmark is a bit misleading: if you want all the students, just put all of them in the output and shuffle.</p>
<p>If you want less than a fraction of the students (let&rsquo;s say 3 out of 4), and the distribution is not too skewed, a simple linear search with rejection sampling would work well in practice.</p>
<p><code>public static int rejectRandomSample(int[] histo, int[] output, int outputSize) {<br/>
int [] currentHisto = Arrays.copyOf(histo, histo.length);<br/>
int [] runningHisto = new int [histo.length+1];<br/>
System.arraycopy(histo, 0, runningHisto, 1, histo.length);<br/>
for (int i = 2; i &lt;= histo.length; i++)<br/>
runningHisto[i] += runningHisto[i-1];</p>
<p> int sum = runningHisto[histo.length];<br/>
int averageSize = sum / histo.length;<br/>
for(int pos = 0; pos &lt; outputSize; ++pos) {<br/>
int i = -1;<br/>
while (true) {<br/>
int y = r.nextInt(sum);<br/>
i = y / averageSize; // hope the data is not too skewed<br/>
while ( runningHisto[i] &gt; y) i -= 1;<br/>
while (runningHisto[i+1] &lt;= y) i += 1;<br/>
if (currentHisto[i] &gt; y - runningHisto[i]) {<br/>
currentHisto[i] -= 1;<br/>
break;<br/>
}<br/>
}<br/>
output[pos] = i;<br/>
}<br/>
return outputSize;<br/>
}<br/>
</code></p>
<p>I obtain the following benchmarks on my machine:</p>
<p><code>N=1024, M=100000<br/>
outputSize = s / 4<br/>
naive 260.04551556738215<br/>
smarter 74.68069439333325<br/>
reject 40.423464682798844<br/>
outputSize = 3 * s / 4<br/>
naive 258.509821210682<br/>
smarter 76.47785267880008<br/>
reject 65.39425675586646<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-503457" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-29T12:14:33+00:00">April 29, 2020 at 12:14 pm</time></a> </div>
<div class="comment-content">
<p>You may want all students but may not be able, at any one time, to allocate memory. Thanks for your code.</p>
</div>
<ol class="children">
<li id="comment-503484" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d26034a16369272528e8f323c5f3660?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d26034a16369272528e8f323c5f3660?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">randomPoster</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-29T15:13:17+00:00">April 29, 2020 at 3:13 pm</time></a> </div>
<div class="comment-content">
<p>To avoid the penalty when currentSum is low, you can also recompute the runningHisto regularly. Something like:</p>
<p><code>public static int rejectRandomSample(int[] histo, int[] output, int outputSize) {<br/>
int [] currentHisto = Arrays.copyOf(histo, histo.length);<br/>
int [] runningHisto = new int [histo.length+1];<br/>
int sum = 1;<br/>
int currSum = 0;<br/>
int averageSize = 0;<br/>
for(int pos = 0; pos &lt; outputSize; ++pos) {<br/>
if (sum * .95 &gt; currSum) {<br/>
System.arraycopy(currentHisto, 0, runningHisto, 1, histo.length);<br/>
for(int i = 2; i &lt;= histo.length; i++)<br/>
runningHisto[i] += runningHisto[i-1];<br/>
sum = runningHisto[histo.length];<br/>
currSum = sum;<br/>
averageSize = (sum / histo.length) + 1;<br/>
}<br/>
int i = -1;<br/>
while (true) {<br/>
int y = r.nextInt(sum);<br/>
i = y / averageSize; // hope the data is not too skewed<br/>
while ( runningHisto[i] &gt; y) i -= 1;<br/>
while (runningHisto[i+1] &lt;= y) i += 1;<br/>
if (currentHisto[i] &gt; y - runningHisto[i]) {<br/>
currentHisto[i] -= 1;<br/>
break;<br/>
}<br/>
}<br/>
output[pos] = i;<br/>
currSum -= 1;<br/>
}<br/>
return outputSize;<br/>
}<br/>
</code></p>
<p>gives me</p>
<p><code>naive 250.25992953739302<br/>
smarter 74.97430178092274<br/>
reject 42.24443463267574<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-503487" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d26034a16369272528e8f323c5f3660?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d26034a16369272528e8f323c5f3660?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">randomPoster</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-29T15:33:54+00:00">April 29, 2020 at 3:33 pm</time></a> </div>
<div class="comment-content">
<p>Just FTR, the last timings are for &ldquo;outputSize = s&rdquo; which means get all students.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
