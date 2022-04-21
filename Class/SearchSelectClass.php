<?php
require_once('./Class/SelectClass.php');

class SearchSelectClass extends SelectClass {

    public function SearchSelect($table, $order_by = null, $where, $starting_limit, $limit, $search_item) {
        $query = $this->setSearchQuery($table, $order_by, $where, $starting_limit, $limit);
        $this->prepareQuery($query);
        $this->stmt->bindValue(':search', '%'.$search_item.'%',PDO::PARAM_STR);
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function setSearchQuery($table, $order_by, $where, $starting_limit, $limit) {
        $sql = 'SELECT * FROM '.$table.' WHERE ';
        if (count($where) > 1) {
            foreach($where as $key => $where_value) {
                $sql .= $where_value.' LIKE :search ';
                ($key % 2 == 0) ? $sql .= 'OR ' : '';
            }
        }
        $sql = $this->setOrderBy($sql,$order_by);
        $sql = $this->setSelectLimit($sql,$starting_limit,$limit);
        return $sql;
    }


    public function getTotalSearchResult($table,$order_by = null,$where,$starting_limit,$limit,$search_item) {
        $results = $this->SearchSelect($table,$order_by,$where,$starting_limit,$limit,$search_item);
        $total_result = count($results);
        return $total_result;
    }

}


?>