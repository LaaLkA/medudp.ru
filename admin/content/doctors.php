<?php

//Удаление записи сотрудника
if (isset($_GET['delete'])) {
    if (!empty($_GET['delete'])) {
        $deleteId = nullControl($link, $_GET['delete']);

        //Удаление записи в базе данных
        $deleteDoctors = mysqli_query($link, "DELETE FROM doctors WHERE id='$deleteId'");
        // infMessage('Поздравляем!', '<p class="alert alert-success">Запись сотрудника успешно удалена</p>');
        echo"
        <script>
            window.location.replace('?options=doctors&search={$_GET['search']}')
        </script>
        ";
    } else {
        echo "<p class=\"alert alert-warning\" role=\"alert\"><b>Внимание!</b> При удалении сотрудника произошла непредвиденная ошибка</p>";
    }
}

//Изменение информации о сотруднике
if (isset($_POST['update'])) {
    $docID = $_POST['update'];
    $user_information = array($_POST['department'], $_POST['appointmentUpdate'], $_POST['form_appointment1'], $_POST['firstname1'], $_POST['lastname1'], $_POST['middlename1'], $_POST['jobtime1'], $_POST['history1'], $_POST['speciality1'], $_POST['endsert1'], $_POST['speciality2'], $_POST['endsert2']);
    $errcount = 0;
    //Если сотрудник из отдела Администрация
    if ($user_information[0] == "Администрация") {
        //Не проверям поля на пустоту
        $errcount = 0;
        //Иначе проверяем
    } else {
        for ($i = 0; $i < count($user_information); $i++) {
            //Кроме 5,6,7,10,11
            if ($i == 5 || $i == 6 || $i == 7 || $i == 10 || $i == 11) {
                continue;
            }
            if (empty($user_information[$i])) {
                $errcount++;
            }
        }
    }


    if ($errcount == 0) {
        for ($i = 0; $i < count($user_information); $i++) {
            $user_information[$i] = nullControl($link, $user_information[$i]);
        }
        //Загрузка фото сотрудника
        if (is_uploaded_file($_FILES['user_photoUpdate']['tmp_name'])) {
            $uploaddir = 'gallery/';
            // это папка, в которую будет загружаться картинка
            $apend = date('YmdHis') . rand(100, 1000) . '.jpg';
            // это имя, которое будет присвоенно изображению
            $uploadfile = "$uploaddir$apend";
            //в переменную $uploadfile будет входить папка и имя изображения

            // В данной строке самое важное - проверяем загружается ли изображение (а может вредоносный код?)
            // И проходит ли изображение по весу.
            if (($_FILES['user_photoUpdate']['type'] == 'image/gif' || $_FILES['user_photoUpdate']['type'] == 'image/jpeg' || $_FILES['user_photoUpdate']['type'] == 'image/png') && ($_FILES['user_photoUpdate']['size'] != 0 and $_FILES['user_photoUpdate']['size'] <= 300000)) {
                // Указываем максимальный вес загружаемого файла.
                if (move_uploaded_file($_FILES['user_photoUpdate']['tmp_name'], $uploadfile)) {
                    //Здесь идет процесс загрузки изображения
                    $size = getimagesize($uploadfile);
                    // с помощью этой функции мы можем получить размер пикселей изображения
                    if ($size[0] < 1000 && $size[1] < 1000) {
                        $imgDwn = $link->query("UPDATE doctors SET image_name='$apend' WHERE id='$docID'");
                        // если размер изображения не более 1000 пикселей по ширине и не более 1000 по высоте
                    } else {
                        infMessage('Внимание!', '<p class="alert alert-danger" role="alert">Загружаемое изображение превышает допустимые нормы (ширина не более - 1000; высота не более 1000)</p>');
                        // удаление файла
                        unlink($uploadfile);
                    }
                } else {
                    infMessage('Внимание!', '<p class="alert alert-danger" role="alert">Произошла ошибка загрузки файла на сервер</p>');
                }
            } else {
                infMessage('Внимание!', '<p class="alert alert-warning" role="alert">Размер файла не должен превышать 300 Kб</p>');
            }
        }


        $base_dwn = mysqli_query($link, "UPDATE doctors SET department='$user_information[0]',appointment='$user_information[1]',form_appointment='$user_information[2]',first_name='$user_information[3]',last_name='$user_information[4]',middle_name='$user_information[5]',job_time='$user_information[6]',history='$user_information[7]',speciality='$user_information[8]',endsert='$user_information[9]',speciality2='$user_information[10]',endsert2='$user_information[11]' WHERE id='$docID'");
        if ($base_dwn) {
            infMessage('Поздравляем!', '<p class="alert alert-success">Информация о сотруднике успешно изменена</p>');
        } else {
            infMessage('Внимание!', '<p class="alert alert-warning" role="alert">Ошибка записи в базу данных</p>');
        }
    } else {
        infMessage('Внимание!', '<p class="alert alert-warning" role="alert">Вы забыли заполнить одно из обязательных полей </p>');
    }
}

//Копирование сотрудника в другое подразделение
if (isset($_POST['copy'])) {
    $copyDocID = nullControl($link, $_POST[copy]);
    $copyID = nullControl($link, $_POST[toDepartment]);
    //  Запись копии в базу данных
    $downloadPersonalInformation = $link->query("SELECT * FROM doctors WHERE id = '$copyDocID'");
    while ($row = mysqli_fetch_row($downloadPersonalInformation)) {
        $copyBaseDownload = $link->query("INSERT INTO doctors (department,appointment,form_appointment,first_name,last_name,middle_name,job_time,history,speciality,endsert,image_name,speciality2,endsert2,recordoff) VALUES ('$copyID','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]','$row[8]','$row[9]','$row[10]','$row[11]','$row[12]','$row[13]','$row[14]')");
        if ($copyBaseDownload) {
            echo"
                <script>
                    window.location.replace('?options=doctors&search={$_GET['search']}')
                </script>
            ";
        }
    }
}

//Добавление нового сотрудника
if (isset($_POST['appointment1'])) {

    $user_information = array($_POST['department'], $_POST['appointment1'], $_POST['form_appointment1'], $_POST['firstname1'], $_POST['lastname1'], $_POST['middlename1'], $_POST['jobtime1'], $_POST['history1'], $_POST['speciality1'], $_POST['endsert1'], $_POST['speciality2'], $_POST['endsert2']);
    for ($i = 0; $i < count($user_information); $i++) {
        if ($i == 5 || $i == 6 || $i == 7 || $i == 10 || $i == 11) {
            continue;
        }
        if (empty($user_information[$i])) {
            $errcount++;
        }
    }
    if ($errcount == 0) {
        for ($i = 0; $i < count($user_information); $i++) {
            $user_information[$i] = nullControl($link, $user_information[$i]);
        }
        //Загрузка фото сотрудника
        if (is_uploaded_file($_FILES['user_photo']['tmp_name'])) {
            $uploaddir = 'gallery/';
            // это папка, в которую будет загружаться картинка
            $apend = date('YmdHis') . rand(100, 1000) . '.jpg';
            // это имя, которое будет присвоенно изображению
            $uploadfile = "$uploaddir$apend";
            //в переменную $uploadfile будет входить папка и имя изображения

            // В данной строке самое важное - проверяем загружается ли изображение (а может вредоносный код?)
            // И проходит ли изображение по весу.
            if (($_FILES['user_photo']['type'] == 'image/gif' || $_FILES['user_photo']['type'] == 'image/jpeg' || $_FILES['user_photo']['type'] == 'image/png') && ($_FILES['user_photo']['size'] != 0 and $_FILES['user_photo']['size'] <= 300000)) {
                // Указываем максимальный вес загружаемого файла.
                if (move_uploaded_file($_FILES['user_photo']['tmp_name'], $uploadfile)) {
                    //Здесь идет процесс загрузки изображения
                    $size = getimagesize($uploadfile);
                    // с помощью этой функции мы можем получить размер пикселей изображения
                    if ($size[0] < 1000 && $size[1] < 1000) {
                        $user_information[12] = $apend;
                        // если размер изображения не более 1000 пикселей по ширине и не более 1000 по высоте
                    } else {
                        infMessage('Внимание!', '<p class="alert alert-danger" role="alert">Загружаемое изображение превышает допустимые нормы (ширина не более - 1000; высота не более 1000), установлена стандартная картинка</p>');
                        $user_information[12] = 'nofoto.jpg';
                        // удаление файла
                        unlink($uploadfile);
                    }
                } else {
                    infMessage('Внимание!', '<p class="alert alert-danger" role="alert">Произошла ошибка загрузки файла на сервер, установлена стандартная картинка</p>');
                    $user_information[12] = 'nofoto.jpg';
                }
            } else {
                infMessage('Внимание!', '<p class="alert alert-warning" role="alert">Размер файла не должен превышать 300 Kб</p>');
                $user_information[12] = 'nofoto.jpg';
            }
        } else {
            $user_information[12] = 'nofoto.jpg';
        }

        $base_dwn = mysqli_query($link, "INSERT INTO doctors (department,appointment,form_appointment,first_name,last_name,middle_name,job_time,history,speciality,endsert,image_name,speciality2,endsert2) VALUES ('$user_information[0]','$user_information[1]','$user_information[2]','$user_information[3]','$user_information[4]','$user_information[5]','$user_information[6]','$user_information[7]','$user_information[8]','$user_information[9]','$user_information[12]','$user_information[10]','$user_information[11]')");
        if ($base_dwn) {
            infMessage('Поздравляем!', '<p class="alert alert-success">Новый сотрудник <b>' . $user_information[4] . ' ' . $user_information[3] . ' ' . $user_information[5] . '</b> добавлен в отделение <b>' . $user_information[0] . '</b></p>');
        } else {
            infMessage('Внимание!', '<p class="alert alert-warning" role="alert">Ошибка записи в базу данных</p>');
        }
    } else {
        infMessage('Внимание!', '<p class="alert alert-warning" role="alert">Вы забыли заполнить одно из обязательных полей</p>');
    }
}

?>


<div class="col-xs-12 department_page">

    <div style="display: none; max-width:1000px;" id="newDoctor">
        <form method="post" action="?options=doctors" enctype="multipart/form-data">
            <h3 class="modal-title">Добавление нового сотрудника</h3>
            <div class="row">
                <p></p>
                <div class="form-group col-md-6">
                    <label for="exampleInputDepartment1">Отделение *</label>
                    <select name="department" id="exampleInputDepartment1" class="form-control">
                        <?php giveDepartmentList($link); ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputappointment1">Должность *</label>
                    <input type="text" class="form-control" id="exampleInputappointment1" name="appointment1" placeholder="Введите должность врача">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="nameDoctor2">Фамилия *</label>
                    <input type="text" class="form-control" id="nameDoctor2" name="lastname1" placeholder="Введите фамилию врача">
                </div>
                <div class="form-group col-md-4">
                    <label for="nameDoctor1">Имя *</label>
                    <input type="text" class="form-control" id="nameDoctor1" name="firstname1" placeholder="Введите имя врача">
                </div>
                <div class="form-group col-md-4">
                    <label for="nameDoctor3">Отчество</label>
                    <input type="text" class="form-control" id="nameDoctor3" name="middlename1" placeholder="Введите отчеcтво врача">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="jobTime1">График работы сотрудника</label>
                    <input type="text" class="form-control" id="jobTime1" name="jobtime1" placeholder="Введите график работы врача">
                </div>

                <div class="form-group col-sm-6 col-md-6">
                    <label for="exampleInputDepartment2">Формальная должность*</label>
                    <select name="form_appointment1" id="exampleInputDepartment2" class="form-control">
                        <?php giveAppointmentList($link); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="history1">Краткая биография</label>
                <textarea class="form-control" id='doctor_textarea' rows="3" name="history1" placeholder="Добавьте краткую биографию врача"></textarea>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="speciality1">Специальность по сертификату *</label>
                    <input type="text" class="form-control" id="speciality1" name="speciality1" placeholder="Введите специальность по сертификату">
                </div>
                <div class="form-group col-md-6">
                    <label for="endsert1">Дата окончания сертификата *</label>
                    <input type="date" class="form-control" id="endsert1" name="endsert1" placeholder="Введите дату окончания сертификата">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="speciality2">Специальность по дополнительному сертификату</label>
                    <input type="text" class="form-control" id="speciality2" name="speciality2" placeholder="Введите специальность по дополнительному сертификату">
                </div>
                <div class="form-group col-md-6">
                    <label for="endsert2">Дата окончания дополнительного сертификата</label>
                    <input type="date" class="form-control" id="endsert2" name="endsert2" placeholder="Введите дату окончания дополнительного сертификата">
                </div>
            </div>
            <div class="form-group">
                <label>
                    <span>Загрузить изображение</span>
                    <input type="file" name="user_photo" />
                </label>
            </div>
            <button type="submit" class="btn btn-success">Добавить</button>
            <button data-fancybox-close class="btn btn-danger">Отмена</button>
        </form>
    </div>

    <p class="col-xs-6 pageNameLabel">Управление сотрудниками</p>

    <div class="col-xs-6 gordon text-right">
        <button data-fancybox data-src="#newDoctor" data-modal="true" href="javascript:;" class="btn btn-primary">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    <div class="col-xs-12 doctorSearchBlock">
        <div class="row">
            <div class="col-xs-10">
                <div class="row">

                    <input type="text" class="form-control" id="doctorSearch" placeholder="Поиск" value="<?php print_r($_GET['search']) ?>">
                </div>
            </div>
            <div class="col-xs-2 text-right gordon2">
                <button class="btn btn-primary doctorSearchButton" id="doctorSearchButton">Найти</button>
            </div>
        </div>
    </div>

    <div class='col-xs-12 doctorsList'></div>

</div>