<div class="col-xs-8 div_carousel">
    <!--    <div class="hidden-xs hidden-sm col-md-12">-->
<!--    <div class="row">-->
        <div class="clearfix"></div>
        <div class="col-xs-12">
            <div class="row">
                <h3 class="era">
                        <Strong><i class="fa fa-bullhorn" aria-hidden="true"></i> Интересное</Strong>
                    </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- Карусель -->
        <div id="myCarousel" class="carousel slide baba" data-interval="15000" data-ride="carousel">

                <?php
                $news_see = mysqli_query($link, "SELECT * FROM promo ORDER BY id DESC");
                $x = 1;
                $n = 'active';
                $max_item = mysqli_num_rows($news_see);
                echo "
                <ol class=\"carousel-indicators indicators1\">
                ";
                for ($i=0;$i<$max_item;$i++) {
                    echo "<li data-target=\"#myCarousel\" data-slide-to=\"$i\" class=\"$n\"></li>";
                    $n='';
                }
                echo "
                </ol>
                ";

                echo "
                <div class=\"carousel-inner\">
                ";
                $n = 'active';
                while ($row = mysqli_fetch_row($news_see)) {


                    echo "
                    
                        
                            <div class=\"$n item slide__style slide$x\" >
                                <a href=\"$row[1]\">
                                    <div class='inner_block' style='background-image: url(/img/promo/$row[2]);'>

                            </div>
                            </a>
                            
                            </div>
                            
                        
                                ";
                    $x++;
                    $n = '';
                }

                echo "
                </div>
                ";

                ?>

            <!-- Навигация для карусели -->
            <!-- Кнопка, осуществляющая переход на предыдущий слайд с помощью атрибута data-slide="prev" -->
            <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                <i class="fas fa-angle-left"></i>
            </a>
            <!-- Кнопка, осуществляющая переход на следующий слайд с помощью атрибута data-slide="next" -->
            <a class="carousel-control right" href="#myCarousel" data-slide="next">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
</div>


<div class="col-xs-4 wrapperNewsPromo">
    <div class="col-xs-12 news">
        <div class="row">
            <?php
            $random = rand(1,5);
            if ($random == 1) {
                echo"<a href=\"?page=department_page&department_name=stomatology#exp1\"><img class=\"promo__img\" src=\"https://www.medudp.ru/img/promo/promo_stomat.jpg\" alt=\"Стоматологическая помощь взрослым\" class=\"img-rounded\"></a>";
            }
            if ($random == 2){
                echo"<a href=\"?page=department_page&department_name=endoscopy#exp1\"><img class=\"promo__img\" src=\"https://www.medudp.ru/img/promo/promo_endo.jpg\" alt=\"Эндоскопия\" class=\"img-rounded\"></a>";
            }
            if ($random == 3){
                echo"<a href=\"?page=department_page&department_name=hospital#exp1\"><img class=\"promo__img\" src=\"https://www.medudp.ru/img/promo/promo_boli.jpg\" alt=\"Кабинет боли\" class=\"img-rounded\"></a>";
            }
            if ($random == 4){
                echo"<a href=\"?page=department_page&department_name=roentgen#exp1\"><img class=\"promo__img\" src=\"https://www.medudp.ru/img/promo/ld1.jpg\" alt=\"Мамография\" class=\"img-rounded\"></a>";
            }
            if ($random == 5){
                echo"<a href=\"?page=department_page&department_name=roentgen#exp1\"><img class=\"promo__img\" src=\"https://www.medudp.ru/img/promo/ld2.jpg\" alt=\"Компьютерная томография\" class=\"img-rounded\"></a>";
            }
            ?>
        </div>
    </div>
</div>
<div class="clearfix"></div>






