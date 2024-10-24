<?php

$apend = date('d-m-Y_H-i-s') .'_'. rand(100, 1000) . '.jpg';
$uploadfile = '../../img/news/little_' . $apend;

if (0 < $_FILES['file']['error']) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
} else {
    if ($_FILES['file']['type'] == 'image/jpeg') {
        if ($_FILES['file']['size'] != 0 and $_FILES['file']['size'] <= 5000000) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $size = getimagesize($uploadfile);
                if ($size[0] < 836 && $size[1] < 471) {
                    echo $apend;
                }else {
                   echo 'imgError1'; //Ошибка соотношения сторон
                }
            }else {
                unlink($uploadfile);
                echo 'imgError2';
                //При загрузке файла произошла ошибка
            }
        }else{
            echo 'imgError3';
            //Размер больше чем нужно
        }
    } else {
        echo 'imgError4';
        //В формате jpeg
    }




}

?>
