<?php

/*
 * Advent of Code: Day 7-1
 *
 * The device the Elves gave you has problems with more than just its communication system.
 * You try to run a system update:
 * $ system-update --please --pretty-please-with-sugar-on-top
 * Error: No space left on device
 *
 * Perhaps you can delete some files to make space for the update?
 *
 * You browse around the filesystem to assess the situation and save the resulting terminal output (your puzzle input).
 * For example:
 * $ cd /
 * $ ls
 * dir a
 * 14848514 b.txt
 * 8504156 c.dat
 * dir d
 * $ cd a
 * $ ls
 * dir e
 * 29116 f
 * 2557 g
 * 62596 h.lst
 * $ cd e
 * $ ls
 * 584 i
 * $ cd ..
 * $ cd ..
 * $ cd d
 * $ ls
 * 4060174 j
 * 8033020 d.log
 * 5626152 d.ext
 * 7214296 k
 *
 * Since the disk is full, your first step should probably be to find directories that are good candidates for deletion.
 * To do this, you need to determine the total size of each directory. The total size of a directory is the sum of the
 * sizes of the files it contains, directly or indirectly.
 * (Directories themselves do not count as having any intrinsic size.)
 *
 * To begin, find all the directories with a total size of at most 100000, then calculate the sum of their total
 * sizes. In the example above, these directories are a and e; the sum of their total sizes is 95437 (94853 + 584).
 * (As in this example, this process can count files more than once!)
 *
 * Find all the directories with a total size of at most 100000.
 *
 * What is the sum of the total sizes of those directories?
 */

$file_name = "puzzle-input-testing.txt";

$file = fopen($file_name, "r");
$sum_total_dir_sizes = 0;

if ($file) {
    $tree = [];
    $current_dir = '';

    while (($line = fgets($file)) !== false) {
        echo PHP_EOL . $line;

        // split line into array
        $line_array = str_split($line);

        // if it starts with a $, it's a command
        if ($line_array[0] == '$') {
            // if it's a cd command, change the current directory
            if ($line_array[2] == 'c' && $line_array[3] == 'd') {
                // get the directory name
                $dir_name = substr($line, 5);

                if (empty($tree)) {
                    $tree[$current_dir] = [];
                }







                // if key doesn't exist in array, add it
//                if (!in_array($dir_name, $list_of_dirs['unique'])) {
//                    $list_of_dirs['tree'][$dir_name] = ['size' => 0];
//                    $list_of_dirs['unique'][] = $dir_name;
//                }

                echo "cd to: $dir_name";
            }
        }

        // if line starts with "dir", get the directory name
//        if ($line_array[0] == "d") {
//            $dir_name = substr($line, 4);
//            echo "dir name: $dir_name";
//            // if key doesn't exist in array, add it
//            if (!in_array($dir_name, $list_of_dirs['unique'])) {
//                $list_of_dirs['tree'][$current_dir][$dir_name] = ['size' => 0];
//                $list_of_dirs['unique'][] = $dir_name;
//            }
//        }
    }

    fclose($file);
} else {
    echo "Unable to open the file: $file_name";
}


// print final answer and save to clipboard to paste into answer input on the webpage
exec('echo "' . $sum_total_dir_sizes . '" | pbcopy');
echo PHP_EOL . $sum_total_dir_sizes;