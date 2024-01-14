---
date: "2004-10-25 12:00:00"
title: "Building the Open Warehouse"
---



Here&rsquo;s a link to slides from a talk by Roger Magoulas, (O&rsquo;Reilly Media, Inc.) about building the open warehouse. The talk was presented at [O&rsquo;Reilly Open Source Convention 2004](http://conferences.oreillynet.com/cs/os2004/view/e_sess/5493).

>Commodity hardware, faster disks, and open source software now make building a data warehouse more of a resource and design issue than a cost issue for many organizations. Now a robust analysis infrastructure can be built on an open source platform with no performance or functional compromises.

This talk will cover a proven analysis architecture, the open source tool options for each architecture component, the basics of dimensional modeling, and a few tricks of the trade.

Why open source? Aside from the cost savings, open source lets you leverage what your staff already knows &#8212; tools like Perl, SQL and Apache &#8212; rather than having to procure and staff for the proprietary tools that dominate the commercial space.

Data Warehouse Architecture: &#8211; Consolidated Data Store (CDS)<br/>
&#8211; Process to condition, correlate and transform data<br/>
&#8211; Multi-topic data marts<br/>
&#8211; dimensional models<br/>
&#8211; Multi-channel data access

Open Source Components<br/>
Database: MySQL<br/>
&#8211; fast, effective<br/>
Data Movement: Perl/DBI/SQL<br/>
&#8211; flexible data access<br/>
Data Access: Perl/Apache/SQL<br/>
&#8211; template toolkit for ad hoc SQL<br/>
&#8211; Perl hash for crosstabs/pivot<br/>
&#8211; Perl for reports

Dimensional Model<br/>
&#8211; organizes data for queries and navigation from detail to summary<br/>
&#8211; normalized fact table for quantitative data<br/>
&#8211; denormalized dimensions with descriptive data<br/>
&#8211; conforming dimensions available to multiple facts

Performance Considerations<br/>
&#8211; configuration<br/>
&#8211; indexing<br/>
&#8211; SQL-92 joins<br/>
&#8211; aggregate tables and aggregate navigation

The presentation should provide you with the basic architecture, toolkit, design principles, and strategy for building an effective open source data warehouse.



