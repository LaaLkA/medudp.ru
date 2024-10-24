<?php
//Запись на прием к специалисту
if (isset($_POST['docFlag'])) {
    if (empty($_POST['docFlag'])) {
        $err = 0;
        $mainModalMessage = $mainModalMessage . "<div class='alert alert-danger' role='alert'>При заполнении формы допущены ошибки:</div>";

        if (empty($_POST['recordLastName'])) {
            $modalMessage1 = 'Вы не ввели свою Фамилию<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage1;
            $err++;
        }
        if (empty($_POST['recordFirstName'])) {
            $modalMessage2 = 'Вы не ввели свое Имя<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage2;
            $err++;
        }
        // if (empty($_POST['recordMiddleName'])) {
        //     $modalMessage3 = 'Вы не ввели свое Отчество<br>';
        //     $mainModalMessage = $mainModalMessage . $modalMessage3;
        //     $err++;
        // }
        if (empty($_POST['likeRecordTime'])) {
            $modalMessage4 = 'Вы не ввели желаемое время записи<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage4;
            $err++;
        }
        if (empty($_POST['recordPhone'])) {
            $modalMessage5 = 'Вы не ввели номер телефона для обратной связи<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage5;
            $err++;
        }
        if (empty($_POST['access'])) {
            $modalMessage6 = 'Вам необходимо дать свое согласие на обработку персональных данных<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage6;
            $err++;
        }

        if ($err > 0) {

            infMessage('Ошибка!', $mainModalMessage);
        } else {
            $patientInformation = array($_POST['docid'], $_POST['ib'], $_POST['recordLastName'], $_POST['recordFirstName'], $_POST['recordMiddleName'], $_POST['likeRecordTime'], $_POST['recordPhone'], $_POST['access']);
            foreach ($patientInformation as &$value) {
                $value = nullControl($link, $value);
            }
            if (empty($patientInformation[1])) {
                $patientInformation[1] = 'none';
            }
            $dateOpinions = date(d . "." . m . "." . Y . "  " . H . ":" . i);
            $recordDB = mysqli_query($link, "INSERT INTO userRecord (doctorid,ib,lastname,firstname,middlename,timerecord,telnumber,accessRec,timeMarker) VALUES ('$patientInformation[0]','$patientInformation[1]','$patientInformation[2]','$patientInformation[3]','$patientInformation[4]','$patientInformation[5]','$patientInformation[6]','$patientInformation[7]','$dateOpinions')");
            if ($recordDB) {
                $getDoc = mysqli_query($link, "SELECT * FROM doctors WHERE id=$patientInformation[0]");
                while ($row = mysqli_fetch_row($getDoc)) {
                    $to = 'admin@medudp.ru, kaplunenko@medudp.ru, record_reg@medudp.ru';
                    $subject = 'Запись на прием';
                    $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
                    $message = '
                        <html lang="ru">
                        <head>
                            <title>Document</title>
                        </head>
                        <body>
                        <style type="text/css">
                            .containermail {
                            
                            }
                        </style>
                        <table width=«100%» border=«0» cellspacing=«0» cellpadding=«0»>
                        <tr>
                        <td align=«center» bgcolor=«#ffffff»>
                        <table width=«600» border=«0» cellspacing=«0» cellpadding=«0»>
                        <tr>
                        <td align=«center»>
                        <p class="containermail">
                        Новая заявка на запись к врачу<br><br>
                        <b>Врач:</b> ' . $row[5] . ' ' . $row[4] . ' ' . $row[6] . '<br>
                        <b>Отделение:</b> ' . $row[1] . '<br><br>
                        <b>Пациент:</b> ' . $patientInformation[2] . ' ' . $patientInformation[3] . ' ' . $patientInformation[4] . '<br>
                        <b>История болезни:</b> ' . $patientInformation[1] . '<br>
                        <b>Желаемое время записи:</b> ' . $patientInformation[5] . '<br>
                        <b>Обратный номер телефона:</b> ' . $patientInformation[6] . '<br>
                        <br><br>Не отвечайте на это письмо. Это письмо создано автоматически роботом с сайта www.medudp.ru
                        </p>
                        </td>
                        </tr>
                        </table>
                        </td>
                        </tr>
                        </table>
                        </body>
                        </html>';

                    $headers = 'Content-type:text/html; charset=utf-8' . "\r\n" .
                        'From: record-robot@medudp.ru' . "\r\n" .
                        'Reply-To: webmaster@example.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                    mail($to, $subject, $message, $headers);
                    $final = '';
                    $final = $final . "<div class='alert alert-success' role='alert'>Ваша заявка была успешно отправлена на обработку</div>";

                    $final = $final . "<div class='alert alert-info' role='alert'>";
                    $final = $final . "<p><b>Пациент: </b>{$_POST['recordLastName']} {$_POST['recordFirstName']} {$_POST['recordMiddleName']} </p>";
                    $final = $final . "<p><b>Желаемое время записи: </b>{$_POST['likeRecordTime']}</p>";
                    $final = $final . "<p><b>Обратный номер телефона: </b>{$_POST['recordPhone']}</p>"; 
                    $final = $final . "</div>";

                    $final = $final . "<div class='alert alert-success' role='alert'><h5><b>В ближайщее время с вами свяжется наш сотрудник для подтверждения вашей записи</b></h5></div> ";
                    
                    infMessage('Готово!', $final);
                }
            } else {
                infMessage('Ошибка!', "Ошибка подготовки запроса:" . mysqli_error($link) . '<br>' . mysqli_stmt_execute($recordDB) . '<br>' . mysqli_stmt_close($recordDB));
            }
        }
    }else {
        infMessage('Ошибка!', "Сбой, попробуйте еще раз.");
    }
}

//Запись на прием на диагностику
if (isset($_POST['diagFlag'])) {
    if (empty($_POST['diagFlag'])) {
        $err = 0;

        if (empty($_POST['recordLastName'])) {
            $modalMessage1 = 'Вы не ввели свою Фамилию<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage1;
            $err++;
        }
        if (empty($_POST['recordFirstName'])) {
            $modalMessage2 = 'Вы не ввели свое Имя<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage2;
            $err++;
        }
        if (empty($_POST['recordMiddleName'])) {
            $modalMessage3 = 'Вы не ввели свое Отчество<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage3;
            $err++;
        }
        if (empty($_POST['likeRecordTime'])) {
            $modalMessage4 = 'Вы не ввели желаемое время записи<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage4;
            $err++;
        }
        if (empty($_POST['recordPhone'])) {
            $modalMessage5 = 'Вы не ввели номер телефона для обратной связи<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage5;
            $err++;
        }
        if (empty($_POST['access'])) {
            $modalMessage6 = 'Вам необходимо дать свое согласие на обработку персоональных данных<br>';
            $mainModalMessage = $mainModalMessage . $modalMessage6;
            $err++;
        }

        if ($err > 0) {
            infMessage('Внимание!', $mainModalMessage);
        } else {
            $patientInformation = array($_POST['ib'], $_POST['recordLastName'], $_POST['recordFirstName'], $_POST['recordMiddleName'], $_POST['likeRecordTime'], $_POST['recordPhone'], $_POST['access'],$_POST['diagName']);
            foreach ($patientInformation as &$value) {
                $value = nullControl($link, $value);
            }
            if (empty($patientInformation[0])) {
                $patientInformation[1] = 'none';
            }
            $dateOpinions = date(d . "." . m . "." . Y . "  " . H . ":" . i);
            $recordDB = mysqli_query($link, "INSERT INTO diagRecord (ib,lastname,firstname,middlename,timerecord,telnumber,accessRec,timeMarker,diagName) VALUES ('$patientInformation[0]','$patientInformation[1]','$patientInformation[2]','$patientInformation[3]','$patientInformation[4]','$patientInformation[5]','$patientInformation[6]','$dateOpinions','$patientInformation[7]')");
            if ($recordDB) {


                    $to = 'admin@medudp.ru, kaplunenko@medudp.ru, record_reg@medudp.ru';
                    $subject = 'Запись на исследование';
                    $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
                    $message = '
<html lang="ru">
<head>
    <title>Document</title>
</head>
<body>

Новая запись на исследование<br><br>

<b>Исследование:</b> ' . $patientInformation[7]. '<br><br>
<b>Пациент:</b> ' . $patientInformation[1] . ' ' . $patientInformation[2] . ' ' . $patientInformation[3] . '<br>
<b>История болезни:</b> ' . $patientInformation[0] . '<br>
<b>Желаемое время записи:</b> ' . $patientInformation[4] . '<br>
<b>Обратный номер телефона:</b> ' . $patientInformation[5] . '<br>
<br><br>Не отвечайте на это письмо. Это письмо создано автоматически роботом с сайта www.medudp.ru

</body>
</html>
';
                    $headers = 'Content-type:text/html; charset=utf-8' . "\r\n" .
                        'From: record-robot@medudp.ru' . "\r\n" .
                        'Reply-To: webmaster@example.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                    mail($to, $subject, $message, $headers);
                    infMessage('Поздравляем!', 'Ваша заявка принята, в ближайшее время с вами свяжется наш специалист');

            } else {
                infMessage('Ошибка!', "Ошибка подготовки запроса:" . mysqli_error($link) . '<br>' . mysqli_stmt_execute($recordDB) . '<br>' . mysqli_stmt_close($recordDB));
            }
        }
    }else {
        infMessage('Ошибка!', "Сбой, попробуйте еще раз.");
    }
}

?>