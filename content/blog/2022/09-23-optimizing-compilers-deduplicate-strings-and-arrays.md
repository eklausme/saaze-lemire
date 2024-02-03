---
date: "2022-09-23 12:00:00"
title: "Optimizing compilers deduplicate strings and arrays"
---



When programming, it can be wasteful to store the same constant data again and again. You use more memory, you access more data. Thankfully, your optimizing compiler may help.

Consider the following two lines of C code:
```C
    printf("Good day professor Jones");
```

```C
    printf("Good day professor Jane");
```


There is redundancy since the prefix &ldquo;Good day professor&rdquo; is the same in both cases. To my knowledge, no compiler is likely to trim this redundancy. However, you can get the desired trimming by breaking the strings:
```C
    printf("Good day professor ");
    printf("Jones");

    printf("Good day professor ");
    printf("Jane");
```


Most compilers will recognize the constant string and store it once in the program. It works even if the constant string &ldquo;Good day professor&rdquo; appears in different functions.

Thus the following function may return true:
```C
    const char * str1 = "dear friend";
    const char * str2 = "dear friend";
    return str1 == str2;
```


That is, you do not need to manually create constant strings: the compiler recognizes the redundancy (typically).

The same trick fails with extended strings:
```C
    const char * str1 = "dear friend";
    const char * str2 = "dear friend\0f";
    return str1 == str2;
```


All compilers I tried return false. They create two C strings even if one is a prefix of the other in the following example&hellip;
```C
char get1(int k) {
    const char * str = "dear friend";
    return str[k];
}

char get2(int k) {
    const char * str = "dear friend\0f";
    return str[k];
}
```


Unsurprisingly, the &ldquo;data compression&rdquo; trick works with arrays. For example, the arrays in these two functions are likely to be compiled to just one array because the compiler recognizes that they are identical:
```C
int f(int k) {
    int array[] = {1,2,3,4,5,34432,321323,321321,1,
    2,3,4,5,34432,321323,321321};
    return array[k];
}


int g(int k) {
    int array[] = {1,2,3,4,5,34432,321323,321321,1,
    2,3,4,5,34432,321323,321321};
    return array[k+1];
}
```


It may still work if one array is an exact subarray of the other ones with GCC, as in this example:
```C
int f(int k) {
    int array[] = {1,2,3,4,5,34432,321323,321321,1,
    2,3,4,5,34432,321323,321321};
    return array[k];
}


int g(int k) {
    int array[] = {1,2,3,4,5,34432,321323,321321,1,
    2,3,4,5,34432,321323,321321,1,4};
    return array[k+1];
}
```


You can also pile up several arrays as in the following case where GCC creates just one array:
```C
long long get1(int k) {
    long long str[] = {1,2,3};
    return str[k];
}

long long get2(int k) {
    long long str[] = {1,2,3,4};
    return str[k+1];
}

long long get3(int k) {
    long long str[] = {1,2,3,4,5,6};
    return str[k+1];
}

long long get4(int k) {
    long long str[] = {1,2,3,4,5,6,7,8};
    return str[k+1];
}
```


It also works with arrays of pointers, as in the following case:
```C
const char * get1(int k) {
    const char * str[] = {"dear friend", "dear sister", "dear brother"};
    return str[k];
}

const char * get2(int k) {
    const char * str[] = {"dear friend", "dear sister", "dear brother"};
    return str[k+1];
}
```


Of course, if you want to make sure to keep your code thin and efficient, you should not blindly rely on the compiler. Nevertheless, it is warranted to be slightly optimistic.

