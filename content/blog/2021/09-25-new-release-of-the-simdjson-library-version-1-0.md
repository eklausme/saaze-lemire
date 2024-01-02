---
date: "2021-09-25 12:00:00"
title: "New release of the simdjson library: version 1.0"
---



The most popular data format on the web is arguably JSON. It is a simple and convenient format. Most web services allow to send and receive data in JSON.

Unfortunately, parsing JSON can be time and energy consuming. Back in 2019, we [released the simdjson library](https://simdjson.org). It broke speed records and it is still one of the most efficient and fast JSON parsing library. It makes few compromises. It provides exact float parsing, exact unicode validation and so forth.

An [independent benchmark](https://github.com/kostya/benchmarks) compares it with other fast C++ libraries and demonstrates that it can use far less energy.

simdjson                 |2.1 J                    |
-------------------------|-------------------------|
RapidJSON                |6.8 J                    |
C++ for Modern C++       |41 J                     |


We have recently released version 1.0. It took us two years to get at that point. It is an important step for us.

There are many ways a library can give you access to the JSON data. A convenient approach is the DOM tree (DOM stands for document object model). In a DOM-based approach, the document is parsed entirely and materialized in an in-memory construction. For some applications, it is the right model, but in other instances, it is a wasteful step.

We also have streaming-based approaches. In such approaches, you have an event-based interface where the library calls user-provided function when encountering different elements. Though it can be highly efficient, in part because it sidesteps the need to construct a DOM tree, it is a challenging programming paradigm.

Another approach is a simple serialization-deserialization. You provide a native data structure and you ask the library to either write it out in JSON or to turn the JSON into your data structure. It is often a great model. However, it has limited flexibility.

In simdjson, we are proposing a new approach which we call On Demand. The On Demand approach feels like a DOM approach, but it sidesteps the construction of the DOM tree. It is entirely lazy: it decodes only the parts of the document that you access.

With On Demand, you can write clean code as follows:
```C
#include <iostream>
#include "simdjson.h"
using namespace simdjson;
int main(void) {
    ondemand::parser parser;
    padded_string json = padded_string::load("twitter.json");
    ondemand::document tweets = parser.iterate(json);
    std::cout << uint64_t(tweets["search_metadata"]["count"]) << " results." << std::endl;
}
```


In such an example, the library accesses only the content that you require, doing only minimal validation and indexing of the whole document.

With On Demand, if you open a file containing 1000 numbers and you need just one of these numbers, only one number is parsed. If you need to put the numbers into your own data structure, they are materialized there directly, without being first written to a temporary tree. Thus we expect that the simdjson On Demand might often provide superior performance, when you do not need to materialize a DOM tree. The On Demand front-end was primarily developed by John Keiser.

In release 1.0 of the simdjson library, the On Demand frontend is our default though we also support a DOM-based approach.

Release 1.0 adds several key features:

1. In big data analytics, it is common to serialize large sets of records as multiple JSON documents separated by white spaces. You can now get the benefits of On Demand while parsing almost infinitely long streams of JSON records. At each step, you have access to the current document, but a secondary thread indexes the following block. You can thus access enormous files while using a small amount of memory and achieve record-breaking speeds.
1. Given an On Demand instance (value, array, object, etc.), you can now convert it to a JSON string using the to_json_string method which returns a string view in the original document for unbeatable speeds.
1. The On Demand front-end now supports the JSON Pointer specification. You can request a specific value using a JSON Pointer within a large document.


The release 1.0 is robust. We have extended and improved our documentation. We have added much testing.

The simdjson library is the result of the work of many people. I would like to thank Nicolas Boyer for working with me over the summer on finishing this version.

You can find [simdjson on GitHub](https://github.com/simdjson/simdjson/releases/tag/v1.0.0). You can use it by adding two files to your project ([simdjson.h](https://github.com/simdjson/simdjson/releases/download/v1.0.0/simdjson.h) and [simdjson.cpp](https://github.com/simdjson/simdjson/releases/download/v1.0.0/simdjson.cpp)), or as a CMake dependency or using many popular package managers.

