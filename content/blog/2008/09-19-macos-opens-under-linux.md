---
date: "2008-09-19 12:00:00"
title: "MacOS open´s under Linux"
---



MacOS has a nice &ldquo;open&rdquo; command that will open any document with any application from the command line. I hacked my own for Linux for a bash shell:

<code><br/>
TEMP=`getopt -o a: -- "$@"`<br/>
if [ $? != 0 ] ; then exit 1 ; fi<br/>
eval set -- "$TEMP"<br/>
while true ; do<br/>
case "$1" in<br/>
-a) COMMAND=$2 ; shift 2;;<br/>
--) shift ; break ;;<br/>
*)echo "should not happen" ; exit 1 ;;<br/>
esac<br/>
done<br/>
if [ $COMMAND ]; then<br/>
nohup $COMMAND $@ > ~/.s1 2> ~/.s2 &<br/>
else<br/>
/usr/bin/xdg-open $@<br/>
fi<br/>
</code>

