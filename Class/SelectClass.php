<?php
require_once('./Class/DatabaseClass.php');

// DatabaseClassを継承します
class SelectClass extends DatabaseClass {

    // $tableにあるすべての情報を取得する関数
    public function selectAll($table,$order_by = null) {
        $sql = $this->createSelectQuery($table,$order_by);
        $result = $this->execute($sql,null,null);
        return $result;
    }

    // $tableにあるすべての件数を取得する関数
    public function getTotalResult($table,$order_by = null) {
        $selectAll = $this->selectAll($table,$order_by);
        $total_result = count($selectAll);
        return $total_result;
    }

    // LIMITのあるSQL文を作成、それを配列として戻す関数
    public function selectPagination($table,$order_by = null,$starting_limit,$limit,$arrange = null) {
        $sql = $this->createSelectQuery($table,$order_by,$arrange);
        $sql = $this->setSelectLimit($sql,$starting_limit,$limit);
        $result = $this->execute($sql,null,null);
        return $result;
    }

    // SELECTのSQL文を作成する
    public function createSelectQuery($table,$order_by,$arrange = null) {
        $sql = 'SELECT * FROM '.$table;
        $sql = $this->setOrderBy($sql,$order_by,$arrange);
        return $sql;
    }

    // ORDERが設定されていれば、それをSQL文に追加する
    public function setOrderBy($sql,$order_by,$arrange) {
        (is_null($arrange)) ? $arrange = ' DESC' : $arrange = $arrange;
        if ($order_by != null ) {
            $sql .= ' ORDER BY '.$order_by.$arrange;
        }
        return $sql;
    }

    // LIMITをSQL文に追加する関数
    public function setSelectLimit($sql,$starting_limit,$limit) {
        ($starting_limit == 0) ? $starting_limit = '0' : ''; // 0がNullとして読み込まれるため、String型に変換しました。
        if ($starting_limit != null && $limit != null) {
            $sql .= ' LIMIT '.$starting_limit.','.$limit;
        }
        return $sql;
    }

}


?>