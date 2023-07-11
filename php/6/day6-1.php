<?php

/*
 * Advent of Code: Day 6-1
 *
 * To be able to communicate with the Elves, the device needs to lock on to their signal. The signal is a series of
 * seemingly-random characters that the device receives one at a time.
 *
 * To fix the communication system, you need to add a subroutine to the device that detects a start-of-packet marker in
 * the datastream. In the protocol being used by the Elves, the start of a packet is indicated by a sequence of four
 * characters that are all different.
 *
 * The device will send your subroutine a datastream buffer (your puzzle input); your subroutine needs to identify the
 * first position where the four most recently received characters were all different. Specifically, it needs to report
 * the number of characters from the beginning of the buffer to the end of the first such four-character marker.
 *
 * For example, suppose you receive the following datastream buffer:
 * mjqjpqmgbljsphdztnvjfqwrcgsmlb
 *
 * How many characters need to be processed before the first start-of-packet marker is detected?
 */

$file_name = "puzzle-input.txt";

$file = fopen($file_name, "r");
$characters_to_marker = 0;

if ($file) {
    $counter = 1;
    $char_buffer = [];
    while (($char = fgetc($file)) !== false) {
        echo PHP_EOL . '--- Character ---';
        echo PHP_EOL . gettype($char);
        echo PHP_EOL . $char;

        $char_buffer[] = $char;

        if (count($char_buffer) === 4) {
            $unique_array = array_unique($char_buffer);
            if (count($unique_array) === count($char_buffer)) {
                echo PHP_EOL . 'We found the starting marker: ' . implode($char_buffer);
                echo PHP_EOL . 'Count of Characters is: ' . $counter;
                $characters_to_marker = $counter;
                break;
            } else {
                array_shift($char_buffer);
            }
        } else {
            echo PHP_EOL . 'Loop Count: ' . $counter;
            echo PHP_EOL . 'Char Buffer: ' . implode($char_buffer);
            echo PHP_EOL . 'The buffer doesn\'t have 4 characters in it';
        }

        $counter++;
    }

    fclose($file);
} else {
    echo "Unable to open the file: $file_name";
}


// print final answer and save to clipboard to paste into answer input on the webpage
exec('echo "' . $characters_to_marker . '" | pbcopy');
echo PHP_EOL . $characters_to_marker;