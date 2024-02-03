---
date: "2008-05-06 12:00:00"
title: "Graph diameter versus maximum node degree"
---



Since I have had [amazing luck in the past](/lemire/blog/2008/05/01/i-am-seeking-an-efficient-algorithm-to-group-identical-values-in-an-array/) with questions to the readers of this blog, I have another question.

The diameter of a graph is the longest distance between any two nodes. The degree of a node is the number of edges or links from and to this node.

Intuitively, the higher the node degrees, the denser the graph. If you have _n_ nodes and the maximal degree of the nodes is <em>n</em>-1, then the graph diameter is 1. If you have lesser maximal degrees, then you can get an infinite diameter by producing a disconnected graph.

An interesting question (to me) is:

> Given a maximal node degree, and a number of nodes <em>n</em>, what is the smallest possible diameter?


I am sure this is textbook material, but I could not find the answer quickly. Using a hyper-rectangle, I am able to construct a graph having _n_ nodes and log _n_ diameter. Simply start with a 4-node rectangular graph: you have 4 nodes and a diameter of 2. Move to a 8-node cubic graph: you have 8 nodes and a diameter of 3. Generalizing this construction, you have 2<sup><em>d</em></sup> nodes and a diameter of <em>d</em>. Is this the best you can do?

Anyhow. Why do I care about the answer? Because I keep reading that hubs are necessary in graphs to ensure that we have a small diameter. I am trying to quantify this statement. There are about 2<sup>33</sup> human beings. By my construction above, if everyone knows 33 people, then it is possible to get a diameter of 33. It seems like a relatively large diameter.

An obvious technique to shrink the diameter without using hubs, is to increase the maximal node degree. I am wondering by how much I need to increase the maximal node degree so that I can a 6 degree of separation between any two human beings.

(Yes, I know that social networks are not homogeneous. But stay with me. Assume they were.)

