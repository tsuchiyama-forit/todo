<?php

$search_item = $original->specialCharCheck($_POST['search_item']);

if (empty($search_item)) {
    $search_item = $original->specialCharCheck($_GET['search_item']);
}

// For Pagination

($returnPage == 0) ? $returnPage = 1 : ''; // If ReturnPage is 0 Make Its Value into 1
($nextPage == $total_pages) ? $nextPage = $total_pages : ''; // If NextPage is Equal to TotalPages Turn Its Value into TotalPages Value

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
        $rec['created_at'] = strtotime($rec['created_at']);
        $rec['updated_at'] = strtotime($rec['updated_at']);
        require('./inc/todo-row-template.php');
        $bgFlg++;
    endfor;
} else {
    echo '検索値に一致するものがありません';
    exit;
}

?>