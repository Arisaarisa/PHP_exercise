<?php

// 接続に必要な情報を定義
define('DSN', 'mysql:host=mysql;dbname=pet_shop;charset=utf8;');
define('USER', 'staff');
define('PASSWORD', '9999');

// DBに接続
try {
  $dbh = new PDO(DSN, USER, PASSWORD);
  echo 'アクセスありがとうございます！本日のご紹介です！' . '<br>'.'<br>';
} catch (PDOException $e) {
  // 接続がうまくいかない場合こちらの処理がなされる
  echo $e->getMessage();
  exit;
}

// SQL文の組み立て
$sql = "select * from animals";

// プリペアドステートメントの準備
$stmt = $dbh->prepare($sql);

// プリペアドステートメントの実行
$stmt->execute();

// 結果の受け取り
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($row as $animal) {
  echo $animal['type'].'の'. $animal['classifcation'] . 'ちゃん'.'<br>'. $animal['description'].'<br>'.$animal['birthday'].'  生まれ'.'<br>'.'出身地  '.$animal['birthplace'].'<hr>';
}
