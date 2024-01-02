---
date: "2006-07-12 12:00:00"
title: "Migration from CVS to Subversion"
---



For those who don&rsquo;t know, email is not a good collaborative editing tool. There are many superior alternatives such as wikis, version control tools, and so on. I tend to use all of those, but for serious work, when I need to actually sit down and write the paper, I use version control (such as CVS).

My friend Owen has decided to go spend the summer hidden in a shack. The downside of this is that bandwidth has become very expensive to him. So I suggested we move to Subversion from CVS. Subversion is reportedly smarter about how it uses the bandwidth. For example, if you change a single line in a file, it will not send the entired (changed) file over to the server, but just the description of the change. It has also other nice features like atomicity.

In practice, however, setting up Subversion has turned out to be a bit of a headache. My ISP has a nice [Subversion howto](http://www.csoft.net/docs/svn.html), but I ran into many problems when I tried to [setup svnserve](http://www.csoft.net/docs/svnserve.html) (the Subversion server).

Some lessons learned:

- Make sure you don&rsquo;t use the Berkeley DB backend. It is very fragile: the minute something goes a bit wrong, Berkeley DB falls and can&rsquo;t get up. Oh! You won&rsquo;t lose data, but you&rsquo;ll need to go on the server and do a &ldquo;svnadmin recover&rdquo;. Instead, use the newer &ldquo;fsfs&rdquo; which has not given me any trouble.
- Don&rsquo;t trust too much the Subversion error messages. I think they were written without much thought. Things like &ldquo;this URL doesn&rsquo;t exist&rdquo; actually means &ldquo;I can&rsquo;t find your repository where you say it should be, try another URL&rdquo;.
- Use a web client for browsing the different versions. I use [WebSVN](http://websvn.tigris.org/) and I&rsquo;m very happy. It was extremely simple to setup and the requirements are very minimal.
- Under Linux, don&rsquo;t bother with the GUI clients. I tried most of them and they simply won&rsquo;t cut it. Use the basic CLI tools coupled with a web client.


