<?php

    // For Pagination
    // Page_noのGetパラメターがあればそれを取得、なければ１にする
    if(isset($_GET['page_no'])) {
        $pageno = $_GET['page_no'];
    } else {
        $pageno = 1;
    }

    $table = 'posts';
    $order_by = 'id';
    $limit = 6;

    // GetパラメターでSortがあればOrderbyそれによって変える
    if (isset($_GET['sort'])) {
        $order_by = $_GET['sort'];
    }

    $returnPage = $pageno - 1;
    $nextPage = $pageno + 1;

    // SelectClassでgetTotalResult関数を呼び出し、レコードの件数を取得
    $total_results = $selectClass->getTotalResult($table,$order_by);
    // マックスページを取得する 2.2の場合3にするため、情報ミスなどがありません
    $total_pages = ceil($total_results/$limit);
    $starting_limit = ($pageno-1)*$limit;

    ($returnPage == 0) ? $returnPage = 1 : ''; // ０ページに行かないように０になったら、１にする
    ($nextPage == $total_pages) ? $nextPage = $total_pages : ''; // NextPageが実際のページより超えないため、同じ値になれば、$total_pageと同じにする
    
    // SelectClassでselectPagination関数を呼び出し、LimitのあるSQLでレコードを配列として取得する
    $results = $selectClass->selectPagination($table,$order_by,$starting_limit,$limit);

    //  For文の中身を取り出す
    for ($i=0; $i < count($results); $i++):
        $rec = $results[$i];
        require('./inc/todo-row-template.php');
        $bgFlg++;
    endfor;

?>