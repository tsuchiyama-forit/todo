<?php
try {
    // Access into Database Class
    $dbh = new Database();

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

    $dbh->query('SELECT count(*) FROM posts');
    $dbh->execute();
    $total_results = $dbh->columnCount();

    $total_pages = ceil($total_results/$limit);
    $starting_limit = ($pageno-1)*$limit;

    // Getting posts data
    if(isset($_POST['sort']) && $_POST['sort'] !== '') {
        $query = 'SELECT * FROM posts ORDER BY created_at '.$_POST['sort'].' LIMIT '.$starting_limit.','.$limit;
    } else {
        $query = 'SELECT * FROM posts ORDER BY id DESC LIMIT '.$starting_limit.','.$limit;
    }

    $dbh->query($query);
    $results = (array)$dbh->resultArray();

    $dbh = null;

    // For文で$resultsの中身を取り出す
    for ($i=0; $i < count($results); $i++) {
        $rec = (array)$results[$i];  // $resultsはオブジェクトであるため、配列に変化しながら代入する
        require('./todo-row.php');   // todo-row.php のテンプレートを呼び出す
        $bgFlg++;                   // Add 1 to $bgFlg(background Flag) to use it for background css if even
    }
    // For文終了
    }
    catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        var_dump($e->getMessage());
        exit();
    }

    $bgFlg = 1;
?>
                