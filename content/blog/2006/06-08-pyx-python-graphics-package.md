---
date: "2006-06-08 12:00:00"
title: "PyX &ndash; Python graphics package"
---



> PyX is a Python package for the creation of PostScript and PDF files. It combines an abstraction of the PostScript drawing model with a TeX/LaTeX interface. Complex tasks like 2d and 3d plots in publication-ready quality are built out of these primitives.


Here is the type of things you can do:

<img decoding="async" src="http://pyx.sourceforge.net/gallery/graphs/washboard.png" />

Naturally, the code is a bit hairy:

<code><br/>
from math import pi, cos<br/>
from pyx import *<br/>
from pyx.deco import barrow, earrow<br/>
from pyx.style import linewidth, linestyle<br/>
from pyx.graph import graphxy<br/>
from pyx.graph.axis import linear<br/>
from pyx.graph.axis.painter import regular<br/>
from pyx.graph.style import line<br/>
from pyx.graph.data import function<br/>
mypainter = regular(basepathattrs=[earrow.normal], titlepos=1)<br/>
def mycos(x): return -cos(x)+.10*x<br/>
g = graphxy(height=5, x2=None, y2=None,<br/>
x=linear(min=-2.5*pi, max=3.3*pi, parter=None,<br/>
painter=mypainter, title=r"$\\delta\\phi$"),<br/>
y=linear(min=-2.3, max=2, painter=None))<br/>
g.plot(function("y(x)=mycos(x)", context=locals()),<br/>
[line(lineattrs=[linewidth.Thick])])<br/>
g.finish()<br/>
x1, y1 = g.pos(-pi+.1, mycos(-pi+.1))<br/>
x2, y2 = g.pos(-.1, mycos(-.1))<br/>
x3, y3 = g.pos(pi+.1, mycos(pi+.1))<br/>
g.stroke(path.line(x1-.5, y1, x1+.5, y1), [linestyle.dashed])<br/>
g.stroke(path.line(x1-.5, y3, x3+.5, y3), [linestyle.dashed])<br/>
g.stroke(path.line(x2-.5, y2, x3+.5, y2), [linestyle.dashed])<br/>
g.stroke(path.line(x1, y1, x1, y3), [barrow.normal, earrow.normal])<br/>
g.stroke(path.line(x3, y2, x3, y3), [barrow.normal, earrow.normal])<br/>
g.text(x1+.2, 0.5*(y1+y3), r"$2\\pi\\gamma k\\Omega$", [text.vshift.middlezero])<br/>
g.text(x1-.6, y1-.1, r"$E_{\\rm b}$", [text.halign.right])<br/>
g.text(x3+.15, y2+.20, r"$2J_k(\\varepsilon/\\Omega)+\\pi\\gamma k\\Omega$")<br/>
g.writeEPSfile("washboard")<br/>
g.writePDFfile("washboard")<br/>
</code>

(Source: [0xDE](http://11011110.livejournal.com/55308.html))

