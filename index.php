<?php
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // should do a check here to match $_SERVER['HTTP_ORIGIN'] to a
    // whitelist of safe domains
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}
?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function(d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter45053036 = new Ya.Metrika({
                    id: 45053036,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true
                });
            } catch (e) {}
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function() {
                n.parentNode.insertBefore(s, n);
            };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/45053036" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->

<?php
include_once '../porter.php';
?>
<?php
include_once 'content/allFunction.php';
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="1 day">
    <meta name="language" content="Russian">
    <meta name="generator" content="N/A">
    <meta name="yandex-verification" content="42c5836da5879a63" />

    <?php getTitlePage($link, $_GET['page'], $_GET['department_name'], $_GET['news']); ?>

    <link rel="apple-touch-icon" sizes="180x180" href="https://www.medudp.ru/img/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.medudp.ru/img/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.medudp.ru/img/fav/favicon-16x16.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.medudp.ru/css/bootstrap-theme.min.css.map">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/hover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.2/jquery.fancybox.min.css" />
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="pa/index.css">

</head>

<body>
    <!-- <div id="fb-root"></div>
<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.11';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script> -->
    <div class="hidden" itemscope itemtype="http://schema.org/Organization">
        <span itemprop="name">ФГБУ "Поликлиника №4" Управление делами Президента РФ</span>
        Контакты:
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            Адрес:
            <span itemprop="streetAddress">Кутузовский пр-т, 20</span>
            <span itemprop="postalCode"> 121151</span>
            <span itemprop="addressLocality">Москва</span>,
        </div>
        Телефон:<span itemprop="telephone">+7 499 243–70–34</span>,
        Факс:<span itemprop="faxNumber">+7 499 243–74-93</span>,
        Электронная почта: <span itemprop="email">medudp@medudp.ru</span>
    </div>

    <div class="sv_settings text-center" id="sv_settings">
        <span>Размер шрифта
            <span class="fs-outer">
                <button class="btn btn-default fs-n" id="fs-n">А</button>
                <button class="btn btn-default fs-m" id="fs-m">А</button>
                <button class="btn btn-default fs-l" id="fs-l">А</button>
            </span>
        </span>

        <span class="mgl20">Цветовая схема
            <span class="cs-outer">
                <button class="btn btn-default cs-bw" id="cs-bw">А</button>
                <button class="btn btn-default cs-wb" id="cs-wb">А</button>
                <button class="btn btn-default cs-bb" id="cs-bb">А</button>
                <button class="btn btn-default cs-gb" id="cs-gb">А</button>
                <button class="btn btn-default cs-yg" id="cs-yg">А</button>
            </span>
        </span>


        <span class="img-outer">
            <button class="btn btn-default" id="img-onoff"><i class="fas fa-images"></i> <span id="img-onoff-text"> Отключить изображения</span></button>
        </span>


        <span class="img-outer">
            <a class="btn btn-default" id="sv_off"><i class="fas fa-undo"></i> Обычная версия</a>
        </span>

    </div>


    <div class="container remodal-bg">

        <!--    <div class="row">-->


        <!--        <div class="col-sm-3 col-md-3 poisk">-->
        <!--            <div class="row">-->
        <!--                <form role="search" method="post" action="?page=search#exp1">-->
        <!--                    <div class="input-group">-->
        <!--                        <input name="search_text" type="text" class="form-control input-sm" placeholder="Поиск по сайту">-->
        <!--    	  <span class="input-group-btn">-->
        <!--    	    <button class="btn btn-success btn-sm" type="button">-->
        <!--                <i class="glyphicon glyphicon-search"></i>-->
        <!--            </button>-->
        <!--	      </span>-->
        <!--                    </div>-->
        <!--                </form>-->
        <!--            </div>-->
        <!--        </div>-->

        <!--        <div class="col-sm-offset-6 col-md-offset-6 col-sm-3 col-md-3">-->
        <!--            <div class="row">-->
        <!--                <p class="text-right lwtext"><a href="#" id="sv_on" class="btn btn-success btn-sm"><i class="fa fa-low-vision"></i>Версия для слабовидящих</a></p>-->
        <!--            </div>-->
        <!--        </div>-->

        <?php
        $input_text = $_GET['page'];
        nullControl($link, $input_text);
        switch ($input_text) {
            case "administration":
                include_once 'content/header.php';
                include_once 'content/administration.php';
                include_once 'content/footer.php';
                break;
            case "department_page":
                include_once 'content/header.php';
                include_once 'content/department_page.php';
                include_once 'content/footer.php';
                break;
            case "news":
                include_once 'content/header.php';
                include_once 'content/news_page.php';
                include_once 'content/footer.php';
                break;
            case "contacts_page":
                include_once 'content/header.php';
                include_once 'content/contacts_page.php';
                include_once 'content/footer.php';
                break;
            case "documents":
                include_once 'content/header.php';
                include_once 'content/documents.php';
                include_once 'content/footer.php';
                break;
            case "high-tech_medical_care":
                include_once 'content/header.php';
                include_once 'content/high-tech_medical_care.php';
                include_once 'content/footer.php';
                break;
            case "paid_services":
                include_once 'content/header.php';
                include_once 'content/paid_services.php';
                include_once 'content/footer.php';
                break;
            case "gos_garant":
                include_once 'content/header.php';
                include_once 'content/gos_garant.php';
                include_once 'content/footer.php';
                break;
            case "dms":
                include_once 'content/header.php';
                include_once 'content/dms.php';
                include_once 'content/footer.php';
                break;
            case "gallery":
                include_once 'content/header.php';
                include_once 'content/gallery.php';
                include_once 'content/footer.php';
                break;
            case "stock":
                include_once 'content/header.php';
                include_once 'content/stock.php';
                include_once 'content/footer.php';
                break;
            case "job":
                include_once 'content/header.php';
                include_once 'content/job.php';
                include_once 'content/footer.php';
                break;
            case "process":
                include_once 'content/process.php';
                break;
            case "lis":
                include_once 'content/header.php';
                include_once 'content/lis.php';
                include_once 'content/footer.php';
                break;
            case "opinion":
                include_once 'content/header.php';
                include_once 'content/opinion.php';
                include_once 'content/footer.php';
                break;
            // case "privacy_policy":
            //     include_once 'content/header.php';
            //     include_once 'content/privacy policy.php';
            //     include_once 'content/footer.php';
            //     break;
            // case "privacy_policy":
            //     include_once 'content/header.php';
            //     include_once 'content/agreementLK.php';
            //     include_once 'content/footer.php';
            //     break;
            case "site_map":
                include_once 'content/header.php';
                include_once 'content/site_map.php';
                include_once 'content/footer.php';
                break;
            case "det_otd_menu_new":
                include "";
                include_once 'content/header.php';
                include_once 'content/det_otd_menu_new.php';
                include_once 'content/footer.php';
                break;
            case "search":
                include_once 'content/header.php';
                include_once 'content/search.php';
                include_once 'content/footer.php';
                break;
            case "per_predv_osm":
                include_once 'content/header.php';
                include_once 'content/per_predv_osm.php';
                include_once 'content/footer.php';
                break;
            case "vac":
                include_once 'content/header.php';
                include_once 'content/vac.php';
                include_once 'content/footer.php';
                break;
            case "resultRecordPage":
                include_once 'content/resultRecordPage.php';
                break;
            case "fiz":
                include_once 'content/header.php';
                include_once 'content/fiz.php';
                include_once 'content/footer.php';
                break;
            case "ur":
                include_once 'content/header.php';
                include_once 'content/ur.php';
                include_once 'content/footer.php';
                break;
            case "covid":
                include_once 'content/header.php';
                include_once 'content/covid.php';
                include_once 'content/footer.php';
                break;
            case "medical_report":
                include_once 'content/header.php';
                include_once 'content/medical_report.php';
                include_once 'content/footer.php';
                break;
            case "lk":
                include_once 'content/header.php';
                // include_once 'content/header_pa.php';
                //				include_once 'content/medical_report.php';
                include_once 'content/footer.php';
                break;
            default:
                include_once 'content/header.php';
                include_once 'content/news_block.php';
                include_once 'content/sale_block.php';
                include_once 'content/news_block2.php';
                include_once 'content/paid_services_block.php';
                //            include_once 'content/department_block.php';
                include_once 'content/policlinic_information.php';
                // include_once 'content/gallery_block.php';
                include_once 'content/footer.php';
        }
        ?>

    </div>
    </div>
    <div id="toTop"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script type="text/javascript">
        $(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() != 0) {
                    $('#toTop').fadeIn();
                } else {
                    $('#toTop').fadeOut();
                }
            });
            $('#toTop').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
            });
        });
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.2/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="https://www.medudp.ru/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/7d318c58e8.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="pa/main.js"></script>
</body>

</html>