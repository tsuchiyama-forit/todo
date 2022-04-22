<?php

$search_item = $original->specialCharCheck($_POST['search_item']);

if (empty($search_item)) {
    $search_item = $original->specialCharCheck($_GET['search_item']);
}

// For Pagination

// Page_noのGetパラメターがあればそれを取得、なければ１にする
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

// SelectClassでgetTotalSearchResult関数を呼び出しWhere条件ありでレコードの件数を取得
$total_results = $selectClass->getTotalSearchResult($table,null,$where,null,null,$search_item);
$total_pages = ceil($total_results/$limit);

// SelectClassでSearchSelect関数を呼び出しWhere条件ありでレコードを配列として取得
$result = $selectClass->SearchSelect($table,$order_by,$where,$starting_limit,$limit,$search_item);

// 検索値と一致するものがないかを判定
if (count($result) != 0) { 
    //  For文の中身を取り出す
    for ($i=0; $i < count($result); $i++):
        $rec = $result[$i];
        require('./inc/todo-row-template.php');
        $bgFlg++;
    endfor;
} else {
    echo '検索値に一致するものがありません';
    exit;
}

?>