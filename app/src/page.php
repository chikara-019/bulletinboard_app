
<?php

require_once 'database.php';

$dbHandler = new Database('DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD');
$pdo = $dbHandler->getpdo();

$datemax = 20;

// デフォルト1
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$offset = ($current_page - 1) * $datemax;



//var_dump($comments);

$sql = "SELECT COUNT(*) FROM bbs_table";
$totalcount = $pdo->query($sql)->fetchColumn();
$totalpage = ceil($totalcount / $datemax);


// ページネーションリンクの表示
for ($i = 1; $i <= $totalpage; $i++) {
    if ($i == $current_page) {
        echo "<span class='current'>$i</span>";
    } else {
        echo "<a href='?page=$i'>$i</a>";
    }
}
?>
