<?php

/*
 * Advent of Code: Day 4-1
 *
 * Space needs to be cleared before the last supplies can be unloaded from the ships, and so several Elves have been
 * assigned the job of cleaning up sections of the camp. Every section has a unique ID number, and each Elf is assigned
 * a range of section IDs.
 *
 * However, as some of the Elves compare their section assignments with each other, they've noticed that many of the
 * assignments overlap. To try to quickly find overlaps and reduce duplicated effort, the Elves pair up and make a big
 * list of the section assignments for each pair (your puzzle input).
 *
 * Example:
 * 2-4,6-8
 * 2-3,4-5
 * 5-7,7-9
 * 2-8,3-7
 * 6-6,4-6
 * 2-6,4-8
 *
 * Some of the pairs have noticed that one of their assignments fully contains the other.
 * For example, 2-8 fully contains 3-7, and 6-6 is fully contained by 4-6. In pairs where one assignment
 * fully contains the other, one Elf in the pair would be exclusively cleaning sections their partner will already be
 * cleaning, so these seem like the most in need of reconsideration. In this example, there are 2 such pairs.
 *
 * In how many assignment pairs does one range fully contain the other?
 */

$file_name = "puzzle-input.txt";

$file = fopen($file_name, "r");

$assignments_subsumed = 0;

if ($file) {
    while (($assignments = fgets($file)) !== false) {
        $assignments_array = explode(',', trim($assignments));

        $elf1 = explode('-', $assignments_array[0]);
        $elf2 = explode('-', $assignments_array[1]);

        $elf1_assignment = range($elf1[0], $elf1[1]);
        $elf2_assignment = range($elf2[0], $elf2[1]);

        if (array_intersect($elf1_assignment, $elf2_assignment) == $elf1_assignment) {
            $assignments_subsumed++;
        }
        elseif (array_intersect($elf2_assignment, $elf1_assignment) == $elf2_assignment) {
            $assignments_subsumed++;
        }
    }

    fclose($file);
} else {
    echo "Unable to open the file: $file_name";
}


// print final answer and save to clipboard to paste into answer input on the webpage
exec('echo "' . $assignments_subsumed . '" | pbcopy');
echo PHP_EOL . $assignments_subsumed;