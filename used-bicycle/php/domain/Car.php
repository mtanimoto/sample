<?php

class Car
{
    private $_number;
    private $_carType;
    private $_price;
    private $_color;
    private $_remark;

    public function __construct(int $number, string $carType, int $price, string $color, string $remark)
    {
        $this->_number = $number;
        $this->_carType = $carType;
        $this->_price = $price;
        $this->_color = $color;
        $this->_remark = $remark;
    }

    public function getNumber(): int
    {
        return $this->_number;
    }

    public function getCarType(): string
    {
        return $this->_carType;
    }

    public function getPrice(): int
    {
        return $this->_price;
    }

    public function getColor(): string
    {
        return $this->_color;
    }

    public function getRemark(): string
    {
        return $this->_remark;
    }
}
