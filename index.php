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
            <?php

            try {
                $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = 'SELECT * FROM posts WHERE 1 ORDER BY id DESC';
                $stmt = $dbh->prepare($sql);
                $stmt->execute();

                $dbh = null;

                $bgFlg = 1;

                while(true) {
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($rec == false) {
                        break;
                    }
            ?>

            <div class="todo-item border-bottom pt-2 pb-2 <?php echo ($bgFlg % 2 == 0) ? 'bg-light' : '' ?>">
                <div class="row text-center align-items-center">
                    <div class="col-4 col-lg-3 overflow-scroll"><?php echo htmlspecialchars($rec['title']); ?></div>
                    <div class="col-4 col-lg-3 overflow-scroll"><?php echo htmlspecialchars($rec['content']); ?></div>
                    <div class="col-4 col-lg-3 date"><?php echo htmlspecialchars($rec['created_at']); ?>
                        <?php
                            if($rec['edit_flg'] == 1) {
                                echo '<br><small class="edited-sign">編集済み</small>';
                            }
                        ?>
                    </div>
                    <div class="col-12 col-lg-3 content-buttons d-flex justify-content-between">
                        <div class="col-6 edit-col">
                            <a class="btn btn-success" href="./edit.php?id=<?php echo $rec['id']; ?>" role="button">編集</a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-danger" href="./delete.php?id=<?php echo $rec['id']; ?>" role="button">削除</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                $bgFlg++;
                }
            }
            catch (Exception $e) {
                print 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

            ?>
            <?php

            ?>
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
                                <input type="text" name="title" id="title-input" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="content-input" class="form-label">内容</label>
                                <textarea class="form-control" name="content" id="content-input" rows="3" required></textarea>                            </div>
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