<!-- Get Header -->
<?php
    $page_title = 'ToDoアプリ｜新規作成';
    require_once('./header.php');
?>
<?php

// タイトルは５０文字超えるとDBに保存しない
if (strlen($_POST['title']) > 50 ) {
?>
    <div class="container">
        <div class="d-flex justify-content-center flex-column align-items-center mt-5">
            <h1>タイトルの文字数が多すぎます。減らしてください。</h1><br>
            <button type="button" class="btn btn-danger w-50" onclick="history.back()">戻る</button>
        </div>
    </div>
<?php
exit();
}

// タイトルと内容が空欄の場合
if ($_POST['title'] == ' ' || $_POST['content'] == ' ' ) {
?>
    <div class="container">
        <div class="d-flex justify-content-center flex-column align-items-center mt-5">
            <h1>タイトルと内容欄を正しく記入してください！</h1><br>
            <button type="button" class="btn btn-danger w-50" onclick="history.back()">戻る</button>
        </div>
    </div>
<?php
exit();
}


try {

    $post_title = $_POST['title'];
    $post_content = $_POST['content'];
    
    $post_title = htmlspecialchars($post_title,ENT_QUOTES,'UTF-8');
    $post_content = htmlspecialchars($post_content,ENT_QUOTES,'UTF-8');

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

<!-- Get Footer -->
<?php
    require_once('./footer.php');
?>