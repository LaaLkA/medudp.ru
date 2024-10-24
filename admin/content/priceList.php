<?php

?>
<div class="col-xs-12"></div>

<div class="col-xs-12 department_page">

    <p class='pageNameLabel2'>Загрузка прейскуранта на сайт</p>

    <form method='post' enctype='multipart/form-data' class='newNewsForm'>
        <div class="row">
            <div class='inputDwnNewsImageBlock'>
                <p><b>Файл прейскуранта в PDF*</b></p>
                <label>
                    <input type='file' class='inputDwnNewsImage' name='uploadPricePdf' id='pricePdf'/>
                    <a class='btn btn-primary'>Выберите файл...</a>
                    <input class='inputNameNewsImage' type="text" id='pricePdfPrew' value="Файл не выбран..." disabled />
                </label>
                <a class='btn btn-primary' id='uploadPricePdfButton'>Загрузить</a>
            </div>
        </div>
    </form>


    <form method='post' enctype='multipart/form-data' class='newNewsForm'>
        <div class="row">
            <div class='inputDwnNewsImageBlock'>
                <p><b>Файл прейскуранта в XML*</b></p>
                <label>
                    <input type='file' class='inputDwnNewsImage' name='uploadPriceXml' id='priceXml'/>
                    <a class='btn btn-primary'>Выберите файл...</a>
                    <input class='inputNameNewsImage' type="text" id='priceXmlPrew' value="Файл не выбран..." disabled />
                </label>
                <a class='btn btn-primary' id='uploadPriceXmlButton'>Загрузить</a>
            </div>
        </div>
    </form>
</div>
