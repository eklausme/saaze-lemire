---
date: "2020-05-22 12:00:00"
title: "Programming inside a container"
index: false
---

[24 thoughts on &ldquo;Programming inside a container&rdquo;](/lemire/blog/2020/05-22-programming-inside-a-container)

<ol class="comment-list">
<li id="comment-518378" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/25999b45c3bd15412dbf85ca281cde8f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/25999b45c3bd15412dbf85ca281cde8f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Peter Boothe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-22T20:23:12+00:00">May 22, 2020 at 8:23 pm</time></a> </div>
<div class="comment-content">
<p>There is a hack for the second issue. When you launch the container, mount your current directory as the same directory in the container and set your working directory to the same.</p>
<p><code>docker run -v 'pwd':'pwd' -w 'pwd' ubuntu<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-518385" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-22T20:43:19+00:00">May 22, 2020 at 8:43 pm</time></a> </div>
<div class="comment-content">
<p>Nice trick. I will use it.</p>
<p>As for your command, let us see what happens when we run it&#8230;</p>
<pre><code>$ docker run -it -v $(pwd):$(pwd) -w $(pwd) ubuntu bash 
# ls 
ls: cannot open directory '.': Permission denied 

$ docker run -it -v $(pwd):$(pwd):Z -w $(pwd) ubuntu bash  
# ls 
CMakeLists.txt  Dockerfile  README.md  main.cpp  
# touch x.txt 
# exit 
$ ls -al x.txt
-rw-r--r--. 1 root root 0 May 22 16:36 x.txt
</code></pre>
<p>So, first, if you are using a secured linux (and many of my servers are secured linux), the volume binding won&rsquo;t work. That&rsquo;s easily solved.</p>
<p>But then, more critically, as you can see, the file permission is messed up.</p>
</div>
<ol class="children">
<li id="comment-518387" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/25999b45c3bd15412dbf85ca281cde8f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/25999b45c3bd15412dbf85ca281cde8f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Boothe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-22T20:50:47+00:00">May 22, 2020 at 8:50 pm</time></a> </div>
<div class="comment-content">
<p>You can fix the second issue with uid mapping. I haven&rsquo;t needed to use that feature myself, so my advice after this point is more speculative. That said, <a href="https://seravo.fi/2019/align-user-ids-inside-and-outside-docker-with-subuser-mapping" rel="nofollow ugc">https://seravo.fi/2019/align-user-ids-inside-and-outside-docker-with-subuser-mapping</a> looks like another good solution.</p>
</div>
<ol class="children">
<li id="comment-518390" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-22T20:54:27+00:00">May 22, 2020 at 8:54 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>You can fix the second issue with uid mapping.</p>
</blockquote>
<p>Yes. That&rsquo;s what my script does.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-518395" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4807b1b97fee2851d9381f294d794f29?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4807b1b97fee2851d9381f294d794f29?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-22T21:07:52+00:00">May 22, 2020 at 9:07 pm</time></a> </div>
<div class="comment-content">
<p>I use lxd because it feels more like a vm but is a container.</p>
<p><code>lxc launch ubuntu:Alias containerName<br/>
lxc exec containerName -- Command<br/>
lxc stop containerName<br/>
lxc destroy containerName<br/>
</code></p>
<p>&ldquo;LXD is a next generation system container manager. It offers a user experience similar to virtual machines but using Linux containers instead.</p>
<p>It&rsquo;s image based with pre-made images available for a wide number of Linux distributions and is built around a very powerful, yet pretty simple, REST API.&rdquo; from <a href="https://linuxcontainers.org/lxd/" rel="nofollow ugc">https://linuxcontainers.org/lxd/</a></p>
</div>
<ol class="children">
<li id="comment-518610" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-23T00:43:41+00:00">May 23, 2020 at 12:43 am</time></a> </div>
<div class="comment-content">
<p>I am not bound to Docker. It just happens to be everywhere I need to work. I must admit that my approach is a bit of a hack.</p>
</div>
</li>
</ol>
</li>
<li id="comment-518615" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d529bafee19e75a60b00f035a7a58ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d529bafee19e75a60b00f035a7a58ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steven Stewart-Gallus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-23T00:56:10+00:00">May 23, 2020 at 12:56 am</time></a> </div>
<div class="comment-content">
<p><a href="https://docs.fedoraproject.org/en-US/fedora-silverblue/toolbox/" rel="nofollow ugc">https://docs.fedoraproject.org/en-US/fedora-silverblue/toolbox/</a></p>
<p>I think in theory Fedora toolbox could be extended to support multiple Linux distros but probably LXD is your best bet for now.</p>
</div>
</li>
<li id="comment-518806" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7d8f4f75b3ebc65bdf728b325fea4227?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7d8f4f75b3ebc65bdf728b325fea4227?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">agus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-23T05:26:31+00:00">May 23, 2020 at 5:26 am</time></a> </div>
<div class="comment-content">
<p>Daniele, I suggest you trying this tool to develop inside a container. I use it and it is great</p>
<p><a href="https://code.visualstudio.com/docs/remote/containers" rel="nofollow ugc">https://code.visualstudio.com/docs/remote/containers</a></p>
<p>It is native from vscode</p>
</div>
</li>
<li id="comment-518889" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4791adba8697c53d4b6e8b9a6613334?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4791adba8697c53d4b6e8b9a6613334?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://digriz.org.uk" class="url" rel="ugc external nofollow">Alexander Clouter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-23T08:51:51+00:00">May 23, 2020 at 8:51 am</time></a> </div>
<div class="comment-content">
<p>I started with this approach but needed to also cater for services that you deployed which means you really need to include <code>systemd</code> as part of your development environment.</p>
<p>Though wrapped up in a Makefile, it pretty much looks like:</p>
<p><code>env TMPDIR=$(pwd) $(pwd)/packer build -on-error=ask -only docker packer.json<br/>
docker run -it --rm \<br/>
-e container=docker \<br/>
-v $(pwd)/data:/opt/VENDOR/PROJECT/data:ro \<br/>
-v $(pwd)/nginx:/opt/VENDOR/PROJECT/nginx:ro \<br/>
-v $(pwd)/lua:/opt/VENDOR/PROJECT/lua:ro \<br/>
-v $(pwd)/public:/opt/VENDOR/PROJECT/public:ro \<br/>
-v $(pwd)/src:/opt/VENDOR/PROJECT/public/gpt/src:ro \<br/>
--publish=127.0.0.1:8000:80 \<br/>
--publish=127.0.0.1:63790:6379 \<br/>
--tmpfs /run \<br/>
--tmpfs /tmp \<br/>
-v /sys/fs/cgroup:/sys/fs/cgroup:ro \<br/>
--cap-add SYS_ADMIN --cap-add NET_ADMIN --cap-add SYS_PTRACE \<br/>
--stop-signal SIGPWR \<br/>
VENDOR/PROJECT:latest<br/>
</code></p>
<p><a href="https://packer.io" rel="nofollow ugc">Packer</a> generates the Docker container but will also cook my production GCP, AWS, Azure, &#8230; images too.</p>
<p><code>packer.json</code> includes a call out to a <code>setup</code> script that does the grunt work and installs <code>systemd</code> (Debian: <code>systemd-sysv</code>) and sets the entry point to <code>/sbin/init</code>; there are some other minor details (such as <code>passwd -d root</code> so you can do a console login and logging out is via typing <code>halt</code> in the container) but this is the gist of it.</p>
<p>To interact with the deployment you work from the <em>host</em> side and then just reload your service to make it live. You do need to line up your ducks in a row to get those bind mounts into the right place for your service to just pick up on but when you get it right it makes life a lot easier.</p>
<p>As a note I continue to use a shell script over orchestration tools, as well as other container/VM environments, so everything remains accessible to others. The above seems to work on Windows and macOS too.</p>
<p>At the end of the day this is about making it not just easier for myself, but for everyone else.</p>
</div>
<ol class="children">
<li id="comment-518892" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4791adba8697c53d4b6e8b9a6613334?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4791adba8697c53d4b6e8b9a6613334?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://digriz.org.uk" class="url" rel="ugc external nofollow">Alexander Clouter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-23T09:02:12+00:00">May 23, 2020 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>&#8230;those bind mounts are read-only to act as a polite reminder/guard that you should not edit files directly on your &lsquo;server&rsquo; but instead make all changes in the project host side where they can be commited and be re-deployed (hopefully involving just a service reload).</p>
</div>
</li>
</ol>
</li>
<li id="comment-518914" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/12f90d14d9e10c3b7f1c79abbb68334e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/12f90d14d9e10c3b7f1c79abbb68334e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">lloyd konneker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-23T10:26:36+00:00">May 23, 2020 at 10:26 am</time></a> </div>
<div class="comment-content">
<p><a href="https://www.google.com/url?sa=t&amp;rct=j&amp;q=&amp;esrc=s&amp;source=web&amp;cd=&amp;cad=rja&amp;uact=8&amp;ved=2ahUKEwjwsfmq4snpAhVCoXIEHRmyBMgQFjAAegQIAxAB&amp;url=https://github.com/tailhook/vagga&amp;usg=AOvVaw2cESmHd9ruT4yx0i2SyPgf" rel="nofollow ugc">Vagga creates user space containers for developers </a></p>
</div>
</li>
<li id="comment-519804" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-25T09:49:30+00:00">May 25, 2020 at 9:49 am</time></a> </div>
<div class="comment-content">
<p>This approach has undoubtedly been reimplemented multiple times by many people. Two examples I am aware of:</p>
<p><a href="https://github.com/opencomputeproject/OpenNetworkLinux/blob/master/docker/tools/onlbuilder" rel="nofollow ugc">https://github.com/opencomputeproject/OpenNetworkLinux/blob/master/docker/tools/onlbuilder</a></p>
<p><a href="https://github.com/Azure/sonic-buildimage/blob/master/Makefile.work#L244" rel="nofollow ugc">https://github.com/Azure/sonic-buildimage/blob/master/Makefile.work#L244</a></p>
</div>
<ol class="children">
<li id="comment-519838" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-25T12:51:40+00:00">May 25, 2020 at 12:51 pm</time></a> </div>
<div class="comment-content">
<p>Yes. I do not claim to be original.</p>
</div>
</li>
</ol>
</li>
<li id="comment-523977" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d41ee6ea5eda5e7b851ef32d62229bf5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d41ee6ea5eda5e7b851ef32d62229bf5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">vicaya</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-03T22:47:24+00:00">June 3, 2020 at 10:47 pm</time></a> </div>
<div class="comment-content">
<p>LOL, I set this up more than 1 year ago, after tired of having to set up my vim dev env on cluster nodes for debugging: <a href="https://github.com/vicaya/vimdev/blob/master/v" rel="nofollow ugc">https://github.com/vicaya/vimdev/blob/master/v</a> which doesn&rsquo;t require privilege mode.</p>
<p>Note, the repo also integrates with docker hub build automation, which is fairly convenient as well.</p>
</div>
<ol class="children">
<li id="comment-524017" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-04T01:07:56+00:00">June 4, 2020 at 1:07 am</time></a> </div>
<div class="comment-content">
<p>I require privileged access when running the container because, as a programmer, I need to low-level access (performance counters, and so forth). Otherwise, it would not be required.</p>
</div>
</li>
</ol>
</li>
<li id="comment-524536" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/76dc8527d424e1a4387c62758d261ac8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/76dc8527d424e1a4387c62758d261ac8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Boris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T11:43:36+00:00">June 5, 2020 at 11:43 am</time></a> </div>
<div class="comment-content">
<p>Have you looked at singularity?<br/>
It&rsquo;s containers for HPC environments. The idea is the scientist creates his environment (e.g. his laptop) as an image and run on a cluster with this image. Should also work for programming and it&rsquo;s becoming a standard in HPC.<br/>
regards,<br/>
Boris<br/>
<a href="https://singularity.lbl.gov/" rel="nofollow ugc">https://singularity.lbl.gov/</a></p>
</div>
<ol class="children">
<li id="comment-524595" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T12:40:49+00:00">June 5, 2020 at 12:40 pm</time></a> </div>
<div class="comment-content">
<p>I am not exactly sure we need &ldquo;containers for HPC&rdquo;. What is the benefit over Docker?</p>
</div>
<ol class="children">
<li id="comment-524628" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/76dc8527d424e1a4387c62758d261ac8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/76dc8527d424e1a4387c62758d261ac8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Boris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T14:48:04+00:00">June 5, 2020 at 2:48 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not a real expert, but the main ideas are,<br/>
1. security. Docker needs a daemon running as root and the containers running in a root context. Sysadmins don&rsquo;t like that 😉<br/>
Singularity is a program, running under your username.<br/>
2. convenience. Singularity automatically mounts your home directory and the work directory (not sure about the later) into the container, so no extra copying back and forth.<br/>
3. portability. A singularity container is just one big file. Docker containers are build from layers. You can easily convert them to singularity. The advantage is, you can just copy this one big file to a new cluster and don&rsquo;t have to rely on that there are the proper versions of your libraries/programs installed.<br/>
4. reproducability. If you publish a paper, you just have to preserve the singularity container and your dataset and can reproduce the results years later. Docker containers get updated.<br/>
Hope this explains the reasons of this development. It makes it also much easier for sysadmins not to install 10 versions of the same library for different projects. So win-win 🙂<br/>
regards,<br/>
Boris</p>
</div>
<ol class="children">
<li id="comment-524630" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T15:20:55+00:00">June 5, 2020 at 3:20 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Singularity is a program, running under your username.</p>
</blockquote>
<p>So you do not get access to performance counters and the like? I need to be able to access these from time to time. So if privileged access is not feasible, that would make it impossible for me to use such an option.</p>
<blockquote>
<p>Singularity automatically mounts your home directory and the work directory (not sure about the later) into the container, so no extra copying back and forth.</p>
</blockquote>
<p>I do the same with Docker.</p>
<blockquote>
<p>portability. A singularity container is just one big file. Docker containers are build from layers. You can easily convert them to singularity. The advantage is, you can just copy this one big file to a new cluster and don’t have to rely on that there are the proper versions of your libraries/programs installed.</p>
</blockquote>
<p>I am confused about this comment. The whole point of Docker is not to have to worry about the libraries or programs installed on the host.</p>
<blockquote>
<p>reproducability. If you publish a paper, you just have to preserve the singularity container and your dataset and can reproduce the results years later. Docker containers get updated.</p>
</blockquote>
<p>I don&rsquo;t think they do get updated. Not unless you want to get updates. That is an important feature for docker.</p>
<blockquote>
<p>Hope this explains the reasons of this development. It makes it also much easier for sysadmins not to install 10 versions of the same library for different projects. So win-win 🙂<br/>
regards,</p>
</blockquote>
<p>I use docker for this very purpose, so that I do not have to install different versions.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-524634" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/76dc8527d424e1a4387c62758d261ac8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/76dc8527d424e1a4387c62758d261ac8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Boris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T15:46:44+00:00">June 5, 2020 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>Ok,<br/>
I think in a self administered environment there might be not much difference. But Docker was meant to run micro services and has different goals. Sure you can tweak docker, but singularity solves some of the problems without tweaking.<br/>
I&rsquo;m not sure about performance counters, but I doubt it, because of being a userland process.<br/>
The main idea behind it is, that you can test your program small scale on your local machine (maybe in docker) and once you&rsquo;re happy, convert your docker image to singularity and run the production on a cluster.<br/>
The main point is not a lot of clusters will implement docker, because of the inherent security issues. And I think a lot of research needs as much computing power as possible, so you have to think how to scale out.<br/>
Anyhow, it was just a suggestion 🙂<br/>
regards,<br/>
Boris</p>
</div>
</li>
<li id="comment-526044" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6909ff047986f589929faa05d39ff308?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6909ff047986f589929faa05d39ff308?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">pr0PM</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-12T17:18:19+00:00">June 12, 2020 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>Use podman instead of docker most issues will be solved instantly.</p>
</div>
<ol class="children">
<li id="comment-526066" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-12T22:19:14+00:00">June 12, 2020 at 10:19 pm</time></a> </div>
<div class="comment-content">
<p>Podman is linux only, right?</p>
</div>
<ol class="children">
<li id="comment-526073" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6909ff047986f589929faa05d39ff308?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6909ff047986f589929faa05d39ff308?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">pr0PM</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-13T01:47:33+00:00">June 13, 2020 at 1:47 am</time></a> </div>
<div class="comment-content">
<p>Yes, but we have vm and wsl to take care of that. (<a href="https://podman.io/getting-started/installation.html" rel="nofollow ugc">here</a>)</p>
</div>
<ol class="children">
<li id="comment-526075" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-13T02:39:22+00:00">June 13, 2020 at 2:39 am</time></a> </div>
<div class="comment-content">
<p>For me, the point of using docker is that I can have the same workflow no matter what machine I am on (Windows, macOS, any Linux distribution).</p>
<p>Yes. I have VirtualBox, but it has major drawbacks for what I have to do. Running podman inside VirtualBox would be a terrible experience compared to just launching docker.</p>
<p>I also don&rsquo;t want to mess with the systems. I don&rsquo;t want to hack /etc/apt/sources.list.d under ubuntu if I don&rsquo;t need to. Docker is easily to install, fully supported, pretty much everywhere.</p>
<p>I realize that what I write may sound unfair, but I think that using Docker, at this point in time, makes a lot of sense.</p>
<p>I did investigate podman. I am sure it is great for some people&#8230; but I don&rsquo;t find it attractive. When I can just start podman containers with a command line under macOS, then maybe&#8230;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
