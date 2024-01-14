---
date: "2018-04-12 12:00:00"
title: "For greater speed, try batching your out-of-cache data accesses"
index: false
---

[14 thoughts on &ldquo;For greater speed, try batching your out-of-cache data accesses&rdquo;](/lemire/blog/2018/04-12-for-greater-speed-try-batching-your-out-of-cache-data-accesses)

<ol class="comment-list">
<li id="comment-300558" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dcddae70351aff62451086cd399801f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dcddae70351aff62451086cd399801f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Matthew Wozniczka</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-13T01:34:32+00:00">April 13, 2018 at 1:34 am</time></a> </div>
<div class="comment-content">
<p>Are you missing a &lsquo;- 1&rsquo; in your assert?</p>
</div>
<ol class="children">
<li id="comment-300593" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-13T15:15:00+00:00">April 13, 2018 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p>I corrected the typo.</p>
</div>
</li>
</ol>
</li>
<li id="comment-300586" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-13T12:52:30+00:00">April 13, 2018 at 12:52 pm</time></a> </div>
<div class="comment-content">
<p>There is an interesting recent post by ryg on this topic: <a href="http://%20https://fgiesen.wordpress.com/2018/03/05/a-whirlwind-introduction-to-dataflow-graphs/" rel="nofollow">A whirlwind introduction to dataflow graphs</a></p>
</div>
</li>
<li id="comment-300655" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-14T11:29:54+00:00">April 14, 2018 at 11:29 am</time></a> </div>
<div class="comment-content">
<p>There must be something off here. First I thought it could be a difference in Hardware Prefetcher or Loop Optimizer. But that didn&rsquo;t make sense when debugging. So I dived into the generated code for the <code>sumrandom</code> function first:</p>
<p><code>uint64_t sumrandom(uint64_t *values, size_t size) {<br/>
uint64_t sum = 0;<br/>
for (size_t k = 0; k &lt; size; ++k) {<br/>
sum += values[murmur32(k) % size ]; // dependency!<br/>
}<br/>
return sum;<br/>
}<br/>
</code></p>
<p>Checking the <strong>memory access dependency</strong> some nasty instruction pops up:</p>
<p><code>.L25:<br/>
movl %ecx, %eax<br/>
shrl $16, %eax<br/>
xorl %ecx, %eax<br/>
addq $1, %rcx<br/>
imull $-2048144789, %eax, %eax<br/>
movl %eax, %edx<br/>
shrl $13, %edx<br/>
xorl %edx, %eax<br/>
imull $-1028477387, %eax, %eax<br/>
movl %eax, %edx<br/>
shrl $16, %edx<br/>
xorl %edx, %eax<br/>
xorl %edx, %edx<br/>
divq %rsi # rdx:rax /= rsi EXPENSIVE<br/>
addq (%rdi,%rdx,8), %r8 # r8 += rdi[ rdx * 8 ]<br/>
cmpq %rcx, %rsi<br/>
jne .L25<br/>
</code></p>
<p>The latency cost of the hashing will be in the <strong>modulo</strong> for <code>murmur32(k) % size</code> as it requires a 64 bit <strong>division</strong>. Agner reports <strong>21-83 cycles</strong>. If we make the size of the hash table a power of 2 the compiler can get the hash bits with a mask using <code>andl</code> instead of the expensive <code>divq</code>.</p>
<p>If we change</p>
<p><code>void demo() {<br/>
size_t N = 1024 * 1024 * 16; // 16M instead of 13M<br/>
</code></p>
<p>the divq goes away:</p>
<p><code>.L25:<br/>
movl %ecx, %edx<br/>
shrl $16, %edx<br/>
xorl %ecx, %edx<br/>
addq $1, %rcx<br/>
imull $-2048144789, %edx, %edx<br/>
movl %edx, %esi<br/>
shrl $13, %esi<br/>
xorl %esi, %edx<br/>
imull $-1028477387, %edx, %edx<br/>
movl %edx, %esi<br/>
shrl $16, %esi<br/>
xorl %esi, %edx<br/>
andl $16777215, %edx # and to 0xFFFFFF, no divq<br/>
addq (%rdi,%rdx,8), %rax<br/>
cmpq $16777216, %rcx<br/>
jne .L25<br/>
</code></p>
<p>Comparing <strong>13M table size</strong> bench:</p>
<p><code>cc -march=native -O3 -o batchload batchload.c<br/>
[demo] N= 13631488<br/>
populaterandom(indexes, N) : 6.064 cycles per operation (best)<br/>
sumrandom(values, N) : 52.113 cycles per operation (best) 52.556 cycles per operation (avg)<br/>
sumrandomandindexes(values, indexes, N) : 37.835 cycles per operation (best) 38.245 cycles per operation (avg)<br/>
sumrandomfromindexes(values, indexes, N) : 30.716 cycles per operation (best) 31.593 cycles per operation (avg)<br/>
</code></p>
<p>with <strong>16M table size</strong> bench:</p>
<p><code>cc -march=native -O3 -o batchload batchload.c<br/>
[demo] N= 16777216<br/>
populaterandom(indexes, N) : 1.733 cycles per operation (best)<br/>
sumrandom(values, N) : 37.639 cycles per operation (best) 38.143 cycles per operation (avg)<br/>
sumrandomandindexes(values, indexes, N) : 34.819 cycles per operation (best) 35.196 cycles per operation (avg)<br/>
sumrandomfromindexes(values, indexes, N) : 32.992 cycles per operation (best) 33.326 cycles per operation (avg)<br/>
</code></p>
<p><strong>performance now is practically the same</strong>. So the latency for the murmur hash <strong>and the modulo operation</strong> must be 15+ cycles. It&rsquo;s quite good for having a division involved. So the savings come from removing a dependency on the hash table address calculation.</p>
<p>Mystery solved 🙂</p>
</div>
<ol class="children">
<li id="comment-300658" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-14T12:03:36+00:00">April 14, 2018 at 12:03 pm</time></a> </div>
<div class="comment-content">
<p>I enjoyed your comment, but how does it solve the mystery? Can you elaborate?</p>
</div>
</li>
</ol>
</li>
<li id="comment-300660" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-14T12:47:46+00:00">April 14, 2018 at 12:47 pm</time></a> </div>
<div class="comment-content">
<p>Oh, sorry, forgot to make it clear. From the post you mention the cost of <strong>hashing is 7 cycles yet</strong> removing the dependency showed <strong>savings of 15+ cycles</strong>. That didn&rsquo;t add up.</p>
<p>Another interesting thing is why is it <em>only 15 cycles</em> given the <code>divq</code> taking in theory 21+ cycles. Well, the compiler generated another version of the function with <strong>constant propagation</strong> that uses a <strong>multiplicative inverse</strong>:</p>
<p><code>sumrandom.constprop.2:<br/>
.LFB50:<br/>
.cfi_startproc<br/>
xorl %r8d, %r8d<br/>
xorl %esi, %esi<br/>
movabsq $5675921253449092805, %r9 # multiplicative inverse of 13<br/>
.p2align 4,,10<br/>
.p2align 3<br/>
.L11:<br/>
movl %esi, %ecx<br/>
shrl $16, %ecx<br/>
xorl %esi, %ecx<br/>
addq $1, %rsi<br/>
imull $-2048144789, %ecx, %ecx<br/>
movl %ecx, %eax<br/>
shrl $13, %eax<br/>
xorl %eax, %ecx<br/>
imull $-1028477387, %ecx, %ecx<br/>
movl %ecx, %eax<br/>
shrl $16, %eax<br/>
xorl %eax, %ecx<br/>
movq %rcx, %rax<br/>
mulq %r9 # rdx:rax *= 13's mul inverse<br/>
shrq $22, %rdx # rdx &gt;&gt;= 22 ...<br/>
leaq (%rdx,%rdx,2), %rax<br/>
leaq (%rdx,%rax,4), %rax<br/>
salq $20, %rax<br/>
subq %rax, %rcx<br/>
addq (%rdi,%rcx,8), %r8<br/>
cmpq $13631488, %rsi<br/>
jne .L11<br/>
movq %r8, %rax<br/>
ret<br/>
</code></p>
<p>For people missing this trick, here is <a href="http://clomont.com/efficient-divisibility-testing/" rel="nofollow">an article on multiplicative inverse trick</a> for modulus. Compilers take advantage of <a href="http://www.nynaeve.net/?p=64" rel="nofollow">address calculation with leaq for speed</a>. Still this is much more expensive than a simple <code>andl</code> mask. Probably why it&rsquo;s 15 cycles instead of 21+.</p>
</div>
<ol class="children">
<li id="comment-300662" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-14T13:35:26+00:00">April 14, 2018 at 1:35 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Still this is much more expensive than a simple andl mask. Probably why it&rsquo;s 15 cycles instead of 21+.
</p></blockquote>
<p>I meant to say</p>
<blockquote><p>
Still this calculation is much more expensive than a simple andl mask. It probably raises the <em>total</em> cost of hashing to 15 cycles* instead of 21+. And it shows when there&rsquo;s a direct dependency for the memory access.
</p></blockquote>
</div>
</li>
</ol>
</li>
<li id="comment-300680" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-14T17:39:02+00:00">April 14, 2018 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>Forgot to say, IMHO perf reporting cache misses is misleading.</p>
</div>
</li>
<li id="comment-300705" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-15T08:11:26+00:00">April 15, 2018 at 8:11 am</time></a> </div>
<div class="comment-content">
<p>Avoid the division (in modulo).</p>
<p>It kills <strong>pipelining</strong>: the addition depends on the division, so it has to wait for it.</p>
<p>In the array-cached variant, you allow pipelining the divisions by removing the dependency; the subsequent lookups are probably much faster than the divisions. I can only speculate that the cache misses go down because of additional pipelining in the second loop.</p>
</div>
</li>
<li id="comment-300761" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-16T08:14:29+00:00">April 16, 2018 at 8:14 am</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s a comment from Saturday awaiting moderation due to it having external links. In that comment I show the version of the function benchmarked is another one with <code>constant propagation</code>. So it doesn&rsquo;t do divq but it does the division via 13&rsquo;s <code>multiplicative inverse</code>, which is somewhat faster.</p>
<p>So, to complete the analysis, here is again the original version:</p>
<p><code>cc -march=native -O3 -o batchload batchload.c<br/>
[demo] N= 13631488<br/>
populaterandom(indexes, N) : 6.075 cycles per operation (best)<br/>
sumrandom(values, N) : 51.834 cycles per operation (best) 51.904 cycles per operation (avg)<br/>
sumrandomandindexes(values, indexes, N) : 36.707 cycles per operation (best) 36.962 cycles per operation (avg)<br/>
sumrandomfromindexes(values, indexes, N) : 31.528 cycles per operation (best) 31.754 cycles per operation (avg)<br/>
</code></p>
<p>And now let&rsquo;s compare with bringing N from outside so it can&rsquo;t use a constant:</p>
<p><code>void demo( const int m ) {<br/>
size_t N = 1024 * 1024 * m;</p>
<p> printf("[demo] N= %zu \n", N);</p>
<p> uint64_t *values = malloc(N * sizeof(uint64_t));<br/>
uint32_t *indexes = malloc(N * sizeof(uint32_t));<br/>
for (size_t i = 0; i &lt; N; i++) {<br/>
values[i] = i * 3 - 2;<br/>
}<br/>
uint64_t answer = sumrandom(values, N);</p>
<p>#define repeat 5<br/>
BEST_TIME_NOCHECK(populaterandom(indexes, N), , repeat, N, true);<br/>
BEST_TIME(sumrandom(values, N), answer, , repeat, N, true);<br/>
BEST_TIME(sumrandomandindexes(values, indexes, N), answer, , repeat, N, true);<br/>
BEST_TIME(sumrandomfromindexes(values, indexes, N), answer, , repeat, N,<br/>
true);</p>
<p> free(values);</p>
<p> free(indexes);<br/>
}</p>
<p>int main( int argc, char *argv[] ) {<br/>
if ( argc &lt; 2 )<br/>
return -1;<br/>
int m = atoi( argv[ 1 ] );<br/>
demo( m );<br/>
return EXIT_SUCCESS;<br/>
}<br/>
</code></p>
<p>and let&rsquo;s benchmark this version:</p>
<p><code>$ ./batchload 13<br/>
[demo] N= 13631488<br/>
populaterandom(indexes, N) : 26.553 cycles per operation (best)<br/>
sumrandom(values, N) : 80.907 cycles per operation (best) 81.980 cycles per operation (avg)<br/>
sumrandomandindexes(values, indexes, N) : 58.007 cycles per operation (best) 58.351 cycles per operation (avg)<br/>
sumrandomfromindexes(values, indexes, N) : 31.712 cycles per operation (best) 32.118 cycles per operation (avg)<br/>
</code></p>
<p>The implementation <code>sumrandom.constprop.2</code> goes away and we see a much slower hashing for both versions and the difference when removing the hash <code>dependency is 23 cycles</code>.</p>
<p>This is an important point often neglected in papers and books. <strong>Hash Tables have a cost of converting the table key to the range</strong>. This cost is significant and much bigger than the hashing function itself. In many papers what they do is use a table size 2^x to remove this cost. This might not be the case in a production-level implementation as we can&rsquo;t keep growing tables by 2x forever.</p>
<p>Now I think we are done. 🙂</p>
</div>
</li>
<li id="comment-300763" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mathias Gaunard</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-16T09:13:21+00:00">April 16, 2018 at 9:13 am</time></a> </div>
<div class="comment-content">
<p>You probably want to block to deal well with larger values of &lsquo;size&rsquo;.</p>
</div>
</li>
<li id="comment-300778" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-16T12:28:04+00:00">April 16, 2018 at 12:28 pm</time></a> </div>
<div class="comment-content">
<p>@mserdarsanli adapted the code to a web benchmark with C++17 (how cool, huh?)</p>
<p>Seems <a href="http://quick-bench.com/M-CTMUD38DFuGZQ4q5KrMVdJA0g" rel="nofollow">GCC 7.3 can optimize for the batched case better</a> than <a href="http://quick-bench.com/E2j9-4a0WiOwLv0GXqR-4zVIQqA" rel="nofollow">clang 6.0</a>. In fact, for the later the caching of hashes is even slower!</p>
</div>
</li>
<li id="comment-300780" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-16T12:36:21+00:00">April 16, 2018 at 12:36 pm</time></a> </div>
<div class="comment-content">
<p>Same <a href="http://quick-bench.com/hk2yInfxlfF2ecavkdFmd4UQLpo" rel="nofollow">benchmark for GCC 7.3 with 16M entries</a> (andl mask instead of modulus)</p>
</div>
</li>
<li id="comment-300791" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-16T14:52:44+00:00">April 16, 2018 at 2:52 pm</time></a> </div>
<div class="comment-content">
<p>Last link is wrong.</p>
<p>For 16M entries: <a href="http://quick-bench.com/zXPCZPzXFPGF7iDTTGTjP7ELGAc" rel="nofollow">GCC 7.3</a> vs <a href="http://quick-bench.com/opuEwDDyIpVUKo4HjS6DojmnCuk" rel="nofollow">CLANG 6.0</a> show they are practically the same using <code>andl mask</code> and the original difference on this post doesn&rsquo;t happen at all. (Like in my first comment)</p>
</div>
</li>
</ol>
