---
date: "2022-01-03 12:00:00"
title: "How programmers make sure that their software is correct"
---



Our most important goal in writing software is that it be correct. The software must do what the programmer wants it to do. It must meet the needs of the user.

In the business world, [double-entry bookkeeping](https://en.wikipedia.org/wiki/Double-entry_bookkeeping) is the idea that transactions are recorded in at least two accounts (debit and credit). One of the advantages of double-entry bookkeeping, compared to a more naive approach, is that it allows for some degree of auditing and error finding. If we compare accounting and software programming, we could say that double-entry accounting and its subsequent auditing is equivalent to software testing.

For an accountant, converting a naive accounting system into a double-entry system is a difficult task in general. In many cases, one would have to reconstruct it from scratch. In the same manner, it can be difficult to add tests to a large application that has been developed entirely without testing. And that is why testing should be first on your mind when building serious software.

A hurried or novice programmer can quickly write a routine, compile and run it and be satisfied with the result. A cautious or experienced programmer will know not to assume that the routine is correct.

Common software errors can cause problems ranging from a program that abruptly terminates to database corruption. The consequences can be costly: a software bug caused the explosion of an Ariane 5 rocket in 1996 ([Dowson, 1997](https://doi.org/10.1145/251880.251992)). The error was caused by the conversion of a floating point number to a signed integer represented with 16 bits. Only small integer values could be represented. Since the value could not be represented, an error was detected and the program stopped because such an error was unexpected. The irony is that the function that triggered the error was not required: it had simply been integrated as a subsystem from an earlier model of the Ariane rocket. In 1996 U.S. dollars, the estimated cost of this error is almost $400 million.

The importance of producing correct software has long been understood. The best scientists and engineers have been trying to do this for decades.

There are several common strategies. For example, if we need to do a complex scientific calculation, then we can ask several independent teams to produce an answer. If all the teams arrive at the same answer, we can then conclude that it is correct. Such redundancy is often used to prevent hardware-related faults ([Yeh, 1996](https://doi.org/10.1109/AERO.1996.495891)). Unfortunately, it is not practical to write multiple versions of your software in general.

Many of the early programmers had advanced mathematical training. They hoped that we could prove that a program is correct. By putting aside the hardware failures, we could then be certain that we would not encounter any errors. And indeed, today we have sophisticated software that allows us to sometimes prove that a program is correct.

Let us consider an example of formal verification to illustrate our point. We can use the z3 library from Python ([De Moura and Bjørner, 2008](https://doi.org/10.1007/978-3-540-78800-3_24)). If you are not a Python user, don&rsquo;t worry: you don&rsquo;t have to be to follow the example. We can install the necessary library with the command <code>pip install z3-solver</code> or the equivalent. Suppose we want to be sure that the inequality <code>( 1 + y ) / 2 &lt; y</code> holds for all 32-bit integers. We can use the following script:
```C
import z3
y = z3.BitVec("y", 32)
s = z3.Solver()
s.add( ( 1 + y ) / 2 >= y )
if(s.check() == z3.sat):
    model = s.model()
    print(model)
```


In this example we construct a 32-bit word (<em>BitVec</em>) to represent our example. By default, the z3 library interprets the values that can be represented by such a variable as ranging from -2147483648 to 2147483647 (from <span class="math">\(-2^{31}\)</span> to <span class="math">\(2^{31}-1\)</span> inclusive). We enter the inequality opposite to the one we wish to show (<code>( 1 + y ) / 2 &gt;= y</code>). If z3 does not find a counterexample, then we will know that the inequality <code>( 1 + y ) / 2 &lt; y</code> holds.

When running the script, Python displays the integer value 2863038463 which indicates that z3 has found a counterexample. The z3 library always gives a positive integer and it is up to us to interpret it correctly. The number 2147483648 becomes -2147483648, the number 2147483649 becomes -2147483647 and so on. This representation is often called [the two&rsquo;s complement](https://en.wikipedia.org/wiki/Two%27s_complement). Thus, the number 2863038463 is in fact interpreted as a negative number. Its exact value is not important: what matters is that our inequality (<code>( 1 + y ) / 2 &lt; y</code>) is incorrect when the variable is negative. We can check this by giving the variable the value -1, we then get <code>0 &lt; -1</code>. When the variable takes the value 0, the inequality is also false (<code>0&lt;0</code>). We can also check that the inequality is false when the variable takes the value 1. So let us add as a condition that the variable is greater than 1 (<code>s.add( y &gt; 1 )</code>):
```C
import z3
y = z3.BitVec("y", 32)
s = z3.Solver()
s.add( ( 1 + y ) / 2 >= y )
s.add( y > 1 )

if(s.check() == z3.sat):
    model = s.model()
    print(model)
```


Since the latter script does not display anything on the screen when it is executed, we can conclude that the inequality is satisfied as long as the variable of variable is greater than 1.

Since we have shown that the inequality <code>( 1 + y ) / 2 &lt; y</code> is true, perhaps the inequality <code>( 1 + y ) &lt; 2 * y</code> is true too? Let&rsquo;s try it:
```C
import z3
y = z3.BitVec("y", 32)
s = z3.Solver()
s.add( ( 1 + y ) >= 2 * y )
s.add( y > 1 )

if(s.check() == z3.sat):
    model = s.model()
    print(model)
```


This script will display 1412098654, half of 2824197308 which is interpreted by z3 as a negative value. To avoid this problem, let&rsquo;s add a new condition so that the double of the variable can still be interpreted as a positive value:
```C

import z3
y = z3.BitVec("y", 32)
s = z3.Solver()
s.add( ( 1 + y ) / 2 >= y )
s.add( y > 0 )
s.add( y < 2147483647/2)

if(s.check() == z3.sat):
model = s.model()
print(model)
```


This time the result is verified. As you can see, such a formal approach requires a lot of work, even in relatively simple cases. It may have been possible to be more optimistic in the early days of computer science, but by the 1970s, computer scientists like Dijkstra were expressing doubts:

> we see automatic program verifiers verifying toy programs and one observes the honest expectation that with faster machines with lots of concurrent processing, the life-size problems wiIl come within reach as well. But, honest as these expectations may be, are they justified? I sometimes wonder&hellip; ([Dijkstra, 1975](https://doi.org/10.1145/800027.808478))


It is impractical to apply such a mathematical method on a large scale. Errors can take many forms, and not all of these errors can be concisely presented in mathematical form. Even when it is possible, even when we can accurately represent the problem in a mathematical form, there is no reason to believe that a tool like z3 will always be able to find a solution: when problems become difficult, computational times can become very long. An empirical approach is more appropriate in general.

Over time, programmers have come to understand the need to test their software. It is not always necessary to test everything: a prototype or an example can often be provided without further validation. However, any software designed in a professional context and having to fulfill an important function should be at least partially tested. Testing allows us to reduce the probability that we will have to face a disastrous situation.

There are generally two main categories of tests.

- There are unit tests. These are designed to test a particular component of a software program. For example, a unit test can be performed on a single function. Most often, unit tests are automated: the programmer can execute them by pressing a button or typing a command. Unit tests often avoid the acquisition of valuable resources, such as creating large files on a disk or making network connections. Unit testing does not usually involve reconfiguring the operating system.
- Integration tests aim to validate a complete application. They often require access to networks and access to sometimes large amounts of data. Integration tests sometimes require manual intervention and specific knowledge of the application. Integration testing may involve reconfiguring the operating system and installing software. They can also be automated, at least in part. Most often, integration tests are based on unit tests that serve as a foundation.


Unit tests are often part of a continuous integration process ([Kaiser et al., 1989](https://doi.org/10.1109%2FCMPSAC.1989.65147)). Continuous integration often automatically performs specific tasks including unit testing, backups, applying cryptographic signatures, and so on. Continuous integration can be done at regular intervals, or whenever a change is made to the code.

Unit tests are used to structure and guide software development. Tests can be written before the code itself, in which case we speak of <em>test-driven development</em>. Often, tests are written after developing the functions. Tests can be written by programmers other than those who developed the functions. It is sometimes easier for independent developers to provide tests that are capable of uncovering errors because they do not share the same assumptions.

It is possible to integrate tests into functions or an application. For example, an application may run a few tests when it starts. In such a case, the tests will be part of the distributed code. However, it is more common not to publish unit tests. They are a component reserved for programmers and they do not affect the functioning of the application. In particular, they do not pose a security risk and they do not affect the performance of the application.

Experienced programmers often consider tests to be as important as the original code. It is therefore not uncommon to spend half of one&rsquo;s time on writing tests. The net effect is to substantially reduce the initial speed of writing computer code. Yet this apparent loss of time often saves time in the long run: setting up tests is an investment. Software that is not well tested is often more difficult to update. The presence of tests allows us to make changes or extensions with less uncertainty.

Tests should be readable, simple and they should run quickly. They often use little memory.

Unfortunately, it is difficult to define exactly how good tests are. There are several statistical measures. For example, we can count the lines of code that execute during tests. We then talk about test coverage. A coverage of 100% implies that all lines of code are concerned by the tests. In practice, this coverage measure can be a poor indication of test quality.

Consider [this example](https://play.golang.org/p/nwMUq2o_WlX):
```C
package main

import (
    "testing"
)


func Average(x, y uint16) uint16 {
   return (x + y)/2
}

func TestAverage(t *testing.T) {
    if Average(2,4) != 3 {
        t.Error(Average(2,4))
    }
}
```


In the Go language, we can run tests with the command <code>go test</code>. We have an <code>Average</code> function with a corresponding test. In our example, the test will run successfully. The coverage is 100%.

Unfortunately, the <code>Average</code> function may not be as correct as we would expect. If we pass the integers 40000 and 40000 as parameters, we would expect the average value of 40000 to be returned. But the integer 40000 added to the integer 40000 cannot be represented with a 16-bit integer (<code>uint16</code>): the result will be instead <code>(40000+4000)%65536=14464</code>. So the function will return 7232 which may be surprising. The following test will fail:
```C

func TestAverage(t *testing.T) {
if Average(40000,40000) != 40000 {
t.Error(Average(40000,40000))
}
}
```


When possible and fast, we can try to test the code more exhaustively, like [in this example](https://play.golang.org/p/nlq_J_-Tw8F) where we include several values:
```C
package main

import (
    "testing"
)


func Average(x, y uint16) uint16 {
   if y > x {
     return (y - x)/2 + x
   } else {
     return (x - y)/2 + y
   }
}

func TestAverage(t *testing.T) {
  for x := 0; x < 65536; x++ {
    for y := 0; y < 65536; y++ {
      m := int(Average(uint16(x),uint16(y)))
      if x < y {
        if m < x || m > y {
          t.Error("error ", x, " ", y)
        }
      } else {
        if m < y || m > x {
          t.Error("error ", x, " ", y)
        }
      }
    }
  }
}
```


In practice, it is rare that we can do exhaustive tests. We can instead use pseudo-random tests. For example, we can generate pseudo-random numbers and use them as parameters. In the case of random tests, it is important to keep them deterministic: each time the test runs, the same values are tested. This can be achieved by providing a fixed _seed_ to the random number generator as in [this example](https://play.golang.org/p/XGoxJoxfiEJ):
```C
package main

import (
    "testing"
        "math/rand"
)


func Average(x, y uint16) uint16 {
   if y > x {
     return (y - x)/2 + x
   } else {
     return (x - y)/2 + y
   }
}

func TestAverage(t *testing.T) {
  rand.Seed(1234)
  for test := 0; test < 1000; test++ {
    x := rand.Intn(65536)
    y := rand.Intn(65536)
    m := int(Average(uint16(x),uint16(y)))
    if x < y {
      if m < x || m > y {
        t.Error("error ", x, " ", y)
      }
    } else {
      if m < y || m > x {
        t.Error("error ", x, " ", y)
      }
    }
  }
}
```


Tests based on random exploration are part of a strategy often called _fuzzing_ ([Miller at al., 1990](https://doi.org/10.1145/96267.96279)).

We generally distinguish two types of tests. Positive tests aim at verifying that a function or component behaves in an agreed way. Thus, the first test of our <code>Average</code> function was a positive test. Negative tests verify that the software behaves correctly even in unexpected situations. We can produce negative tests by providing our functions with random data (<em>fuzzing</em>). Our second example can be considered a negative test if the programmer expected small integer values.

The tests should fail when the code is modified ([Budd et al., 1978](https://doi.org/10.1109/AFIPS.1978.195)). On this basis, we can also develop more sophisticated measures by testing for random changes in the code and ensuring that such changes often cause tests to fail.

Some programmers choose to generate tests automatically from the code. In such a case, a component is tested and the result is captured. For example, in our example of calculating the average, we could have captured the fact that <code>Average(40000,40000)</code> has the value 7232. If a subsequent change occurs that changes the result of the operation, the test will fail. Such an approach saves time since the tests are generated automatically. We can quickly and effortlessly achieve 100% code coverage. On the other hand, such tests can be misleading. In particular, it is possible to capture incorrect behaviour. Furthermore, the objective when writing tests is not so much their number as their quality. The presence of several tests that do not contribute to validate the essential functions of our software can even become harmful. Irrelevant tests can waste programmers&rsquo; time in subsequent revisions.

Finally, we review the benefits of testing: tests help us organize our work, they are a measure of quality, they help us document the code, they avoid regression, they help debugging and they can produce more efficient code.
<h4>Organization</h4>

Designing sophisticated software can take weeks or months of work. Most often, the work will be broken down into separate units. It can be difficult, until you have the final product, to judge the outcome. Writing tests as we develop the software helps to organize the work. For example, a given component can be considered complete when it is written and tested. Without the test writing process, it is more difficult to estimate the progress of a project since an untested component may still be far from being completed.
<h4>Quality</h4>

Tests are also used to show the care that the programmer has put into his work. They also make it possible to quickly evaluate the care taken with the various functions and components of a software program: the presence of carefully composed tests can be an indication that the corresponding code is reliable. The absence of tests for certain functions can serve as a warning.

Some programming languages are quite strict and have a compilation phase that validates the code. Other programming languages (Python, JavaScript) leave more freedom to the programmer. Some programmers consider that tests can help to overcome the limitations of less strict programming languages by imposing on the programmer a rigour that the language does not require.
<h4>Documentation</h4>

Software programming should generally be accompanied by clear and complete documentation. In practice, the documentation is often partial, imprecise, erroneous or even non-existent. Tests are therefore often the only technical specification available. Reading tests allows programmers to adjust their expectations of software components and functions. Unlike documentation, tests are usually up-to-date, if they are run regularly, and they are accurate to the extent that they are written in a programming language. Tests can therefore provide good examples of how the code is used.<br/>
Even if we want to write high-quality documentation, tests can also play an important role. To illustrate computer code, examples are often used. Each example can be turned into a test. So we can make sure that the examples included in the documentation are reliable. When the code changes, and the examples need to be modified, a procedure to test our examples will remind us to update our documentation. In this way, we avoid the frustrating experience of readers of our documentation finding examples that are no longer functional.
<h4>Regression</h4>

Programmers regularly fix flaws in their software. It often happens that the same problem occurs again. The same problem may come back for various reasons: sometimes the original problem has not been completely fixed. Sometimes another change elsewhere in the code causes the error to return. Sometimes the addition of a new feature or software optimization causes a bug to return, or a new bug to be added. When software acquires a new flaw, it is called a regression. To prevent such regressions, it is important to accompany every bug fix or new feature with a corresponding test. In this way, we can quickly become aware of regressions by running the tests. Ideally, the regression can be identified while the code is being modified, so we avoid regression. In order to convert a bug into a simple and effective test, it is useful to reduce it to its simplest form. For example, in our previous example with <code>Average(40000,40000)</code>, we can add the detected error in [additional test](https://play.golang.org/p/PH9y3ZqV2c9):
```C
package main

import (
    "testing
)


func Average(x, y uint16) uint16 {
   if y > x {
     return (y - x)/2 + x
   } else {
     return (x - y)/2 + y
   }
}

func TestAverage(t *testing.T) {
   if Average(2,4) != 3 {
     t.Error("error 1")
   }
   if Average(40000,40000) != 40000 {
     t.Error("error 2")
   }
}
```

<h4>Bug fixing</h4>

In practice, the presence of an extensive test suite makes it possible to identify and correct bugs more quickly. This is because testing reduces the extent of errors and provides the programmer with several guarantees. To some extent, the time spent writing tests saves time when errors are found while reducing the number of errors.<br/>
Furthermore, an effective strategy to identify and correct a bug involves writing new tests. It can be more efficient on the long run than other debugging strategies such as stepping through the code. Indeed, after your debugging session is completed, you are left with new unit tests in addition to a corrected bug.
<h4>Performance</h4>

The primary function of tests is to verify that functions and components produce the expected results. However, programmers are increasingly using tests to measure the performance of components. For example, the execution speed of a function, the size of the executable or the memory usage can be measured. It is then possible to detect a loss of performance following a modification of the code. You can compare the performance of your code against a reference code and check for differences using statistical tests.
<h3>Conclusion</h3>

All computer systems have flaws. Hardware can fail at any time. And even when the hardware is reliable, it is almost impossible for a programmer to predict all the conditions under which the software will be used. No matter who you are, and no matter how hard you work, your software will not be perfect. Nevertheless, you should at least try to write code that is generally correct: it most often meets the expectations of users.<br/>
It is possible to write correct code without writing tests. Nevertheless, the benefits of a test suite are tangible in difficult or large-scale projects. Many experienced programmers will refuse to use a software component that has been built without tests.<br/>
The habit of writing tests probably makes you a better programmer. Psychologically, you are more aware of your human limitations if you write tests. When you interact with other programmers and with users, you may be better able to take their feedback into account if you have a test suite.
<h3>Suggested reading</h3>

- James Whittaker, Jason Arbon, Jeff Carollo, How Google Tests Software, Addison-Wesley Professional; 1st edition (March 23 2012)
- Lisa Crispin, Janet Gregory, Agile Testing: A Practical Guide for Testers and Agile Teams, Addison-Wesley Professional; 1st edition (Dec 30 2008)

<h3>Credit</h3>

The following Twitter users contributed ideas: @AntoineGrodin, @dfaranha, @Chuckula1, @EddyEkofo, @interstar, @Danlark1, @blattnerma, @ThuggyPinch, @ecopatz, @rsms, @pdimov2, @edefazio, @punkeel, @metheoryt, @LoCtrl, @richardstartin, @metala, @franck_guillaud, @__Achille__, @a_n__o_n, @atorstling, @tapoueh, @JFSmigielski, @DinisCruz, @jsonvmiller, @nickblack, @ChrisNahr, @ennveearr1, @_vkaku, @kasparthommen, @mathjock, @feO2x, @pshufb, @KishoreBytes, @kspinka, @klinovp, @jukujala, @JaumeTeixi

