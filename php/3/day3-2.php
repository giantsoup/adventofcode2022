<?php

/*
 * Advent of Code: Day 3-2
 *
 * For safety, the Elves are divided into groups of three. Every Elf carries a badge that identifies their group.
 * For efficiency, within each group of three Elves, the badge is the only item type carried by all three Elves.
 * That is, if a group's badge is item type B, then all three Elves will have item type B somewhere in their rucksack,
 * and at most two of the Elves will be carrying any other item type.
 *
 * The problem is that someone forgot to put this year's updated authenticity sticker on the badges. All the badges need
 * to be pulled out of the rucksacks so the new authenticity stickers can be attached.
 *
 * Additionally, nobody wrote down which item type corresponds to each group's badges. The only way to tell which item
 * type is the right one is by finding the one item type that is common between all three Elves in each group.
 *
 * Every set of three lines in your list corresponds to a single group, but each group can have a different badge
 * item type. So, in the above example, the first group's rucksacks are the first three lines:
 *
 * Priorities for these items must still be found to organize the sticker attachment efforts: here, they are 18 (r) for
 * the first group and 52 (Z) for the second group. The sum of these is 70.
 *
 * Find the item type that corresponds to the badges of each three-Elf group.
 * What is the sum of the priorities of those item types?
 */


$time_start = microtime(true);
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
    $elf_group = [];

    while (($rucksack = fgets($file)) !== false) {
        $elf_group[] = trim($rucksack);

        if (count($elf_group) === 3) {

            // Option 1: Fancy - Create a character frequency and use shorter list to loop over rucksacks
            // Option 1 Time: ~0.0005 seconds (0.00045, 0.00052, 0.00048)
            // Option 2: Brute Force - Loop over each character in each rucksack and compare to other rucksacks
            // Option 2 Time: ~0.0003 seconds (0.00029, 0.00032, 0.00031)
            $option = 2;

            if ($option === 1) {
                $str = implode($elf_group);
                $frequencies = count_chars($str, 1);

                // Filter out characters appearing less than 3 times
                $characters_appearing_at_least_thrice = [];
                foreach ($frequencies as $char => $freq) {
                    if ($freq >= 3) {
                        $characters_appearing_at_least_thrice[] = chr($char);
                    }
                }

                foreach ($characters_appearing_at_least_thrice as $character) {
                    $rucksacks_with_character = 0;

                    foreach ($elf_group as $rucksack) {
                        if (strpos($rucksack, $character) !== false) {
                            $rucksacks_with_character++;
                        }
                    }

                    if ($rucksacks_with_character === 3) {
                        $priority = $priorities[strtolower($character)];
                        if (ctype_upper($character)) {
                            $priority += 26;
                        }

                        $priority_sum += $priority;

                        // only need to find the first match because there is only exactly 1 matching character per group
                        break;
                    }
                }
            }

            if ($option === 2) {
                foreach ($elf_group as $rucksack) {
                    $rucksack_array = str_split($rucksack);
                    $remaining_rucksacks = array_diff($elf_group, [$rucksack]);

                    foreach ($rucksack_array as $character) {
                        $matching_rucksack_count = 0;
                        foreach ($remaining_rucksacks as $remaining_rucksack) {
                            if (strpos($remaining_rucksack, $character) !== false) {
                                $matching_rucksack_count++;
                            }
                        }

                        if ($matching_rucksack_count === 2) {
                            $priority = $priorities[strtolower($character)];
                            if (ctype_upper($character)) {
                                $priority += 26;
                            }

                            $priority_sum += $priority;

                            // only need to find the first match because there is only exactly 1 matching character per group
                            break 2;
                        }
                    }
                }
            }

            $elf_group = [];
        }
    }

    fclose($file);
} else {
    echo "Unable to open the file: $file_name";
}

$time_end = microtime(true);
$time = $time_end - $time_start;
// first idea = 0.0005 seconds
// print final answer and save to clipboard to paste into answer input on the webpage
exec('echo "' . $priority_sum . '" | pbcopy');
echo PHP_EOL . $priority_sum . PHP_EOL;
echo '==== Executed In ====' . PHP_EOL;
echo $time . PHP_EOL;