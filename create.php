<?php
// CreateClass　呼び込む
require_once('./Class/CreateClass.php');
// OrignalClass 呼び込む
require_once('./Class/OriginalClass.php');

$original = new OriginalClass();
$createClass = new CreateClass();

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

$createClass->insertPost($post_title,$post_content);
header('Location: ./index.php');

?>
