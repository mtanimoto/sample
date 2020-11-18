<?php

class OnSaleCarRepository
{
    public static function find(int $number): Car
    {
        return OnSaleCarTable::select($number);
    }

    public static function findAll(): array
    {
        return OnSaleCarTable::select();
    }

    public static function register(Car $car): int
    {
        OnSaleCarTable::insert($car);
        return 1;
    }

    public static function remove(Car $car): int
    {
        OnSaleCarTable::delete($car);
        return 1;
    }
}
