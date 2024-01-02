---
date: "2007-01-26 12:00:00"
title: "Debug CSS with the Firefox DOM Inspector"
---



While it allows us to make HTML pages really beautiful without cluttering the HTML code with presentation artefacts, Cascading Style Sheet (CSS) is a rather difficult declarative language. Selectors are not trivial and rules overwrite each other without warning. Consider this example

<code><br/>
a, b >a * {color:red;}<br/>
b a {color:blue;}<br/>
</code>

What happens when an element &ldquo;a&rdquo; is encountered? Which color is it? If you think this never happens, consider that a Web page can call several CSS files (using, for example, the @import statement).

Until recently, I thought that the Firefox DOM Inspector (under the Tools menu) was merely a useful way to browse the DOM tree of a document. It took me a while to discover why people were so excited about it. As far as I know, Firefox is the only browser with this feature and it is a must.

One thing it can do is to allow you to explore and understand how your CSS rules get applied. To see how it works, select a node in the left pane (choose an element with non-trivial CSS properties, like table, td or p or span), then in the right pane you should see its name, its URI, its type&hellip; Click on the small icon at the upper left corner of the right pane. Go to CSS Style Rules. Then, always in the right pane, you should see the CSS rules that have fired for this node and in the order (recall the CSS rules can overwrite each others). If you click on the rule, you see its consequences in the lower right pane. Next, go to Computed Styles (click on the small icon at the upper left corner again)&hellip; and see all of the CSS properties your node has (after all rules have been applied). By the way, you can also, by the same process, know exactly where on the page the node is and what its geometry is (go to Box Model).

