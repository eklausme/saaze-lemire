---
date: "2006-10-16 12:00:00"
title: "Better email notifications in subversion"
---



Subversion is a great version control tool, but the scripts that accompany it are still immature. One of them, commit-email.pl is particularly bad. It goes on and on for hundreds of lines, and the end result is very poor usability. Earlier tonight, I found a better solution on the Web with color and all, then I fixed it. But I can&rsquo;t figure out who I stole this from. In any case, here is my fixed commit-email.rb (run gunzip on it first). You may have to change the first line. To activate the script, edit the post-commit file of you repository (or create it from post-commit.tmpl) and make sure you have the following:

<code><br/>
REPOS="$1"<br/>
REV="$2"<br/>
./commit-email.rb "$REPOS" "$REV"<br/>
</code>

where &ldquo;commit-email.rb&rdquo; is located in the same directory as &ldquo;post-commit&rdquo;.

