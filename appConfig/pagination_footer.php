<div class="d-block text-center card-footer">
    <h6 class="my-text" style="text-align: left;">Pages</h6>
    <nav class="" aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item my-text"><a href="javascript:void(0);" class="page-link my-text" aria-label="Previous"><span aria-hidden="true" class="my-text">«</span><span class="sr-only my-text">Previous</span></a></li>
            <?php
            // display the links to the pages
            for ($pageNumber=1;$pageNumber<=$number_of_pages;$pageNumber++) {
                echo '<li class="page-item my-text"><form action="'.$BASEURL.'?page='.$page.'&pageNumber=' . $pageNumber . '" method="post">'
                    . '<button name="btn-upload" class="page-link my-text" type="submit" id="btn-upload">' . $pageNumber . '</button></form></li>';
                ?>
                </li>
            <?php } ?>
            <li class="page-item my-text"><a href="javascript:void(0);" class="page-link my-text" aria-label="Next" ><span aria-hidden="true" class="my-text">»</span><span class="sr-only my-text">Next</span></a></li>
        </ul>
    </nav>
</div>