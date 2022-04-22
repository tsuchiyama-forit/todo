<?php

// Connect into Database Class
// This will be Parent class to Every Class

class DatabaseClass {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'todo';

    protected $dbh;
    protected $error;
    protected $stmt;

    // インスタンス化されたときにデータベースと接続する
    public function __construct() {
        // $dsn を設定する
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $options = array (
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbh = new PDO($dsn,$this->user,$this->password,$options);
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
            exit();
        }
    }

    // $this->stmt をExecuteするための関数
    public function execute($sql, $search_item = null, $data = null) {
        $this->prepareQuery($sql);
        // SearchItemがNullではなければ、SearchのためのBindをする
        if (!is_null($search_item)) {
            $this->stmt->bindValue(':search', '%'.$search_item.'%',PDO::PARAM_STR);
        }
        // DataがNullではなければそれと同時に実行する
        if (!is_null($data)) {
            $this->stmt->execute($data);
        } else {
            $this->stmt->execute();
        }
        // 配列として情報を戻す
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // stnを準備する
    public function prepareQuery($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // DB終了
    public function endDatabase() {
        $this->dbh = null;
    }

}


?>