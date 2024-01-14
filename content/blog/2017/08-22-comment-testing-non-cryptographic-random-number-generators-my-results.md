---
date: "2017-08-22 12:00:00"
title: "Testing non-cryptographic random number generators: my results"
index: false
---

[22 thoughts on &ldquo;Testing non-cryptographic random number generators: my results&rdquo;](/lemire/blog/2017/08-22-testing-non-cryptographic-random-number-generators-my-results)

<ol class="comment-list">
<li id="comment-284780" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.pcg-random.org/" class="url" rel="ugc external nofollow">M.E. O'Neill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T16:36:22+00:00">August 22, 2017 at 4:36 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>I&rsquo;m glad that working on PRNG testing. Not enough people are! But I think you need to distinguish between systemic failures (which have really low p-values very close to zero) and occasional blips were there is an â€œunlikelyâ€ p-value. Blips must happen from time to time. Three runs is ample to show a repeatable systemic failure, but not nearly enough to say that a blip occurs too often, you&rsquo;ll most likely be seeing false patterns in random noise.</p>
</div>
<ol class="children">
<li id="comment-285042" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-27T14:53:01+00:00">August 27, 2017 at 2:53 pm</time></a> </div>
<div class="comment-content">
<p>Another option is to use Adaptive Crush which if it sees a questionable p-value on a given test it increases the number of samples and reruns that test. It &ldquo;rinse and repeats&rdquo; up to a limit looking for pass/fail.</p>
<p>(<a href="http://www.math.sci.hiroshima-u.ac.jp/~m-mat@math.sci.hiroshima-u.ac.jp/MT/ADAPTIVE/" rel="nofollow ugc">http://www.math.sci.hiroshima-u.ac.jp/<span class="__cf_email__" data-cfemail="d0aebdfdbdb1a490bdb1a4b8fea3b3b9feb8b9a2bfa3b8b9bdb1fda5feb1b3febaa0">[email&#160;protected]</span>/MT/ADAPTIVE/</a>)</p>
</div>
</li>
</ol>
</li>
<li id="comment-284788" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.pcg-random.org/" class="url" rel="ugc external nofollow">M.E. O'Neill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T19:16:29+00:00">August 22, 2017 at 7:16 pm</time></a> </div>
<div class="comment-content">
<p>I emailed Daniel and pointed out to him that he was erroneously repeating the same test with the same seeds. I&rsquo;m pleased to see he has updated his post.</p>
<p>I think it&rsquo;s important, though, to be clear about how to interpret the p-value results from TestU01. Here&rsquo;s a quote from the TestU01 manual</p>
<p>â€œWhen a p-value is extremely close to 0 or to 1 (for example, if it is less than 10^âˆ’10), one can obviously conclude that the generator fails the test. If the p-value is suspicious but failure is not clear enough, (p = 0.0005, for example), then the test can be replicated independently until either failure becomes obvious or suspicion disappears (i.e., one finds that the suspect p-value was obtained only by chance). This approach is possible because there is no limit (other than CPU time) on the amount of data that can be produced by a RNG to increase the sample size and the power of the test.â€</p>
<p>Thus the proper terminology for many of the p-values Daniel got is *suspicious*. As L&rsquo;Ecuyer notes, any time you get a suspicious p-value, you are obligated to investigate. Arguably the current code in Daniel&rsquo;s test suite doesn&rsquo;t do this part well enough, because he just reruns the whole test three times. That&rsquo;s not enough investigation!</p>
<p>As the author of PCG, so if someone thinks they see an issue, I have an obligation to investigate. I have looked into the specific suspicious p-values Daniel observed for specific tests, and here are the results I get repeating those same tests:</p>
<p>Running CollisionOver (BigCrush Test #9) on pcg32 twenty times, I see these p-values: 0.05811, 0.144, 0.9842, 0.797, 0.9561, 0.4523, 0.3093, 0.1909, 0.9385, 0.6832, 0.9418, 0.1008, 0.06458, 0.1211, 0.4523, 0.6231, 0.03508, 0.9561, 0.2548, 0.8652, which averages out to be 0.4964.</p>
<p>Running Run, r = 0 (BigCrush Test# 38) on the byte reverse (not the usual bit-reversed) of the least significant 32-bits of pcg64 lsb twenty times, I see these p-values: 0.992, 0.8454, 0.08798, 0.6355, 0.8053, 0.1355, 0.06824, 0.25, 0.1758, 0.4459, 0.5009, 0.4907, 0.8229, 0.6984, 0.3183, 0.4428, 0.6964, 0.8723, 0.0706, 0.7646, which averages out to be 0.506.</p>
<p>Thus, we can conclude that Daniel was just seeing some normal variation, not an actual problem.</p>
<p>Likewise, Daniel&rsquo;s claims about TestU01 finding flaws in SplitMix are similarly false, merely what we normally see in thorough testing where many tests are applied, and some of the fails he reports for Vigna&rsquo;s generators are also not indicators of serious problems.</p>
<p>I&rsquo;ve only just started (re)checking SplitMix to make sure it gets a clean bill of health too, but once it&rsquo;s done I&rsquo;ll post again with a pastebin link for all the results.</p>
<p>Even though Daniel made a few mistakes (and gave me a bit more excitement than I was expecting this morning!), I applaud the idea of more widespread testing of PRNGs in general. We&rsquo;ve already seen that mistakes are easy to make, and in that context, we really want multiple sources of independent validation, not just PRNG authors posting results. (You might hope that if the work has been formally published, that peer-reviewers would do this kind of work, but independently replicating someone&rsquo;s results, and checking over their code for bugs, is above and beyond what typically happens in that context.)</p>
</div>
<ol class="children">
<li id="comment-284789" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T19:30:05+00:00">August 22, 2017 at 7:30 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for your comments. I will be updating my results this week.</p>
</div>
<ol class="children">
<li id="comment-284799" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.pcg-random.org/" class="url" rel="ugc external nofollow">M.E. O'Neill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T21:23:47+00:00">August 22, 2017 at 9:23 pm</time></a> </div>
<div class="comment-content">
<p>Here are links to my retest results for PCG and SplitMix:</p>
<p>* pcg32 â€” <a href="https://pastebin.com/g9Fe2KdZ" rel="nofollow ugc">https://pastebin.com/g9Fe2KdZ</a><br/>
* pcg64 â€” <a href="https://pastebin.com/MTsGm9uN" rel="nofollow ugc">https://pastebin.com/MTsGm9uN</a><br/>
* splitmix â€” <a href="https://pastebin.com/ut80JMMz" rel="nofollow ugc">https://pastebin.com/ut80JMMz</a> and <a href="https://pastebin.com/gPP4NA88" rel="nofollow ugc">https://pastebin.com/gPP4NA88</a></p>
<p>As expected, like the earlier retesting I reported for PCG, these retests show, as expected, that no real flaw had been discovered in SplitMix via simple TestU01 testing.</p>
<p>(But, regarding the statistical quality of SplitMix, it does, however, only produce each output *once* (when used as a 64-bit PRNG). Once you&rsquo;ve seen a given 64-bit value, you&rsquo;ll never see it again. That means it fails a really simple 64-bit birthday-problem test, due to lack of repeats. But actually observe this issue, you need either lots of time or lots of memory to observe 64-bit repeats (i.e., you must remember every 64-bit value you have seen so far). I have a custom tester to check for plausible behavior, and it uses 100 GB of RAM to perform the test. Obviously that&rsquo;s not a test everyone can run (although you can use smaller sizes if you&rsquo;re willing to wait longer), but for SplitMix, you don&rsquo;t actually have to run the test to know that it&rsquo;ll fail, since it&rsquo;s an integral part of the design. FWIW, Vigna&rsquo;s PRNGs, pcg64, pcg64_fast, a 128-bit MCG, and std::mt19937_64 all pass a simple 64-bit birthday test. As with any statistical issue, you might decide it&rsquo;s not important for your application. And in some specialized situations, the once-only property is actually desirable, which is why PCG reluctantly provides some variants (explicitly labelled with the suffix _once_insecure) to provide it.)</p>
<p>(It&rsquo;s also the case that Daniel tested Vigna&rsquo;s cut-down version of SplitMix, which drops its multi-stream functionality and the split() function that inspires its name.)</p>
</div>
<ol class="children">
<li id="comment-285044" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-27T15:03:53+00:00">August 27, 2017 at 3:03 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Once you&rsquo;ve seen a given 64-bit value, you&rsquo;ll never see it again.&rdquo;</p>
<p>Unless I&rsquo;m missing the point, I see this as unimportant since for a generator with period 2^64 (or 2^64-1), we can only expect good stat quality with sample sizes &lt; sqrt(2^64) = 2^32 for not birthday spacing related and b-day spacing no more than (2^64)^(1/3) ~= 2642246</p>
</div>
<ol class="children">
<li id="comment-285056" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.pcg-random.org/" class="url" rel="ugc external nofollow">M.E. O'Neill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-27T23:00:15+00:00">August 27, 2017 at 11:00 pm</time></a> </div>
<div class="comment-content">
<p>If it really were the case that you could only demand 2^32 values from SplitMix, that would itself be a problem as well because on a modern machine we can produce 2^32 values well under 10 seconds. A modern PRNG that is only good for fewer than 10 seconds of output would be questionable at best.</p>
<p>The old rule about only being able to expect about sqrt(period) values from any PRNG is not the case for many/most modern PRNGs, and especially not cryptographically secure ones based on hashing a counter (e.g., Random123). The period of those is based on the width their internal counter, and they should give randomness that passes statistical tests all the way until the counter loops back.</p>
<p>SplitMix passes PractRand&rsquo;s statistical tests up to at least 64 TB of output (that&rsquo;s as far as I&rsquo;ve run it so far), 2048x more than the 32 GB fail we&rsquo;d see if it failed at the square root of its period. </p>
<p>In general though, I think we can agree that using a 64-bit PRNG with 2^64 period to produce 64-bit outputs is clearly problematic. We can agree that there will be birthday issues far sooner than the period might have you think.</p>
<p>In contrast, if you use SplitMix as a 32-bit PRNG, everything will seem as it should.</p>
</div>
<ol class="children">
<li id="comment-285104" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-28T16:58:46+00:00">August 28, 2017 at 4:58 pm</time></a> </div>
<div class="comment-content">
<p>And the cubic root of period is only an LCG thing..bad me.</p>
<p>Oh, and thanks for putting the effort into writing a paper accessible to a wide audience. Certainly practitioners appreciate the extra effort.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-285117" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-28T20:58:42+00:00">August 28, 2017 at 8:58 pm</time></a> </div>
<div class="comment-content">
<p>Thank you. I will rerun everything from scratch. I tried patching up my results with a partial rerun, but it is too easy to mislabel files when proceeding this way. I will just precisely capture the output of the script on a single machine. This will hopefully clear all confusions.</p>
<p>Thanks again!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-302778" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a38a09e3c273086906f26cc3b1746287?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a38a09e3c273086906f26cc3b1746287?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.evensen.org" class="url" rel="ugc external nofollow">Pelle Evensen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-07T09:52:46+00:00">May 7, 2018 at 9:52 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;Running CollisionOver (BigCrush Test #9) on pcg32 twenty times, I see these p-values: 0.05811, 0.144, 0.9842, 0.797, 0.9561, 0.4523, 0.3093, 0.1909, 0.9385, 0.6832, 0.9418, 0.1008, 0.06458, 0.1211, 0.4523, 0.6231, 0.03508, 0.9561, 0.2548, 0.8652, which averages out to be 0.4964.</p>
<p>Running Run, r = 0 (BigCrush Test# 38) on the byte reverse (not the usual bit-reversed) of the least significant 32-bits of pcg64 lsb twenty times, I see these p-values: 0.992, 0.8454, 0.08798, 0.6355, 0.8053, 0.1355, 0.06824, 0.25, 0.1758, 0.4459, 0.5009, 0.4907, 0.8229, 0.6984, 0.3183, 0.4428, 0.6964, 0.8723, 0.0706, 0.7646, which averages out to be 0.506.&rdquo;</p>
<p>The mean is a fairly useless metric for repeated tests. What you want to do is a goodness of fit for a U(0, 1) distribution.</p>
<p>p for the first series (Test #9) of p-values [octave&rsquo;s implementation of the one-sided KS-test, kolmogorov_smirnov_test(x, &ldquo;unif&rdquo;, 0, 1)] is ~0.476, nothing suspicious.</p>
<p>p for the second series (Test #38) is 0.992 which at least would lead me to run that particular test more times.<br/>
(Anderson-Darling gives a somewhat high but not very high p-value for the second series, 0.96.)</p>
</div>
</li>
</ol>
</li>
<li id="comment-284796" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9f4834b55031d5aa89e1c802e177944d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9f4834b55031d5aa89e1c802e177944d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alois Bauer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T20:53:13+00:00">August 22, 2017 at 8:53 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t get it: JavaDoc says &ldquo;Instances of SplittableRandom are not cryptographically secure. Consider instead using SecureRandom in security-sensitive applications.&rdquo; &#8211; so what is your point?<br/>
Crack SecureRandom and you will get my attention.<br/>
And about &ldquo;widespread&rdquo;: Please show me any relevant code using SplittableRandom in Java&#8230;.</p>
</div>
<ol class="children">
<li id="comment-284797" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T21:01:05+00:00">August 22, 2017 at 9:01 pm</time></a> </div>
<div class="comment-content">
<p><em>Instances of SplittableRandom are not cryptographically secure. Consider instead using SecureRandom in security-sensitive applications.</em></p>
<p>That is correct.</p>
<p><em>so what is your point?</em></p>
<p>I&rsquo;m not sure what you are asking.</p>
<p>Maybe you think it is a post about cryptography?</p>
<p>My blog post is specifically about &ldquo;non-cryptographic RNGs&rdquo;, please see the title. The tests I run are specifically designed for non-crytographic RNGs.</p>
<p><em>Crack SecureRandom and you will get my attention.</em></p>
<p>Again, this post has nothing to do whatsoever with cryptography. We test non-cryptographic random number generators. </p>
<p><em>Please show me any relevant code using SplittableRandom in Java</em></p>
<p>SplittableRandom is part of the core Java API. It is difficult to be more widespread.</p>
</div>
</li>
</ol>
</li>
<li id="comment-284970" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-25T21:51:16+00:00">August 25, 2017 at 9:51 pm</time></a> </div>
<div class="comment-content">
<p>Curious how Mersenne Twister compares to the above (later?) random number generator. Maybe not important.</p>
</div>
<ol class="children">
<li id="comment-284971" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-25T21:55:44+00:00">August 25, 2017 at 9:55 pm</time></a> </div>
<div class="comment-content">
<p>Mersenne Twister passes practically random, but I don&rsquo;t have the results yet from &ldquo;big crush&rdquo;. From what I read elsewhere, it fails. You can certainly run the tests yourself if you are curious: I encourage you to do so.</p>
</div>
<ol class="children">
<li id="comment-285055" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.pcg-random.org/" class="url" rel="ugc external nofollow">M.E. O'Neill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-27T22:40:07+00:00">August 27, 2017 at 10:40 pm</time></a> </div>
<div class="comment-content">
<p>The Mersenne Twister did not fail in Daniel&rsquo;s test because he told PractRand to stop after 64 GB, which is about half an hour of testing. By default, PractRand tests up to 32 TB, which obviously takes considerably longer.</p>
<p>The 32-bit Mersenne Twister will fail at 256 GB of output and its 64-bit version will fail at 512 GB of output (which takes three hours to reach). It fails PractRand&rsquo;s BRank test. You can find sample output showing it fail in the â€œHow to Test with PractRandâ€ tutorial on my blog.</p>
<p>So, a more precise answer from Daniel would be to say that it didn&rsquo;t fail when he tested it, but he only ran a limited test. Saying that it â€œpasses PractRandâ€ (in general) is false; it does not.</p>
<p>[FWIW, a 74 bit Lehmer PRNG fails PractRand at about the same point at the Mersenne Twister (yes, I meant 74, not 64).]</p>
</div>
<ol class="children">
<li id="comment-285118" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-28T21:09:45+00:00">August 28, 2017 at 9:09 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s correct. It only passes the test as one can find it in the repository. So it is one seed, and only 64 GB. This does not catch all possible failures.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-285070" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.pcg-random.org/" class="url" rel="ugc external nofollow">M.E. O'Neill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-28T03:57:50+00:00">August 28, 2017 at 3:57 am</time></a> </div>
<div class="comment-content">
<p>Hey Daniel,</p>
<p>Looks like testingRNG/testu01/results in your github repo still has files from when you were accidentally reusing the same seed for every run (perhaps because your test script dumps results files in testingRNG/testu01, and not testingRNG/testu01/results ?).</p>
<p>In particular, the results for testpcg64-S848432-b-r.log and testpcg64-S987654-b-r.log are just duplicates of testpcg64-b-r.log. When you correct this issue, the actual runs for these seeds are completely free of any blips and the â€œrun failuresâ€ you think you&rsquo;re seeing for pcg64 disappear.</p>
</div>
<ol class="children">
<li id="comment-285072" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dd6f92f4599adf3b90a740ff0ec39ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.pcg-random.org/" class="url" rel="ugc external nofollow">M.E. O'Neill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-28T04:03:44+00:00">August 28, 2017 at 4:03 am</time></a> </div>
<div class="comment-content">
<p>Also, I suspect that the reason you thought SplitMix failed was because your Xorshift RNG misidentified itself as SplitMix. If you remove those misattributions, I think SplitMix will come out okay.</p>
</div>
<ol class="children">
<li id="comment-285119" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-28T21:12:48+00:00">August 28, 2017 at 9:12 pm</time></a> </div>
<div class="comment-content">
<p>My script deliberately does not overwrite files in the results subdirectory (that would be inconvenient as they are checked into the repository). However, it is correct that there were issues with these archived log files. So, as stated in a previous comment, and in the revised blog post, I am re-running everything from scratch to hopefully get a clean and fully reproducible result dump. Thanks for warning me about these problems.</p>
</div>
</li>
<li id="comment-285120" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-28T21:16:17+00:00">August 28, 2017 at 9:16 pm</time></a> </div>
<div class="comment-content">
<p>You are probably right about SplitMix, and once I get the final results, I might do a blog post specifically about SplitMix.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-344942" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8db82189117b8df2a25651113586b11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8db82189117b8df2a25651113586b11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-28T04:17:34+00:00">August 28, 2018 at 4:17 am</time></a> </div>
<div class="comment-content">
<p>Are you aware of any generators which pass TestU01 that use 32-bit arithmetic exclusively? That is, composed of integer type <code>uint32_t</code>. Basically something like **xoshiro128**** but.. actually passes TestU01. PCG seems to be exclusively 64-bit. 64-bit arithmetic is notoriously cumbersome and slow in JavaScript. <a href="https://github.com/rotLua/better-random-numbers-for-javascript-mirror/blob/master/support/c/Alea.c" rel="nofollow">Alea</a> was made for JS, and supposedly passes BigCrush but no one seems to be testing it/heard of it.</p>
</div>
<ol class="children">
<li id="comment-408289" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c74671d493346be0eb7df5985456b8fa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c74671d493346be0eb7df5985456b8fa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.iro.umontreal.ca/~lecuyer/" class="url" rel="ugc external nofollow">Pierre L'Ecuyer</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T20:15:33+00:00">May 22, 2019 at 8:15 pm</time></a> </div>
<div class="comment-content">
<p>Lin: You can read the original TestU01 article that introduced Crush, BigCrush, etc.</p>
<p>P. L&rsquo;Ecuyer and R. Simard, &ldquo;TestU01: A C Library for Empirical Testing of Random Number Generators&rdquo;, ACM Transactions on Mathematical Software, 33, 4, Article 22, August 2007, 40 pages.</p>
<p>It contains a large table with test results for many 32-bit generators. You will find there that the Mersenne Twister fails linearity tests in BigCrush. But there are also generators that pass all the tests and (more importantly) are also supported by solid theory.</p>
</div>
</li>
</ol>
</li>
</ol>
