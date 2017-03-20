<?php

function fun() {
    static $counter = 0;
    $counter++;

    echo $counter;
}

func();