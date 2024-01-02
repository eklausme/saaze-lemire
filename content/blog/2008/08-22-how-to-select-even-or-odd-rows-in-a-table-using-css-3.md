---
date: "2008-08-22 12:00:00"
title: "How to select even or odd rows in a table using CSS 3"
---



CSS 3 is around the corner. Already we are seeing some benefits. The latest versions of Safari and Opera, as well as the beta version of Firefox allow you to select even or odd rows in a table using only CSS:

<code><br/>
tr:nth-child(2n+1) {<br/>
background-color: blue;<br/>
}<br/>
tr:nth-child(2n) {<br/>
background-color: red;<br/>
}<br/>
</code>

See? No ECMAScript, no server-side programming. Alas, no sign of support for this in Internet Explorer.

