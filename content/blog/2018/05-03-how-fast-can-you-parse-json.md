---
date: "2018-05-03 12:00:00"
title: "How fast can you parse JSON?"
---



JSON has become the de facto standard exchange format on the web today. A JSON document is quite simple and is akin to a simplified form of JavaScript:
```C
{
     "Image": {
        "Width":  800,
        "Height": 600,
        "Animated" : false,
        "IDs": [116, 943, 234, 38793]
      }
}
```


These documents need to be generated and parsed on a large scale. Thankfully, we have many fast libraries to parse and manipulate JSON documents.

In a recent paper by Microsoft ([Mison: A Fast JSON Parser for Data Analytics](http://www.vldb.org/pvldb/vol10/p1118-li.pdf)), the researchers report parsing JSON document at 0.1 or 0.2 GB/s with common libraries such as RapidJSON. It is hard to tell the exact number as you need to read a tiny plot, but I have the right ballpark. They use a 3.5 GHz processor, so that&rsquo;s 8 to 16 cycles per input byte of data.

Does it make sense? 

I don&rsquo;t have much experience processing lots of JSON, but I can use a library. [RapidJSON](http://rapidjson.org) is handy enough. If you have a JSON document in a memory buffer, all you need are a few lines:
```C
rapidjson::Document d;
if(! d.ParseInsitu(buffer).HasParseError()) {
 // you are done parsing
}
```


This &ldquo;ParseInsitu&rdquo; approach modifies the input buffer (for faster handling of the strings), but is fastest. If you have a buffer that you do not want to modify, you can call &ldquo;Parse&rdquo; instead. 

To run an example, I am parsing one sizeable &ldquo;twitter.json&rdquo; test document. I am using a Linux server with a Skylake processor. I parse the document 10 times and check that the minimum and the average timings are close.

ParseInsitu              |Parse                    |
-------------------------|-------------------------|
4.7 cycles / byte        |7.1 cycles / byte        |


This is the time needed to parse the whole document into a model. You can get even better performance if you use the streaming API that RapidJSON provides.

Though I admit that my numbers are preliminary and partial, they suggest to me that Microsoft researchers might not have given RapidJSON all its chances, since their numbers are closer to the &ldquo;Parse&rdquo; function which is slower. It is possible that they do not consider it acceptable that the input buffer is modified but I cannot find any documentation to this effect, nor any related rationale. Given that they did not provide their code, it is hard to tell what they did exactly with RapidJSON.

The Microsoft researchers report results roughly 10x better than RapidJSON, equivalent to a fraction of a cycle per input byte. The caveat is that they only selectively parse the document, extracting only subcomponents of the document. As far as I can tell, their software is not freely available.

How would they fare against an optimized application of the RapidJSON library? I am not sure. At a glance, it does not seem implausible that they might have underestimated the speed of RapidJSON by a factor of two.

In their paper, the Java-based JSON libraries (GSON and Jackson) are fast, often faster than RapidJSON even if RapidJSON is written in C++. Is that fair? I am not, in principle, surprised that Java can be faster than C++. And I am not very familiar with RapidJSON&hellip; but it looks like performance-oriented C++. C++ is not always faster than Java but in the hands of the right people, I expect it to do well.

So I went looking for a credible performance benchmark that includes both C++ and Java JSON libraries and found nothing. Google is failing me.

In any case, to answer my own question, it seems that parsing JSON should take about 8 cycles per input byte on a recent Intel processor. Maybe less if you are clever. So you should expect to spend 2 or 3 seconds parsing one gigabyte of JSON data.

[I make my code available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/05/02).

