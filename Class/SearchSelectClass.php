<?php
require_once('./Class/SelectClass.php');

class SearchSelectClass extends SelectClass {

    // Getパラメターに使いたいため、いつでも呼び出せるため
    private $searchItem;

    // 検索値があるときにそれに基づき情報を取得する
    public function SearchSelect($table, $order_by = null, $where, $starting_limit, $limit, $search_item) {
        (isset($search_item)) ? $this->searchItem = $search_item : '';
        $query = $this->setSearchQuery($table, $order_by, $where, $starting_limit, $limit);
        $result = $this->execute($query,$search_item);
        return $result;
    }

    // 検索値ありのSQL文を作成する
    public function setSearchQuery($table, $order_by, $where, $starting_limit, $limit) {
        $sql = 'SELECT * FROM '.$table.' WHERE ';
            foreach($where as $key => $where_value) {
                $sql .= $where_value.' LIKE :search ';
                // 最後のForeachにはORを付けないための判定
                ($key != count($where)-1) ? $sql .= 'OR ' : '';
            }
        $sql = $this->setOrderBy($sql,$order_by);
        $sql = $this->setSelectLimit($sql,$starting_limit,$limit);
        return $sql;
    }

    //　検索値に当てはまっている件数を取得する関数
    public function getTotalSearchResult($table,$order_by = null,$where,$starting_limit,$limit,$search_item) {
        $results = $this->SearchSelect($table,$order_by,$where,$starting_limit,$limit,$search_item);
        $total_result = count($results);
        return $total_result;
    }

    // 外に$searchItemをできるため
    public function getSearchItem() {
        return $this->searchItem;
    }

}


?>