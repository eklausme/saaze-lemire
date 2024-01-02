---
date: "2006-11-30 12:00:00"
title: "Getting KDE running (and running well) under Mac OS X is easy"
---



To get KDE running under Mac OS X, the secret is simple <kbd>[fink](http://fink.sourceforge.net/) install bundle-kde-ssl</kbd> and follow the [corresponding instructions on the fink web site](http://fink.sourceforge.net/news/kde.php). Mostly, you have to just have to type <kbd>starkde</kbd> assuming that you have [appropriately edited your .xinitrc file](http://www.daniel-lemire.com/blog/archives/2006/11/23/xfig-running-on-mac-os-x-thanks-to-fink/). The main problem is that it takes a really long time to compile all of this code, but once it runs, it runs well! This has just made Mac OS X that much more useful to me.

__Warning__: do use the &ldquo;export KDEWM=quartz-wm&rdquo; line in your xinitrc. Using the KDE window manager is a sure way to make Apple&rsquo;s X11 crash when moving windows. This is not documented anywhere, but I have verified it on 3 different machines with slightly different setups.

Here&rsquo;s a picture in case you want to see for yourself (click to enlarge):

However, contrary to what I claimed earlier, it turns out that XFig does not work. It worked for a time, but now, I can&rsquo;t seem to make it work again. __Update__. To get XFig to work, I need to go into the (non-X11) Apple shell and type <kbd>open-x11 xfig</kbd>. There is something odd going on with X11 though KDE applications seem unaffected. I might have to switch to KDE Karbon.

Also, OpenOffice under X11 is very sluggish. It seems like [NeoOffice](http://www.neooffice.org/) is a much better solution right now.

