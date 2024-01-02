---
date: "2007-07-27 12:00:00"
title: "Scalable Web Development"
---



Here is a list of slides of various major Web projects where scalability had to be addressed. I am starting to think about a course project where this would be addressed specifically. Since I am not into software engineering, Web programming is nothing but a technical task for me, but if you throw in high scalability, the topic becomes very interesting and very database-related. In English, the course title is a given (<em>Scalable Web Development</em>), but I am unsure how to call it in French. I do not know exactly how to render the word _scalable_ in French: vague terms are typically difficult to translate. Maybe a title like <em>Programmation web et mise Ã  l&rsquo;échelle</em>. It is a bit long, but it is the best I can do.

Scalability means three things, at least. First, you have to the number of hits that your server takes every second. That&rsquo;s IO and CPU scalability. Then you have user-scalability (going from 3 users to 3,000,000) and everything it implies (abuse and spam). Finally, you have design scalability: how fast can you come up with the application, and how fast can you update it as things are crashing and burning.

Topics covered would include:

- Memcache
- Ruby on Rails
- Python
- PHP
- MySQL
- Custom data structures (flat files)
- Partitions
- ECMAScript and AJAX


Am I missing anything? Yes, Java is absent. 

Students would conclude the course with a project that would have to be design to take a lot of abuse, or at least, design in such a way that if it did get abused, people could come in and fix it easily. For example, students would have to explain how they would partition it and so on. Maybe they&rsquo;d have to run tests on how it scales (but that&rsquo;s not entirely satisfying). I&rsquo;d certainly allow students to come up with sites that they can turn into a business.

It would probably be a course from hell. But then, I am convinced that challenging courses is not what kills students. Boredom and couldn&rsquo;t-care-less instructors do.

__Update__. Maybe facebook applications and map reduce should be included.

