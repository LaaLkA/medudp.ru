<?php

function getDownloadFileForm ($filePath) {
    echo "
        <div class='inputDwnFileBlock'>
            <p><b>Загрузить файл*</b></p>
            <label>
                <input type='file' class='inputDwnFile' name='dwnFile' id='dwnFile'/>
                <a class='btn btn-primary'>Выберите файл...</a>
                <input class='inputNameFile' type='text' id='inputNameFile' value='$filePath' disabled />
            </label>  
        </div>
    ";
}

?>