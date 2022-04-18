<?php

try {
  
    $post_id = $_GET['id'];

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

    header('Location: ./index.php');

} catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>