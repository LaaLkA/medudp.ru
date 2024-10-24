<?php
require_once "../content/allFunction.php";
require_once "../../porter.php";



    if (isset($_GET['questionCovid'])) {
        foreach ($_GET as $key =>&$value){
          $value = nullControl($link, $value);
        }
    }

    $dateQuestion = date("Y-m-d Н:i:s");
    $query = "INSERT INTO question (question,name,email,date) VALUES('{$_GET['questionCovid']}','{$_GET['nameCovid']}','{$_GET['emailCovid']}','{$dateQuestion}') ";
    $insertQuestionToBase = $link->query($query) or die ($link->error);
    if ($insertQuestionToBase) {

        $to = 'admin@medudp.ru, melnikov@medudp.ru, covid19@medudp.ru';
        $subject = 'Вопрос по коронавирусу от '. $_GET['nameCovid'];
        $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $question = '
        На сайт поликлиники поступил новый вопрос по коронавирусу!<br><br>
        <b>Справшивает</b> '. $_GET['nameCovid'] .'<br><br>
        <b>Email:</b> '. $_GET['emailCovid'] .'<br><br>
        <b>Вопрос:</b><br>
        '. $_GET['questionCovid'] .'<br><br>
        -----------------------<br>
        Не отвечайте на это письмо. Это письмо создано автоматически роботом с сайта www.medudp.ru
        ';
        $headers = 'Content-type:text/html; charset=utf-8' . "\r\n" .
            'From: site-robot@medudp.ru' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $question, $headers);

        echo "ok";
    }

?>