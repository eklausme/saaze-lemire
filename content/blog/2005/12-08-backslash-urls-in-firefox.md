---
date: "2005-12-08 12:00:00"
title: "Backslash URLs in Firefox"
---



By mistake, I typed &ldquo;http://\\w&rdquo;. Surprise! It actually goes to the White House! Here are more results:

- &ldquo;http://\\a&rdquo; goes to http://www.lemonde.fr/
- &ldquo;http://\\b&rdquo; goes to http://www.b-rail.be/main/F/index.php
- &ldquo;http://\\c&rdquo; goes to http://www.caducee.net/
- &ldquo;http://\\d&rdquo; goes to http://www.meteofrance.com/FR/index.jsp
- &hellip;
- &ldquo;http://\\w&rdquo; goes to http://www.whitehouse.gov/
- &ldquo;http://\\x&rdquo; goes to http://www.polytechnique.fr/
- &ldquo;http://\\z&rdquo; goes to http://www.ztele.com/


At first, I was a bit puzzled that so many results were in French. Of course, what is happening is that Firefox sends the query to Google and redirects you to the first URL in the Google result page. It doesn&rsquo;t redirect you to it verbatim though. Try typing &ldquo;\\w*(?=bla)&rdquo; both in Google and in the Firefox URL box and you&rsquo;ll see that the result differs.

