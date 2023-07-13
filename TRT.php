<?php

function calculateMaxRevenue($treats, $totalTreatCount) {

    $dp = array_fill(0, $totalTreatCount, array_fill(0, $totalTreatCount, 0));

    for ($treatCount = 1; $treatCount <= $totalTreatCount; $treatCount++) {
        for ($i = 0; $i <= $totalTreatCount - $treatCount; $i++) {
            $j = $i + $treatCount - 1;
            $age = $totalTreatCount - ($j - $i);

            if ($i == $j) {
                $dp[$i][$j] = $treats[$i] * $age;
            } else {
                $leftRevenue = $treats[$i] * $age + $dp[$i + 1][$j];
                $rightRevenue = $treats[$j] * $age + $dp[$i][$j - 1];
                $dp[$i][$j] = max($leftRevenue, $rightRevenue);
            }
        }
    }

    return $dp[0][$totalTreatCount - 1];
}

function main() {
    $treatAmount = intval(trim(fgets(STDIN)));
    $treats = [];
    for ($i = 0; $i < $treatAmount; $i++) {
        $treats[] = intval(trim(fgets(STDIN)));
    }

    echo calculateMaxRevenue($treats, $treatAmount) . "\n";
}

main();


