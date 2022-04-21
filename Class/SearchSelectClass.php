<?php
require_once('./Class/SelectClass.php');

class SearchSelectClass extends SelectClass {

    private $searchItem;

    public function SearchSelect($table, $order_by = null, $where, $starting_limit, $limit, $search_item) {
        (isset($search_item)) ? $this->searchItem = $search_item : '';
        $query = $this->setSearchQuery($table, $order_by, $where, $starting_limit, $limit);
        $result = $this->execute($query,$search_item);
        return $result;
    }

    public function setSearchQuery($table, $order_by, $where, $starting_limit, $limit) {
        $sql = 'SELECT * FROM '.$table.' WHERE ';
            foreach($where as $key => $where_value) {
                $sql .= $where_value.' LIKE :search ';
                ($key != count($where)-1) ? $sql .= 'OR ' : '';
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

    public function getSearchItem() {
        return $this->searchItem;
    }

}


?>