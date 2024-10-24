<div class="col-xs-12 rightMenuContentWrapper">
<?php


if (isset($_GET['newDocOk'])) {
    infMessage('Всё отлично!', 'Документ был успешно добавлен.');
}
if (isset($_GET['updDocOk'])) {
    infMessage('Всё отлично!', 'Документ был успешно изменен.');
}
if (isset($_GET['delDocOk'])) {
    infMessage('Всё отлично!', 'Документ был успешно удален.');
}

//Удаление документа
if (isset($_GET['delete'])) {
    if (!empty($_GET['delete'])) {
        $deleteId = nullControl($link,$_GET['delete']);
        $getDocImgName = $link->query("SELECT * FROM documents WHERE id='$deleteId'");
        if ($getDocImgName) {
            $docName = mysqli_fetch_assoc($getDocImgName);
            unlink('../documents/doc/'.$docName[filepath]);
            //Удаление записи в базе данных
            $deleteDoc = $link->query("DELETE FROM documents WHERE id='$deleteId'");
            if ($deleteDoc) {
                echo "
                <script>
                    window.location.href = '?options=documents&delDocOk';
                </script>
                ";
            } else {
                infMessage('Что то пошло не так =(', '<b>Внимание!</b> При удалении записи о документев базе данных произошла непредвиденная ошибка');
            }
        } else {
            infMessage('Что то пошло не так =(', '<b>Внимание!</b> При удалении документа произошла непредвиденная ошибка');
        }
    }
}

    //Форма добавления нового документа
    if (isset($_GET['addNewDocument'])){
        echo "<p class='pageNameLabel2'>Создание нового документа</p>";
        getDocumentForm('','','','',date("Y-m-d"),
            '');
        echo "
        <div class='row'>
            <div class='form-group text-left col-xs-6'>
                <a href='?options=documents' class='btn btn-danger' id='exitNewNews'><-- Назад</a>
            </div>
            <div class='form-group text-right col-xs-6'>
                <button class='btn btn-primary' id='addNewDocument'>Добавить --></button>
            </div>
        </div> 
        ";
    }else {
        //Список последних документов
        if (!isset($_GET['idDocument'])) {
            echo "
                <p class='col-xs-6 pageNameLabel'>Управление документами</p>
            
                <p class='text-right col-xs-6'>
                    <a href='?options=documents&addNewDocument' class='btn btn-primary addNewDocument'><i class='fas fa-plus'></i></a>
                </p>
                
                
                ";
            $dwnDocument = $link->query("SELECT * FROM documents ORDER BY docName");
            while ($row = mysqli_fetch_assoc($dwnDocument)) {
                switch ($row[extension]) {
                    case 'rar';
                        $icon='<i class="far fa-file-archive archColor"></i>';
                        break;
                    case 'xls':
                        $icon='<i class="far fa-file-excel excelColor"></i>';
                        break;
                    case 'xlsx':
                        $icon='<i class="far fa-file-excel excelColor"></i>';
                        break;
                    case 'pdf':
                        $icon='<i class="far fa-file-pdf pdfColor"></i>';
                        break;
                    case 'doc' or 'docx' or 'rtf':
                        $icon='<i class="far fa-file-word wordColor"></i>';
                        break;
                }
                $dataDocument = date("d.m.Y", strtotime($row[docDate]));
                echo "
                
                    <div class='documentsPageLine'>
                        
                            <div>
                                <p class='documentIcon'>$icon</p>
                            </div>
                            <div>
                                <a class='documentNameLink' href='/admin/index.php?options=documents&idDocument=$row[id]'>
                                    <p class='documentName lineNoWrap'>$row[docName]</p>
                                </a>
                                <p class='documentFilePath lineNoWrap'><b>Путь к файлу:</b> /documents/doc/$row[filepath]</p>
                                <p class='documentDate col-xs-4 text-success'><i class=\"far fa-calendar-alt\"></i> $dataDocument</p>
                                <p class='documentSize col-xs-4 text-success'><i class=\"far fa-save\"></i> $row[filesize]</p>
                                <p class='documentCategories col-xs-4 lineNoWrap text-success'><i class=\"far fa-bookmark\"></i> $row[categories]</p>
                            </div>
                        <div>
                            <p class='documentWatch text-center'>
                                <a data-fancybox data-type='iframe' data-src='/documents/doc/$row[filepath]' href='javascript:;'>
                                <i class=\"far fa-eye\"></i><span>Просмотр</span>
                                </a>
                            </p>
                        </div>
                    </div>
                
                ";
            }

        }else {
            //Конкретный документ
            if (!empty($_GET['idDocument'])){
                echo "<p class='pageNameLabel2'>Редактирование документа</p>";
                $documentID = nullControl($link,$_GET['idDocument']);
                $dwnDocumentForId = $link->query("SELECT * FROM documents WHERE id='$documentID'");
                while ($row=mysqli_fetch_assoc($dwnDocumentForId)) {
                    $filePath = '/documents/doc/' . $row[filepath];
                    $dataDocument = date("Y-m-d", strtotime($row[docDate]));
                    getDocumentForm($row[id], $row[docName], $filePath, $row[categories], $dataDocument, $row[filesize]);

                    echo "
                <div class='form-group text-left col-xs-6'>
                    <div class='row'>
                        <a href='?options=documents' class='btn btn-danger' id='exitDocument'><-- Назад</a>
                    </div>
                </div>
                
                <div class='form-group text-right col-xs-6'>
                    <div class='row'>
                        <a data-fancybox data-type='iframe' data-src='$filePath' href='javascript:;' class='btn btn-default'>Просмотр</a>
                        <a data-fancybox data-src='#confirm-deletion' data-modal='true' href='javascript:;' class='btn btn-default'>Удалить</a>
        
                        <div style=';display: none;' id='confirm-deletion'>
                            <h2>Подтвердите удаление!</h2>
                            <p>Вы точно хотите удалить этот документ? После удаления восстановить её будет невозможно.</p>
                            <div class='col-xs-12'>
                                <div class='row'>
                                    <button data-fancybox-close class='btn btn-danger acceptModalButton' >Нет</button>
                                    <a href='?options=documents&delete=$row[id]' class='btn btn-success acceptModalButton'>Да</a>
                                </div>
                            </div>
                        </div>
                        
                        <button class='btn btn-primary' id='updateDocument'>Изменить --></button>
                    </div>
                </div>
                ";
                }
            }
        }
    }
?>
</div>
