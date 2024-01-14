---
date: "2010-03-12 12:00:00"
title: "Which is faster: integer addition or XOR?"
index: false
---

[20 thoughts on &ldquo;Which is faster: integer addition or XOR?&rdquo;](/lemire/blog/2010/03-12-which-is-fastest-integer-addition-or-xor)

<ol class="comment-list">
<li id="comment-52327" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43314a37c30454481331eb4e4c604657?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43314a37c30454481331eb4e4c604657?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://fpgacpu.ca/" class="url" rel="ugc external nofollow">Eric LaForest</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-12T20:32:49+00:00">March 12, 2010 at 8:32 pm</time></a> </div>
<div class="comment-content">
<p>Unless there is more context here, there should be no difference, as both ops map to a single-cycle operation on modern processors. Arbitrary-precision numbers maybe?</p>
<p>However, at the pure hardware level, XOR is faster than addition since there is no carry bit, but other details obscure that and for all practical purposes, they run at the same speed as instructions.</p>
</div>
</li>
<li id="comment-52328" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dada9de44173d6c1b13691554ef8e974?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dada9de44173d6c1b13691554ef8e974?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://faculty.washington.edu/stiber/" class="url" rel="ugc external nofollow">Mike Stiber</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-12T20:32:55+00:00">March 12, 2010 at 8:32 pm</time></a> </div>
<div class="comment-content">
<p>They&rsquo;re probably both the same number of machine cycles, if only because there&rsquo;s no way for an ALU to take advantage of fewer stages of transistors in the XOR versus the ADD (the outputs of the combinatorial logic are just latched into the output after the same amount of time regardless of the operation of that type. Is integer multiplication any different these days (I&rsquo;m too lazy to check for myself)?</p>
</div>
</li>
<li id="comment-52330" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-12T20:48:32+00:00">March 12, 2010 at 8:48 pm</time></a> </div>
<div class="comment-content">
<p>@LaForest Yes, I agree. </p>
<p>@Stiber</p>
<p>Multiplication might run at the same speed, but you have to use a different test.</p>
</div>
</li>
<li id="comment-52332" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.google.com/reader/about/" class="url" rel="ugc external nofollow">Philippe Beaudoin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-12T23:23:58+00:00">March 12, 2010 at 11:23 pm</time></a> </div>
<div class="comment-content">
<p>XOr requires less transistor than addition. This is one measure of complexity on which XOr wins.</p>
<p>XOr would probably be harder to teach to my kid than sums. This is a measure of complexity on which addition wins.</p>
<p>We have a stalemate&#8230;</p>
<p>(As a sidenote, have you thought of updating your spam protection mechanism to ask for XOrs instead of sums? ;))</p>
</div>
</li>
<li id="comment-52331" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-12T22:17:43+00:00">March 12, 2010 at 10:17 pm</time></a> </div>
<div class="comment-content">
<p>The answer is going to depend on the CPU. </p>
<p>For anything like current desktop and server CPUs, they use a ridiculous amount of hardware to accelerate a single instruction stream. Both operations are common and pretty much dead simple, so I&rsquo;d expect both to be among the very-fastest instructions.</p>
<p>This is likely true of embedded CPUs, like those used in the iPad and cell phones.</p>
<p>Multiplication might show a bigger difference (compared to simpler operations) between high-end and low-end CPUs.</p>
</div>
</li>
<li id="comment-52335" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e332baa06ba42512a86fd854d215f967?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e332baa06ba42512a86fd854d215f967?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.ics.uci.edu/~ajfrank/" class="url" rel="ugc external nofollow">Drew Frank</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-13T03:44:16+00:00">March 13, 2010 at 3:44 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m finding that when I compile with gcc, xor is 10-20% faster. When I compile the same code with g++, add is about 10% faster. Here is the code I used: <a href="http://pastebin.com/PzmmFsai" rel="nofollow ugc">http://pastebin.com/PzmmFsai</a> .</p>
<p>uname -a ouputs:<br/>
Linux lappy 2.6.32-ARCH #1 SMP PREEMPT Tue Feb 23 19:43:46 CET 2010 x86_64 Intel(R) Core(TM)2 Duo CPU T7500 @ 2.20GHz GenuineIntel GNU/Linux</p>
<p>And I&rsquo;m using gcc 4.4.3.</p>
</div>
</li>
<li id="comment-52336" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/afc856c8333249372ce6997203368854?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/afc856c8333249372ce6997203368854?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://dos.iitm.ac.in" class="url" rel="ugc external nofollow">Harisankar H</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-13T04:22:51+00:00">March 13, 2010 at 4:22 am</time></a> </div>
<div class="comment-content">
<p>Isn&rsquo;t this because there are complex carry lookahead adder circuitry already incorporated in the hardware ? XOR is a bit wise parallel simpler operation. So in that sense, ADD finishes at the same<br/>
same as XOR because hardware has been optimised for AND.</p>
</div>
</li>
<li id="comment-52339" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-13T10:44:54+00:00">March 13, 2010 at 10:44 am</time></a> </div>
<div class="comment-content">
<p>@Frank With the same code, and testing over many runs, I get that both run at the same speed. </p>
<p>I have modified your code so that it loops around more:</p>
<p><a href="http://pastebin.com/mEZBBYKZ" rel="nofollow ugc">http://pastebin.com/mEZBBYKZ</a></p>
<p><code><br/>
$ g++ -O2 -o code1 code1.cpp<br/>
$ g++ -O2 -o code2 code2.cpp<br/>
$ time ./code1 9999999<br/>
real 0m5.953s<br/>
user 0m5.944s<br/>
sys 0m0.002s<br/>
$ time ./code2 9999999<br/>
real 0m5.974s<br/>
user 0m5.971s<br/>
sys 0m0.002s<br/>
</code></p>
</div>
</li>
<li id="comment-52340" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-13T10:47:57+00:00">March 13, 2010 at 10:47 am</time></a> </div>
<div class="comment-content">
<p>@Bannister I have a bunch of counter-measures against spammers for this blog. They work very well, but a small percentage of spam is unavoidable. I prune spam comments every day, believe it or not.</p>
</div>
</li>
<li id="comment-52338" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-13T06:47:19+00:00">March 13, 2010 at 6:47 am</time></a> </div>
<div class="comment-content">
<p>Well Daniel, you have achieved a measure of success with your weblog &#8211; the spammers have arrived, despite your protection.</p>
<p>Either that, or we have someone (a student?) with an odd sense of humor.</p>
</div>
</li>
<li id="comment-52341" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-13T15:08:45+00:00">March 13, 2010 at 3:08 pm</time></a> </div>
<div class="comment-content">
<p>Folk, you are wasting your time comparing XOR against addition &#8211; both are dirt cheap and going to take the minimum amount of time possible for an instruction that takes two operands and stores a result.</p>
<p>The difference in complexity between the two operations (if any) is insignificant compared to the transistor budget of the CPU designer, and has been for a couple decades.</p>
<p>If you find a difference, it will be to either (1) a measurement error, or (2) something wonky in your favorite language interpreter.</p>
<p>I used to pay a lot of attention to CPU architecture, counting clock cycles per instruction, and writing benchmarks to verify the variants of instruction sequences. As the CPU designers got a bigger transistor budget, they dropped in bigger circuit blocks to perform common operations in a single cycle, or as close as possible. </p>
<p>I was delighted when CPUs got barrel shifters. Ever try to write efficient graphics ops when bit-shift time is linear to the size of the shift? That was a long time back. (And I found a solution.)</p>
<p>When the Intel 486 came out, I lost interest. Most common operations were at that point were very fast. </p>
<p>There is another aspect to this. The unique logic in a CPU is like lines of code in software (and VLSI design became more like software design). Since then CPUs have become very large programs indeed. Large programs almost invariably have bugs. We normally attribute failures to bugs in software, but some are bugs in hardware, and we do not know the proportion.</p>
<p>With current CPUs, massive hardware and overlapped speculative execution has even removed or minimized the cost of subroutine calls and pointer chasing &#8211; in many cases. Instruction clock-cycle counting has not been effective for a long time.</p>
</div>
</li>
<li id="comment-54274" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8ed4f763e1e780d28e61e0a2cec11c86?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8ed4f763e1e780d28e61e0a2cec11c86?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Hessler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-12T22:48:08+00:00">March 12, 2011 at 10:48 pm</time></a> </div>
<div class="comment-content">
<p>FYI: Any test that counts the number of cpu cycles is going to have issues (this is essentially due to the Heisenberg uncertainty principle). Also, to answer a question from above, multiplication (i.e. the IMULT assembly command) usually runs at about 4 clock cycles. However, this is only when you are doing a lot of multiplication. If you are doing only a few this speed is slower. See an discussion of optimized multiplexers for more understanding. Also, if the two number being multiplied are greater than the size of register (ie. 32 bits or 64 bits) the speed is O(lg(n)) where n is the number of bits. While this may seem odd to mention, it is very common on any system doing cryptological calculation (particular those for the ElGamal and RSA encryption systems).</p>
</div>
</li>
<li id="comment-54709" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7594ecd7da7469a887e9a98d885b94fa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7594ecd7da7469a887e9a98d885b94fa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ethanara</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-10T05:19:17+00:00">September 10, 2011 at 5:19 am</time></a> </div>
<div class="comment-content">
<p>I have done the same experiment but with xor and sub, since k -= k is 0 and k ^= k is also 0<br/>
the result is :<br/>
sub : 151 secs. (7 tries)<br/>
xor : 171 secs. (also 7 tries)<br/>
this shows that sub is faster</p>
<p>Code:</p>
<p>#include </p>
<p>using namespace std;</p>
<p>int main()<br/>
{<br/>
int k = 1000;<br/>
for(int i= 0 ; i&lt;10000; i++)<br/>
{<br/>
k -= k;<br/>
cout &lt;&lt; i &lt;&lt; endl;<br/>
k = 1000;</p>
<p> }<br/>
}</p>
<p>and </p>
<p>#include </p>
<p>using namespace std;</p>
<p>int main()<br/>
{<br/>
int k = 1000;<br/>
for(int i= 0 ; i&lt;10000; i++)<br/>
{<br/>
k ^= k;<br/>
cout &lt;&lt; i &lt;&lt; endl;<br/>
k = 1000;</p>
<p> }<br/>
}</p>
</div>
</li>
<li id="comment-54711" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/18d385a3c64005b7b0b5dfdeea7af5ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/18d385a3c64005b7b0b5dfdeea7af5ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ed rowland</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-10T23:51:24+00:00">September 10, 2011 at 11:51 pm</time></a> </div>
<div class="comment-content">
<p>Addition takes longer to compute in *hardware* because the carry bit has to be propogated through N sequential calculations &#8212; each of which involves gate delays. When computing XOR, each bit can be calculated in parallel. </p>
<p>Whether it takes longer on a particular hardware implementation is implementation-dependent. Instruction timing on state-of-the-art Intel processors is complicated, to say the least. But, according to the Intel Architecture Optimization Manula, On intel architectures, The pair of integer ALU pipeline stages can each execute xor and addition operations in one clock cycle. They execute at exactly the same speed.</p>
<p>That&rsquo;s true for Pentium and later processors. It&rsquo;s possible that smaller and leaner processors do have different execution times for XOR and ADD; but I would think that &#8212; given the prevalence of addition operations in computing, that even tiny processors would use the propogation delay time of an addition operation would for the low limit for a single pipleline stage in any modern microprocess, and all or almost all ancient ones as well. (Despite having taken high-school latin, I also think your spam filter is inappropriate).</p>
</div>
</li>
<li id="comment-54798" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/707ef1a39f2bdb8338a1f775db89c5d6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/707ef1a39f2bdb8338a1f775db89c5d6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Aloz1</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-11-19T17:21:18+00:00">November 19, 2011 at 5:21 pm</time></a> </div>
<div class="comment-content">
<p>Would it not be wise and slightly more accurate if you were using unsigned integers?</p>
</div>
</li>
<li id="comment-59724" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">A</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-17T07:32:39+00:00">November 17, 2012 at 7:32 am</time></a> </div>
<div class="comment-content">
<p>@ethanara<br/>
cout is a very complex command and takes a lot of time so in your case it is messing up your timings.</p>
</div>
</li>
<li id="comment-62178" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/130b55e1d8296fe66fffc9aa25098719?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/130b55e1d8296fe66fffc9aa25098719?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.whatsacreel.net76.net/" class="url" rel="ugc external nofollow">Chris</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-12-15T18:49:28+00:00">December 15, 2012 at 6:49 pm</time></a> </div>
<div class="comment-content">
<p>Agner Fog reckons latency and throughput is the same for XOR and ADD on all the CPU&rsquo;s I&rsquo;ve looked at, Agner Fog&rsquo;s word is pretty much Gospel. So if we&rsquo;re not talking about hardware and transistors, the actual computation times in clock cycles are identical.</p>
</div>
</li>
<li id="comment-71708" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd400ef33efea0f2dbfeee519737bf58?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd400ef33efea0f2dbfeee519737bf58?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sebastiano Vigna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-12T10:34:04+00:00">February 12, 2013 at 10:34 am</time></a> </div>
<div class="comment-content">
<p>First, looping on one instruction is useless. The cost of looping is much larger than the cost of the instruction. There&rsquo;s no way you can understand whether xor is faster with a single-instruction loop.</p>
<p>So I put together the test below. It does 16 instructions per loop, so the cost of the loop is reduced by an order of magnitude.</p>
<p>Compile with -DOP=&rdquo;^=&rdquo; for xor and -DOP=&rdquo;+=&rdquo; for addition. My results:</p>
<p>&gt; ./testx<br/>
197000 us<br/>
15:50:19 [lithium] /tmp<br/>
&gt; ./testp<br/>
474000 us</p>
<p>+= is 2.5 times slower.</p>
<p>The problem is that if you look at the disassembled code, the compiler is doing a *lot* of rearrangement in the xor version (don&rsquo;t try to take the ++&rsquo;s out&#8211;it will excise almost all the code). In general, xor satisfies so many useful equations that it is incredibibly difficult to convince the compiler not to change radically your code. It is possible that fiddling some more you can convince the compiler to actually do those xor in that order, but I think I made my point: if you need to add, you must add. xor is absolutely fine if you need just to ensure data dependency, but it cannot replace an add.</p>
<p><code><br/>
uint64_t getusertime() {<br/>
struct rusage rusage;<br/>
getrusage( 0, &amp;rusage );<br/>
return rusage.ru_utime.tv_sec * 1000000ULL + ( rusage.ru_utime.tv_usec / 1000 ) * 1000;<br/>
}<br/>
int main(int argc, char *argv[]) {<br/>
int64_t val0 = time(NULL);<br/>
int64_t val1 = time(NULL);<br/>
int64_t val2 = time(NULL);<br/>
int64_t val3 = time(NULL);<br/>
int64_t val4 = time(NULL);<br/>
int64_t val5 = time(NULL);<br/>
int64_t val6 = time(NULL);<br/>
int64_t val7 = time(NULL);<br/>
int64_t val8 = time(NULL);<br/>
int64_t val9 = time(NULL);<br/>
int64_t val10 = time(NULL);<br/>
int64_t val11 = time(NULL);<br/>
int64_t val12 = time(NULL);<br/>
int64_t val13 = time(NULL);<br/>
int64_t val14 = time(NULL);<br/>
int64_t val15 = time(NULL);<br/>
int64_t x = 0;<br/>
const int64_t start = getusertime();<br/>
for( int64_t i = 100000000LL; i--; ) {<br/>
x OP val0++;<br/>
x OP val1++;<br/>
x OP val2++;<br/>
x OP val3++;<br/>
x OP val4++;<br/>
x OP val5++;<br/>
x OP val6++;<br/>
x OP val7++;<br/>
x OP val8++;<br/>
x OP val9++;<br/>
x OP val10++;<br/>
x OP val11++;<br/>
x OP val12++;<br/>
x OP val13++;<br/>
x OP val14++;<br/>
x OP val15++;<br/>
}<br/>
int64_t volatile do_not_excise = x;<br/>
const int64_t elapsed = getusertime() - start;<br/>
printf("%lld us\n", elapsed );<br/>
return 0;<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-378560" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b859e41a3b1fe82a72bc70503483c408?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b859e41a3b1fe82a72bc70503483c408?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">WrongAnswer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-03T15:23:07+00:00">January 3, 2019 at 3:23 pm</time></a> </div>
<div class="comment-content">
<p>But I got same speeds&#8230;&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-240025" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc9af3c3dc25605641a390621e3cb23e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc9af3c3dc25605641a390621e3cb23e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://homes.cs.washington.edu/~cdel/" class="url" rel="ugc external nofollow">Carlo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-13T17:32:35+00:00">May 13, 2016 at 5:32 pm</time></a> </div>
<div class="comment-content">
<p>Yea, I just confirmed Sebastiano Vigna&rsquo;s results. I&rsquo;m getting about 2.3x improvement on XOR vs. IADD. I compiled with &ldquo;g++ testadd.cpp -lprofiler -Wall -O3 -o testadd&rdquo; and &ldquo;g++ testxor.cpp -lprofiler -Wall -O3 -o testxor&rdquo; and optimized with a 4-way unrolled loop for both programs.</p>
</div>
</li>
</ol>
