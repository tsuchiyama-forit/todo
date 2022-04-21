<div class="sort-select-container container">
    <?php
        $sort = "";
        if (isset($_GET['sort'])) {
            $sort = $original->specialCharCheck($_GET['sort']);
        }
    ?>
    <select name="sort" id="sort_select">
        <option value="" disabled <?php echo $sort == '' ? 'selected' : '' ?>>並び替える</option>
        <option value="title" <?php echo $sort == 'title' ? 'selected' : '' ?>>タイトル</option>
        <option value="created_at" <?php echo $sort == 'created_at' ? 'selected' : '' ?>>作成日</option>
    </select>
</div>