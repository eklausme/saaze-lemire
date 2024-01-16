<p>
<a href="https://packagist.org/packages/eklausme/saaze-lemire"><img src="https://img.shields.io/packagist/v/eklausme/saaze-lemire" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/eklausme/saaze-lemire"><img src="https://img.shields.io/packagist/l/eklausme/saaze-lemire" alt="License"></a>
</p>


# Example theme for Simplified Saaze: Lemire

Here is another theme called [Lemire](https://eklausmeier.goip.de/lemire) for [_Simplified Saaze_](https://eklausmeier.goip.de/blog/2021/10-31-simplified-saaze).
The example content is from [Daniel Lemire](http://lemire.me).

Some key features of the Lemire-theme:
1. Lightweight as there are no gimmicks, no social media icons, no categories+tags, no dark theme switcher
2. Fully responsive with media breaks at 39rem, 60em, 78rem
3. Uses the [HashOver](https://eklausmeier.goip.de/blog/2022/01-04-hashover-comment-system-with-hiawatha) commenting system.

![](https://eklausmeier.goip.de/img/LemireTheme1.webp)

See [Example Theme for Simplified Saaze: Lemire](https://eklausmeier.goip.de/blog/2024/01-02-example-theme-for-simplified-saaze-lemire) for installation, conversion, and usage.


# Simplified Saaze

_Simplified Saaze_ is a fast, all-inclusive, flat-file CMS for simple websites and blogs.

Static site builders are fast but normally have a steep learning curve and require lots of tooling to make them work. We believe building a personal site should be stupidly simple. That's why _Simplified Saaze_ is built on the following principles.

* Easy to run - All you need is [PHP8](https://www.php.net), a C compiler, and [Composer](https://getcomposer.org)
* Easy to host - Serve dynamically or statically
* Easy to edit - Edit content using simple Markdown files
* Easy to theme - Templates use plain PHP/HTML
* Fast and secure - No database = less moving parts + more speed
* Simple to understand - Everything is a collection of entries

For more info and documentation for the original Saaze see https://saaze.dev.
Read [_Simplified Saaze_](https://eklausmeier.goip.de/blog/2021/10-31-simplified-saaze) for installation and usage.


# Speed

The entire WordPress blog including comments has been migrated to a static site as of 08-Dec-2023.
The new site has comments, a commenting system using HashOver, and instant search via [Pagefind](https://eklausmeier.goip.de/blog/2023/10-23-pagefind-searching-in-static-sites) using WebAssembly.

The migration, theme, and installation is explained in [Example Theme for Simplified Saaze: Lemire](https://eklausmeier.goip.de/blog/2024/01-02-example-theme-for-simplified-saaze-lemire).
The migration of all the content, blog posts and comments, was done via two simple Perl scripts, less than 300 lines.

Running the [static site generator](https://eklausmeier.goip.de/blog/2021/10-31-simplified-saaze) on a regular basis:
Converting all 2,259 blog posts to static without comments takes 0.41 seconds, including all comments it takes 0.91 seconds for all the 3,935 entries (CPU is Ryzen 7 3500G).
This runtime is single threaded (one core). Using multithreading would further reduce this time.
The static site generator _Simplified Saaze_ is known to be more than 10-times faster than Hugo, see [Performance Comparison Saaze vs. Hugo vs. Zola](https://eklausmeier.goip.de/blog/2021/11-13-performance-comparison-saaze-vs-hugo-vs-zola).

The resulting static site is served three times faster than the WordPress site from Frankfurt and San Francisco as checked by [Pingdom](https://tools.pingdom.com).
See [Performance Comparison of Lemire Website: WordPress vs. Simplified Saaze](https://eklausmeier.goip.de/blog/2024/01-14-performance-comparison-of-lemire-website-wordpress-vs-simplified-saaze).

If you want to check the numbers, use:
```
composer create-project eklausme/saaze-lemire
```


# Credits

_Simplified Saaze_ was created by [Elmar Klausmeier](https://eklausmeier.goip.de).

Saaze was created by [Gilbert Pellegrom](https://gilbitron.me) from [Dev7studios](https://dev7studios.co). Released under the MIT license.

