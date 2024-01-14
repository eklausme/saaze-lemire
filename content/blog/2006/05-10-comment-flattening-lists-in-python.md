---
date: "2006-05-10 12:00:00"
title: "Flattening lists in Python"
index: false
---

[17 thoughts on &ldquo;Flattening lists in Python&rdquo;](/lemire/blog/2006/05-10-flattening-lists-in-python)

<ol class="comment-list">
<li id="comment-5055" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.entish.org" class="url" rel="ugc external nofollow">Will</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-05-10T18:20:34+00:00">May 10, 2006 at 6:20 pm</time></a> </div>
<div class="comment-content">
<p>I think you just want isinstance, but here&rsquo;s a nice recursive function:</p>
<p>How about:</p>
<p>def flatten(x):<br/>
if not isinstance(x,list):<br/>
return x<br/>
elif len(x) is 0:<br/>
return []<br/>
elif isinstance(x[0],list):<br/>
return flatten(x[0]) + flatten(x[1:])<br/>
else:<br/>
return [x[0]] + flatten(x[1:])</p>
</div>
</li>
<li id="comment-7211" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/acb338cd446d343bd90e734cd8851e20?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/acb338cd446d343bd90e734cd8851e20?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://kogs-www.informatik.uni-hamburg.de/~meine/python_tricks" class="url" rel="ugc external nofollow">Hans Meine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-06-01T12:20:47+00:00">June 1, 2006 at 12:20 pm</time></a> </div>
<div class="comment-content">
<p>No, Daniel, I don&rsquo;t know a better way ATM.<br/>
A possible reason for this obvious lack could be that the Python community likes to have functions with clear semantics. For example, sometimes I want to flatten only one level, or different types, for example, given this input:</p>
<p>[[[1,2,3], (42,None)], [4,5], [6], 7, MyVector(8,9,10)]</p>
<p>One could imagine the following outputs:</p>
<p># flattened one level:<br/>
[[1, 2, 3], (42, None), 4, 5, 6, 7, MyVector(8,9,10)]</p>
<p># flattened all lists:<br/>
[1, 2, 3, (42, None), 4, 5, 6, 7, MyVector(8,9,10)]</p>
<p># flattened all lists and tuples:<br/>
[1, 2, 3, 42, None, 4, 5, 6, 7, MyVector(8,9,10)]</p>
<p># flattened all iterables:<br/>
[1, 2, 3, 42, None, 4, 5, 6, 7, 8, 9, 10]</p>
<p>@Will: Daniels version looks more optimized to me. The question whether isinstance is better than checking the class is another possible implementation decision, e.g. given the following definition of MyVector:</p>
<p>class MyVector(list):<br/>
def __init__(self, *args):<br/>
list.__init__(self, args)</p>
<p>Your version would handle it the same as a list, while daniels would not flatten it.</p>
<p>For the record, the above corresponds to the following checks in Daniel&rsquo;s flatten function:<br/>
if i.__class__ is list:<br/>
if i.__class__ in (list, tuple):<br/>
if isinstance(i, list):<br/>
if isinstance(i, (list, tuple)):<br/>
if hasattr(i, &ldquo;__iter__&rdquo;):<br/>
AFAICS the simplest way to flatten only one layer is to change the recursive call to &ldquo;list&rdquo; instead of &ldquo;flatten&rdquo;.</p>
</div>
</li>
<li id="comment-26981" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/36c10e2de5115d5729e12676727d0b71?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/36c10e2de5115d5729e12676727d0b71?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://rightfootin.blogspot.com/" class="url" rel="ugc external nofollow">Jordan Callicoat</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-09-04T02:33:40+00:00">September 4, 2006 at 2:33 am</time></a> </div>
<div class="comment-content">
<p>Here is a version from the <a href="http://code.activestate.com/lists/python-list/%3cliH36.2811$Qb7.324901@newsb.telia.net%3e/" rel="nofollow">mailing list</a>:</p>
<p><code>def flatten(seq):<br/>
res = []<br/>
for item in seq:<br/>
if (isinstance(item, (tuple, list))):<br/>
res.extend(flatten(item))<br/>
else:<br/>
res.append(item)<br/>
return res</code></p>
<p>Another version is listed a in recipe <a href="http://code.activestate.com/recipes/363051/" rel="nofollow">363051</a>:</p>
<p><code>import sys<br/>
def flatten(inlist, ltype=(list,tuple), maxint=sys.maxint):<br/>
try:<br/>
for ind in xrange(maxint):<br/>
while isinstance(inlist[ind], ltype):<br/>
inlist[ind:ind+1] = list(inlist[ind])<br/>
except IndexError:<br/>
pass<br/>
return inlist</code></p>
</div>
</li>
<li id="comment-49393" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77a1142f4afe07e79f5346ccb48aba50?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77a1142f4afe07e79f5346ccb48aba50?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sweavo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-07-11T11:45:09+00:00">July 11, 2007 at 11:45 am</time></a> </div>
<div class="comment-content">
<p>def flatten(l):<br/>
if isinstance(l,list):<br/>
return sum(map(flatten,l))<br/>
else:<br/>
return l</p>
</div>
</li>
<li id="comment-49631" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/104db6ac9406aa777a0525a0c4a5d75e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/104db6ac9406aa777a0525a0c4a5d75e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-14T08:23:28+00:00">December 14, 2007 at 8:23 am</time></a> </div>
<div class="comment-content">
<p>def flatten(x):<br/>
result = []<br/>
for v in x:<br/>
if hasattr(v, &lsquo;__iter__&rsquo;) and not isinstance(v, basestring):<br/>
result.extend(flatten(v))<br/>
else:<br/>
result.append(v)<br/>
return result</p>
</div>
</li>
<li id="comment-49721" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a326ce4c89baa4f75e5a81e083649473?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a326ce4c89baa4f75e5a81e083649473?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">BioStatMatt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-31T16:57:09+00:00">January 31, 2008 at 4:57 pm</time></a> </div>
<div class="comment-content">
<p>As far as I can tell, several of the functions presented above do not work, including sweavo&rsquo;s. Thie function below does work.</p>
<p>def flatten(x):<br/>
ans = []<br/>
for i in range(len(x)):<br/>
if isinstance(x[i],list):<br/>
ans = x[:i]+flatten(x[i])+x[i+1:]<br/>
else:<br/>
ans.append(x[i])<br/>
return ans</p>
</div>
</li>
<li id="comment-49722" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a326ce4c89baa4f75e5a81e083649473?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a326ce4c89baa4f75e5a81e083649473?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">BioStatMatt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-31T17:10:32+00:00">January 31, 2008 at 5:10 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, my previous post didn&rsquo;t work either. But this one does. Honest.</p>
<p>def flatten(x):<br/>
ans = []<br/>
for i in range(len(x)):<br/>
if isinstance(x[i],list):<br/>
ans.extend(flatten(x[i]))<br/>
else:<br/>
ans.append(x[i])<br/>
return ans</p>
</div>
</li>
<li id="comment-49750" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd55e62ee83014d7c1163f8323d2787d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd55e62ee83014d7c1163f8323d2787d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">timv</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-02-29T21:59:04+00:00">February 29, 2008 at 9:59 pm</time></a> </div>
<div class="comment-content">
<p>A modified version of sweavo&rsquo;s post (which didn&rsquo;t work for me either):</p>
<p>def flatten(l):<br/>
if isinstance(l,list):<br/>
return sum(map(flatten,l),[])<br/>
else:<br/>
return [l]</p>
</div>
</li>
<li id="comment-49763" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Markus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-03-05T11:29:46+00:00">March 5, 2008 at 11:29 am</time></a> </div>
<div class="comment-content">
<p>What about using the reduce-function?</p>
<p>E.g. </p>
<p>def flatten(l):<br/>
return reduce(operator.add, l)</p>
<p>Obviously this requires the operator-module import.</p>
</div>
</li>
<li id="comment-49913" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c048375b9161029bf5dffc57ab5717e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c048375b9161029bf5dffc57ab5717e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bob the Chef</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-15T16:35:46+00:00">May 15, 2008 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>There is a problem with most of these in that they&rsquo;re recursive. Why is it a problem? Because python&rsquo;s stack is going to blow up when the depth of the list is something ridiculously large. </p>
<p>So, we must do this with iteration. One way is to iterate over the list until no lists remain:</p>
<p>def flatten(lst):<br/>
has_lists = True<br/>
while has_lists:<br/>
tmp_lst = []<br/>
has_lists = False<br/>
for elt in lst:<br/>
if isinstance(elt, list):<br/>
tmp_lst += elt<br/>
has_lists = True<br/>
else:<br/>
tmp_lst.append(elt)<br/>
lst = tmp_lst<br/>
return lst</p>
<p>Of course, you&rsquo;re doing more iteration that you need to if the list contains elements of variable list depth. But since function calls are expensive in Python, it may actually be faster than recursion.</p>
</div>
</li>
<li id="comment-50789" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/836b5e3f093c1050f7a058c227ffd1fa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/836b5e3f093c1050f7a058c227ffd1fa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">grimborg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-03-13T12:56:08+00:00">March 13, 2009 at 12:56 pm</time></a> </div>
<div class="comment-content">
<p>works with recursive arrays too&#8230; maybe a bit too long though</p>
<p>def flatten(inlist):<br/>
res = []<br/>
def append(l):<br/>
try: res.extend(flatten(l))<br/>
except TypeError:res.append(l)<br/>
map(append, inlist)<br/>
return res</p>
<p>Test:<br/>
&gt;&gt;&gt; print flatten([[[[1]]],[2],[[[3],4,5],6],7])<br/>
[1,2,3,4,5,6,7]</p>
</div>
</li>
<li id="comment-50790" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/836b5e3f093c1050f7a058c227ffd1fa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/836b5e3f093c1050f7a058c227ffd1fa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">grimborg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-03-13T12:57:28+00:00">March 13, 2009 at 12:57 pm</time></a> </div>
<div class="comment-content">
<p>ahh spaces got cut.<br/>
def flatten(inlist):<br/>
____ res = []<br/>
____ def append(l):<br/>
________ try: res.extend(flatten(l))<br/>
________ except TypeError:res.append(l)<br/>
____ map(append, inlist)<br/>
____ return res</p>
</div>
</li>
<li id="comment-50891" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/83858c3aa798d3fb8e29439ededcf192?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/83858c3aa798d3fb8e29439ededcf192?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://ionelmc.wordpress.com/" class="url" rel="ugc external nofollow">Ionel Maries</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-30T03:59:58+00:00">April 30, 2009 at 3:59 am</time></a> </div>
<div class="comment-content">
<p>reduce(lambda a, b: isinstance(b, (list, tuple)) and a+list(b) or a.append(b) or a, the_nested_list, [])</p>
</div>
</li>
<li id="comment-54080" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f6fe249e1ef4d974c339c1efcced50c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f6fe249e1ef4d974c339c1efcced50c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-01-05T17:30:25+00:00">January 5, 2011 at 5:30 pm</time></a> </div>
<div class="comment-content">
<p>If you don&rsquo;t mind losing the order of the list, you can do it with a nonrecursive oneliner;</p>
<p>lambda X:(lambda x:filter(lambda x:not hasattr(x,&rsquo;__iter__&rsquo;),[[x.append(j) for j in i] if hasattr(i,&rsquo;__iter__&rsquo;) else i for i in x]))(list(X))</p>
</div>
</li>
<li id="comment-54356" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/85034ef64232dfcb7cf269e8d30b17a5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/85034ef64232dfcb7cf269e8d30b17a5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://dailyffs.com" class="url" rel="ugc external nofollow">Lucho</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-25T08:18:54+00:00">April 25, 2011 at 8:18 am</time></a> </div>
<div class="comment-content">
<p>&gt;&gt;&gt; def flatten(l):<br/>
&#8230; return reduce(lambda a,b: a + (flatten(b) if hasattr(b, &lsquo;__iter__&rsquo;) else [b]), l, [])<br/>
&#8230;<br/>
&gt;&gt;&gt; flatten([1,[2,3,[4,[5,6],7],8,[9,10,[11]]]])<br/>
[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]</p>
</div>
</li>
<li id="comment-54834" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/835bdcfb604af710b8a7e574431d3ddc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/835bdcfb604af710b8a7e574431d3ddc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lelutin.ca/" class="url" rel="ugc external nofollow">Gabriel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-12-17T14:04:10+00:00">December 17, 2011 at 2:04 pm</time></a> </div>
<div class="comment-content">
<p>def flatten(lst):<br/>
for el in lst:<br/>
if hasattr(el, &ldquo;__iter__&rdquo;) and not isinstance(el, basestring):<br/>
for x in flatten(el):<br/>
yield x<br/>
else:<br/>
yield el</p>
</div>
</li>
<li id="comment-271540" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ac7e3d4eb0ec90cf534ca1f2c1e70b6f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ac7e3d4eb0ec90cf534ca1f2c1e70b6f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">krononet</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-13T13:53:02+00:00">February 13, 2017 at 1:53 pm</time></a> </div>
<div class="comment-content">
<p>def flatten(aList):<br/>
copyL = []<br/>
for k in aList:<br/>
if type(k) == type([]):<br/>
copyL = copyL + flatten(k)<br/>
else:<br/>
copyL.append(k)<br/>
return copyL</p>
</div>
</li>
</ol>
