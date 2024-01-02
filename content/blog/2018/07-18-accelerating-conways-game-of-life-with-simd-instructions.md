---
date: "2018-07-18 12:00:00"
title: "Accelerating Conway´s Game of Life with SIMD instructions"
---



[Conway&rsquo;s Game of Life](https://en.wikipedia.org/wiki/Conway%27s_Game_of_Life) is one of the simplest non-trivial simulation one can program. It simulates the emergence of life from chaos. Though the rules are simple, the game of life is still being studied for the last five decades.

The rules are simple. You have a grid where each cell in the grid has a single bit of state: it is either alive or dead. During each iteration, we look at the 8 neighbours of each cells and count the number of live neighbours. If a cell is dead but has exactly three live neighbours, it comes alive. If a live cell has more than 3 or less than 2 live neighbours, it dies. That is all.

Implemented in a straight-forward manner, the main loop might look like this&hellip;
```C
for (i = 0; i < height; i++) {
    for (j = 0; j < width; j++) {
      bool alive = states[i][j];
      int neighbours = count_live_neighbours[i][j];
      if (alive) {
        if (neighbours < 2 || neighbours > 3) {
          states[coord] = false;
        }
      } else {
        if (neighbours == 3) {
          states[coord] = true;
        }
      }
    }
}
```


However, if you implement it in this manner, it is hard for an optimizing compiler to generate clever code. For a 10,000 by 10,000 grid, my basic C implementation takes 0.5 seconds per iteration.

So I wondered whether I could rewrite the code in a vectorized manner, using the SIMD instructions available on our commodity processors. My first attempt brought this down to 0.02 seconds per iteration or about 25 times faster. [My code is available](https://github.com/lemire/SIMDgameoflife).

scalar (C)               |0.5 s                    |
-------------------------|-------------------------|
vectorized (C + SIMD)    |0.02 s                   |


I use 32-byte AVX2 intrinsics. I did not profile my code or do any kind of hard work.

Thoughts:

1. At a glance, I would guess that the limiting factor is the number of &ldquo;loads&rdquo;. An x64 processor can, at best, load two registers from memory per cycle and I have many loads. The arithmetic operations (additions, subtractions) probably come for free. My implementation uses 8 bits per cell whereas a single bit is sufficient. Going to more concise representation would reduce the number of loads by nearly an order of magnitude. My guess is that, on main CPUs, I am probably between a factor of 5 and 10 away from the optimal implementation. I expect that I am at least a factor of two away from the optimal speed.
1. The game-of-life problem is very similar to an image processing problem. It is a 3&#215;3 moving/convolution filter. Tricks from image processing can be brought to bear. In particular, the problem is a good fit for GPU processing.
1. I did not look at existing game-of-life implementations. I was mostly trying to come up with the answer by myself as quickly as possible. My bet would be on [GPU implementations](http://www.marekfiser.com/Projects/Conways-Game-of-Life-on-GPU-using-CUDA) beating my implementation by a wide margin (orders of magnitude).


__Update__: John Regher points me to [Hashlife](https://en.wikipedia.org/wiki/Hashlife) as a better high-speed reference.

