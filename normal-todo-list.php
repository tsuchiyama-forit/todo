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
    $nextPage = $pageno + 1;
    $limit = 6;

    ($returnPage == 0) ? $returnPage = 1 : ''; // If ReturnPage is 0 Make Its Value into 1
    ($nextPage == $total_pages) ? $nextPage = $total_pages : ''; // If NextPage is Equal to TotalPages Turn Its Value into TotalPages Value


    $dbh->query('SELECT count(*) FROM posts');
    $dbh->execute();
    $total_results = $dbh->columnCount();

    $total_pages = ceil($total_results/$limit);
    $starting_limit = ($pageno-1)*$limit;

    // Getting posts data (If There is Sort change Order By Value)
    if(isset($_POST['sort']) && $_POST['sort'] !== '') {
        $query = 'SELECT * FROM posts ORDER BY created_at '.$_POST['sort'].' LIMIT '.$starting_limit.','.$limit;
    } else {
        $query = 'SELECT * FROM posts ORDER BY id DESC LIMIT '.$starting_limit.','.$limit;
    }

    $dbh->query($query);
    $results = (array)$dbh->resultArray();

    $dbh->endDatabase();

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
                