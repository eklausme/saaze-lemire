---
date: "2010-12-24 12:00:00"
title: "Make your own programmable digital thermometer in an hour"
---



<img decoding="async" style="float: right; margin: 4px;" src="https://lh4.ggpht.com/__I-3q9m-Gqo/TRVGvI9Gj7I/AAAAAAAABu4/tH9kW8Mvlts/s144/P1040498.JPG" alt />I make my own yogourt because I cannot stand commercial yogourt. You can make your own yogourt in less than 30 minutes: heat milk to 112F (44C), mix in a small quantity of yogourt, leave the container of warm milk in a blanket overnight.

To minimize the labor I wanted a digital thermometer with an alarm set at 112F. Alas, most kitchen digital thermometers are designed for cooking meat. They can take intense heat, but exposure to milk shortens their life considerably.

Inspired by Frauenfelder&rsquo;s [Made by Hand](https://www.amazon.com/Made-Hand-Searching-Meaning-Throwaway/dp/1591843324/ref=sr_1_1?ie=UTF8&amp;qid=1293240616&amp;sr=8-1), I decided to make my own programmable digital thermometer.

You can do it__ in an hour and for less than $80.__ __You do not need any specific knowledge__. A kid could do it.

You need to order:

- An Arduino board ($30). I have used an Uno [ Arduino](https://en.wikipedia.org/wiki/Arduino).
- An LCD Keypad Shield ($24). I have used the DFRobot Shield.
- A ZX-Thermometer Temperature Sensor by [INEX Robotics](http://www.inexglobal.com/products.php?type=addon&amp;cat=app_sensors&amp;model=zx-thermometer) ($8). (Update: my tests show that its surface is lead-free.)
- You also need a USB cable to connect the Arduino to your computer, wires, a generic piezo element (as a buzzer) and a resistance. I recommend buying an Arduino Starter kit.
- You may also need a 9V battery and an adaptor to connect it to the Arduino board. You can get a [9V to 2.1mm Barrel Jack](http://www.robotshop.ca/sfe-9v-to-2-1mm-barrel-jack.html) for $3.
- I have used a [breadboard](https://en.wikipedia.org/wiki/Breadboard) for convenience.


<img decoding="async" style="float: right; margin: 4px;" src="https://lh4.ggpht.com/__I-3q9m-Gqo/TRVHj-p_DTI/AAAAAAAABvQ/CInLKDpLQsU/s144/P1040502.JPG" alt />

The assembly takes less than an hour (see my Picasa album for [all the pictures](https://picasaweb.google.com/lemire/Arduino#)).

1. Put the LCD shield on the Arduino.
1. Connect the thermometer on the analog port 2 (middle wire). Connect another wire to the 5V and another yet to ground. You need to add a resistance between the 5V and the thermometer.
1. Connect the piezo on digital 12. Don&rsquo;t forget to ground one half of it.
1. Connect the Arduino to your computer by USB. Upload the program using the [Arduino IDE](http://arduino.cc/en/Main/Software). I have posted the [C++ software](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2010/12/24/ZX_Thermometer.c) on github. You can use Linux, Windows or a Mac to connect to the Arduino.


Operating the thermometer is easy. Give it some power. The display should come alive. Put the end of the black wire from the thermometer in your liquid. The up and down button control the target temperature. When it is reached, the piezo will play a bad rendition of [Frère Jacques](https://en.wikipedia.org/wiki/Fr%C3%A8re_Jacques). Make sure you disconnect the battery once you are done to save power. This thermometer should work well for beer and yogourt making.

You can easily customize it by adding timers and several different target temperatures. Instead of a piezo element, you could use a voice synthesizer. Best of all, if the temperature sensor breaks, you only need to replace an $8 component.

__Further reading:__ [Arduino](https://en.wikipedia.org/wiki/Arduino) and [Open hardware](https://en.wikipedia.org/wiki/Open_hardware).

__Disclosure:__ Though I link to RobotShop products, I am not affiliated with them in any way. The main Arduino web site has a [list of Arduino distributors](http://www.arduino.cc/en/Main/Buy) by country.

__Code:__ Source code posted on my blog is available from a [github repository](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2010/12/24/ZX_Thermometer.c).

