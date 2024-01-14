---
date: "2015-10-26 12:00:00"
title: "Crazily fast hashing with carry-less multiplications"
index: false
---

[12 thoughts on &ldquo;Crazily fast hashing with carry-less multiplications&rdquo;](/lemire/blog/2015/10-26-crazily-fast-hashing-with-carry-less-multiplications)

<ol class="comment-list">
<li id="comment-200484" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.jandrewrogers.com/" class="url" rel="ugc external nofollow">J. Andrew Rogers</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-26T23:02:57+00:00">October 26, 2015 at 11:02 pm</time></a> </div>
<div class="comment-content">
<p>What does the avalanche bias profile look like? One of the problems with most hash function families is that they trade quality for speed. As computing systems become larger and faster, bias in non-cryptographic hash functions starts to manifests as real pathologies in the software that uses them. The development of algorithms like MurmurHash, CityHash, etc were driven by this.</p>
<p>One of my motivations for the research that led to the MetroHash functions is that I needed non-cryptographic hash functions that were significantly faster than CityHash but which had randomness comparable to cryptographic functions (which you do not get from CityHash) for some use cases inside database engines. And it looked like an interesting research problem, of course.</p>
</div>
<ol class="children">
<li id="comment-200504" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-27T00:12:11+00:00">October 27, 2015 at 12:12 am</time></a> </div>
<div class="comment-content">
<p>You might be interested in Section 6.1 of our manuscript. We discuss SMHasher and the avalanche effect specifically.</p>
</div>
<ol class="children">
<li id="comment-200616" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jandrewrogers.com/" class="url" rel="ugc external nofollow">J. Andrew Rogers</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-27T06:14:52+00:00">October 27, 2015 at 6:14 am</time></a> </div>
<div class="comment-content">
<p>Thanks, I feel a little silly now for having not read that first. 🙂</p>
<p>Interesting stuff.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-200497" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/61b37304c7ed74039a1489c855cee69f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/61b37304c7ed74039a1489c855cee69f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jonathan Graehl</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-26T23:56:20+00:00">October 26, 2015 at 11:56 pm</time></a> </div>
<div class="comment-content">
<p>1. only competitive-speed on recent CPUs, right?</p>
<p>2. small key (64 bytes or less) performance is worse than xxHash ( <a href="https://github.com/Cyan4973/xxHash" rel="nofollow ugc">https://github.com/Cyan4973/xxHash</a> ) and Farmhash ( <a href="https://github.com/google/farmhash" rel="nofollow ugc">https://github.com/google/farmhash</a> ) which are both faster than City, but perhaps there&rsquo;s a weaker quality use of this instruction that can give something suitable e.g. for typical string-keyed hash tables? All I know about quality is that these all past smhasher, but perhaps they cheated a bit by tuning to meet those particular tests.</p>
</div>
<ol class="children">
<li id="comment-200507" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-27T00:21:10+00:00">October 27, 2015 at 12:21 am</time></a> </div>
<div class="comment-content">
<p>Note that CityHash, xxHash, Farmhash&#8230; are not universal. CLHash is XOR universal. (Almost so on long strings.)</p>
<p><em>1. only competitive-speed on recent CPUs, right?</em></p>
<p>Yes. On older CPUs, the carry-less multiplication had a low throughput (except maybe on AMD CPUs where it did better). This is reviewed in our earlier paper (<a href="http://arxiv.org/abs/1202.4961" rel="nofollow">Strongly universal string hashing is fast</a>).</p>
<p><em>2. small key (64 bytes or less) performance is worse (&#8230;) </em></p>
<p>For short strings, performance is likely driven by latency, and the carry-less multiplications have relatively high latency (7 cycles). So I expect it will be difficult to get really exciting results on short strings with carry-less multiplications, at least if you care about the latency of the hash function.</p>
</div>
</li>
</ol>
</li>
<li id="comment-200865" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3269941053f8bd056be12246e32f6f63?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3269941053f8bd056be12246e32f6f63?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Xandor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-27T17:52:58+00:00">October 27, 2015 at 5:52 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m sorry, I&rsquo;d like asking why it is possible to have a*4 == b*4 with a != b in a computer? Maybe I&rsquo;m missing some basic math but I can&rsquo;t see that.</p>
<p>Thank you.</p>
</div>
<ol class="children">
<li id="comment-200878" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-27T18:32:29+00:00">October 27, 2015 at 6:32 pm</time></a> </div>
<div class="comment-content">
<p>You can verify that, in Java, you have the following:</p>
<pre>
int a = 0;
int b = 1073741824;
a != b; // true
4 * a == 4 * b ; // true
</pre>
<p>The result is not Java specific of course, but I have to write the code in some language.</p>
</div>
<ol class="children">
<li id="comment-201887" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e11b1a6e56f360a2b3d751bdad48a95d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e11b1a6e56f360a2b3d751bdad48a95d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">PaweÅ‚ Boraca</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-29T23:51:08+00:00">October 29, 2015 at 11:51 pm</time></a> </div>
<div class="comment-content">
<p>In the post it says:<br/>
a * 4 == b * 4<br/>
whereas in your comment it&rsquo;s:<br/>
4 * a == a * b<br/>
Which is a totally different thing and I&rsquo;m still confused.</p>
</div>
<ol class="children">
<li id="comment-201898" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-30T00:27:54+00:00">October 30, 2015 at 12:27 am</time></a> </div>
<div class="comment-content">
<p>Let me try with actual code. </p>
<p>You can run the following Java program:</p>
<pre>
public class CrazyMath
{
  public static void main (String[] args) 
  {
    int a = 0;
    int b = 1073741824;
    System.out.println(4 * a == 4 * b);
  }
}
</pre>
<p>Or you can write the following C program:</p>
<pre>
#include <stdint.h>
#include <stdio.h>
int main() {
  uint32_t a = 0;
  uint32_t b = 1073741824;
  printf("%s\n",a*4==4*b?"equal":"not equal");
}
</pre>
<p>Or you can try the following Go program&#8230;</p>
<pre>
package main

import "fmt"

func main() {
	a:=0;
	b:=1073741824;
	fmt.Println(a*4==b*4);
}
</pre>
<p>And so forth, and so forth&#8230;</p>
<p>Please try it out for yourself.</p>
</div>
<ol class="children">
<li id="comment-208500" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba86cfd2c06c6c4c9bf8f08f7443ccd5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba86cfd2c06c6c4c9bf8f08f7443ccd5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris Rosendorf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-11-17T15:20:22+00:00">November 17, 2015 at 3:20 pm</time></a> </div>
<div class="comment-content">
<p>But isn&rsquo;t that because 1073741824 * 4 = 2^32 * 2? Where a 32bit integer cannot go beyond? Thus wrapping itself around to 0? (I havn&rsquo;t studied computer engineering, only been programming for a couple years, so only speaking from hands on experience, no theoretical knowledge, basically).</p>
</div>
<ol class="children">
<li id="comment-208510" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-11-17T15:53:56+00:00">November 17, 2015 at 3:53 pm</time></a> </div>
<div class="comment-content">
<p>Right. Most programming languages rely on integers spanning a finite and pre-determined number of bits. That&rsquo;s because this is how the underlying hardware works.</p>
<p>A language like Python will support arbitrary integers&#8230; this comes at a performance cost however.</p>
<p>JavaScript is just strange as it has no support for integers per se. The following is true in JavaScript&#8230;</p>
<p><code><br/>
100000000000000000==100000000000000001<br/>
</code></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-649673" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cecc488422aaddfa348a99a655fb08b9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cecc488422aaddfa348a99a655fb08b9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gabe Morales</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-06T09:33:28+00:00">March 6, 2023 at 9:33 am</time></a> </div>
<div class="comment-content">
<p>One use of carry-less multiplication I&rsquo;ve run across is morton encoding. Morton encoding is a process to produce an octree from a list of objects to retain locality of reference. Assuming a space of objects, if we take their X and Y (and Z and any other dimension) position as binary, then interleave the bitstring into one binary string, then order these resultant binary strings from 0000&#8230; to 1111&#8230;, we arrive at a Z-ordered curve where objects in our list that are physically close together are also close together in the list. This can reduce collision checks by orders of magnitude. The problem is the process for encoding a morton string is usually too slow for real time applications without dedicated opcodes (eg PDEP and PEXT) or memory-expensive LUTs.</p>
<p>Well, one neat side effect of carry-less multiplication is that any number multiplied by itself will yield the original bitstring interleaved with 0s, which is perfect for bitwise operation to combine into one morton code!</p>
</div>
</li>
</ol>
