---
date: "2022-07-24 12:00:00"
title: "Round a direction vector to an 8-way compass"
---



Modern game controllers can point in a wide range of directions. Game designers sometimes want to [convert the joystick direction to get 8-directional movement](https://forum.unity.com/threads/does-anyone-know-how-to-get-8-directional-movement-with-a-joystick.767129/). A typical solution offered is to compute the angle, round it up and then compute back the direction vector.
```C
  double angle = atan2(y, x);
  angle = (int(round(4 * angle / PI + 8)) % 8) * PI / 4;
  xout = cos(angle);
  yout = sin(angle);
```


If you assume that the unit direction vector is in the first quadrant (both x and y are positive), then there is a direct way to compute the solution. Using 1/sqrt(2) or 0.7071 as the default solution, compare both x and y with sin(3*pi/8), and only switch them to 1 if they are larger than sin(3*pi/8) or to 0 if the other coordinate is larger than sin(3*pi/8). The full code looks as follows:
```C
  double outx = 0.7071067811865475; // 1/sqrt(2)
  double outy = 0.7071067811865475;// 1/sqrt(2)
  if (x >= 0.923879532511286) { // sin(3*pi/8)
    outx = 1;
  }
  if (y >= 0.923879532511286) { // sin(3*pi/8)
    outy = 1;
  }
  if (y >= 0.923879532511286) { // sin(3*pi/8)
    outx = 0;
  }
  if (x >= 0.923879532511286) { // sin(3*pi/8)
    outy = 0;
  }
  if (xneg) {
    outx = -outx;
  }
```


I write tiny _if_ clauses because I hope that the compile will avoid producing comparisons and jumps which may stress the branch predictor when the branches are hard to predict.<br/>
You can generalize the solution for the case where either x or y (or both) are negative by first taking the absolute value, and then restoring the sign at the end:
```C
  bool xneg = x < 0;
  bool yneg = y < 0;
  if (xneg) {
    x = -x;
  }
  if (yneg) {
    y = -y;
  }
  double outx = 0.7071067811865475; // 1/sqrt(2)
  double outy = 0.7071067811865475;// 1/sqrt(2)
  if (x >= 0.923879532511286) { // sin(3*pi/8)
    outx = 1;
  }
  if (y >= 0.923879532511286) { // sin(3*pi/8)
    outy = 1;
  }
  if (y >= 0.923879532511286) { // sin(3*pi/8)
    outx = 0;
  }
  if (x >= 0.923879532511286) { // sin(3*pi/8)
    outy = 0;
  }
  if (xneg) {
    outx = -outx;
  }
  if (yneg) {
    outy = -outy;
  }
```


You can rewrite everything with the ternary operator to entice the compiler to produce branchless code (i.e., code without jumps). The result is more compact.
```C
  bool xneg = x < 0;
  x = xneg ? -x : x;
  bool yneg = y < 0;
  y = yneg ? -y : y;
  double outx = (x >= 0.923879532511286) ? 1 
    : 0.7071067811865475;
  double outy = (y >= 0.923879532511286) ? 1 
    : 0.7071067811865475;
  outx = (y >= 0.923879532511286) ? 0 : outx;
  outy = (x >= 0.923879532511286) ? 0 : outy;
  outx = xneg ? -outx : outx;
  outy = yneg ? -outy : outy;
```




The clang compiler may produce an entirely branchless assembly given this code.

But as pointed out by Samuel Lee in the comments, you can do even better&hellip; Instead of capturing the sign with a separate variable, you can just copy the pre-existing sign using a function like copysign (available in C, C#, Java and so forth):
```C
 double outx = fabs(x);
 double outy = fabs(y);
 outx = (outx >= 0.923879532511286) ? 1 
   : 0.7071067811865475;
 outy = (outy >= 0.923879532511286) ? 1 
   : 0.7071067811865475;
 outx = (posy >= 0.923879532511286) ? 0 : outx;
 outy = (posx >= 0.923879532511286) ? 0 : outy;
 outx = copysign(outx, x);
 outy = copysign(outy, y);```


[I wrote a small benchmark that operates on random inputs](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/07/24). Your results will vary but on my mac laptop with LLVM 12, I get that the direct approach with copysign is 50 times faster than the approach with tan/sin/cos.

with tangent             |40 ns/vector             |
-------------------------|-------------------------|
fast approach            |1.2 ns/vector            |
fast approach/copysign   |0.8 ns/vector            |


