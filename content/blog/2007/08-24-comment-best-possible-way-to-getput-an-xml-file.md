---
date: "2007-08-24 12:00:00"
title: "Best Possible Way to GET/PUT an XML File?"
index: false
---

[One thought on &ldquo;Best Possible Way to GET/PUT an XML File?&rdquo;](/lemire/blog/2007/08-24-best-possible-way-to-getput-an-xml-file)

<ol class="comment-list">
<li id="comment-49457" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f25e3572004e350625a80d2363421a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f25e3572004e350625a80d2363421a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.datavore.com/welcome" class="url" rel="ugc external nofollow">Paul Meagher</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-08-24T12:33:50+00:00">August 24, 2007 at 12:33 pm</time></a> </div>
<div class="comment-content">
<p>In PHP, this is how you can read the contents of file so you can display it in a form and write the contents of a web form to a file. You can add more complex read and write operations as desired but this is the basic way to do file IO.</p>
<p>// get body<br/>
$path2file = SITE_ROOT.&rdquo;/xml/doc_&rdquo; . $doc_id . &ldquo;.php&rdquo;;<br/>
$fp = fopen($path2file, &lsquo;r&rsquo;) or die (&lsquo;Could not open $path2file for reading.&rsquo;);<br/>
$data[&lsquo;doc_body&rsquo;] = fread($fp, filesize($path2file));<br/>
fclose($fp);<br/>
// write body<br/>
$path2file = SITE_ROOT.&rdquo;/xml/doc_&rdquo; . $doc_id . &ldquo;.php&rdquo;;<br/>
$fh = fopen($path2file, &ldquo;w&rdquo;) or die (&lsquo;Could not open file for writing.&rsquo;);<br/>
fwrite ($fh, $form_data[&lsquo;doc_body&rsquo;]);<br/>
fclose($fh);</p>
</div>
</li>
</ol>
