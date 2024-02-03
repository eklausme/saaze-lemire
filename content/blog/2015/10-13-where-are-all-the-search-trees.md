---
date: "2015-10-13 12:00:00"
title: "Where are all the search trees?"
---



After arrays and linked lists, one of the first data structures computer-science students learn is the search tree. It usually starts with the [binary search tree](https://en.wikipedia.org/wiki/Binary_search_tree), and then students move on to [B-trees](https://en.wikipedia.org/wiki/B-tree) for greater scalability.

Search trees are a common mechanism used to implement key-value maps (like a dictionary). Almost all databases have some form of B-tree underneath. In C++, up until recently, default map objects were search trees. In Java, you have the TreeMap class.

In contrast to the search tree, we have the hash map or hash table. Hash maps have faster single look-ups, but because the keys are not ordered physically, traversing the keys in sorted order can be much slower. And it might require fully sorting the keys as part of the iteration process, if you want to go through the keys in order.

In any case, if technical interviews and computer-science classes make a big deal of search trees, you&rsquo;d think they were ubiquitous. And yet, they are not. Hash maps are what is ubiquitous.

- JavaScript, maybe the most widely used language in the world, does not have search trees part of the language. The language provides an Object type that can be used as a key-value store, but the keys are not sorted in natural order. Because it is somewhat [bug prone](http://www.less-broken.com/blog/2010/12/lightweight-javascript-dictionaries.html) to rely on the Object type to provide a map functionality, the language recently acquired a [Map](https://developer.mozilla.org/en/docs/Web/JavaScript/Reference/Global_Objects/Map) type, but it is again a wrapper around what must be a hash map. Maps are &ldquo;sorted&rdquo; in insertion order, probably through a linked list so that, at least, the key order is not random.
- Python, another popular language, is like JavaScript. It provides an all-purpose <a href="https://docs.python.org/2/library/stdtypes.html"><tt>dict</tt></a> type that is effectively a map, but if you were to store the keys &lsquo;a&rsquo;, &lsquo;b&rsquo;, &lsquo;c&rsquo;, it might give them back to you as &lsquo;a&rsquo;, &lsquo;c&rsquo;, &lsquo;b&rsquo;. (Try <tt> {'a': 0, 'b': 0, 'c': 0}</tt> for example.) That is, a `dict` is a hash map. Python has an OrderedDict class, but it merely remembers the order in which the keys were added (like JavaScript&rsquo;s Map). So there is no search tree to be found!
- The Go language (golang) provides a [map class](https://blog.golang.org/go-maps-in-action), but we can be sure there is no underlying search tree, since Go randomizes the key order by design! (To prevent users from relying on key order.)


What does it mean? It means that millions of programmers program all day long without ever using a search tree, except maybe when they access their database.

Though key-value stores are essential to programmers, the functions offered by a search tree are much less important to them. This suggests that programmers access their data mostly in random order, or in order of insertion, not in natural order.

__Further reading__: [Scott Meyers has an article](http://scottmeyers.blogspot.ca/2015/09/should-you-be-using-something-instead.html) showing that hash maps essentially outperform all other look-ups except for tiny ones where a sequential search is best.

__Update__: It is commonly stated that a hash map uses more memory. That might not be generally true however. In [a test of hash maps against tree maps in Java](https://github.com/lemire/HashVSTree), I found both to have comparable memory usage.

