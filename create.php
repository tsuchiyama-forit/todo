<?php

// OrignalClass 呼び込む
require_once('./Class/OriginalClass.php');

$original = new OrginalClass();

$post_title = $_POST['title'];
$post_content = $_POST['content'];

$post_title = $original->specialCharCheck($post_title);
$post_content = $original->specialCharCheck($post_content);

if ($original->newTitleLengthCheck($post_title)) {
    require_once('./inc/titleTooLongError.php');
    exit();
}

// タイトルと内容が空欄の場合
if ($original->checkEmpty($post_title) || $original->checkEmpty($post_content) ) {
    require_once('./inc/noContentsError.php');
    exit();
}


try {

    $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO posts (title,content) VALUES (?,?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $post_title;
    $data[] = $post_content;
    $stmt->execute($data);

    $dbh = null;

    header('Location: ./index.php');

} catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>
