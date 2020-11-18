<?php
require_once __DIR__ . "/common/autoload.php";

initialize();

$menu = Menu::getInstance();

while (true) {
    $menu->printContent();
    $n = confirmNumber();

    if ($menu->validValue($n) === true) {
        $navItem = $menu->getSelectedNavItem($n);
        $navItem->printContent();
    } else {
        p("正しい値を入力してください。");
    }
}

function initialize()
{
    autoload();
    OnSaleCarRepository::register(new Car(Id::numbering(), "クラウン", 1000, "ホワイト", "エレガントに決めたいならコレ！"));
    OnSaleCarRepository::register(new Car(Id::numbering(), "フェアレディZ", 800, "シルバー", "スポーティーに日常を過ごしたいあなたへ！"));
    OnSaleCarRepository::register(new Car(Id::numbering(), "カローラ", 200, "ブルー", "キムタクも乗っていた。（宣伝で）大切な人と乗りたい人は是非"));
}
