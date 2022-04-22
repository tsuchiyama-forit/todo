<nav aria-label="Page navigation">
    <ul class="pagination mt-3">
    <li class='page-item <?php echo ($page_no == 1)? 'disabled' : '' ?>'><a class='page-link' href='?page_no=<?php echo $returnPage;?><?php echo (isset($search_item)) ? '&search_item='.$search_item : '' ?>'>戻る</a></li>
    <?php
    $link = '';
    for ($counter = 1; $counter <= $total_pages; $counter++)
    {
        $link = '?page_no='.$counter;
        if ($counter == $page_no) {
        echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";	
        }else{
            if (isset($search_item)) {
                $link .= '&search_item='.$search_item;
            }
            if ($sort != '') {
                $link .= '&sort='.$sort;
            }
            echo "<li class='page-item'><a class='page-link' href='$link'>$counter</a></li>";
        }
    }
    ?>
    <li class='page-item <?php echo ($page_no == $total_pages)? 'disabled' : '' ?>'><a class='page-link' href='?page_no=<?php echo $nextPage;?><?php echo (isset($search_item)) ? '&search_item='.$search_item : '' ?>'>次へ</a></li>
    </ul>
</nav>