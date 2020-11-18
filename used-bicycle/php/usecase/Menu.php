<?php

class Menu extends Nav
{
    private $_title;

    private static $_instance;

    private function __construct()
    {
        $this->_title = "中古車販売メニュー";
    }

    public function printContent(): void
    {
        parent::printTitle($this->_title);
        $menu = "
            1. 販売
            2. 中古車一覧
            3. 売上確認
            4. 新規登録
            99. 終了
        ";
        p(str_replace(" ", "", $menu));
    }

    public static function getInstance(): Menu
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Menu();
        }
        return self::$_instance;
    }

    public function validValue(string $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        $n = intval($input);
        return ($n >= 1 && $n <= 4) || $n === 99;
    }

    public function getSelectedNavItem(string $input): Nav
    {
        $n = intval($input);
        switch ($n) {
            case 1:
                return Sales::getInstance();
            case 2:
                return CarList::getInstance();
            case 3:
                return SalesAmountConfirmation::getInstance();
            case 4:
                return CarRegistration::getInstance();
            case 99:
                return End::getInstance();
        }
        throw new InvalidArgumentException('予期しない入力値です。');
    }
}
