---
date: "2016-04-02 12:00:00"
title: "Setting up a &#8220;robust&#8221; Minecraft server (Java Edition) on a Raspberry Pi"
---



My kids are gamers, and they love Minecraft. Minecraft sells its client software, but the server software is freely available. Since it is written in Java, it can run easily on Linux. Meanwhile, you can order neat little [Raspberry Pi](https://www.amazon.com/s/?field-keywords=raspberry+pi) Linux computers for less than $50. So, putting two and two together, you can build cheaply a little box (not much bigger than my hand) that can be used as a permanent, low-power, perfectly silent game server. And you can expose your kids to servers, Linux and so forth.

There are many guides to setting up a Minecraft server on a Raspberry Pi, but the information is all over the place, and often obsolete. So I thought I would contribute my own technical guide. It took me a couple of long evenings to set things up, but if you follow my instructions, you can probably get it done in a couple of hours, once you have assembled all the material.

We are going to setup a Minecraft server for the old-school Java-based Minecraft. There are other Minecraft versions (e.g., on mobile devices) but they require different software. To be clear: if you are running Minecraft on a smartphone, a console or a tablet, it is may not compatible with the regular (Java) Minecraft. You can use [Geyser](https://geysermc.org) to support console and android clients, but it is not covered by the current guide: you will have to do extra work on your own afterward if you need such support.

My instructions have been tested thoroughly and they work. They have worked for years. I recommend you pay close attention to each step. It is not difficult, but you need to be conscientious. Regularly, people complain that they instructions are out-of-date or incorrect: whenever we investigate, we find that these people have not followed the instructions properly. Many people try to go faster and skip steps or they fail to read everything. At this point in time, thousands of people have successfully followed these instructions. If they do not work for you, it is almost certainly because you did not follow them properly. Start again, and be conscientious.

You can make different choices and improvise, but if you do so, please understand that you are likely on your own to fix the problems you create.

Some people like to see a video of the setup:<br/>
[Wakka Gaming &amp; Tech made a video from this guide](https://www.youtube.com/watch?v=Mw9bUz2OiLk). (The video is not part of these instructions and was made by a tier. Please follow primarily these written instructions.)
<h2>Prerequisites</h2>

- You need a working computer connected to the Internet. My instructions work whether you have a Mac, a Windows PC or a Linux box.
- You need to buy a Raspberry Pi. [I recommend getting a Raspberry Pi 4](https://www.amazon.com/raspberry-pi-4/s?k=raspberry+pi+4). Getting the model with 4GB of RAM might be a nice bonus. I tried long and hard to get a stable and fast server running on a first-generation Raspberry Pi, but it was not good. I find that the Raspberry Pi 3 is much better than the Raspberry Pi 2, unsurprisingly. I recommend that you dedicate the Raspberry Pi to the sole purpose of running a single Minecraft server. Trying to run other software, or more than one server, on the same Raspberry Pi is likely to cause troubles. So if you want to do several projects with a Raspberry Pi, then order several Raspberry Pis.

- You need a power cord to go with the Raspberry Pi.
- Moreover, you need a micro SD card. I recommend getting, at least, an 8GB card. Given how cheap cards are, you might as well get a larger card so that you do not ever have to worry about running out of space. I recommend getting the fastest card you can find. (Speed is normally indicated as a number, such as 5 or 10. Higher numbers are better.) For good measure, get several cards. SD cards wear out so you should plan on replacing the SD card; avoid re-using older SD cards. Be mindful that some cards are defective and will trigger random write errors. These errors might show up as mysterious failures in your Raspberry Pi. For this reason, I recommend getting more than one card: always have a backup.
- I recommend getting a nice plastic box to enclose your Raspberry Pi, just so that it is prettier and sturdier.
- You might also need an ethernet cable if you do not have one already. If you are going to use the Raspberry Pi, it is best to connect it directly to your router: wifi is slower, more troublesome and less scalable. I have had no end of trouble trying to run a Raspberry Pi server using wifi: I don&rsquo;t know whether it is possible.
- Though it is not strictly necessary, I urge you to get a heat sink for the CPU of the Raspberry Pi. The processor of the Raspberry Pi may heat up and when it does, the performance of the computer may drop drastically.
- An HDMI cable, an HDMI-compatible monitor or TV, a USB keyboard and a USB mouse are also be required at first though not to run the server per se. The Raspberry Pi 4 needs a micro-HDMI to HDMI cable unlike the older Raspberry Pis that relied on a standard HDMI cable.


<h2>Instructions</h2>

- You need to put the latest version of the Linux distribution for the Raspberry Pi, [Raspberry Pi OS](http://downloads.raspberrypi.org/raspios_arm64/images/), on the SD card. If you have a recent Raspberry Pi (3 or 4), I recommend getting the 64-bit Raspberry Pi OS, as it may provide better performance and allow you to use more memory. My instructions assume that you get the full version. For some reason, many people prefer the &ldquo;lite&rdquo; version, but then they may have difficulty following my instructions. Please use the full version (the lite and the full versions are both free). You can make things work with the &ldquo;lite&rdquo; version and even save a few steps and some storage space, but if you go down the &ldquo;lite&rdquo; route, you should not expect the instructions to work for you. If you have an old version of the operating system, do not try to upgrade it unnecessarily. Starting from a fresh version is best. Simply follow [the instructions](https://www.raspberrypi.org/documentation/installation/installing-images/README.md) from the Raspberry Pi website. Downloading the image file may take forever.
- At first, you will need a monitor or a TV (with an HDMI connection), a keyboard and a mouse connected to the Raspberry Pi. Connect your Raspberry Pi to your router through the ethernet cable. Put the SD card in the Raspberry Pi. If, like it happened to me, the card won&rsquo;t stay plugged in, just use a rubber band. Do so with some care as you can easily damage the SD card or the Raspberry Pi by pushing the card at the wrong angle or with too much strength. It is really, really important that the card be put in the Raspberry Pi nicely: some boxes that you might put the Raspberry Pi into make it difficult to fit the card just right. If needed, remove the Raspberry Pi from the box you put it in to make sure that everything is plugged in just right. Plug the monitor, the keyboard, and the mouse. Plug the power in and it should start.
- The Raspberry Pi will launch in a graphical mode with mouse support and everything you expect from a modern operating system: we will soon get rid of this unnecessary luxury. Hopefully, you have Internet access right away. Because I am assuming that you are using an ethernet cable (as opposed to wifi), there should be no configuration needed for Internet access.
- By default your username is &ldquo;pi&rdquo; on this new Raspberry Pi. Do not change it even if you know how. If you do so, you will need to update all the instructions: you are on your own.
- Go to the [terminal](https://www.raspberrypi.org/documentation/usage/terminal/). On a Raspberry Pi with a graphical desktop, it can sometimes be found on the Desktop itself maybe under the name <tt>LXTERMINAL</tt>. You should be able to find it quickly by navigating through the graphical desktop and looking the icons. When it launches, the terminal application starts a &ldquo;[bash shell](https://en.wikipedia.org/wiki/Bash_(Unix_shell))&rdquo; (by default). In a shell, you type commands followed by the enter key. Try typing <tt>pwd</tt>, it should return <tt>/home/pi</tt>. If so, congratulations! You are on your way to becoming a Linux hacker!
- (Optional) It helps to know that files in a modern computer are organized into directories (sometimes called folders). Directories can contain other directories, and so forth. On a Raspberry Pi, by default, you have a home directory located at <tt>/home/pi</tt>. You can create new directories under this home directory. You generally cannot write to files located outside your home directory and its subdirectories, nor can you create new directories everywhere: to do so, you need to invoke administrative privileges which is done by prefixing your commands by the `sudo` instruction. However, you should only use the `sudo` when it is strictly necessary as it is a security risk and it affects the file and directory permissions. It might help if you are familiar with the following shell commands:

- <tt>pwd</tt>: gives you the current (working directory).
- <tt>echo $HOME</tt>: gives you the location of your home directory (this should be <tt>/home/pi</tt> throughout.
- <tt>cd newdirectory</tt>: changes the current directory to _newdirectory_ if it exists.
- <tt>mkdir newdirectory</tt>: creates a new directory called _newdirectory_ under the current directory.
- <tt>ls</tt>: displays all files and directories in the current directory.
- <tt>cd ..</tt>: changes the current directory to the parent directory.
- <tt>rm myfile</tt>: permanently deletes the file called <em>myfile</em>.
- <tt>cp myfile1 myfile2</tt>: creates a new file called _myfile2_ which has the same content as <em>myfile1</em>.
- <tt>mv myfile1 myfile2</tt>: moves or renames the file _myfile1_ to <em>myfile1</em>.

<li>Install a few extra packages by typing this command line <tt>sudo apt-get install netatalk screen avahi-daemon default-jdk</tt>, followed by the enter key. Though the command may span more than one line in your browser, enter it as a single line. __Do not skip this important step. Please do not get into an argument as to whether you need all three packages: just install them, life is short.__
<li>Type <tt>java --version</tt>. It should return a message telling you which Java version you have. It should be 8 or better. The latest versions of Minecraft require Java 16, but we can still build older versions with Java 8.
<li>Make sure you have plenty of free disk space: type <tt>df</tt>. This will print a table with several columns. One column should be <tt>'Use%'</tt> and another should be <tt>'Mounted on'</tt>. Pay attention to the lines where <tt>'Mounted on'</tt> is <tt>'/'</tt> or <tt>'/home'</tt>. There should be plenty of disk space: it is indicated by a low percentage value under <tt>'Use%'</tt>. A percentage of use above 50% might be cause for concern. Should you ever encounter errors later, type `df` to check that you have plenty of disk space.
<li>Try typing <tt>screen -list</tt>. If it complains that there is no `screen` command, go back to the previous step and install it. Otherwise, you should get a message of the type <tt>No Sockets found</tt>: that&rsquo;s good!
<li>Then type <tt>sudo raspi-config</tt>. This command starts a little configuration tool.

1. First, tell it to expand the file system so that it uses all the SD card.
1. For safety, I recommend changing the default password (the default account is called `pi` with password <tt>raspberry</tt>).
1. You want to tell the Raspberry Pi to boot in the shell: <tt>Console Autologin Text console, automatically logged in as 'pi' user</tt>.
1. In Internationalisation Options, you may want to configure the time and locale.
1. You may want to set the overclocking to the maximum setting, if the option is available. (Overclocking is optional and may cause instabilities and crashes.)
1. You want to assign the minimum amount of memory to the GPU (16 is enough) from Advanced Options. This is important: if you skip this step, some Raspberry Pis will simply not have enough memory to run the server and you will be getting errors.
1. Under the advanced options, you may want to check the Hostname value. It defaults to <tt>raspberrypi</tt>, I assume you are not changing it. You may need to change it if you have several Raspberry Pis on your network.
1. Make sure that the ssh server is on. The term &ldquo;ssh&rdquo; stands for &ldquo;secure shell&rdquo;, it is a way to connect to the shell of another machine remotely and securely (with encryption).
1. A nice trick at this point is to find the IP address of the Raspberry Pi on your network. Type <tt>ifconfig|grep "inet "</tt>. The result might contain two lines, one line with the string &ldquo;addr:127.0.0.1&rdquo; and another with a string that looks like &ldquo;addr:192.168.1.87&rdquo;. In that case, 192.168.1.87 is your IP address (your address will be different). Note that if you can access your router, you should also be able to find the IP address of your Raspberry Pi, but not everybody can or should access their router.


You can exit <tt>raspi-config</tt> which should bring you back to the bash shell. Reboot the Raspberry Pi by typing <tt>sudo reboot</tt> in the bash shell.
<li>From your PC or Mac on the same network, you need to connect by `ssh` to <tt><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="53233a1321322023313621212a233a7d3f3c30323f">[email&#160;protected]</a></tt>.

- On a Mac, just go to Terminal (Finder/Applications/Utilities/Terminal) and type <tt>ssh <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="88f8e1c8fae9fbf8eaedfafaf1f8e1a6e4e7ebe9e4">[email&#160;protected]</a></tt>.
- If you are using Windows, you can access your Raspberry Pi via ssh by using [Putty](https://www.putty.org/). (If you have Windows 10, Microsoft makes available a [Linux subsystem](https://en.wikipedia.org/wiki/Windows_Subsystem_for_Linux) with full support for <tt>ssh</tt>. If you can make the Linux subsystem work, then typing <tt>ssh <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="582831182a392b283a3d2a2a2128317634373b3934">[email&#160;protected]</a></tt> in its bash shell should work.)


If, somehow, <tt>raspberrypi.local</tt> does not resolve, then replace it by the hard-coded IP address we found previously by typing <tt>ifconfig</tt>. Using a hard-coded IP address is not a good idea because it may change over time. However, temporarily using the hard coded IP address can allow you to make progress (e.g., check the configuration of the Raspberry Pi).

You should now be in the bash shell on the Raspberry Pi. Once this work, you can unplug the Raspberry Pi from the monitor, the keyboard and the mouse. Your server is now &ldquo;headless&rdquo;.
<li>From your home directory on the Raspberry Pi, create a directory where you will install the Minecraft files: <tt>mkdir minecraft &amp;&amp; cd minecraft</tt>. (This is a single command, on a single line.) You can install your files elsewhere, but you need to adapt the instructions below accordingly.
<li>Download the build file for Spigot (your chosen Minecraft software) using the following command line:
```C
wget https://hub.spigotmc.org/jenkins/job/BuildTools/lastSuccessfulBuild/artifact/target/BuildTools.jar
```


(Though the command may span several lines in your browser, it is a single line.)
<li>Build the server by entering the following command line:
```C
<tt>java -Xmx1024M -jar BuildTools.jar  --rev 1.16.5</tt>```


(one line followed by the return key). You can change the version number (1.16.5) to use a more recent release but be mindful that recent versions of Minecraft require more recent Java versions (e.g., JDK 16). If it complains about not finding the java command, try typing <tt>sudo apt install default-jdk</tt> (one line followed by the return key) before typing again <tt>java -Xmx1024M -jar BuildTools.jar</tt>. Once the java program starts, its will take forever. Go drink coffee. After a long time, it will create a file called  <tt>spigot-1.16.5.jar</tt> as well as many other files. If it fails with mysterious errors, make sure that you had enough disk space. Type
```C
<tt>ls spigot*.jar</tt>```


to find how the jar files is called, I will assume that you have <tt>spigot-1.16.5.jar</tt>. The exact name and version number will change over time as spigot gets updated periodically. Adapt the instructions below according to the actual name of the file.

If the build fails with some Java-related error, [please report the issue with spigot](https://www.spigotmc.org/).
<li>Once this is done, start the server for the first time:
```C
<tt>java -jar -Xms512M -Xmx1008M spigot-1.16.5.jar nogui</tt>```


This will create a file called <tt>eula.txt</tt>. You need to edit it with the command
```C
<tt>echo "eula=true" &gt; eula.txt</tt>```


Make sure that the file contains the line <tt>eula=true</tt>, type
```C
<tt>more eula.txt</tt>```


to be sure.
<li>Start the server a second time:
```C
<tt>java -jar -Xms512M -Xmx1008M spigot-1.16.5.jar nogui</tt>```


It will take forever again. Go drink more coffee. Once the server return the command prompt, it should be operational. Have a Minecraft player connect to <tt>raspberrypi.local</tt>. Once you have verified that everything works, type <tt>stop</tt>. If your Raspberry Pi has a lot of memory (e.g., 4 GB or 8 GB) then you can change the -Xmx1008M to something like -Xmx2048M. The number (e.g., 2048M) should not exceed the available RAM. Giving the server more memory may improve the performance. If you have installed the 64-bit Raspberry Pi OS, you may even go safely to larger memory budgets (4096M or more).
<li>If you made it this far, then you got a minecraft server running on your Raspberry Pi. Fantastic! However, we want the server to keep on running even when we are not connected by `ssh` to the server. There are many ways to do this, but we will use `screen` to achieve our goal. It is not the best way, but it should be good enough.
<li>We are going to create a convenient script to start the server. Type <tt>nano minecraft.sh</tt> and write the following __four lines of code__:
```C
if ! screen -list | grep -q "minecraft"; then
  cd /home/pi/minecraft
  screen -S minecraft -d -m java -jar  -Xms512M -Xmx1008M spigot-1.16.5.jar nogui 
fi
```


It is really important to type the 4-line script (or copy and paste it) accurately. You can also grab the [minecraft.sh file from GitHub](https://gist.github.com/lemire/49144ae19ba6d2a3525ec3b05cab1bf7) if you prefer. You must remember to replace spigot-1.16.5.jar with the actual name of your jar file.

The `if` clause helps to make sure that only one instance runs at any one time (it is not perfect, but should be good enough).

Some people have trouble copying and pasting the content of the minecraft.sh file. As a sanity test, type <tt>wc -l minecraft.sh</tt>. The shell should return <tt>4 minecraft.sh</tt> indicating that the script has 4 lines, if you do not see the number 4, do not continue! If you get any number other than 4, then you did not correctly copied the script, it will not work. I am aware that your browser might represent on the web page the 4 lines as more than 4 lines, but there are exactly 4 lines to be copied.

We also want to check the syntax of the script, so type <tt>bash -n minecraft.sh</tt>: this command should return immediately without any error. Now that we have verified that the script has four lines and has a valid syntax, let us make the script executable: <tt>chmod +x minecraft.sh</tt>.

You did remember that I am assuming that you have a file called <tt>spigot-1.16.jar</tt>, right? If your file name differs, please adapt the script accordingly. Please read the script again, make sure that everything is ok.
<li>To make the server more stable, type <tt>nano spigot.yml</tt>. Set <tt>view-distance: 5</tt>. This may or may not be necessary, you can experiment. The downside of this setting is that the clients will get a more limited view.
<li>Optionally, you may want to type <tt>nano server.properties</tt> and modify the greeting message given by the `motd` variable.
<li>We want the server to start automatically when the Raspberry Pi reboots, so type <tt>sudo nano /etc/rc.local</tt> and enter <tt>su -l pi -c /home/pi/minecraft/minecraft.sh</tt> right before the exit command.
<li>Start the server again using the script: <tt>./minecraft.sh</tt> while in the bash shell. (I recommend __against__ typing <tt>sudo ./minecraft.sh</tt> as it would run the server as the root user: you do not want that.) The script will return you to the shell. There should be no error, if there is an error then you need to backtrack and start again: you missed a step somewhere. (These instructions have been thoroughly tested: chances are good that you did not follow them correctly if you are getting an error.)
<li>Your minecraft server (Spigot) is managed using its own console. The console operates a bit like the bash shell: you type commands followed by the enter key. It is also used by the server to log its operations, so you can see what it is currently doing. To access the console of the minecraft server type <tt>screen -r minecraft</tt>, to return to the shell type <tt>ctrl-a d</tt>. At any point, you can now disconnect from the server. The server is still running. You do not need to remain connected to the Raspberry Pi.
<li>Spigot makes use of temporary files (located in <tt>/tmp</tt>). This can cause performance issues and instabilities on a Raspberry Pi. It may even shorten the life of your SD card. It might be better to have temporary files reside in memory. To alleviate the problem, open the file <tt>/etc/fstab</tt> with a text editor such as `nano` as root (e.g., type <tt>sudo nano /etc/fstab</tt>). It should look something like this:
```C
proc            /proc           proc    defaults          0       0
/dev/mmcblk0p6  /boot           vfat    defaults          0       2
/dev/mmcblk0p7  /               ext4    defaults,noatime  0       1
```


(Though these three lines may span several lines in your browser, there is really just three lines.) The important point is that there should be no line where the second entry is &ldquo;/tmp&rdquo;. Then append a new line:
```C
tmpfs           /tmp            tmpfs   nodev,nosuid,size=1M 0    0
```


(Though this line may appear as several lines in your browser, it is really just a single line.) Where you append/insert this line does not matter, but please note that you need to create a new line. The format of the `fstab` file requires that there is one entry per line. The fstab file is read at boot time and you must follow the syntax carefully otherwise you will get an error at the next reboot: so verify your work carefully. For this change to take effect, I recommend simply stopping the Minecraft server, by going to the server prompt (type <tt>screen -r minecraft</tt> if needed) and then typing <tt>stop</tt>. Then you can safely reboot the Raspberry Pi (e.g., with the <tt>sudo reboot</tt> command). If you have done everything right, the server should automatically start following a reboot sequence. In the future, the temporary files will get written to <tt>/tmp</tt> which is actually a disk in memory. Thus, your SD card won&rsquo;t get touched so often.

If the command <tt>screen -r minecraft</tt> because there is no session called &ldquo;minecraft&rdquo;, it is like because you did not run the <tt>./minecraft.sh</tt> or if you did, it was in error. You must be running the minecraft.sh script first if you want to be able to type <tt>screen -r minecraft</tt>.
<li>You are done, congratulations!


And voilà ! The result is a &ldquo;robust&rdquo; and low-cost Minecraft server. You should be able to access it from a Java-based Minecraft desktop client using either <tt>raspberrypi.local</tt> or the IP address of the server.

If you ever need to stop the server, just log in with ssh, use <tt>screen -r minecraft</tt> to get to the server prompt and type <tt>stop</tt>. (If it complains that there is no minecraft screen, then you probably did not not run the minecraft.sh script first.) At the bash prompt, type <tt>sudo shutdown -h now</tt>. Wait a few seconds, then unplug the Raspberry Pi.

It is possible to add user-contributed plugins to your server. There are many desirable plugins. For example [the lanbroadcaster](https://www.spigotmc.org/resources/lanbroadcaster.5320/) plugin may allow your server to be automatically discovered by the Minecraft client within the same local network. To add a Minecraft plugin, drop the corresponding jar file in the `plugins` directory under the `minecraft` directory (<tt>/home/pi/minecraft/plugins</tt>) and restart the server (type `stop` in the server prompt and relaunch <tt>minecraft.sh</tt>). You can recover plugin jar files from the Internet using the `wget` or `curl` commands in a shell followed by the URL such as <tt>wget http://thedomain.com/theplugin.jar</tt>. If you misplaced the jar file on the Raspberry Pi, you can move it to the right directory with the `mv` command: <tt>mv theplugin.jar /home/pi/minecraft/plugins</tt>. If you have the plugin jar files on your Windows PC, you can use `sftp` to upload them to the Raspberry Pi from your PC. There are free sftp clients such as [WinSCP](https://winscp.net/eng/docs/free_sftp_client_for_windows).

You can easily setup several such servers, just buy more Raspberry Pis!

Next, you can make the server available on the Internet using a service like <tt>dyn.com</tt>, and some work on your router to redirect the Minecraft port (25565) from your router to the Raspberry Pi. It is not very difficult to do but it requires you to know a few things about how to configure your router. You should also be aware of the security implications. I am not going to tell you how to do it because the specifics depend on your exact configuration, on how you access the Internet, how your router is configured and so forth. At best, I could describe various scenarios, but if things go wrong, it could leave you without Internet, with security hole, or with a violation of the terms of services of your Internet provider. So you are on your own if you want to expose your server to the Internet at large.

Want to get your Raspberry Pi to do something different? I recommend simply switching to a different SD card containing the latest Linux distribution for Raspberry Pis. It is generally faster to start anew than to reconfigure a machine and given how inexpensive SD cards are. Don&rsquo;t waste time reusing an existing card.

You may wonder why setting up a Minecraft server is so complicated. Can&rsquo;t I or others just package the servers so that it is plug and play? We are limited because the copyright owners of Minecraft do want us to ship ready-to-run Minecraft servers. It should be possible, however, to largely automate the steps that I have outlined. I leave it as an exercise for the reader.

Is there any point to all of this? Probably not. Minecraft servers like Spigot are memory hungry and the Raspberry Pi has little memory. However, the project has stretched my imagination and made me think of new possibilities. I used to recycle old PCs as home servers to provide backups and caching for various projects. I got tired of having old, noisy and bulky PC in my home&hellip; but I could literally stack a cluster of Raspberry Pi computers in a shoe box. The fact that they are silent and use little power is really a blessing.

__Extra__: What if you have installed the Minecraft server, and now want to upgrade it? Sadly, there is no built-in support for in-place updates in Spigot as far as I know. When the software does not support updates, many things can go wrong if you try to force an update so I simply recommend against updates. If you need a new version, just reinstall a new version from scratch. If you want to explore with in-place updates despite my contrary advice, [one comment to this post describes a possible approach](/lemire/blog/2016/04/02/setting-up-a-robust-minecraft-server-on-a-raspberry-pi/#comment-260357), but I do not recommend it particularly. It is at your own risks.

__Further reading__: A short version of this blog post is a chapter in the book &ldquo;[Creative projects with Raspberry Pi](https://www.amazon.com/Creative-Projects-Raspberry-Kirsten-Kearney/dp/1419725009/)&rdquo; by K. Kearney and W. Freeman.

