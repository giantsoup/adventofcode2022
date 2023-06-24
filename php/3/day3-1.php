<?php

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
        $rucksack_array = str_split($rucksack);
        // only do anything id we have an even number of items in the array
//        if (!(count($rucksack_array) % 2)) {
            $halfway = count($rucksack_array) / 2;
            $compartment_one = array_slice($rucksack_array, 0, $halfway);
            $compartment_two = array_slice($rucksack_array, $halfway);

            foreach ($compartment_one as $type_one) {
                foreach ($compartment_two as $type_two) {
                    if (!strcmp($type_one, $type_two)) {
                        $priority = $priorities[strtolower($type_one)];
                        if (ctype_upper($type_one)) {
                            $priority += 26;
                        }
                        $priority_sum += $priority;
                    }
                }
            }
//        }

    }

    fclose($file);
} else {
    echo "Unable to open the file: $file_name";
}


// print final answer and save to clipboard to paste into answer input on the webpage
exec('echo "'.$priority_sum.'" | pbcopy');
echo PHP_EOL.$priority_sum;