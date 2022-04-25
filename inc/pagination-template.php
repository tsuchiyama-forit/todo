<?php

if (isset($search_item)) {
    $link .= '&search_item='.$search_item;
}
if ($sort != '') {
    $link .= '&sort='.$sort;
}

?>

<nav aria-label="Page navigation">
    <ul class="pagination mt-3">
    <li class='page-item <?php echo ($page_no == 1)? 'disabled' : '' ?>'><a class='page-link' href='?page_no=<?php echo $returnPage.$link;?><?php echo (isset($search_item)) ? '&search_item='.$search_item : '' ?>'>戻る</a></li>
    <?php 
    if ($page_no == 1): //１だったら１引かれているPageNoを表示しない
    else:
    ?>
        <li class='page-item'><a class='page-link' href='?page_no=<?php echo ($page_no -1).$link ;?>'><?php echo $page_no - 1 ?></a></li>
    <?php endif; ?>

    <li class='page-item active'><a class='page-link' href='?page_no=<?php echo $page_no.$link;?>'><?php echo $page_no?></a></li>

    <!-- TotalPage よりページが小さいときに＋１のページを表示 （例　$totalPage = 6; 6+1=7 ７になっているため、７ページにいくとデータがない)-->
    <?php if ($total_pages > $page_no) : ?>
        <li class='page-item'><a class='page-link' href='?page_no=<?php echo ($page_no + 1).$link;?>'><?php echo $page_no + 1 ?></a></li>
    <?php endif; ?>

    <!-- PageNoが１のとき３ページを表示させるため -->
    <?php if ($page_no == 1):?>
        <li class='page-item'><a class='page-link' href='?page_no=<?php echo ($page_no + 2).$link;?>'><?php echo $page_no + 2 ?></a></li>
    <?php endif; ?>

    <li class='page-item <?php echo ($page_no == $total_pages)? 'disabled' : '' ?>'><a class='page-link' href='?page_no=<?php echo $nextPage.$link;?><?php echo (isset($search_item)) ? '&search_item='.$search_item : '' ?>'>次へ</a></li>
    </ul>
</nav>