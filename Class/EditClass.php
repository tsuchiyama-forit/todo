<?php
// Call Database Class
require_once('./Class/DatabaseClass.php');

class EditClass extends DatabaseClass {

    // Select分で今編集使用とするところのみの情報を取得する
    public function getData($column,$table,$data) {
        $sql = 'SELECT ';
        foreach($column as $key => $value) {
            $sql .= $value;
            if ($key < count($column)-1) { $sql .= ','; } //$key が0から始まるためCountに１を引きます。　ex.) $key = 3 count($column) = 4-1;
            $sql .= ' ';
        }
        $sql .= 'FROM '.$table.' WHERE id = ?';

        $results = $this->execute($sql,null,$data);
        return $results[0];
    }

    // UpdateでPostの情報を編集する関数
    public function updateData($column,$table,$data) {
        $sql = 'UPDATE '.$table.' SET ';
        foreach($column as $key => $value) {
            $sql .= $value.'=?';
            //  最後のForeachにコンマをつけないようにIf分岐で最後なのかを判断する
            if ($key < count($column)-1) { $sql .= ','; } //$key が0から始まるためCountに１を引きます。　ex.) $key = 3 count($column) = 4-1;
            $sql .= ' ';
        }
        $sql .= 'WHERE id = ?';
        $results = $this->execute($sql,null,$data);
    }

}

?>