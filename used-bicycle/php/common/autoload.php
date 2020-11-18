<?php

spl_autoload_register(function ($className) {
    $pathList = getPaths(realpath(__DIR__ . "/.."));

    foreach ($pathList as $path) {
        $file = $path . "/{$className}.php";
        if (file_exists($file)) {
            require_once $path . "/{$className}.php";
            break;
        }
    }
});

function autoload()
{
    $pathList = getPaths(realpath(__DIR__ . "/../common"));
    foreach ($pathList as $path) {
        if (__FILE__ !== $path) {
            require_once $path;
        }
    }
}

function getPaths(string $targetPath)
{
    return glob(realpath($targetPath) . "/*");
}
