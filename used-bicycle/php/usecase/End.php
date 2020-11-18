<?php

class End extends Nav
{
    private static $_instance;

    private function __construct()
    {
    }

    public function printContent(): void
    {
        exit(0);
    }

    public static function getInstance(): End
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new End();
        }
        return self::$_instance;
    }
}
