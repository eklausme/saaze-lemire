---
date: "2023-02-01 12:00:00"
title: "Serializing IPs quickly in C++"
---



On the Internet, we often use 32-bit addresses which we serialize as strings such as 192.128.0.1. The string corresponds to the Integer address 0xc0800001 (3229614081 in decimal).

How might you serialize, go from the integer to the string, efficiently in C++?

The simplest code in modern C++ might look as follows:
```C
std::string output = std::to_string(address >> 24);
for (int i = 2; i >= 0; i--) {
  output.append(std::to_string((address >> (i * 8)) % 256) + ".");
}

```


At least symbolically, it will repeatedly create small strings that are appended to an initial string.

Can we do better? We have new functions in C++ (std::to_chars) which are dedicated to writing quickly to a string buffer. So we might try to allocate a single buffer and write to it using buffers. The result is not pretty:
```C
std::string output(4 * 3 + 3, '\0'); // allocate just one big string
char *point = output.data();
char *point_end = output.data() + output.size();
point = std::to_chars(point, point_end, uint8_t(address >> 24)).ptr;
for (int i = 2; i >= 0; i--) {
 *point++ = '.';
 point = std::to_chars(point, point_end, uint8_t(address >> (i * 8))).ptr;
}
output.resize(point - output.data());

```


The uglier code might be faster.

I wrote a benchmark where [I repeatedly create strings and add them to containers](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/02/01).

On an AMD Rome (Zen2) processor using GCC 11, I get the following numbers.

pretty code              |80 ns/string             |
-------------------------|-------------------------|
to_chars                 |24 ns/string             |


So about three times faster?

We can go at least twice as fast with a bulkier function but it uses significantly more storage and memory:
```C
  // uses 1025 bytes
  constexpr static const char *lookup =
".0 .1 .2 .3 .4 .5 .6 .7 .8 .9 .10 .11 .12 .13 .14 .15 .16 .17 "
".18 .19 .20 .21 .22 .23 .24 .25 .26 .27 .28 .29 .30 .31 .32 .33 .34 .35 "
".36 .37 .38 .39 .40 .41 .42 .43 .44 .45 .46 .47 .48 .49 .50 .51 .52 .53 "
".54 .55 .56 .57 .58 .59 .60 .61 .62 .63 .64 .65 .66 .67 .68 .69 .70 .71 "
".72 .73 .74 .75 .76 .77 .78 .79 .80 .81 .82 .83 .84 .85 .86 .87 .88 .89 "
".90 .91 .92 .93 .94 .95 .96 .97 .98 .99 "
".100.101.102.103.104.105.106.107.108.109.110.111.112.113.114.115.116."
"117.118.119.120.121.122.123.124.125.126.127.128.129.130.131.132.133.134."
"135.136.137.138.139.140.141.142.143.144.145.146.147.148.149.150.151.152."
"153.154.155.156.157.158.159.160.161.162.163.164.165.166.167.168.169.170."
"171.172.173.174.175.176.177.178.179.180.181.182.183.184.185.186.187.188."
"189.190.191.192.193.194.195.196.197.198.199.200.201.202.203.204.205.206."
"207.208.209.210.211.212.213.214.215.216.217.218.219.220.221.222.223.224."
"225.226.227.228.229.230.231.232.233.234.235.236.237.238.239.240.241.242."
"243.244.245.246.247.248.249.250.251.252.253.254.255";
  std::string output(4 * 3 + 3, '\0');
  char *point = output.data();
  uint8_t by;
  by = address >> 24;
  std::memcpy(point, lookup + by * 4 + 1, 4);
  point += (by < 10) ? 1 : (by < 100 ? 2 : 3);
  by = address >> 16;
  std::memcpy(point, lookup + by * 4, 4);
  point += (by < 10) ? 2 : (by < 100 ? 3 : 4);
  by = address >> 8;
  std::memcpy(point, lookup + by * 4, 4);
  point += (by < 10) ? 2 : (by < 100 ? 3 : 4);
  by = address >> 0;
  std::memcpy(point, lookup + by * 4, 4);
  point += (by < 10) ? 2 : (by < 100 ? 3 : 4);
  output.resize(point - output.data());


```


In my benchmark, I include a version by Marcin Zukowski that uses even more memory (about 4 times) and is slightly faster.

As always, your results will vary depending on your system and your compiler. However, I recommend against creating small strings and aggregating them together in performance critical code.

__Credit__: Peter Dimov and Marcin Zukowski have contributed fast versions (see benchmarks). The version with a large table is derived from their work. Ivan-Assen Ivanov contributed ideas on Twitter.

