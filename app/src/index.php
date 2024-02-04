<?php

    //require_once 'database.php';
    //$dbHandler = new Database('run-php-db', 'bbs_yt', 'root', 'root');
    //$pdo = $dbHandler->getPro();
    date_default_timezone_set("Asia/Tokyo");




    $comment_array = array();//配列にqueryで取得したものを入れておく
    $pdo = null;
    $stmt = null;
    $error_messages = array();
    $comment_page = 20;


    try{
        $pdo = new PDO('mysql:host=run-php-db;dbname=bbs_yt', "root", "root");

    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
    $sql = "SELECT id, username, title, comment, postdate FROM bbs_table";
    $comment_array = $pdo->query($sql);//sql文をqueryを使って問い合わせができる


    //フォームを打ち込んだ時
    if(!empty($_POST["submitButton"])){

        $postdate = date("Y-m-d H:i:s");

        //名前チェック
        if(empty($_POST["username"])){
            echo "名前を入力してください。";
        }elseif(!preg_match('/^.{1,30}$/', $_POST["username"])){
            echo "名前は30文字以内で入力してください。";
        }

        //コメントチェック
        if(empty($_POST["comment"])){
            echo "コメントを入力してください。";
        }elseif(!preg_match('/^.{1,200}$/', $_POST["comment"])){
            echo "コメントは200文字以内で入力してください。";

        }else{


            try{
                $stmt = $pdo->prepare("INSERT INTO bbs_table (username, title, comment, postdate) VALUES(:username, :title, :comment, :postdate)");
                $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
                $stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);

                $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
                $stmt->bindParam(':postdate', $postdate, PDO::PARAM_STR);
        
                $stmt->execute();
                
                echo "投稿完了いたしました。";

            }catch(PDOException $e){
                echo "投稿に失敗しました。". $e->getMessage();
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
                <lable for="username">名前：</label>
                <input type="text" name="username">
            </div>
            <!--requiredでの入力制限かけること可能-->
            <div>
                <lable for="title">タイトル：</label>
                <input type="text" name="title">
            </div>

            <div>
                <label for="comment">コメント：</label>

                <textarea class="commentTextArea" name="comment"></textarea>
            </div>
            <!--requiredでの入力制限かけること可能-->
    <div class="boardWrapper">
        <section>
            <?php foreach($comment_array as $comment): ?>
                <article>
                    <div class="wapper">
                        <div class="nameArea">
                            <span>名前：</span>
                            <p class="username"><?php echo $comment["username"]; ?></p>
                            <span>タイトル：</span>

                            <p class="username"><?php echo $comment["title"]; ?></p>
                            <time>:<?php echo $comment["postdate"]; ?></time>
                            
                        </div>
                        <p class="comment"><?php echo $comment["comment"]; ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>

                <div>
                    <?php require 'page.php';?>
                </div>   
</body>
</html>
