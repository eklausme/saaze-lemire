---
date: "2006-06-27 12:00:00"
title: "Leaving for Curves and Surfaces (Avignon)"
---



In a few hours, I&rsquo;m &ldquo;planing&rdquo; (opposite of &ldquo;deplaning&rdquo;) for Avignon, France where I&rsquo;ll attend Curves and Surfaces 2006. The web site is currently down.

I will be talking about monotone curves.

For applications such as pattern recognition, curve reconstruction and so on, it is important to be able to study the properties of curves and chains (a chain is just a discrete, usually finite, curve). For discrete functions, while we can&rsquo;t talk about smoothness, we can talk about monotonicity, for example. A perfectly monotone (or piecewise monotone) discrete function (or signal) is unlikely to be noisy.

What is the equivalent of monotonicity for curves?

The typical definition of a monotone curve is a so-called <em>v</em>-monotone curve: under a change of basis where _v_ is aligned with the x-axis, then the curve&rsquo;s x-component is always __increasing__. For most settings, this is a very strong requirement.

We decided to look at an alternative definition of what it could mean for a curve (or a chain) to be monotone. For functions, we know that _f_ is monotone if the inverse image of balls are connected. So, we decided that an arc-length parametrized curve _s_ would be <em>R</em>-monotone if the inverse images of balls are connected. We go on to show it is a sensible definition. The definition also applies to chains. We can then filter noisy chains to increase their degree of monotonicity (<em>R</em>).

In the coming months/weeks, I&rsquo;ll post the preprint. It is also available to those who ask by email.

__Update__: I posted [my slides on the web](https://lemire.me/talks/cs2006slideslemire.pdf). Comments are invited even if you don&rsquo;t attend Curves and Surfaces.

