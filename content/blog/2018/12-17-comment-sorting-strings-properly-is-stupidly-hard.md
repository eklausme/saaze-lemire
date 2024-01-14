---
date: "2018-12-17 12:00:00"
title: "Sorting strings properly is stupidly hard"
index: false
---

[42 thoughts on &ldquo;Sorting strings properly is stupidly hard&rdquo;](/lemire/blog/2018/12-17-sorting-strings-properly-is-stupidly-hard)

<ol class="comment-list">
<li id="comment-373593" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3cc65bf12f559a78e925346129aebd88?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3cc65bf12f559a78e925346129aebd88?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Usman Sharif</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-17T19:16:14+00:00">December 17, 2018 at 7:16 pm</time></a> </div>
<div class="comment-content">
<p>C# has a concept of Invariant Culture for string comparisons. It is very useful for the exact issue you are running into. See <a href="https://docs.microsoft.com/en-us/dotnet/api/system.globalization.cultureinfo.invariantculture?view=netframework-4.7.2" rel="nofollow ugc">https://docs.microsoft.com/en-us/dotnet/api/system.globalization.cultureinfo.invariantculture?view=netframework-4.7.2</a></p>
</div>
</li>
<li id="comment-373599" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bdfe52039a721cc72e5750772d155d80?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bdfe52039a721cc72e5750772d155d80?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jonathan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-17T20:20:33+00:00">December 17, 2018 at 8:20 pm</time></a> </div>
<div class="comment-content">
<p>Python has the very strong natsort module for this. It has a lot of special cases for things like thousands separators, character accents and character case.</p>
<p><a href="https://natsort.readthedocs.io/en/master/howitworks.html" rel="nofollow ugc">https://natsort.readthedocs.io/en/master/howitworks.html</a></p>
</div>
<ol class="children">
<li id="comment-373616" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-17T23:44:21+00:00">December 17, 2018 at 11:44 pm</time></a> </div>
<div class="comment-content">
<p>As far as I can tell, this is not part of the standard library.</p>
</div>
</li>
<li id="comment-373728" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Mueller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T10:02:00+00:00">December 18, 2018 at 10:02 am</time></a> </div>
<div class="comment-content">
<p>IMHO &ldquo;natural sort&rdquo; solves a slightly different problem: the problem of sorting text that contains numbers. For example &ldquo;1000 apples&rdquo; should be sorted after &ldquo;200 apples&rdquo;. I see the library you refer to supports both numbers, as well as locale-specific sorting. Another related problem is sorting date values such as &ldquo;Mar/29/2018&rdquo; correctly. For log files, the easiest solution is to the use the format &ldquo;2018-03-29&rdquo; (year, month, day), which avoid the problem. Trying to &ldquo;detect&rdquo; what is meant is quite hard.</p>
</div>
</li>
</ol>
</li>
<li id="comment-373619" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f3d47375b0172123ff4fb4c2a175b030?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f3d47375b0172123ff4fb4c2a175b030?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://notstatschat.rbind.io" class="url" rel="ugc external nofollow">Thomas Lumley</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T00:13:01+00:00">December 18, 2018 at 12:13 am</time></a> </div>
<div class="comment-content">
<p>Here it is in R (in my default en_NZ.UTF-8 locale)</p>
<p><code>&gt; v&lt;-c("e","a","é","f")<br/>
&gt; sort(v)<br/>
[1] "a" "e" "é" "f"<br/>
&gt; v&lt;-c("a","b","A","B")<br/>
&gt; sort(v)<br/>
[1] "a" "A" "b" "B"<br/>
</code></p>
<p>I note that some languages do sort accented vowels at the end, eg Ã˜ and Ã… in Danish. And Estonian not only sorts accented vowels to <em>nearly</em> the end of the alphabet, but also puts U after Z.</p>
<p>As you say, it&rsquo;s hard.</p>
</div>
</li>
<li id="comment-373739" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7843307a1f8a74b602624c5a3f15d71c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7843307a1f8a74b602624c5a3f15d71c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tomasz Jamroszczak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T10:29:01+00:00">December 18, 2018 at 10:29 am</time></a> </div>
<div class="comment-content">
<p>The problem is, sorting letters and words depends on language. Until 2006 Swedish <code>V</code> letter was equivalent to <code>W</code>. <code>Ã…</code>, <code>Ã„</code>, and <code>Ã–</code> are at the end of the alphabet.</p>
<p>Sorting Chinese is hard &#8211; some sort the characters by the number of brush strokes it&rsquo;s needed to paint it.</p>
</div>
</li>
<li id="comment-373759" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/48a6d56089799a939499779123c891a6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/48a6d56089799a939499779123c891a6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Adynatos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T11:22:56+00:00">December 18, 2018 at 11:22 am</time></a> </div>
<div class="comment-content">
<p>oh yeah? how do you sort emojis?<br/>
following unicode seems to at least be sane.</p>
</div>
<ol class="children">
<li id="comment-373791" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T13:25:11+00:00">December 18, 2018 at 1:25 pm</time></a> </div>
<div class="comment-content">
<p>If standard libraries made it is easy to sort according to the Unicode Collation Algorithm (a standard) then I&rsquo;d be fine with it. That&rsquo;s not what they do.</p>
</div>
<ol class="children">
<li id="comment-373907" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T22:53:06+00:00">December 18, 2018 at 10:53 pm</time></a> </div>
<div class="comment-content">
<p>While you be aware of this, it is worth pointing out that the Unicode Collation Algorithm is not an algorithm that takes two strings s1 and s2 and sorts them. It takes s1, s2 <em>and a locale</em> and sorts s1 and s2 according to the locale.</p>
<p>So the UCA is in no way a drop-in replacement for a plain <code>s1 &lt; s2</code> type comparison, because it implies the complicated question &ldquo;what locale do you want to do this sort in&rdquo;?</p>
<p>I 100% agree that languages should provide locale sensitive sorts, and I would be surprised if most mainstream, modern ones don&rsquo;t &#8211; but it&rsquo;s hard to argue it should be the default.</p>
<p>There is a &ldquo;default&rdquo; collation order available for UCA, but using this is unlikely to make everyone happy (the concept of a &ldquo;default&rdquo; locale is likely to raise some hackles) and you&rsquo;ll get a slowdown for no good reason &#8211; still, using the default UCA locale as the language-level default sort is a better option than using the implicit environment locale, although worse than &ldquo;binary&rdquo;, IMO.</p>
</div>
<ol class="children">
<li id="comment-373913" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T23:23:14+00:00">December 18, 2018 at 11:23 pm</time></a> </div>
<div class="comment-content">
<p><em>I 100% agree that languages should provide locale sensitive sorts, and I would be surprised if most mainstream, modern ones don&rsquo;t</em></p>
<p>Have a look at the answers I got so far:</p>
<ol>
<li>&ldquo;Go has x/text which may be included in the standard library (&#8230;)&rdquo; Not exactly encouraging, is it?</li>
<li>Regarding Python, a commenter pointed me to a non-standard library (natsort), and there is questions as to whether it solves the right problem. The locale package seems like a more concrete answer, but it fails on my machine (as the commenter anticipates) and requires non-obvious (to me) invocations like <tt>locale.setlocale(locale.LC_ALL, 'fr_FR')</tt>. Granted, programming is hard, but some things are more obvious than others. </li>
<li>For Swift, one commenter refers to Objective-C. But the documentation regarding <a href="https://docs.swift.org/swift-book/LanguageGuide/StringsAndCharacters.html" rel="nofollow">strings in the current Swift does not say anything about collation</a>. The <a href="https://developer.apple.com/documentation/swift/string" rel="nofollow">string class has no helpful attribute</a> that I can spot.</li>
</ol>
<p>I submit to you that a tricky technical interview question would be &ldquo;how do you sort unicode strings in Python&rdquo;. Then &ldquo;how do you sort unicode strings in Swift&rdquo;. Even with access to the Internet, I suspect that even good engineers would fail to produce a working solution.</p>
<p>This should be clearly documented and accessible. It is not.</p>
<p>I don&rsquo;t expect C to provide this sort of things. One commenter points out that C++ does. I think Java and C# do. For Swift 4, the answer is unknown to me at this point. For Go, the answer seems to be &ldquo;no, the language does not support it&rdquo;. But even when languages do support it, why can&rsquo;t it just be something straight-forward and documented like <tt>thisarray.sort(ThisLocale.comparator)</tt>?</p>
</div>
<ol class="children">
<li id="comment-373917" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T23:43:51+00:00">December 18, 2018 at 11:43 pm</time></a> </div>
<div class="comment-content">
<p>Huh, the situation is worse than I expected (I don&rsquo;t use those languages regularly, or at least I don&rsquo;t care about collation order when I use them).</p>
<p>That said, it seems at least Go and Swift do support this, even if the documentation is poor. An <a href="https://stackoverflow.com/q/38720383/149138" rel="nofollow">example for Swift</a> in Swedish locale, and as far as x/text in Go goes, it seems to me that the /x/ libraries are indeed &ldquo;part of Go&rdquo; but not part of &ldquo;Go core development&rdquo;. I.e., the X are classification means a <a href="https://github.com/golang/go/wiki/SubRepositories" rel="nofollow">different development process and compatibility requirements</a> but they are still &ldquo;included&rdquo;. Kind of weird some for something as basic as collation.</p>
<p>One reason might be the ubiquity of ICU. As far as I know this is the widely available &ldquo;go to&rdquo; library for full-on collation and the one I&rsquo;ve ended up using in any serious setting. So maybe people prefer to just use the consistent ICU library than language facilities for this?</p>
<p>On Python, the answer seems to be the &ldquo;locale&rdquo; package as you point out, but it seems not cross-platform (i.e., the locales are named differently on Windows and Linux). I guess it would at least work for the &ldquo;implicit locale&rdquo; case though. Maybe there is yet another way to get standard locale names? Seems messy.</p>
</div>
<ol class="children">
<li id="comment-373959" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-19T02:08:50+00:00">December 19, 2018 at 2:08 am</time></a> </div>
<div class="comment-content">
<p>The Swift example you offer is for old Swift versions. I am sure it is possible to do with the current Swift version, but the approach described there does not work.</p>
<p>That is, it is not that Swift does not support it, it is that it is stupidly hard to find how to do it.</p>
</div>
<ol class="children">
<li id="comment-373979" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-19T03:57:07+00:00">December 19, 2018 at 3:57 am</time></a> </div>
<div class="comment-content">
<p>Based on my search, I agree with you. It is both poorly documented and the Swift community is apparently not big enough, or doesn&rsquo;t care enough (or not well-indexed enough with enough SEO) to provide yet an an easy to find answer for newer versions.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-373956" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-19T02:04:00+00:00">December 19, 2018 at 2:04 am</time></a> </div>
<div class="comment-content">
<p>I replied here but it didn&rsquo;t show up, maybe lost in moderation?</p>
</div>
<ol class="children">
<li id="comment-373965" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-19T02:23:01+00:00">December 19, 2018 at 2:23 am</time></a> </div>
<div class="comment-content">
<p>Hmmm? I checked and all the comments I have from you are approved. BTW did you know that you have 138 comments on my blog. True fact. (Obviously, I am appreciative.)</p>
</div>
<ol class="children">
<li id="comment-373978" class="comment odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-19T03:55:41+00:00">December 19, 2018 at 3:55 am</time></a> </div>
<div class="comment-content">
<p>It showed up, it was the comment that mentioned ICU above this one. Feel free to delete this branch.</p>
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
</ol>
</li>
<li id="comment-373779" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24d8d4af8adc6329ebb9252087e4c88e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24d8d4af8adc6329ebb9252087e4c88e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Malte</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T12:29:03+00:00">December 18, 2018 at 12:29 pm</time></a> </div>
<div class="comment-content">
<p>With Apple&rsquo;s Objective-C (in the Foundation framework I guess) you&rsquo;d use <code>-localizedCompare:</code> with NSArray&rsquo;s <code>-sortedArrayUsingSelector:</code> (or <code>-sortUsingSelector:</code> for in-place sort of mutable arrays).</p>
<p>The comparator uses the user&rsquo;s current locale. There&rsquo;s a bunch of string comparison methods that allow you to use specific locales and other options.</p>
<p>I believe there are corresponding APIs in Swift.</p>
</div>
<ol class="children">
<li id="comment-373789" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T13:22:16+00:00">December 18, 2018 at 1:22 pm</time></a> </div>
<div class="comment-content">
<p><em>I believe there are corresponding APIs in Swift.</em></p>
<p>Do you happen to have a reference to <tt>localizedCompare</tt> in Swift 4. I looked briefly but did not find it.</p>
</div>
<ol class="children">
<li id="comment-375013" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24d8d4af8adc6329ebb9252087e4c88e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24d8d4af8adc6329ebb9252087e4c88e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Malte</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-23T09:48:33+00:00">December 23, 2018 at 9:48 am</time></a> </div>
<div class="comment-content">
<p>Sorry for the late reply! Holidays and stuff.</p>
<p>Hmm, googling <a href="https://developer.apple.com/documentation/foundation/nsstring/1416999-localizedcompare" rel="nofollow">gives me this in Apple&rsquo;s online documentation</a>. Using the comparator boils down to, e.g.,</p>
<p><code>let array = ["a","B","b","Ã¨","A","e"]<br/>
let sorted = array.sorted {<br/>
$0.localizedCompare($1) == .orderedAscending<br/>
}<br/>
</code></p>
<p>Does that work for you?</p>
</div>
<ol class="children">
<li id="comment-375393" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-24T15:29:11+00:00">December 24, 2018 at 3:29 pm</time></a> </div>
<div class="comment-content">
<p>Your code sample assumes that the String struct in Swift has a method called localizedCompare. It does not:</p>
<p><a href="https://developer.apple.com/documentation/swift/string" rel="nofollow ugc">https://developer.apple.com/documentation/swift/string</a></p>
<p>However, I have finally figured out how to do it:</p>
<p><tt>import Foundation</tt></p>
<p><tt>["a","e","é","f"].sorted {($0 as NSString).localizedCompare(($1)) == .orderedAscending}</tt></p>
<p>The trick is to &ldquo;cast&rdquo; the standard Swift strings to NSString. The standard Swift strings do not support localizedCompare.</p>
<p>To be clear, this means that localized comparison is not part of the Swift standard library, you need &ldquo;Foundation&rdquo; and you need to cast your strings over to Foundation&rsquo;s NSString. Importantly, this means that if you search the standard library, you will not find out how to do localized comparison.</p>
<p>Thus localized comparisons are clearly viewed as outside of the core functionality of the language.</p>
<p>I think that&rsquo;s wrong.</p>
</div>
<ol class="children">
<li id="comment-379374" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/60dcb74d816e29b2aa6b9c0b5969670e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/60dcb74d816e29b2aa6b9c0b5969670e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Xiaodi Wu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-05T21:42:17+00:00">January 5, 2019 at 9:42 pm</time></a> </div>
<div class="comment-content">
<p>You should not have to bridge String to NSString in order to use localized comparison. As a special rule, methods on NSString magically appear as available for String when you import Foundation. This is because Foundation is a core library and its features for strings are essential to the language.</p>
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
<li id="comment-373866" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brian Kessler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T17:58:51+00:00">December 18, 2018 at 5:58 pm</time></a> </div>
<div class="comment-content">
<p>Go has <a href="https://github.com/golang/text" rel="nofollow"><code>x/text</code></a> which may be included in the standard library in the future.<br/>
That includes collation for many languages. I believe that the <code>language.Und</code> (default language) uses the default collator.</p>
<p><code>package uca</p>
<p>import (<br/>
"testing"</p>
<p> "golang.org/x/text/collate"<br/>
"golang.org/x/text/language"<br/>
)</p>
<p>func TestUCASort(t *testing.T) {<br/>
v := []string{"e", "a", "é", "f"}<br/>
c := collate.New(language.Und)<br/>
c.SortStrings(v) // [a e é f]<br/>
t.Log(v)<br/>
v = []string{"a", "b", "A", "B"}<br/>
c.SortStrings(v) // [a A b B]<br/>
t.Log(v)<br/>
}<br/>
</code></p>
<p>Additionally, the python standard library uses <a href="https://docs.python.org/3/library/locale.html" rel="nofollow"><code>locale</code></a> for localization and string collation.</p>
<p><code>import locale</p>
<p>locale.setlocale(locale.LC_ALL, '')<br/>
x=["e","a","é","f"]<br/>
x.sort(key=locale.strxfrm)<br/>
</code></p>
<p>However, I tried to test out the sorting on <code>fr_ca</code> locale and got the incorrect answer, which I found out was due to <a href="https://bugs.python.org/issue23195" rel="nofollow">incorrect locale settings on Max OS X/BSD.</a> On my machine, <code>fr_FR.UTF-8</code> collation is linked to <code>la_LN.US-ASCII</code></p>
<p><code>ls -l /usr/share/locale/fr_FR.UTF-8/<br/>
lrwxr-xr-x 1 root wheel 28 Oct 31 10:37 LC_COLLATE -&gt; ../la_LN.US-ASCII/LC_COLLATE<br/>
lrwxr-xr-x 1 root wheel 17 Oct 31 10:37 LC_CTYPE -&gt; ../UTF-8/LC_CTYPE<br/>
drwxr-xr-x 3 root wheel 96 Oct 31 10:37 LC_MESSAGES<br/>
lrwxr-xr-x 1 root wheel 30 Oct 31 10:37 LC_MONETARY -&gt; ../fr_FR.ISO8859-1/LC_MONETARY<br/>
lrwxr-xr-x 1 root wheel 29 Oct 31 10:37 LC_NUMERIC -&gt; ../fr_FR.ISO8859-1/LC_NUMERIC<br/>
-r--r--r-- 1 root wheel 364 Aug 17 15:58 LC_TIME<br/>
</code></p>
<p>So the issue with string sorting goes beyond programming languages to properly handling collation in the OS as well. Sorting strings is hard&#8230;</p>
</div>
<ol class="children">
<li id="comment-373922" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T23:48:57+00:00">December 18, 2018 at 11:48 pm</time></a> </div>
<div class="comment-content">
<p>Isn&rsquo;t x/text already part of the standard library? At least, aren&rsquo;t the x/ packages included with Go but simply &ldquo;developed apart from Go core&rdquo; and having some different compatibility requirements?</p>
<p>Said another way, if I &ldquo;install Go&rdquo; does it come with x/text?</p>
<p>(in case it&rsquo;s not clear, I am not very familiar with Go)</p>
</div>
<ol class="children">
<li id="comment-373953" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-19T02:02:45+00:00">December 19, 2018 at 2:02 am</time></a> </div>
<div class="comment-content">
<p>The list of packages in the Go standard library is available there:</p>
<p><a href="https://golang.org/pkg/#stdlib" rel="nofollow ugc">https://golang.org/pkg/#stdlib</a></p>
<p>It does not include the x packages.</p>
<p>You can find the x packages there:</p>
<p><a href="https://golang.org/pkg/#other" rel="nofollow ugc">https://golang.org/pkg/#other</a></p>
<p>Here is the comment that describes them:</p>
<blockquote><p>These packages are part of the Go Project but outside the main Go tree. They are developed under looser compatibility requirements than the Go core. Install them with &ldquo;go get&rdquo;.</p></blockquote>
</div>
<ol class="children">
<li id="comment-373957" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-19T02:06:03+00:00">December 19, 2018 at 2:06 am</time></a> </div>
<div class="comment-content">
<p>The Go collation code is available on GitHub. It is short but filled with scary &ldquo;TODOs&rdquo;: <a href="https://github.com/golang/text/blob/master/collate/collate.go#L205" rel="nofollow ugc">https://github.com/golang/text/blob/master/collate/collate.go#L205</a></p>
</div>
</li>
<li id="comment-373958" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-19T02:08:15+00:00">December 19, 2018 at 2:08 am</time></a> </div>
<div class="comment-content">
<p>Well, I guess the best that can be said for Go then is that there is support for locale-aware collation &ldquo;in the Go project&rdquo; but not as part of the standard library. Maybe one day? At least they have the excuse of being a relatively young language (but I don&rsquo;t really buy it because it also puts them in the &ldquo;modern&rdquo; category which means they should get this stuff right from day 1). Perhaps the excuse is that Go is more minimalist compared to other languages.</p>
<p>There is also an argument to be made for how much belongs in the stdlib and how much is left to outside libraries &#8211; but I would personally think that basic locale support, including collation should be in the stdlib.</p>
</div>
<ol class="children">
<li id="comment-373963" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-19T02:18:49+00:00">December 19, 2018 at 2:18 am</time></a> </div>
<div class="comment-content">
<p><em>There is also an argument to be made for how much belongs in the stdlib and how much is left to outside libraries â€“ but I would personally think that basic locale support, including collation should be in the stdlib.</em></p>
<p>Sorting, comparing and hashing strings in a natural language way definitively belongs to the standard library. I can excuse C, for obvious reasons&#8230; but other languages should support this very well.</p>
<p>I could live with a language that exports this to a well made external library, but it should be clearly documented and easy to find.</p>
<p>It is the kind of things that are almost impossible to build on your own but that everyone needs to get right from time to time. And when you do need to do it, you should not need to spend days on it.</p>
<p>Note that the default sort does not even work for ascii-only English. And English does use accents!</p>
</div>
<ol class="children">
<li id="comment-373977" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-19T03:54:37+00:00">December 19, 2018 at 3:54 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Note that the default sort does not even work for ascii-only English.<br/>
And English does use accents!
</p></blockquote>
<p>Well the crux of my original argument was that it does &ldquo;work&rdquo; &#8211; because using binary collation is totally reasonable for the &ldquo;default sort&rdquo; (i.e., also for default comparison and equality and hashing).</p>
<p>So there are two separate points of contention here:</p>
<p>1) Is the default comparison (equality, hashing, etc) behavior of programming languages reasonable? (eg that AaBb is sorted as ABab)</p>
<p>2) When locale-aware sorting is wanted, is it available and documented?</p>
<p>I&rsquo;m willing to concede the answer certainly appears to be &ldquo;no&rdquo; for (2) at least for many mainstream languages, and I was wrong here since I had assumed based on my experience from other languages that everyone is getting this right today.</p>
<p>I don&rsquo;t agree with you on (1) at all though! You appear to be arguing that in the absence of any global agreement on how to collate, the languages should at least try to get some bits right for English and I guess French speakers and also perhaps indirectly for languages that share some of those conventions, and perhaps also for other languages whose character sets don&rsquo;t overlap?</p>
<p>I don&rsquo;t agree: there is no good default order, so at this point you might as well just use whatever lexicographic sort order is fastest which is what most languages do. Maybe there is an argument for making it &ldquo;obviously wrong&rdquo; for human consumption, by doing some xor on the letters or something, but that seems a bit extreme!</p>
<p>I find this reasoning confusing:</p>
<blockquote><p>
Human beings understand that the characters e, é, E, Ã‰, Ã¨, Ãª, and so<br/>
forth, should be considered as the same letter (e) with accents. There<br/>
are exceptions to this rule, but the default which consists in sorting<br/>
accentuated characters after the letter â€˜z&rsquo; is just not reasonable.
</p></blockquote>
<p>Actually <em>human beings</em> do not agree on that! You mention &ldquo;there are exceptions&rdquo; &#8211; but the exceptions are not some weird letters that everyone agrees should be sorted differently, but that everyone doesn&rsquo;t even agree how the same letters should be sorted. Just <a href="https://en.wikipedia.org/wiki/Alphabetical_order#Language-specific_conventions" rel="nofollow">take a look at this list</a>.</p>
<p>You mention accents, as an obvious case &#8211; but a quick scan of that list shows it may not be so obvious at all. There seem to be at least four different strategies that I can pick out: treating an character with a diacritic the same as the unadorned letter (except for tie breaking?), treating it as coming after the unadorned letter, putting it somewhere else in the alphabet entirely (usually after z for Latin-using scripts), or the &ldquo;French way&rdquo; which is apparently to treat accented characters the same as unadorned, but to tie break on the accented characters starting from the <em>right</em> end of the string working backwards (this is news to me and I&rsquo;ve spent my fair share of time looking up words in a French dictionary).</p>
<p>You do not want this mess in your default string ordering (where it can also infect equality, hashing, etc)!</p>
<p>You also do not want to be the one choosing between German or French ways of collating, or Russia or Ukrainian or any other list of hard choices for your &ldquo;best effort global collation to rule them all&rdquo;. You do not want to be the one who got it working &ldquo;alright&rdquo; for French but left out every Asian script, etc.</p>
<p>Finally, and something I forgot before, proper collating breaks all sorts of relationships you&rsquo;d expect of a &ldquo;normal&rdquo; lexicographic sort. For example, if for two strings a, b you have a &lt; b (and a not a prefix of b), you would expect it to be true if you append some additional (perhaps identical) characters to a and b since after all that&rsquo;s how lexicographic compare works, but proper collation doesn&rsquo;t follow this rule and many similar expected relationships (<em>at least</em> it is transitive though, when properly implemented, or all hell would really break loose).</p>
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
<li id="comment-373869" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.lbs.ca/technology" class="url" rel="ugc external nofollow">Dominic A Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T18:04:58+00:00">December 18, 2018 at 6:04 pm</time></a> </div>
<div class="comment-content">
<p>Handled properly in C++ std library <a href="https://en.cppreference.com/w/cpp/locale/collate" rel="nofollow">https://en.cppreference.com/w/cpp/locale/collate</a>.</p>
</div>
</li>
<li id="comment-373906" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T22:47:29+00:00">December 18, 2018 at 10:47 pm</time></a> </div>
<div class="comment-content">
<p>I disagree.</p>
<p>While it&rsquo;s true that &ldquo;default&rdquo; sorts don&rsquo;t make sense in a lot of ways, there is no single sort that makes sense for everyone, because different languages have different ways of sorting.</p>
<p>So while you say:</p>
<blockquote><p>
You might prefer A to come before a, or vice versa, but no human being would ever sort the letters as A,B,a,b or a,b,A,B.
</p></blockquote>
<p>This claim may not be true, although a few minutes of Googling dind&rsquo;t turn up a counter example, although most other obvious orderings are broken by <a href="https://en.wikipedia.org/wiki/Kiowa_language" rel="nofollow">this language</a>. Even if it is true for A and B, it is at definitely not true if you replace A and B by some other letters that you think sort in an obvious way, because someone of another culture has the opposite opinion.</p>
<p>So for things displayed to people, you need a <em>locale-aware</em> collation. This isn&rsquo;t a single collation algorithm, but a family, one per locale and is a well-studied problem solved among other ways by the &ldquo;Unicode Collation Algorithm&rdquo;.</p>
<p>So then the question is, should the default sort in a language try to be locale-aware, implicitly pulling in a locale from &ldquo;somewhere&rdquo; and using that? I&rsquo;d strongly argue &ldquo;no&rdquo;. For one thing, there is a huge advantage to having library functions that behave identically on every platform and system, and pulling the widely-varying locale implicity into core comparison functions breaks this.</p>
<p>Second, it&rsquo;s slow &#8211; and the slowness may vary by locale.</p>
<p>Third, a probably overwhelming amount of the time the purpose of a sort is simply to put some strings in an ordered collection or something like that: not for end-user display. So you would be optimizing for an uncommon case.</p>
<p>Fourth, if you make the sort locale-aware, do you also make equality location aware? In general, you&rsquo;d like <code>a &lt;= b &amp;&amp; b &lt;= a</code> to imply <code>a == b</code> which means your equality should be locale aware too, but that raises all the same issues as above for equality, and in that case they are even more in favor of &ldquo;binary compare&rdquo; I think.</p>
<p>Fifth, even when locale-awareness is the goal, just pulling whatever locale the process is running under is often the wrong choice. If it&rsquo;s a web server, you don&rsquo;t care about the locale of the running machine, but of the remote user, and so on. So locale-awareness isn&rsquo;t something that can be swept under the covers anyways in many cases. It&rsquo;s something you have to deal with explicitly, so more or less equally hard whether sort implicitly takes locale into consideration anyways.</p>
<p>So in my opinion, the ideal scenario is that the language provides &ldquo;binary&rdquo; equality and comparison operators by default, and robust locale-sensitive methods as well with configurable locale. That&rsquo;s exactly what most languages do.</p>
</div>
<ol class="children">
<li id="comment-373921" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-18T23:46:35+00:00">December 18, 2018 at 11:46 pm</time></a> </div>
<div class="comment-content">
<p>Perhaps I should amend:</p>
<blockquote><p>
That&rsquo;s exactly what most languages do.
</p></blockquote>
<p>to</p>
<p>That&rsquo;s exactly what <em>some</em> languages do, and the rest should step up their game.</p>
</div>
</li>
<li id="comment-375493" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-24T21:11:35+00:00">December 24, 2018 at 9:11 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Third, a probably overwhelming amount of the time the purpose of a sort is simply to put some strings in an ordered collection or something like that: not for end-user display. So you would be optimizing for an uncommon case.&rdquo;</p>
<p>I agree with most of your points, but this one is tricky.<br/>
You have two pools of clients. One is the guys writing linkers and parsers and suchlike, with the set of concerns you&rsquo;re listing (&ldquo;I don&rsquo;t care about the precise details, but I want fast and stable sorts&rdquo;); the other is developers writing user-facing code who just want the right thing to happen.</p>
<p>Probably the fault is language minimalism that tries to force two very different functions into the same keyword/library function.<br/>
Perhaps languages should just bite the bullet and accept the necessity for both<br/>
ByteSort(string) and TextSort(string, locale[=by default from OS])<br/>
?</p>
</div>
<ol class="children">
<li id="comment-375496" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-24T21:34:08+00:00">December 24, 2018 at 9:34 pm</time></a> </div>
<div class="comment-content">
<p>Note that I probably should have said &ldquo;comparisons&rdquo; not &ldquo;sorts&rdquo; &#8211; since the string comparison behavior is at issue here and sorts are just one (obvious) way the comparison order is surfaced.</p>
<p>I considered user-facing code when I wrote that. Look at any application that is user facing and see how many string comparisons are in there, and then how many of those end up displayed to the user as part of a sort.</p>
<p>There are many where nearly all the comparisons are internal, especially if the languages uses ordering as a core component of its containers, as say C++ does (where the default containers like std::map and friends use ordering as their key relation).</p>
<p>I&rsquo;ll grant you that there might be some applications, especially small ones, where comparisons are primarily for sorted display to the user, but I think most will be &ldquo;internal&rdquo; uses.</p>
<p>There is even a stronger case for equality &#8211; I think most would agree that the overwhelming use for equality for user-facing programs are internal mechanics that won&rsquo;t be displayed to the user, or even if it affects user visible stuff, &ldquo;binary equality&rdquo; (an exact code-point by code-point comparison) works fine. So if you agree that binary equality is desirable, but you want locale-sensitive comparison, you are left with the awkward choice of having comparison operators which are inconsistent with equals. Yuck&#8230; stay away from that idea!</p>
</div>
<ol class="children">
<li id="comment-375504" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-24T21:57:54+00:00">December 24, 2018 at 9:57 pm</time></a> </div>
<div class="comment-content">
<p>Aren&rsquo;t the sorts of examples you&rsquo;re giving a sort of &ldquo;premature optimization&rdquo;? You&rsquo;re asserting that user facing apps &ldquo;need&rdquo; to utilize high-performance maps and hashes and equates and suchlike, and I&rsquo;m not sure that&rsquo;s at all true.</p>
<p>Sure, I can believe that there are some backends like Twitter and Google that need to do whatever they can to run strings fast in their data centers. But they&rsquo;re also capable of using code correctly. For the default programmer, and the default app, there seems no reason whatsoever to optimize for speed over &ldquo;correctness&rdquo;, however defined.</p>
<p>Maybe, alternatively, the flaw is in ever allowing a sort() routine that doesn&rsquo;t FORCE the use of a locale (and thus thinking about the issue)?<br/>
So you can have<br/>
sort(strings, kDefaultLocale[=what OS provides))<br/>
sort(strings, kBytesLocal)<br/>
sort(strings, explicit locale)<br/>
but just sort(strings) does not exist as an option?</p>
</div>
<ol class="children">
<li id="comment-375524" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-24T23:15:22+00:00">December 24, 2018 at 11:15 pm</time></a> </div>
<div class="comment-content">
<p>No, I don&rsquo;t think it&rsquo;s premature to have reasonably fast collections by default in a language &#8211; it&rsquo;s what most people want.</p>
<p>However, fast or slow collections is a red-herring. It&rsquo;s actually about fast or slow default string comparisons. I think people want fast string operations in general, yes. The concept of &ldquo;premature optimization&rdquo; doesn&rsquo;t apply in the same way to library or base language features as it does for a finished application. In a finished application you probably understand the input domain and user-facing use cases so you can tell which operations need to be sped up to improve user experience, and the rest can be left alone.</p>
<p>For a standard library or built-in language feature, you generally have no idea, or, more precisely &#8211; you have to support a huge spectrum of uses from people who don&rsquo;t care about performance to cases where the cost of the operation will dominate runtime. So the tradeoffs are a bit different: you should make it as fast as possible within the constraints of a reasonable API, and if you have to make your API worse to make it faster, you <em>might</em> consider it depending on the goals of your language, your typical user, availability of alternate APIs etc.</p>
<p>All that said, this isn&rsquo;t mostly about performance anyways, but largely about correctness and adhering to the principle of least surprise. I would expect all the basic types to compare identically everywhere. Certainly 0 &lt; 1 everywhere, etc. If strings silently start pulling the locale for comparisons, you are often making an invalid assumption (that whatever default locale is being used is at all appropriate, even if the user wanted locale-based collation in the first place), and you just unleashed a bunch of bugs in many locales that aren&rsquo;t &ldquo;en_us&rdquo;. I would never want my default string comparisons to change behavior based on what user the process was running under, what locale was set by some code I wasn&rsquo;t aware of, what environment variables where set, etc.</p>
<p>So comparing by unicode code-point value seems entirely an entirely reasonable default to me, and this is exactly what almost every modern and many ancient languages do.</p>
<p>Now there <em>is</em> a time and place for locale-aware display at the UI layer, and languages should better support this use case &#8211; but I definitely disagree you want to involve that with the comparator for the core string type.</p>
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
<li id="comment-374096" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2a23f1eaa56bd9309254a7408803207e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2a23f1eaa56bd9309254a7408803207e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Max Lybbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-19T15:06:22+00:00">December 19, 2018 at 3:06 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m surprised how little this and other globalization questions come up. I find it fascinating. If I didn&rsquo;t have experience in the industry, I would assume it isn&rsquo;t mentioned in blog posts for the same reason unexpected integer division results aren&rsquo;t mentioned: you get bit once and learn your lesson.</p>
<p>Instead, I&rsquo;m sure that while everybody knows that the C locale (sorting ASCII-betically, as they used to say in Perl) isn&rsquo;t good enough, very few people know what is. And, if the ICU library&rsquo;s API is anything to go by, the people who do know how to solve the problem apparently have no taste in API design.</p>
</div>
<ol class="children">
<li id="comment-375498" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-24T21:36:31+00:00">December 24, 2018 at 9:36 pm</time></a> </div>
<div class="comment-content">
<p>I have some experience with this, and in my experience it definitely &ldquo;comes up&rdquo;, but apparently not in a way that results in languages having first-class support for it.</p>
<p>In any enterprise product localization is a big deal and everyone mostly seems to use third party libraries (read this as &ldquo;ICU&rdquo;) to support locale aware everything.</p>
</div>
</li>
</ol>
</li>
<li id="comment-375489" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-24T20:54:38+00:00">December 24, 2018 at 8:54 pm</time></a> </div>
<div class="comment-content">
<p>Mathematica (as usual) seems to have put some thought into this:<br/>
Defaults work the way you want:<br/>
Sort[{&ldquo;e&rdquo;, &ldquo;a&rdquo;, &ldquo;é&rdquo;, &ldquo;f&rdquo;}]<br/>
{&ldquo;a&rdquo;, &ldquo;e&rdquo;, &ldquo;é&rdquo;, &ldquo;f&rdquo;}</p>
<p>Sort[{&ldquo;a&rdquo;, &ldquo;b&rdquo;, &ldquo;A&rdquo;, &ldquo;B&rdquo;}]<br/>
{&ldquo;a&rdquo;, &ldquo;A&rdquo;, &ldquo;b&rdquo;, &ldquo;B&rdquo;}</p>
<p>But there has also been thought (and there exist rules) for ordering of &ldquo;semantically significant&rdquo; format/font variants, so</p>
<p>Sort[{&ldquo;e&rdquo;, &ldquo;a&rdquo;, &ldquo;é&rdquo;, &ldquo;f&rdquo;, &ldquo;&#091;ExponentialE]&rdquo;}]<br/>
{&ldquo;a&rdquo;, &ldquo;e&rdquo;, &ldquo;é&rdquo;, &ldquo;f&rdquo;, &ldquo;&#091;ExponentialE]&rdquo;}</p>
<p>That latter element (&ldquo;&#091;ExponentialE]&rdquo;) would display in Mathematica as a typographic variant of e, but it&rsquo;s the &ldquo;e&rdquo; of mathematics, and is sorted as a different class that comes after &ldquo;text&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-375492" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-24T21:11:24+00:00">December 24, 2018 at 9:11 pm</time></a> </div>
<div class="comment-content">
<p>I am not surprised regarding Mathematica, given that tools like Excel get it right.</p>
</div>
</li>
</ol>
</li>
<li id="comment-430493" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a3d4acaa2852953dd9b772e78d3a1dd0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a3d4acaa2852953dd9b772e78d3a1dd0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/baverman" class="url" rel="ugc external nofollow">Anton Bobrov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-07T06:25:18+00:00">October 7, 2019 at 6:25 am</time></a> </div>
<div class="comment-content">
<p>I agree that documentation regarding unicode collation is obscure. But the topic is complex by itself. Proper sorting is UI specific for a particular viewer and involves many external factors which is hard to handle with a default behavior. It will be almost wrong as current ASCII (binary) default but also much slower.</p>
<p>Python can use system locale settings:</p>
<p><code>import locale<br/>
locale.setlocale(locale.LC_ALL, '')<br/>
print(sorted(["e","a","é","f"], key=locale.strxfrm))<br/>
# ['a', 'e', 'é', 'f']<br/>
</code></p>
<p>It also works with my en_US locale, because it defines proper order for diacritic &ldquo;chars&rdquo;.</p>
</div>
</li>
<li id="comment-448057" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e00a162c3fc18e89ded0ac1a2c89ced0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e00a162c3fc18e89ded0ac1a2c89ced0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ned Harding</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-20T04:29:55+00:00">November 20, 2019 at 4:29 am</time></a> </div>
<div class="comment-content">
<p>I love this! Having dealt with just this issue writing Alteryx (a data processing application), it was a huge struggle. For the reasons below I promise you that no data system has ever gotten this &ldquo;right&rdquo; and I am not sure it is even possible.</p>
<p>Unfortunately the locale thing gets even more complicated when dealing with databases. The locale of the computer doesn&rsquo;t matter, only the locale of the data. So me as an American looking at French data needs to use a French locale. There is no reasonable default in code that can anticipate this. So I punted and made the user decide the locale per sort tool (one Alteryx workflow can have multiple data connections.)</p>
<p>But it gets worse! Imagine a database of names (think clients) that cross international borders. In order to properly sort a subset of this database the locale rules would need to be applied by which country each user is in. That means that depending how I filter and sort my database, I need to pick a different locale each time &#8211; and I have not even changed computers or data sources! And how am I meant to sort when I am including names from various countries?</p>
</div>
</li>
<li id="comment-649151" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/018069ee7a7db7b4063059ed85886cdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/018069ee7a7db7b4063059ed85886cdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-05T04:17:03+00:00">February 5, 2023 at 4:17 am</time></a> </div>
<div class="comment-content">
<p>For future reference:</p>
<p>For R:<br/>
&#8211; stringi: stri_sort aprovides locale sensitive sorting<br/>
&#8211; stringr: str_sort provides locale sensitive sorting</p>
<p>For Python:<br/>
&#8211; locale: provides locale sensitive sorting on Windows, and OSes using glibc. Fails on systems using bdslibc, musl libc, and libc implementations on embedded systems.<br/>
&#8211; pyicu: a wrapper for icu4c, create a collator from existing locale, or build collator from custom rules</p>
<p>Draft notes available on <a href="https://github.com/enabling-languages/python-i18n/blob/main/notebooks/Collation.ipynb" rel="nofollow ugc">github</a></p>
</div>
</li>
</ol>
