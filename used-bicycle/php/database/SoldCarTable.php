<?php

class SoldCarTable
{
    private static $_carList = [];

    public static function select()
    {
        return self::$_carList;
    }

    public static function insert(Car $car): int
    {
        array_push(self::$_carList, $car);
        return 1;
    }
}
