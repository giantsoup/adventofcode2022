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
                    $result = 'lose';
                    break;
                case 'B':
                    $opponent = 'Paper';
                    break;
                case 'Y':
                    $result = 'draw';
                    break;
                case 'C':
                    $opponent = 'Scissors';
                    break;
                case 'Z':
                    $result = 'win';
                    break;
            }

            if ($opponent === 'Rock') {
                if ($result === 'win') {
                    $me = 'Paper';
                }
                if ($result === 'lose') {
                    $me = 'Scissors';
                }
                if ($result === 'draw') {
                    $me = 'Rock';
                }
            }

            if ($opponent === 'Paper') {
                if ($result === 'win') {
                    $me = 'Scissors';
                }
                if ($result === 'lose') {
                    $me = 'Rock';
                }
                if ($result === 'draw') {
                    $me = 'Paper';
                }
            }

            if ($opponent === 'Scissors') {
                if ($result === 'win') {
                    $me = 'Rock';
                }
                if ($result === 'lose') {
                    $me = 'Paper';
                }
                if ($result === 'draw') {
                    $me = 'Scissors';
                }
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