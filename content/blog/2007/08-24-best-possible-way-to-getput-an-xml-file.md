---
date: "2007-08-24 12:00:00"
title: "Best Possible Way to GET/PUT an XML File?"
---



After seeking a good [GTD](https://en.wikipedia.org/wiki/GTD)-compliant to-do list manager, I finally designed my own. I seek a tool that lets me:

- backup the data
- does not suffer from vendor lock-in
- keeps stuff confidential (sorry, you can&rsquo;t know what I have to do today)
- will not lose or corrupt my data (ever).


Among the tools I have reviewed is Chandler which looks good but is still in alpha. Actiontastic is very nice, but is not GTD-compliant in my opinion and it is hard to tell what the license is. [What&rsquo;s next](http://whatsnextapp.com/) is really brilliant, but it is not GTD-compliant and comes with its own Web server which is a bit odd.

Then you have [dcubed](http://www.dcubed.ca/) or [MonkeyGTD](http://monkeygtd.tiddlyspot.com/), TiddlyWiki-based solutions. It is very nice and there is no doubt some people will like it, but I never could get used to TiddlyWiki and I distrust it.
Really, the best application I found so far is [PHP-GTD](http://sourceforge.net/projects/phpgtd) but the developers are not hacking it fast enough and they seem to have a case of spaghetti code based on how slowly they come up with new versions.

What I did is actually pretty sweet. I simply fill out an XML that looks like this:

<code><br/>
&lt;goal title="stay alive" category="personal"><br/>
&lt;nextaction title="stop the fire in my kitchen" /><br/>
&lt;action title="go get some milk" tickle="2008-12-12" /><br/>
&lt;someday title="go on a diet" /><br/>
&lt;/goal><br/>
</code>

In any case, you see the idea. My application supports deadlines, goals, actions, next actions, ticklers, lists, descriptions, some-day projects and so on. I can easily extend it (recall what the X of XML stands for!).

The XML file is linked to an XSLT file. This XSLT file (executed by the browser) generates HTML which, thanks to ECMAScript, allows me to navigate through the data fully. As far as I can tell, I support many of the same views as an application like php-gtd, except that my application is a thousand times faster and I have ten times less code. Everything is in XML and in this instance, it does make things so much better. I do not even want to think about designing a database schema for this data.

So, what is the problem? Well, I can happily edit an XML file, but before I release this software to the world, and I think it has value even though I only took one evening to write it, I need a user-friendly way to edit the data. It won&rsquo;t do to have people edit an XML file by hand. It is easy enough for me to include, through ECMAScript, so way to add actions and stuff. However, how and where do I save the data?

There is no browser-oblivious way for an HTML page, even a local HTML page, to modify a local XML file. This probably means that I need some kind of server-side companion to my XSLT/ECMAScript application. Of course, it appears that TiddlyWiki manages to store its own data in an HTML file, but I am not certain I trust this sort of mechanism: I would always be afraid to have unsaved data. Google Gear is browser-specific (won&rsquo;t work with Camino, Safari, Konqueror, and so on). It is fine and sweet to build Firefox-only applications, but that&rsquo;s eventually as bad as writing Internet Explorer-only applications. I do not consider a browser-specific application to be a Web application.

What I need is brutally simple. I only need a server-side application that will allow me to retrieve the file (GET) and then to replace it with another one (PUT or POST) after the user has edited. I say POST because I toy with the idea of having version control: instead of replacing the existing file, edits would be reversible.

So, security issues aside, I think I only need a server-side application that&rsquo;s really very, very simple. Maybe ten lines of Perl or Python.

I searched, but I can&rsquo;t find any discussion on the best possible way to do something so simple. Naturally, my goal here is to keep things so incredibly simple that can pick up my application and build their own variants.
Anyone can help me?

