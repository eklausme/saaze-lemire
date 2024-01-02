---
date: "2011-11-01 12:00:00"
title: "My favorite LaTeX editor for MacOS: Texpad"
---



I always found word processors distracting. I hate to copy and paste text only to find that the text formatting was copied as well. When I write, I do not want to have to worry about typesetting or page formatting issues. And I prefer a straight text file as a file format: it plays nicely with version control tools (e.g., [subversion](https://en.wikipedia.org/wiki/Apache_Subversion)) and&nbsp; it allows you to choose your own working environment because so many programs can edit text files.

Hence, [LaTeX ](https://en.wikipedia.org/wiki/LaTeX)is my favorite approach for writing professional documents. It is far from perfect, of course. But I find the alternatives even more lacking (e.g., [DocBook](https://en.wikipedia.org/wiki/DocBook)). In any case, many conferences and journals expect LaTeX documents.

Beginners find it hard to remember all the [TeX](https://en.wikipedia.org/wiki/TeX) and LaTeX commands, but this only slows you down initially. With practice, you memorize everything and can type complicated equations without thinking about the syntax at all. However, even with my experience, I find that editing LaTeX documents remains inconvenient when using a generic text editor:

- My LaTeX documents are usually made of several files. E.g., I use [BibTeX](https://en.wikipedia.org/wiki/BibTeX) so my bibliography data is in a separate file. I&rsquo;m currently reviewing the thesis of one of my student who divided his thesis into 10 or so files (one for each chapter).
- Because LaTeX is not [WYSIWYG](https://en.wikipedia.org/wiki/WYSIWYG), you must sometimes compare the result (e.g., a PDF file) with your source files. Aligning the output to your code might be difficult. (&ldquo;Where is the paragraph on page 3 in my LaTeX files?&rdquo;)
- Documents have structure (e.g., chapters and sections). It is sometimes difficult in LaTeX to quickly find a given section.
- The LaTeX workflow requires you to repeatedly rebuild your document to check the end result. This may require you to leave the editor to issue a shell command which disrupts your thought process.


There are many excellent editors built specifically for LaTeX. For Linux, my favorite LaTeX editor is [Kile](https://en.wikipedia.org/wiki/Kile). Up to recently, I had no favorite LaTeX for MacOS, but I am now using [Texpad](https://www.texpadapp.com/). It is not free, but it is quite cheap: only $20.

Unlike Kile or other LaTeX editors, Texpad does not have extensive toolbars or menus. Instead, Texpad stays out of your way. I like that!

<a style="float: right;margin:5px" href="https://picasaweb.google.com/lh/photo/Y__5xNS2HSKzevqzNb_AMQ?feat=embedwebsite"><img fetchpriority="high" decoding="async" src="https://lh5.googleusercontent.com/-4gqotdtfqZ4/TrAJBFZ8HzI/AAAAAAAAB8A/KJwDjn4EKv8/s288/Screen%252520Shot%2525202011-11-01%252520at%25252010.56.14%252520AM.png" alt width="288" height="229" /></a><br/>
The standard layout of the application is made of three panes. The first pane is made of the structure of the document. If your document uses other files (e.g., a BibTeX file), it will automatically appear in the structure, and you will be able to edit it by clicking on it. The central pane is a typical text editor whereas the last pane is for the output. If your document builds a PDF file, you will see it in the third pane.&nbsp; If you click anywhere in the PDF document, Texpad will try to match the corresponding location in your LaTeX document (using SyncTeX under the hood).

I don&rsquo;t know how Texpad was written, but it is quite fast. It is also robust: it does not crash.

Of course, Texpad is not perfect, I wish it would automatically reload files when they are changed on disk. This is important when using a version control system: you do not want to write over the changes of your co-workers without realizing it. Also, I recommend turning off the &ldquo;automatch begin &hellip; end&rdquo; as it is too naive to be generally useful. (Update: according to the authors, the problems with begin/end matches were fixed in version 1.4.3.) Moreover, even in the latest version, Texpad stubbornly insists on treating LaTeX warnings as errors. That is, even if the PDF document was generated correctly, it brings up the warnings in the third pane instead of the document, and there is no&nbsp; way to disable this default. (You can, however, have access to your PDF document by clicking on the PDF button.) Finally, the PDF view in the third pane is limited. For example, you cannot search text in it or quickly locate the corresponding PDF file on disk (e.g., to email it to someone). These are all minor issues however.

Overall, if you are a Mac user and write in LaTeX, I recommend you give Texpad a try. You can download a [free demo](https://www.texpadapp.com/).

__Disclosure__: I decided to write this review after receiving a free copy of Texpad.

