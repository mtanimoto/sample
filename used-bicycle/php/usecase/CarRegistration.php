<?php

class CarRegistration extends Nav
{
    private $_title;

    private static $_instance;

    private function __construct()
    {
        $this->_title = "新規登録";
    }

    public function printContent(): void
    {
        parent::printTitle($this->_title);

        $carType = $this->_confirmCarType();
        $price = $this->_confirmPrice();
        $color = $this->_confirmColor();
        $remark = $this->_confirmRemark();

        $input = $this->_confirmRegistration();
        if ($input === 1) {
            $car = new Car(Id::numbering(), $carType, $price, $color, $remark);
            OnSaleCarRepository::register($car);
        }

        if ($input === 2) {
            $this->printContent();
            return;
        }

        if ($input === 99) {
            return;
        }
    }

    public static function getInstance(): CarRegistration
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new CarRegistration();
        }
        return self::$_instance;
    }

    private function _confirmCarType(): string
    {
        $input = confirmNumber("車種：");
        if ($input === '') {
            p("車種を入力してください。");
            return $this->_confirmCarType();
        }
        return $input;
    }

    private function _confirmPrice(): int
    {
        $input = confirmNumber("値段：");
        if (is_numeric($input)) {
            return intval($input);
        }
        p("値段には数値を入力してください。");
        return $this->_confirmPrice();
    }

    private function _confirmColor(): string
    {
        $input = confirmNumber("　色：");
        if ($input === '') {
            p("色を入力してください。");
            return $this->_confirmColor();
        }
        return $input;
    }

    private function _confirmRemark(): string
    {
        return confirmNumber("備考：");
    }

    private function _confirmRegistration(): int
    {
        $menu = "
            1. 確定
            2. 再入力
            99. 戻る
        ";
        p(str_replace(" ", "", $menu));

        $input = confirmNumber();

        if (in_array($input, ['1', '2', '99'])) {
            return intval($input);
        }

        return $this->_confirm();
    }
}
