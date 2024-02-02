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
?>