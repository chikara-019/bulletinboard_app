<?php
require_once 'database.php';

date_default_timezone_set("Asia/tokyo");

if(isset($_POST['deletebutton'])){
    $post_id = $_POST["deletebutton"];

    $dbHandlers = new Database('DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD');
    $pdo = $dbHandlers->getpdo();

    try{

        $stmt = $dbHandlers->getpdo()->prepare("DELETE FROM bbs_table WHERE id = :id");
        $stmt->bindParam(':id', $post_id, PDO::PARAM_INT);
        $stmt->execute();

        echo "投稿を削除しました。<br>";
        echo "<a href='index.php'>戻る</a>";
        
    }catch(PDOException $e){

        echo "投稿削除に失敗しました。" . $e->getMessage();

    }

}else{
    echo "投稿削除に失敗しました。";
    echo "<a href='index.php'>戻る</a>";

}

?>