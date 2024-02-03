---
date: "2004-05-19 12:00:00"
title: "Changing job for a Linux addict"
---



People who are happy with whatever operating system they are offered probably find it much easier to change job. When you are a linux addict, it means that you have to secretly install Linux and then reverse-engineer the network configuration so that you can, well, print.

This time I installed [Gentoo](https://www.gentoo.org/) in my office. As it turns out, it was rather painless, but as an overworked prof., it was still hurtful to waste a day configuring the machine. The toughest part this time was getting the printing to work. As it turns out, I had to the cups to use smb://mylogin:mypassword@tlmnt4/uer_com instead of smb://tlmnt4/uer_com. Somehow, cups couldn&rsquo;t just reuse my known username and password. Hmmm&hellip; I wonder why I never had this problem before? I really wish cups was easier to configure. But at least, it works now.

There is also a special java applet system called explor@ here. But I think I mostly figured out how to get it running &ldquo;ok&rdquo; under linux (in French), though I had to waste another day on it.

I have good reasons to believe I must be the only prof. around using Linux. My addiction to command line interfaces has a thing or two to do with it. You can emulate pretty much the unix environment under Windows, but it is never quite the same in terms of productivity.

I&rsquo;ve been told that MacOS X would be a good choice too. Except that I couldn&rsquo;t have done what I just did here: take the &ldquo;free&rdquo; PC they put in my office and transform it in a Linux box.

Some facts people often don&rsquo;t know:

- Networking is mostly painless under Linux. Since most networks use DHCP, the configuration is a joke. With samba, you can access pretty much all of the network services you need even when they are hosted on a Windows server.
- With OpenOffice and latex2rtf, you can pretty live within the MS Word universe and not get noticed. People will complain that the documents don&rsquo;t look quite as they expect, but I&rsquo;m a prof. and I can always claim that I&rsquo;m not very good with word processing. You can consume and produce Word documents. Not very good ones, but unless you do secretarial work, it will be ok.
- Email is not a problem even in a supposedly windows-only world: just use the exchange server as a POP server and you&rsquo;ll be fine. Microsoft is not yet crazy enough to prevent people from checking their mail using the POP protocol. You might not get all the features from Exchange, but what you are missing won&rsquo;t hurt you, much.


In the end, you can be very productive with Linux.

Now, if I could find how to turn the system bell off once and for all, I&rsquo;d be happy.

Update: it turns out that we can turn off the system bell easily under Linux. I never knew this. Just do &ldquo;xset b off&rdquo;. You can put this in your .xsession file too.

