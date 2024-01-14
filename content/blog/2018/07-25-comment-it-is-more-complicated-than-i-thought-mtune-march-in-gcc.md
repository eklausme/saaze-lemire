---
date: "2018-07-25 12:00:00"
title: "It is more complicated than I thought: -mtune, -march in GCC"
index: false
---

[17 thoughts on &ldquo;It is more complicated than I thought: -mtune, -march in GCC&rdquo;](/lemire/blog/2018/07-25-it-is-more-complicated-than-i-thought-mtune-march-in-gcc)

<ol class="comment-list">
<li id="comment-321471" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/445eb81d43da4bb6d04bfb4d67bedd92?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/445eb81d43da4bb6d04bfb4d67bedd92?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/stefantalpalaru" class="url" rel="ugc external nofollow">stefantalpalaru</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-25T20:49:01+00:00">July 25, 2018 at 8:49 pm</time></a> </div>
<div class="comment-content">
<p>Sounds like it&rsquo;s an architecture identification bug. If you can replicate it with gcc-8.1 (or even better, the Git HEAD), report it on GCC&rsquo;s bug tracker: <a href="https://gcc.gnu.org/bugzilla/" rel="nofollow ugc">https://gcc.gnu.org/bugzilla/</a></p>
</div>
<ol class="children">
<li id="comment-323914" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-28T17:36:15+00:00">July 28, 2018 at 5:36 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s not a bug per se, because it happens when GCC is too old to know about the new arch. So it doesn&rsquo;t happen (for Skylake) on newer GCC, but it would presumabley still happen with a newer CPU uarch.</p>
</div>
</li>
</ol>
</li>
<li id="comment-321547" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d7489a0d0a7e7b43a5441de467c4e7f2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d7489a0d0a7e7b43a5441de467c4e7f2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">GeorgeL</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-25T22:01:28+00:00">July 25, 2018 at 10:01 pm</time></a> </div>
<div class="comment-content">
<p>Maybe it depends on your operating system and GCC version. On CentOS 7.5 with native GCC 4.8.5 and even with GCC 8.2 RC setting march=native also means mtune=native is set</p>
<p>On Core i7 4790K cpu</p>
<p>with GCC 4.8.5 native</p>
<p><code>gcc -v<br/>
Using built-in specs.<br/>
COLLECT_GCC=gcc<br/>
COLLECT_LTO_WRAPPER=/usr/libexec/gcc/x86_64-redhat-linux/4.8.5/lto-wrapper<br/>
Target: x86_64-redhat-linux<br/>
Configured with: ../configure --prefix=/usr --mandir=/usr/share/man --infodir=/usr/share/info --with-bugurl=http://bugzilla.redhat.com/bugzilla --enable-bootstrap --enable-shared --enable-threads=posix --enable-checking=release --with-system-zlib --enable-__cxa_atexit --disable-libunwind-exceptions --enable-gnu-unique-object --enable-linker-build-id --with-linker-hash-style=gnu --enable-languages=c,c++,objc,obj-c++,java,fortran,ada,go,lto --enable-plugin --enable-initfini-array --disable-libgcj --with-isl=/builddir/build/BUILD/gcc-4.8.5-20150702/obj-x86_64-redhat-linux/isl-install --with-cloog=/builddir/build/BUILD/gcc-4.8.5-20150702/obj-x86_64-redhat-linux/cloog-install --enable-gnu-indirect-function --with-tune=generic --with-arch_32=x86-64 --build=x86_64-redhat-linux<br/>
Thread model: posix<br/>
gcc version 4.8.5 20150623 (Red Hat 4.8.5-28) (GCC)<br/>
</code></p>
<p>you get for march and mtune</p>
<p><code>gcc -march=native -Q --help=target | egrep -- '-march=|-mtune' | cut -f3<br/>
core-avx2<br/>
core-avx2<br/>
</code></p>
<p>with GCC 8.2 RC snapshot reported as 8.1.1 right now</p>
<p><code>gcc -v<br/>
Using built-in specs.<br/>
COLLECT_GCC=gcc<br/>
COLLECT_LTO_WRAPPER=/opt/gcc-8.2.0-RC-20180719/libexec/gcc/x86_64-redhat-linux/8/lto-wrapper<br/>
Target: x86_64-redhat-linux<br/>
Configured with: ../configure --prefix=/opt/gcc-8.2.0-RC-20180719 --disable-multilib --enable-bootstrap --enable-plugin --with-gcc-major-version-only --enable-shared --disable-nls --enable-threads=posix --enable-checking=release --with-system-zlib --enable-__cxa_atexit --disable-install-libiberty --disable-libunwind-exceptions --enable-gnu-unique-object --enable-linker-build-id --with-linker-hash-style=gnu --enable-languages=c,c++ --enable-initfini-array --disable-libgcj --enable-gnu-indirect-function --with-tune=generic --build=x86_64-redhat-linux --enable-lto --enable-gold<br/>
Thread model: posix<br/>
gcc version 8.1.1 20180719 (GCC<br/>
</code></p>
<p>you get for march and mtune</p>
<p><code>gcc -march=native -Q --help=target | egrep -- '-march=|-mtune' | cut -f3<br/>
haswell<br/>
haswell<br/>
</code></p>
<p>and specifically for haswell target you get for march and mtune</p>
<p><code>gcc -march=haswell -Q --help=target | egrep -- '-march=|-mtune' | cut -f3<br/>
haswell<br/>
haswell<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-321793" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-26T03:20:17+00:00">July 26, 2018 at 3:20 am</time></a> </div>
<div class="comment-content">
<p>You need to run the test with a compiler that doesn&rsquo;t know about your arch to make this interesting. In particular, for gcc 8 your results are as expected: Haswell is known by gcc and you are running on Haswell, so you get march and mtune set to Haswell.</p>
<p>For the gcc 4.8.5 test, it isn&rsquo;t clear what it means: core-avx2 is no longer a supported option for gcc (at least according to the manual): it reminds me of the icc options? It doesn&rsquo;t make sense to tune for &ldquo;core-avx2&rdquo; since that is not an micro-architecture, so it&rsquo;s hard to say what gcc is doing internally. Perhaps this behavior changed in later versions of gcc.</p>
</div>
<ol class="children">
<li id="comment-322055" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d7489a0d0a7e7b43a5441de467c4e7f2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d7489a0d0a7e7b43a5441de467c4e7f2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">GeorgeL</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-26T09:24:13+00:00">July 26, 2018 at 9:24 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
For the gcc 4.8.5 test, it isn&rsquo;t clear what it means: core-avx2 is no<br/>
longer a supported option for gcc (at least according to the manual):<br/>
it reminds me of the icc options? It doesn&rsquo;t make sense to tune for<br/>
â€œcore-avx2â€ since that is not an micro-architecture, so it&rsquo;s hard to<br/>
say what gcc is doing internally. Perhaps this behavior changed in<br/>
later versions of gcc.
</p></blockquote>
<p>Ah didn&rsquo;t realise core-avx2 was no longer supported. Probably explains why i had issues compiling PHP 7.3 alphas &#8211; on Skylake cpu failed to compile with Zend Opcache on GCC 4.8.5 but compiled fine on GCC 7.3.1 🙂</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-321568" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-25T22:27:37+00:00">July 25, 2018 at 10:27 pm</time></a> </div>
<div class="comment-content">
<p>A note about the gcc documentation you mentioned:</p>
<blockquote><p>
Specifying -march=cpu-type implies -mtune=cpu-type.
</p></blockquote>
<p>It could be clearer: what it should say is that &ldquo;Specifying -march=cpu-type implies -mtune=cpu-type <strong>if not otherwise explicitly specified.</strong>&rdquo; I had always interpreted it that way, but probably because before reading it I had seen lots of examples where both are specified (indeed, the documentation hints at that usage).</p>
<p>That is, it has always been the case that passing both <code>-march</code> and <code>-mtune</code> to the same compilation makes sense: you often want to target some fairly broad range of chips (say, since Sandy Bridge) but optimize for the chip you know will be the most common in your case in the immediate future (say Skylake).</p>
<p>You can see some method to gcc&rsquo;s madness here. When you specify that gcc should use instructions and tuning for your arch, but you run into a problem when the arch is newer than gcc knows. In that case, what gcc does is different for the &ldquo;march&rdquo; side of things versus the &ldquo;mtune&rdquo;.</p>
<p>For the march, you are just talking about available instructions and instruction sets. Any version of GCC knows about some set of instruction sets, usually corresponding to the newest arch it knows about. It can also query the instruction sets supported by the current CPU. If it as unknown type, it could match it against the arches it knows about and if there is an exact match or a &ldquo;superset match&rdquo; it could just use that &#8211; and so it does: it selects Broadwell since from an ISA point of view, Skylake <em>is</em> Broadwell (Skylake may support a few extra instructions such as MPX, but since gcc doesn&rsquo;t know about them, it wouldn&rsquo;t query for them and so this logic probably gets the same result whether it is using exact match or superset match).</p>
<p>Another way of looking at it is that <code>-march=broadwell</code> is just a shortcut for specifying a long list of <code>-m</code> options like <code>-mavx</code>, <code>-mavx2</code>, <code>-mpclmul</code>, etc, and the same list can be generated for <code>-march=native</code> by querying the processor&rsquo;s capabilities, which may then be compressed to something like <code>-march=broadwell</code> if it matches the list implied by Broadwell.</p>
<p>All this is good because it prevents a huge regression when using <code>-march=native</code>: if it didn&rsquo;t do this when you upgraded your CPU you&rsquo;d suddenly lose access to AVX2, AVX, any version of SSE greater than 2 and so on, since gcc would just be like &ldquo;Oh, I don&rsquo;t know about this CPU so I&rsquo;ll use the based x86-64 profile&rdquo;. So I think we can say gcc is doing a reasonable thing on the <code>-march</code> side of things.</p>
<p>That leaves <code>-mtune</code>. The main problem as you put is that <code>-march=native</code> implies (for example) <code>-mtune=broadwell</code> on Skylake chips when gcc doesn&rsquo;t know about Skylake, but it does <em>not</em> imply <code>-mtune=broadwell</code>. In fact, in this particular case, <code>-mtune=broadwell</code> would be the best option: <code>-mtune=generic</code> is worse.</p>
<p>We know that, however, only with the benefit of hindsight: Skylake performs very much like Broadwell (which performs essentially identical to Haswell before it), so Broadwell is a good tune for Skylake. That certainly hasn&rsquo;t always been the case though: when the switch to the P4 uarch was made, the tune for the &ldquo;previous&rdquo; arch would have been a bad match for P4, and same when P4 was in turn dropped in favor of a return to the PPro/PentiumM architecture.</p>
<p>So the rule of &ldquo;use the latest arch (from same manufacturer?)&rdquo; would have worked well recently but not in the past. It would also have trouble when some manufacturer doesn&rsquo;t have a linear list of architectures, but rather also has various secondary archictectures, like Intel with Atom and the Phi/Knights* stuff.</p>
<p>The rule of &ldquo;use generic tune&rdquo; seems like a reasonable compromise, and also has the advantage of being easier to implement: no need to implement an ordering of architectures or deal with the various families etc. So even though I originally thought this was really dumb, I can see the logic.</p>
<p>Last note. You write:</p>
<blockquote><p>
By default, when unspecified, â€œ-mtune=genericâ€ applies which means&#8230;
</p></blockquote>
<p>I think you know this, but one should be clear that this only applies if you don&rsquo;t also specify <code>-march</code>. Usually you want to specific <code>-march</code> since the difference there is huge: newer instruction sets, and <code>-mtune</code> comes along for the side.</p>
</div>
</li>
<li id="comment-321570" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-25T22:30:36+00:00">July 25, 2018 at 10:30 pm</time></a> </div>
<div class="comment-content">
<p>I hate no editing capabilities, and this typo is too important: it should read:</p>
<blockquote><p>
The main problem as you put is that -march=native implies (for<br/>
example) <code>-march=broadwell</code> on Skylake chips when gcc doesn&rsquo;t know about<br/>
Skylake, but it does not imply <code>-mtune=broadwell</code>
</p></blockquote>
</div>
</li>
<li id="comment-321658" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-26T00:26:59+00:00">July 26, 2018 at 12:26 am</time></a> </div>
<div class="comment-content">
<p>Thanks. This is an appropriate and timely bit of information, given my upcoming exercise. 🙂</p>
<p>I can somewhat understand the choice of compiler-default behaviors, but also expect it might wander a bit between versions. This should not matter for most folk, for most problems, but if you are working a problem targeted for a specific processor, this stuff matters.</p>
</div>
</li>
<li id="comment-322004" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e9486eb138a602b0aaac1e6db6c1d64d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e9486eb138a602b0aaac1e6db6c1d64d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://shalom.craimer.org" class="url" rel="ugc external nofollow">Shalom Craimer</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-26T08:10:32+00:00">July 26, 2018 at 8:10 am</time></a> </div>
<div class="comment-content">
<p>For the longest time, a codebase I worked on had <code>-march=native -mtune=native</code>. It was just easier to let GCC figure things out instead of specifying the actual values, and it worked, so why bother?</p>
<p>But it does. And this article is a great link to share with people who don&rsquo;t know that.</p>
<p>The reason I had to change the code base was virtual machines. Some of the build was being done in a QEMU VM, so the CPU returned from <code>procinfo</code> was a QEMU. This broke the build entirely, since GCC couldn&rsquo;t figure out what the CPU architecture was. But if it hadn&rsquo;t been for that, I would not have been aware of the issues with <code>-march=native -mtune=native</code>. So thank you for writing the article to bring this to more people&rsquo;s attention.</p>
</div>
</li>
<li id="comment-322569" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/445eb81d43da4bb6d04bfb4d67bedd92?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/445eb81d43da4bb6d04bfb4d67bedd92?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/stefantalpalaru/" class="url" rel="ugc external nofollow">stefantalpalaru</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-27T00:42:43+00:00">July 27, 2018 at 12:42 am</time></a> </div>
<div class="comment-content">
<p>gcc-8.2 fixes the Skylake identification bug: <a href="https://www.phoronix.com/scan.php?page=news_item&#038;px=GCC-8.2-Relased" rel="nofollow ugc">https://www.phoronix.com/scan.php?page=news_item&#038;px=GCC-8.2-Relased</a></p>
</div>
</li>
<li id="comment-324311" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-29T07:45:59+00:00">July 29, 2018 at 7:45 am</time></a> </div>
<div class="comment-content">
<p>If the compiler does not <em>know</em> the actual architecture &#8211; you mentioned that broadwell is not correct, just close enough &#8211; how is it going to know that tuning for broadwell is more appropriate than tuning generic? Because apparently it is not a broadwell.</p>
<p>It seems consistent to me apply generic tuning for a CPU that the compiler does not (yet) have enough details. It cannot just assume that broadwell <em>tuning</em> is the best choice for all future broadwell successor CPUs.</p>
</div>
<ol class="children">
<li id="comment-324404" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-29T14:02:04+00:00">July 29, 2018 at 2:02 pm</time></a> </div>
<div class="comment-content">
<p><em>It seems consistent to me apply generic tuning for a CPU that the compiler does not (yet) have enough details. </em></p>
<p>It is not wrong, but I would argue that it is not possible to infer this behaviour from the documentation. So the net result is a surprise, and surprises are not good.</p>
</div>
</li>
</ol>
</li>
<li id="comment-357695" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3edfe3d7ddd58c637a125fc9177b226d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3edfe3d7ddd58c637a125fc9177b226d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Quentin N</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-16T23:54:24+00:00">October 16, 2018 at 11:54 pm</time></a> </div>
<div class="comment-content">
<p>One of the longest running threads in compiler development, this is a great post with the key question asked, some valuable introspection tools, and the general state of things explained</p>
<p>The two key discussions are 1) march is generally incrementally inclusive across processor models/capabilities, and 2) the tools themselves adapt over time to the available models.</p>
<p>Worth noting that the underlying tools (assembler, linker) can be sensitive to these variables.</p>
<p>I <em>wish</em> gcc and clang would both auto-generate docs to show the tune/arch/HW (and if dependent on the OS) decision tree. Maybe I need to pony up some open source development effort&#8230;</p>
</div>
</li>
<li id="comment-403468" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/635222a3ac8443f92647a880733b2949?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/635222a3ac8443f92647a880733b2949?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Aaron Max Fein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-24T23:29:32+00:00">April 24, 2019 at 11:29 pm</time></a> </div>
<div class="comment-content">
<p>Great thread indeed, very cool to get a better grip on this&#8230; was making the same assumptions and occasionally wondered about it&#8230; 🙂</p>
</div>
</li>
<li id="comment-424740" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e083d60d3d3fd321b29b37ed92054392?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e083d60d3d3fd321b29b37ed92054392?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Martin Guttman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-20T15:48:46+00:00">August 20, 2019 at 3:48 pm</time></a> </div>
<div class="comment-content">
<p>I find it to be more of a documentation broad wording issue and not a bug per se. Where it says :</p>
<blockquote><p>
Specifying -march=cpu-type implies -mtune=cpu-type
</p></blockquote>
<p>It exactly means <em>cpu-type</em>, not <em>attribute-option</em>. Since <code>native</code> it&rsquo;s not a <code>cpu-type</code> but rather a compiler instruction to try to match the current architecture, it does not cascade to the <code>-mtune</code> option, and is well within the wording. The confusing wording, but correct one.</p>
</div>
<ol class="children">
<li id="comment-424746" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-20T17:01:46+00:00">August 20, 2019 at 5:01 pm</time></a> </div>
<div class="comment-content">
<p>I am not sure I ever believed it was a bug. It is just complicated.</p>
</div>
<ol class="children">
<li id="comment-654314" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d7b351b8eb694a8c59dcf485a1aac09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d7b351b8eb694a8c59dcf485a1aac09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mingye Wang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-26T13:34:13+00:00">August 26, 2023 at 1:34 pm</time></a> </div>
<div class="comment-content">
<p>For what is worth, on godbolt&rsquo;s x86-64 gcc 13.2, &ldquo;-march=native &#8211;help=target -Q&rdquo; now gives whatever CPU the server happens to be using in &ldquo;-mtune&rdquo;. Using the available versions I found that GCC 7.2 gives generic mtune, but GCC 7.3 does native. I am a bit too lazy to find the commit for now.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
