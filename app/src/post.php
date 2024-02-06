<?php
require_once 'database.php';

$dbHandler2 = new Database('run-php-db', 'bbs_yt', 'root', 'root');
$pdo = $dbHandler2->getpdo();
date_default_timezone_set("Asia/Tokyo");

    //フォームを打ち込んだ時
    if(!empty($_POST["submitButton"])){

        $postdate = date("Y-m-d H:i:s");

        //名前チェック
        if(empty($_POST["username"])){
            echo "名前を入力してください。";
            return;
        }elseif(!preg_match('/^.{1,20}$/', $_POST["username"])){
            echo "名前は20文字以内で入力してください。";
            return;
        }

        //タイトルチェック
        if(empty($_POST["title"])){
            echo "タイトルを入力してください。";
            return;
        }elseif(!preg_match('/^.{1,30}$/', $_POST["title"])){
            echo "タイトル30文字以内で入力してください。";
            return;
        }
        //コメントチェック
        if(empty($_POST["comment"])){
            echo "コメントを入力してください。";
            return;
        }elseif(!preg_match('/^.{1,50}$/', $_POST["comment"])){
            echo "コメントは200文字以内で入力してください。";
            return;

        }else{


            try{
                $stmt = $pdo->prepare("INSERT INTO bbs_table (username, title, comment, postdate) VALUES(:username, :title, :comment, :postdate)");
                $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
                $stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
                $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
                $stmt->bindParam(':postdate', $postdate, PDO::PARAM_STR);
        
                $stmt->execute();
                
                echo "投稿完了";

            }catch(PDOException $e){
                //echo "投稿に失敗しました。". $e->getMessage();
                header('Location: index.php' . urlencode("投稿に失敗しました。" . $e->getMessage()));
                exit;
            }
        

        }

    }