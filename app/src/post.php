<?php
require_once 'database.php';

$dbHandler2 = new Database('run-php-db', 'bbs_yt', 'root', 'root');
$pdo = $dbHandler2->getpdo();
date_default_timezone_set("Asia/Tokyo");



try {
    $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO  bbs_table(username, title, body, postdate) VALUES(:username, :title, :comment, now())");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':comment', $comment);
    $stmt->execute();

    echo "投稿が保存されました。";

    header('index.php');
    exit();
    
} catch(PDOException $e) {
    // エラーメッセージの生成
    $errorMessage = "データ保存中にエラーが発生しました: " . $e->getMessage();

    echo $errorMessage;
    //echo $e->getMessage();


}
