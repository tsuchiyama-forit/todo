<!-- Get Header -->
<?php
    $page_title = 'ToDoアプリ｜編集';
    require_once('./header.php');

    try {
        $post_id = $_GET['id'];

        $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = 'SELECT title,content,created_at FROM posts WHERE id = ?';
        $stmt = $dbh->prepare($sql);
        $data[] = $post_id;
        $stmt->execute($data);
    
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $post_title = $rec['title'];
        $post_content = $rec['content'];

        $post_content = htmlspecialchars($post_content,ENT_QUOTES,'UTF-8');
        $post_title = htmlspecialchars($post_title,ENT_QUOTES,'UTF-8');

        $dbh = null;
    

    }
    catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
    }

?>

<div class="todo d-flex align-items-center">
    <div class="container">
        <form action="./edit-done.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <div class="mb-3">
                    <label for="title-input" class="form-label">タイトル</label>
                    <input type="text" name="title" id="title-input" class="form-control" required value="<?php echo $post_title; ?>">
                </div>
                <div class="mb-3">
                    <label for="content-input" class="form-label">内容</label>
                    <textarea class="form-control" name="content" id="content-input" rows="3" required><?php echo $post_content; ?></textarea>                            
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary me-3" onclick="history.back()">戻る</button>
                    <button type="submit" class="btn btn-primary new-submit ms-3">送信</button>
                </div>
        </form>
    </div>
</div>

<!-- Get Footer -->
<?php
    require_once('./footer.php');
?>