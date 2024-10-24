<div class="col-xs-12 department_page">
<?php

//Сообщение об успешном добавлении новости
if (isset($_GET['newNewsDone'])){
    infMessage('Всё отлично!','Новость успешно опубликована на сайте');
}
//Удаление новости
if (isset($_GET['delete'])) {
    if (!empty($_GET['delete'])) {
        $deleteId = nullControl($link,$_GET['delete']);
        $getNewsImgName = $link->query("SELECT * FROM news WHERE id='$deleteId'");
        $newsImgName = mysqli_fetch_assoc($getNewsImgName);
        unlink('../img/news/little_'.$newsImgName[image_name]);
        //Удаление записи в базе данных
        $deleteNews = $link->query("DELETE FROM news WHERE id='$deleteId'");
        infMessage('Всё отлично!', 'Новость была успешно удалена с сайта');
    } else {
        infMessage('Что то пошло не так =(', '<b>Внимание!</b> При удалении новости произошла непредвиденная ошибка');
    }
}
//Удаление превью новой новости
if (isset($_GET['deletePrewImg'])) {
    if (!empty($_GET['deletePrewImg'])) {
        $deleteImgName = nullControl($link,$_GET['deletePrewImg']);
        unlink('../img/news/little_'.$deleteImgName);
    }
}


//Форма добавления новой новости
if (isset($_GET['addNewNews'])){
    $dateNow = date('Y-m-d');
    echo "
        <p class='pageNameLabel2'>Добавление новой новости</p>
                
                    <form method='post' enctype='multipart/form-data' class='newNewsForm'>
                        <div class='col-xs-8'>
                            <div class='row'>
                                <img src='/img/news/nobanner.jpg' class='img-rounded' id='newImagePre'>
                            </div>
                        </div>
                        <div class='col-xs-4'>
                            <p class='imgDescription'>Изображение (баннер), сопровождающее новость должно иметь соотношение сторон <b>16:9</b> и иметь размер не более <b>835 на 470 пикселей.</b></p>      
                            <br>
                            <br>
                            <p>Оптимальный размер изображения <b>835 на 470 пикселей</b>.</p>
                            <br>
                            <p>Размер изображения не должен превышать <b>5 Мб.</b></p>
                        </div>
                        <div class='clearfix'></div>
                        <br>
                        <div class='row'>
                            <div class='inputDwnNewsImageBlock'>
                                <p><b>Загрузить изображение*</b></p>
                                <label>
                                    <input type='file' class='inputDwnNewsImage' name='newsImage' id='newsImage'/>
                                    <a class='btn btn-primary'>Выберите файл...</a>
                                    <input class='inputNameNewsImage' type='text' id='inputNameNewsImage' value='Файл не выбран...' disabled />
                                </label>  
                                <a class='btn btn-primary' id='uploadNewsImage'>Загрузить</a>
                            </div>
                        </div>
                    </form>
                    
                    <form method='post'  enctype='multipart/form-data' class='newNewsForm' id='newNewsForm'>
                        <div class='row'>
                            <input type='text' name='imgName' id='imgName' class='hidden'>
                            <div class='form-group col-xs-12'>
                                <label for='newTitleNews'>Заголовок новости*</label>
                                <input type='text' class='form-control' name='newTitleNews' id='newTitleNews' value='$row[title]' maxlength='500'>
                                <p class='text-right'><span id='contNewTitleNews'>0</span>/500</p>
                            </div>
                            <div class='form-group col-xs-12'>
                                <label for='newDescriptionNews'>Краткое описание новости*</label>
                                <input type='text' class='form-control' name='newDescriptionNews' id='newDescriptionNews' value='$row[description]' maxlength='160'>
                                <p class='text-right'><span id='contNewDescriptionNews'>0</span>/160</p>
                            </div>
                            <div class='form-group col-xs-12'>
                                <label for='newArticleNews'>Содержание новости*</label><br>
                                <div class='col-xs-12 adminNewsButtonsWrapper'>
                                    <div class='row'>
                                        <a id='button-b' href='#' class='btn btn-default '><i class='fa fa-bold' aria-hidden='true'></i></a>
                                        <a id='button-i' href='#' class='btn btn-default'><i class='fa fa-italic' aria-hidden='true'></i></a>
                                        <a id='button-u' href='#' class='btn btn-default'><i class='fa fa-underline' aria-hidden='true'></i></a>
                                        <a id='button-s' href='#' class='btn btn-default'><i class='fa fa-strikethrough' aria-hidden='true'></i></a>
                                        <a id='button-a' href='#' class='btn btn-default'><i class='fa fa-link' aria-hidden='true'></i></a>
                                    </div>
                                </div>
                                <textarea class='form-control' rows='20' name='newArticleNews' id='newArticleNews'>
<b>Уважаемые пациенты!</b>


<b>Записаться на прием</b>, а также задать все интересующие Вас вопросы Вы можете позвонив <b>по многоканальному номеру: 8 (499) 243-72-33</b>, отправив сообщение на электронную почту: do@medudp.ru или с помощью формы записи к специалистам.
                                </textarea>
                                <p class='text-right'><span id='contNewArticleNews'>0</span></p>
                            </div>
                            <div class='form-group col-xs-4'>
                                <label for='newTimeNews'>Дата публикации новости*</label>
                                <input type='date' class='form-control' name='newTimeNews' value='$dateNow'>
                            </div>
                            <div class='form-group col-xs-4'>
                                <label for='newCategoriesNews'>Категория*</label>
                                <input class='form-control' name='newCategoriesNews' id='newCategoriesNews' value='Новости поликлиники' maxlength='255'>
                                <p class='text-right'><span id='contNewCategoriesNews'>0</span>/255</p>
                            </div>
                            <div class='checkbox col-xs-4'>
                            <br>
                                <label>
                                  <input type='checkbox' name='newDetMarker'> Для детского отделения
                                </label>
                            </div> 
                        </div>
                    </form>    
                    
                    <div class='row'>
                        <div class='form-group text-left col-xs-6'>
                            <a href='?options=news' class='btn btn-danger' id='exitNewNews'>Отмена</a>
                        </div>
                        <div class='form-group text-right col-xs-6'>
                            <button class='btn btn-success' id='addNewNewsButton'>Добавить</button>
                        </div>
                    </div>                       
    ";
} else {
    //Список последних новостей
    if (!isset($_GET['idNews'])) {
        echo "
    
    <p class='col-xs-6 pageNameLabel'>Управление новостями</p>

    <div class='col-xs-6 gordon text-right'>
        <a href='?options=news&addNewNews' class='btn btn-primary'><i class='fas fa-plus'></i></a>
    </div>

    <div class='col-xs-12 newsPageAdmin'>
    
    ";
        $giveNewsList = mysqli_query($link, "SELECT * FROM news ORDER BY id DESC LIMIT 5");
        echo"
        <div class='adminNewsListWrapper'>
            
        ";
        while ($row = mysqli_fetch_assoc($giveNewsList)) {
            $dateNews = date("d.m.Y", strtotime($row[time]));
            echo "
                <div class='newsPageAdminChild'>
                    <a href='/admin/index.php?options=news&idNews=$row[id]'>  
                        <div class='newsImg'><img src='../img/news/little_" . $row[image_name] . "' class='img-rounded' width='200px'></div>
                        <div id='newsMetaInformation'>
                            <div class='newsTitle'><b>$row[title]</b></div>
                            <div class='newsSubInfo'>
                                <div class='newsDate'><i class='far fa-calendar-alt'></i> $dateNews</div>";
            if ($row[det_marker] == 1) {
                echo "          <div class='newsKids'><i class='fas fa-check'></i> Для детского корпуса</div>";
            }
        echo "          
                            </div>
                        </div>
                    </a>
                </div>
            ";
            $indexb++;
        }
        echo"
            
        </div>
        <div class='col-xs-12 text-center'>
            <div class='row'>
                <button id='adminMoreNewsButton'>Показать еще</button>
            </div>
        </div>
        ";
    } else {
        //Конкретная новость
        if (!empty($_GET['idNews'])) {
            $newsID = nullControl($link, $_GET['idNews']);
            $dwnNews = $link->query("SELECT * FROM news WHERE id='$newsID'");
            while ($row = mysqli_fetch_assoc($dwnNews)) {
                echo "
            
                <p class='pageNameLabel2'>Редактирование новости</p>
                
                    <form method='post' action='?options=news' enctype='multipart/form-data' class='updateNewsForm' >
                        <div class='col-xs-8'>
                            <div class='row'>
                                <img src='../img/news/little_" . $row[image_name] . "' class='img-rounded' id='newImagePre'>
                            </div>
                        </div>
                        <div class='col-xs-4'>
                            <p class='imgDescription'>Изображение (баннер), сопровождающее новость должно иметь соотношение сторон <b>16:9</b> и иметь размер не более <b>835 на 470 пикселей.</b></p>
                            <br>
                            <br>
                            <p>Оптимальный размер изображения <b>835 на 470 пикселей</b>.</p>
                            <br>
                            <p>Размер изображения не должен превышать <b>5 Мб.</b></p>
                        </div>
                        <div class='clearfix'></div>
                        <br>
                        <div class='row'>
                            <div class='inputDwnNewsImageBlock'>
                                <p><b>Загрузить изображение*</b></p>
                                <label>
                                    <input type='file' class='inputDwnNewsImage' name='newsImage' id='newsImage'/>
                                    <a class='btn btn-primary'>Выберите файл...</a>
                                    <input class='inputNameNewsImage' type='text' id='inputNameNewsImage' value='/img/news/little_$row[image_name]' disabled />
                                </label>  
                                <a class='btn btn-primary' id='uploadNewsImage'>Загрузить</a>
                            </div>
                        </div>
                    </form>    
                            
                            
                    <form method='post'  enctype='multipart/form-data' class='newNewsForm' id='newNewsForm'>       
                        <div class='row'>
                            <input type='text' name='idNews' id='idNews' class='hidden' value='$row[id]'>
                            <input type='text' name='imgName' id='imgName' class='hidden' value='$row[image_name]'>
                            <div class='form-group col-xs-12'>
                                <label for='newTitleNews'>Заголовок новости*</label>
                                <input type='text' class='form-control' name='newTitleNews' id='newTitleNews' value='$row[title]' maxlength='500'>
                                <p class='text-right'><span id='contNewTitleNews'>0</span>/500</p>
                            </div>
                            <div class='form-group col-xs-12'>
                                <label for='newDescriptionNews'>Краткое описание новости*</label>
                                <input type='text' class='form-control' name='newDescriptionNews' id='newDescriptionNews' value='$row[description]' maxlength='160'>
                                <p class='text-right'><span id='contNewDescriptionNews'>0</span>/160</p>
                            </div>
                            <div class='form-group col-xs-12'>
                                <label for='newArticleNews'>Содержание новости*</label>
                                <div class='col-xs-12 adminNewsButtonsWrapper'>
                                    <div class='row'>
                                        <a id='button-b' href='#' class='btn btn-default '><i class='fa fa-bold' aria-hidden='true'></i></a>
                                        <a id='button-i' href='#' class='btn btn-default'><i class='fa fa-italic' aria-hidden='true'></i></a>
                                        <a id='button-u' href='#' class='btn btn-default'><i class='fa fa-underline' aria-hidden='true'></i></a>
                                        <a id='button-s' href='#' class='btn btn-default'><i class='fa fa-strikethrough' aria-hidden='true'></i></a>
                                        <a id='button-a' href='#' class='btn btn-default'><i class='fa fa-link' aria-hidden='true'></i></a>
                                    </div>
                                </div>
                                <textarea class='form-control' rows='10' name='newArticleNews' id='newArticleNews'>$row[article]</textarea>
                                <p class='text-right'><span id='contNewArticleNews'>0</span></p>
                            </div>
                            <div class='form-group col-md-4'>
                                <label for='newTimeNews'>Дата публикации новости*</label>
                                <input type='date' class='form-control' name='newTimeNews' value='$row[time]'>
                            </div>
                            <div class='form-group col-xs-4'>
                                <label for='newCategoriesNews'>Категория*</label>
                                <input class='form-control' name='newCategoriesNews' id='newCategoriesNews' value='$row[categories]' maxlength='255'>
                                <p class='text-right'><span id='contNewCategoriesNews'>0</span>/255</p>
                            </div>
                            <div class='checkbox col-xs-4'>
                            <br>
                                <label>
                                  <input type='checkbox' name='newDetMarker'";
                                    if ($row[det_marker]==1) {
                                        echo "checked";
                                    }
                                    echo "> Для детского отделения
                                </label>
                            </div>
                        </div>
                    </form>
                    
                    
                    
                    <div class='row'>
                        <div class='form-group text-left col-xs-6'>
                            <a href='?options=news' class='btn btn-danger' id='exitNewNews'><-- Назад</a>
                        </div>
                        
                        <div class='form-group text-right col-xs-6'>
                            
                            <a data-fancybox data-src='#confirm-deletion' data-modal='true' href='javascript:;' class='btn btn-default'>Удалить</a>
            
                            <div style='display: none;' id='confirm-deletion'>
                                <h2>Подтвердите удаление!</h2>
                                <p>Вы точно хотите удалить эту новость? После удаления восстановить её будет невозможно.</p>
                                <div class='col-xs-12'>
                                    <div class='row'>
                                        <button data-fancybox-close class='btn btn-danger acceptModalButton' >Нет</button>
                                        <a href='?options=news&delete=$row[id]' class='btn btn-success acceptModalButton'>Да</a>
                                    </div>
                                </div>
                            </div>
                            
                            <button class='btn btn-primary' id='updateNewsButton'>Изменить --></button>
                            
                        </div>
                    </div>
                        
                     
            ";
            }
        }
    }
}

?>
</div>
