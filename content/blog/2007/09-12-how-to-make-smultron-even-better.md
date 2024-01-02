---
date: "2007-09-12 12:00:00"
title: "How to make Smultron even better"
---



Smultron is, by far, the best text editor on MacOS. And it is free. Now, I just found out how to make it even better. One annoying problem with Smultron is that if the underlying file gets updated, Smultron often forgets to reload it. You can make this less likely. First close Smultron, then, in a shell, type:

<code>defaults write org.smultron.Smultron TimeBetweenDocumentUpdateChecks 1</code>

Explanation: by default, Smultron checks for file updates every 10 seconds.

