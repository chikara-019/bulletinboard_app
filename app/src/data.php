
<?php

require_once 'database.php';

$dbHandler = new Database('DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD');
$pdo = $dbHandler->getpdo();

$datemax = 20;

// デフォルト1
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$offset = ($current_page - 1) * $datemax;

$sql = "SELECT id, username, title, comment, postdate FROM bbs_table ORDER BY postdate DESC LIMIT :offset, :datemax";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':datemax', $datemax, PDO::PARAM_INT);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

//var_dump($comments);

?>
