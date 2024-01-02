---
date: "2006-01-31 12:00:00"
title: "Do not open external links in new windows"
---



A university official who shall remain nameless wrote to me this morning the following sentence regarding our web sites:

> it is important that links to external sites appear as a new window


The official claims this is for well-established legal reasons.

When Tim Berners-Lee invented the web in 1991, there were no concept of a link opening in a new page. In fact, the target attribute use to achieve this feat was a W3C recommendation only for a brief time: in HTML 4.0 which was immediately replaced by HTML 4.01. It is worth noting that neither frames nor target attributes are supported in recent versions of HTML (XHTML 1.1).

Let&rsquo;s add that there are serious accessibility issues with opening new windows and that Jacob Nielsen considers it to be one of the top 10 errors web developers can make:

> Even disregarding the user-hostile message implied in taking over the user&rsquo;s machine, the strategy is self-defeating since it disables the Back button which is the normal way users return to previous sites. Users often don&rsquo;t notice that a new window has opened, especially if they are using a small monitor where the windows are maximized to fill up the screen. So a user who tries to return to the origin will be confused by a grayed out Back button.


As for legal justifications, there are none.

