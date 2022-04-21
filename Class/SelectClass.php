<?php
require_once('./Class/DatabaseClass.php');

class SelectClass extends DatabaseClass {

    public function selectAll($table,$order_by = null) {
        $sql = $this->createSelectQuery($table,$order_by);
        $result = $this->execute($sql,null,null);
        return $result;
    }

    public function getTotalResult($table,$order_by = null) {
        $selectAll = $this->selectAll($table,$order_by);
        $total_result = count($selectAll);
        return $total_result;
    }

    public function selectPagination($table,$order_by = null,$starting_limit,$limit) {
        $sql = $this->createSelectQuery($table,$order_by);
        $sql = $this->setSelectLimit($sql,$starting_limit,$limit);
        $result = $this->execute($sql,null,null);
        return $result;
    }

        
    public function createSelectQuery($table,$order_by) {
        $sql = 'SELECT * FROM '.$table;
        $sql = $this->setOrderBy($sql,$order_by);
        return $sql;
    }

    public function setOrderBy($sql,$order_by) {
        if ($order_by != null ) {
            $sql .= ' ORDER BY '.$order_by.' DESC';
        }
        return $sql;
    }

    public function setSelectLimit($sql,$starting_limit,$limit) {
        ($starting_limit == 0) ? $starting_limit = '0' : ''; // 0がNullとして読み込まれるため、String型に変換しました。
        if ($starting_limit != null && $limit != null) {
            $sql .= ' LIMIT '.$starting_limit.','.$limit;
        }
        return $sql;
    }

}


?>