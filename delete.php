<?php
// DeleteClass　呼び込む
require_once('./Class/DeleteClass.php');
// OriginalClass 呼び込む
require_once('./Class/OriginalClass.php');

$original = new OriginalClass();
$deleteClass = new DeleteClass();

$post_id = $_GET['id'];
$page_no = $_GET['page_no'];
if (isset($_GET['search_item'])) {
    $search_item = $original->specialCharCheck($_GET['search_item']);
}


$deleteClass->deletePost($post_id);

if (isset($_GET['search_item'])) {
    header("Location: ./index.php?page_no=$page_no&search_item=$search_item");    
} else {
    header("Location: ./index.php?page_no=$page_no");
}


?>