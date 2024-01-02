---
date: "2006-07-10 12:00:00"
title: "How to fix pango fonts problems"
---



I recently updated my Mandrake Linux machine and got errors like this one when starting a GTK application:

<code><br/>
(gnome_segv:24830): Pango-CRITICAL **: _pango_engine_shape_shape: assertion `PANGO_IS_FONT (font)' failed<br/>
</code>

The net result is that all GTK-based applications (Firefox, Gnumeric, Gimp, and so on) are broken.

To fix this, log in as root, and type

<code><br/>
/usr/bin/pango-querymodules-32 > /etc/pango/i386/pango.modules<br/>
</code>

You might want to check that pango.modules is indeeed in &ldquo;/etc/pango/i386&rdquo;.

