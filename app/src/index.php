<?php


    date_default_timezone_set("Asia/Tokyo");
    $comment_array = array();
    //arry=配列
    //ただの変数だと1つしか入らないのにたいし、配列であれば複数対応可能 
    //echo $_POST["submitButton"]. "<br>";
    $pdo = null;
    $stmt = null;
    //データベースとの接続を管理するdatabaseクラスを定義
    class Database{
        //privateで外部からのアクセスを制限
        private $pdo;

        public function __construct($host, $dbname, $user, $password){
            try{
                $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //接続が成功するとpdoに接続の際に使用される情報が代入
            }catch(PDOException $e){
                echo 'Connection failed:'. $e->getMessage();
                //接続に失敗した際はPDOExceptionエラー詳細情報が確認できる
            }
        }
        //ここの処理がインスタンス化されると呼ばれる
        //引数はデータベースとの接続に必要な情報

        public function getPro(){
            return $this->pdo;
            //クラス内のプラベートメンバ変数の値を取得
        }
    }

    $dbHandler = new Database('run-php-db', 'bbs_yt', 'root', 'root');
    $pdo = $dbHandler->getPro();

    /*try{
        $pdo = new PDO('mysql:host=run-php-db;dbname=bbs_yt', "root", "root"); 
    }catch(PDOException $e) {
            echo $e->getMessage();
    }*/

    //フォームを打ち込んだ時
    if(!empty($_POST["submitButton"])){


        //名前のバリデーションチェック
        if(empty($_POST["username"])){
            echo "名前を入力してください。";
            exit;
        }
        
        if(empty($_POST["comment"])){
            echo "本文を入力してください。";
            //echo "<script>document.querySelector('.commentTextArea').value = '名前を入力してください。';</script>";
            exit;
        }

        $postdate = date("Y-m-d H:i:s");

        try{
    
            // 17行目のコードを以下のように修正します。
            //$stmt = $pdo->prepare("INSERT INTO bbs_table ('username', 'comment', 'postdate') VALUES (:username, :comment, :postdate)");
            $stmt = $pdo->prepare("INSERT INTO `bbs_table` (`username`, `comment`, `postdate`) VALUES(:username, :comment, :postdate);");
            $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
            $stmt->bindParam(':comment', $_POST["comment"], PDO::PARAM_STR);
            $stmt->bindParam(':postdate', $postdate, PDO::PARAM_STR);

            $stmt->execute();
            echo "投稿が完了しました。";
        }catch(PDOException $e){

            echo $e->getMessage();
        }



    }

    //echo $_POST["username"]. "<br>";
    //echo $_POST["comment"];


    //DBからコメントデータを取得する
    $sql = $sql = "SELECT id, username, comment, postdate FROM bbs_table";

    //sql文で、query関数を呼ぶことで問い合わせができるようになる。
    $comment_array = $pdo->query($sql);
    //$comment_arrayの中にデータベースの情報を保存しておくことができる→htmlで出力
    //DBの接続を閉じる
    $pdo = null;

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
    <div class="boardWrapper">
        <section>
            <?php foreach($comment_array as $comment): ?>
                <article>
                    <div class="wapper">
                        <div class="nameArea">
                            <span>名前：</span>
                            <p class="username"><?php echo $comment["username"]; ?></p>
                            <time>:<?php echo $comment["postdate"]; ?></time>
                            
                        </div>
                        <p class="comment"><?php echo $comment["comment"]; ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
        <form class="formWrapper" method="POST">
            <div>
                <input type="submit" value="書き込む" name="submitButton">
                <lable for="">名前：</label>
                <input type="text" name="username">
            </div>
            <div>
                <textarea class="commentTextArea" name="comment"></textarea>


</body>
</html>
