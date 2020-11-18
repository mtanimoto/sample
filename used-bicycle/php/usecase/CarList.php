<?php

class CarList extends Nav
{
    private $_title;

    private static $_instance;

    private function __construct()
    {
        $this->_title = "中古車一覧";
    }

    public function printContent(): void
    {
        parent::printTitle($this->_title);
        $carList = OnSaleCarRepository::findAll();

        if ($carList === []) {
            p("販売する中古車がありません。");
            p("");
        }

        foreach ($carList as $car) {
            $this->printCarInfo($car);
        }

        confirmNumber("メニューに戻るには何かキーを入力して下さい。");
    }

    public static function getInstance(): CarList
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new CarList();
        }
        return self::$_instance;
    }

    public function printCarInfo(Car $car): void
    {
        $price = number_format($car->getPrice()) . "万";
        p("番号：{$car->getNumber()}");
        p("車種：{$car->getCarType()}");
        p("値段：{$price}");
        p("　色：{$car->getColor()}");
        p("備考：{$car->getRemark()}");
        p("");
    }
}
