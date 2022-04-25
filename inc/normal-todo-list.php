<?php

    // For Pagination

    // SelectClassでgetTotalResult関数を呼び出し、レコードの件数を取得
    $total_results = $selectClass->getTotalResult($table,$order_by);
    // マックスページを取得する 2.2の場合3にするため、情報ミスなどがありません
    $total_pages = ceil($total_results/$limit);

    ($returnPage == 0) ? $returnPage = 1 : ''; // ０ページに行かないように０になったら、１にする
    ($nextPage == $total_pages) ? $nextPage = $total_pages : ''; // NextPageが実際のページより超えないため、同じ値になれば、$total_pageと同じにする
    
    // SelectClassでselectPagination関数を呼び出し、LimitのあるSQLでレコードを配列として取得する
    $results = $selectClass->selectPagination($table,$order_by,$starting_limit,$limit,$arrange);

    //  For文の中身を取り出す
    for ($i=0; $i < count($results); $i++):
        $rec = $results[$i];
        $rec['created_at'] = strtotime($rec['created_at']);
        $rec['updated_at'] = strtotime($rec['updated_at']);
        require('./inc/todo-row-template.php');
        $bgFlg++;
    endfor;

?>