---
date: "2020-03-31 12:00:00"
title: "We released simdjson 0.3: the fastest JSON parser in the world is even better!"
---



Last year (2019), we released the simjson library. It is a C++ library available under a liberal license (Apache) that can parse JSON documents very fast. How fast? We reach and exceed 3 gigabytes per second in many instances. It can also parse millions of small JSON documents per second.

The new version is much faster. How much faster? Last year, we could parse a file like simdjson at a speed of 2.0 GB/s, and then we reached 2.2 GB/s. We are now reaching 2.5 GB/s. Why go so fast? In comparison, a fast disk can reach  5 GB/s and the best network adapters are even faster.

The following plot presents the 2020 simdjson library (version 0.3) compared with the fastest standard compliant C++ JSON parsers (RapidJSON and sajson). It ran on a single Intel Skylake core, and the code was compiled with the GNU GCC 9 compiler. [All tests are reproducible using Docker containers](https://github.com/simdjson/simdjson_experiments_vldb2019).

<a href="https://lemire.me/blog/wp-content/uploads/2020/03/image.png"><img decoding="async" class="alignnone size-full wp-image-18318" src="https://lemire.me/blog/wp-content/uploads/2020/03/image.png" alt width="750" height="450" srcset="https://lemire.me/blog/wp-content/uploads/2020/03/image.png 750w, https://lemire.me/blog/wp-content/uploads/2020/03/image-300x180.png 300w" sizes="(max-width: 750px) 100vw, 750px" /></a>

In this plot, RapidJSON and simjson have exact number parsing, while RapidJSON (fast float) and sajson use approximate number parsing. Furthermore, sajson has only partial unicode validation whereas other parsers offer exact encoding (UTF8) validation.

If we only improved the performance, it would already be amazing. But our new release pack a whole lot of improvements:

1. Multi-Document Parsing: Read a bundle of JSON documents (ndjson) 2-4x faster than doing it individually.
1. Simplified API: The API has been completely revamped for ease of use, including a new JSON navigation API and fluent support for error code and exception styles of error handling with a single API. In the past, using simdjson was a bit of a chore, the new approach is definitively modern, see for yourself:
```C
auto cars_json = R"( [
  { "make": "Toyota", "model": "Camry",  "year": 2018, 
       "tire_pressure": [ 40.1, 39.9 ] },
  { "make": "Kia",    "model": "Soul",   "year": 2012, 
       "tire_pressure": [ 30.1, 31.0 ] },
  { "make": "Toyota", "model": "Tercel", "year": 1999, 
       "tire_pressure": [ 29.8, 30.0 ] }
] )"_padded;
dom::parser parser;
dom::array cars = parser.parse(cars_json).get<dom::array>();

// Iterating through an array of objects
for (dom::object car : cars) {
  // Accessing a field by name
  cout << "Make/Model: " << car["make"] 
           << "/" << car["model"] << endl;

  // Casting a JSON element to an integer
  uint64_t year = car["year"];
  cout << "- This car is " << 2020 - year 
           << "years old." << endl;

  // Iterating through an array of floats
  double total_tire_pressure = 0;
  for (double tire_pressure : car["tire_pressure"]) {
    total_tire_pressure += tire_pressure;
  }
  cout << "- Average tire pressure: " 
      << (total_tire_pressure / 2) << endl;

  // Writing out all the information about the car
  for (auto [key, value] : car) {
    cout << "- " << key << ": " << value << endl;
  }
}
```



1. Exact Float Parsing: simdjson parses floats flawlessly at high speed.
1. Fallback implementation: simdjson now has a non-SIMD fallback implementation, and can run even on very old 64-bit machines. This means that you no longer need to check whether the system supports simdjson.
1. Automatic allocation: as part of API simplification, the parser no longer has to be preallocated: it will adjust automatically when it encounters larger files.
1. Runtime selection API: We have exposed simdjson&rsquo;s runtime CPU detection and implementation selection as an API, so you can tell what implementation we detected and test with other implementations.
1. Error handling your way: Whether you use exceptions or check error codes, simdjson lets you handle errors in your style. APIs that can fail return simdjson_result, letting you check the error code before using the result. But if you are more comfortable with exceptions, skip the error code<br/>
and cast straight to the value you need, and exceptions will be thrown automatically if an error happens. Use the same API either way!
1. Error chaining: We also worked to keep non-exception error-handling short and sweet. Instead of having to check the error code after every single operation, now you can chain JSON navigation calls like looking up an object field or array element, or casting to a string, so that you only have to check the error code once at the very end.
1. We now have a dedicated web site ([https://simdjson.org](https://simdjson.org)) in addition to the GitHub site ([https://github.com/simdjson/simdjson](https://github.com/simdjson/simdjson)).


__Credit__: many people contributed to simdjson, but John Keiser played a substantial role worthy of mention.

