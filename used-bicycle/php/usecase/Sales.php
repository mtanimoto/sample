<?php

class Sales extends Nav
{
    private $_title;

    protected function __construct()
    {
        $this->_title = "販売";
    }

    public function printContent(): void
    {
        parent::printTitle($this->_title);
        $carList = OnSaleCarRepository::findAll();

        if ($carList === []) {
            p("販売する中古車がありません。");
            p("");
            confirmNumber("メニューに戻るには何かキーを入力して下さい。");
            return;
        }

        $carListInstance = CarList::getInstance();
        foreach ($carList as $car) {
            $carListInstance->printCarInfo($car);
        }

        $input = confirmNumber("販売する中古車番号を入力して下さい。（99：戻る）：");
        if ($input == '99') {
            return;
        }

        if (!$this->_hasNumber($carList, $input)) {
            p("入力番号に該当する車がありません。");
            $this->printContent();
            return;
        }

        $car = OnSaleCarRepository::find(intval($input));
        OnSaleCarRepository::remove($car);
        SoldCarRepository::register($car);
    }

    private function _hasNumber(array $carList, string $input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        $car = array_filter($carList, function ($car) use ($input) {
            $n = intval($input);
            return $car->getNumber() === $n;
        });
        return count($car) === 1;
    }
}
