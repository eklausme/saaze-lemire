---
date: "2004-09-26 12:00:00"
title: "An Amazon Web Services (AWS) 4.0 application in just a few lines"
---



I have somewhat of a debate with my friend Yuhong about the correct way to use a Web Service. Yuhong seems to prefer SOAP. I much prefer REST. What is a REST Web Service? For the most part, a REST Web Service is really, really simple. You simply follow a URL and magically, you get back an XML file which is the answer to your query. One benefit of REST is that you can easily debug it and write quick scripts for it. What is a SOAP Web Service? I don&rsquo;t know. I really don&rsquo;t get it. It seems to be a very complicated way to do the same thing: instead of sending the query as a URL, you send the query as a XML file. The bad thing about it is that if it breaks, then you have no immediate way to debug it: you can&rsquo;t issue a SOAP request using your browser (or maybe you can, but I just don&rsquo;t know how). 

Now, things never break, do they? Well, that is the problem, they break often because either I&rsquo;m being stupid or I don&rsquo;t know what I&rsquo;m doing or the people on the other side don&rsquo;t know what they are doing or the people on the other side are experimenting a bit or whatever else. I find that being able to quickly debug my code is the primary feature any IT technology should have. The last thing I want from a technology is for it to be hard to debug.

Here is the problem that I solved this week-end. I have this list of artists and I want to get a list of all corresponding music albums so I can put it all into a relational (SQL) database. Assuming that your list of artists are in a file called artists_big.txt and that you want the result to be in a file called amazonresults.sql, the following does a nice job thanks to the magic of Amazon Web Services:

__Yes: the code goes over because I cannot allow HTML to wrap lines (Python allows wrapping lines, but not arbitrarily so, white space is significant in Python). There is just no way around it that I know: suggestions with sample HTML code are invited.__

<code>import libxml2, urllib2, urllib, sys, re, traceback<br/>
ID=""# please enter your own ID here<br/>
uri="http://webservices.amazon.com/AWSECommerceService/2004-10-19"<br/>
url="http://webservices.amazon.com/onca/xml?Service=AWSECommerceService&SubscriptionId=%s&Operation=ItemSearch&SearchIndex=Music&Artist=%s&ItemPage=%i&ResponseGroup=Request,ItemIds,SalesRank,ItemAttributes,Reviews"<br/>
outputcontent = ["ASIN","Artist","Title","Amount","NumberOfTracks","SalesRank","AverageRating","ReleaseDate"]<br/>
input = open("artists_big.txt")<br/>
output = open("amazonresults.sql", "w")<br/>
log = open("amazonlog.txt", "w")<br/>
output.write("DROP TABLE music;nCREATE TABLE music (ASIN TEXT, Artist TEXT, Title TEXT, Amount INT, NumberOfTracks INT, SalesRank INT, AverageRating NUMERIC, ReleaseDate DATE);n")<br/>
def getNodeContentByName(node, name):<br/>
for i in node:<br/>
if (i.name==name): return i.content<br/>
return None<br/>
for artist in input:#go through all artists<br/>
print "Recovering albums for artist : ", artist<br/>
page = 1<br/>
while(True):# recover all pages<br/>
resturl = url %(ID,urllib.quote(artist),page)<br/>
log.write("Issuing REST request: "+resturl+"n")<br/>
try :<br/>
data = urllib2.urlopen(resturl).read()<br/>
except urllib2.HTTPError,e:<br/>
log.write("n")<br/>
log.write(str(traceback.format_exception(*sys.exc_info())))<br/>
log.write("n")<br/>
log.write("could not retrieve :n"+resturl+"n")<br/>
continue<br/>
try :<br/>
doc = libxml2.parseDoc(data)<br/>
except libxml2.parserError,e:<br/>
log.write("n")<br/>
log.write(str(traceback.format_exception(*sys.exc_info())))<br/>
log.write("n")<br/>
log.write("could not parse (is valid XML?):n"+data+"n")<br/>
continue<br/>
ctxt=doc.xpathNewContext()<br/>
ctxt.xpathRegisterNs("aws",uri)<br/>
isvalid = (ctxt.xpathEval("//aws:Items/aws:Request/aws:IsValid")[0].content == "True")<br/>
if not isvalid :<br/>
log.write("The query %s failed " % (resturl))<br/>
errors = ctxt.xpathEval("//aws:Error/aws:Message")<br/>
for message in errors: log.write(message.content+"n")<br/>
continue<br/>
for itemnode in ctxt.xpathEval("//aws:Items/aws:Item"):<br/>
attr = {}<br/>
for nodename in outputcontent:<br/>
content = getNodeContentByName(itemnode,nodename)<br/>
if(content <> None):<br/>
content = re.sub("'","'",content)<br/>
if(nodename == "SalesRank"):<br/>
content = re.sub(",","",content)<br/>
attr[nodename] = content<br/>
columns = "("<br/>
keys = attr.keys()<br/>
for i in range(len(keys)-1):<br/>
columns += keys[i]+","<br/>
columns+=keys[len(keys)-1]+")"<br/>
row = "("<br/>
values = attr.values()<br/>
for i in range(len(values)-1):<br/>
row+="'"+str(values[i])+"',"<br/>
row+="'"+str(values[len(values)-1])+"')"<br/>
command = "INSERT INTO music "+columns+" VALUES "+row+";n"<br/>
output.write(command)<br/>
NumberOfPages = int(ctxt.xpathEval("//aws:Items/aws:TotalPages")[0].content)<br/>
if(page >= NumberOfPages): break<br/>
page += 1<br/>
input.close()<br/>
output.close()<br/>
log.close()<br/>
print "You should now be able to run the file in postgresql. Start the postgres client doing psql, and using i amazonresults.sql in the postgresql shell."<br/>
</code>

Update : this was updated to take into account these comments from Amazon following the upgrade of AWS 4.0 from beta to release:

> Service Name change: You will need to modify the Service Name parameter in your application from AWSProductData to AWSECommerceService. We realize that it may take some time to implement this change in your applications. In order to make this transition as easy as possible, we will continue supporting AWSProductData for a short time.

2) REST/WSDL Endpoints: You will need to modify your application to connect to webservices.amazon.com instead of aws-beta.amazon.com. For other locales, the new endpoints are webservices.amazon.co.uk, webservices.amazon.de and webservices.amazon.co.jp.



