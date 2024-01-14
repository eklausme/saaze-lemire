---
date: "2010-01-11 12:00:00"
title: "Actual programming with HTML and CSS (without javascript)"
---



I usually stick with academic or research issues, but today, I wanted to have some fun. Geek fun.

While W3C describes [Cascading Style Sheets (CSS)](http://www.w3.org/Style/CSS/) as a <em>mechanism for adding style (e.g. fonts, colors, spacing) to Web documents</em>, it is also a bona fide programming language. In fact, it is one of the most widespread [declarative languages](https://en.wikipedia.org/wiki/Declarative_programming).

But how powerful is CSS? It is not [Turing complete](https://en.wikipedia.org/wiki/Turing_completeness), so there is no hope of programming full applications.  However, CSS may be surprisingly powerful. (Update: [It turns out that HTML+CSS is Turing complete](/lemire/blog/2011/03/08/breaking-news-htmlcss-is-turing-complete/)!)

Suppose you are given a plain HTML table and you want to add counters and colors to it. Starting with this table:

<code> &lt;table&gt;<br/>
&lt;tr&gt;&lt;th&gt;City&lt;/th&gt;&lt;th&gt;Color&lt;/th&gt;&lt;/tr&gt;<br/>
&lt;tr&gt;&lt;td&gt;Montreal&lt;/td&gt;&lt;td&gt;Red&lt;/td&gt;&lt;/tr&gt;<br/>
&lt;tr&gt;&lt;td&gt;Toronto&lt;/td&gt;&lt;td&gt;Blue&lt;/td&gt;&lt;/tr&gt;<br/>
&lt;tr&gt;&lt;td&gt;Vancouver&lt;/td&gt;&lt;td&gt;Yellow&lt;/td&gt;&lt;/tr&gt;<br/>
&lt;/table&gt;</code>

We want to color rows in alternative colors. We need counters and a way to color the second line differently.

__Solution:__ Add the following lines to your CSS style sheet:

<code>tr{counter-increment: mycounter}<br/>
table {counter-reset: mycounter -1}<br/>
td:first-child:before {content: counter(mycounter)". " }<br/>
tr:nth-child(2n+2) td {background-color: #ccc;}<br/>
tr:nth-child(2n+3) td {background-color: #ddd;}<br/>
</code>

