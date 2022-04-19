<?php
try {

    $search_item = htmlspecialchars($_POST['search_item']);

    if (empty($search_item)) {
        $search_item = htmlspecialchars($_GET['search_item']);
    }

    // Getting Data From DB
    $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // For Pagination

    if(isset($_GET['page_no'])) {
        $pageno = $_GET['page_no'];
    } else {
        $pageno = 1;
    }

    $returnPage = $pageno - 1;
    if ($returnPage == 0) {
        $returnPage = 1;
    }
    $nextPage = $pageno + 1;
    if ($nextPage == $total_pages) {
        $nextPage = $total_pages;
    }

    $limit = 6;
    $query = 'SELECT count(*) FROM posts WHERE title LIKE :search OR content LIKE :search';

    $statement = $dbh->prepare($query);
    $statement->bindValue(':search' , '%'.$search_item.'%',);
    $statement->execute();
    $total_results = $statement->fetchColumn();
    $total_pages = ceil($total_results/$limit);

    $starting_limit = ($pageno-1)*$limit;

    $sql = 'SELECT * FROM posts WHERE title LIKE :search OR content LIKE :search ORDER BY id DESC LIMIT '.$starting_limit.','.$limit;
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':search' , '%'.$search_item.'%',);
    $stmt->execute();

    $dbh = null;

    $result = $stmt->fetchAll();

    if ($result) { 
        foreach ($result as $rec) {
            require('./todo-row.php'); // Get todo-row.php Contents
            $bgFlg++; // 偶数の数字に背景色がつくように
        }
            // End Foreach Statement  
    } else {
        echo '検索値に一致するものがありません';
    }

} catch (Exception $e) {
    echo '失敗しました：'. $e->getMessage();
}

?>