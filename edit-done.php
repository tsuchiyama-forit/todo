<?php
$page_title = 'ToDoアプリ｜編集終了';
require_once('./inc/header.php');
require_once('./Class/EditClass.php');

$editClass = new EditClass();

$post_id = $_POST['post_id'];
$post_title = $_POST['title'];
$post_content = $_POST['content'];

$post_id = $original->specialCharCheck($post_id);
$post_content = $original->specialCharCheck($post_content);
$post_title = $original->specialCharCheck($post_title);


$today = date("Y-m-d");

$column = [
    'title',
    'content',
    'updated_at',
    'edit_flg'
];

$table = 'posts';

$data[] = $post_title;
$data[] = $post_content;
$data[] = $today;
$data[] = 1;
$data[] = $post_id;

$editClass->updateData($column,$table,$data);

header('Location: ./index.php');


?>