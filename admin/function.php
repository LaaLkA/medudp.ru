<?php

//Получение списка отделений из базы данных
function giveDepartmentList($link, $depName)
{

    $result = mysqli_query($link, "SELECT * FROM departments;");
    while ($row = mysqli_fetch_row($result)) {
        echo "<option ";
        if ($depName!=null) {
            if ($depName == $row[1]) echo"selected";
        }
        echo">{$row[1]}</option>";
    }
}
//Получение списка формальных должностей из базы данных
function giveAppointmentList($link, $appName)
{

    $result = mysqli_query($link, "SELECT * FROM formAppointment;");
    while ($row = mysqli_fetch_row($result)) {
        echo "<option ";
        if ($appName!=null) {
            if ($appName == $row[0]) echo"selected";
        }
        echo" value='$row[0]'>{$row[1]}</option>";
    }
}

//Получение состояния маркера записи в отделение
function giveRecordMarker($link, $idDep)
{
    $result = mysqli_query($link, "SELECT * FROM departments WHERE id='$idDep'");
    while ($row = mysqli_fetch_row($result)) {
        echo "<option ";
        if ($row[4] == 0) {
            echo "<option value='1'>Да</option>
                  <option selected value='$row[4]'>Нет</option>";
        } else {
            echo "<option selected value='$row[4]'>Да</option>
                  <option value='0'>Нет</option>";
        }
    }
}

//Функция вывода формы для изменения информации о сотруднике
function updateDoctor($docID,$depName,$docApp,$lastname,$firstname,$middlename,$jobtime,$appName,$inf,$speciality1,$endsert1,$speciality2,$endsert2,$image_name,$link)
{
    echo "
<div class=\"modal fade bs-example-modal-lg newDoctor$docID\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myLargeModalLabel\">
    <div class=\"modal-dialog modal-lg\" role=\"document\">
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <h3 class=\"modal-title\">Редактировать сотрудника</h3>
                <form method=\"post\" action=\"?options=doctors\" enctype=\"multipart/form-data\">
                    <div class=\"row\">
                        <p></p>
                        <div class=\"form-group col-md-6\">
                            <label for=\"exampleInputDepartment1\">Отделение*</label>
                            <select name=\"department\" id=\"exampleInputDepartment1\" class=\"form-control\">";
                                    giveDepartmentList($link,$depName);
   echo"                    </select>
                        </div>
                        <div class=\"form-group col-md-6\">
                            <label for=\"exampleInputappointment1\">Должность*</label>
                            <input type=\"text\" class=\"form-control\" id=\"exampleInputappointment1\" name=\"appointmentUpdate\"
                                   value=\"$docApp\">
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"form-group col-md-4\">
                            <label for=\"nameDoctor2\">Фамилия*</label>
                            <input type=\"text\" class=\"form-control\" id=\"nameDoctor2\" name=\"lastname1\"
                                   value=\"$lastname\">
                        </div>
                        <div class=\"form-group col-md-4\">
                            <label for=\"nameDoctor1\">Имя*</label>
                            <input type=\"text\" class=\"form-control\" id=\"nameDoctor1\" name=\"firstname1\"
                                   value='$firstname'>
                        </div>
                        <div class=\"form-group col-md-4\">
                            <label for=\"nameDoctor3\">Отчество*</label>
                            <input type=\"text\" class=\"form-control\" id=\"nameDoctor3\" name=\"middlename1\"
                                   value='$middlename'>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"form-group col-sm-6 col-md-6\">
                            <label for=\"jobTime1\">График работы сотрудника</label>
                            <input type=\"text\" class=\"form-control\" id=\"jobTime1\" name=\"jobtime1\"
                                   value='$jobtime'>
                        </div>

                        <div class=\"form-group col-sm-6 col-md-6\">
                            <label for=\"exampleInputDepartment2\">Формальная должность*</label>
                            <select name=\"form_appointment1\" id=\"exampleInputDepartment2\" class=\"form-control\">";
                                giveAppointmentList($link,$appName);
                     echo"       </select>
                        </div>
                    </div>
                    <div class=\"form-group\">
                        <label for=\"history1\">Краткая биография</label>
                        <textarea class=\"form-control\" rows=\"10\" name=\"history1\">$inf</textarea>
                    </div>
                    <div class=\"row\">
                        <div class=\"form-group col-md-6\">
                            <label for=\"speciality1\">Специальность по сертификату*</label>
                            <input type=\"text\" class=\"form-control\" id=\"speciality1\" name=\"speciality1\"
                                   value='$speciality1'>
                        </div>
                        <div class=\"form-group col-md-6\">
                            <label for=\"endsert1\">Дата окончания сертификата*</label>
                            <input type=\"text\" class=\"form-control\" id=\"endsert1\" name=\"endsert1\"
                                   value='$endsert1'>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"form-group col-md-6\">
                            <label for=\"speciality2\">Специальность по дополнительному сертификату</label>
                            <input type=\"text\" class=\"form-control\" id=\"speciality2\" name=\"speciality2\"
                                   value='$speciality2'>
                        </div>
                        <div class=\"form-group col-md-6\">
                            <label for=\"endsert2\">Дата окончания дополнительного сертификата</label>
                            <input type=\"text\" class=\"form-control\" id=\"endsert2\" name=\"endsert2\"
                                   value='$endsert2'>
                        </div>
                    </div>
                    <div class=\"form-group\">
                    <img src='gallery/" . $image_name . "' class='img-rounded' height='75px'>
                        <label>
                            <span>Загрузить изображение</span>
                            <input type=\"file\" name=\"user_photoUpdate\"/>
                        </label>
                    </div>
                    <input type=\"text\" class=\"form-control hidden\" id=\"update\" name=\"update\" value='$docID'>
                    <button type=\"submit\" class=\"btn btn-default\">Изменить</button>
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Отмена</button>
                    <a href=\"?options=doctors&delete=$row[id]\" class=\"btn btn-danger doc_delete_bottom\"><i class=\"far fa-trash-alt\"></i></a>
                </form>
            </div>
        </div>
    </div>
</div>";
}



//Транслит
function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}
function str2url($str) {
    // переводим в транслит
    $str = rus2translit($str);
    // в нижний регистр
    $str = strtolower($str);
    // заменям все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
    // удаляем начальные и конечные '-'
    $str = trim($str, "-");
    return $str;
}
//Перевод размера файлов
function formatSize($bytes) {

    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' Гб';
    }

    elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' Мб';
    }

    elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' Кб';
    }

    elseif ($bytes > 1) {
        $bytes = $bytes . ' байты';
    }

    elseif ($bytes == 1) {
        $bytes = $bytes . ' байт';
    }

    else {
        $bytes = '0 байтов';
    }

    return $bytes;
}

?>