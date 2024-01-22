---
date: "2019-02-01 12:00:00"
title: "Web caching: what is the right time-to-live for cached pages?"
---



I have been having performance problems with my blog and this forced me to spend time digging into the issue. Some friends of mine advocate that I should just &ldquo;pay someone&rdquo; and they are no doubt right that it would be the economical and strategic choice. Sadly, though I am eager to pay for experts, I am also a nerd and I like to find out why things fail.

My blog uses something called WordPress. It is a popular blog platform written in PHP. WordPress is fast enough for small sites, but the minute your site gets some serious traffic, it tends to struggle. To speed things up, I tried using a WordPress plugin called WP Super Cache. What the plugin does is to materialize pages as precomputed HTML. It should make sites super fast.

There is a caveat to such plugins: by the time you blog is under so much stress that PHP scripts can&rsquo;t run without crashing, no plugin is likely to save you.

I also use an external service called Cloudflare. Cloudflare acts as a distinct cache, possibly serving pre-rendered pages to people worldwide. Cloudflare is what is keeping my blog alive right now.

After I reported that by default (without forceful rules) Cloudflare did very little caching, a Cloudflare engineer got in touch. He told me that my pages were served to Cloudflare with a time-to-live delay of 3 seconds. That is, my server instructs Cloudflare to throw away cached pages after three seconds.

I traced back the problem to what is called an htaccess file on my server:
```C
<IfModule mod_expires.c>
<span class="Apple-converted-space">  ExpiresActive On
<span class="Apple-converted-space">  ExpiresByType text/html A3
&lt;/IfModule&gt;
```


The mysterious &ldquo;A3&rdquo; means &ldquo;expires after 3 seconds&rdquo;.

How did this instruction get there? It gets written by WP Super Cache. I checked WP Super Cache.

I work on software performance, but I am not an expert on Web performance. However, this feels like a very short time-to-live.

I am puzzled by this decisions by the authors of WP Super Cache.

