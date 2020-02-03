<?php

define('DSN', 'mysql:host=mysql;dbname=pet_shop;charset=utf8;');
define('USER', 'staff');
define('PASSWORD', '9999');

try {
  $dbh = new PDO(DSN, USER, PASSWORD);
  echo '接続に成功しました！' . '<br>';
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $keyword = $_GET["keyword"];
};

if ($keyword == '') {
  $sql = "select * from animals";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($keyword) {
  $sql2 = "select * from animals where description like '%$keyword%' ";
  echo $sql2;
  $stmt = $dbh->prepare($sql2);
  $stmt->execute();
  $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>課題</title>
</head>

<body>
  <h1>本日のご紹介ペット！</h1>
  <p>
    <form action="" method="get">
      <label for="keyword">キーワード:
        <input type="text" name="keyword" placeholder="キーワードの入力">
      </label>
      <input type="submit" value="検索">
    </form>

    <?php
    foreach ($animals as $animal) {
      echo $animal['type'] .  'の' . $animal['classifcation'] . 'ちゃん' . ' <br> ' . $animal['description'] . ' <br> ' . $animal['birthday'] . '生まれ' . ' <br> ' . '出身地' . $animal['birthplace'] . ' <hr> ';
    }
    ?>
  </p>
</body>

</html>