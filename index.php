<!-- Get Header -->
<?php
    $page_title = 'ToDoアプリ｜トップページ';
    require_once('./header.php');
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
            <form action="./" method="POST" class="d-flex align-items-center col-12 col-lg-4 text-right search-form">
                <label for="search_bar" class="me-3">検索バー</label>
                <input type="text" id="search_bar" name="search_item" class="form-control w-50 me-1">
                <input type="submit" class="btn search-btn" value="検索　">
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
            // If There is Search_item Show Search Items Only
            if (isset($_POST['search_item']) || $_GET['search_item']) {
                try {

                    $search_item = htmlspecialchars($_POST['search_item']);

                    if (empty($search_item)) {
                        $search_item = htmlspecialchars($_GET['search_item']);
                    }

                    // Getting Data From DB
                    $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
                    $user = 'root';
                    $password = '';
                    $dbh = new PDO($dsn, $user, $password);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // For Pagination

                    if(isset($_GET['page_no'])) {
                        $pageno = $_GET['page_no'];
                    } else {
                        $pageno = 1;
                    }

                    $returnPage = $pageno - 1;
                    if ($returnPage == 0) {
                        $returnPage = 1;
                    }
                    $nextPage = $pageno + 1;
                    if ($nextPage == $total_pages) {
                        $nextPage = $total_pages;
                    }

                    $limit = 6;
                    $query = 'SELECT count(*) FROM posts WHERE title LIKE :search OR content LIKE :search';

                    $statement = $dbh->prepare($query);
                    $statement->bindValue(':search' , '%'.$search_item.'%',);
                    $statement->execute();
                    $total_results = $statement->fetchColumn();
                    $total_pages = ceil($total_results/$limit);

                    $starting_limit = ($pageno-1)*$limit;

                    $sql = 'SELECT * FROM posts WHERE title LIKE :search OR content LIKE :search ORDER BY id DESC LIMIT '.$starting_limit.','.$limit;
                    $stmt = $dbh->prepare($sql);
                    $stmt->bindValue(':search' , '%'.$search_item.'%',);
                    $stmt->execute();

                    $dbh = null;

                    $result = $stmt->fetchAll();
                    if ($result) { 
                        foreach ($result as $rec) {
                            ?>
                            <div class="todo-item border-bottom pt-2 pb-2 <?php echo ($bgFlg % 2 == 0) ? 'bg-light' : '' ?>">
                                <div class="row text-center align-items-center">
                                    <div class="col-4 col-lg-3 overflow-scroll"><?php echo htmlspecialchars($rec['title']); ?></div>
                                    <div class="col-4 col-lg-3 overflow-scroll"><?php echo htmlspecialchars($rec['content']); ?></div>
                                    <div class="col-4 col-lg-3 date"><?php echo ($rec['created_at'] == $rec['updated_at'])? htmlspecialchars($rec['created_at']) : htmlspecialchars($rec['updated_at']); ?>
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
                                            <a class="btn btn-danger" href="./delete.php?id=<?php echo $rec['id']; ?>&page_no=<?php echo $pageno; ?><?php echo (isset($search_item)) ? '&search_item='.$search_item : '' ?>" role="button">削除</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                                $bgFlg++;
                            }
                            // End Foreach Statement  
                    } else {
                        echo '検索値に一致するものがありません';
                    }

                } catch (Exception $e) {
                    echo '失敗しました：'. $e->getMessage();
                }
            } else {

                try {
                    // Getting Data From DB
                    $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
                    $user = 'root';
                    $password = '';
                    $dbh = new PDO($dsn, $user, $password);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // For Pagination

                    if(isset($_GET['page_no'])) {
                        $pageno = $_GET['page_no'];
                    } else {
                        $pageno = 1;
                    }

                    $returnPage = $pageno - 1;
                    if ($returnPage == 0) {
                        $returnPage = 1;
                    }
                    $nextPage = $pageno + 1;
                    if ($nextPage == $total_pages) {
                        $nextPage = $total_pages;
                    }

                    $limit = 6;
                    $query = 'SELECT count(*) FROM posts';

                    $statement = $dbh->prepare($query);
                    $statement->execute();
                    $total_results = $statement->fetchColumn();
                    $total_pages = ceil($total_results/$limit);

                    $starting_limit = ($pageno-1)*$limit;

                    // Getting posts data
                    $sql = 'SELECT * FROM posts ORDER BY id DESC LIMIT '.$starting_limit.','.$limit;
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();

                    $dbh = null;
                    // Start While Statement
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
                            <div class="col-4 col-lg-3 date"><?php echo ($rec['created_at'] == $rec['updated_at'])? htmlspecialchars($rec['created_at']) : htmlspecialchars($rec['updated_at']); ?>
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
                                    <a class="btn btn-danger" href="./delete.php?id=<?php echo $rec['id']; ?>&page_no=<?php echo $pageno; ?>" role="button">削除</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $bgFlg++;
                        }
                    // End While Statement    
                }
                catch (Exception $e) {
                    print 'ただいま障害により大変ご迷惑をお掛けしております。';
                    var_dump($e->getMessage());
                    exit();
                }

                $bgFlg = 1;
                
            }
                ?>

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
                                <textarea class="form-control" name="content" id="content-input" rows="3" required></textarea>                            
                            </div>
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
    <nav aria-label="Page navigation">
        <ul class="pagination mt-3">
        <li class='page-item <?php echo ($pageno == 1)? 'disabled' : '' ?>'><a class='page-link' href='?page_no=<?php echo $returnPage;?><?php echo (isset($search_item)) ? '&search_item='.$search_item : '' ?>'>戻る</a></li>
        <?php
        for ($counter = 1; $counter <= $total_pages; $counter++){
            if ($counter == $pageno) {
            echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";	
            }else{
                if (isset($search_item)) {
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter&search_item=$search_item'>$counter</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                }
            }
        }
        ?>
        <li class='page-item <?php echo ($pageno == $total_pages)? 'disabled' : '' ?>'><a class='page-link' href='?page_no=<?php echo $nextPage;?><?php echo (isset($search_item)) ? '&search_item='.$search_item : '' ?>'>次へ</a></li>
        </ul>
    </nav>
</div>

<!-- Get Footer -->
<?php
    require_once('./footer.php');
?>