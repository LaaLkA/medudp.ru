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

    $base_dwn = $link->query("UPDATE news SET title='{$_POST['newTitleNews']}',description='{$_POST['newDescriptionNews']}',article='{$_POST['newArticleNews']}',time='{$_POST['newTimeNews']}',categories='{$_POST['newCategoriesNews']}',det_marker='$detMarker',image_name='{$_POST['imgName']}' WHERE id='{$_POST['idNews']}'");

    if ($base_dwn) {
        echo "noError";
    }else {
        echo "formError";
    }
}
?>