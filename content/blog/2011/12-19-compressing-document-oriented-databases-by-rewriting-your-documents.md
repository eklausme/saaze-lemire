---
date: "2011-12-19 12:00:00"
title: "Compressing document-oriented databases by rewriting your documents"
---



The space utilization of relational databases can be estimated quickly. If you create a table made of three columns, each containing an integer, you can expect the database to use roughly 12 bytes per row, plus some overhead. Unless your database is tiny, how you name your columns is irrelevant to the space utilization.

Document-oriented databases such as [MongoDB](https://www.mongodb.org/) are not so simple. There is room for optimization. Using short names for attributes is better.
For example, in going from [JSON](http://www.json.org/) tuples of the form

<code>{date_achat:'1999-06-30',article:'Echasses',<br/>
quantite:1,prix:2800}</code>

to these tuples where one attribute has a longer name

<code>{date_achat:'1999-06-30',article<span style="color:red">fromoutstore</span>:'Echasses',<br/>
quantite:1,prix:2800}<br/>
</code>


you increase the space utilization per tuple by 12 bytes (from 105 to 117 bytes per tuple).

The converse is true. Using shorter names is better:

<code>{d:'1999-06-30',a:'Echasses',q:1,p:2800}<br/>
</code>

The space utilization per tuple goes down to 80 bytes (from 105 bytes). This is a saving of over 20%.

It is tempting to do away with the attribute names entirely and save the data as array:

<code>['1999-06-30','Echasses',1,2800]</code>

Yet the space utilization remains at 80 bytes because the binary format used by MongoDB ([BSON](http://bsonspec.org/)) does not store arrays concisely.

Should we worry about this issue? We live in an era of abundant storage and memory. MongoDB pre-allocates the storage to avoid disk fragmentation. Even the tiniest collection will use 128 MB, and larger collections are stored in 2 GB files: MongoDB is unafraid to waste nearly 2 GB or more. In fact, we might say that it is precisely because we live in such abundance that we can afford to use document-oriented databases. However, [engineers still face problems with space utilization](http://stackoverflow.com/questions/2966687/reducing-mongodb-database-file-size). Hence, it is useful to be aware of the effect that the names you choose will have, especially if you come from a relational database context where name length is irrelevant.

