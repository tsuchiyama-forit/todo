<form action="./" method="POST" class="pb-2">
    <select name="sort" id="sort">
        <option value="" <?php echo (!isset($_POST['sort']) || $_POST['sort'] !== '') ? 'selected' : '' ?>>ソートを選択</option>
        <option value="DESC" <?php echo ($_POST['sort'] == 'DESC') ? 'selected' : '' ?>>作成日降順</option>
        <option value="ASC" <?php echo ($_POST['sort'] == 'ASC') ? 'selected' : '' ?>>作成日昇順</option>
    </select>
    <input type="submit" value="ソート">
</form>