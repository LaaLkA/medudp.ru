<?php
function getDocumentForm ($documentId,$documentName,$filePath,$documentCategories,$documentDate,$documentSize) {
    echo"<p class='archColor'><b>Внимание!</b> Файл для загрузки должен быть в формате <b>PDF</b> и иметь <b>название латинскими символами!</b></p>";
    echo "
        
        <form method='post' enctype='multipart/form-data' class='documentForm' id='documentForm'>
            <div class='row'>"
                .getDownloadFileForm($filePath).
                "<div class='form-group col-xs-12'>
                    <label for='documentName'>Название документа*</label>
                    <input type='text' class='form-control' name='documentName' id='documentName' value='$documentName' maxlength='500' placeholder='Укажите имя документа без расширения...'>
                    <p class='text-right'><span id='contDocumentNameCount'>0</span>/500</p>
                </div>
                <div class='form-group col-xs-7'>
                    <label for='documentCategories'>Категория документа*</label>
                    <input type='text' class='form-control' name='documentCategories' id='documentCategories' value='$documentCategories' maxlength='500' placeholder='Укажите категорию документа...'>
                    <p class='text-right'><span id='documentCategoriesCount'>0</span>/500</p>
                </div>
                <div class='form-group col-xs-3'>
                    <label for='documentDate'>Дата документа*</label>
                    <input type='date' class='form-control' name='documentDate' id='documentDate' value='$documentDate'>
                </div>
                <div class='form-group col-xs-2'>
                    <label for='documentSize'>Размер файла</label>
                    <input type='text' class='form-control' name='documentSize' id='documentSize' value='$documentSize' maxlength='500' readonly>
                </div>
                
                <input type='text' class='form-control hidden' name='documentId' id='documentId' value='$documentId'>
                
                
            </div>
        </form>
    ";
}
?>