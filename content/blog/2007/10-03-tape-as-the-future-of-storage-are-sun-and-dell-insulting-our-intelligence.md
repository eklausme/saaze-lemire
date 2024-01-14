---
date: "2007-10-03 12:00:00"
title: "Tape as the future of storage: are Sun and Dell insulting our intelligence?"
---


<img decoding="async" src="http://farm1.static.flickr.com/70/172810044_8e0cce9c08_m.jpg" /><br/><small>([source](http://www.flickr.com/photos/garyjwood/))</small>

The CEO of Sun (Jonathan Schwartz) has decided to refocus his company on storage, or so [he said on his blog](https://blogs.oracle.com/roller-ui/errors/404.jsp). So far so good. I do not think you can endlessly assume that people will want more computing power, as it comes with a growing electricity bill, but you can assume they will always need more storage as long as the electricity bill remains constant.

The trouble, of course, is that the more hard drives you have, the more electricity you use. This works well for a PC. But in a multi-exabyte data warehouse where most of the data is never accessed, you want the electricity usage to be independent of the amount of data.

Solution? Just power down your hard drives, I say.
Here is what Jonathan had to say:

>Today, only tape can maintain the integrity of that data without electricity. And for the datacenters we serve, many are seeing the cost of electricity threatening to eclipse their hardware budgets (yes, I&rsquo;m serious).


Ok. Hard drives are __not very reliable__ and you need multiple copies of the data to be safe, and you need refresh these copies all the time. This does require some electricity, but copying hard drives on a regular basis should not be so costly if the hard drives spend much of their time powered down. And, frankly, I would not trust a tape backup forever either: surely, you have to copy those as well from time to time.

Meanwhile, __hard drives are at least ten times cheaper than tape backups__, given the same storage. In fact, it appears that 1 TB of tape backup costs $5000 whereas 1 TB of hard drives costs well under $500. This means that I can buy 8 hard drives, and duplicate my data 8 times, and still save money over tape backups. With the hard drives, I will have much better performance due to much better random access latency. So why would I ever buy tape backups?

Are you going to tell me that 8 replicated hard drives are less reliable than one tape backup? I bet it uses just about as much space.
The story was recently spinned to Canadian journalists and it seems that Dell agrees with Sun. Here is what a spokesman for Dell had to say:

>Our studies suggest about 81 per cent of companies are looking to increase their level of investment in tape and over half are using tape for compliance issues.


My take on this story is that Sun and Dell are insulting our intelligence. They are selling this idea that tape-backups-are-great to managers who have money to waste, but real engineers know better.

(Yes, maybe I am wrong. If so, tell me how!)
