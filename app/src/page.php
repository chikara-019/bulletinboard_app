
<?php

/*
require_once 'database.php';

$dbHandler = new Database('run-php-db', 'bbs_yt', 'root', 'root');
$pdo = $dbHandler->getPDO();

$sql = "SELECT COUNT(*) FROM bbs_table";

$stmt = $pdo->query($sql);
$totalcount = $stmt->fetchColumn(); 

$datemax = 10;
$totalpage = ceil($totalcount / $datemax);



echo "total: " . $totalcount;
echo "page" . $totalpage;
?>
*/



require_once 'database.php';

$dbHandler = new Database('run-php-db', 'bbs_yt', 'root', 'root');
$pdo = $dbHandler->getPDO();

$datemax = 5;

// 現在のページ番号、デフォルトは1
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$offset = ($current_page - 1) * $datemax;

$sql = "SELECT id, username, title, comment, postdate FROM bbs_table LIMIT :offset, :datemax";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':datemax', $datemax, PDO::PARAM_INT);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 総ページ数の計算
$sql = "SELECT COUNT(*) FROM bbs_table";
$totalcount = $pdo->query($sql)->fetchColumn();
$totalpage = ceil($totalcount / $datemax);

$sql = "SELECT id, username, title, comment, postdate FROM bbs_table";
$comment_array2 = $pdo->query($sql);


foreach ($comment_array2 as $comment) {
    echo "<p>{$comment['username']} - {$comment['comment']} - {$comment['postdate']}</p>";
}


// ページネーションリンクの表示
for ($i = 1; $i <= $totalpage; $i++) {
    if ($i == $current_page) {
        echo "<span class='current'>$i</span>";
    } else {
        echo "<a href='?page=$i'>$i</a>";
    }
}
?>
