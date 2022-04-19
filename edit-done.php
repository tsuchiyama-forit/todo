<?php

try {
    $post_id = $_POST['post_id'];
    $post_title = $_POST['title'];
    $post_content = $_POST['content'];

    $post_title = htmlspecialchars($post_title,ENT_QUOTES,'UTF-8');
    $post_content = htmlspecialchars($post_content,ENT_QUOTES,'UTF-8');

    $post_id = (int)$post_id;

    $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $today = date("Y-m-d");

    $sql = 'UPDATE posts SET title=?, content=?, updated_at=?, edit_flg=? WHERE id = ?';
    $stmt = $dbh->prepare($sql);

    $data[] = $post_title;
    $data[] = $post_content;
    $data[] = $today;
    $data[] = 1;
    $data[] = $post_id;

    $stmt->execute($data);

    $dbh = null;

    header('Location: ./index.php');

}   catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
}

?>