---
date: "2019-01-31 12:00:00"
title: "My blog can´t keep up: 500 errors all over"
---



My blog is relatively minor enterprise. It is strictly non-profit (no ad). I have been posting one or two blog posts a week for about fifteen years. I have been using the same provider in all this time (csoft.net). They charge me about $50 a month. I also subscribe to Cloudflare services, which costs me some extra money.

I use wordpress. If I had to do things over, I would probably choose something else, but that is what I have today. I have thousands of posts, comments, pages, and lots of personalization: I&rsquo;d rather not risk breaking or losing all this content.

I use php version 7.0. My host provides version 7.3, but 7.0 is the latest they support with something called mbstring. Without mbstring (whatever that is), my blog simply won&rsquo;t run.

I estimate that I get somewhere between 30,000 and 50,000 unique visitors a month. Despite my efforts, my blog keeps on failing under the load. It becomes unavailable for hours.

I have given up on writing new blog post using the online editor. It is brittle. The old wordpress editor worked relatively well, but since upgrading wordpress, they have now pushed something called the Gutenberg editor. It tries to be clever, but half the time it just fails with a 500 error (meaning that the server just failed). So I use a client called MarsEdit. It seems to work well enough. (Update: after the blog stopped throwing 500 errors constantly, I was able to switch back to default editor which works better for me.)

Several times a week, someone emails me to report that they tried to leave a comment and they got a 500 error.

I seem to get about one spam comment per minute or so. I have just now decided to close comments on posts older than 30 days, in the hope that it will relax the load on my server.

My error logs are filled with &ldquo;End of script output before headersâ€ (a few every minutes).

I used to rely on WP Super Cache, hoping that it made things better, but I have since disabled most plugins. I am hoping Cloudflare can do the work. (Update: I have since re-enabled WP Super Cache, now that I have fewer php failures, in the hope that it might work. I do not think that it can do its work if your php scripts can&rsquo;t run to completion.)

I had the following line in the .htaccess file at the root of my blog:
```C
Header set Cache-Control "max-age=600, public"
```


The intention was that it would entice Cloudflare to cache everything. I do not think it worked.

Because my error logs showed that wp-cron.php was failing every few minutes, I added the following in my wp-config.php file:
```C
define('DISABLE_WP_CRON', true);
```


I setup a separate cron job to call wp-cron.php every hour.

I now use Cloudflare with the following settings: &ldquo;Caching Level: Ignore query string, Respect Existing Headers and Cache: Everything. I pay for Argo, whatever that is, in the hope that it might improve things. With these settings, I would expect Cloudflare to cache pretty much everything. It apparently does not. My blog gets hammered. Cloudfare reports 45,000 uncached requests for the day, and most of them are in the last couple of hours. (Update: I managed to get cloudflare to cache everything by going to page rules, and setting cache everything, and waiting a few hours. I had to make sure my rules were applied correctly.)

I have asked my host provider (csoft.net) to give me more memory, but they seem unwilling to do it transparently. Though csoft.net is neither cheap nor particularly modern, they have been professional. I have purchased a service with SiteGround, as I am considering moving there because it seems more popular than csoft. I am not super excited about tuning my PHP/Wordpress setup, however. I fear that it is wrong-headed optimization.

What am I missing? How can I be in so much trouble in 2019 with such a relatively modest task?

__Note 1__: I am aware that there are centralized platform like Medium. This blog is an independent blog on purpose.

__Note 2__: Many people suggest that I move away from WordPress to something like static generation (e.g., Hugo). I am sympathetic to this point of view, but it is a much easier choice to make when you are starting out and don&rsquo;t have thousands of articles to carry over.

__Credit__: I am grateful to Travis Downs and Nathan Kurz for an email exchange regarding my problems.

__Update__: My blog is now hosted with SiteGround.

