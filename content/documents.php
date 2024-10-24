<div class="col-xs-12">
    <a name="exp1"></a>
    <div class="row">
        <h3 class="era"><i class="fa fa-folder-open" aria-hidden="true"></i> <Strong>Документы учреждения</Strong></h3>
    </div>
</div>


<div class="col-xs-12 documentsPage">

        <?php
        $getAllCategories = $link->query("SELECT DISTINCT categories FROM documents WHERE categories != 'Архив' ORDER BY categories ASC ");
        while ($docCategories = mysqli_fetch_row($getAllCategories)) {
            echo "<h3 class='nameDocCategories'>$docCategories[0]</h3>";
            $getDocuments = $link->query("SELECT * FROM documents WHERE categories ='{$docCategories[0]}' ORDER BY docName ASC");
            while   ($docInformation = mysqli_fetch_assoc($getDocuments)) {
                $dataDocument = date("d.m.Y", strtotime($docInformation[docDate]));
                echo "
                <div class='oneDocWrapper'>

                                <div class='col-xs-12 docDateStroke'><div class='row'>Документ</div></div>
            
                                    <div class='docTitle col-xs-12'>$docInformation[docName]</div>
                                    <div class='col-xs-12 docDateStroke'><div class='row'>от $dataDocument</div></div>
            
                                    <div class='col-xs-12 docDateStroke'><div class='row'> $docInformation[extension], $docInformation[filesize]</div></div>
            
                                    <div class='col-xs-4'>
                                        <div class='row'>
                                            <a class='dwnButton' href='/documents/doc/$docInformation[filepath]' target='_blank'>Скачать</a>
                                            </div>
                                        </div>
                                    <div class='col-xs-5'>
                                        <div class='row'>
                                            <a class='viewButton' data-fancybox data-type='iframe' data-src='/documents/doc/$docInformation[filepath]' href='javascript:;'>Просмотреть</a>
                                        </div>
                                    </div>
                                    
                                </div>
                ";
            }
        }
        ?>

</div>