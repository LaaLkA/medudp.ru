<div class="row">
    <h4 class="det_otd_content_title text-center"><b>Детское отделение</b></h4>
</div>

<div class="thumb-wrap">
    <iframe width="720" height="405" src="https://rutube.ru/play/embed/eeb6e9bb26e713a48fd42f2ee9983c50" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
</div>

<div class="col-sm-12">
    <div class="row">
        <p></p>
        <p class="det_main_text">Детское отделение ФГБУ «Поликлиника №4» является мощным комплексным лечебно-диагностическим подразделением поликлиники, оно располагается в отдельно стоящем корпусе и объединяет в себе отделения: педиатрии с помощью на дому и неотложной помощью детям, отделение специализированной педиатрической медицинской помощи, медицинской реабилитации и отделение детской стоматологии.</p>
        <!--        <img class="det_otd_department_logo" src="img/det/main.jpg" alt="Детский корпус ФГБУ 'Поликлиника №4'">-->
        <p></p>
        <p class="det_main_text">Режим работы детского отделения: Пн-Пт: 8.00 - 20.00, Сб: 8.00 - 14.00, Вс: 9.00 - 15.00</p>
        <p class="det_main_text">В течение всей рабочей недели, опытные врачи педиатры и врачи специалисты, всегда Вас примут и окажут необходимую помощь, при невозможности к нам приехать, Вашему ребенку окажут помощь на дому.</p>
    </div>
</div>

<div class="col-xs-12">
    <div class="row">
        <h4 class="det_otd_content_title text-center">Последние новости детского отделения</h4>
        <div class="col-md-12 col-sm-12 news_list">
            <div class="row">
                <div class="col-md-12 col-sm-12 news_lent">
                    <div class="row">
                        <?php

                        $news_see = mysqli_query($link, "SELECT * FROM news WHERE det_marker='1' ORDER BY id DESC LIMIT 5
                            ");
                        while ($row = mysqli_fetch_assoc($news_see)) {
                            $newsDate = date("d.m.Y", strtotime($row['time']));
                            $short_link = mb_substr($row[2], 0, 500);
                            echo "
                                <a class='a_news' href='?page=news&news=$row[id]#exp1'>
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
                                    
                                </div>
                            </a>
                ";
                        }

                        ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>