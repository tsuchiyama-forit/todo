<?php
// DatabaseClass を呼び込む
require_once('DatabaseClass.php');

class SelectClass extends DatabaseClass {

    public function selectAll($table,$order_by = null) {
        $sql = 'SELECT * FROM '.$table;
        if ($order_by != null ) {
            $sql .= ' ORDER BY '.$order_by.' DESC';
        }
        $this->stmt = $this->dbh->prepare($sql);
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTotalResult($table,$order_by = null) {
        $selectAll = $this->selectAll($table,$order_by);
        $total_result = count($selectAll);
        return $total_result;
    }

    public function selectPagination($table,$order_by = null,$starting_limit,$limit) {
        $sql = 'SELECT * FROM '.$table;
        if ($order_by != null ) {
            $sql .= ' ORDER BY '.$order_by.' DESC';
        }
        $sql .= ' LIMIT '.$starting_limit.','.$limit;
        $this->stmt = $this->dbh->prepare($sql);
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

}


?>