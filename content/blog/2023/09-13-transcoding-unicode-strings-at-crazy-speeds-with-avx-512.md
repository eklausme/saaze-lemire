---
date: "2023-09-13 12:00:00"
title: "Transcoding Unicode strings at crazy speeds with AVX-512"
---



In software, we store strings of text as arrays of bytes in memory using one of the Unicode Transformation Formats (UTF), the most popular being UTF-8 and UTF-16. Windows, Java, C# and other systems common languages and systems default on UTF-16, whereas other systems and most of the web relies on UTF-8. There are benefits to both formats and we are not going to adopt one over the other any time soon. It means that we must constantly convert our strings from UTF-8 to UTF-16 and back.

It is so important that IBM mainframes based on z/Architecture provide special-purposes instructions named “CONVERT UTF-8 TO UTF-16” and “CONVERT UTF-16 TO UTF-8” for translation between the two encodings. By virtue of being implemented in hardware, these exceed 10 GiB processing speed for typical inputs. The rest of us do not have access to powerful mainframes, but our processors have single-instruction-multiple-data (SIMD) instructions. These SIMD instructions operate on larger registers (128 bits, 256 bits, 512 bits) representing vectors of numbers. Starting with the AMD Zen 4 family of processors, and with recent server Intel processors (i.e., Ice Lake or better), we have powerful SIMD instructions that can operate over 512 bits of data (AVX-512). The width (512 bits) is not the most interesting thing about these instructions: they are also distinctly more powerful than prior SIMD instruction sets.

We have a [software library for this purpose called simdutf](https://github.com/simdutf/simdutf). The library automatically detects your processor and selects a &lsquo;kernel&rsquo; of functions that is most appropriate. It supports a wide range of instruction sets (ARM NEON, SSE2, AVX2), but until last year, it did not support AVX-512.

So, how quickly can you convert (or &lsquo;transcode&rsquo;) strings using AVX-512? It is the subject of a new paper: [Transcoding unicode characters with AVX-512 instructions](https://arxiv.org/pdf/2212.05098.pdf) (Software: Practice and Experience, to appear). A reference point is the popular ICU library that is used almost universally for this task. It is mature and well optimized.

It is fairly easy to optimize the performance of transcoding for simple cases (e.g., English), but much more challenging for languages such as Arabic&hellip; and the most difficult case is probably streams of Emojis. The following graphic indicates our performance in gigabytes of input per second, comparing against our fast AVX2 kernel and ICU for difficult cases: plot A  is for UTF-8 to UTF-16 transcoding and plot B is for UTF-16 to UTF-8 transcoding. In these experiments, we use an Ice Lake processor and the Clang 14 C++ compiler from the LLVM.

<a href="https://lemire.me/blog/wp-content/uploads/2023/09/spe3261-fig-0003-m.jpg"><img decoding="async" class="alignnone size-large wp-image-20821" src="https://lemire.me/blog/wp-content/uploads/2023/09/spe3261-fig-0003-m-1024x513.jpg" alt width="660" height="331" srcset="https://lemire.me/blog/wp-content/uploads/2023/09/spe3261-fig-0003-m-1024x513.jpg 1024w, https://lemire.me/blog/wp-content/uploads/2023/09/spe3261-fig-0003-m-300x150.jpg 300w, https://lemire.me/blog/wp-content/uploads/2023/09/spe3261-fig-0003-m-768x385.jpg 768w, https://lemire.me/blog/wp-content/uploads/2023/09/spe3261-fig-0003-m-1536x770.jpg 1536w, https://lemire.me/blog/wp-content/uploads/2023/09/spe3261-fig-0003-m.jpg 1713w" sizes="(max-width: 660px) 100vw, 660px" /></a>

&nbsp;

Using AVX-512 on recent Intel and AMD processors, we exceed 4 GB/s on Chinese and Emoji inputs and almost reach 8 GB/s on Arabic text when transcoding from UTF-8. When transcoding from UTF-16, we exceed 5 GB/s on Chinese and Emoji text and break the 20 GB/s barrier on Arabic text.

I also like to report the speed in &lsquo;gigacharacters per second&rsquo;: billions of characters processed per second.  It is less impressive that gigabytes per second because characters can span multiple bytes, but with gigacharacters per second, we can directly compare the UTF-8 to UTF-16 transcoding to the UTF-16 to UTF-8 transcoding. We find it much easier to transcoding from UTF-16, since it is a simpler format, than to transcode from UTF-8. The benefits compared to ICU depend on the data source, but our simdutf library can be several times faster as the following tables show.

__UTF-8 to UTF-16:__

<thead>
<th class="bottom-bordered-cell left-aligned"> |<th class="bottom-bordered-cell left-aligned">ICU |<th class="bottom-bordered-cell left-aligned">AVX-512 |

</thead>
<td class="right-bordered-cell left-aligned">Arabic |<td class="left-aligned">0.80 |<td class="left-aligned">4.3 |
<td class="right-bordered-cell left-aligned">Chinese |<td class="left-aligned">0.50 |<td class="left-aligned">1.8 |
<td class="right-bordered-cell left-aligned">Emoji |<td class="left-aligned">0.22 |<td class="left-aligned">1.0 |
<td class="right-bordered-cell left-aligned">Hebrew |<td class="left-aligned">0.80 |<td class="left-aligned">4.3 |
<td class="right-bordered-cell left-aligned">Hindi |<td class="left-aligned">0.43 |<td class="left-aligned">1.7 |
<td class="right-bordered-cell left-aligned">Japanese |<td class="left-aligned">0.51 |<td class="left-aligned">1.7 |
<td class="right-bordered-cell left-aligned">Korean |<td class="left-aligned">0.62 |<td class="left-aligned">1.8 |
<td class="right-bordered-cell left-aligned">Latin |<td class="left-aligned">1.5 |<td class="left-aligned">20. |
<td class="right-bordered-cell left-aligned">Russian |<td class="left-aligned">0.46 |<td class="left-aligned">4.2 |


__UTF-16 to UTF-8:__

<th class="bottom-bordered-cell right-bordered-cell left-aligned"> |<th class="bottom-bordered-cell left-aligned">ICU |<th class="bottom-bordered-cell left-aligned">AVX-512 |

<td class="right-bordered-cell left-aligned">Arabic |<td class="left-aligned">0.67 |<td class="left-aligned">11. |
<td class="right-bordered-cell left-aligned">Chinese |<td class="left-aligned">0.36 |<td class="left-aligned">3.9 |
<td class="right-bordered-cell left-aligned">Emoji |<td class="left-aligned">0.27 |<td class="left-aligned">1.6 |
<td class="right-bordered-cell left-aligned">Hebrew |<td class="left-aligned">0.68 |<td class="left-aligned">11. |
<td class="right-bordered-cell left-aligned">Hindi |<td class="left-aligned">0.21 |<td class="left-aligned">3.8 |
<td class="right-bordered-cell left-aligned">Japanese |<td class="left-aligned">0.37 |<td class="left-aligned">3.8 |
<td class="right-bordered-cell left-aligned">Korean |<td class="left-aligned">0.37 |<td class="left-aligned">3.8 |
<td class="right-bordered-cell left-aligned">Latin |<td class="left-aligned">0.91 |<td class="left-aligned">20. |
<td class="right-bordered-cell left-aligned">Russian |<td class="left-aligned">0.23 |<td class="left-aligned">11. |


Older Intel processor that supported AVX-512 raised serious concerns due to various forms of &lsquo;frequency throttling&rsquo;: whenever you&rsquo;d use these instructions, they would trigger a lowering of the frequency. For this reason, we do not use AVX-512 instructions on these older processors, preferring to fall back on AVX instructions. There is no frequency throttling on AMD Zen 4 or recent Intel processors due AVX-512 instructions.

Our functions have already been used in production systems for nearly a year as part of the [simdutf library](https://github.com/simdutf/simdutf). The library includes an extensive collection of tests and benchmarks. It is part of several important projects such as Node.js, Bun, Oracle graaljs, and it is used by Couchbase and others. The simdutf library is a joint community effort, with multiple important contributors (e.g., Wojciech Muła, Yagiz Nizipli and so forth).

We are currently in the process of adding Latin 1 support to the library. In the future, I hope that we might add SVE/SVE2 support for the new generation of ARM processors.

__Credit__: The algorithmic design of the new AVX-512 functions should be credited to the always brilliant Robert Clausecker.

