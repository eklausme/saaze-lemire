---
date: "2007-01-18 12:00:00"
title: "Color terminal under Mac OS X"
---



One thing that annoys me since I started using Mac OS X is that there is no color in the terminal. So I added the following lines to my .bashrc file:

<code style="font-size: 0.8em;">export TERM="xterm-color"<br/>
alias ls="ls -G"<br/>
PS1="\\[\\033[01;32m\\]\\u@\\h\\[\\033[01;34m\\] \\w \\$\\[\\033[00m\\] "<br/>
</code>

For some reason, I also had to add the following line at the end of the global bashrc file (/etc/bashrc) so that my user bashrc file is read:

<code style="font-size: 0.8em;">. ~/.bashrc<br/>
</code>

See also my post [I have had it with Firefox under MacOS](http://www.daniel-lemire.com/blog/archives/2007/06/27/i-have-had-it-with-firefox-under-macos/).

