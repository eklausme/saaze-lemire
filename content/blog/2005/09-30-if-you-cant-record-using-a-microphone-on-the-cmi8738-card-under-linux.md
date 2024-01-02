---
date: "2005-09-30 12:00:00"
title: "If you can´t record using a microphone on the CMI8738 card under Linux&#8230;"
---



For the 3 people in the universe who have my exact same problem, that is, they can&rsquo;t record audio using a microphone on the CMI8738 card under Linux&hellip; here&rsquo;s the solution:

> To enable the microphone on the 0.9 series:

1. run &ldquo;alsactl store&rdquo;<br/>
2. edit /etc/asound.state. Set &ldquo;Mic As Center/LFE&rdquo; to &ldquo;false&rdquo;.<br/>
3. run &ldquo;alsactl restore&rdquo; If your Mic is set to &ldquo;Record&rdquo; and capture<br/>
level is appropriately high, the Mic should now work.



(My thanks to Lukasz Weber for pointing this out.)

There is also a friendly way: kmix allows you to set the &ldquo;Mic As Center/LFE&rdquo; property to &ldquo;false&rdquo; using the GUI.

Yes. I wasted 4 hours on this.

More interesting notes:

- mhWaveEdit is the coolest sound recording software under Linux. The author should take a course in marketing though: what kind of name is that? &ldquo;mhWaveEdit&rdquo;!?!


