---
date: "2007-08-20 12:00:00"
title: "Is the cosine similarity transitive?"
---



A simple enough similarity measure is the cosine similarity measure. It is used often in Information Retrieval and it works well. It is also quite simple: cos(v,w)=&lt;v/|v|,w/|w|>. 

Clearly, it is reflexive (cos(v,v)=1) and symmetric (cos(v,w)=cos(w,v)). But it is also transitive: if cos(v,w) is near 1, and cos(w,z) is near 1, then cos(v,z) is near 1.

Can you prove transitivity? 

I do have a hastily-derived inequality, but I want to know if anyone can best me. (Not hard.)

(Yes, I am looking for a two-liner.)

