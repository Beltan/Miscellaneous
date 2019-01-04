<?php

$save_inputs = [];

function init() {

    global $save_inputs;

    while($line = readline()) {
        $trimmed = preg_replace('/\s+/', ' ', $line);
        $readed = explode(" ", $trimmed);
        $save_inputs = array_merge($save_inputs, $readed);
    }
}

function read_word() {
    global $save_inputs;

    if(count($save_inputs) > 0) {
        return array_shift($save_inputs);
    }
    
    return false;
}

init();

// ---- code from here ----

function gcd($a, $b) {
    if ($a == 0) return $b;
    if ($b == 0) return $a;
    if ($a == $b) return $a;
    if ($a > $b) return gcd($a-$b, $b);
    return gcd($a, $b-$a);
}

function myPow($exp) {
    if ($exp == 0) return 1;
    return 2*myPow($exp - 1);
}

function probability($money, $exponente) {
    return floor($money/1000*$exponente);
}

$money = read_word();

while ($money !== false) {
    $tries = read_word();
    $exponente = myPow($tries);
    $probabilidad = probability($money, $exponente);
    $divisor = gcd($probabilidad, $exponente);
    $newExponente = $exponente / 2;
    $winProbabilidadOld = -1;
    $loseProbabilidadOld = -1;
    $st = 1024 / $exponente;

    for ($i = 0; $i <= $money; $i++) {
        $loseProbabilidad = probability($money - $i, $newExponente);
        if ($loseProbabilidad != $loseProbabilidadOld) {
            $loseSt = 1024 / $newExponente;
            $loseProbabilidadOld = $loseProbabilidad;
        }

        $winProbabilidad = probability($money + $i, $newExponente);
        if ($winProbabilidad != $winProbabilidadOld) {
            $winSt = 1024 / $newExponente;
            $winProbabilidadOld = $winProbabilidad;
        }

        if ($loseProbabilidad * $loseSt + $winProbabilidad * $winSt == 2 * $probabilidad * $st) {
            echo $i . ' ';
            break;
        }
    }

    echo $probabilidad / $divisor . '/' . $exponente / $divisor . PHP_EOL;

    $money = read_word();
}

?>