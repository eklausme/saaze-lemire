---
date: "2006-02-23 12:00:00"
title: "Giving Efficient Distance Lectures on a Budget"
---



As part of CS6905, I lecture from my basement near Montreal, to New Brunswick in Easter Canada. Sounds crazy? Well, according to my collaborators, this works well for everyone involved. We use [webhuddle](http://www.webhuddle.com) to broadcast the lectures. We are short of a video stream, but it seems that it is not a critical flaw.

If, like me, you prepare your slides using LaTeX, then you have a small problem because webhuddle expects either PowerPointish files or a zip file containing JPG or GIF images. Don&rsquo;t go for JPG images as they are too big when your slides are mostly text and a flat background. Here&rsquo;s a script to convert a PDF file into a bunch of GIF files (it can be improved upon):

<code><br/>
pdftoppm $1 $1ppm<br/>
listoffiles=""<br/>
for i in $1ppm*.ppm<br/>
do<br/>
echo "converting file " $i<br/>
convert -resize 800x600 $i $i.gif<br/>
listoffiles=$i".gif "$listoffiles<br/>
echo "you can now delete "$i<br/>
done<br/>
echo "now zipping "$listoffiles<br/>
zip -9 $1.zip $listoffiles<br/>
echo "zip file is "$1.zip<br/>
</code>

