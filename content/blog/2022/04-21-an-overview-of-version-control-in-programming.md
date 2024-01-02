---
date: "2022-04-21 12:00:00"
title: "An overview of version control in programming"
---



In practice, computer code is constantly being transformed. At the beginning of a project, the computer code often takes the form of sketches that are gradually refined. Later, the code can be optimized or corrected, sometimes for many years.

Soon enough, programmers realized that they needed to not only to store files, but also to keep track of the different versions of a given file. It is no accident that we are all familiar with the fact that software is often associated with versions. It is necessary to distinguish the different versions of the computer code in order to keep track of updates.

We might think that after developing a new version of a software, the previous versions could be discarded. However, it is practical to keep a copy of each version of the computer code for several reasons:

1. A change in the code that we thought was appropriate may cause problems: we need to be able to go back quickly.
1. Sometimes different versions of the computer code are used at the same time and it is not possible for all users to switch to the latest version. If an error is found in a previous version of the computer code, it may be necessary for the programmer to go back and correct the error in an earlier version of the computer code without changing the current code. In this scenario, the evolution of the software is not strictly linear. It is therefore possible to release version 1.0, followed by version 2.0, and then release version 1.1.
1. It is sometimes useful to be able to go back in time to study the evolution of the code in order to understand the motivation behind a section of code. For example, a section of code may have been added without much comment to quickly fix a new bug. The attentive programmer will be able to better understand the code by going back and reading the changes in context.
1. Computer code is often modified by different programmers working at the same time. In such a social context, it is often useful to be able to quickly determine who made what change and when. For example, if a problem is caused by a segment of code, we may want to question the programmer who last worked on that segment.


Programmers quickly realized that they needed version control systems. The basic functions that a version control system provides are rollback and a history of changes made. Over time, the concept version control has spread. There are even several variants intended for the general public such as DropBox where various files, not only computer code, are stored.

The history of software version control tools dates back to the 1970s ([Rochkind, 1975](https://doi.org/10.1109/TSE.1975.6312866)). In 1972, Rochkind developed the SCCS (Source Code Control System) at Bell Laboratories. This system made it possible to create, update and track changes in a software project. SCCS remained a reference from the end of the 1970s until the 1980s. One of the constraints of SCCS is that it does not allow collaborative work: only one person can modify a given file at a given time.

In the early 1980s, Tichy proposed the RCS (Revision Control System), which innovated with respect to SCCS by storing only the differences between the different versions of a file in backward order, starting from the latest file. In contrast, SCCS stored differences in forward order starting from the first version. For typical use where we access the latest version, RCS is faster.

In programming, we typically store computer code within text files. Text files most often use ASCII or Unicode (UTF-8 or UTF-16) encoding. Lines are separated by a sequence of special characters that identify the end of a line and the beginning of a new line. Two characters are often used for this purpose: &ldquo;carriage return&rdquo; (CR) and &ldquo;line feed&rdquo; (LF). In ASCII and UTF-8, these characters are represented with the byte having the value 13 and the byte having the value 10 respectively. In Windows, the sequence is composed of the CR character followed by the LF character, whereas in Linux and macOS, only the LF character is used. In most programming languages, we can represent these two characters with the escape sequences \r and \n respectively. So the string &ldquo;a\nb\nc&rdquo; has three lines in most programming languages under Linux or macOS: the lines &ldquo;a&rdquo;, &ldquo;b&rdquo; and &ldquo;c&rdquo;.

When a text file is edited by a programmer, usually only a small fraction of all lines are changed. Some lines may also be inserted or deleted. It is convenient to describe the differences as succinctly as possible by identifying the new lines, the deleted lines and the modified lines.

The calculation of differences between two text files is often done first by breaking the text files into lines. We then treat a text file as a list of lines. Given two versions of the same file, we want to associate as many lines in the first version as possible with an identical line in the second version. We also assume that the order of the lines is not reversed.

We can formalize this problem by looking for the longest common subsequence. Given a list, a subsequence simply takes a part of the list, excluding some elements. For example, (a,b,d) is a subsequence of the list (a,b,c,d,e). Given two lists, we can find a common subsequence, e.g. (a,b,d) is a subsequence of the list (a,b,c,d,e) and the list (z,a,b,d). The longest common subsequence between two lists of text lines represents the list of lines that have not been changed between the two versions of a text file. It might be difficult to solve this program using brute force. Fortunately, we can compute the longest common subsequence by dynamic programming. Indeed, we can make the following observations.

1. If we have two strings with a longest subsequence of length k, and we add at the end of each of the two strings the same character, the new strings will have a longer subsequence of length k+1.
1. If we have two strings of lengths m and n, ending in distinct characters (for example, &ldquo;abc&rdquo; and &ldquo;abd&rdquo;), then the longest subsequence of the two strings is the longest subsequence of the two strings after removing the last character from one of the two strings. In other words, to determine the length of the longest subsequence between two strings, we can take the maximum of the length of the subsequence after amputating one character from the first string while keeping the second unchanged, and the length of the subsequence after amputating one character from the second string while keeping the first unchanged.<br/>
These two observations are sufficient to allow an efficient calculation of the length of the longest common subsequence. It is sufficient to start with strings comprising only the first character and to add progressively the following characters. In this way, one can calculate all the longest common subsequences between the truncated strings. It is then possible to reverse this process to build the longest subsequence starting from the end. If two strings end with the same character, we know that the last character will be part of the longest subsequence. Otherwise, one of the two strings is cut off from its last character, making our choice in such a way as to maximize the length of the longest common subsequence.


The following function illustrates a possible solution to this problem. Given two arrays of strings, the function returns the longest common subsequence. If the first string has length <code>m</code> and the second <code>n</code>, then the algorithm runs in <code>O(m*n)</code> time.
```C
func longest_subsequence(file1, file2 []string) []string {
	m, n := len(file1), len(file2)
	P := make([]uint, (m+1)*(n+1))
	for i := 1; i <= m; i++ {
		for j := 1; j <= n; j++ {
			if file1[i-1] == file2[j-1] {
				P[i*(n+1)+j] = 1 + P[(i-1)*(n+1)+(j-1)]
			} else {
				P[i*(n+1)+j] = max(P[i*(n+1)+(j-1)], P[(i-1)*(n+1)+j])
			}
		}
	}
	longest := P[m*(n+1)+n]
	i, j := m, n
	subsequence := make([]string, longest)
	for k := longest; k > 0; {
		if P[i*(n+1)+j] == P[i*(n+1)+(j-1)] {
			j-- // the two strings end with the same char
		} else if P[i*(n+1)+j] == P[(i-1)*(n+1)+j] {
			i--
		} else if P[i*(n+1)+j] == 1+P[(i-1)*(n+1)+(j-1)] {
			subsequence[k-1] = file1[i-1]
			k--; i--; j--
		}
	}
	return subsequence
}
```


Once the subsequence has been calculated, we can quickly calculate a description of the difference between the two text files. Simply move forward in each of the text files, line by line, stopping as soon as you reach a position corresponding to an element of the longest sub-sequence. The lines that do not correspond to the subsequence in the first file are considered as having been deleted, while the lines that do not correspond to the subsequence in the second file are considered as having been added. The following function illustrates a possible solution.
```C
func difference(file1, file2 []string) []string {
    subsequence := longest_subsequence(file1, file2)
    i, j, k := 0, 0, 0
    answer := make([]string, 0)
    for i &lt; len(file1) &amp;&amp; k &lt; len(file2) {
        if file2[k] == subsequence[j] &amp;&amp; file1[i] == subsequence[j] {
            answer = append(answer, "'"+file2[k]+"'\n")
            i++; j++; k++
        } else {
            if file1[i] != subsequence[j] {
                answer = append(answer, "deleted: '"+file1[i]+"'\n")
                i++
            }
            if file2[k] != subsequence[j] {
                answer = append(answer, "added: '"+file2[k]+"'\n")
                k++
            }
        }
    }
    for ; i &lt; len(file1); i++ {
        answer = append(answer, "deleted: '"+file1[i]+"'\n")
    }
    for ; k &lt; len(file2); k++ {
        answer = append(answer, "added: '"+file2[k]+" \n")
    }
    return answer
}
```


<br/>
The function we propose as an illustration for computing the longest subsequence uses <code>O(m*n)</code> memory elements. It is possible to reduce the memory usage of this function and simplify it ([Hirschberg, 1975](https://doi.org/10.1145/360825.360861)). Several other improvements are possible in practice ([Miller and Myers, 1985](https://doi.org/10.1002/spe.4380151102)). We can then represent the changes between the two files in a concise way.

Suggested reading: [article Diff (wikipedia)](https://en.wikipedia.org/wiki/Diff)

Like SCCS, RCS does not allow multiple programmers to work on the same file at the same time. The need to own a file to the exclusion of all other programmers while working on it may have seemed a reasonable constraint at the time, but it can make the work of a team of programmers much more cumbersome.

In 1986 Grune developed the Concurrent Versions System (CVS). Unlike previous systems, CVS allows multiple programmers to work on the same file simultaneously. It also adopts a client-server model that allows a single directory to be present on a network, accessible by multiple programmers simultaneously. The programmer can work on a file locally, but as long as he has not transmitted his version to the server, it remains invisible to the other developers.

The remote server also serves as a de facto backup for the programmers. Even if all the programmers&rsquo; computers are destroyed, it is possible to start over with the code on the remote server.

In a version control system, there is usually always a single latest version. All programmers make changes to this latest version. However, such a linear approach has its limits. An important innovation that CVS has updated is the concept of a branch. A branch allows to organize sets of versions that can evolve in parallel. In this model, the same file is virtually duplicated. There are then two versions of the file (or more than two) capable of evolving in parallel. By convention, there is usually one main branch that is used by default, accompanied by several secondary branches. Programmers can create new branches whenever they want. Branches can then be merged: if a branch A is divided into two branches (A and B) which are modified, it is then possible to bring all the modifications into a single branch (merging A and B). The branch concept is useful in several contexts:

1. Some software development is speculative. For example, a programmer may explore a new approach without being sure that it is viable. In such a case, it may be better to work in a separate branch and merge with the main branch only if successful.
1. The main branch may be restricted to certain programmers for security reasons. In such a case, programmers with reduced access may be restricted to separate branches. A programmer with privileged access may then merge the secondary branch after a code inspection.
1. A branch can be used to explore a particular bug and its fix.
1. A branch can be used to update a previous version of the code. Such a version may be kept up to date because some users depend on that earlier version and want to receive certain fixes. In such a case, the secondary branch may never be integrated with the main branch.


One of the drawbacks of CVS is poor performance when projects include multiple files and multiple versions. In 2000, Subversion (SVN) was proposed as an alternative to CVS that meets the same needs, but with better performance.

CVS and Subversion benefit from a client-server approach, which allows multiple programmers to work simultaneously with the same version directory. Yet programmers often want to be able to use several separate remote directories.

To meet these needs, various &ldquo;distributed version control systems&rdquo; (DVCS) have been developed. The most popular one is probably the Git system developed by Torvalds (2005). Torvalds was trying to solve a problem of managing Linux source code. Git became the dominant version management tool. It has been adopted by Google, Microsoft, etc. It is free software.

In a distributed model, a programmer who has a local copy of the code can synchronize it with either one directory or another. They can easily create a new copy of the remote directory on a new server. Such flexibility is considered essential in many complex projects such as the Linux operating system kernel.

Several companies offer Git-based services including GitHub. Founded in 2008, GitHub has tens of millions of users. In 2018, Microsoft acquired GitHub for $7.5 billion.

For CVS and Subversion, there is only one set of software versions. With a distributed approach, multiple sets can coexist on separate servers. The net result is that a software project can evolve differently, under the responsibility of different teams, with possible future reconciliation.

In this sense, Git is distributed. Although many users rely on GitHub (for example), your local copy can be attached to any remote directory, and it can even be attached to multiple remote directories. The verb &ldquo;clone&rdquo; is sometimes used to describe the recovery of a Git project locally, since it is a complete copy of all files, changes, and branches.

If a copy of the project is attached to another remote directory, it is called a fork. We often distinguish between branches and forks. A branch always belongs to the main project. A fork is originally a complete copy of the project, including all branches. It is possible for a fork to rejoin the main project, but it is not essential.

Given a publicly available Git directory, anyone can clone it and start working on it and contributing to it. We can create a new fork. From a fork, we can submit a pull request that invites people to integrate our changes. This allows a form of permissionless innovation. Indeed, it becomes possible to retrieve the code, modify it and propose a new version without ever having to interact directly with the authors.

Systems like CVS and subversion could become inefficient and take several minutes to perform certain operations. Git, in contrast, is generally efficient and fast, even for huge projects. Git is robust and does not get &ldquo;corrupted&rdquo; easily. However, it is not recommended to use Git for huge files such as multimedia content: Git&rsquo;s strength lies in text files. It should be noted that the implementation of Git has improved over time and includes sophisticated indexing techniques.

Git is often used on the command line. It is possible to use graphical clients. Services like GitHub make Git a little easier.

The basic logical unit of Git is the <code>commit</code>, which is a set of changes to multiple files. A <code>commit</code> includes a reference to at least one parent, except for the first <code>commit</code> which has no parent. A single <code>commit</code> can be the parent of several children: several branches can be created from a <code>commit</code> and each subsequent <code>commit</code> becomes a <code>child</code> of the initial <code>commit</code>. Furthermore, when several branches are merged, the resulting <code>commit</code> will have several parents. In this sense, the <code>commits</code> form an &ldquo;acyclic directed graph&rdquo;.

With Git, we want to be able to refer to a <code>commit</code> in an easy way, using a unique identifier. That is, we want to have a short numeric value that corresponds to one <code>commit</code> and one <code>commit</code> only. We could assign each <code>commit</code> a version number (1.0, 2.0, etc.). Unfortunately, such an approach is difficult to reconcile with the fact that <code>commits</code> do not form a linear chain where a <code>commit</code> has one and only one parent. As an alternative, we use a hash function to compute the unique identifier. A hash function takes elements as parameters and calculates a numerical value (hash value). There are several simple hash functions. For example, we can iterate over the bytes contained in a message from a starting value <code>h</code>, by computing <code>h = 31 * h + b</code> where <code>b</code> is the byte value. For example, a message containing bytes 3 and 4 might have a hash value of <code>31 * (31 * 3) + 4</code> if we start <code>h = 0</code>. Such a simple approach is effective in some cases, but it allows malicious users to create collisions: it would be possible to create a fake <code>commit</code> that has the same hash value and thus create security holes. For this reason, Git uses more sophisticated hashing techniques (SHA-1, SHA-256) developed by cryptographic specialists. Commits are identified using a hash value (for example, the hexadecimal numeric value 921103db8259eb9de72f42db8b939895f5651489) which is calculated from the date and time, the comment left by the programmer, the user&rsquo;s name, the parents and the nature of the change. In theory, two <code>commits</code> could have the same hash value, but this is an unlikely event given the hash functions used by Git. It&rsquo;s not always practical to reference a hexadecimal code. To make things easier, Git allows you to identify a commit with a label (e.g., v1.0.0). The following command will do: <code>git tag -a v1.0.0 -m "version 1.0.0"</code>.

Though tags can be any string, tags often contain sequences of numbers indicating a version. There is no general agreement among programmers on how  to attribute version numbers to a version. However, tags sometimes take the form of three numbers separated by dots: MAJOR.MINOR.PATCH (for example, 1.2.3). With each new version, 1 is added to at least one of the three numbers. The first number often starts at 1 while the next two start at 0.

- The first number (MAJOR) must be increased when you make major changes to the code. The other two numbers (MINOR and PATCH) are often reset to zero. For example, you can go from version 1.2.3 to version 2.0.0.
- The second number (MINOR) is increased for minor changes (for example, adding a function). When increasing the second number, the first number (MAJOR) is usually kept unchanged and the last number (PATCH) is reset to zero.
- The last number (PATCH) is increased when fixing bugs. The other two numbers are not increased.<br/>
There are finer versions of this convention like &ldquo;[semantic versioning](https://semver.org)&ldquo;.


With Git, the programmer can have a local copy of the commit graph. They can add new <code>commits</code>. In a subsequent step, the programmer must &ldquo;push&rdquo; his changes to a remote directory so that the changes become visible to other programmers. The other programmers can fetch the changes using a `pull&rsquo;.

Git has advanced collaborative features. For example, the <code>git blame</code> command lets you know who last modified a given piece of code.
<h2>Conclusion</h2>

Version control in computing is a sophisticated approach that has benefited from many years of work. It is possible to store multiple versions of the same file at low cost and navigate from one version to another quickly.

If you develop code without using a version control tool like Git or the equivalent, you are bypassing proven practices. It&rsquo;s likely that if you want to work on complex projects with multiple programmers, your productivity will be much lower without version control.

