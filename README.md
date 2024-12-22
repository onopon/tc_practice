# TC practice 〜初めてテストコードを書く人へ〜 

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

2024/12/22 PHP Conference 2024にて、「テストコード書いてみませんか？」というタイトルで発表を行いました💡
https://speakerdeck.com/onopon/tesutokodoshu-itemimasenka
https://fortee.jp/phpcon-2024/proposal/f1473725-d50a-4fae-8045-d13ec9e49b05

## TC practiceとは

本リポジトリは、テストコードの書き方を学びたい人向けのチュートリアルリポジトリです。

主に、下記の方向けとなります。

- テストコードはなんとなく知っているけど、どのように書いていけばいいかがわからない
- プロジェクトでテストコードを導入するために、チームみんながテストコードを書ける状態を作りたい

テストコードそのものを知らない方は、 [WHAT_IS_TESTCODE.md](/WHAT_IS_TESTCODE.md) をご一読ください。

このリポジトリのソースコード内の至るところにクイズ形式で散りばめております。

クイズの一覧は、 [QUESTIONS.md](/QUESTIONS.md) に記載しております。

また本クイズを進める上で必要となるディレクトリの構造は、 [DIRECTORY_STRUCTURE.txt](/DIRECTORY_STRUCTURE.txt) をご確認ください。

## ページ構成

大きく下記の2ページが用意されています。

#### http://localhost:8000/user/login

ログインページです。

ユーザIDとパスワードの入力フォームが用意されております。

ユーザID、パスワードを入力、Loginボタンを押下後、正しい場合は http://localhost:8000/ に遷移します。

ユーザIDが存在しない、パスワードが誤っている場合は本urlにリダイレクトされます。

#### http://localhost:8000/

ログインユーザのアカウント情報ページです。

ユーザ名、ユーザID、役職、誕生日、星座が表示されます。

Logoutボタンを押下すると、 http://localhost:8000/user/login に遷移します。

## 環境構築方法

1. Dockerコマンドを利用できる状況にしてください
2. 下記コマンドを実行してください。必要なdockerを立ち上げ、初期準備（migrationやテストユーザの作成など)をしてくれます。

```
sh ./initial_run.sh
```

## initial_run.sh によりできる環境

local, testingの2つの環境を作成することができます。

### local

ブラウザ上でページの動作確認を行うために利用します。

### testing

CUI上で、用意したテストの実行を行うために利用します。

## initial_run.sh により立ち上がるdocker

app, db, phpunitの3つのdockerが立ち上がります。

### app

local環境で利用します。ページの挙動をブラウザ上で確認できるようにするためのdockerです。

### db

local, testing環境で利用します。

利用するdbが環境により異なり、

local環境ではtc_practiceが利用され、

testing環境ではtc_practice_testingが利用されます。

### phpunit

testing環境で利用します。CUI上でテストが実行できるようにするためのdockerです。

## 2回目以降の立ち上げ方法

下記コマンドを実行してください。

```
docker-compose up -d
```

`sh ./initial_run.sh` でも立ち上がってはくれますが、様々な処理を挟むため時間がかかります。

## dockerの終了のさせ方

下記コマンドを実行してください。

```
docker-compose down
```

## dockerコンテナ内でbashシェルを利用する方法

用途に応じて書きのコマンドを実行してください。

コンテナから抜ける場合は、 exit を実行してください。

### appコンテナに入りたい場合

```
docker-compose exec app bash
```

### dbコンテナに入りrootでmysqlを起動したい場合

```
docker-compose exec db bash
mysql -uroot -proot
```

### phpunitコンテナに入りテストを手動で実行したい場合

```
docker-compose exec phpunit bash
./vendor/bin/phpunit
```

## 便利なコマンド

いくつかコマンドを用意しました。

状況に応じて是非活用してください。

#### ./mysql

`./mysql` と実行すると、mysqlに接続できます。

#### ./phpunit

`./phpunit` と実行すると、全テストを順番に実行していきます。

`./phpunit tests/Unit/Librariees/UserUtilTest.php` のように指定したファイルのみテストを実行することもできます。

#### docker compose exec phpunit bash

phpunit docker上でbashを実行できるようになります。
exit と入力することで本bashから抜けることができます。

#### php artisan create:user

※ 本コマンドは `docker compose exec phpunit bash` 上で行ってください。

任意のユーザを作成することができます。
実行されるコマンドの中身は、

app/Console/Commands/CreateUser.php

をご確認ください。
オプションを与えることで、初期値意外のデータで作成することができます。

ex)

```
php artisan create:user --loginId=hoge
```
