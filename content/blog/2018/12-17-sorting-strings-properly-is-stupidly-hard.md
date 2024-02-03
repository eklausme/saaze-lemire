---
date: "2018-12-17 12:00:00"
title: "Sorting strings properly is stupidly hard"
---



Programming languages make it hard to sort arrays properly. Look at how JavaScript sorts arrays of integers:
```C
> v = [1,3,2,10]
[ 1, 3, 2, 10 ]
> v.sort()
[ 1, 10, 2, 3 ]
```


You need a magical incantation to get the right result:
```C
> v.sort((a,b)=>a-b)
[ 1, 2, 3, 10 ]
```


Though this bad default can create bugs, it is probably not the source of too many frustrations. However, sorting strings alphabetically is a real problem. Let us see how various languages do it.

JavaScript:
```C
> var v = ["e", "a", "é","f"]
> v.sort()
[ 'a', 'e', 'f', 'é' ]
```

```C
> v = ["a","b","A","B"]
> v.sort()
[ 'A', 'B', 'a', 'b' ]
```



Python:
```C
>>> x=["e","a","é","f"]
>>> x.sort()
>>> x
['a', 'e', 'f', 'é']
```

```C
>>> x=["a","A","b","B"]
>>> x.sort()
>>> x
['A', 'B', 'a', 'b']
```



Swift:
```C
  1> var x = ["e","a","é","f"]
  2> x.sorted()
$R0: [String] = 4 values {
  [0] = "a"
  [1] = "e"
  [2] = "f"
  [3] = "é"
```

```C
  1>  var x = ["a","b","A","B"]
  2> x.sorted()
$R1: [String] = 4 values {
  [0] = "A"
  [1] = "B"
  [2] = "a"
  [3] = "b"
}
```



As far as I can tell, by default, these languages apply crude code-point sorting. Human beings understand that the characters e, é, E, Ã‰, Ã¨, Ãª, and so forth, should be considered as the same letter (e) with accents. There are exceptions to this rule, but the default which consists in sorting accentuated characters after the letter &lsquo;z&rsquo; is just not reasonable. The way case is handled is patently stupid. You might prefer A to come before a, or vice versa, but no human being would ever sort the letters as A,B,a,b or a,b,A,B.

There are standards for sorting strings, such as the [Unicode Collation Algorithm](http://unicode.org/reports/tr10/).

To get a sensible default, programming languages force you to use complicated code. In JavaScript, it is burdensome but easy enough&hellip;.
```C
> v.sort(Intl.Collator().compare)
[ 'a', 'e', 'é', 'f' ]
```


However, I am not sure what the equivalent is in Python and Swift. It does not jump at me in the documentation of the respective standard librairies. I did not even look at it for other popular programming languages like Go, C++, and so forth.

It is unacceptably difficult to do the &ldquo;right thing&rdquo;. The net result is that many programmers do not sort strings properly. If you use a natural language with non-English characters, you see the effect in many applications. It looks bad.

Thankfully, most major software products get it right. Microsoft Office, Google Docs, Apple apps&hellip; all do the right thing. It creeps up in small budget applications. I have to use one in my daily life as an employee of a public university, and it annoys me.

We should do better.

__Further reading__:[International Components for Unicode](https://en.wikipedia.org/wiki/International_Components_for_Unicode)

