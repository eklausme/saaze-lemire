---
date: "2006-10-13 12:00:00"
title: "Revert back changes in subversion"
---



Suppose you have incorrectly checked in a change to a file in a subversion repository. How do you revert back? This is documented elsewhere, but I want to document just exactly how I do it.

First of all, you need to know what are the most recent versions of your file, to figure it out, just do:

<code><br/>
svn log myfile | head -n 10<br/>
</code>

where &ldquo;-n 10&rdquo; is meant to only give you the first 10 lines of the log files, but you may need more if the comments are exhaustive. This should give you the latest revisions. Say they are 122 and 227, then just do reverse merge, like so:

<code><br/>
svn merge -r 227:122 myfile<br/>
svn diff myfile<br/>
svn ci<br/>
</code>

The command &ldquo;svn diff&rdquo; is necessary to make sure that, indeed, you have reverted back the right changes.

