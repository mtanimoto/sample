<?php

class SoldCarRepository
{
    public static function findAll(): array
    {
        return SoldCarTable::select();
    }

    public static function register(Car $car): int
    {
        SoldCarTable::insert($car);
        return 1;
    }
}
