<?php

function p($target)
{
    if (gettype($target) === 'array') {
        $target = print_r($target, true);
    }

    echo $target . PHP_EOL;
}

function confirmNumber(string $message = "メニューを入力してください。："): string
{
    p($message);
    $stdin =  fgets(STDIN);
    return str_replace(PHP_EOL, '', $stdin);
}
