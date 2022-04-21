<?php
// Call Database Class
require_once('./Class/DatabaseClass.php');

class EditClass extends DatabaseClass {

    public function getData($column,$table,$data) {
        $sql = 'SELECT ';
        foreach($column as $key => $value) {
            $sql .= $value;
            if ($key < count($column)-1) { $sql .= ','; } //$key が0から始まるためCountに１を引きます。　ex.) $key = 3 count($column) = 4-1;
            $sql .= ' ';
        }
        $sql .= 'FROM '.$table.' WHERE id = ?';

        $this->prepareQuery($sql);
        $this->WithDataExecute($data);
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateData($column,$table,$data) {
        $sql = 'UPDATE '.$table.' SET ';
        foreach($column as $key => $value) {
            $sql .= $value.'=?';
            //  最後のForeachにコンマをつけないようにIf分岐で最後なのかを判断する
            if ($key < count($column)-1) { $sql .= ','; } //$key が0から始まるためCountに１を引きます。　ex.) $key = 3 count($column) = 4-1;
            $sql .= ' ';
        }
        $sql .= 'WHERE id = ?';
        $this->prepareQuery($sql);
        $this->WithDataExecute($data);
    }

}

?>