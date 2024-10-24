<h4 class="text-center"><strong><i class="fa fa-ambulance" aria-hidden="true"></i> Кабинет организации помощи на дому и госпитализации</strong></h4>
<div class="col-md-12 col-sm-12">
    <ul class="nav nav-tabs department_menu">
        <li class="active"><a data-toggle="tab" href="#panel1"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Об
                отделении</a></li>
        <li><a data-toggle="tab" href="#panel2"><i class="fa fa-user-md" aria-hidden="true"></i> Персонал</a></li>
        <li><a data-toggle="tab" href="#panel3"><i class="fa fa-medkit" aria-hidden="true"></i> Услуги отделения</a>
        </li>
        <li><a data-toggle="tab" href="#panel4"><i class="fa fa-picture-o" aria-hidden="true"></i> Галерея</a></li>

    </ul>

    <div class="tab-content">
        <div id="panel1" class="tab-pane fade in active informationTab">
            <img src="/img/main_departments_photo/snmp_main_photo.jpg" alt="osnmp.jpg" class="img-rounded department_logo">

            <p>Кабинет организации помощи на дому и госпитализации ФГБУ «Поликлиника № 4» оказывает медицинскую помощь при внезапных острых заболеваниях, состояниях, обострении хронических заболеваний, не опасных для жизни и не требующих экстренной медицинской помощи. (в соответствии с приказом МЗ И СР РФ от 15 мая 2012 г. N 543н «ОБ УТВЕРЖДЕНИИ ПОЛОЖЕНИЯ ОБ ОРГАНИЗАЦИИ ОКАЗАНИЯ ПЕРВИЧНОЙ МЕДИКО-САНИТАРНОЙ ПОМОЩИ ВЗРОСЛОМУ НАСЕЛЕНИЮ, приложение № 3 «ПРАВИЛА ОРГАНИЗАЦИИ ДЕЯТЕЛЬНОСТИ ОТДЕЛЕНИЯ (КАБИНЕТА) НЕОТЛОЖНОЙ МЕДИЦИНСКОЙ ПОМОЩИ ПОЛИКЛИНИКИ (ВРАЧЕБНОЙ АМБУЛАТОРИИ, ЦЕНТРА ОБЩЕЙ ВРАЧЕБНОЙ ПРАКТИКИ (СЕМЕЙНОЙ МЕДИЦИНЫ)).</p>

            <p>В составе кабинета работают врачи терапевты и педиатры оказавающие помощь на дому взрослому и детскому контингенту.</p>

            <div class="clearfix" style="border-top: solid 3px cornflowerblue"></div>
            <h3 style="margin-top: 10px;">Контакты</h3>

            <div class="col-md-6">

                <p><b>Вызов врача на дом:</b></p>
                <p>
                    8 (499) 243-72-33 (функц. кнопка 4)
                </p>


                <p><b>Телефон вызова врача для контингента относящегося к Российской Академии Наук:</b></p>
                <p>
                    8 (499) 243-78-82
                </p>

            </div>
            <div class="clearfix" style="border-bottom: solid 3px cornflowerblue"></div>
            <p></p>
            <p class="coralText">Прием вызовов по помощи на дому осуществляется с 8:00 до 12:00 часов ежедневно, кроме воскресных и праздничных дней.</p>
            <p>Обращаем Ваше внимание, что при вызове врача Вам необходимо четко отвечать на вопросы нашего диспетчера,
                четко и правильно называть свой адрес, пути наиболее удобного подъезда, а также предупреждать
                диспетчера, если рядом ведутся ремонтные и строительные работы.</p>
        </div>
        <div id="panel2" class="tab-pane fade personalTab">
            <?php givePersonalList("'Кабинет организации помощи на дому и госпитализации'", null, $link); ?>
        </div>
        <div id="panel3" class="tab-pane fade">
            <h3></h3>

            <p>
                Прием (осмотр) врача-терапевта на дому
                <br> Взятие мазка из носа на исследование
                <br> Взятие мазка из зева на исследование
                <br> Взятие материала на бактериологическое исследование
                <br> Прием (осмотр) врача-педиатра на дому
                <br> Прием (осмотр) врача-педиатра на дому второго ребенка в семье в рамках одного выезда
            </p>

        </div>
        <div id="panel4" class="tab-pane fade">

            <div class="col-xs-12 gallery">
                <?php
                $home = $_SERVER['DOCUMENT_ROOT'];
                $dir = $home . "/departments/osnmp/gallery";
                $images = scandir($dir);
                $images = array_values(array_filter($images, function ($e) {
                    return $e != (".") and $e != ("..");
                }));

                for ($i = 0; $i < count($images); $i++) {
                    echo "
                        <a data-fancybox='gallery' href='/departments/osnmp/gallery/$images[$i]'>
                            <img src='/departments/osnmp/gallery/$images[$i]' class='img-rounded galleryImgTab' alt='$i'>
                        </a>
                        ";
                }
                ?>
            </div>


        </div>
    </div>
</div>