<?php

// Advent of Code Day 1

// In case the Elves get hungry and need extra snacks, they need to know which Elf to ask: they'd like to know how many
// Calories are being carried by the Elf carrying the most Calories.

// Find the Elf carrying the most Calories. How many total Calories is that Elf carrying?

$file_name = "puzzle-input.txt";

$file = fopen($file_name, "r");

$current_elf = 0;
$top_elf = 0;

if ($file) {
    while (($line = fgets($file)) !== false) {

        $snack = (int)trim($line);

        if ($snack === 0) {
            if ($current_elf > $top_elf) {
                $top_elf = $current_elf;
            }

            $current_elf = 0;
            continue;
        }

        $current_elf = $current_elf + $snack;
    }

    fclose($file);
} else {
    echo "Unable to open the file: $file_name";
}


// print final answer and save to clipboard to paste into answer input on the webpage
exec('echo "'.$top_elf.'" | pbcopy');
echo PHP_EOL.$top_elf;