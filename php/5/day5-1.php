<?php

/*
 * Advent of Code: Day 5-1
 *
 * The expedition can depart as soon as the final supplies have been unloaded from the ships. Supplies are stored in
 * stacks of marked crates, but because the needed supplies are buried under many other crates, the crates need to be
 * rearranged.
 *
 * The ship has a giant cargo crane capable of moving crates between stacks. To ensure none of the crates get crushed
 * or fall over, the crane operator will rearrange them in a series of carefully-planned steps. After the crates are
 * rearranged, the desired crates will be at the top of each stack.
 *
 * The Elves don't want to interrupt the crane operator during this delicate procedure, but they forgot to ask her
 * which crate will end up where, and they want to be ready to unload them as soon as possible so they can embark.
 *
 * Example:
 *     [D]
 * [N] [C]
 * [Z] [M] [P]
 *  1   2   3
 *
 * move 1 from 2 to 1
 * move 3 from 1 to 3
 * move 2 from 2 to 1
 * move 1 from 1 to 2
 *
 * The Elves just need to know which crate will end up on top of each stack; in this example, the top crates are C in
 * stack 1, M in stack 2, and Z in stack 3, so you should combine these together and give the Elves the message CMZ.
 *
 * After the rearrangement procedure completes, what crate ends up on top of each stack?
 */

$file_name = "puzzle-input.txt";

$file = fopen($file_name, "r");

$stacks = [
    1 => [],
    2 => [],
    3 => [],
    4 => [],
    5 => [],
    6 => [],
    7 => [],
    8 => [],
    9 => [],
];

$top_items_on_stack = [];
$parsing_stack = true;

if ($file) {
    while (($line = fgets($file)) !== false) {
        if ($parsing_stack) {
            $stack_array = str_split($line);
            foreach ($stack_array as $position => $item) {

                if ($item == 1) {
                    $parsing_stack = false;
                    foreach ($stacks as $key => $stack) {
                        $stacks[$key] = array_reverse($stack);
                    }
                    break;
                }

                if (!in_array($item, ['', ' ', '[', ']', PHP_EOL])) {
                    if ($position == 1) {
                        $stacks[1][] = $item;
                    } elseif ($position == 5) {
                        $stacks[2][] = $item;
                    } elseif ($position == 9) {
                        $stacks[3][] = $item;
                    } elseif ($position == 13) {
                        $stacks[4][] = $item;
                    } elseif ($position == 17) {
                        $stacks[5][] = $item;
                    } elseif ($position == 21) {
                        $stacks[6][] = $item;
                    } elseif ($position == 25) {
                        $stacks[7][] = $item;
                    } elseif ($position == 29) {
                        $stacks[8][] = $item;
                    } elseif ($position == 33) {
                        $stacks[9][] = $item;
                    }
                }
            }

            if (!$parsing_stack) {
                continue;
            }
        }

        if (!$parsing_stack and $line != PHP_EOL) {
            $instruction_array = explode(' ', $line);
            $move = (int) $instruction_array[1];
            $from = (int) $instruction_array[3];
            $to = (int) $instruction_array[5];
            if ($instruction_array[0] == 'move') {
                for ($i = 1; $i <= $move; $i++) {
                    $stacks[$to][] = array_pop($stacks[$from]);
                }
            }
        }
    }

    foreach ($stacks as $stack) {
        $top_items_on_stack[] = array_pop($stack);
    }

    fclose($file);
} else {
    echo "Unable to open the file: $file_name";
}


// print final answer and save to clipboard to paste into answer input on the webpage
exec('echo "' . implode($top_items_on_stack) . '" | pbcopy');
echo PHP_EOL . implode($top_items_on_stack);