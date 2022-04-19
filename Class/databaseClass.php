<?php

// PDO Database Class
//　データベースに関するメソッドなどはこちらに記載される

class DataBase {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'todo';

    private $dbh;
    private $error;
    private $stmt; 

    public function __construct() {
        // $dsn を設定する
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $options = array (
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        // PDOインスタンスを作成する
        try {
            $this->dbh = new PDO ($dsn,$this->user,$this->pass,$options);
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    // Queryメソッドを定義する
    public function query($query) {
        $dbh = $this->dbh;
        $this->stmt = $dbh->prepare($query);
    }

    // BindValue を利用してSQL文に値を埋め込む
    public function bind($parameter, $value, $type = null) {
        if (is_null($type)) {
            // Call getBindType Function to get Type
            $type = $this->getBindType($value);
        }
        $this->stmt->bindValue($parameter,$value,$type);
    }

    // bind関数の$typeを取得するため
    public function getBindType($value) {
        $type = null;
        switch(true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default : 
                $type = PDO::PARAM_STR;
        }
        return $type;
    }

    // Execute関数を定義する
    public function execute() {
        return $this->stmt->execute();
    }

    // 結果を配列として取得する
    public function resultArray(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // 結果を初め一つ取得
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // 行の数を取得
	public function columnCount(){
		return $this->stmt->fetchColumn();
	}

    
    
}

?>