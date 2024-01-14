---
date: "2010-11-02 12:00:00"
title: "How do search engines handle special characters? Should you care?"
index: false
---

[10 thoughts on &ldquo;How do search engines handle special characters? Should you care?&rdquo;](/lemire/blog/2010/11-02-how-do-search-engines-handle-special-characters-should-you-care)

<ol class="comment-list">
<li id="comment-53853" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-02T09:35:25+00:00">November 2, 2010 at 9:35 am</time></a> </div>
<div class="comment-content">
<p>@John</p>
<p>Great point. </p>
<p>In this case, comparing &ldquo;Kurt Godel&rdquo; and &ldquo;Kurt GÃ¶del&rdquo;, both Bing and Google fail my &ldquo;this is the same person&rdquo; test.</p>
<p>So, if you want people to find your article on Kurt GÃ¶del more easily, maybe you should include a few &ldquo;Kurt Godel&rdquo; typos. 😉</p>
</div>
</li>
<li id="comment-53856" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Will Fitzgerald</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-02T11:28:45+00:00">November 2, 2010 at 11:28 am</time></a> </div>
<div class="comment-content">
<p>Michael&rsquo;s comments are well stated&#8211;at least, it&rsquo;s what I would have written as my comment! </p>
<p>The original question to Matt Cutts was about ligatures (e.g. is &ldquo;Duï¬€&rsquo;s Beer&rdquo; the same as &ldquo;Duff&rsquo;s beer&rdquo;) and typographic hyphens.</p>
</div>
</li>
<li id="comment-53852" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a7f4f9dcbbf1d46d660b0a6c98435751?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a7f4f9dcbbf1d46d660b0a6c98435751?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.johndcook.com/blog/" class="url" rel="ugc external nofollow">John</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-02T08:41:20+00:00">November 2, 2010 at 8:41 am</time></a> </div>
<div class="comment-content">
<p>Apparently Google gives you somewhat different results when you search on &ldquo;Godel&rdquo; as well. I would expect more English speakers would simply leave off diacritical marks than, for example, change Ã¶ to oe.</p>
</div>
</li>
<li id="comment-53854" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/41bd47de5d865b20e611843a0b0ef60c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/41bd47de5d865b20e611843a0b0ef60c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Brundage</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-02T09:51:42+00:00">November 2, 2010 at 9:51 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s actually even more complicated. The search engine isn&rsquo;t a single entity, but rather many online and offline processes, each of which can implement different rules.</p>
<p>Let&rsquo;s assume for a moment that the web page and server code correctly handles and logs the Unicode text representation (so that Ã¶ isn&rsquo;t corrupted somewhere along the way); surprisingly many sites already fail this step.</p>
<p>You&rsquo;ve got things like autocomplete, stemming, spell correction, and synonym handling, each of which is distinct software that normalizes it&rsquo;s inputs differently. Then you&rsquo;ve got all the offline processes that analyze query logs, index documents, extract terms, etc. Some of these can map oe to Ã¶ while others don&rsquo;t.</p>
<p>In your example, it&rsquo;s unclear which of these systems are not treating these queries as equivalent. It might even be ranking; maybe uncyclopedia is in the results somewhere, but unnotmalized query-dependent ranking changes it&rsquo;s order of appearance. By playing with additional constraints (eg, site:uncyclopedia.com) you may be able to further probe the implementation.</p>
<p>Text normalization is still an afterthought in most software, even at Google.</p>
</div>
</li>
<li id="comment-53855" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/41bd47de5d865b20e611843a0b0ef60c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/41bd47de5d865b20e611843a0b0ef60c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Brundage</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-02T10:09:36+00:00">November 2, 2010 at 10:09 am</time></a> </div>
<div class="comment-content">
<p>Speaking of autocomplete, I typed that on an iPhone, and it &ldquo;corrected&rdquo; its to &ldquo;it&rsquo;s&rdquo; without my noticing. But at least it handles umlauts. 🙂</p>
</div>
</li>
<li id="comment-53859" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-02T16:13:04+00:00">November 2, 2010 at 4:13 pm</time></a> </div>
<div class="comment-content">
<p>@Paul</p>
<p>You are quite right that search engines could be more interactive and that Google&rsquo;s innovation in this regard is great.</p>
</div>
</li>
<li id="comment-53857" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d1c93083fe659ce6bf7af2af44613d95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d1c93083fe659ce6bf7af2af44613d95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris Betti</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-02T13:39:36+00:00">November 2, 2010 at 1:39 pm</time></a> </div>
<div class="comment-content">
<p>I liked Michael&rsquo;s post because it pointed out the complications inherent in the whole stack, from source text to web servers and on through any other storage and presentation tools (I would add the lack of capability for users to represent diacritical characters, in either unicode form, in an input text field to the list as well, for engines that don&rsquo;t normalize both user input and index).</p>
<p>I found Daniel&rsquo;s blog post interesting because he&rsquo;s measuring the search engines ability to help users wade through this dirty data. Despite the complications inherent in the whole stack, what can the engines do to get english speaking users the right information? As the full stack of tools improve their internationalization support, we&rsquo;ll get improved source data, but for now, dirty data is a fact of life for the search engines.</p>
<p>Complicating the picture even more is when two separate input concepts normalize to homographs. For example, Russian pisÃ¡t &ldquo;to write&rdquo; vs pÃ­sat &ldquo;to piss&rdquo; (I couldn&rsquo;t enter the russian characters successfully, but this version suffices). There are situations in which a non-native russian speaker could become pretty embarassed when presenting to a russian speaking audience, all because the search engine decided to normalize the two terms to the same thing.</p>
<p>One thing the experts could look into is, how are foreign search providers handling these issues? It&rsquo;s possible that the answer for english speaking individuals is to normalize everything, but it may be worth investigating the foreign search provider&rsquo;s tactics for handling the wealth of dirty data out there on the &lsquo;net.</p>
</div>
</li>
<li id="comment-53858" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://futurepaul.blogspot.com" class="url" rel="ugc external nofollow">Paul</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-02T14:47:19+00:00">November 2, 2010 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p>NLP is fun in that so often you run into cases like this where there just isn&rsquo;t a universal right answer. Googling Godel, I see a gallery on the front page. What if that&rsquo;s the Godel I want? Pulling GÃ¶del in would dilute my results even more. Even capitalization can be significant. &lsquo;Papa&rsquo; = Spanish for pope, &lsquo;papa&rsquo; = Spanish for potato. </p>
<p>I like Google&rsquo;s use of &ldquo;did you mean &rdquo; to suggest things I might have meant, but still let me see both sets. For researchers who really care about this, ways of explicitly enabling stemming/character normalization/etc. is useful (but overly complex for a Google). In the long run I think the solution is machine intelligence that can differentiate contexts (did you mean the vegetable or the pontiff? Let me find all the pages it was used in that sense)</p>
</div>
</li>
<li id="comment-53860" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/41bd47de5d865b20e611843a0b0ef60c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/41bd47de5d865b20e611843a0b0ef60c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Brundage</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-03T12:30:24+00:00">November 3, 2010 at 12:30 pm</time></a> </div>
<div class="comment-content">
<p>Great points about homographs, capitalization, etc. affecting interpretation of the search. Of course, the minute we get beyond something &ldquo;simple&rdquo; like character equivalence classes, we&rsquo;re into all the challenges that make search such a fun and exciting space to work in.</p>
<p>Stop phrases (&ldquo;The Help&rdquo; is the title of a very popular book), punctuation (C++, R.S.V.P., WALL-E, Math.rand(), etc.), mixed encodings (especially in the Far East region, where you get URL-escaped GBK mixed with CJK in the same search request), etc.</p>
<p>And these are all just the cases where we assume perfect queries and corpus. In the real world, spelling errors, encoding errors, and disagreement about canonical form abound. Recent examples include the movie &ldquo;Kick-Ass&rdquo; (or is it &ldquo;Kick ass&rdquo; or &ldquo;Kickass&rdquo;?), the product &ldquo;iPhone&rdquo; (or is it &ldquo;i-Phone&rdquo; or &ldquo;eye phone&rdquo; or oops &ldquo;iPone&rdquo; or &ldquo;iPhome&rdquo;), etc. Maybe you misplaced the umlaut: KÃ¼rt Godel (which seems to &ldquo;work&rdquo; in both Google and Bing, with no spell-correction or backout links displayed by either engine).</p>
<p>Fun stuff!</p>
</div>
</li>
<li id="comment-53983" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dcc20dcc7d6c03797bb8ddda41d01e6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dcc20dcc7d6c03797bb8ddda41d01e6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.youtube.com/" class="url" rel="ugc external nofollow">Richard</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-06T19:51:17+00:00">December 6, 2010 at 7:51 pm</time></a> </div>
<div class="comment-content">
<p>Great post.</p>
</div>
</li>
</ol>
