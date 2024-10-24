<?php

require_once "../../content/allFunction.php";
require_once "../function.php";
require_once "../../../porter.php";


if (isset($_POST['newTitleNews'])) {

    foreach ($_POST as $key =>&$value){
        if ($key != 'newArticleNews') {
            $value = nullControl($link, $value);
        }
    }

    if ($_POST['newDetMarker'] == 'on') {
        $detMarker = 1;
    } else {
        $detMarker = 0;
    }

    $base_dwn = $link->query("INSERT INTO news (title,description,article,time,categories,det_marker,image_name) VALUES ('{$_POST['newTitleNews']}','{$_POST['newDescriptionNews']}','{$_POST['newArticleNews']}','{$_POST['newTimeNews']}','{$_POST['newCategoriesNews']}','$detMarker','{$_POST['imgName']}')");

    if ($base_dwn) {
        echo "noError";
    }else {
        echo "formError";
    }
}
?>