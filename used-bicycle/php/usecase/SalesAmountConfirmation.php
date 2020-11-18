<?php

class SalesAmountConfirmation extends Nav
{
    private $_title;

    protected function __construct()
    {
        $this->_title = "売上確認";
    }

    public function printContent(): void
    {
        parent::printTitle($this->_title);
        $soldCarList = SoldCarRepository::findAll();

        $amount = array_reduce($soldCarList, function ($amount, $car) {
            $amount += $car->getPrice();
            return $amount;
        });

        $amount = number_format($amount);
        p("現在の売上合計は {$amount}万 です。");
        p("");
        confirmNumber("メニューに戻るには何かキーを入力して下さい。");
    }
}
