<?php
require_once 'datamase.php';

$stmt = $pdo->prepare("INSERT INTO bbs_table (username, title, comment, postdate) VALUES(:username, :title, :comment, :postdate)");
$stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
$stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);

$stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
$stmt->bindParam(':postdate', $postdate, PDO::PARAM_STR);

$stmt->execute();