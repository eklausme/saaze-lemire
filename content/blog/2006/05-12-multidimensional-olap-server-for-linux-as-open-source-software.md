---
date: "2006-05-12 12:00:00"
title: "Multidimensional OLAP Server for Linux as Open Source Software"
---



[Jedox will release a free open source Linux MOLAP server](http://forum.jedox.com/?s=a2774019ca574051c048b01c3400072b022c79d2) by the end of the year. A pre-release of the software is expected by mid of 2005.
>  __All data is stored entirely in memory.__ Data can not only be read from but also written back to the cubes. Like in a spreadsheet, all calculations and consolidations are carried out within milliseconds in the server memory while they are written back to the cube.

I sure hope that by &ldquo;memory&rdquo; they include &ldquo;external&rdquo; memory because otherwise, their cubes are going to have to be quite small. Normally, you&rsquo;d at least memory map large files as [Lemur OLAP](http://www.nongnu.org/lemur/) does.

