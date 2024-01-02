---
date: "2006-06-02 12:00:00"
title: "How to recover &#8220;lost&#8221; changes in CVS"
---



Suppose someone destroyed one of your file revisions by checking in a file undoing any changes you made. While your version is still in the CVS tree (you are using version control, aren&rsquo;t you?), you don&rsquo;t know how to merge them with the current version of the file.

Well, here&rsquo;s a hack that will do it:

<code><br/>
cvs update myfile<br/>
cvs update -r 1.39 -p myfile > mychanges<br/>
cvs update -r 1.38 -p myfile > beforemychanges<br/>
merge myfile beforemychanges mychanges<br/>
</code>

I&rsquo;m sure there is a cleaner way to do it.

