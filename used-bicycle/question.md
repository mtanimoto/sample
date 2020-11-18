# 概要

中古車販売をしている店舗用のシステムを作成する。
システムは中古車を新規登録可能とし、新規登録した中古車は販売を可能とする。
販売した中古車でどれくらい売れたかを見る。

# 条件

- 中古車の新規登録は、車種、値段、色、備考を入力できるようにする。
- 販売した中古車の売上合計を見れるようにする。
- 車を置けるスペースが限られているため、置ける車の台数は最大１６台までとする。
- 中古車の価格は10万以上、5000万以下とする。
- 範囲外の値が入力された場合はエラーメッセージで警告を促すこと。
- 中古車は完売することを可能とする。
- プログラムの初期起動時は売上は0とする。
- プログラムの初期起動時は中古車を固定で３台存在しているようにする。内容は以下の通り。

```
車種：クラウン
値段：1,000万
　色：ホワイト
備考：エレガントに決めたいならコレ！

車種：フェアレディZ
値段：800万
　色：シルバー
備考：スポーティーに日常を過ごしたいあなたへ！

車種：カローラ
値段：200万
　色：ブルー
備考：キムタクも乗っていた。（宣伝で）大切な人と乗りたい人は是非
```

# 出力例

## 初期起動時

```
_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/
_/                             中古車販売メニュー                                _/
_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/
1. 販売
2. 中古車一覧
3. 売上確認
4. 新規登録
99. 終了

メニューを入力して下さい。：
```

## 販売

```
_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/
_/                                販売                                        _/
_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/
番号：1
車種：クラウン
値段：1,000万
　色：ホワイト
備考：エレガントに決めたいならコレ！

番号：2
車種：フェアレディZ
値段：800万
　色：シルバー
備考：スポーティーに日常を過ごしたいあなたへ！

番号：3
車種：カローラ
値段：200万
　色：ブルー
備考：キムタクも乗っていた。（宣伝で）大切な人と乗りたい人は是非

販売する中古車番号を入力して下さい。（99：戻る）：
```

## ※．販売する中古車がない場合の出力例

```
販売する中古車がありません。

メニューに戻るには何かキーを入力して下さい。
```

## 中古車一覧

```
_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/
_/                             中古車一覧                                     _/
_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/
番号：1
車種：クラウン
値段：1,000万
　色：ホワイト
備考：エレガントに決めたいならコレ！

番号：2
車種：フェアレディZ
値段：800万
　色：シルバー
備考：スポーティーに日常を過ごしたいあなたへ！

番号：3
車種：カローラ
値段：200万
　色：ブルー
備考：キムタクも乗っていた。（宣伝で）大切な人と乗りたい人は是非

メニューに戻るには何かキーを入力して下さい。
```

### ※．販売する中古車がない場合の出力例

```
販売する中古車がありません。

メニューに戻るには何かキーを入力して下さい。
```

## 売上確認

```
_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/
_/                              売上確認                                       _/
_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/

現在の売上合計は 7,600万 です。

メニューに戻るには何かキーを入力して下さい。
```

## 新規登録

```
_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/
_/                              新規登録                                       _/
_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/

車種：マジェスタ（Enter）
値段：1200（Enter）
　色：ブルメタ（Enter）
備考：最高峰の高級車（Enter）

1. 確定
2. 再入力
99. 戻る

メニューを入力して下さい。：
```