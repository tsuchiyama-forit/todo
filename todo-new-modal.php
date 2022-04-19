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