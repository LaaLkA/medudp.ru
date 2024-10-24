<div class="col-md-12 col-sm-12">
    <a name="exp1"></a>
    <div class="row">
        <h3 class="era"><i class="fas fa-bomb"></i> <Strong>Специальные предложения</Strong></h3>
    </div>
</div>


<!--<div class="col-md-12 col-sm-12 stock_page doc_page">-->
<!--    <div class="row">-->
<!--        <div class="col-sm-12 col-md-12">-->
            <h3></h3>

<?php
    $doc_see=mysqli_query($link, "SELECT * FROM complexProgramm ORDER BY title ASC");
    while ($row = mysqli_fetch_row($doc_see)) {
        echo "<div class=\"col-sm-12 col-md-12 special_plitka doc_page1\">
                <div class=\"row\">
                    <h3>$row[1]</h3>
                    <p>$row[2]</p>
                    <a class=\"pull-left url_s\" href=\"documents/Программы/$row[3]\" target=\"_blank\">
                        <div class=\"media media_block_style\">
                            <div class=\"media-left media-middle\">
                                <i class=\"fa fa-file-pdf-o pdf_s\" aria-hidden=\"true\"></i>
                            </div>
                            <div class=\"media-body\">
                                <p class='doc_name'>$row[4]</p>
                            </div>
                        </div>
                    </a>";
        if(!empty($row[5])) {
            echo "<a class=\"pull - left url_s\" href=\"documents/Программы/$row[5]\" target=\"_blank\">
                        <div class=\"media media_block_style\">
                            <div class=\"media-left media-middle\">
                                <i class=\"fa fa-file-pdf-o pdf_s\" aria-hidden=\"true\"></i>
                            </div>
                            <div class=\"media-body\">
                                <p class='doc_name'>$row[6]</p>
                            </div>
                        </div>
                    </a>";
        }
        echo "</div>
            </div>";
    }
?>





<!--        </div>-->
<!--    </div>-->
<!--</div>-->