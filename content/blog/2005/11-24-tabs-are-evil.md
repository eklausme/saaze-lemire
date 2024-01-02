---
date: "2005-11-24 12:00:00"
title: "Tabs are evil"
---



I thought I had written a piece about this, but no. So, there you go. Tabs are evil in text files. Why? Because the tab character (\\t) has vaguely defined semantics. It means &ldquo;insert x spaces&rdquo; where x depends on the text editor and the preferences of the user.

The solution? Tell your text editor to dynamically replace tabs by spaces. For vim, you can achieve this by putting the line &ldquo;set expandtab&rdquo; in your file &ldquo;~\\.vimrc&rdquo; or by typing &ldquo;:set expandtab&rdquo; while vim is running. The equivalent should be possible with all good text editors.

Go do it. Configure your text editor properly.

__Note__: For some specific file formats, such as make files, tabs are necessary.

