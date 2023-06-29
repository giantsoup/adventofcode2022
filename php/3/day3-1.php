<?php

/*
 * Advent of Code: Day 3
 *
 * The Elves have made a list of all the items currently in each rucksack (your puzzle input), but they need your
 * help finding the errors. Every item type is identified by a single lowercase or uppercase letter (that is, a and A
 * refer to different types of items).
 *
 * The list of items for each rucksack is given as characters all on a single line. A given rucksack always has the
 * same number of items in each of its two compartments, so the first half of the characters represent items in the
 * first compartment, while the second half of the characters represent items in the second compartment.
 *
 * To help prioritize item rearrangement, every item type can be converted to a priority:
 * Lowercase item types a through z have priorities 1 through 26.
 * Uppercase item types A through Z have priorities 27 through 52.
 *
 * In the above example, the priority of the item type that appears in both compartments of each rucksack is
 * 16 (p), 38 (L), 42 (P), 22 (v), 20 (t), and 19 (s); the sum of these is 157.
 *
 * Find the item type that appears in both compartments of each rucksack.
 * What is the sum of the priorities of those item types?
 */

$file_name = "puzzle-input.txt";

$file = fopen($file_name, "r");

$priority_sum = 0;
$priorities = [
    'a' => 1,
    'b' => 2,
    'c' => 3,
    'd' => 4,
    'e' => 5,
    'f' => 6,
    'g' => 7,
    'h' => 8,
    'i' => 9,
    'j' => 10,
    'k' => 11,
    'l' => 12,
    'm' => 13,
    'n' => 14,
    'o' => 15,
    'p' => 16,
    'q' => 17,
    'r' => 18,
    's' => 19,
    't' => 20,
    'u' => 21,
    'v' => 22,
    'w' => 23,
    'x' => 24,
    'y' => 25,
    'z' => 26
];

if ($file) {
    while (($rucksack = fgets($file)) !== false) {
        $priority = 0;
        $rucksack_array = str_split(trim($rucksack));
        $halfway = count($rucksack_array) / 2;

        $compartment_one = array_slice($rucksack_array, 0, $halfway);
        $compartment_two = array_slice($rucksack_array, $halfway);

        foreach ($compartment_one as $type_one) {
            if (in_array($type_one, $compartment_two)) {

                $priority = $priorities[strtolower($type_one)];
                if (ctype_upper($type_one)) {
                    $priority += 26;
                }

                $priority_sum += $priority;
                // only need to find the first match because there is only exactly 1 matching character per rucksack
                break;
            }
        }

    }

    fclose($file);
} else {
    echo "Unable to open the file: $file_name";
}


// print final answer and save to clipboard to paste into answer input on the webpage
exec('echo "' . $priority_sum . '" | pbcopy');
echo PHP_EOL . $priority_sum;