<?php
    $page_title = 'ToDoアプリ｜編集確認';
    require_once('./inc/header.php');

    if (isset($_POST['post_id'])) {
        
        $post_id = $_POST['post_id'];
        $post_title = $_POST['title'];
        $post_content = $_POST['content'];

        $post_id = $original->specialCharCheck($post_id);
        $post_content = $original->specialCharCheck($post_content);
        $post_title = $original->specialCharCheck($post_title);

    ?>

        <div class="container">
            <form action="edit-done.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">タイトル</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo $post_title; ?>" readonly="readonly">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">内容</label>
                    <textarea class="form-control" name="content" id="content" rows="3" readonly="readonly"><?php echo trim($post_content); ?></textarea>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary me-3" onclick="history.back()">戻る</button>
                    <button type="submit" class="btn btn-primary new-submit ms-3">送信</button>
                </div>
            </form>
        </div>

    <?php
    } else {
        header('Location: ./');
    }

?>