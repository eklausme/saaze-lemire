---
date: "2005-12-21 12:00:00"
title: "Metaclass programming in Python"
---



I&rsquo;m a few years behind, but while I knew you could modify classes in Python, it turns out [you can do it conveniently as of Python 2.2](http://www.ibm.com/us-en/).

Here&rsquo;s how you can dynamically create a class:<br/>
<code>>>> from new import classobj<br/>
>>> Foo2 = classobj('Foo2',(),{"mymethod":lambda self,x: x})<br/>
>>> Foo2().mymethod(2)<br/>
2<br/>
</code>

Once the class has been created, you can easily modify it as well:

<code>>>> setattr(Foo2,'anothermethod',lambda self,x: 2*x)<br/>
>>> Foo2().anothermethod(2)<br/>
4<br/>
</code>

I recall that I found ways to achieve the same result by manipulating directly class objects, but this is much neater.

You can even dynamically change the class of an object:<br/>
<code>>>> t.__class__=classobj('newFoo2', (Foo2,), {"supermethod":lambda self,x: 5*x})<br/>
>>> t.supermethod(2)<br/>
10<br/>
</code>

That&rsquo;s pretty satisfying.

