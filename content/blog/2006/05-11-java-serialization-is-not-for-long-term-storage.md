---
date: "2006-05-11 12:00:00"
title: "Java Serialization is not for long term storage"
---



Using Serialization for long term storage, is a common mistake. In fact, Microsoft made with with Microsoft Word and it is a well known source of trouble (ever had a corrupted file you could not recover from?). Serialization in Java was never advertized as a viable storage long term mechanism. We serialize in order to send objects over a wire (RMI), or for lightweight persistance (especially for non-critical data). I&rsquo;m not making this up, this is how Sun documents it.

Also, Sun makes no promise that you&rsquo;ll be able to deserialize, if your code changes. Ever heard of the java.io.InvalidClassException class? That&rsquo;s what you&rsquo;ll get on your face if you ever change the class you used to serialize (even if you change it just a little bit).

Think about the following scenario:

1. You serialize some objects you care about.
1. Weeks pass by.
1. For some reason or other, you change the class. Suppose, for example, that you delete a field or you move the class up or down in the hierarchy. You don&rsquo;t keep the old class around anymore.
1. That&rsquo;s it, you can&rsquo;t deserialize your objects __ever__ unless you do reverse engineering. It won&rsquo;t stop and ask you how you want it fixed, it will just throw an exception with no direct way for you to fix this. You&rsquo;ll need to &ldquo;hand recover you data&rdquo;. Have fun. If the data was not your own, and it was hand crafted by a client, you are probably going to lose your job.


And let&rsquo;s not even get into what happens if you must exchange your data with other software not written in Java.

If you really care about your data, dump it in a custom XML format. It isn&rsquo;t that hard.

