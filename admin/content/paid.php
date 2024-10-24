<?php
session_start();
require_once "../../content/allFunction.php";
require_once "../function.php";
require_once "../../../porter.php";

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">

    <title>Панель управления сайтом www.medudp.ru</title>
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css.map">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.2/jquery.fancybox.min.css"/>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.4.2/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="https://www.medudp.ru/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/admin/js/script.js"></script>
</head>
<body>
<div class="col-xs-12 mainFon">

<?php
$result = mysqli_query($link, "SELECT * FROM doctors WHERE department=$_GET[dep] AND form_appointment IN ('1','2') ORDER BY form_appointment, last_name ASC");
$num_result = mysqli_num_rows($result);
$indexb = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $convertEndSert1 = convertDate ($row[endsert]);
    $convertEndSert2 = convertDate ($row[endsert2]);
    echo "
          <p class='more'></p>
            <div class='col-xs-12 card '>
                <div class='col-xs-3'><img src='../gallery/" . $row[image_name] . "' class='img-thumbnail'></div>
                <div class='col-xs-9'>
                    <p class='name'>$row[last_name] $row[first_name] $row[middle_name]</p>
                    <p class='appointment'>$row[appointment]</p>
                    <p>$row[department]</p>
                    <p>$row[job_time]</p>
                    <p><b>Краткая биография: <br></b>";
    echo nl2br($row[history]);
                   echo"</p>";
    if (!empty($row[speciality]) && !empty($row[endsert])) {
        echo "<p><b>Основная специальность:</b> $row[speciality] <br><b>Окончание сертификата:</b> $convertEndSert1</p>";
    }
    if (!empty($row[speciality2]) && !empty($row[endsert2])) {
        echo"<p><b>Дополнитеьная специальность:</b> $row[speciality2] <br><b>Окончание сертификата:</b> $convertEndSert2</p>";
    }

               echo" </div>
 
            </div>
            
            <div class='clearfix'></div>";

    $indexb++;
}

?>
</div>
</body>
</html>