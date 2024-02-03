<?php
// index.php

date_default_timezone_set("Asia/Tokyo");

require_once 'database.php';
require_once 'page.php';

$comment_array = array();

try {
    $pdo = new PDO('mysql:host=run-php-db;dbname=bbs_yt', "root", "root");
} catch (PDOException $e) {
    echo $e->getMessage();
}

$sql = "SELECT id, username, comment, postdate FROM bbs_table";
$comment_array = $pdo->query($sql);

// フォームを打ち込んだ時
if (!empty($_POST["submitButton"])) {
    $postdate = date("Y-m-d H:i:s");

    // 名前チェック
    if (empty($_POST["username"])) {
        echo "名前を入力してください。";
    } elseif (!preg_match('/^.{1,30}$/', $_POST["username"])) {
        echo "名前は30文字以内で入力してください。";
    }

    // コメントチェック
    if (empty($_POST["comment"])) {
        echo "コメントを入力してください。";
    } elseif (!preg_match('/^.{1,200}$/', $_POST["comment"])) {
        echo "コメントは200文字以内で入力してください。";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO bbs_table (username, comment, postdate) VALUES(:username, :comment, :postdate)");
            $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
            $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
            $stmt->bindParam(':postdate', $postdate, PDO::PARAM_STR);

            $stmt->execute();

            echo "投稿完了いたしました.";

        } catch (PDOException $e) {
            echo "投稿に失敗しました." . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP掲示板</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 class="title">掲示板</h1>
    <hr>
    <form class="formWrapper" method="POST">
        <div>
            <input type="submit" value="投稿する" name="submitButton">
        </div>
        <div>
            <label for="username">名前：</label>
            <input type="text" name="username">
        </div>
        <!--requiredでの入力制限かけること可能-->
        <div>
            <label for="title">タイトル：</label>
            <input type="text" name="title">
        </div>

        <div>
            <label for="comment">コメント：</label>
            <textarea class="commentTextArea" name="comment"></textarea>
        </div>

        <!-- コメントの表示 -->
        <div class="boardWrapper">
            <section>
                <?php displayComments($comments); ?>
            </section>
        </div>

        <!-- ページネーションリンクの表示 -->
        <div
        class="pagination">
                <?php
                for ($i = 1; $i <= $totalpage; $i++) {
                    if ($i == $current_page) {
                        echo "<span class='current'>$i</span>";
                    } else {
                        echo "<a href='?page=$i'>$i</a>";
                    }
                }
                ?>
            </div>
        </form>
    </body>

</html>
    
