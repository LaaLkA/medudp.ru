<?php

$uploadfile = '../../documents/doc/price.pdf';

if (0 < $_FILES['file']['error']) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
} else {
    if ($_FILES['file']['type'] == 'application/pdf') {
        if ($_FILES['file']['size'] != 0 and $_FILES['file']['size'] <= 5000000) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {

                    echo 'ok';

            }else {

                echo 'imgError2';
                //При загрузке файла произошла ошибка
            }
        }else{
            echo 'imgError3';
            //Размер больше чем нужно
        }
    } else {
        echo 'imgError4';
        //В формате pdf
    }
}

?>
