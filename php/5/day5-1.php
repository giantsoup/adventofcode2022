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
//        if (!$parsing_stack) {
//            echo PHP_EOL . 'Stack 1: ' . print_r($stacks[1], true);
//            echo PHP_EOL . 'Stack 2: ' . print_r($stacks[2], true);
//            echo PHP_EOL . 'Stack 3: ' . print_r($stacks[3], true);
//            die();
//        }
        if ($parsing_stack) {
            echo PHP_EOL . PHP_EOL . 'Parsing Stack';
            $stack_array = str_split($line);
            echo PHP_EOL . print_r($stack_array, true);
            foreach ($stack_array as $position => $item) {
                echo PHP_EOL . 'item: ' . $item . ' position: ' . $position;

                if ($item == 1) {
                    $parsing_stack = false;
                    echo PHP_EOL . 'Done parsing stack';
                    foreach ($stacks as $key => $stack) {
                        echo PHP_EOL . 'Reversed Stack: ' . print_r(array_reverse($stack), true);
                        $stacks[$key] = array_reverse($stack);
                    }
                    echo PHP_EOL . 'Stacks: ';
                    echo PHP_EOL . print_r($stacks, true);
                    break;
                }

                if (!in_array($item, ['', ' ', '[', ']', PHP_EOL])) {
                    echo PHP_EOL . 'This is a letter';
                    if ($position == 1) {
                        echo PHP_EOL . 'Should be in Stack 1';
                        $stacks[1][] = $item;
                    } elseif ($position == 5) {
                        echo PHP_EOL . 'Should be in Stack 2';
                        $stacks[2][] = $item;
                    } elseif ($position == 9) {
                        echo PHP_EOL . 'Should be in Stack 3';
                        $stacks[3][] = $item;
                    }
                }
            }

            if (!$parsing_stack) {
                continue;
            }
        }

        if (!$parsing_stack and $line != PHP_EOL) {
            echo PHP_EOL . PHP_EOL . 'Parsing Instructions';
            $instruction_array = explode(' ', $line);
            echo PHP_EOL . print_r($instruction_array, true);
            $move = (int) $instruction_array[1];
            $from = (int) $instruction_array[3];
            $to = (int) $instruction_array[5];
            echo PHP_EOL . 'Move: ' . gettype($move);
            echo PHP_EOL . 'From: ' . gettype($from);
            echo PHP_EOL . 'To: ' . gettype($to);
            echo PHP_EOL . 'To Stack Outside For Loop: ' . print_r($stacks[$to], true);
            if ($instruction_array[0] == 'move') {
                for ($i = 1; $i <= $move; $i++) {
                    echo PHP_EOL . 'Before Stacks: ' . print_r($stacks, true);
                    echo PHP_EOL . 'Item Number: ' . $i;
                    echo PHP_EOL . 'From Stack: ' . $from;
                    echo PHP_EOL . print_r($stacks[$from], true);
                    echo PHP_EOL . 'To Stack: ' . $to;
                    echo PHP_EOL . print_r($stacks[$to], true);

                    $stacks[$to][] = array_pop($stacks[$from]);

                    echo PHP_EOL . 'After Stacks: ' . print_r($stacks, true);
                }
            }
        }
    }

    echo PHP_EOL . 'Final Stacks: ' . print_r($stacks, true);

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