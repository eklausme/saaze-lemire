---
date: "2007-10-09 12:00:00"
title: "Odd Networking Problem with MacOS"
---



We just found a major MacOS bug, but there seems to be no trace of it on the Web, so I am posting this here hoping that someone can help. We tested several machines and whenever you have an __ethernet connection__, trying to do an __HTTP POST request__ with a __sizeable load__ (such as __editing a large article on wikipedia__) will fail. This does not happen with WiFi, only ethernet (with a cable).

We tested with several browsers. Apparently, some version of Safari would not suffer from this bug, but I could not confirm it.

The problem is not hardware-bound because running Windows XP on the same machine fixes the issue. So, it seems there is a major bug in Apple&rsquo;s ethernet driver.

Help me!

