<div class="col-xs-12 p_serv_main">
    <a name="exp1"></a>
    <div class="row">


        <h3 class="era"><i class="fas fa-dollar-sign"></i> <Strong>Прейскурант услуг</Strong></h3>

        <div class="clearfix"></div>


        <div class="col-xs-12 price__wrapper">
            <div class="col-xs-2 paidTelNumber">Скачать полный прейскурант платных услуг:</div>
            <div class="fullPriceDownload">
                <div class="text-center">
                    <a data-fancybox data-type='iframe' data-src='/documents/doc/price.pdf' href='javascript:;'><i class="fas fa-download"></i> Прейскурант.pdf</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 paidTelNumber1"><span class="normal--text">WhatsApp кабинета платных услуг:</span> 8 (910) 460-6017</div>

            <div class="col-xs-12 search">
                <div class="search_item search_back">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input id="paidSearch" type="text" placeholder="Поиск" class="paidSearch" name="searchName" maxlength="100">
                </div>
                <div class="search_item">
                    <button id="paidSearchButtons" class="search_paid_buttons">Найти</button>
                </div>
            </div>




            <div class="clearfix"></div>



            <div class="clearfix"></div>
            <div class="col-xs-12" id="content_div" style="background-color: white; border-radius: 5px;">
                <p id="searchInfo">Загрузка прейскуранта...</p>
            </div>

            <div class="clearfix"></div>
            <div class="btn_block">
                <button class="firstPagNumber">
                    <- Предыдущая страница</button>
                        <div class="kolPrisePosition">...</div>
                        <button class="lastPagNumber">Следующая страница -></button>
            </div>
        </div>


        <div class="clearfix"></div>
        <h3 class="era"><i class="far fa-file-alt"></i> <Strong>Документы</Strong></h3>

        <div class="col-xs-12 documentPageWarapper">
            <div class="row">
                <div class="col-xs-12 documentsPage">
                    <?php
                    $getAllCategories = $link->query("SELECT DISTINCT categories FROM documents WHERE categories = 'Предоставление платных услуг' ORDER BY categories ASC ");
                    while ($docCategories = mysqli_fetch_row($getAllCategories)) {
                        echo "<h3 class='nameDocCategories'>$docCategories[0]</h3>";
                        $getDocuments = $link->query("SELECT * FROM documents WHERE categories ='{$docCategories[0]}' ORDER BY docName ASC");
                        while ($docInformation = mysqli_fetch_assoc($getDocuments)) {
                            $dataDocument = date("d.m.Y", strtotime($docInformation['docDate']));
                            echo "
                                <div class='oneDocWrapper'>

                                <div class='col-xs-12 docDateStroke'><div class='row'>Документ</div></div>
            
                                    <div class='docTitle col-xs-12'>$docInformation[docName]</div>
                                    <div class='col-xs-12 docDateStroke'><div class='row'>от $dataDocument</div></div>
            
                                    <div class='col-xs-12 docDateStroke'><div class='row'> $docInformation[extension], $docInformation[filesize]</div></div>
            
                                    <div class='col-xs-4'>
                                        <div class='row'>
                                            <a class='dwnButton' href='/documents/doc/$docInformation[filepath]' target='_blank'>Скачать</a>
                                            </div>
                                        </div>
                                    <div class='col-xs-5'>
                                        <div class='row'>
                                            <a class='viewButton' data-fancybox data-type='iframe' data-src='/documents/doc/$docInformation[filepath]' href='javascript:;'>Просмотреть</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                ";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <a name="exp2"></a>
        <h3 class="era"><i class="fas fa-bomb"></i> <Strong>Специальные предложения</Strong></h3>
        <div class="complexProgramsCards">


            <?php
            $doc_see = mysqli_query($link, "SELECT * FROM complexProgramm ORDER BY id");
            while ($row = mysqli_fetch_row($doc_see)) {
                echo "<div class='col-xs-12 programCard'>
                    <div class='programCard__badge'>Комплексная программа</div>
                    
                    <h3 class='programCard__title'>$row[1]</h3>
                    
                    <div class='programCard__notification'>Любую программу можно преобрести отдельно</div>
                    <a class=\"pull-left doc_name\" data-fancybox data-type='iframe' data-src='/documents/Программы/$row[3]' href='javascript:;'>   
                        Подробнее
                    </a>";
                    //<a name=\"exp1{$row[0]}\"></a>
                    // <p class='programCard__article'>$row[2]</p>
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

    </div>
</div>