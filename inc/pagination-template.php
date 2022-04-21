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