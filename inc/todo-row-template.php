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