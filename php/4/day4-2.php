<?php

/*
 * Advent of Code: Day 4-2
 *
 * Example:
 * 2-4,6-8
 * 2-3,4-5
 * 5-7,7-9
 * 2-8,3-7
 * 6-6,4-6
 * 2-6,4-8
 *
 * It seems like there is still quite a bit of duplicate work planned. Instead, the Elves would like to know the number
 * of pairs that overlap at all.
 *
 * In the above example, the first two pairs (2-4,6-8 and 2-3,4-5) don't overlap,
 * while the remaining four pairs (5-7,7-9, 2-8,3-7, 6-6,4-6, and 2-6,4-8) do overlap:
 *
 * In how many assignment pairs do the ranges overlap?
 */

$file_name = "puzzle-input.txt";

$file = fopen($file_name, "r");

$assignments_overlapping = 0;

if ($file) {
    while (($assignments = fgets($file)) !== false) {
        $assignments_array = explode(',', trim($assignments));

        $elf1 = explode('-', $assignments_array[0]);
        $elf2 = explode('-', $assignments_array[1]);

        $elf1_assignment = range($elf1[0], $elf1[1]);
        $elf2_assignment = range($elf2[0], $elf2[1]);

        if (count(array_intersect($elf1_assignment, $elf2_assignment))) {
            $assignments_overlapping++;
        }
        elseif (count(array_intersect($elf2_assignment, $elf1_assignment))) {
            $assignments_overlapping++;
        }
    }

    fclose($file);
} else {
    echo "Unable to open the file: $file_name";
}


// print final answer and save to clipboard to paste into answer input on the webpage
exec('echo "' . $assignments_overlapping . '" | pbcopy');
echo PHP_EOL . $assignments_overlapping;