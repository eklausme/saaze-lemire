---
date: "2007-10-24 12:00:00"
title: "Play the strongest checkers program in the world"
---



I just attended a talk by [Jonathan Schaeffer](https://en.wikipedia.org/wiki/Jonathan_Schaeffer) the guy behind [Chinook](https://webdocs.cs.ualberta.ca/~chinook/), the best checkers computer player in the world. You can [play a watered down version of Chinook on the Web](https://webdocs.cs.ualberta.ca/~chinook/play/).

The way they built this, is to enumerate all games with 10 pieces or less. Hence, if there are fewer than 10 pieces, Chinook knows whether he can win, get a draw, or lose since it has explored all possibilities. What they have recently shown is that, in any game, they can get to a 10 pieces configuration where Chinook cannot lose. In effect, Chinook is mathematically __unbeatable__. 

I am not an expert in this area, far from it, but it seems to me that one could design an even better computer program. There may be instances where Chinook gets a draw, whereas a win might have been possible. However, using this brute force approach, it seems like it will be several decades before we can improve substantially over Chinook. Again because it relies on brute force, it may not be possible to generalize this approach to more complex games (like Chess).

Jonathan is a great speaker and, no doubt, a great researcher. As a hacker, I appreciate Chinook: they had to use extremely clever designs. However, we have a Wizard-of-Oz effect here: once you see __how__ they have beaten the game, you realize it depends fundamentally on extreme brute force. They used 50 powerful computers running for years to solve the problem. Their files are so large, and copied so often, that they have to consider file copying to be a lossly operation! 

Chinook did not learn rules, it enumerated all possibilities! Many of my AI friends would rather see intelligence as the result of inference. Somehow, we learn rules that are applied in a logically fashion by our brain. Chinook is also not an instance of Machine Learning as it is commonly done: there is very little statistics involved, just brute force. Finally, Chinook did not try to think like a human being, whatever this could mean. 

