<?php
//header('Content-Type: text/html; charset=utf-8');
session_start();
require_once "PHPscript/documentsForm.php";
require_once "PHPscript/dwnFileForm.php";
require_once "../content/allFunction.php";
require_once "function.php";
require_once "../../porter.php";

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title>Панель управления сайтом www.medudp.ru</title>
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css.map">
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.2/jquery.fancybox.min.css" />
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.2/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="https://www.medudp.ru/js/bootstrap.min.js"></script>


</head>

<body>
    <?php
    //Регистрация пользователя
    if (isset($_POST['log_new']) && isset($_POST['pass_new'])) {
        $log_new1 = strip_tags($_POST['log_new']);
        $log_new1 = htmlspecialchars($log_new1);
        $pass_new1 = strip_tags($_POST['pass_new']);
        $pass_new1 = htmlspecialchars($pass_new1);
        $salt1 = "tr@a";
        $salt2 = "pgh1!";
        $pass_new1 = hash('ripemd128', "$salt1$pass_new1$salt2");

        //Проверка на сущесттвование логина
        $log_new2 = mysqli_query($link, "SELECT * FROM users WHERE user_login ='$log_new1'");
        $row = mysqli_fetch_row($log_new2);
        if ($log_new1 == $row[1]) {
            echo "<p class='bg-danger text-center'>Пользователь с таким именем уже существует</p>";
        } else {
            $new_user = mysqli_query($link, "INSERT INTO users (user_login, user_pass) VALUES ('$log_new1','$pass_new1') ");
            if ($new_user) {
                echo "<p class='bg-success text-center'>Вы успешно зарегистрированны</p>";
            } else {
                echo "<p class='bg-danger text-center'>Произошла ошибка записи в базу данных</p>";
            }
        }
    ?>
        <script type="text/javascript">
            setTimeout('location.replace("/admin/index.php")', 2000);
        </script>
    <?php


    }
    //Страница регистрации
    if (isset($_GET['registration'])) {
    ?>
        <div class="col-sm-4 col-md-4 col-sm-offset-4 col-md-offset-4 form_aut">

            <div class="row">
                <p class="text-center">Регистрация</p>

                <p class="text-center">Введите желаемые логин и пароль пользователя</p>

                <form class="form-horizontal aut_form" method="post">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Введите желаемый логин" name="log_new">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Введите желаемый пароль" name="pass_new">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Зарегистрироваться</button>
                        </div>
                    </div>
                </form>

            </div>
        <?php
    }
    //Авторизация пользователя
    if (isset($_POST['log']) && isset($_POST['pass'])) {

        $log1 = strip_tags($_POST['log']); //
        $log1 = htmlspecialchars($log1);
        $pass1 = strip_tags($_POST['pass']);
        $pass1 = htmlspecialchars($pass1);
        $pass2 = mysqli_query($link, "SELECT * FROM users WHERE user_login ='$log1'");
        if ($pass2->num_rows) {
            $row = mysqli_fetch_row($pass2);
            $salt1 = "tr@a";
            $salt2 = "pgh1!";
            $pass1 = hash('ripemd128', "$salt1$pass1$salt2");
            if ($pass1 == $row[2]) {
                session_start();
                $_SESSION['session_id'] = hash('ripemd128', $pass1);
                $_SESSION['username'] = $log1;
            } else {
                echo "<p class='bg-danger text-center'>Логин или пароль были введены неверно</p>";
            }
        } else {
            echo "<p class='bg-danger text-center'>Логин или пароль были введены неверно</p>";
        }
    }
    //Страница авторизации
    if (!isset($_SESSION['session_id']) && !isset($_GET['registration'])) {
        ?>

            <div class="col-xs-offset-5 col-xs-2 form_aut">
                <p class="text-center"><img src="/img/logopicture2.png" class=""></p>
                <p class="text-center">Панель управления сайтом www.medudp.ru</p>

                <p class="text-center">
                    <small>Для входа в панель управления необходимо авторизоваться</small>
                </p>

                <form class="aut_form" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleLoginEmail1" name="log" placeholder="Имя пользователя">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="exampleInputPassword1" name="pass" placeholder="Пароль">
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="row">
                            <button type="submit" class="btn btn-default">Войти</button>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="row">
                            <p class="text-right">
                                <button class="btn btn-default" disabled="">Регистрация</button>
                            </p>
                        </div>
                    </div>
                </form>

            </div>
        <?php
    }
    //Деавторизация
    if (isset($_GET['exit'])) {
        session_destroy();
        ?>
            <script type="text/javascript">
                setTimeout('location.replace("/admin/index.php")', 0);
            </script>
        <?php
    }
    //Главная страница
    if (isset($_SESSION['session_id'])) {
        ?>
            <div class="container remodal-bg">
                <div class="row">
                    <div class="col-xs-12 adminLine">
                        <div class="row">
                            <div class="col-xs-4 logo_bl">
                                <a href="https://www.medudp.ru/">
                                    <div class="logo_img"><img src="/img/logopicture.png" class="img-circle"></div>
                                    <div class="logo_p">ФГБУ "Поликлиника №4"</div>
                                </a>
                            </div>
                            <div class="col-xs-4 logo_bl">
                                <p class="lineText text-center"></p>
                            </div>
                            <div class="col-xs-4 logo_bl">
                                <div class="username text-right"><?php echo ucfirst($_SESSION['username']); ?><a href="?exit"> <i class="fas fa-sign-out-alt"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="cleafix"></div>
                    <div class="col-xs-2">
                        <div class="row">
                            <div class="panel panel-default leftMenu">
                                <div class="panel-body"><b>Панель управления</b></div>
                                <div class="list-group">
                                    <?php
                                    //Вычисление количества записей в подразделах
                                    $countDoc = $link->query("SELECT COUNT(*) FROM doctors");
                                    $countDocRow = mysqli_fetch_row($countDoc);
                                    $countDep = $link->query("SELECT COUNT(*) FROM departments");
                                    $countDepRow = mysqli_fetch_row($countDep);
                                    $countNews = $link->query("SELECT COUNT(*) FROM news");
                                    $countNewsRow = mysqli_fetch_row($countNews);
                                    $countCert = $link->query("SELECT * FROM doctors WHERE endsert<now() ORDER BY last_name");

                                    while ($row = mysqli_fetch_assoc($countCert)) {
                                        if ($row['department'] !== 'Архив') {
                                            if ($row['department'] !== 'Администрация') {
                                                $countCertRow++;
                                            }
                                        }
                                    }
                                    $countDocuments = $link->query("SELECT COUNT(*) FROM documents");
                                    $countDocumentsRow = mysqli_fetch_row($countDocuments);
                                    if ($_SESSION['username'] === 'kadr1') {
                                        echo "
                                            <a href='/admin/index.php' class='list-group-item mainPage'>Главная</a>
                                            <a href='?options=doctors' class='list-group-item'> Сотрудники<span class='badge'>$countDocRow[0]</span></a>
                                            <a href='?options=departments' class='list-group-item'>Отделения<span class='badge'>$countDepRow[0]</span></a>
                                            <a href='?options=sert_date' class='list-group-item'> Сертификаты<span class='badge sertBadge'>$countCertRow</span></a>
                                        ";
                                    } else {

                                        echo "
                                            <a href='/admin/index.php' class='list-group-item mainPage'>Главная</a>
                                            <a href='?options=doctors' class='list-group-item'> Сотрудники<span class='badge'>$countDocRow[0]</span></a>
                                            <a href='?options=departments' class='list-group-item'>Отделения<span class='badge'>$countDepRow[0]</span></a>
                                            <a href='?options=news' class='list-group-item'> Новости<span class='badge'>$countNewsRow[0]</span></a>
                                            <a href='?options=documents' class='list-group-item'> Документы<span class='badge'>$countDocumentsRow[0]</span></a>
                                            <a href='?options=sert_date' class='list-group-item'> Сертификаты<span class='badge sertBadge'>$countCertRow</span></a>
                                            <a href='?options=priceList' class='list-group-item'> Прейскурант</a>
                                        ";
                                    }
                                    ?>



                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xs-10 rightMenu1">
                        <div class="col-xs-12 rightMenu2">
                            <div class="row">
                                <?php


                                $input_text = strip_tags($_GET['options']);
                                $input_text = htmlspecialchars($input_text);
                                $input_text = mysqli_real_escape_string($link, $input_text);
                                switch ($input_text) {
                                    case "doctors":
                                        include_once 'content/doctors.php';
                                        break;
                                    case "doctorPage":
                                        include_once 'content/doctorPage.php';
                                        break;
                                    case "departments":
                                        include_once 'content/departments.php';
                                        break;
                                    case "news":
                                        include_once 'content/news.php';
                                        break;
                                    case "paid":
                                        include_once 'content/paid.php';
                                        break;
                                    case "sert_date":
                                        include_once 'content/certificate.php';
                                        break;
                                    case "priceList":
                                        include_once 'content/priceList.php';
                                        break;
                                    case "documents":
                                        include_once 'content/documents.php';
                                        break;

                                    case "6":
                                        include "";
                                        break;
                                    case "7":
                                        include "";
                                        break;
                                    case "8":
                                        include "";
                                        break;
                                    case "9":
                                        include "";
                                        break;
                                    case "10":
                                        include "";
                                        break;
                                    case "11":
                                        include "";
                                        break;
                                    case "12":

                                        break;
                                    default:
                                        if ($_SESSION['username'] === 'kadr1') {
                                            include_once 'content/doctors.php';
                                            break;
                                        } else {
                                            include_once 'content/main.php';
                                            break;
                                        }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
        ?>

        <script type="text/javascript" src="/admin/js/script.js"></script>
</body>

</html>