<?php

$search_item = $original->specialCharCheck($_POST['search_item']);

if (empty($search_item)) {
    $search_item = $original->specialCharCheck($_GET['search_item']);
}

// For Pagination

if(isset($_GET['page_no'])) {
    $pageno = $_GET['page_no'];
} else {
    $pageno = 1;
}

$returnPage = $pageno - 1;
$nextPage = $pageno + 1;

($returnPage == 0) ? $returnPage = 1 : ''; // If ReturnPage is 0 Make Its Value into 1
($nextPage == $total_pages) ? $nextPage = $total_pages : ''; // If NextPage is Equal to TotalPages Turn Its Value into TotalPages Value

$table = 'posts';
$order_by = 'id';
$where = ['title','content'];
$limit = 6;
$starting_limit = ($pageno-1)*$limit;

$total_results = $selectClass->getTotalSearchResult($table,null,$where,null,null,$search_item);
$total_pages = ceil($total_results/$limit);

// $result = $stmt->fetchAll();
$result = $selectClass->SearchSelect($table,$order_by,$where,$starting_limit,$limit,$search_item);

if (count($result) != 0) { 
    //  For文の中身を取り出す
    for ($i=0; $i < count($result); $i++):
        $rec = (array)$result[$i];
        require('./inc/todo-row-template.php');
        $bgFlg++;
    endfor;
} else {
    echo '検索値に一致するものがありません';
    exit;
}

?>