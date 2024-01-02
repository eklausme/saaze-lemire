---
date: "2008-07-04 12:00:00"
title: "Backing up your Mac on an external disk"
---



A couple of weeks ago, I needed to backup my MacBook Pro to an external disk (a firewire G-Drive) because my hard drive was failing. I started shopping for a good backup solution, but none of them had the following features:

- support for incremental backups: if a change is made, you only backup the files that differ;
- adequate handling of IO errors (no all-out abort);
- inexpensive.


Indeed, I tried two different tools, but they refused to backup my disk due to numerous IO errors. They would not even tell me how to fix my problem.

As it turns out, your Mac has already all it needs, by default, to do just that. First, create a file called &ldquo;backup.sh&rdquo;, make it executable (chmod +x backup.sh) and copy the following content to it:

<code><br/>
#!/bin/sh<br/>
RSYNC="/usr/bin/rsync -E"<br/>
# my external disk is located<br/>
# at /Volumes/G-DRIVE\\ MINI/<br/>
sudo $RSYNC -a -x -S --delete --exclude-from backup_excludes.txt $* /Volumes/G-DRIVE\\ MINI/<br/>
sudo bless -folder /Volumes/G-DRIVE\\ MINI/System/Library/CoreServices<br/>
</code>

Then run it! Go to a shell and type &ldquo;./backup.sh&rdquo;. It will ask for you root password.

If you ever need to restore your files, then create a file called &ldquo;restore.sh&rdquo; with the following content:

<code><br/>
#!/bin/sh<br/>
RSYNC="/usr/bin/rsync -E"<br/>
sudo $RSYNC -a -x -S --delete --exclude-from backup_excludes.txt $* /Volumes/G-DRIVE\\ MINI/ /Volumes/Macintosh\\ HD/<br/>
sudo bless -folder /Volumes/Macintosh\\ HD/System/Library/CoreServices<br/>
</code>

Executing restore.sh may prove dangerous. Make sure you have tried booting from the external disk first. To boot from an external disk, I think you have to hold down the command key while rebooting.

