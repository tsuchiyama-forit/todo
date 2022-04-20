<!-- Get Header -->
<?php
    $page_title = 'ToDoアプリ｜トップページ';
    require_once('./header.php');
    require_once('./Class/databaseClass.php'); // Get Database Class into Index
?>

<div class="todo d-flex align-items-center flex-column justify-content-center">
    <div class="container border">
        <!-- New ToDo Button Modal -->
        <div class="row justify-content-between pt-3 pb-3">
            <div class="col-12 col-lg-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-Todo">
                    ToDo 新規作成
                </button>
            </div>
            <!-- 検索フォーム -->
            <form action="./" method="POST" class="d-flex align-items-center col-12 col-lg-4 text-right search-form">
                <label for="search_bar" class="me-3">検索バー</label>
                <input type="text" id="search_bar" name="search_item" class="form-control w-50 me-1">
                <input type="submit" class="btn search-btn" value="検索">
            </form>
        </div>
        <div class="todo-lists">
            <!-- ToDo List Title -->
            <?php require_once('todo-list-title.php'); ?>

            <?php
            // search_item　パラメータがあるのか判定する
            if (isset($_POST['search_item']) || $_GET['search_item']) {
                // With Search Item Todo List
                require('./search-todo-list.php');
            } else {
                // Without Search Item Todo List
                require('./normal-todo-list.php');
            }
                ?>

        </div>
            <?php require('./sort-bar.php'); ?>      <!-- Sort.php　呼び出す -->
        <?php require('./todo-new-modal.php'); ?>    <!-- ToDo 新規作成 Modal -->
    </div>  <!-- Container 終了  -->
    <?php require('./pagination.php'); ?>    <!-- Pagination呼び出す -->
</div>
<!-- Get Footer -->
<?php require_once('./footer.php'); ?>