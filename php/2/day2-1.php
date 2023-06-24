<?php

$file_name = "puzzle-input.txt";

$file = fopen($file_name, "r");

$my_score = 0;
$scoring = [
    'win' => 6,
    'lose' => 0,
    'draw' => 3,
    'Rock' => 1,
    'Paper' => 2,
    'Scissors' => 3,
];

if ($file) {
    while (($round = fgets($file)) !== false) {

        $opponent = '';
        $me = '';
        $result = '';


        foreach (str_split($round) as $round_array) {
            switch ($round_array[0]) {
                case 'A':
                    $opponent = 'Rock';
                    break;
                case 'X':
                    $me = 'Rock';
                    break;
                case 'B':
                    $opponent = 'Paper';
                    break;
                case 'Y':
                    $me = 'Paper';
                    break;
                case 'C':
                    $opponent = 'Scissors';
                    break;
                case 'Z':
                    $me = 'Scissors';
                    break;
            }
        }

        if ($opponent === 'Rock') {
            if ($me === 'Rock') {
                $result = 'draw';
            }
            if ($me === 'Paper') {
                $result = 'win';
            }
            if ($me === 'Scissors') {
                $result = 'lose';
            }
        }

        if ($opponent === 'Paper') {
            if ($me === 'Rock') {
                $result = 'lose';
            }
            if ($me === 'Paper') {
                $result = 'draw';
            }
            if ($me === 'Scissors') {
                $result = 'win';
            }
        }

        if ($opponent === 'Scissors') {
            if ($me === 'Rock') {
                $result = 'win';
            }
            if ($me === 'Paper') {
                $result = 'lose';
            }
            if ($me === 'Scissors') {
                $result = 'draw';
            }
        }

        $my_score = $my_score + $scoring[$result] + $scoring[$me];
    }

    fclose($file);
} else {
    echo "Unable to open the file: $file_name";
}


// print final answer and save to clipboard to paste into answer input on the webpage
exec('echo "'.$my_score.'" | pbcopy');
echo PHP_EOL.$my_score;