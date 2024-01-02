---
date: "2008-01-30 12:00:00"
title: "Chaining CAPTCHAs for fun and profit?"
---



A CAPTCHA is a type of challenge-response test used in computing to determine whether a user is human. Yahoo! is having major difficulties with its CAPTCHAs. Russian hackers are able to [pass their Turing tests with 35% accuracy](http://it.slashdot.org/story/08/01/30/0037254/yahoo-captcha-hacked). Some human beings say that their accuracy is 80% on these same tests.

This accuracy is not an historical breakthrough since [academics got almost perfect scores on earlier Yahoo! CAPTCHAs](http://ieeexplore.ieee.org:80/Xplore/errorpage.jsp?reload=true). Nevertheless, 35% appears to be good enough to make the CAPTCHA nearly useless. 

I have a neat way to decrease the accuracy for the robots while maintaining the human accuracy &mdash; at the cost of more work for the human being. Basically, you &ldquo;chain&rdquo; the CAPTCHAs by asking the human being to get at least k good answers out of N queries.

Say you have an p=80% probability of entering the right answer as a human being. What is the probability that you will get at least 3 out of 4 right? My answer is F(p) = 4 p<sup>3</sup>(1-p)+p<sup>4</sup>. That is, the human being still has an 80% probability of passing the test, while the robot chances went from 35% down to 13%.

I have been unable to find any reference to CAPTCHA chaining. The closest reference I found is this paper:

Ran Canetti, Shai Halevi, Michael Steiner, [Hardness Amplification of Weakly Verifiable Puzzles](http://link.springer.com/chapter/10.1007%2F978-3-540-30576-7_2), Lecture Notes in Computer Science, 2005.

If anyone knows how to spin this into an interesting research paper, please get in touch.

I predict that telling human beings apart from evil machines is going to become an emerging and very important research area. The war against artificial intelligences has already started. No. I am not kidding: evil people are building networks of evil software as we speak.

