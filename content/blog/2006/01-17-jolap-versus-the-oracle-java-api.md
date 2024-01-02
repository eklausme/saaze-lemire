---
date: "2006-01-17 12:00:00"
title: "JOLAP versus the Oracle Java API"
---



Some years ago (in 2000), the Java OLAP (JOLAP) spec. was proposed and it was finally ratified by all parties (including Oracle, Sun, Apple but __not__ IBM and Microsoft). One point that has been puzzling me is why JOLAP wasn&rsquo;t more widely adopted, at least partially. (__Update__: though the Final JOLAP Draft was approved, the spec. was never released and there is no license available right now allowing anyone to implement the Final Draft.) For our course CS6905 Advanced Technologies for E-Business, I prepared what must be too many slides on the JOLAP and Oracle Java API. I didn&rsquo;t find a comparison between the Oracle OLAP API and JOLAP, so here&rsquo;s my own analysis:

- Firstly, Oracle doesn&rsquo;t implement the [Common Warehouse Model](http://www.omg.org/cwm/) (CWM). I have no experience working with CWM, but it seems like CWM is quite complex. Maybe they figured it wasn&rsquo;t worth the trouble?
- Secondly, in its OLAP API, Oracle doesn&rsquo;t implement the J2EE Connector model, or anything having to do with J2EE. I suspect Oracle is not eager to depend on J2EE.
- Thirdly, the Oracle OLAP API doesn&rsquo;t have Cube and Edge objects. To me, this is a shame because I really like the Edge objects JOLAP defines. Anyone knows why Oracle didn&rsquo;t integrate those in its revised 10g API?


So, we are left in an OLAP world where Microsoft&rsquo;s MDX is the sole cross-vendor query language. How ironic!

