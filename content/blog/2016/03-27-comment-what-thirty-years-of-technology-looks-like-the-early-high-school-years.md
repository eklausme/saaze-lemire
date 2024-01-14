---
date: "2016-03-27 12:00:00"
title: "What thirty years of technology looks like: the early high-school years"
index: false
---

[One thought on &ldquo;What thirty years of technology looks like: the early high-school years&rdquo;](/lemire/blog/2016/03-27-what-thirty-years-of-technology-looks-like-the-early-high-school-years)

<ol class="comment-list">
<li id="comment-618741" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cfd04a0ca75339f0772b96461028e14d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cfd04a0ca75339f0772b96461028e14d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Chuck Athey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-27T04:11:04+00:00">January 27, 2022 at 4:11 am</time></a> </div>
<div class="comment-content">
<p>I needed logs when the server dies and wanted to make sure I had the correct screen process in the case another screen was started with the same name. Here is the script I came up with.<br/>
#!/bin/bash<br/>
renice -n 10 $$<br/>
EXIT_STAT=1<br/>
while [[ $EXIT_STAT != 0 ]]; do<br/>
DATE=`date +%Y%d%d_%H%M%S`<br/>
#The following 2 lines are a single line that wraps in this post<br/>
screen -L -Logfile run_$DATE.log -D -m -S minecraft java -Xmx3072M -Xms3072M -jar paper.jar -o true -nogui &amp;<br/>
SPID=&rdquo;$!&rdquo;<br/>
wait $SPID<br/>
EXIT_STAT=$?<br/>
#The following 2 lines are a single line that wraps in this post<br/>
echo &ldquo;Done with Screen $SPID, exiting with $EXIT_STAT&rdquo; &gt;&gt;run_$DATE.log<br/>
timeout 10<br/>
done</p>
</div>
</li>
</ol>
