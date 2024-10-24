<div class="col-xs-12">
    <div class="row">
        <a name="exp1"></a>
        <h3 class="era"><i class="far fa-comment"></i> <Strong>Отзывы</Strong></h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="col-xs-12 opinion_block">
    <div class="row">
        <div class=" col-xs-9">
            <div class="row">
                <form class="back_form" method="post" role="form" action="?page=opinion#exp1" id="opinion_form">
                    <!--                    <div class="hidden-xs hidden-sm hidden-md col-lg-3 logo_opinion">-->
                    <!--                        <img src="https://www.medudp.ru//img/opinion.png" alt="" class="img-responsive">-->
                    <!--                    </div>-->
                    <!--                    <div class="col-xs-1"></div>-->
                    <div class="form-group col-xs-12 has-feedback">
                        <label for="input_message">Сообщение:</label>
                        <textarea class="form-control" id="input_message" name="input_message" placeholder="Введите сюда текст своего сообщения..." rows="6"></textarea>
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                    <div class="clearfix hidden-lg"></div>

                    <div class="form-group col-xs-6 .has-feedback">
                        <label for="input_name">Ваше имя:</label>
                        <input type="name" class="form-control" id="input_name" name="input_name" placeholder="Например, Иван Иванович">
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                    <div class="clearfix hidden-lg"></div>
                    <div class="col-xs-1"></div>
                    <div class="form-group col-xs-5 .has-feedback">
                        <label for="input_email">Ваш email:</label>
                        <input type="email" class="form-control" id="input_email" name="input_email" placeholder="Например, email@domain.ru">
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                    <div class="clearfix hidden-lg"></div>

                    <div class="checkbox col-xs-12  check_privacy_policy">
                        <label>
                            <input type="checkbox" value="Согласен" name="access">
                            Я даю своё согласие ФГБУ "Поликлиника №4" на обработку моих персональных данных, 
                            в соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О
                            персональных данных», на условиях и для целей, определенных в <a href='/content/agreementPD/index.php'>политике конфиденциальности</a>.
                        </label>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-xs-offset-10 col-xs-2 btn_sbm">
                        <button type="submit" class="btn-opinions">Отправить</button>
                    </div>
                    <div class="clearfix"></div>
                </form>

            </div>
        </div>
        <div class="col-xs-3 anketa_container">
            <div class="col-xs-12 anketa_inner">
                <h4 class="text-center">Оцените качество работы ФГБУ "Поликлиника №4"</h4>
                <p>Как это сделать? Все очень просто!</p>
                <table class="anketa_table">
                    <tr>
                        <td class="text-center anketa_icons"><i class="fas fa-download"></i></td>
                        <td>Скачайте и распечатайте анкету</td>
                    </tr>
                    <tr>
                        <td class="text-center anketa_icons"><i class="fas fa-clipboard-check"></i></td>
                        <td>Заполните анкету</td>
                    </tr>
                    <tr>
                        <td class="text-center anketa_icons"><i class="far fa-envelope"></i></td>
                        <td>Бросьте анкету в ящик "Для обращений и анкет" около регистратуры</td>
                    </tr>
                </table>

                <buttons><a class="btn-anketa" href="documents/doc/Приложение № 7 анкета к приказу №21 от 15.01.2021 по ВКК.pdf" target="_blank">Скачать анкету</a></buttons>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['input_message'])) {

    $err = 0;
    if (strlen($_POST['input_message']) > 5000) {
        $modalMessage1 = 'Текст сообщения не может превышать 5000 символов.<br>';
        $mainModalMessage = $mainModalMessage . $modalMessage1;
        $err++;
    }
    if (strlen($_POST['input_name']) > 100) {
        $modalMessage2 = 'Имя не может превышать 100 символов.<br>';
        $mainModalMessage = $mainModalMessage . $modalMessage2;
        $err++;
    }
    if (strlen($_POST['input_email']) > 100) {
        $modalMessage3 = 'Email не может превышать 100 символов.<br>';
        $mainModalMessage = $mainModalMessage . $modalMessage3;
        $err++;
    }
    if (empty($_POST['input_message'])) {
        $modalMessage5 = 'Вы не ввели текст сообщения<br>';
        $mainModalMessage = $mainModalMessage . $modalMessage5;
        $err++;
    }
    if (empty($_POST['input_name'])) {
        $modalMessage6 = 'Вы не ввели свое имя<br>';
        $mainModalMessage = $mainModalMessage . $modalMessage6;
        $err++;
    }
    if (empty($_POST['input_email'])) {
        $modalMessage7 = 'Вы не ввели свой email - адрес для обратной связи<br>';
        $mainModalMessage = $mainModalMessage . $modalMessage7;
        $err++;
    }
    if (empty($_POST['access'])) {
        $modalMessage8 = 'Вам необходимо дать свое согласие на обработку персональных данных<br>';
        $mainModalMessage = $mainModalMessage . $modalMessage8;
        $err++;
    }

    if ($err > 0) {
        infMessage('Внимание!', $mainModalMessage);
    } else {
        $message = $_POST['input_message'];
        $opinion_information = array($_POST['input_message'], $_POST['input_name'], $_POST['input_email'], $_POST['access']);
        for ($i = 0; $i < count($opinion_information); $i++) {
            $opinion_information[$i] = strip_tags($opinion_information[$i]);
            $opinion_information[$i] = htmlspecialchars($opinion_information[$i]);
            $opinion_information[$i] = mysqli_real_escape_string($link, $opinion_information[$i]);
        }
        $dateOpinions = date(d . "." . m . "." . Y . "  " . H . ":" . i);

        $base_dwn_opinion = mysqli_query($link, "INSERT INTO opinions (input_message,input_name,input_email,access,timeMarker) VALUES ('$opinion_information[0]','$opinion_information[1]','$opinion_information[2]','$opinion_information[3]','$dateOpinions')");

        if ($base_dwn_opinion) {

            $to = 'admin@medudp.ru, melnikov@medudp.ru, denisov@medudp.ru, medudp@medudp.ru';
            $subject = 'Отзыв с сайта medudp.ru';
            $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
            $message = 'На сайте www.medudp.ru был оставлен новый отзыв о работе нашего учреждения:<br><br>
        ' . $message . '<br><br>' . $opinion_information[1] . '<br>' . $opinion_information[2] . '<br><br>Не отвечайте на это письмо. Это письмо создано автоматически роботом с сайта www.medudp.ru ';
            $headers = 'Content-type:text/html; charset=utf-8' . "\r\n" .
                'From: site-robot@medudp.ru' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
            $modalMessage9 = 'Ваш Отзыв успешно принят и в ближайшее время будет рассмотрен.<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage9;
            infMessage('Поздравляем!', $mainModalMessage);
        } else {
            $modalMessage10 = 'Ошибка записи в базу данных. Возможно база данных недоступна попробуйте добавить отзыв позднее <br>';
            $mainModalMessage = $mainModalMessage . $modalMessage10;
            infMessage('Ошибка!', $mainModalMessage);
        }
    }
}

$opinionShow = mysqli_query($link, "SELECT * FROM opinions WHERE marker=1 ORDER BY id DESC");
while ($row = mysqli_fetch_row($opinionShow)) {
    echo "<div class=\"col-xs-12 opinionPlitka\">
<h3 class='opinonName'>$row[1]</h3>";

    if (!empty($row[6])) echo "<p class='text-justify'><b>$row[6]</b></p>";

    echo "
    <p class='text-justify'>$row[3]</p>
           </div>";
    if (!empty($row[7])) echo "
<div class='answerPlitka col-xs-offset-2 col-xs-10'>
<h3>Администрация поликлиники</h3>
<p class='text-justify'>
$row[7]</p>
</div>
";
}

?>