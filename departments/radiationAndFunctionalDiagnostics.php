<h4 class="text-center"><strong>Отделение лучевой и функциональной диагностики</strong></h4>
<div class="col-xs-12">
    <ul class="nav nav-tabs department_menu">
        <li class="active"><a data-toggle="tab" href="#panel1"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Об отделении</a></li>
        <li><a data-toggle="tab" href="#panel2"><i class="fa fa-user-md" aria-hidden="true"></i> Персонал</a></li>
        <li><a data-toggle="tab" href="#panel4"><i class="fa fa-picture-o" aria-hidden="true"></i> Галерея</a></li>
    </ul>

    <div class="tab-content">
        <div id="panel1" class="tab-pane fade in active terap informationTab informationTab">
            <h1 class="departmentTitle">Отделение лучевой и функциональной диагностики</h1>

            <div class="col-xs-12">
                <div class="row">
                    <!-- <h3 class="departmentSubTitle">Общая информация</h3> -->
                    <p>В отделении объединены
                        <a class="urlGreen" href="?page=department_page&department_name=roentgen#exp1"><b>рентгеновские</b></a>,
                        <a class="urlGreen" href="?page=department_page&department_name=ultrasound#exp1"><b>ультразвуковые</b></a> и
                        <a class="urlGreen" href="?page=department_page&department_name=functional#exp1"><b>функциональные</b></a> методы исследования, что позволяет оперативно пройти комплексное обследование и получить максимально полное и достоверное диагностическое заключение, подобрать оптимальный диагностический алгоритм для решения конкретных задач. Отделение оснащено оборудованием фирмы «Siemens», «Philips», «GE», «SCHILLER». Медицинский персонал имеет большой опыт работы, владеет всеми современными методами диагностики. Данные рентгеновских, многих функциональных исследований хранятся в электронном виде, что позволяет проводить оценку выявленных изменений в динамике и копировать изображения на пленку, бумагу, диск в любое время.
                    </p>
                    
                </div>
            </div>

            <div class="col-xs-12 videoContainer">
                <div class="row">
                    <div class="thumb-wrap">
                        <iframe width="720" height="405" src="https://rutube.ru/play/embed/eaf5d2cd13a9b10baf3e03cfe2ef6501" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                    </div>
                </div>
            </div>

            <img class="img-rounded department_logo" src="/img/poster_rehab.jpg" alt="постер лучевая" width="100%">
            
            <p>Сегодня доступ к информации кажется безграничным, и, казалось бы, вопросы своего здоровья можно решить самостоятельно. Но когда дело доходит до диагностики и лечения, важно помнить:<b> учитывая множество факторов, от клинической картины до сопутствующих заболеваний, вид исследования и его необходимый объем может определить только врач.</b></p>

            <p>Согласно приказам Минздрава России №560н, №557н, №997н <b>для назначения рентгенологического, ультразвукового и функционального исследований требуется направление от лечащего врача.</b> Это не просто формальность, а необходимость, направленная на обеспечение нашей безопасности, а что касается рентгенологических исследование это обеспечивает избегание ненужной лучевой нагрузки. Ведь каждое исследование должно быть оправдано и целенаправленно вести к уточнению диагноза или выбору метода лечения.</p>

            <p><b>Лечащий врач играет ключевую роль в организации вашего обследования и лечения, и он в первую очередь несёт ответственность за определение необходимости, показаний и возможных противопоказаний к проведению рентгенологических, ультразвуковых и функциональных исследований.</b> Специфика выбора метода заключается в том, что разные зоны исследования и предполагаемые патологии требуют разных подходов к диагностике и анализу полученных данных.</p>








        </div>
        <div id="panel2" class="tab-pane fade personalTab personalTab">
            <?php givePersonalList("'Отделение лучевой и функциональной диагностики'", '"%Заведующий отделением лучевой%"', $link); ?>
            <?php givePersonalList("'Отделение лучевой и функциональной диагностики'", '"%Старшая%"', $link); ?>
        </div>
        <div id="panel4" class="tab-pane fade">
            <div class="col-xs-12 gallery">
                <?php
                $home = $_SERVER['DOCUMENT_ROOT'];
                $dir = $home . "/departments/roentgen/gallery";
                $images = scandir($dir);
                $images = array_values(array_filter($images, function ($e) {
                    return $e != (".") and $e != ("..");
                }));

                for ($i = 0; $i < count($images); $i++) {
                    echo "
                        <a data-fancybox='gallery' href='/departments/roentgen/gallery/$images[$i]'>
                            <img src='/departments/roentgen/gallery/$images[$i]' class='img-rounded galleryImgTab' alt='$i'>
                        </a>
                        ";
                }
                ?>
            </div>
        </div>
    </div>
</div>