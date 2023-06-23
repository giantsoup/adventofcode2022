<?php

// Advent of Code Day 1

// To avoid this unacceptable situation, the Elves would instead like to know the total Calories carried by the top
// three Elves carrying the most Calories. That way, even if one of those Elves runs out of snacks,
// they still have two backups.

// Find the top three Elves carrying the most Calories. How many Calories are those Elves carrying in total?

$file_name = "puzzle-input.txt";

$file = fopen($file_name, "r");

$elves = [];
$current_elf = 0;

if ($file) {
    while (($line = fgets($file)) !== false) {

        $snack = (int)trim($line);

        if ($snack === 0) {
            $elves[] = $current_elf;

            $current_elf = 0;
            continue;
        }

        $current_elf = $current_elf + $snack;
    }

    rsort($elves);
    $sum = array_sum(array_slice($elves, 0, 3));

    fclose($file);
} else {
    echo "Unable to open the file: $file_name";
}


// print final answer and save to clipboard to paste into answer input on the webpage
exec('echo "'.$sum.'" | pbcopy');
echo PHP_EOL.$sum;