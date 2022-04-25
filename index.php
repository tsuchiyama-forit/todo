<!-- Get Header（クラスなどはHeaderに呼び込みとインスタンスされちる -->
<!-- 
    持っている情報
    DatabaseClass,SelectClass,SearchSelectClassの
    クラスは $selectClass　でアクセス可能です。
-->
<?php
    $page_title = 'ToDoアプリ｜トップページ';
    require_once('./inc/header.php');
?>
<div class="todo d-flex align-items-center flex-column justify-content-center">
    <div class="container border">
        <!-- New ToDo Button Modal -->
        <div class="row justify-content-between pt-3 pb-3">
            <div class="col-12 col-lg-4 d-flex align-items-center">
                <button type="button" class="btn btn-primary bg-dark border-dark col-6" data-bs-toggle="modal" data-bs-target="#new-Todo">
                    ToDo 新規作成
                </button>
                <!-- Require Sort Template -->
                <?php require_once('./inc/sort-template.php'); ?>
            </div>
            <form action="./" method="POST" class="d-flex justify-content-end align-items-center col-12 col-lg-4 text-right search-form">
                <label for="search_bar" class="me-3">検索バー</label>
                <input type="text" id="search_bar" name="search_item" class="form-control w-50 me-1">
                <input type="submit" class="btn search-btn" value="検索">
            </form>
        </div>
        <div class="todo-lists">
            <!-- ToDo List Title -->
            <div class="table-title row text-center border">
                <div class="col-4 col-lg-3">タイトル</div>
                <div class="col-4 col-lg-3">内容</div>
                <div class="col-4 col-lg-3">作成日時</div>
                <div class="col-12 col-lg-3 d-flex justify-content-between title-buttons">
                    <div class="col-6 edit-col">編集</div>
                    <div class="col-6">削除</div>
                </div>
            </div>

            <?php
            // Page_noのGetパラメターがあればそれを取得、なければ１にする
            if(isset($_GET['page_no'])) {
                $page_no = $_GET['page_no'];
            } else {
                $page_no = 1;
            }

            $returnPage = $page_no - 1;
            $nextPage = $page_no + 1;

                // GetパラメターでSortがあればOrderbyそれによって変える
            if (isset($_GET['sort'])) {
                $order_by = $_GET['sort'];
            }

            if ($order_by === 'title') {
                $arrange = ' ASC';
            } else {
                $arrange = null;
            }

            $table = 'posts';
            $order_by = 'id';
            $limit = 6;
            $starting_limit = ($page_no-1)*$limit;

            $where = ['title','content']; // Use Only for Searching Item

            //  SearchItemがあるかないを判定する（それにより違うテンプレートを呼び出す）
            if (isset($_POST['search_item']) || $_GET['search_item']) {
                require_once('./inc/search-todo-list.php');
            } else {
                require_once('./inc/normal-todo-list.php');
            }
            ?>

        </div>
        <!-- ToDo 新規作成 Modal -->
        <?php require_once('./inc/new-modal-template.php'); ?>
    </div>
    <div class="title mt-3">
        <h2><?php echo ($selectClass->getSearchItem() != null) ?  $original->specialCharCheck($selectClass->getSearchItem()).'の検索結果': 'すべてのToDoリスト' ?></h2>
    </div>
    <?php require_once('./inc/pagination-template.php'); ?>
</div>

<!-- Get Footer -->
<?php
    require_once('./inc/footer.php');
?>