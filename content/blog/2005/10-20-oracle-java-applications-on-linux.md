---
date: "2005-10-20 12:00:00"
title: "Oracle Java Applications on Linux"
---



A nameless university is using Oracle&rsquo;s jinitiator applets on some management web sites. Jinitiator is just Oracle&rsquo;s version of the Java JVM, but you can use any recent JVM and be happy. The trick under Linux is to fool the browser into interpreting the mime-type &ldquo;application/x-jinit-applet&rdquo; (specific to Oracle) as just an ordinary applet. As it turns out, you just have to edit a small text file called pluginreg.dat.

Reference: Oracle Apps on Linux &#8211; AVallark.

See also my posts [Oracle buys Hyperion](http://www.daniel-lemire.com/blog/archives/2007/03/02/oracle-buys-hyperion/), [JOLAP versus the Oracle Java API](http://www.daniel-lemire.com/blog/archives/2006/01/17/jolap-versus-the-oracle-java-api/), [IBM, Oracle and Microsoft freeing their databases](http://www.daniel-lemire.com/blog/archives/2005/11/23/ibm-oracle-and-microsoft-freeing-their-databases/) and [Oracle and MySQL â€” is MySQL in a weak position?](http://www.daniel-lemire.com/blog/archives/2005/10/18/oracle-and-mysql-is-mysql-in-a-weak-position/)

