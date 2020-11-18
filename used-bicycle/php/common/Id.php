<?php

class Id
{
    private static $_id = 0;
    public static function numbering()
    {
        self::$_id += 1;
        if (self::$_id === 99) {
            self::$_id += 1;
        }
        return self::$_id;
    }
}
