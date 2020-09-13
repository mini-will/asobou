# Awesome-name

Asobiy

## Description

毎日遊びを選ぶのも大変です。<br>
同じ遊びばかりでは飽きてしまいますよね。<br>
何で遊ぶか考える手間が省けないかと Asobiy を作りました<br>

## Demo

![Asobiy](https://asobiy.herokuapp.com/)

## Features

- 年齢に応じた遊びをランダムに表示
- 違う遊びがみたいときはチェンジボタンで違う遊びをランダムに表示

## Requirement

- vue 2.6
- laravel 7.28
- MySQL 8.0
- nodejs 14.3

## ディレクトリ仕様

- vue のソースフォルダを /resources/js に配置する

1. トップページにアクセスし遊びたい年齢を選ぶ

## Installation （ローカル環境）

```
# git clone
$ git clone https://github.com/mini-will/asobou.git

# 実行ディレクトリへ移動
$ cd {local_repo}

# 環境最新化
$ npm update
$ composer update

# db作成
$ php artisan migrate

# .env
# 特殊設定無し

# 遊びデータの挿入
$ php artisan db:seed --class=PlayProductSeeder

# run
$ npm run watch
$ php artisan serve
```

## Test

<!-- 1. test
2. test
3. test -->

## Deploy

<!-- 1. deploy
2. deploy
3. deploy -->

## Anything Else

## Author

[minisoba](https://twitter.com/minisooba)

<!-- ## License

[MIT](http://TomoakiTANAKA.mit-license.org)</blockquote> -->
