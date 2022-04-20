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

    // When Instanced Connect into Db
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
        }
    }

    // Execute $stmt
    public function execute() {
        return $this->stmt->execute();
    }
}


?>