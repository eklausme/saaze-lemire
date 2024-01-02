---
date: "2005-08-29 12:00:00"
title: "Getting pdflatex to embed all fonts"
---



__Update__: a much simpler approach is described in [Embedding fonts for IEEE](/lemire/blog/2006/08/18/embedding-fonts-for-ieee/).

My friend Yuhong reminded me to make sure I embed all fonts in the pdf file for our ICDM-05 paper. This seems to be an IEEE requirement.

Turns out to be a non trivial task, but not difficult. Here&rsquo;s what I did (applies to a Linux TeTeX 3.0 distribution):

1. As root, type &ldquo;updmap &#8211;edit&rdquo;, edit the config file so that it has the following content:<br/>
<code style="width:9cm"><br/>
#pdftexDownloadBase14 false<br/>
pdftexDownloadBase14 true</code>
1. Run pdflatex over your document.
1. Run pdffonts over the produced pdf file, all fonts should have true in the columns &ldquo;emb&rdquo; and &ldquo;sub&rdquo;.


