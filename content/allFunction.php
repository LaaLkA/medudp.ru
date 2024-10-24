<?php
function getTitlePage($linkDatabase, $page, $dep_name, $news_id) //функция вывода заголовка страницы
{


    if (!empty($page) & empty($dep_name)) {
        if (!empty($news_id)) {
            $a = $news_id;
            $addTitle = mysqli_query($linkDatabase, "SELECT * FROM news WHERE id=$a");
            while ($row = mysqli_fetch_row($addTitle)) {
                print "<meta name='description' content='$row[2]'>";
                print "<title>" . $row[1] . "</title>";
            }
        } else {
            $a = "'" . $page . "'";
            $addTitle = mysqli_query($linkDatabase, "SELECT * FROM titleName WHERE page=$a");
            while ($row = mysqli_fetch_row($addTitle)) {
                if (empty($row[2])) {
                    $TitlePage = $row[3];
                    print "<meta name='keywords' content='$row[5]'>";
                    print "<meta name='description' content='$row[4]'>";
                    print $row[6];
                }
            }
            print "<title>" . $TitlePage . " - ФГБУ 'Поликлиника №4'" . "</title>";
        }
    }


    if (!empty($dep_name)) {
        $b = "'" . $dep_name . "'";
        $addTitle = mysqli_query($linkDatabase, "SELECT * FROM titleName WHERE department_name=$b");
        $row = mysqli_fetch_row($addTitle);
        print "<meta name='description' content='$row[4]'>";
        print "<title>" . $row[3] . " - ФГБУ 'Поликлиника №4'" . "</title>";
    }

    if (empty($page) & empty($dep_name)) {
        print "<meta name='keywords' content='поликлиника 4 управления делами президента, фгбу поликлиника 4 управления делами президента рф официальный сайт, поликлиника 4 управления делами президента рф официальный сайт, сайт поликлиника 4'>";
        print "<meta name='description' content='Поликлиника №4 - уникальное семейное лечебно-профилактическое учреждение, в его стенах медицинскую помощь могут получать как взрослые, так и дети. '>";
        print "<title>ФГБУ 'Поликлиника №4' Управления делами Президента РФ</title>";
    }
}

//Преобразование даты из базы данных
function convertDate($date)
{
    $date = strtotime($date);
    $convertDate = date("d.m.Y", $date);
    return $convertDate;
}


//Вывод информационного сообщения
function infMessage($title, $message)
{
    echo "
    
    <div class='modal fade bs-example-modal-lg' id='recordNotification' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-lg'>
        <div class='modal-content'>
        <div class='modal-header'>
          <h4 class='modal-title'>$title</h4>
        </div>
        <div class='modal-body'>
        <div class='notBody'>
            $message
        </div>
        <div class='text-right'>
        <button type='button' class='btn btn-primary' data-dismiss='modal'>Ок</button></div>
        
        </div>
      </div>
    </div>
  </div>
  ";
}

//Заагрузка персонала на страницы отделения
function givePersonalList($nameDep, $appointmentName, $linkDatabase)
{

    echo "<div class='row'>";
    if (!empty($appointmentName)) {
        $doc_see = mysqli_query($linkDatabase, "SELECT * FROM doctors WHERE department=$nameDep and appointment LIKE $appointmentName ORDER BY form_appointment, last_name ASC");
    } else {
        $doc_see = mysqli_query($linkDatabase, "SELECT * FROM doctors WHERE department=$nameDep ORDER BY form_appointment, last_name ASC");
    };
    while ($row = mysqli_fetch_row($doc_see)) {
        echo "
            <div class='row doctorMainCard'>
                <div class='col-md-2 col-sm-2'>
                    <img src='/admin/gallery/" . $row[11] . "' class='img-rounded'>
                </div>
                <div class='col-md-8 col-sm-8 doctor_card'>
                    <h3>$row[5] $row[4] $row[6]</h3>
                    <p>$row[2]</p>";
        if (!empty($row[7])) {
            echo "<p><b><span style='color: darkred'>График приема:</span> </b> $row[7]</p>";
        }
        echo "              </div>
                <div class='col-sm-2 col-md-2 button_panel'>
                            <p class='text-center'><button class='btn btn-info btn-sm bt_q' type='button' data-toggle='modal' data-target='#myModal$row[0]'><i class='far fa-address-card'></i> Подробнее</button></p>";

        $checkRecordDep = mysqli_query($linkDatabase, "SELECT * FROM departments WHERE dpname=$nameDep");
        while ($run = mysqli_fetch_row($checkRecordDep)) {
            if ($run[4] == 1) {
                if ($row[3] == 1 || $row[3] == 2) {
                    if ($row[14] != 1) {
                        echo "<p class='text-center'><button class='btn btn-primary btn-sm bt_m' type='button' data-toggle='modal' data-target='#ModalRecord$row[0]'><i class='fas fa-edit'></i> Записаться</button></p>";
                    }
                }
            }
        }

        echo "<div id='myModal$row[0]' class='modal fade'>
                                <div class='modal-dialog modal-md'>
                                    <div class='modal-content'>
                                        <div class='modal-body'>
                                            <p class='text-center'><img class='img-rounded' src='https://www.medudp.ru/admin/gallery/$row[11]' width=100%></p>
                                            <h3>$row[5] $row[4] $row[6]</h3>
                                            <p>$row[2]</p>";
        if (!empty($row[7])) {
            echo "<p><b><span style='color: darkred'> График приема:</span></b> $row[7]</p>";
        }
        echo nl2br($row[8]);
        if (!empty($row[9]) && !empty($row[10])) {
            $convertEndSert = convertDate($row[10]);
            echo "
            <br>
            <br>
            <p><b>Сведения о сертификате:</b> $row[9]</p>
            <p><b>Дата окончания сертификата:</b> $convertEndSert</p>

            ";
        }
        if (!empty($row[12]) && !empty($row[13])) {
            $convertEndSert2 = convertDate($row[13]);
            echo "
            <br>
            <p><b>Сведения о сертификате:</b> $row[12]</p>
            <p><b>Дата окончания сертификата:</b> $convertEndSert2</p>

            ";
        }
        echo "
                            </div>
                                        <div class='modal-footer'>
                                            <button class='btn btn-default' type='button' data-dismiss='modal'>Закрыть</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <div class='clearfix'></div>";
        $recordName = $row[5] . ' ' . $row[4] . ' ' . $row[6];
        getRecordForm($row[0], $recordName);
    }
    echo "</div>";
}

//Заагрузка персонала на страницы отделения
function givePersonalListForFunctional($nameDep, $appointmentName, $linkDatabase)
{

    echo "<div class='row'>";
    if (!empty($appointmentName)) {
        $doc_see = mysqli_query($linkDatabase, "SELECT * FROM doctors WHERE department=$nameDep AND appointment LIKE $appointmentName AND id != 249 ORDER BY form_appointment, last_name ASC");
    } else {
        $doc_see = mysqli_query($linkDatabase, "SELECT * FROM doctors WHERE department=$nameDep ORDER BY form_appointment, last_name ASC");
    };
    while ($row = mysqli_fetch_row($doc_see)) {
        echo "
            <div class='row doctorMainCard'>
                <div class='col-md-2 col-sm-2'>
                    <img src='/admin/gallery/" . $row[11] . "' class='img-rounded'>
                </div>
                <div class='col-md-8 col-sm-8 doctor_card'>
                    <h3>$row[5] $row[4] $row[6]</h3>
                    <p>$row[2]</p>";
        if (!empty($row[7])) {
            echo "<p><b><span style='color: darkred'>График приема:</span> </b> $row[7]</p>";
        }
        echo "              </div>
                <div class='col-sm-2 col-md-2 button_panel'>
                            <p class='text-center'><button class='btn btn-info btn-sm bt_q' type='button' data-toggle='modal' data-target='#myModal$row[0]'><i class='far fa-address-card'></i> Подробнее</button></p>";

        $checkRecordDep = mysqli_query($linkDatabase, "SELECT * FROM departments WHERE dpname=$nameDep");
        while ($run = mysqli_fetch_row($checkRecordDep)) {
            if ($run[4] == 1) {
                if ($row[3] == 1 || $row[3] == 2) {
                    if ($row[14] != 1) {
                        echo "<p class='text-center'><button class='btn btn-primary btn-sm bt_m' type='button' data-toggle='modal' data-target='#ModalRecord$row[0]'><i class='fas fa-edit'></i> Записаться</button></p>";
                    }
                }
            }
        }

        echo "<div id='myModal$row[0]' class='modal fade'>
                                <div class='modal-dialog modal-md'>
                                    <div class='modal-content'>
                                        <div class='modal-body'>
                                            <p class='text-center'><img class='img-rounded' src='https://www.medudp.ru/admin/gallery/$row[11]' width=100%></p>
                                            <h3>$row[5] $row[4] $row[6]</h3>
                                            <p>$row[2]</p>";
        if (!empty($row[7])) {
            echo "<p><b><span style='color: darkred'> График приема:</span></b> $row[7]</p>";
        }
        echo nl2br($row[8]);
        if (!empty($row[9]) && !empty($row[10])) {
            $convertEndSert = convertDate($row[10]);
            echo "
            <br>
            <br>
            <p><b>Сведения о сертификате:</b> $row[9]</p>
            <p><b>Дата окончания сертификата:</b> $convertEndSert</p>

            ";
        }
        if (!empty($row[12]) && !empty($row[13])) {
            $convertEndSert2 = convertDate($row[13]);
            echo "
            <br>
            <p><b>Сведения о сертификате:</b> $row[12]</p>
            <p><b>Дата окончания сертификата:</b> $convertEndSert2</p>

            ";
        }
        echo "
                            </div>
                                        <div class='modal-footer'>
                                            <button class='btn btn-default' type='button' data-dismiss='modal'>Закрыть</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <div class='clearfix'></div>";
        $recordName = $row[5] . ' ' . $row[4] . ' ' . $row[6];
        getRecordForm($row[0], $recordName);
    }
    echo "</div>";
}

//Проверка входящих данных
function nullControl($link, $a)
{
    $a = strip_tags($a);
    $a = htmlspecialchars($a);
    $a = mysqli_real_escape_string($link, $a);
    return $a;
}

//Форма записи к специалисту
function getRecordForm($id, $recordName)
{
    $b = $_SERVER['REQUEST_URI'];
    // $b = substr($b,-5);
    echo "
    <form method='post' role='form' action='$b' id='doctor_record_form'>
        <div id='ModalRecord$id' class='modal fade'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      
      <div class='modal-header'>
        <h3 class='modal-title'>$recordName</h3>
        <p>Запись на прием</p>
      </div>
      
      <div class='modal-body'>
        <div class='row'>
        <div class='col-xs-4 form-group'>
            <label for='cardNumber'>Номер карты \ Номер пропуска</label>
            <input type='text' id='cardNumber' class='form-control' name='ib' maxlength='10' placeholder='Например: 32129'>
            <p class='text-justify smallText'>*Если у вас нет пропуска, или вы обращаетесь к нам в первый раз - оставьте поле незаполненным</p>
        </div>
        <div class='col-xs-4 form-group'>
            <label for='phone'>Ваш контактный номер телефона</label>
            <input type='text' id='phone'  class='form-control' name='recordPhone' maxlength='15' placeholder='Например: +79192345678'>
            <p class='text-right contNumber'><span id='contInputPhone'>0</span>/15</p>
        </div>
        
        <div class='clearfix'></div>
        
        <div class='col-xs-4 form-group'>
            <label for='fam'>Фамилия</label>
            <input type='text' id='fam'  class='form-control'  name='recordLastName' maxlength='30' placeholder='Иванов'>
            <p class='text-right contNumber'><span id='contInputFam'>0</span>/30</p>
        </div>
        
        <div class='col-xs-4 form-group'>
            <label for='im'>Имя</label>
            <input type='text' id='im'  class='form-control' name='recordFirstName' maxlength='30' placeholder='Иван'>
            <p class='text-right contNumber'><span id='contInputIm'>0</span>/30</p>
        </div>
        
        <div class='col-xs-4 form-group'>
            <label for='ot'>Отчество</label>
            <input type='text' id='ot'  class='form-control' name='recordMiddleName' maxlength='30' placeholder='Иванович'>
            <p class='text-right contNumber'><span id='contInputOt'>0</span>/30</p>
        </div>
        
         <div class='col-xs-12 form-group'>
            <label for='time'>Желаемое время приема</label>
            <textarea type='text' id='time'  class='form-control' name='likeRecordTime' maxlength='200' placeholder='Например: Вторник, 22.04.2018, 11.00 - 12.00'></textarea>
            <p class='text-right contNumber'><span id='contInputTime'>0</span>/200</p>
        </div>
        
            <input type='text' id='docid' class='form-control hidden' name='docid' value='$id'>
            <input type='text' id='rum' class='form-control hidden' name='docFlag'>
        <div class='checkbox col-xs-12 form-group '>
             <label>
                <input type='checkbox' value='Согласен' name='access'>Я даю своё согласие ФГБУ 'Поликлиника №4' на обработку моих персональных данных, в соответствии с 
                Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на условиях и для целей, определенных в
                <a href='/content/agreementPD/index.php'>политике конфиденциальности</a>.
             </label>
             <p></p>
             <p><i class='fas fa-info-circle'></i> Рассмотрение заявок  производится в соответствии с <a href='documents/doc/reglament raboty otvetstvennyh lic medregistratury za rassmotreniem postupayushchih zayavok pacientov na zapis k vracham cherez sajt polikliniki.pdf' target='_blank'>регламентом работы ответственных лиц медрегистратуры за рассмотрением поступающих заявок пациентов на запись к врачам через сайт поликлиники</a></p>
             
         </div>
         <div class='col-xs-12 ModalRecordButtons'>
         <button type='submit' class='btn btn-primary'>Отправить</button>
      <button type='button' class='btn btn-danger' data-dismiss='modal'>Закрыть</button>
        
        <div class='clearfix'></div>
</div>
      </div>  
</div>
      
      </div>
      </div>
</div>
</form>
    ";
}

//Форма записи на диагностку
function getRecordFormDiag($id, $recordName)
{
    $b = $_SERVER['REQUEST_URI'];
    echo "
    <form class='recordForm' method='post' role='form' action='$b'>
        <div id='ModalRecord$id' class='modal fade'>
  <div class='modal-dialog modal-lg'>
    <div class='modal-content'>
      
      <div class='modal-header'>
        <h3 class='modal-title'>$recordName</h3>
        <p>Запись на прием</p>
      </div>
      
      <div class='modal-body'>
        <div class='row'>
        <div class='col-xs-4 form-group'>
            <label for='cardNumber'>Номер карты \ Номер пропуска</label>
            <input type='text' id='cardNumber' class='form-control' name='ib' maxlength='10' placeholder='Например: 32129'>
            <p class='text-justify smallText'>*Если у вас нет пропуска, или вы обращаетесь к нам в первый раз - оставьте поле незаполненным</p>
        </div>
        <div class='col-xs-4 form-group'>
            <label for='phone'>Ваш контактный номер телефона</label>
            <input type='text' id='phone'  class='form-control' name='recordPhone' maxlength='15' placeholder='Например: +79192345678'>
            <p class='text-right contNumber'><span id='contInputPhone'>0</span>/15</p>
        </div>
        
        <div class='clearfix'></div>
        
        <div class='col-xs-4 form-group'>
            <label for='fam'>Фамилия</label>
            <input type='text' id='fam'  class='form-control'  name='recordLastName' maxlength='30' placeholder='Иванов'>
            <p class='text-right contNumber'><span id='contInputFam'>0</span>/30</p>
        </div>
        
        <div class='col-xs-4 form-group'>
            <label for='im'>Имя</label>
            <input type='text' id='im'  class='form-control' name='recordFirstName' maxlength='30' placeholder='Иван'>
            <p class='text-right contNumber'><span id='contInputIm'>0</span>/30</p>
        </div>
        
        <div class='col-xs-4 form-group'>
            <label for='ot'>Отчество</label>
            <input type='text' id='ot'  class='form-control' name='recordMiddleName' maxlength='30' placeholder='Иванович'>
            <p class='text-right contNumber'><span id='contInputOt'>0</span>/30</p>
        </div>
        
         <div class='col-xs-12 form-group'>
            <label for='time'>Желаемое время приема</label>
            <textarea type='text' id='time'  class='form-control' name='likeRecordTime' maxlength='200' placeholder='Например: Вторник, 22.04.2018, 11.00 - 12.00'></textarea>
            <p class='text-right contNumber'><span id='contInputTime'>0</span>/200</p>
        </div>
            <input type='text' id='rum' class='form-control hidden' name='diagName' value='$recordName'>
            <input type='text' id='rum' class='form-control hidden' name='diagFlag'>
        <div class='checkbox col-xs-12 form-group '>
             <label>
                <input type='checkbox' value='Согласен' name='access'>Я даю своё согласие ФГБУ 'Поликлиника №4' на обработку моих персональных данных, в соответствии с 
                Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на условиях и для целей, 
                определенных в <a href='/content/agreementPD/index.php'>политике конфиденциальности</a>..
             </label>
             <p></p>
             <p><i class='fas fa-info-circle'></i> Рассмотрение заявок  производится в соответствии с <a href='documents/Reglament raboty otvetstvennyh lic medregistratury za rassmotreniem postupayushchih zayavok pacientov na zapis k vracham cherez sajt polikliniki.pdf' target='_blank'>регламентом работы ответственных лиц медрегистратуры за рассмотрением поступающих заявок пациентов на запись к врачам через сайт поликлиники</a></p>
             
         </div>
         
         <div class='col-xs-12 ModalRecordButtons'>
         <button type='submit' class='btn btn-primary'>Отправить</button>
         <button type='button' class='btn btn-danger' data-dismiss='modal'>Закрыть</button>
        
        <div class='clearfix'></div>
</div>
      </div>  
</div>
      
      </div>
      </div>
</div>
</form>
    ";
}

function getFormQuestionCovid()
{
    echo "
        <form method='post' enctype='multipart/form-data' class='formQuestionCovid' >
            <h3 class='questionTitleName'>Задайте Ваш вопрос по коронавирусу</h3>
            <div class='form-group col-xs-12'>
                <div class='row'>
                    <label for='questionCovid'>Ваш вопрос:*</label><br>
                    <textarea class='form-control' rows='5' name='questionCovid' id='questionCovid' maxlength='500'></textarea>
                </div>
            </div>
            <div class='form-group col-xs-12'>
                <div class='row'>
                    <label for='nameCovid'>Ваше имя:</label><br>
                    <input class='form-control' name='nameCovid' id='nameCovid' maxlength='100'>
                </div>
            </div>
            <div class='form-group col-xs-12'>
                <div class='row'>
                    <label for='emailCovid'>Ваш email :</label><br>
                    <input type='email' class='form-control' name='emailCovid' id='emailCovid' maxlength='100'>
                </div>
            </div>
                            Я даю своё согласие ФГБУ \"Поликлиника №4\" на обработку моих
                            персональных данных, в соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О
                            персональных данных», на условиях и для целей, определенных в <a href='/content/agreementPD/index.php'>политике конфиденциальности</a>.
        </form>
        
        <button class=\"btn btn-prepare\" id='submitCovid'>Отправить</button>
    ";
}
