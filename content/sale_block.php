<div class="col-md-12 col-sm-12">
    <a name="exp1"></a>
    <div class="row">
        <a href="?page=paid_services#exp2" class="era_a">
            <h3 class="era"><i class="fas fa-bomb"></i> <Strong>Специальные предложения</Strong></h3>
        </a>
    </div>
</div>


<!--<div class="col-md-12 col-sm-12 stock_page doc_page">-->
<!--    <div class="row">-->
<!--        <div class="col-sm-12 col-md-12">-->
<h3></h3>

<div class="col-xs-12 sale_block_container">
    <div class="row">
        <div class="complexProgramsCards">
            <?php
            $doc_see = mysqli_query($link, "SELECT * FROM complexProgramm ORDER BY id DESC LIMIT 6");
            while ($row = mysqli_fetch_row($doc_see)) {
                echo "<div class='col-xs-12 programCard'>
                <div class='programCard__badge'>Комплексная программа</div>
                
                <h3 class='programCard__title'>$row[1]</h3>
                
                <div class='programCard__notification'>Любую программу можно преобрести отдельно</div>
                <a class=\"pull-left doc_name\" data-fancybox data-type='iframe' data-src='/documents/Программы/$row[3]' href='javascript:;'>   
                    Подробнее
                </a>";
                    //<a name=\"exp1{$row[0]}\"></a>
                    //<p class='programCard__article'>$row[2]</p>
                // if (!empty($row[5])) {
                //     echo "<br><a class=\"pull-left doc_name\" data-fancybox data-type='iframe' data-src='/documents/Программы/$row[5]' href='javascript:;'>   
                //        <i class=\"fa fa-file-pdf-o\" aria-hidden=\"true\"></i> $row[5]
                //     </a>";
                // }
                echo "
            </div>";
            }
            ?>
        </div>
        <div class="clearfix"></div>
        <!--        <a class="btnSaleBlock col-xs-offset-5 col-xs-3" href="?page=paid_services#exp2">Все предложения</a>-->
    </div>
</div>

<!--<div class="col-xs-12 sale_block">-->
<!--    <div class="row">-->
<!--        <div class="col-xs-9">-->
<!--            <h1>Специальные предложения к началу учебного года!</h1>-->
<!--            <ul>-->
<!--                <li><strong>Комплексная программа "Идем в детский сад"</strong></li>-->
<!--                <li><strong>Комплексная программа "Здравствуй школа"</strong></li>-->
<!--                <li><strong>Комплексная программа "Поступаем в ВУЗ"</strong></li>-->
<!--                <li><strong>Программы комплексного осмотра детей</strong></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <a href="?page=stock#exp1">-->
<!--            <div class="col-xs-3">-->
<!--                <p class="text-center">Узнайте все <br> подробности прямо <br> сейчас!</p>-->
<!--            </div>-->
<!--        </a>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="clearfix"></div>-->