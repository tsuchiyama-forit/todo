<?php
    require_once('./Class/OriginalClass.php');
    require_once('./Class/SearchSelectClass.php');

    // すべてのクラスをインスタンス化します
    // SelectClass インスタンス
    $selectClass = new SearchSelectClass();
    $original = new OriginalClass();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet">
    <title><?php echo $page_title; ?></title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid justify-content-center">
            <a class="navbar-brand text-light" href="./">ToDoアプリケーション</a>
        </div>
        </nav>
    </header>