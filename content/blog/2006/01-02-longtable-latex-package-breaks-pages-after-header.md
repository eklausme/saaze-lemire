---
date: "2006-01-02 12:00:00"
title: "Longtable LaTeX package breaks pages after header"
---



Here&rsquo;s an annoying longtable bug for those of you using LaTeX for a living. Sometimes, but rarely so, a longtable will break at the oddest places when using horizontal lines (hline), including right after the header. [The solution](http://www.latex-project.org/cgi-bin/ltxbugs2html?pr=tools/2666&#038;category=Tools&#038;responsible=anyone&#038;state=anything&#038;keyword=longtable&#038;) is to define a special kind of hline called &ldquo;nobreakhline&rdquo; and use that instead where you don&rsquo;t want any page breaks.

<code><br/>
\\makeatletter<br/>
\\def\\nobreakhline{%<br/>
\\multispan\\LT@cols\\unskip\\leaders\\hrule\\@height\\arrayrulewidth\\hfill\\cr<br/>
\\noalign{\\penalty10000}}<br/>
\\makeatother<br/>
</code>

