<?php


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

        public function getpdo(){
            return $this->pdo;
            //クラス内のプラベートメンバ変数の値を取得
        }



        
    }


?>