---
date: "2005-11-15 12:00:00"
title: "No loops in Python one-liners?"
---



You can pass to the Python interpreter a one-liner, such as this one:<br/>
<code>python -c 'print "hello"'<br/>
</code><br/>
You can even do fancy things like this:<br/>
<code>python -c "import os; print os.listdir('.')"<br/>
</code><br/>
But it seems you cannot do loops within the line:<br/>
<code>python -c "import os; for i in os.listdir('.'): print i"<br/>
</code><br/>
However, you can do loops as long as it begins the line, as follows:<br/>
<code>python -c "for i in range(10): print i; print i"<br/>
</code><br/>
Interestingly, both &ldquo;print i&rdquo; above are considered to be inside the loop. I could not find any documentation anywhere regarding this limitation which seems to derive from how Python parses code lines.

