---
date: "2006-09-15 12:00:00"
title: "Operators and, or and xor written in English: is this standard C++?"
---



Kamel was reviewing some code I wrote and through a question he asked, I realized that some code I wrote would not compile under Visual C++. Further investigations showed that the following is valid under GCC, but not under Visual C++:

<code><br/>
#include <iostream><br/>
using std::cout;<br/>
using std::endl;<br/>
int main(int argv, char ** args)<br/>
{<br/>
int a = 7;<br/>
int b = 3;<br/>
cout &lt;&lt; (a and b) &lt;&lt; endl;<br/>
cout &lt;&lt; (a or b) &lt;&lt; endl;<br/>
cout &lt;&lt; (a xor b) &lt;&lt; endl;<br/>
return 0<br/>
}<br/>
</iostream></code>

Can anyone help us out? Is this correct code?

__Update__: It looks like you can get this result under Visual C++ by including &ldquo;iso646.h&rdquo;. It includes the following definitions:<br/>
<code><br/>
#define and &&<br/>
#define and_eq &=<br/>
#define bitand &<br/>
#define bitor |<br/>
#define compl ~<br/>
#define not !<br/>
#define not_eq !=<br/>
#define or ||<br/>
#define or_eq |=<br/>
#define xor ^<br/>
#define xor_eq ^=<br/>
</code>

