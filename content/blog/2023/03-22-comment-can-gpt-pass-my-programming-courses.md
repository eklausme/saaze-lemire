---
date: "2023-03-22 12:00:00"
title: "Can GPT pass my programming courses?"
index: false
---

[17 thoughts on &ldquo;Can GPT pass my programming courses?&rdquo;](/lemire/blog/2023/03-22-can-gpt-pass-my-programming-courses)

<ol class="comment-list">
<li id="comment-649918" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c9ea80a2d8d6561d9f364d4c26d7105?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c9ea80a2d8d6561d9f364d4c26d7105?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael P</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-22T20:43:58+00:00">March 22, 2023 at 8:43 pm</time></a> </div>
<div class="comment-content">
<p>If the second answer is correct, it is only by coincidence: the program as written will improperly exclude 1200 from the sum, but include 1300.</p>
</div>
<ol class="children">
<li id="comment-649927" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/98de7c3010c695d66ba6f3dea88e337e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/98de7c3010c695d66ba6f3dea88e337e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://bootstrapped.me/" class="url" rel="ugc external nofollow">Lukas G</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-23T03:25:24+00:00">March 23, 2023 at 3:25 am</time></a> </div>
<div class="comment-content">
<p>You are right but the Bing ChatBot returns the correct code:</p>
<p>public class Sum {<br/>
public static void main(String[] args) {<br/>
int sum = 0;<br/>
for (int i = 1; i &lt;= 10000; i++) {<br/>
int hundredthDigit = (i / 100) % 10;<br/>
if (hundredthDigit % 3 != 0) {<br/>
sum += i;<br/>
}<br/>
}<br/>
System.out.println(sum);<br/>
}<br/>
}</p>
</div>
</li>
</ol>
</li>
<li id="comment-649919" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c20a2c08c0072173d19fb94283c77737?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c20a2c08c0072173d19fb94283c77737?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://vivekhaldar.com" class="url" rel="ugc external nofollow">Vivek Haldar</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-22T21:12:24+00:00">March 22, 2023 at 9:12 pm</time></a> </div>
<div class="comment-content">
<p>There has actually been research on this:<br/>
The Robots Are Coming: Exploring the Implications of OpenAI Codex on Introductory Programming. <a href="https://dl.acm.org/doi/pdf/10.1145/3511861.3511863" rel="nofollow ugc">https://dl.acm.org/doi/pdf/10.1145/3511861.3511863</a></p>
<p>Made a video covering that paper: <a href="https://youtu.be/kvXsKPt3aRM" rel="nofollow ugc">https://youtu.be/kvXsKPt3aRM</a></p>
<p>Prof. Crista Lopes has been trying it on compilers/PL questions: <a href="https://tagide.com/education/the-end-of-programming-as-we-know-it/" rel="nofollow ugc">https://tagide.com/education/the-end-of-programming-as-we-know-it/</a></p>
</div>
</li>
<li id="comment-649920" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d8c5ef982e5d3afafc2d10f1f66e059?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d8c5ef982e5d3afafc2d10f1f66e059?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Elis Byberi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-22T21:29:35+00:00">March 22, 2023 at 9:29 pm</time></a> </div>
<div class="comment-content">
<p>Write a Java program that calculates the sum of numbers from 1 to 10,000 (including 1 and 10,000) but omitting numbers where the hundredth digit is divisible by 3.</p>
<p>wrong: <code>if ((i / 100) % 3 != 0)</code> gives sum = 33006700</p>
<p>correct: <code>if ((i / 100) % 10 != 3)</code> gives sum = 45155500</p>
</div>
<ol class="children">
<li id="comment-649921" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d8c5ef982e5d3afafc2d10f1f66e059?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d8c5ef982e5d3afafc2d10f1f66e059?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Elis Byberi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-22T21:37:29+00:00">March 22, 2023 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;correct: <code>if ((i / 100) % 10 != 3)</code> gives sum = 45155500&#8243; from the first solution is still wrong.</p>
<p><code>if ((i / 100) % 10 % 3 != 0)</code> omits numbers where the hundredth digit is divisible by 3.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649924" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b732c10f41d234cc36b9946f891b7f1c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b732c10f41d234cc36b9946f891b7f1c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-22T22:15:49+00:00">March 22, 2023 at 10:15 pm</time></a> </div>
<div class="comment-content">
<p>You are very much correct. It should have been<br/>
if((i/100)%10%3!=0)) &#8230;<br/>
Or<br/>
if((i/100)%30!=0))&#8230;</p>
</div>
</li>
<li id="comment-649926" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aa29405b8eafae6c7d4bbe029c6f34c8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aa29405b8eafae6c7d4bbe029c6f34c8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">zwd</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-23T00:35:32+00:00">March 23, 2023 at 12:35 am</time></a> </div>
<div class="comment-content">
<p>for the second question, it&rsquo;s interesting that<br/>
1. if you start a fresh conversation with Bing chat, it&rsquo;ll get it right without errors, so it&rsquo;s probably influenced by the first answer somehow.<br/>
2. Even if it got it wrong, ask it to double check, then it might be fixed. so I guess if students review their solutions before submitting the exam paper, they might fix them,</p>
</div>
</li>
<li id="comment-649929" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-23T05:53:15+00:00">March 23, 2023 at 5:53 am</time></a> </div>
<div class="comment-content">
<p>But what does this mean for us?<br/>
Clearly, online exams are dead.<br/>
Homeworks are dead, too.<br/>
But if people can pass homeworks by pasting them into ChatGPT, they will do so and those will not learn as much as if they did them themselves. But then they will score worse in the exams&#8230;<br/>
Or allow ChatGPT, and make everything much harder, because the computer does all the easy parts for us in the future?</p>
</div>
<ol class="children">
<li id="comment-649942" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ac0072120333a3d9943ecceae8d60e17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ac0072120333a3d9943ecceae8d60e17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan Edens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-24T02:15:01+00:00">March 24, 2023 at 2:15 am</time></a> </div>
<div class="comment-content">
<p>in this security environment, you are correct!</p>
</div>
</li>
</ol>
</li>
<li id="comment-649930" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/062547509ea29cb1a75e7260a77bb6e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/062547509ea29cb1a75e7260a77bb6e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcel Popescu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-23T06:34:50+00:00">March 23, 2023 at 6:34 am</time></a> </div>
<div class="comment-content">
<p>Having a strong dislike of Luddites in all forms, I tend to object on principle to statements like &ldquo;we should forbid technology X&rdquo;. Even disregarding principle, it tends not to work.</p>
<p>Instead, let&rsquo;s use this opportunity to try and improve our educational system, which is a disaster anyway. We could, for example, present the &ldquo;slightly incorrect&rdquo; second program to students and ask them to explain WHY it&rsquo;s incorrect. (Incidentally, I asked ChatGPT this question and it gave an incorrect explanation&#8230;)</p>
<p>Ultimately, I think &ldquo;homework is dead&rdquo; is correct. Online exams &#8211; at least in this field, which is my main interest &#8211; will probably be more similar to a pair programming / mob programming session, where the student(s) work together with the professor to create an application &#8211; maybe similar to today&rsquo;s hackatons. That would definitely not scale anywhere near today&rsquo;s &ldquo;mass exam&rdquo; model though.</p>
</div>
<ol class="children">
<li id="comment-649940" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ac0072120333a3d9943ecceae8d60e17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ac0072120333a3d9943ecceae8d60e17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan Edens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-24T02:13:42+00:00">March 24, 2023 at 2:13 am</time></a> </div>
<div class="comment-content">
<p>Idk, Those are unrealistic programming situations, and will further disconnect the &ldquo;education&rdquo; world from programming. I would already argue that such courses make you harder to teach once you&rsquo;re slowing down tickets on my Jira board. xD</p>
</div>
</li>
</ol>
</li>
<li id="comment-649932" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a339f3a59b9df9c09eb8d06c744279d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a339f3a59b9df9c09eb8d06c744279d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ralph Corderoy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-23T09:34:06+00:00">March 23, 2023 at 9:34 am</time></a> </div>
<div class="comment-content">
<p>The &lsquo;.&rsquo;-counting SIMD code assumes the input is a multiple of 16 long. When it isn&rsquo;t, as with in the sample given, it also counts &lsquo;.&rsquo;s beyond the end of the input.</p>
</div>
</li>
<li id="comment-649934" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b63614fb3f790fb7f9f06844f70b727d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b63614fb3f790fb7f9f06844f70b727d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ionut Popa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-23T14:59:53+00:00">March 23, 2023 at 2:59 pm</time></a> </div>
<div class="comment-content">
<p>Normally such problems are resolved by Gauss sums (one sum from 1 to n then substract multiple sums for that has to be excluded). For a computer science exam that should be the solution to gets most of the points, by being the more efficient.</p>
<p>Even those models are impresive by producing a result there are two main issues. Some results are wrong even resemble the correct one, but even worse, the result are trivial an unoptimized. If programmers will ever rely for real on such tools we&rsquo;ll end up with a huge amount of unoptimized software which will produce coats far beyond the savings made to code that software.</p>
</div>
</li>
<li id="comment-649939" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ac0072120333a3d9943ecceae8d60e17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ac0072120333a3d9943ecceae8d60e17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan Edens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-24T02:10:07+00:00">March 24, 2023 at 2:10 am</time></a> </div>
<div class="comment-content">
<p>expecting 100% correct answers is a failing In usage, not in the Ai&rsquo;d accuracy, it exists to let you sculpt your answer, and is useless in a 1 on 1 question answer session. I would argue it is you getting it wrong by designing a test asking a fish to fly. You need to engineer prompts, not fail around in the air 😀</p>
</div>
</li>
<li id="comment-649943" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d03e6a383d32f4b6501f5107cb23019?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d03e6a383d32f4b6501f5107cb23019?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ITR</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-24T05:31:05+00:00">March 24, 2023 at 5:31 am</time></a> </div>
<div class="comment-content">
<p>If it couldn&rsquo;t solve <em>introductory</em> programming questions, then it would straight up suck. If people are unable to answer these questions without ChatGPT then they&rsquo;ll fail later courses anyways, so who cares?</p>
</div>
</li>
<li id="comment-649951" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad7f60eb72a0d430aa61d24517fb4aa0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad7f60eb72a0d430aa61d24517fb4aa0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-24T17:46:40+00:00">March 24, 2023 at 5:46 pm</time></a> </div>
<div class="comment-content">
<p>It should absolutely be banned in the appropriate contexts. Don&rsquo;t worry about the silly people calling us Luddites. We do not hand toddlers a calculator and set them to the task of long calculations. No, they are taught each step from counting to long division. The calculator isn&rsquo;t very useful anywhere in that process. Those that think they learn with them are frequently deferring their learning for later when they do symbolic long division, etc &#8230; There is only so far such a metaphorical can may be kicked down the road.</p>
<p>When it comes to these assignments and exams, those yelling out &ldquo;Luddite&rdquo; have forgotten the point of these assessments and have a warped view of the education process. Yes, we can ask them to bug hunt (though these models also appear to be able to do some bug hunting as well&#8230; so their perception of that as a higher order skill doesn&rsquo;t seem to ring very true) but they ignore that bug hunting code is a bit of a different skill than writing de novo code and students should be learning both skills. Turning ones classroom into a meta-analysis of of an AI (or any other seamless technology) is often not very conducive to the students learning the basic skills they would need to make the meta-critique. That is often quite a different topic&#8230; again to the calculator analogy, a discussion of overflow conditions with students that haven&rsquo;t mastered basic arithmetic is largely fruitless. And for another analogy, a discussion of open banking and API compliance by large banks isn&rsquo;t really conducive to learning the basics of finance. As dismal as the view may seem to some looking at the modern education system, an embrace of ChatGPT, and/or similar models, would be detrimental rather than helpful in the vast majority of cases. In short, subjects are taught in a certain order for a reason and shortcut tools have typically been banned precisely because they are not useful for learning those skills even if they are reintroduced later (e.g. calculators banned while learning arithmetic but making a reappearance while learning calculus).</p>
<p>Finally&#8230; my computer science exams were on paper in the 2010s. Sure, our homework was turned in online and autograded by computer but when they really wanted to check if you had the skills, then you put pen or pencil to paper. People seem to find this shocking today while I am instead shocked that people think this is impossible and we should all just let everyone cheat with AI because it is magically unbannable. Yes, it was more difficult during the pandemic, but we still very much have the traditional way of making assessments at our disposal and it still works as well as ever. Those looking for a revolution will be sorely disappointed.</p>
<p>Personally I&rsquo;m a fan of homework and project style skills and think exams can be overemphasized&#8230; but those that think ChatGPT will push towards higher level skills are mistaken. It merely highlights the potential for abuse that has existed in these areas forever. Yes, it used to be cheating off their friends homework and now both friends ask ChatGPT for the answer&#8230; but it really isn&rsquo;t that much of a new threat to education&#8230; except in the more subtle ways. I have no worries on the cheating front. Going back to the calculator analogy again&#8230; I&rsquo;m afraid about the people 20 years later that can&rsquo;t calculate a 15% tip without a calculator. For everyone that learns from it and internalizes the mistakes it makes because they sound like a reasonable explanation of what is going on.</p>
<p>As for &ldquo;prompt engineering.&rdquo; Yeah&#8230; we should totally work extra hard to communicate what we mean to the computer and guide it to the right answer&#8230; yeah. Not very useful for any of those times where you don&rsquo;t know the right answer</p>
</div>
</li>
<li id="comment-650054" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e27a8443228ea5ee01f267d9a179597a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e27a8443228ea5ee01f267d9a179597a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrei Pushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-03T12:06:07+00:00">April 3, 2023 at 12:06 pm</time></a> </div>
<div class="comment-content">
<p>We need to invest more investigation into limitations of today&rsquo;s (GPT-4) language models. Though it improves pretty fast, it has its inherent limitations. It is genuinely not great at math as it was not supposed to solve math problems. Its primary skills are linguistic, and coincidentally it can program too, because the trasformer model excels at translation, and in case of coding it is merely translation into programming language.</p>
<p>Like we or not, but soon this model will accompany us everywhere and the skill of writing good prompts is definitely smth that AI will teach us, thus continuing symbiotic relationships.</p>
<p>For the purpose of exam assignments we should select those tasks that today are difficult for language models. And there are plenty, we just need to understand its limitations more. One good example is telling what&rsquo;s wrong with a given piece of code. And it is not necessarily bug hunting, you can ask to refactor some code to make it more clear, which is very important aspect of programmers work, on par with debugging.</p>
<p>Also I believe soft skills becoming more and more important and making conversation on sketching possible solutions with some analysis is also a great way to select great developers, though I am not sure how to apply it to juniors. But the idea that we as human have intuition towards possible solutions, while generating models tend to generate solutions one by one, and during live conversation it is not easy to apply chatGPT. Being able to explain any part of code is anyway a great skill in teamwork, so why not to put more stress on it during exams/assignments?</p>
</div>
</li>
</ol>
