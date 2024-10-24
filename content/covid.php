<div class="col-xs-12">
    <a name="exp1"></a>
    <div class="row">
        <h3 class="era"><i class="fa fa-folder-open" aria-hidden="true"></i> <Strong>Вопросы по короновирусу</Strong></h3>
    </div>
</div>

<div class="col-xs-12 questionsPage">

<!--    <div class="col-xs-12 questionPlitka">-->
<!--        <div class="row">-->
<!--            <h3 class="questionTitleName">Задайте нам свой вопрос!</h3>-->
<!--            <a data-fancybox data-animation-duration="700" data-src="#animatedModal" href="javascript:;" class="btn btn-success btn-covid">Задать вопрос</a>-->
<!--            <div style="display: none;max-width: 600px" id="animatedModal" class="animated-modal">-->
<!--                --><?php
//                getFormQuestionCovid();
//                ?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    
<!--    <div class="col-xs-12 questionVideo">-->
<!--        <div class="row">-->
<!--            <h3 class="questionTitleName">Видео сообщения по коронавирусу:</h3>-->
<!--            <a data-fancybox href="https://youtu.be/edVfdgwn4ys">-->
<!--                <div class="col-xs-4 videoPrew">-->
<!--                    <div class="row">-->
<!--                        <iframe width="100%" height="210" src="https://www.youtube.com/embed/edVfdgwn4ys" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a><a data-fancybox href="https://youtu.be/_YuoU8EBP_s">-->
<!--                <div class="col-xs-4 videoPrew">-->
<!--                    <div class="row">-->
<!--                        <iframe width="100%" height="210" src="https://www.youtube.com/embed/_YuoU8EBP_s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a><a data-fancybox href="https://youtu.be/nkzSoQAjjnI">-->
<!--                <div class="col-xs-4 videoPrew">-->
<!--                    <div class="row">-->
<!--                        <iframe width="100%" height="210" src="https://www.youtube.com/embed/nkzSoQAjjnI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a><a data-fancybox href="https://youtu.be/Yi9kc-qrY9E">-->
<!--                <div class="col-xs-4 videoPrew">-->
<!--                    <div class="row">-->
<!--                        <iframe width="100%" height="210" src="https://www.youtube.com/embed/Yi9kc-qrY9E" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a><a data-fancybox href="https://youtu.be/cvYwFvNXAV0">-->
<!--                <div class="col-xs-4 videoPrew">-->
<!--                    <div class="row">-->
<!--                        <iframe width="100%" height="210" src="https://www.youtube.com/embed/cvYwFvNXAV0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--            <a data-fancybox href="https://youtu.be/jNDIzRzCF0A">-->
<!--                <div class="col-xs-4 videoPrew">-->
<!--                    <div class="row">-->
<!--                        <iframe width="100%" height="210" src="https://www.youtube.com/embed/jNDIzRzCF0A" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--            <a data-fancybox href="https://youtu.be/V0egPc_dR-I">-->
<!--                <div class="col-xs-4 videoPrew">-->
<!--                    <div class="row">-->
<!--                        <iframe width="100%" height="210" src="https://www.youtube.com/embed/V0egPc_dR-I" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--            <a data-fancybox href="https://youtu.be/LZXqxKSJsA0">-->
<!--                <div class="col-xs-4 videoPrew">-->
<!--                    <div class="row">-->
<!--                        <iframe width="100%" height="210" src="https://www.youtube.com/embed/LZXqxKSJsA0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->

    <div class="col-xs-6">
        <div class="row">
            <h3 class="questionTitleName">Вопросы на которые мы уже ответили:</h3>
            <?php
            $dwnQuestionFromBase = $link->query("SELECT * FROM question WHERE flag=1 ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($dwnQuestionFromBase)) {
                $questionDate = date("d.m.Y", strtotime($row[date]));
                $questionAnswer = nl2br($row[answer]);
                echo"
                    <div class='col-xs-10 questionWrapper'>
                        <h3 class='questionName col-xs-10'>$row[name]  <br><small>$row[email]</small></h3>
                       
                        <p class='text-right questionLabel col-xs-2'>Вопрос</p>
                        <div class='clearfix'></div>
                        <p class='questionDate'>$questionDate</p>
                        <p class='questionData'>$row[question]</p>
                    </div>
                ";
                if (!empty($row[answer])) {
                    echo"
                        <div class='col-xs-offset-2 col-xs-10  answerForQuestionWrapper'>
                            <p class='text-right questionLabel'>Ответ</p>
                            <h3 class='questionName'>$row[docAnswer]</h3>
                            <p class='questionAnswer'>$questionAnswer</p>
                        </div>
                    ";
                }
            }
            ?>
        </div>
    </div>

    <?php
    //Список новостей
    $news_see = mysqli_query($link, "SELECT * FROM news WHERE categories='Коронавирус' ORDER BY id DESC");
    echo "
        <div class=\"col-xs-6 news_list\">
        <h3 class='questionTitleName'>Новости о коронавирусе:</h3>    
";
    while ($row = mysqli_fetch_assoc($news_see)) {
        $newsDate = date("d.m.Y", strtotime($row[time]));
        $short_link = mb_substr($row[3], 0, 250);
        echo "
                    
            <a class='a_news' id='newsHyper' href='?page=news&news=$row[id]#exp1'>
                <div class='col-xs-12 news_bl_1'>
                    <div class='row'>
                        <div class='col-xs-3 imgNewsCovid'>
                            <div class='row'>
                            <img src='https://www.medudp.ru/img/news/little_$row[image_name]' alt='$row[title]' class='img-rounded img_news'>
                            </div>
                        </div>
                        <div class='col-xs-9'>

                            <h3 class='newsTitle'><b>$row[title]</b></h3>
                            <p class='date_line'>$newsDate</p>
                            <p class='art_bl'>$row[description]</p>
                            
                        </div>
                        <div class='clearfix'></div>
                    </div>
                </div>
            </a>
                       
            ";
    }
    echo "</div>";
    ?>

</div>