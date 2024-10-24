
//Количество знаков в полях ввода
$(function () {
    if ($('input').is('#newTitleNews')) {
        //В переменную б забираем значение поля Input
        $b = $('#newTitleNews').val();
        $('#contNewTitleNews').text($b.length);
        $('#newTitleNews').keyup(function count() {
            var $n = $(this).val().length;
            $('#contNewTitleNews').text($n);
        });
    }
    if ($('input').is('#newDescriptionNews')) {
        //В переменную б забираем значение поля Input
        $b = $('#newDescriptionNews').val();
        $('#contNewDescriptionNews').text($b.length);
        $('#newDescriptionNews').keyup(function count() {
            var $n = $(this).val().length;
            $('#contNewDescriptionNews').text($n);
        });
    }
    if ($('textarea').is('#newArticleNews')) {
        //В переменную б забираем значение поля Input
        $b = $('#newArticleNews').val();
        $('#contNewArticleNews').text($b.length);
        $('#newArticleNews').keyup(function count() {
            var $n = $(this).val().length;
            $('#contNewArticleNews').text($n);
        });
    }
    if ($('input').is('#newCategoriesNews')) {
        //В переменную б забираем значение поля Input
        $b = $('#newCategoriesNews').val();
        $('#contNewCategoriesNews').text($b.length);
        $('#newCategoriesNews').keyup(function count() {
            var $n = $(this).val().length;
            $('#contNewCategoriesNews').text($n);
        });
    }
});

//Поиск сотрудников
// $(function () {
//     $('#doctorSearchButton').click(function () {
//         $('.doctorsListChild').hide(100);
//         $('#paginationBlock').hide();
//         n2 = $('#doctorSearch').val();
//         n2 = n2.toLowerCase();
//         $('p#doctorName').each(function () {
//             var textColumn = $(this).text();
//             if (textColumn.toLowerCase().indexOf(n2)!==-1) {
//                 $(this).parent('.doctorsListChild').show(500);
//             }
//         });
//     });
// });

//Добавить еще 10 новостей
$(function () {
    $('#adminMoreNewsButton').click(function () {
        $n = $('.adminNewsListWrapper>div').length;
        // alert('Начальная позиция: '+$n);
        $.get(
            '/admin/ajax/adminMoreNewsToPage.php',
            { start: $n },
            function (data) {
                $('.adminNewsListWrapper').append(data).slideDown();
            }
        );
    });
});

//Повторно отобразить поиск
if ($('#doctorSearch').length && $('#doctorSearch').val() !== "") {
    searchDoctorsFunction();
}

//Поиск сотрудников по нажатию кнопки
$(function () {
    $('#doctorSearchButton').click(function () {
        searchDoctorsFunction();
    });
});

//Поиск сотрудников по нажатию "Enter"
$(document).ready(function () {
    $('#doctorSearch').keydown(function (e) {
        if (e.keyCode === 13) {
            searchDoctorsFunction();
        }
    });
});


function searchDoctorsFunction() {
    console.log('jr')
    $('#doctorSearch').removeClass('errorStyle')
    $('.doctorsList').removeClass('searchResult')
    $('#doctorSearch').attr('placeholder', 'Поиск')
    $('.doctorsList').empty();
    n2 = $('#doctorSearch').val();
    if (n2 !== "") {
        n2 = n2.toLowerCase();

        $.ajax({
            url: '/admin/ajax/searchDoctors.php',
            method: 'post',
            dataType: 'html',
            data: { search: n2 },
            success: function (php_response) {
                php_response = php_response.replace(/\r?\n/g, '');
                // console.log(php_response);
                $('.doctorsList').addClass('searchResult')
                $('.doctorsList').append(php_response).slideDown(1000);
            }
        });
    } else {
        $('.doctorsList').removeClass('searchResult')
        $('.doctorsList').empty();
        $('#doctorSearch').addClass('errorStyle')
        $('#doctorSearch').attr('placeholder', 'Поисковый запрос не может быть пустым...')
    }
}



//Отображение имени загружаемого файла в поле Input
$(function () {
    $('#newsImage').change(function () {
        var f_name = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            f_name.push(' ' + $(this).get(0).files[i].name);
        }
        $('#inputNameNewsImage').val(f_name.join(', '));
    });
});
$(function () {
    $('#pricePdf').change(function () {
        var f_name = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            f_name.push(' ' + $(this).get(0).files[i].name);
        }
        $('#pricePdfPrew').val(f_name.join(', '));
    });
});

$(function () {
    $('#priceXml').change(function () {
        var f_name = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            f_name.push(' ' + $(this).get(0).files[i].name);
        }
        $('#priceXmlPrew').val(f_name.join(', '));
    });
});

$(function () {
    $('#dwnFile').change(function () {
        var f_name = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            f_name.push(' ' + $(this).get(0).files[i].name);
        }
        $('#inputNameFile').val(f_name.join(', '));
    });
});

//Загрузка прейскуранта в XML
$('#uploadPriceXmlButton').on('click', function () {
    var file2 = $('#priceXml');
    var file_data2 = $('#priceXml').prop('files')[0];
    // console.log(file_data);
    if (file2.prop('files').length) {
        var form_data2 = new FormData();
        form_data2.append('file', file_data2);
        $.ajax({
            url: '/admin/ajax/dwnPriceXml.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data2,
            type: 'post',
            success: function (php_response) {
                php_response = php_response.replace(/\r?\n/g, '');
                console.log(php_response);

                if (php_response === 'xError2') {
                    $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>При загрузке файла произошла непредвиденная ошибка! <br> Обратитесь к администратору сайта для устранения.</p></div>');
                } else {
                    if (php_response === 'xError3') {
                        $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Размер файла превышает 5.00 Мб.</p></div>');
                    } else {
                        if (php_response === 'xError4') {
                            $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Прикрепленный файл не является PDF!</p></div>');
                        } else {
                            if (php_response === 'xok') {
                                $.fancybox.open('<div class=\"message\"><h2 class="text-success">Отлично!</h2><p>Новый прейскурант в формате XML успешно загружен!</p></div>');
                                $('#priceXmlPrew').val('Файл не выбран...');
                            }
                        }
                    }
                }
            }
        });
    } else {
        $.fancybox.open('<div class=\"message\"><h2 class="text-warning">Ошибка!</h2><p>Не выбран файл для загрузки!</p></div>');
    }
});

//Загрузка прейскуранта в PDF
$('#uploadPricePdfButton').on('click', function () {
    var file = $('#pricePdf');
    var file_data = $('#pricePdf').prop('files')[0];
    // console.log(file_data);
    if (file.prop('files').length) {
        var form_data = new FormData();
        form_data.append('file', file_data);
        // console.log(form_data);

        $.ajax({
            url: '/admin/ajax/dwnPricePdf.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (php_script_response) {

                if (php_script_response === 'imgError2') {
                    $.fancybox.open('<div class=\"message\"><h2 class="text-danger">Ошибка!</h2><p>При загрузке файла произошла непредвиденная ошибка! <br> Обратитесь к администратору сайта для устранения.</p></div>');
                } else {
                    if (php_script_response === 'imgError3') {
                        $.fancybox.open('<div class=\"message\"><h2 class="text-warning">Ошибка!</h2><p>Размер файла превышает 5.00 Мб.</p></div>');
                    } else {
                        if (php_script_response === 'imgError4') {
                            $.fancybox.open('<div class=\"message\"><h2 class="text-warning">Ошибка!</h2><p>Прикрепленный файл не является PDF!</p></div>');
                        } else {
                            if (php_script_response === 'ok') {
                                $.fancybox.open('<div class=\"message\"><h2 class="text-success">Отлично!</h2><p>Новый прейскурант в формате PDF успешно загружен!</p></div>');
                                $('#pricePdfPrew').val('Файл не выбран...');
                            }
                        }
                    }
                }

            }
        });
    } else {
        $.fancybox.open('<div class=\"message\"><h2 class="text-warning">Ошибка!</h2><p>Не выбран файл для загрузки!</p></div>');
    }
});





//Загрузка и отображение изображения новости
$('#uploadNewsImage').on('click', function () {
    var file = $('#newsImage');
    var file_data = $('#newsImage').prop('files')[0];
    // console.log(file_data);
    if (file.prop('files').length) {
        var form_data = new FormData();
        form_data.append('file', file_data);
        // console.log(form_data);
        // alert(file_data);
        $.ajax({
            url: '/admin/ajax/newsPreviewImg.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (php_script_response) {
                console.log(php_script_response);
                if (php_script_response === 'imgError1') {
                    $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Соотношение сторон изображения превышает 835 на 475 пикселей.</p></div>');
                } else {
                    if (php_script_response === 'imgError2') {
                        $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>При загрузке файла произошла непредвиденная ошибка! <br> Обратитесь к администратору сайта для устранения.</p></div>');
                    } else {
                        if (php_script_response === 'imgError3') {
                            $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Размер изображения превышает 5.00 Мб.</p></div>');
                        } else {
                            if (php_script_response === 'imgError4') {
                                $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Прикрепленный файл не является изображением!</p></div>');
                            } else {
                                $('#newImagePre').attr('src', '/img/news/little_' + php_script_response);
                                $('#imgName').attr('value', php_script_response);
                                $('#exitNewNews').attr('href', '?options=news&deletePrewImg=' + php_script_response);
                            }
                        }
                    }
                }
            }
        });
    } else {
        $.fancybox.open('<div class=\"message\"><h2 class="text-warning">Ошибка!</h2><p>Не выбран файл для загрузки!</p></div>');
    }
});

//Отключение выделения поля инпут при заполнении
$(function () {
    $('#newTitleNews').focus(function () {
        $('#newTitleNews').removeClass('emptyInput');
    });
    $('#newDescriptionNews').focus(function () {
        $('#newDescriptionNews').removeClass('emptyInput');
    });
    $('#newArticleNews').focus(function () {
        $('#newArticleNews').removeClass('emptyInput');
    });
    $('#newCategoriesNews').focus(function () {
        $('#newCategoriesNews').removeClass('emptyInput');
    });
});

//Добавление новости
$('#addNewNewsButton').on('click', function () {
    if ($('#imgName').val() === '') {
        $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Вы не загрузили изображение сопровождающее новость.</p></div>');
    } else {
        if ($('#newTitleNews').val() === '') {
            $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Поле <b>"Заголовок новости"</b> не заполнено.</p></div>');
            $('#newTitleNews').addClass('emptyInput');
        } else {
            if ($('#newDescriptionNews').val() === '') {
                $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Поле <b>"Краткое описание новости"</b> не заполнено.</p></div>');
                $('#newDescriptionNews').addClass('emptyInput');
            } else {
                if ($('#newArticleNews').val() === '') {
                    $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Поле <b>"Содержание новости"</b> не заполнено.</p></div>');
                    $('#newArticleNews').addClass('emptyInput');
                } else {
                    if ($('#newCategoriesNews').val() === '') {
                        $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Поле <b>"Категория"</b> не заполнено.</p></div>');
                        $('#newCategoriesNews').addClass('emptyInput');
                    } else {
                        var news_form_data = new FormData(document.getElementById('newNewsForm'));
                        for (var pair of news_form_data.entries()) {
                            console.log(pair[0] + ' - ' + pair[1]);
                        }
                        $.ajax({
                            url: '/admin/ajax/newNewsDwn.php',
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: news_form_data,
                            type: 'post',
                            success: function (php_script_response) {
                                if (php_script_response === 'noError') {
                                    window.location.href = '?options=news&newNewsDone';
                                }
                                if (php_script_response === 'formError') {
                                    $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Произошла ошибка записи в базу данных, обратитеть к администратору.</p></div>');
                                }
                            }
                        });
                    }
                }
            }
        }
    }
});

//Изменение новости
$('#updateNewsButton').on('click', function () {
    if ($('#imgName').val() === '') {
        $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Вы не загрузили изображение сопровождающее новость.</p></div>');
    } else {
        if ($('#newTitleNews').val() === '') {
            $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Поле <b>"Заголовок новости"</b> не заполнено.</p></div>');
            $('#newTitleNews').addClass('emptyInput');
        } else {
            if ($('#newDescriptionNews').val() === '') {
                $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Поле <b>"Краткое описание новости"</b> не заполнено.</p></div>');
                $('#newDescriptionNews').addClass('emptyInput');
            } else {
                if ($('#newArticleNews').val() === '') {
                    $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Поле <b>"Содержание новости"</b> не заполнено.</p></div>');
                    $('#newArticleNews').addClass('emptyInput');
                } else {
                    if ($('#newCategoriesNews').val() === '') {
                        $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Поле <b>"Категория"</b> не заполнено.</p></div>');
                        $('#newCategoriesNews').addClass('emptyInput');
                    } else {
                        var news_form_data = new FormData(document.getElementById('newNewsForm'));
                        for (var pair of news_form_data.entries()) {
                            console.log(pair[0] + ' - ' + pair[1]);
                        }
                        $.ajax({
                            url: '/admin/ajax/updateNewsDwn.php',
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: news_form_data,
                            type: 'post',
                            success: function (php_script_response) {
                                if (php_script_response === 'noError') {
                                    window.location.href = '?options=news&newNewsDone';
                                }
                                if (php_script_response === 'formError') {
                                    $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Произошла ошибка записи в базу данных, обратитеть к администратору.</p></div>');
                                }
                            }
                        });
                    }
                }
            }
        }
    }
});



//Форматирование текста новости
function addTag(open, close) {
    var control = $('#newArticleNews')[0];
    var start = control.selectionStart;
    var end = control.selectionEnd;
    if (start !== end) {
        var text = $(control).val();
        $(control).val(text.substring(0, start) + open + text.substring(start, end) + close + text.substring(end));
        $(control).focus();
        var sel = end + (open + close).length;
        control.setSelectionRange(sel, sel);
    }
    return false;
}

// Жирный
$('#button-b').click(function () {
    return addTag('<b>', '</b>');
});

// Курсив
$('#button-i').click(function () {
    return addTag('<i>', '</i>');
});

// Подчеркнутый
$('#button-u').click(function () {
    return addTag('<u>', '</u>');
});

// Зачеркнутый
$('#button-s').click(function () {
    return addTag('<s>', '</s>');
});

// Ссылка
$('#button-a').click(function () {
    return addTag('<a href="' + prompt('Введите адрес', '') + '">', '</a>');
});

// При клике на кнопки не снимаем фокус с textarea.
$('a').on('mousedown', function () {
    return false;
});

//Добавление нового документа
$(function () {
    $('#addNewDocument').click(function () {
        var documentFile = $('#dwnFile');
        if (documentFile.prop('files').length === 1) {
            var documentForm = new FormData(document.getElementById('documentForm'));
            var fileName = documentFile.attr('name');
            var file = documentFile.prop('files')[0];
            documentForm.append(fileName, file);
            documentForm.append('addNewDocument', '1');

            // for (var pair of documentForm.entries()) {
            //     console.log(pair[0]+ ' - ' + pair[1]);
            // }
            $.ajax({
                url: '/admin/ajax/dwnDocument.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: documentForm,
                type: 'post',
                success: function (php_script_response) {
                    console.log(php_script_response);
                    if (php_script_response === 'ok') {
                        window.location.href = '?options=documents&newDocOk';
                    }
                    if (php_script_response === 'imgError1') {
                        $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Соотношение сторон изображения превышает 835 на 475 пикселей.</p></div>');
                    } else {
                        if (php_script_response === 'imgError2') {
                            $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>При загрузке файла произошла непредвиденная ошибка! <br> Обратитесь к администратору сайта для устранения.</p></div>');
                        } else {
                            if (php_script_response === 'imgError3') {
                                $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Размер изображения превышает 5.00 Мб.</p></div>');
                            } else {
                                if (php_script_response === 'imgError4') {
                                    $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Прикрепленный файл не является PDF файлом!</p></div>');
                                }
                            }
                        }
                    }
                }
            });
        } else {
            $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Вы должны прикрепить файл</p></div>');
        }
    });
});

// Изменение документа
$(function () {
    $('#updateDocument').click(function () {
        var documentForm = new FormData(document.getElementById('documentForm'));
        var documentFile = $('#dwnFile');
        console.log(documentFile);
        if (documentFile.prop('files').length === 1) {
            var fileName = documentFile.attr('name');
            var file = documentFile.prop('files')[0];
            documentForm.append(fileName, file);
        }

        for (var pair of documentForm.entries()) {
            console.log(pair[0] + ' - ' + pair[1]);
        }
        $.ajax({
            url: '/admin/ajax/dwnDocument.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: documentForm,
            type: 'post',
            success: function (php_script_response) {
                console.log(php_script_response);
                if (php_script_response === 'ok') {
                    window.location.href = '?options=documents&updDocOk';
                }
                if (php_script_response === 'imgError1') {
                    $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Соотношение сторон изображения превышает 835 на 475 пикселей.</p></div>');
                } else {
                    if (php_script_response === 'imgError2') {
                        $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>При загрузке файла произошла непредвиденная ошибка! <br> Обратитесь к администратору сайта для устранения.</p></div>');
                    } else {
                        if (php_script_response === 'imgError3') {
                            $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Размер изображения превышает 5.00 Мб.</p></div>');
                        } else {
                            if (php_script_response === 'imgError4') {
                                $.fancybox.open('<div class=\"message\"><h2>Ошибка!</h2><p>Прикрепленный файл не является PDF файлом!</p></div>');
                            }
                        }
                    }
                }
            }
        });
    });
});


