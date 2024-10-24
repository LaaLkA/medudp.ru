<?php
    require_once "../../content/allFunction.php";
    require_once "../function.php";
    require_once "../../../porter.php";

//    echo $_FILES['dwnFile']['name'] . " | ";
//    echo $_POST['documentName'] . " | ";
//    echo $_POST['documentCategories'] . " | ";
//    echo $_POST['documentDate'] . " | ";
//    echo $_POST['documentSize'] . " | ";
//    echo $_POST['documentId'] . " | ";

    $uploadfile = '../../documents/doc/';

    //Добавление нового документа
    if (isset($_POST['addNewDocument'])){
        foreach ($_POST as $key =>&$value){
            $value = nullControl($link, $value);
        }
        if ($_FILES['dwnFile']['type'] == 'application/pdf' or $_FILES['dwnFile']['type'] == 'application/application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            if ($_FILES['dwnFile']['size'] != 0 and $_FILES['dwnFile']['size'] <= 200000000) {
                if (move_uploaded_file($_FILES['dwnFile']['tmp_name'], $uploadfile.$_FILES['dwnFile']['name'])) {

                    $docExt = pathinfo($_FILES['dwnFile']['name'], PATHINFO_EXTENSION);
                    $docSize = formatSize($_FILES['dwnFile']['size']);

                    $query = "INSERT INTO documents (categories,docName,filepath,docDate,filesize,extension) VALUES('{$_POST['documentCategories']}','{$_POST['documentName']}','{$_FILES['dwnFile']['name']}','{$_POST['documentDate']}','$docSize','$docExt') ";
                    $insertDocument = $link->query($query) or die ($link->error);
                    if ($insertDocument) {
                        echo "ok";
                    }


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
            //В формате pdf или rtf
        }
    } else {
        //Изменения документа
        if (isset($_FILES['dwnFile'])) {
            foreach ($_POST as $key =>&$value){
                $value = nullControl($link, $value);
            }

            $getDocImgName = $link->query("SELECT * FROM documents WHERE id='{$_POST['documentId']}'");
            if ($getDocImgName) {
                $docName = mysqli_fetch_assoc($getDocImgName);
                unlink('../../documents/doc/' . $docName[filepath]);
            }
            //
            if ($_FILES['dwnFile']['type'] == 'application/pdf' or $_FILES['dwnFile']['type'] == 'application/application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                if ($_FILES['dwnFile']['size'] != 0 and $_FILES['dwnFile']['size'] <= 100000000) {
                    if (move_uploaded_file($_FILES['dwnFile']['tmp_name'], $uploadfile.$_FILES['dwnFile']['name'])) {

                        $docExt = pathinfo($_FILES['dwnFile']['name'], PATHINFO_EXTENSION);
                        $docSize = formatSize($_FILES['dwnFile']['size']);

                        $query = "UPDATE documents SET categories='{$_POST['documentCategories']}',docName='{$_POST['documentName']}',filepath ='{$_FILES['dwnFile']['name']}',docDate='{$_POST['documentDate']}',filesize='$docSize',extension = '{$docExt}' WHERE id='{$_POST['documentId']}'";
                        $insertDocument = $link->query($query) or die ($link->error);
                        if ($insertDocument) {
                            echo "ok";
                        }
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
                
                //В формате pdf или rtf
            }
        }else {
            $query = "UPDATE documents SET categories='{$_POST['documentCategories']}',docName='{$_POST['documentName']}',docDate='{$_POST['documentDate']}' WHERE id='{$_POST['documentId']}'";
            $insertDocument = $link->query($query) or die ($link->error);
            if ($insertDocument) {
                echo "ok";
            }
        }
    }


?>
