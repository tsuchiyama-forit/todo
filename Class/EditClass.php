<?php
// Call Database Class
require_once('./Class/DatabaseClass.php');

class EditClass extends DatabaseClass {

    // Select分で今編集使用とするところのみの情報を取得する
    public function getData($column,$table,$data) {
        $sql = 'SELECT ';
        $sql = $this->querySetColumn($sql,$column,'select');
        $sql .= 'FROM '.$table.' WHERE id = ?';
        $results = $this->execute($sql,null,$data);
        return $results[0];
    }

    // UpdateでPostの情報を編集する関数
    public function updateData($column,$table,$data) {
        $sql = $this->getUpdateQuery($column,$table);
        $results = $this->execute($sql,null,$data);
    }

    public function getUpdateQuery($column,$table) {
        $sql = 'UPDATE '.$table.' SET ';
        $sql = $this->querySetColumn($sql,$column,'update');
        $sql .= 'WHERE id = ?';
        return $sql;
    }

    public function querySetColumn($sql,$column,$type) {
        foreach($column as $key => $value) {
            $sql .= $value;
            if ($type == 'update') { $sql .= '=?'; }
            //  最後のForeachにコンマをつけないようにIf分岐で最後なのかを判断する
            if ($key < count($column)-1) { $sql .= ','; } //$key が0から始まるためCountに１を引きます。　ex.) $key = 3 count($column) = 4-1;
            $sql .= ' ';
        }
        return $sql;
    }

}

?>