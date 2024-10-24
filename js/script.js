$(document).ready(function () {

    $(function() {
        $('#recordNotification').modal('show')
    })
//Версия для слабовидящих
    var selector = '#content, #content *, .navbar, .navbar *, .nav, .nav*, .container,  .container *, body, .menu, .logo, .logo_background, .logo_label *, .logo_text *,.phone_number_background, .phone_number_background *,.address *,.address,.grad_menu,.grad_menu *, .sale_block, .sale_block *, .era_a, .era, .carousel,.carousel *,.content *,.content,.department_block, .d_block *,.fon_block,.footer_information,.footer_information *,.department_list,.department_list *,.department_content,.department_content *,.admine,.tyt,.button_panel,.button_panel *,.news_list,.news_list *,.hi_tech,.hi_tech *,.p_serv_main,.p_serv_main *,.dms_main,.dms_main *,.joblist,.joblist *,.special_plitka,.special_plitka *,.doc_page,.doc_page *,.contacts,.contacts *,.organization, .news, .news *, .questionsPage, .questionsPage *';
    //-------------
    $('.fs-outer button').click(function(){
        $(selector).css('font-size',$(this).css('font-size'));
        $.cookie('font-size',$(this).attr('id'));
        $('.fs-outer button').removeClass('active');
        $(this).addClass('active');

    });

    $('.cs-outer button').click(function(){
        $(selector).css('color',$(this).css('color'));
        $(selector).css('background',$(this).css('background'));
        $.cookie('cs',$(this).attr('id'));
        $('.cs-outer button').removeClass('active');
        $(this).addClass('active');

    });

    $('.img-outer button').click(function(){
        if ($.cookie('img')!=='on'){
            $('img').hide();
            $.cookie('img','on');
            $('#img-onoff-text').text(' Включить изображения');
            $(this).addClass('active');
        } else
        {
            $('img').css('display','block');
            $.cookie('img','off');
            $('#img-onoff-text').text(' Выключить изображения');
            $(this).removeClass('active');
        }
    });

    if ($.cookie('sv_on')==='true'){
        $('.div_carousel, .news').hide();
        $('#sv_on').addClass('active');
        $('#sv_settings').css('display','block');
        if ($.cookie('font-size')!==null){
            $('#'+$.cookie('font-size')).click();
        }
        if ($.cookie('cs')!==null){
            $('#'+$.cookie('cs')).click();
        }

    }



    $('#sv_on').click(
        function(){
            if ($.cookie('sv_on')!=='true'){
                $.cookie('sv_on', 'true');
                if ($.cookie('font-size')==null){
                    $('#fs-n').click();
                }
                if ($.cookie('cs')==null){
                    $('#cs-bw').click();
                }

            }
            else
            {
                $.cookie('sv_on', 'false');
            }
            location.reload();
        }
    );

    $('#sv_off').click(
        function () {
            if ($.cookie('sv_on')==='true'){
                $.cookie('sv_on', 'false');
            }
            location.reload();
        }
    );

});


$(document).ready(function () {
    $('a.fancyimage').fancybox();
});


//Подсчет количества символов в формах
$(function () {
    $('#phone').keyup(function count() {
        var $n = $(this).val().length;
        $('#contInputPhone').text($n);
    });
});
$(function () {
    $('#fam').keyup(function count() {
        var $n = $(this).val().length;
        $('#contInputFam').text($n);
    });
});
$(function () {
    $('#im').keyup(function count() {
        var $n = $(this).val().length;
        $('#contInputIm').text($n);
    });
});
$(function () {
    $('#ot').keyup(function count() {
        var $n = $(this).val().length;
        $('#contInputOt').text($n);
    });
});
$(function () {
    $('#time').keyup(function count() {
        var $n = $(this).val().length;
        $('#contInputTime').text($n);
    });
});
//--------------------------------------

$(document).ready(function () {
    if ($('div').is('.p_serv_main')) {
        ajaxGetXML();
        //Поиск услуг в прейскуранте
        $(function () {
            //Если кнопка Найти нажата
            $('#paidSearchButtons').click(function () {
                //Скрываем все показанные услуги и кнопки и инф. абзац
                for (var i = 0; i < final_coun_stroke + 1; i++) {
                    $('.str' + i).hide();
                }
                //Скрываем блок с кнопками и количеством услуг
                $('.btn_block').hide();
                //Установливаем размер и цвет пространства для поиска
                $('#content_div').css({'background-color':'white'});
                //Меняем содержимое сообщения на поиск
                $('#searchInfo').text('Поиск...');
                //Выводим сообщение пользователю
                $('#searchInfo').fadeIn();
                //Удалем выделение результата предъидущего поиска
                $('.search-found').removeClass('search-found');
                //Берем в переменную введенный пользователем запрос
                n2 = $('#paidSearch').val().toLowerCase();
                //Проверяем количесво символов в запросе
                setTimeout(function () {
                    //Если символов 3 и более...
                    if (n2.length>2) {
                        //Устанавливаем пространству для поиска размер по содержимому
                        $('#content_div').css({'height':'','background-color':''});
                        //Убираем информационный абзац
                        $('#searchInfo').hide();
                        //Счетчик найденных услуг
                        var functionIsRunning = 0;
                        $('.serviceName').each(function () {
                            var textColumn2 = $(this).text();
                            // console.log(textColumn2);
                            if (textColumn2.toLowerCase().indexOf(n2)!==-1) {
                                textColumn2 = textColumn2.toLowerCase().replace( n2, '<span class="search-found">' + n2 + '</span>' );
                                $(this).html(textColumn2);
                                $(this).parent().parent().show();
                                functionIsRunning++;
                                // console.log('совпадение - ' + textColumn2);
                            }
                        });
                        $('.column1').each(function () {
                            var textColumn1 = $(this).text();
                            if (textColumn1.toLowerCase().indexOf(n2)!==-1) {
                                $(this).parent().show();
                                textColumn1 = textColumn1.replace( n2, '<span class="search-found">' + n2 + '</span>' );
                                $(this).html(textColumn1);
                                functionIsRunning++;
                                // console.log('совпадение - ' + textColumn1);
                            }
                        });

                        if (functionIsRunning === 0) {
                            $('#content_div').css({'background-color':'white'});
                            $('#searchInfo').text('К сожалению по вашему запросу ничего не удалось найти... ');
                            $('#searchInfo').show();
                        }

                    }else {
                        if (n2.length === 0) {
                            //Убираем информационный абзац
                            $('#searchInfo').hide();
                            $('#searchInfo').text('Поиск');
                            //Скрываем все строки в цикле
                            for ($i = 0; $i < final_coun_stroke + 1; $i++) {
                                $('.str' + $i).hide();
                            }
                            $('#content_div').css({'background-color':''});
                            //показываем первые строки в цикле
                            for ($i = 0; $i < stroke_number; $i++) {
                                $('.str' + $i).fadeIn();
                            }

                            //Показываем кнопки навигации
                            $('.btn_block').fadeIn();

                            //Переопределяем переменные для навигации по страницам
                            n = stroke_number;
                            flag = 0;
                        } else {
                            $('#searchInfo').text('Введите хотя бы 3 символа');
                            $('#searchInfo').show();
                        }
                    }
                }, 1000);
            });
        });

//Поиск по нажатию Enter
        $(document).keypress(function(e) {
            if(e.which === 13) {
                //Скрываем все показанные услуги и кнопки и инф. абзац
                for (var i = 0; i < final_coun_stroke + 1; i++) {
                    $('.str' + i).hide();
                }
                //Скрываем блок с кнопками и количеством услуг
                $('.btn_block').hide();
                //Установливаем размер и цвет пространства для поиска
                $('#content_div').css({'background-color':'white'});
                //Меняем содержимое сообщения на поиск
                $('#searchInfo').text('Поиск...');
                //Выводим сообщение пользователю
                $('#searchInfo').fadeIn();
                //Удалем выделение результата предъидущего поиска
                $('.search-found').removeClass('search-found');
                //Берем в переменную введенный пользователем запрос
                n2 = $('#paidSearch').val().toLowerCase();
                //Проверяем количесво символов в запросе
                setTimeout(function () {
                    //Если символов 3 и более...
                    if (n2.length>2) {
                        //Устанавливаем пространству для поиска размер по содержимому
                        $('#content_div').css({'height':'','background-color':''});
                        //Убираем информационный абзац
                        $('#searchInfo').hide();
                        //Счетчик найденных услуг
                        var functionIsRunning = 0;
                        $('.serviceName').each(function () {
                            var textColumn2 = $(this).text();
                            // console.log(textColumn2);
                            if (textColumn2.toLowerCase().indexOf(n2)!==-1) {
                                textColumn2 = textColumn2.toLowerCase().replace( n2, '<span class="search-found">' + n2 + '</span>' );
                                $(this).html(textColumn2);
                                $(this).parent().parent().show();
                                functionIsRunning++;
                                // console.log('совпадение - ' + textColumn2);
                            }
                        });
                        $('.column1').each(function () {
                            var textColumn1 = $(this).text();
                            if (textColumn1.toLowerCase().indexOf(n2)!==-1) {
                                $(this).parent().show();
                                textColumn1 = textColumn1.replace( n2, '<span class="search-found">' + n2 + '</span>' );
                                $(this).html(textColumn1);
                                functionIsRunning++;
                                // console.log('совпадение - ' + textColumn1);
                            }
                        });

                        if (functionIsRunning === 0) {
                            $('#content_div').css({'background-color':'white'});
                            $('#searchInfo').text('К сожалению по вашему запросу ничего не удалось найти... ');
                            $('#searchInfo').show();
                        }

                    }else {
                        if (n2.length === 0) {
                            //Убираем информационный абзац
                            $('#searchInfo').hide();
                            $('#searchInfo').text('Поиск');
                            //Скрываем все строки в цикле
                            for ($i = 0; $i < final_coun_stroke + 1; $i++) {
                                $('.str' + $i).hide();
                            }
                            $('#content_div').css({'background-color':''});
                            //показываем первые строки в цикле
                            for ($i = 0; $i < stroke_number; $i++) {
                                $('.str' + $i).fadeIn();
                            }

                            //Показываем кнопки навигации
                            $('.btn_block').fadeIn();

                            //Переопределяем переменные для навигации по страницам
                            n = stroke_number;
                            flag = 0;
                        } else {
                            $('#searchInfo').text('Введите хотя бы 3 символа');
                            $('#searchInfo').show();
                        }
                    }
                }, 1000);

            }
        });
    }
    //Устанавливаем число строк на одну страницу
    stroke_number = 15;
    // console.log('Элементов на странице: ' + stroke_number);
});


//Функция парсинга файла прейскуранта
function ajaxGetXML() {
    $.ajax({
        type: 'POST',
        url: 'documents/paid/price.xml',
        dataType: 'xml',
        success: function (data) {
            var html = '';
            var price = [];
            var priceLine = [];
            $(data).find('Row').each(function () {//Перебираем все Row
                priceLine = [];
                // html += '<div class="str' + index + '">';//Формируем строки
                $(this).find('Cell').each(function () {
                    id_user = $(this).find('Data').html();
                    // html += '<p class="column' + index + '">' + id_user + '</p>';

                    priceLine.push(id_user);

                });
                // console.log(priceLine);
                // html += '</div>';
                price.push(priceLine);
            });
            price.splice(0,11);
            price.splice(price.length-2,2);
            // console.log(price);

            for (i = 0; i<price.length; i++) {
                html += '<div class="price__line str' + i + '">';
                html += '<div class="price__item price__item1 column1"><p>' + price[i][2] + '</p></div>';
                html += '<div class="price__item price__item2 column1-1"><p>' + price[i][1] + '</p></div>';
                if(price[i][5] === undefined) {
                    html += '<div class="price__item price__item3 column2"><p class="serviceName">' + price[i][3] + '</p></div>';
                } else {
                    html += '<div class="price__item price__item3 column2"><p class="serviceName">' + price[i][3] + '</p><p class="commentPrice"> *' + price[i][5] + '</p></div>';
                }
                html += '<div class="price__item price__item4 column3"><p>' + price[i][4] + '</p></div>';
                html += '</div>';
            }




            $('#content_div').append(html); // выводим данные

            //Форматируем цену по прайсу
            $('.column3>p').each(function(){
                $(this).append('.00 р.');
            });

            //Считаем количество строк
            // $n = $('#content_div').find('price__line').length;

            // console.log('Количество оставшихся строк: ' + $n);

            //Удаляем  4 последних строки
            // for (i = 0; i < 4; i++) {
            //     $('.str' + $n).remove();
            //     $n -= 1;
            // }
            //Считаем число оставшихся строк
            final_coun_stroke = $('#content_div').find('.price__line').length;
            // console.log('Число строк после преобразования: ' + final_coun_stroke);
            $('.kolPrisePosition').text('Всего услуг: '+ final_coun_stroke);


            //Вычисляем число страниц
            var page_number = Math.ceil(final_coun_stroke / stroke_number);
            // console.log('Число страниц: ' + page_number);

            // for (i=1;i<$page_number;i++) {
            //
            //     $('.paid_pagination').append('<li><a class="pagNumber" href="#"">'+i+'</a></li>');
            // }

            //Скрываем все записи
            for (var i = 0; i < final_coun_stroke + 1; i++) {
                $('.str' + i).hide();
            }
            //Скрываем информационный абзац
            $('#searchInfo').hide();
            $('#content_div').css({'background-color':''});
            //Выводим первый i записей, остальные скрываем
            for (i = 0; i < stroke_number; i++) {
                $('.str' + i).fadeIn("slow");
            }
        },
        // если произошла ошибка при получении файла
        error: function () {
            alert('Файл с прейскурантом услуг временно недоступен');
        }
    });
}

//Листание страниц
$(function () {
    n = stroke_number;
    flag = 0;

    $('.lastPagNumber').click(function () {
        if (n <= final_coun_stroke-1) {
        for (i = flag; i < n; i++) {
            $('.str' + i).hide();
        }
        flag = flag + stroke_number;
        console.log('Значение 1: ' + flag);
        n = n + stroke_number;
        console.log('Значение 2: ' + n);

            for (i = flag; i < n; i++) {
                $('.str' + i).fadeIn(1000);

            }
        }
    });

    $('.firstPagNumber').click(function () {
        if (flag > 0) {
            for (i = flag; i < n; i++) {
                $('.str' + i).hide();
            }
            flag = flag - stroke_number;
            console.log('Значение 1: ' + flag);
            n = n - stroke_number;
            console.log('Значение 2: ' + n);

            for (i = flag; i < n; i++) {
                $('.str' + i).fadeIn(1000);
            }
        }
    });
});




//Возврат списка услуг к первоначальному состоянию
// $(function () {
//     //Если пользователь набирает текст
//     $('#paidSearch').keyup(function () {
//         //Берем в переменную значение из поля ввода
//         zapros = $('#paidSearch').val();
//         //Если запрос пустой
//         if(zapros === '') {
//             //Скрываем все строки в цикле
//             for (var i = 0; i < final_coun_stroke + 1; i++) {
//                 $('.str' + i).hide(1000);
//             }
//             //показываем первые строки в цикле
//             for (i = 0; i < stroke_number; i++) {
//                 $('.str' + i).fadeIn(1000);
//             }
//             //Убираем информационный абзац
//             $('#searchInfo').hide(500);
//             //Показываем кнопки навигации
//             $('.firstPagNumber').fadeIn(1000);
//             $('.kolPrisePosition').fadeIn(1000);
//             $('.lastPagNumber').fadeIn(1000);
//             //Переопределяем переменные для навигации по страницам
//             n = stroke_number;
//             flag = 0;
//         }
//     });
// });

//Добавить еще 10 новостей
$(function () {
    $('#moreNewsButton').click(function () {
        var n = $('.news_list>div>a').length;
        // alert('Начальная позиция: '+$n+' '+'Конечная позиция: '+$m);
        $.get(
            '/ajax/moreNewsToPage.php',
            {start:n},
            function(data) {
                $('.news_list>.containerNews').append(data).slideDown();
            }
        );
    });
});

// Отправка вопроса по коронавирусу
$(function () {
    $('#submitCovid').click(function () {

        $.fancybox.close();
        var str = $('form').serialize();
        console.log( str );



        $.ajax({
            url: 'ajax/dwnQuestionCovidToBase.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: str,
            type: 'get',
            success: function(msg){
                console.log(msg);
                if (msg ==='ok') {
                    $.fancybox.open('<div class=\"message\"><h2>Отлично!</h2><p>Ваш вопрос успешно отправлен нашим специалистам. <br><br> В скором времени вы получите ответ на электронную почту которую вы указали.</p></div>');
                }
            }
        });
    });
});