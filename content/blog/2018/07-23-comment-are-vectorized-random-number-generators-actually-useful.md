---
date: "2018-07-23 12:00:00"
title: "Are vectorized random number generators actually useful?"
index: false
---

[2 thoughts on &ldquo;Are vectorized random number generators actually useful?&rdquo;](/lemire/blog/2018/07-23-are-vectorized-random-number-generators-actually-useful)

<ol class="comment-list">
<li id="comment-321014" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d77bf17fd7105092d905a76d8da3048e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d77bf17fd7105092d905a76d8da3048e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Nejc Rosenstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-24T14:20:21+00:00">July 24, 2018 at 2:20 pm</time></a> </div>
<div class="comment-content">
<p>I was optimizing one of my Monte Carlo simulation programs not so long ago. The program in question was used for simulation of movement of large number of particles under different conditions, but always under assumption that no collisions can occur (large mean free path). Each particle&rsquo;s movement was therefore totally independent from movement of any other particle. The simulation was already executed in several cores, but I also added another optimization where I used AVX/AVX2 intrinsics. Previously I was simulating the movement of one particle at a time in every thread, but after the optimization I started simulating the movement of four particles simultaneously in every thread. On each step I had to do interpolations, compute results of various equations and so on and optimisation with intrinsics was totally straightforward and it gave a nice (and expected) performance boost. On every step I also had to generate random numbers and I made myself a simple vectorized implementation of xoroshiro128+ and this sped up the simulation nicely, because I could generate 4 pseudorandom numbers at once, i.e. one for every particle. So, to conclude &#8211; vectorizing the PRNG turned out to be a good decision in my case.</p>
</div>
</li>
<li id="comment-324274" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8384efde6dc676fca7fcae9fb4730314?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8384efde6dc676fca7fcae9fb4730314?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/S6Regen" class="url" rel="ugc external nofollow">Sean O'Connor</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-29T05:30:11+00:00">July 29, 2018 at 5:30 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d use the RDRAND machine instruction for everything except Intel messed up their early hardware implementation of it and I get an illegal instruction exception if I try to use it on my laptop.<br/>
Actually my main use is evolutionary algorithms and there was a paper that showed that pseudo-random number generator are just as good as &ldquo;true&rdquo; random. Also there are on-line sources of &ldquo;quantum noise&rdquo; random numbers.<br/>
The main reason pseudo-random is okay apparently is that the random numbers just need to be non-correlated with the problem and that is a low hurdle.</p>
</div>
</li>
</ol>
