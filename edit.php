<!-- Get Header -->
<?php
    $page_title = 'ToDoアプリ｜編集';
    require_once('./inc/header.php');
    // CreateClass　呼び込む
    require_once('./Class/EditClass.php');

    $original = new OriginalClass();
    $editClass = new EditClass();

    $post_id = $original->specialCharCheck($_GET['id']);

    $column = ['title','content','created_at','updated_at'];
    $table = 'posts';
    $data[] = $post_id;

    $rec = $editClass->getData($column,$table,$data);
    
    $post_title = $rec['title'];
    $post_content = $rec['content'];

    $post_content = $original->specialCharCheck($post_content);
    $post_title = $original->specialCharCheck($post_title);
?>

<div class="todo d-flex align-items-center">
    <div class="container">
        <form action="./edit-confirm.php" method="post">
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
    require_once('./inc/footer.php');
?>