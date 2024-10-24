<div class="col-xs-12 ">
    <a name="exp1"></a>
    <div class="row">
        <a href="?page=news#exp1" class="era_a"><h3 class="era"><i class="far fa-newspaper"></i> <Strong>НОВОСТИ</Strong>
            </h3></a>
    </div>
</div>




            <?php
                //Конкретная новость
                if (isset ($_GET["news"])) {
                    $id_news = nullControl($link,$_GET['news']);
                    $one_news_see = mysqli_query($link, "SELECT * FROM news WHERE id=$id_news");
                    while ($row = mysqli_fetch_assoc($one_news_see)) {
                        $newsBody = nl2br($row[article]);
                        $newsDate = date("d.m.Y", strtotime($row[time]));
                        echo "
                            <div class=\"col-xs-12 news_list\">
                                <div class=\"row\">
                                    <div class='col-xs-12 news_lent'>
                                        <div class='col-xs-6 newsBodyWrapper'>
                                            <h3 class='oneNewsTitle'><b>$row[title]</b></h3>
                                                <p class='date_line'>$newsDate</p>
                                            <p class='newsBody'>$newsBody</p>
                                        </div>
                                        
                                        <div class='col-xs-6'>
                                            <div class='row'>
                                                <img src='https://www.medudp.ru/img/news/little_$row[image_name]' alt='$row[title]' style='width:100%;' class='newsTitleImg'><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                } else {
                    //Список новостей
                    $news_see = mysqli_query($link, "SELECT * FROM news ORDER BY id DESC LIMIT 10");
                    echo "
                    <div class=\"col-xs-12 news_list\">
                        <div class=\"col-xs-12 containerNews\">
                    ";
                    while ($row = mysqli_fetch_assoc($news_see)) {
                        $newsDate = date("d.m.Y", strtotime($row[time]));
                        $short_link = mb_substr($row[3], 0, 250);
                        echo "
                    
                            <a class='a_news' id='newsHyper' href='?page=news&news=$row[id]#exp1'>
                                <div class='col-xs-12 news_bl_1'>
                                    
                                        <div class='col-xs-3'>
                                            <div class='row'>
                                            <img src='https://www.medudp.ru/img/news/little_$row[image_name]' alt='$row[title]' class='img-rounded img_news'>
                                            </div>
                                        </div>
                                        <div class='col-xs-9'>
            
                                            <h3 class='newsTitle'><b>$row[title]</b></h3>
                                            <p class='date_line'>$newsDate</p>
                                            
                                            
                                        </div>
                                        <div class='clearfix'></div>
                                    
                                </div>
                            </a>
                        
                        ";
                    }
                    echo "
                    </div>
                        <div class='col-xs-12 text-center'>
                            <button id='moreNewsButton'>Показать еще</button>
                        </div>
                    </div>
                    
                    ";
                }
            ?>



<?php

?>