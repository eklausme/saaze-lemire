---
date: "2023-03-22 12:00:00"
title: "Can GPT pass my programming courses?"
---



<em>Professeur</em> Caplan [reports](https://betonit.substack.com/p/gpt-retakes-my-midterm-and-gets-an) that [ChatGPT](https://chat.openai.com), the new artificial intelligence that is all the rage, can pass his economics midterm and get an A.

What about computer science ? I submitted to GPT one problem I offer my students&hellip;

> Write a Java program that calculates the sum of numbers from 1 to 10,000 (including 1 and 10,000) but omitting numbers that are divisible by three and also omitting numbers whose hundredth digit is 2 or 3 (e.g. 1201 or 3313).


Bing/GPT solves the problem with ease:
```C
public class SumOfNumbers {
  public static void main(String[] args) {
    int sum = 0;
    for (int i = 1; i <= 10000; i++) {
      if (i % 3 != 0 && (i / 100) % 10 != 2 && (i / 100) % 10 != 3) {
        sum += i;
      }
    }
    System.out.println("The sum of numbers from 1 to 10,000 (including 1 and 10,000) but omitting numbers that are divisible by three and also omitting numbers whose hundredth digit is 2 or 3 is: " + sum);
  }
}

```


Maybe it somehow knew just this particular answer. What if I tweak the question a bit?

> Write a Java program that calculates the sum of numbers from 1 to 10,000 (including 1 and 10,000) but omitting numbers where the hundredth digit is divisible by 3.


Bing/GPT gets it almost correct:
```C
public class SumOfNumbers {
  public static void main(String[] args) {
    int sum = 0;
    for (int i = 1; i <= 10000; i++) {
      if ((i / 100) % 3 != 0) {
        sum += i;
      }
    }
    System.out.println("The sum of numbers from 1 to 10,000 (including 1 and 10,000) but omitting numbers where the hundredth digit is divisible by 3 is: " + sum);
  }
}

```


What about other questions I often ask&hellip; such as&hellip;

> Write a Java function which can invert the elements in an array of integers.


Bing/GPT gets it right, complete with a detailed explanation&hellip;
```C
public static void invertArray(int[] arr) {
  int n = arr.length;
  for (int i = 0; i < n / 2; i++) {
    int temp = arr[i];
    arr[i] = arr[n - i - 1];
    arr[n - i - 1] = temp;
  }
}

```


What about database work? Here is a basic question I ask&hellip;

> What can you say about the attributes A and B if A→B and B→A?


Bing/GPT tells me that&hellip;

<em>If A→B and B→A, then A and B are said to be functionally dependent on each other. This means that the value of A uniquely determines the value of B, and vice versa. In other words, if you know the value of A, you can determine the value of B, and if you know the value of B, you can determine the value of A</em>

This is correct.

What about a more technical database question ?

> Give me a SQL query which counts the number of rows where attribute A is equal to attribute B?



Bing/GPT answers&hellip;
```C
SELECT COUNT(*) FROM table_name WHERE A = B

```


Unfortunately, it extends to the exams themselves. Bing/GPT gets much of it right. In the current &ldquo;introduction to programming&rdquo; exam, there was only one question the GPT got obviously wrong, but I would have attributed some points &lsquo;for effort&rsquo;.

Bing/GPT can pass my introductory computer science courses.

I further asked it to solve a problem using the C++ simdjson library. We are definitively well beyond introductory courses. GPT did well enough as the answer is almost correct:

<em><a href="https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-22-a-19.55.38.png"><img fetchpriority="high" decoding="async" class="alignnone size-medium wp-image-20326" src="https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-22-a-19.55.38.png" alt width="600" height="300" /></a></em>

Then I asked that it produces its own SIMD routine in C++ to count the number of characters equal to &lsquo;.&rsquo; and it did so&hellip; It is almost correct&hellip;

<em><a href="https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-22-a-20.15.52.png"><img decoding="async" class="alignnone size-medium wp-image-20329" src="https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-22-a-20.15.52.png" alt width="600" height="300" /></a></em>

Bing GPT can solve mathematical problems, in French.<a href="https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-27-a-15.24.00.png"><img decoding="async" class="alignnone size-medium wp-image-20339" src="https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-27-a-15.24.00.png" alt width="600" height="240" srcset="https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-27-a-15.24.00.png 2624w, https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-27-a-15.24.00-300x120.png 300w, https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-27-a-15.24.00-1024x410.png 1024w, https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-27-a-15.24.00-768x307.png 768w, https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-27-a-15.24.00-1536x615.png 1536w, https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-27-a-15.24.00-2048x820.png 2048w" sizes="(max-width: 600px) 100vw, 600px" /></a>

