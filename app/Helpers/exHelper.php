<?php

function exTypeToString($type) {

    switch ($type) {
        case 0:
            return "Без веса";
        case 1:
            return "Без веса раздельное";
        case 2:
            return "С весом";
        case 3:
            return "С весом раздельное";
        default:
            return "Не определено";
    }
}
