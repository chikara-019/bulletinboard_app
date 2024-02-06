<?php

require_once 'define.php';
    //データベースとの接続を管理するdatabaseクラス定義
    class Database{
        //private外部からのアクセス制限
        private $pdo;

        private $host;
        private $dbname;
        private $user;
        private $password;


        public function __construct($host, $dbname, $user, $password){

            $this->host = DB_HOST;
            $this->dbname = DB_NAME;
            $this->user = DB_USER;
            $this->password = DB_PASSWORD;


            try{
                $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //接続okだと＄pdoに接続時に使用される情報が代入
            }catch(PDOException $e){
                echo "失敗しました。". $e->getMessage();
                //接続に失敗した際はPDOExceptionエラー詳細情報が確認できる
                //$e->getMessage()
            }
        }
        //ここの処理がインスタンス化されると呼ばれる
        //引数はデータベースとの接続に必要な情報

        public function getpdo(){
            return $this->pdo;
            //クラス内のプラベートメンバ変数の値を取得
        }
    }
?>

