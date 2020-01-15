<?php

// 接続に必要な情報を定義
define('DSN', 'mysql:host=mysql;dbname=pet_shop;charset=utf8;');
define('USER', 'staff');
define('PASSWORD', '9999');

// DBに接続
try {
  $dbh = new PDO(DSN, USER, PASSWORD);
  echo '本日のご紹介ペット！' . '<br>';
} catch (PDOException $e) {
  // 接続がうまくいかない場合こちらの処理がなされる
  echo $e->getMessage();
  exit;
}

// SQL文の組み立て
$sql2 = "select * from animals";

// プリペアドステートメントの準備
$stmt = $dbh->prepare($sql2);

// プリペアドステートメントの実行
$stmt->execute();

// 結果の受け取り
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($row as $animal) {
  echo $animal['type'].'の'. $animal['classifcation'] . 'ちゃんは'. $animal['description'].'です。'.'<br>'.$animal['birthday'].'生まれ'.'<br>'.$animal['birthplace'].'<hr>';
}
