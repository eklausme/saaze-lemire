---
date: "2006-06-01 12:00:00"
title: "Autocompletion in the Python console"
---



[Hans tells us](https://kogs-www.informatik.uni-hamburg.de/~meine/python_tricks) how to have autocompletion in the Python console:

<code><br/>
import readline, rlcompleter<br/>
readline.parse_and_bind("tab: complete")<br/>
</code>

This is brilliant, but I wonder how I would ever have guessed this exact sequence of code. Isn&rsquo;t it a bit obscur?

Anyhow. Hans also tells us how to have this run automatically every time the console is launched. I think it is very nice.

