<?php

class OnSaleCarTable
{
    private static $_carList = [];

    public static function select(int $number = null)
    {
        if (is_null($number)) {
            return self::$_carList;
        }

        foreach (self::$_carList as $_car) {
            if ($_car->getNumber() === $number) {
                return $_car;
            }
        }

        return null;
    }

    public static function insert(Car $car): int
    {
        array_push(self::$_carList, $car);
        return 1;
    }

    public static function delete(Car $car): int
    {
        foreach (self::$_carList as $key => $_car) {
            if ($_car->getNumber() === $car->getNumber()) {
                unset(self::$_carList[$key]);
                return 1;
            }
        }
        return 0;
    }
}
