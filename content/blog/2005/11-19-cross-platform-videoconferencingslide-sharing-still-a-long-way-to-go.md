---
date: "2005-11-19 12:00:00"
title: "Cross-platform videoconferencing/slides sharing: still a long way to go?"
---



With Owen Kaser and Yuhong Yan, I am organizing our [eBusiness Technologies course ](http://pizza.unbsj.ca/~owen/backup/courses/OLAP-2004/) for this winter.

Now, Yuhong is in Fredericton, Owen is in Saint John and I&rsquo;m in Montreal. How do we give one course all together? Last time was through expensive videoconferencing equipment, but this time, we are looking at cheaper, PC-based solutions. Owen and I are Linux users, Yuhong is a Windows user. Yuhong suggested we use [IBM Sametime](http://www-03.ibm.com/software/products/en/ibmsame). I thought &ldquo;Great! IBM is very pro-Linux!&rdquo; At first, it looked great because the preferred Sametime client is Java-based with an added browser plugin. Well, after 4 hours of <em>fun</em>, the results are so-so. My experience with Sametime, both under Linux and Windows, wasn&rsquo;t great. In both OSes (Windows and Linux), Firefox crashed on the first attempt to use Sametime. I didn&rsquo;t get this problem using Internet Explorer. Restarting Firefox after a first crash fixed the problem. Then, the desktop sharing feature was, at first, completely disabled for me under Linux. Restarting Firefox a third time fixed the problem. However, desktop sharing under Linux was not great: in order to share a window, it has to be entirely visible so, this means, you must keep the window above the others. Not great. You don&rsquo;t have this problem under Windows. Finally, videoconferencing is entirely disabled under Linux whereas it worked well under Windows. The only glitch to videoconferencing under Windows is that if you want to select another input device than the default one, you have to restart Sametime for the changes to take effect, but you get no dialog box warning you about it. Oh! And the license for Sametime was around $20k, though the client is available for free as a Java applet.

So, why not use gnomemeeting (Linux) and netmeeting (Windows)? Because gnomemeeting makes not effort to support the full T.120 protocol: this means no desktop sharing features under gnomemeeting for the foreseeable future. Of course, you can use [VNC](https://en.wikipedia.org/wiki/Vnc) but if all you want to do is broadcast slides remotely, it is an overkill and since you don&rsquo;t have integrated chatting and videoconferencing, this means a lot of fiddling around.

What I&rsquo;m looking for is simple. I want basic videoconferencing and slides sharing (to display my PDF slides remotely) between Windows and Linux (and MacOS). It is sad to see that in 2005, I still can&rsquo;t get this work.

As I was writting this, I was reminded of a post by Harold on Marratech which is available for Linux, Windows and MacOS. The best thing is that you can try Marratech for free (though without the desktop sharing feature) and even pay as you go at a rate of around $36 a day. Maybe that&rsquo;s the solution I&rsquo;m looking for? (I&rsquo;m not related in any way to Marratech and I don&rsquo;t even claim their product work. I haven&rsquo;t tried it.)

