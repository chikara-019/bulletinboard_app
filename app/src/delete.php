<?php
/*
echo "aaaaa<br>";
echo "aaaaa<br>";
echo "aaaaa<br>";
echo "aaaaa<br>";
echo "aaaaa<br>";
*/



require_once 'database.php';


date_default_timezone_set("Asia/tokyo");

if(isset($_POST['deletebutton'])){
    $post_id = $_POST["deletebutton"];

    $dbHandlers = new Database('run-php-db', 'bbs_yt', 'root', 'root');
    $pdo = $dbHandlers->getpdo();

    $stmt = $dbHandlers->getpdo()->prepare("DELETE FROM bbs_table WHERE id = :id");
    $stmt->bindParam(':id', $post_id, PDO::PARAM_INT);
    $stmt->execute();

    echo "投稿削除完了しました。";
    echo "<a href='index.php'>戻る</a>";

}

?>