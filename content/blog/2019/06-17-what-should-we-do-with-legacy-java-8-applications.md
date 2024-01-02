---
date: "2019-06-17 12:00:00"
title: "What should we do with &#8220;legacy&#8221; Java 8 applications?"
---



Java is a mature programming language. It was improved over many successive versions. Mostly, new Java versions did not break your code. Thus Java was a great, reliable platform.

For some reason, the Oracle engineers decided to break things after Java 8. You cannot &ldquo;just&rdquo; upgrade from Java 8 to the following versions. You have to update your systems, sometimes in a significant way.

For management purposes, my employer uses an ugly Java application, launched by browsers via something called Java Web Start. I am sure that my employer&rsquo;s application was very modern when it launched, but it is now tragically old and ugly. Oracle has ended maintenance of Java 8 in January. It may stop making Java 8 available publicly at the end of 2020. Yet my employer&rsquo;s application won&rsquo;t work with anything beyond Java 8.

Java on the desktop is not ideal. For a business applications, you are much better off with a pure Web application. It is easier to maintain, secure, it is more portable. Our IT staff knows this, they are not idiots. They are preparing a Web equivalent that should launch&hellip; some day&hellip; But it is <em>complicated</em>. They do not have infinite budgets and there are many stakeholders.

What do we do while something more modern is being built?

If you are a start-up, you can just switch to the open-source version of Java 8 like OpenJDK. But we are part of a large organization. We want to rely on supported software: doing otherwise would be irresponsible.

So what do we do?

I think that their current plan is just to stick with Java 8. They have an Oracle license, so they can keep on installing Java 8 on PCs even if Oracle pulls the plug.

But is that wise?

I think that a better solution would be to switch to [Amazon Corretto](https://aws.amazon.com/corretto/). Amazon recruited James Gosling, Java&rsquo;s inventor. It feels like the future of Java may move in Amazon&rsquo;s hands.

__Update__: [RedHat is offering paid support for OpenJDK 8.](https://www.redhat.com/en/about/press-releases/red-hat-introduces-commercial-support-openjdk-microsoft-windows)

