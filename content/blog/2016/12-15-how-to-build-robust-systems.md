---
date: "2016-12-15 12:00:00"
title: "How to build robust systems"
---



Millions of little things go wrong in your body every minute. Your brain processes the data in a noisy manner. Even trained mathematicians can&rsquo;t think logically most of the time.

In our economy, most companies fail within a decade. Most products are flawed.

Over a million people die every year in car accidents. We have made cars much safer over the last few decades, not by turning them into tanks or by limiting speed to 10&nbsp;km/h, but by adding air bags and other security features that make accidents less harmful.

A large fraction of our software is built in C. The C language is great, but it does not easily lend itself to a rigorous analysis. For example, a lot of production C software relies on &ldquo;undefined&rdquo; behavior that is compiler specific.

Irrespective of the programming language you choose, your software will run out of resources, it will contain bugs&hellip; Faults are unavoidable but our computers still keep us productive and entertained.

There are two distinct strategies to build robust systems:

1. You can reduce the possibility of a fault.
1. You can reduce the harm when faults do occur.

We all know what it means to reduce the possibility of a fault&hellip; we can make software safer by adding more checks, we can train better drivers&hellip;
But what does the latter (reducing harm) means concretely? Our bodies are designed so that even if hundreds of our cells break down you barely notice it. Our economy can keep working even if a large fraction of its enterprises fail. Robust software systems are all around us. For example, modern operating systems (Linux, Windows, Android, iOS, macOS) can sustain many faults before failing. Our web servers (e.g., Apache) have often long streams of error logs.

As a programmer, it is simply not possible to account for everything that may go wrong. Systems have limited resources (e.g., memory) and these may run out at any time. Your memory and storage may become corrupted&hellip; there is a small but non-zero probability that a single bit may flip. For example, [cosmic rays are bound to corrupt slightly your memory](https://en.wikipedia.org/wiki/Cosmic_ray#Effect_on_electronics). We can shield memory and storage, and add layers of redundancy&hellip; but, beyond a certain point, reducing the possibility of a fault becomes tremendously complicated and expensive&hellip; and it becomes far more economical to minimize the harm due to expected faults.

