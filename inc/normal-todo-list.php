<?php

    // For Pagination

    if(isset($_GET['page_no'])) {
        $pageno = $_GET['page_no'];
    } else {
        $pageno = 1;
    }

    $table = 'posts';
    $order_by = 'id';
    $limit = 6;

    $returnPage = $pageno - 1;
    $nextPage = $pageno + 1;

    ($returnPage == 0) ? $returnPage = 1 : ''; // If ReturnPage is 0 Make Its Value into 1
    ($nextPage == $total_pages) ? $nextPage = $total_pages : ''; // If NextPage is Equal to TotalPages Turn Its Value into TotalPages Value

    $total_results = $selectClass->getTotalResult($table,$order_by);
    $total_pages = ceil($total_results/$limit);
    $starting_limit = ($pageno-1)*$limit;
    
    $results = $selectClass->selectPagination($table,$order_by,$starting_limit,$limit);

    //  For文の中身を取り出す
    for ($i=0; $i < count($results); $i++):
        $rec = (array)$results[$i];
        require('./inc/todo-row-template.php');
        $bgFlg++;
    endfor;

?>