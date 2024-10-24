<?php
session_start();
if (!empty($_POST['docid'])){
    $_SESSION['docid'] = $_POST['docid'];
}

if (!empty($_POST['ib'])){
    $_SESSION['ib'] = $_POST['ib'];
}else {
    echo "История болезни не введена";
}

if (!empty($_POST['recordLastName'])){
    $_SESSION['recordLastName'] = $_POST['recordLastName'];
}else {
    echo "Фамилия не введена";
}

if (!empty($_POST['recordFirstName'])){
    $_SESSION['recordFirstName'] = $_POST['recordFirstName'];
}else {
    echo "Имя не введено";
}

if (!empty($_POST['recordMiddleName'])){
    $_SESSION['recordMiddleName'] = $_POST['recordMiddleName'];
}else {
    echo "Отчество не введено";
}

if (!empty($_POST['likeRecordTime'])){
    $_SESSION['likeRecordTime'] = $_POST['likeRecordTime'];
}else {
    echo "Время записи не введено";
}

if (!empty($_POST['recordPhone'])){
    $_SESSION['recordPhone'] = $_POST['recordPhone'];
}else {
    echo "Телефон не указан";
}

if (!empty($_POST['access'])){
    $_SESSION['access'] = $_POST['access'];
}else {
    echo "Согласие не введено";
}

echo "<script>window.location.href='".$_SERVER["HTTP_REFERER"]."'</script>";
?>