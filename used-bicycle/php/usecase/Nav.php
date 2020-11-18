<?php

abstract class Nav
{
    private static $_instances = [];

    protected function printTitle(string $title): void
    {
        for ($i = 0; $i < 40; $i++) {
            echo "_/";
        }
        echo PHP_EOL;

        echo "_/";
        $len = strlen(mb_convert_encoding($title, "sjis-win", "utf8"));

        $leftWhiteSpaces = 38 - $len / 2;
        echo join("", array_fill(0, $leftWhiteSpaces, " "));

        echo $title;

        $rigthWhiteSpaces = ($len % 2) === 0 ? 38 - $len / 2 : 38 - $len / 2 + 1;
        echo join("", array_fill(0, $rigthWhiteSpaces, " "));

        echo "_/" . PHP_EOL;

        for ($i = 0; $i < 40; $i++) {
            echo "_/";
        }
        echo PHP_EOL;
    }

    public static function getInstance()
    {
        $class = get_called_class();
        if (!isset(self::$_instances[$class])) {
            self::$_instances[$class] = new $class;
        }
        return self::$_instances[$class];
    }

    abstract public function printContent(): void;

}
