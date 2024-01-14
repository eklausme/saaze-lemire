---
date: "2018-12-08 12:00:00"
title: "Science and Technology links (December 8th 2018)"
index: false
---

[8 thoughts on &ldquo;Science and Technology links (December 8th 2018)&rdquo;](/lemire/blog/2018/12-08-science-and-technology-links-december-8-th-2018)

<ol class="comment-list">
<li id="comment-371678" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Andrew Dalke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-08T21:16:19+00:00">December 8, 2018 at 9:16 pm</time></a> </div>
<div class="comment-content">
<p>The followup letters to Rosenblatt point make statements like:</p>
<p>Joel et al. &ldquo;The high degree of overlap in the form of brain features between females and males combined with the prevalence of mosaicism within brains are at variance with the assumption that sex divides human brains into two separate populations. Moreover, the fact that the large majority of brains consist of unique mosaics of â€œmale-end,â€ â€œfemale-end,â€ and intermediate (i.e., common in both females and males) features precludes any attempt to predict an individual&rsquo;s unique brain mosaic on the basis of sex category&rdquo;</p>
<p>and Chekroud et al. &ldquo;Based on these criteria, the authors convincingly establish that there is little evidence for this strict sexually dimorphic view of human brains, counter to the popular lay conception of a â€œmaleâ€ and â€œfemaleâ€ brain.&rdquo;</p>
</div>
<ol class="children">
<li id="comment-371689" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-08T22:10:26+00:00">December 8, 2018 at 10:10 pm</time></a> </div>
<div class="comment-content">
<p>His finding is stated as such:</p>
<blockquote><p>By fitting a linear support vector machine (2) to the voxel-based morphometry data reported in ref. 1 we achieve a cross-validated misclassification rate of about 80% (depending on the random splits). We thus conclude that, whereas the univariate brain attributes (voxel morphometry) are bad predictors of gender, the multivariate brain morphometry is a very good predictor of gender.</p></blockquote>
<p>Thus you can predict gender from brain morphometry with an accuracy of 80%.</p>
<p>Of course, the result might be wrong but it is a simple classification exercise using available data. One can verify it quickly.</p>
<p>As far as I can tell, it was never contested. Thus it is reasonable to assume that it is so: if you give me the morphometry of a brain, I can predict the gender well.</p>
</div>
<ol class="children">
<li id="comment-372028" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew Dalke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-09T22:50:16+00:00">December 9, 2018 at 10:50 pm</time></a> </div>
<div class="comment-content">
<p>The reply by <a href="https://www.pnas.org/content/113/14/E1969" rel="nofollow">Joel et al.</a> addresses that 80% result directly.</p>
<blockquote><p>
Rosenblatt (7) correctly identified an individual&rsquo;s sex category about<br/>
80% of the time &#8230; Chekroud et al. (8) correctly identified an<br/>
individual&rsquo;s sex category about 89.5â€“95% of the time, but accuracy<br/>
dropped to 65â€“74% when head-size-related measurements were regressed<br/>
out. This latter finding is in line with previous reports that<br/>
observed sex/gender differences are largely attributed to differences<br/>
in brain size (9, 10) (see also figure S4 in ref. 1). Although the<br/>
different supervised learning methods achieve better accuracy in<br/>
predicting sex category than the simple method described above, they<br/>
have the same conceptual problem, namely, it is unclear what the<br/>
biological meaning of the new space is and in what sense brains that<br/>
seem close in this space are more similar than brains that seem<br/>
distant. Moreover, it is unclear whether the brain variability that is<br/>
represented in the new space is related to sex or rather to<br/>
physiological, psychological, or social variables that correlate with<br/>
sex (e.g., weight, socioeconomic status, or type of education) or to a<br/>
chance difference between the males and females in the sample (2, 4).<br/>
One way to answer this question is by checking whether a model created<br/>
to predict sex category in one dataset can accurately predict sex<br/>
category in another dataset. Using SVM, we found that accuracy may<br/>
drop dramatically (sometimes to less than 50%) when a model created<br/>
using a dataset from one geographical region (Tel-Aviv, Beijing, or<br/>
Cambridge) was tested on the other datasets.
</p></blockquote>
</div>
<ol class="children">
<li id="comment-372047" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-10T00:05:47+00:00">December 10, 2018 at 12:05 am</time></a> </div>
<div class="comment-content">
<p>Interesting. I had guessed the brain size was an important variable in this problem, and it appears that I was right, but I am surprised by the strength of the effect. Maybe I shouldn&rsquo;t have been.</p>
<p>It does not seem right to reject size-related features, but it is an interesting qualification.</p>
<p>I am not sure I understand the quote, however. The fact that a model can learn to predict gender based on brain features is a data point&#8230; but the fact that one model fails to generalize across different genetics tells you nothing at all.</p>
<p>Being able to build a model is informative; failing to do so proves nothing.</p>
<p>Or they mean to imply that a single model cannot cover multiple ethnicities? Why would they think so?</p>
</div>
<ol class="children">
<li id="comment-372249" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew Dalke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-10T20:52:42+00:00">December 10, 2018 at 8:52 pm</time></a> </div>
<div class="comment-content">
<p>The single model of &ldquo;male genitalia&rdquo; and &ldquo;female genitalia&rdquo; &#8211; strongly bimodal, with &ldquo;intersex&rdquo; as a third category &#8211; does cover multiple ethnicities, so if you don&rsquo;t think &ldquo;male brain&rdquo;/&rdquo;female brain&rdquo; doesn&rsquo;t do so, then why would you say there are male/female brains?</p>
<p>Are there male heights and female heights? Someone 157cm high is more likely to be female than male, while someone 188cm high is more likely to be male. Does that make 157cm a &ldquo;female&rdquo; height? Clearly no, as there short men, and even subpopulations where most men are under that height.</p>
<p>I think the argument is that if you try to classify brain features as male and female, then you&rsquo;ll find out that far more people have &ldquo;intersex&rdquo; brains, with some male and some female features, than people with ones which are all male/female. The numbers cited are &lsquo;0â€“8.2% internally consistent brains and 23â€“53% substantially variable brains&rsquo;.</p>
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
<li id="comment-372272" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-11T01:37:07+00:00">December 11, 2018 at 1:37 am</time></a> </div>
<div class="comment-content">
<p>For #3, I think there are some serious issues with the paper that Cook&rsquo;s simulation is based on (<a href="https://dataprivacylab.org/projects/identifiability/paper1.pdf" rel="nofollow ugc">https://dataprivacylab.org/projects/identifiability/paper1.pdf</a>).</p>
<p>Cook does a simulation using fixed population per zipcode and uniform probability of any dob for 0-78 years, and gets an 84% probability uniquely identifiability. But the paper, which supposedly accounts for the actual distribution of population per zipcodes and actual clustered age brackets gets 87%. The problem is that Cook&rsquo;s approach should be an upper bound, and any clustering should lower the probability.</p>
<p>So I read the paper, and found that rather than doing a simulation, the author just used a simple binary &ldquo;yes/no&rdquo; for all residents in a zipcode depending on the number of people in their age bracket. On the bright side, this is clearly described in Section 4.3.1 (apart from what I&rsquo;m hoping is a crucial typo). On the dark side, this means the 87% number doesn&rsquo;t bear any relation to the simulation that Cook ran, or the actual number of people that are identifiable.</p>
<p>To get a better idea of what the real number would be, I rewrote a modified version of his simulation to use the actual zipcode populations (<a href="https://blog.splitwise.com/2013/09/18/the-2010-us-census-population-by-zip-code-totally-free/" rel="nofollow ugc">https://blog.splitwise.com/2013/09/18/the-2010-us-census-population-by-zip-code-totally-free/</a>). Then I ran it (on Power9!) and got 64% identifiability. If you were add in the age specific information (which I didn&rsquo;t find in my quick searching), this number would drop further, although I don&rsquo;t know by how much.</p>
<p>So while I think the paper is right that (zip, dob, sex) does uniquely identify some large percentage of Americans, I&rsquo;m disappointed that the exact number being touted turns out to be so flimsy. Maybe I&rsquo;m wrong, but it feels like none of the people currently promoting the paper did any verification on whether it was actually right. When Cook talks about the 20 rejections for the paper, it makes me wonder if maybe peer review was actually doing a good job.</p>
</div>
</li>
<li id="comment-372811" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-13T16:16:21+00:00">December 13, 2018 at 4:16 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
If you were add in the age specific information (which I didn&rsquo;t find<br/>
in my quick searching), this number would drop further, although I<br/>
don&rsquo;t know by how much.
</p></blockquote>
<p>I did figure out how to download the age bracketed zipcode population data from the census.gov website and massaged it into a form I could work with. The age clustering didn&rsquo;t have much further effect on the percentage identifiable, only a couple percent more.</p>
<p>It&rsquo;s a little hard to compare the numbers directly, as the five-year age brackets go through age 90 and the previous assumption was for a max age of 78, but my final conclusion is that 63% is a good final estimate. That is, if we use the 5-year-age-brackets from the 2010 census, and actual populations for zipcodes, a little under 63% of Americans are uniquely identifiable by (zip, sex, dob).</p>
</div>
</li>
<li id="comment-373362" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/05d12e4277599f9b9b9e71c6262d9674?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/05d12e4277599f9b9b9e71c6262d9674?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Victor Stewart</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-16T19:10:26+00:00">December 16, 2018 at 7:10 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve always heard that heart and brain cells don&rsquo;t regenerate and once gone are gone, etc.</p>
<p>But this has always made little common sense to me. Speaking of heart cells, athletic training in the highest heart rate zone builds denser heart muscle that contracts with more strength, and the zone just below increases the volume of blood pumped per beat. And top athletes are known to have enlarged hearts for these reasons.</p>
<p>Thus&#8230; clearly change is afoot?</p>
<p>And there are similar arguments about brain plasticity.</p>
</div>
</li>
</ol>
