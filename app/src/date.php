<?php
require_once 'database.php';

date_default_timezone_set("Asia/tokyo");


$dbHandlers3 = new Database('run-php-db', 'bbs_yt', 'root', 'root');
$pdo = $dbHandlers3->getpdo();

$offset = 0; // オフセットの値を設定
$datemax = 100; // 表示する最大の行数を設定

$sql = "SELECT id, username, title, comment, postdate FROM bbs_table ORDER BY postdate DESC LIMIT :offset, :datemax";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':datemax', $datemax, PDO::PARAM_INT);
$stmt->execute();

// 結果を取得
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

//var_dump($results);


//index.phpで$resultを回す？？
