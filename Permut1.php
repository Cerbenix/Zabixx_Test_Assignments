<?php

function calculateMahonianRow($inversions)
{
    $i = 1;
    $row = [1];

    while ($i < $inversions) {
        $previousRow = $row;
        $row = array_fill(0, 1 + ($i + 1) * ($i / 2), 0);
        $multipliers = array_fill(0, $i + 1, 1);

        for ($j = 0; $j < count($multipliers); $j++) {
            for ($k = 0; $k < count($previousRow); $k++) {
                $row[$k + $j] += $previousRow[$k];
            }
        }
        $i++;
    }

    return $row;
}

function main()
{
    $datasetCount = intval(fgets(STDIN));

    for ($i = 0; $i < $datasetCount; $i++) {
        $input = explode(" ", trim(fgets(STDIN)));
        $permutations = intval($input[0]);
        $inversions = intval($input[1]);

        $row = calculateMahonianRow($permutations);

        if ($inversions < 0 || $inversions >= count($row)) {
            echo "0" . PHP_EOL;
        } else {
            echo $row[$inversions] . PHP_EOL;
        }
    }
}

main();
