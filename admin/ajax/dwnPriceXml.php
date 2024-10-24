<?php

$uploadfile = '../../documents/paid/price.xml';

if (0 < $_FILES['file']['error']) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
} else {
    if ($_FILES['file']['type'] == 'text/xml') {
        if ($_FILES['file']['size'] != 0 and $_FILES['file']['size'] <= 5000000) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                echo 'xok';
            }else {
                echo 'xError2';
                //При загрузке файла произошла ошибка
            }
        }else{
            echo 'xError3';
            //Размер больше чем нужно
        }
    } else {
        echo 'xError4';
        //В формате xml
    }
}

?>

