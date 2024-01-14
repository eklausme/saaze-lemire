---
date: "2007-01-15 12:00:00"
title: "Turing award recipient tears apart artificial intelligence"
index: false
---

[2 thoughts on &ldquo;Turing award recipient tears apart artificial intelligence&rdquo;](/lemire/blog/2007/01-15-turing-award-recipient-tears-apart-artificial-intelligence)

<ol class="comment-list">
<li id="comment-49111" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/227dcc8c79584bb4af4f6a463c1aa6f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/227dcc8c79584bb4af4f6a463c1aa6f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">RivestF</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-01-18T07:47:11+00:00">January 18, 2007 at 7:47 am</time></a> </div>
<div class="comment-content">
<p>My personnal guess is that the brain may eventually be modeled. As for language (and other things), I think the main issue is that there is a small piece of architecture that is highly replicated (like the visual system), but we just haven&rsquo;t found it yet. (And since we can&rsquo;t record in human brains with electrodes, it won&rsquo;t come tomorrow!) But this is just a guess.</p>
</div>
</li>
<li id="comment-49820" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a9cefe8e0d6764e68c425c1c3062ba78?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a9cefe8e0d6764e68c425c1c3062ba78?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">plc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-03-29T05:08:08+00:00">March 29, 2008 at 5:08 am</time></a> </div>
<div class="comment-content">
<p>Having read his Synapse State Theory paper, I don&rsquo;t quite know what to think &#8211; He seems to have a point, but I fail to perceive the big difference with today&rsquo;s commonly accepted model of the animal brain:<br/>
That the differences and plasticity of neural synapses make up the &ldquo;matter&rdquo; of thought (if that is precise enough to describe it).</p>
<p>Perhaps he&rsquo;d be more accepted by his scientific colleagues if he cared more for other people&rsquo;s work &#8211; He&rsquo;d have to present sound arguments rather than just dismissing the accepted current research.</p>
<p>And about the time complexity of modelling mental activity, wouldn&rsquo;t that be more like Omega(N*S), where N = total number of neurons, and S = total number of synapses because:</p>
<p>A &lsquo;worst case&rsquo; scenario would probably be an activity involving every single neuron (or a very large amount of them anyway). If every neuron fires, you&rsquo;d have to update every synapse connected to it, in order to update its new state of conductivity.</p>
<p>And if we try to reason about the number of synapses compared to neurons, we get a (probably unrealistic) scenario of every neuron connected to all the remaining neurons, leaving us with (1/2)*n*(n+1) synapses. (because the problem essentially is SIGMA(s, from s=1 to s=n) )<br/>
This leaves us with something in the order of Theta(n^2) (and that is regardless of whether a synapse is unidirectional or not), resulting in a total lower bound for mental modelling of Omega(n^3) </p>
<p>I certainly look forward to reading his book in order to see for myself if he&rsquo;s on to something or has simply given in to his megalomania.</p>
</div>
</li>
</ol>
