<!-- Get Header -->
<?php
    $page_title = 'ToDoアプリ｜トップページ';
    require_once('./header.php');
?>

<div class="todo d-flex align-items-center">
    <div class="container border">
        <!-- New ToDo Button Modal -->
        <div class="d-flex justify-content-center pt-3 pb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-Todo">
                ToDo 新規作成
            </button>
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
            <!-- これはFor文で回し、DBから情報取得する -->
            <div class="todo-item border-bottom pt-2 pb-2">
                <div class="row text-center align-items-center">
                    <div class="col-4 col-lg-3">清掃</div>
                    <div class="col-4 col-lg-3">トイレとお風呂を清掃する</div>
                    <div class="col-4 col-lg-3">2021年12月25日</div>
                    <div class="col-12 col-lg-3 content-buttons d-flex justify-content-between">
                        <div class="col-6 edit-col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-Todo">
                            編集
                        </button>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-primary" href="./delete.php" role="button">削除</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="todo-item border-bottom pt-2 pb-2">
                <div class="row text-center align-items-center">
                    <div class="col-4 col-lg-3">清掃</div>
                    <div class="col-4 col-lg-3">トイレとお風呂を清掃する</div>
                    <div class="col-4 col-lg-3">2021年12月25日</div>
                    <div class="col-12 col-lg-3 content-buttons d-flex justify-content-between">
                        <div class="col-6 edit-col">
                            <a class="btn btn-primary" href="#" role="button">編集</a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-primary" href="#" role="button">削除</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- For文終了 -->
        </div>
        <!-- ToDo 新規作成 Modal -->
        <div class="modal fade" id="new-Todo" tabindex="-1" aria-labelledby="new-TodoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="new-TodoLabel">ToDo新規作成</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="./create.php" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title-input" class="form-label">タイトル</label>
                                <input type="text" name="title" id="title-input" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="content-input" class="form-label">内容</label>
                                <textarea class="form-control" id="content-input" rows="3"></textarea>                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                            <button type="submit" class="btn btn-primary new-submit">送信</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ToDo　編集　Modal -->
        <div class="modal fade" id="edit-Todo" tabindex="-1" aria-labelledby="new-TodoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="new-TodoLabel">ToDo編集</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="./create.php" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title-input" class="form-label">タイトル</label>
                                <input type="text" name="title" id="title-input" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="content-input" class="form-label">内容</label>
                                <textarea class="form-control" id="content-input" rows="3"></textarea>                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                            <button type="submit" class="btn btn-primary new-submit">送信</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Get Footer -->
<?php
    require_once('./footer.php');
?>