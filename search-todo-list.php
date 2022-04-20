<?php
try {

    $search_item = htmlspecialchars($_POST['search_item']);

    if (empty($search_item)) {
        $search_item = htmlspecialchars($_GET['search_item']);
    }

    // Access into Database Class
    $dbh = new Database();

    // For Pagination

    if(isset($_GET['page_no'])) {
        $pageno = $_GET['page_no'];
    } else {
        $pageno = 1;
    }

    $returnPage = $pageno - 1;
    $nextPage = $pageno + 1;
    $limit = 6;

    ($returnPage == 0) ? $returnPage = 1 : ''; // If ReturnPage is 0 Make Its Value into 1
    ($nextPage == $total_pages) ? $nextPage = $total_pages : ''; // If NextPage is Equal to TotalPages Turn Its Value into TotalPages Value

    $query = 'SELECT count(*) FROM posts WHERE title LIKE :search OR content LIKE :search';

    $dbh->query($query);
    $dbh->bind(':search','%'.$search_item.'%',null);
    $dbh->execute();

    $total_results = $dbh->columnCount(); // Get Results Column
    $total_pages = ceil($total_results/$limit);
    $starting_limit = ($pageno-1)*$limit;

    $sql = 'SELECT * FROM posts WHERE title LIKE :search OR content LIKE :search ORDER BY id DESC LIMIT '.$starting_limit.','.$limit;

    $dbh->query($sql);
    $dbh->bind(':search','%'.$search_item.'%',null);
    $results = (array)$dbh->resultArray();

    $dbh->endDatabase();

    if ($results) { 
        // For文で$resultsの中身を取り出す
        for ($i=0; $i < count($results); $i++) {
            $rec = (array)$results[$i];  // $resultsはオブジェクトであるため、配列に変化しながら代入する
            require('./todo-row.php');   // todo-row.php のテンプレートを呼び出す
            $bgFlg++;                   // Add 1 to $bgFlg(background Flag) to use it for background css if even
        }
        // For文終了
    } else {
        echo '検索値に一致するものがありません';
    }

} catch (Exception $e) {
    echo '失敗しました：'. $e->getMessage();
}

?>