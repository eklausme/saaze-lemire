---
date: "2021-08-21 12:00:00"
title: "The big-load anti-pattern"
index: false
---

[16 thoughts on &ldquo;The big-load anti-pattern&rdquo;](/lemire/blog/2021/08-21-the-big-load-anti-pattern)

<ol class="comment-list">
<li id="comment-595595" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">---</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-21T12:34:34+00:00">August 21, 2021 at 12:34 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
roughly the size of your CPU cache
</p></blockquote>
<p>That&rsquo;s often too small, although if you&rsquo;re talking about L3 caches on many present day CPUs, it&rsquo;s probably okay. The cost of context switching and I/O is significantly worse than RAM speed on most setups, so you often want to tune for I/O as opposed to CPU cache, such as making large read requests to disk (particularly if it&rsquo;s a harddisk).</p>
<p>What&rsquo;s probably more important is doing async I/O, so your processing can occur whilst the disk is pulling in data for you. Also, avoiding random I/O, as sequential I/O is generally fastest (i.e. be careful with reading too many things at the same time).</p>
<p>Since I/O costs typically dwarf RAM speeds, large files are better than smaller ones (lowers random access costs and performance penalties with opening files) &#8211; it&rsquo;s actually why many games go to the effort of packing all their assets into archives because it&rsquo;s faster to deal with one big file than many smaller ones.</p>
</div>
<ol class="children">
<li id="comment-595605" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-21T13:53:19+00:00">August 21, 2021 at 1:53 pm</time></a> </div>
<div class="comment-content">
<p>Yes, using many tiny files would be a performance anti-pattern of its own (which I refer to as &ldquo;small-load&rdquo;).</p>
<p>Note that in my context, I assume a high-performance SSD. If you are using a spinning drive, then you may be limited to a few megabytes per second (if that) and my whole post is irrelevant.</p>
</div>
<ol class="children">
<li id="comment-595642" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">---</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-21T22:48:37+00:00">August 21, 2021 at 10:48 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s not just many tiny files, <em>any</em> splitting can slow you down because each file you have incurs overhead with opening/closing it (and can reduce sequential accesses because filesystems are less likely to place these specific files sequentially on disk). Granted, if the files are large enough, the cost is pretty small, but it doesn&rsquo;t mean you should arbitrarily introduce splitting with the assumption that it improves performance.</p>
<p>Most SSDs are limited by SATA bandwidth, so around 500MB/s max. If you&rsquo;re using a cloud hosting platform, you&rsquo;ll also be limited by network bandwidth, so possibly even less.<br/>
Even if you&rsquo;re using a high performance modern NMVe drive, you&rsquo;re still stuck with needing to do kernel traps when issuing reads.</p>
<p>As such, the point stands that you shouldn&rsquo;t optimise based on CPU cache, but on whatever is most efficient for I/O. 1GB is likely too big, but 1MB is likely too small.<br/>
SSDs obviously have different performance characteristics to HDDs, but fortunately, for sequential access, the guidelines for the two are the same.</p>
</div>
<ol class="children">
<li id="comment-595737" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-22T16:04:49+00:00">August 22, 2021 at 4:04 pm</time></a> </div>
<div class="comment-content">
<p>I take your point that many people&rsquo;s IO is limited to megabytes per second. Certainly, my home Internet peaks at about 50 MB/s (download).</p>
<p>On the latest servers I purchased, I am <em>measuring</em> bandwidths for sequential reads that are > 3 GB/s (using standard methodologies). AWS provides gigabytes of network bandwidth (I <em>measured</em> over 4 GB/s for large files in node-to-node transfer).</p>
</div>
<ol class="children">
<li id="comment-595801" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">---</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-23T04:41:16+00:00">August 23, 2021 at 4:41 am</time></a> </div>
<div class="comment-content">
<p>AWS scales available network bandwidth based on your instance size. All but the few largest instance sizes will not achieve GB/s network bandwidth.</p>
<p>Also note that you&rsquo;re measuring sequential I/O. This is usually achievable if everything is in one file, however, if it&rsquo;s spread out across multiple files, you&rsquo;re less likely to get fully sequential I/O.</p>
</div>
<ol class="children">
<li id="comment-595845" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-23T13:44:40+00:00">August 23, 2021 at 1:44 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>AWS scales available network bandwidth based on your instance size. All but the few largest instance sizes will not achieve GB/s network bandwidth.</p>
</blockquote>
<p>That&rsquo;s true. Small instances also have relatively little RAM (e.g., 4 GB per core).</p>
<blockquote>
<p>however, if it’s spread out across multiple files, you’re less likely to get fully sequential I/O.</p>
</blockquote>
<p>This is absolutely true and worth noting.</p>
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
<li id="comment-595618" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/edbd5f1c2f535b14165ae883fa7c3f37?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/edbd5f1c2f535b14165ae883fa7c3f37?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jens Alfke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-21T17:22:49+00:00">August 21, 2021 at 5:22 pm</time></a> </div>
<div class="comment-content">
<p>Memory-mapping the file (e.g. with mmap) can give you the best of both worlds. You can code as though the file were all in memory, which is simpler, and you can even backtrack or peek forward if necessary. But the computer doesn’t have to copy the whole file into RAM.</p>
<p>(Depending on the OS, you may lose some performance because the file is read in smaller chunks, possibly as small as 4KB. But in practice the kernel will usually see your access pattern and read ahead in bigger chunks, which btw gives you async I/O for free.)</p>
</div>
<ol class="children">
<li id="comment-595622" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-21T18:11:13+00:00">August 21, 2021 at 6:11 pm</time></a> </div>
<div class="comment-content">
<p>Memory mapping is a great approach but underneath it is limited by the same fundamental principles. It does not bypasses CPU cache and RAM.</p>
<p>(I am aware that you know this, but I am clarifying it.)</p>
</div>
<ol class="children">
<li id="comment-595730" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://travisdowns.github.io" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-22T14:57:47+00:00">August 22, 2021 at 2:57 pm</time></a> </div>
<div class="comment-content">
<p>I would argue that memory mapping <em>is</em> fundamentally different than the big allocate-read-process approach. Effectively it is like your suggested streaming approach: the memory only takes one trip to the inner circle.</p>
<p>Consider the case where the mapped pages aren&rsquo;t in the page cache. You map the pages, and only a small structure is created in the kernel recording the mapping (a so-called VMA in the case of Linux). Then you start processing the region: each time you get to a new 4k page, the kernel will map in that page, including it reading from storage. Then, in userspace the page will be hot in cache.</p>
<p>Some of the details may vary (e.g., the kernel may &ldquo;read ahead&rdquo; more than 4k page to make the IO faster), but these generally make things better, not worse.</p>
<p>You can do the same analysis for the case were the page are already hot in the page cache, and again this method is competitive with streaming.</p>
<p>Or, as you usually prefer, you can test this. I have found the mmap approach generally somewhat faster than the <code>read()</code>-based streaming approach, but this varies a bit by OS, kernel version, etc. Here&rsquo;s a <a href="https://stackoverflow.com/a/41419353/149138" rel="nofollow ugc">bit more</a> on mmap vs <code>read()</code> — more from the side of why mmap isn&rsquo;t just way better than read() but rather competitive with the winner decided by smaller factors.</p>
</div>
<ol class="children">
<li id="comment-595731" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-22T15:09:09+00:00">August 22, 2021 at 3:09 pm</time></a> </div>
<div class="comment-content">
<p>@Travis</p>
<p>Suppose that I have a CSV file. It is huge. I memory map it. Then I load the CVS file into a tabular data structure, with parsed entries (think excel spreadsheet).</p>
<p>How does it help that the file was memory mapped?</p>
</div>
<ol class="children">
<li id="comment-595734" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-22T15:18:08+00:00">August 22, 2021 at 3:18 pm</time></a> </div>
<div class="comment-content">
<p>But I agree, of course, that if you are reading the file, say line by line, a memory map may be effectively equivalent to code that looks like line-by-line reading. (I would expect the memory map to be less efficient in practice though it does not have to be.)</p>
<p>What I am warning people against is the belief that memory mapping is somehow intrinsically different from loading the data into memory.</p>
</div>
</li>
<li id="comment-595739" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://travisdowns.github.io" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-22T16:33:31+00:00">August 22, 2021 at 4:33 pm</time></a> </div>
<div class="comment-content">
<p>Sure, let&rsquo;s be explicit about it using your example.</p>
<p>Let&rsquo;s read a spreadsheet of size <code>N</code> on a system with a single cache level of size <code>C</code>. As I understand it, your point is that &ldquo;loading&rdquo; (reading from disk and/or page cache) the whole file, prior to processing the entire file is slow because most bytes in the file must be brought into RAM at least twice, once when the file is loaded and once when it is processed.</p>
<p>To be even more explicit, in pseudo-code, the &ldquo;big load&rdquo; scenario looks something like this, I think:</p>
<p><code>// allocate a buffer of size N (size of the file)<br/>
// we assume here this doesn't do much<br/>
// work, it doesn't touch N bytes!<br/>
byte buffer[] = allocate(file.size);</p>
<p>// read the entire file into the buffer<br/>
// this necessarily brings all N bytes of the<br/>
// file into RAM, but only at most C bytes<br/>
// can remain in cache, since that's the size<br/>
// of the cache<br/>
read(file.path, buffer);</p>
<p>// now, parse the array of bytes into the<br/>
// in-memory DOM or whatever you want<br/>
// to call it. This necessarily touches all N<br/>
// bytes again, so brings at least N - C bytes<br/>
// into cache. We assume N &gt;&gt; C in the "big"<br/>
// scenario, so N - C ~= N.<br/>
spreadsheet_DOM = parse(buffer);<br/>
</code></p>
<p>Does that look right?</p>
<p>As an alternative, you suggest that you process the file in chunks, which might look like:</p>
<p><code>byte buffer[C / 2]; // a buffer half the size of cache</p>
<p>// start with empty DOM<br/>
spreadsheet_DOM = empty();</p>
<p>for (c = 0; c &lt; file.size; c += C / 2) {<br/>
// read C / 2 bytes<br/>
read(file.path, buffer);<br/>
// then parse those new bytes into cells which<br/>
// we parse and add to the spreadsheet<br/>
// the new cells in the buffer<br/>
spreadsheet_DOM.add_cells(buffer);<br/>
}<br/>
</code></p>
<p>Here, we only bring bytes into memory once, in the read call, they stay in cache for the subsequent add_cells call. Performance will be much better (surprisingly, perhaps even better than 2x better as your test shows).</p>
<p>So we are calling the second case &ldquo;fundamentally different&rdquo; than the first right? You say that using mmap will be like the first in the fundamental sense of memory movement, and I say it will be like the second, right?</p>
<p>We might as well agree on that before looking at the mmap-the-entire-file scenario.</p>
</div>
<ol class="children">
<li id="comment-595740" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://travisdowns.github.io" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-22T16:34:45+00:00">August 22, 2021 at 4:34 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, when I said &ldquo;must be brought into RAM at least twice&rdquo; I meant &ldquo;brought from RAM to the core at least twice&rdquo;.</p>
</div>
</li>
<li id="comment-595742" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-22T16:58:55+00:00">August 22, 2021 at 4:58 pm</time></a> </div>
<div class="comment-content">
<p>No I do not agree with the position you attribute to me. I agree with the position you attribute to yourself.</p>
<p>You are missing the step here where you actually use the data. You are only deserializing. So try adding a step where you sum up the columns for example.</p>
</div>
<ol class="children">
<li id="comment-595750" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://travisdowns.github.io" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-22T18:10:45+00:00">August 22, 2021 at 6:10 pm</time></a> </div>
<div class="comment-content">
<p>I see. Yes, then I agree: if you have more than 1 processing operation (including here de-serialization in that category) that wants to iterate over the in-memory data (including output from a previous step), mmap won&rsquo;t help you avoid bringing the entire data in at least once. It only helps for the phase directly following the mmap&rsquo;ing (which I think is all you can ask from it).</p>
<p>In that sense it is different: if you can organize your processing, including deserialization, into a single-pass, <code>mmap</code>ing the entire file will allow the whole thing to be streaming, while <code>read()</code>ing into a large buffer won&rsquo;t. So my point stands if you are able to write a <code>deserialize_and_sum()</code> operation that works on a large buffer in a single pass.</p>
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
<li id="comment-596064" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.lbs.ca/" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-25T16:48:17+00:00">August 25, 2021 at 4:48 pm</time></a> </div>
<div class="comment-content">
<p>Indeed, so much so that even for data that is processed by looking at other data in the same file (in your spreadsheet example, another column), we look at how far ahead/behind we need to look, and read a window of data only that wide and then read single columns and process what is in memory.</p>
<p>We typically perform 2-5 different mathematical data processes on each column of data, and each is performed in it&rsquo;s own thread, so we observe some multi-processing taking place even against a slow disk read and write at each end.</p>
<p>Not only does this approach allow us to deal with data sets that are as large as can fit on disk, it also allows us to accurately predict memory requirements up front (and keeps them very small).</p>
</div>
</li>
</ol>
