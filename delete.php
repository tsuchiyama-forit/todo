<?php

try {
  
    $post_id = $_GET['id'];
    $page_no = $_GET['page_no'];
    if (isset($_GET['search_item'])) {
        $search_item = $_GET['search_item'];
    }

    $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'DELETE FROM posts WHERE id = ?';
    $stmt = $dbh->prepare($sql);
    $data[] = $post_id;
    $stmt->execute($data);

    $dbh = null;

    if (isset($_GET['search_item'])) {
        header("Location: ./index.php?page_no=$page_no&search_item=$search_item");    
    } else {
        header("Location: ./index.php?page_no=$page_no");
    }

} catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>