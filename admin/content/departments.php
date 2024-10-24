<?php
//Добавление нового отделения
if (isset($_POST['dep_name'])) {
    if (!empty($_POST['dep_name'])) {
        $dep_name = strip_tags($_POST['dep_name']);
        $dep_name = htmlspecialchars($dep_name);
        $dep_name = mysqli_real_escape_string($link, $dep_name);
        $query = mysqli_query($link, "INSERT INTO departments (dpname) VALUES ('$dep_name')");
        if ($query) {
            infMessage("Поздравляем!", "Новое отделение успешно добавлено!");
        } else {
            die('Error : (' . $mysqli->errno . ') ' . $mysqli->error);
        }
    } else {
        infMessage("Ошибка!", "Название отделения не может быть пустым :(");
    }
}

//Удаление отделения
if (isset($_GET['delete_dep'])) {
    if (!empty($_GET['delete_dep'])) {
        $deleteId = strip_tags($_GET['delete_dep']);
        $deleteId = htmlspecialchars($deleteId);
        $deleteId = mysqli_real_escape_string($link, $deleteId);
        //Получаем имя подразделения
        $nameDeleteDepartments = mysqli_query($link, "SELECT * FROM departments WHERE id='$deleteId'");
        while ($rob = mysqli_fetch_row($nameDeleteDepartments)) {
            //Перевести сотрудников удаляемого отделения в "Архив"
            $transferDeleteDepartmentsDoctors = mysqli_query($link, "UPDATE doctors SET department='Архив' WHERE department='$rob[1]'");
        }
        $deleteDepartments = mysqli_query($link, "DELETE FROM departments WHERE id='$deleteId'");
        if ($deleteDepartments) {
            infMessage("Поздравляем!", "Отделение успешно удалено! Сотрудники отделения были переведены в Архив");
        } else {
            die('Error : (' . $mysqli->errno . ') ' . $mysqli->error);
        }
    }
}

//Обновление отделения
if (isset($_POST['id_dep_name']) & isset($_POST['update_dep_name']) & isset($_POST['update_dep_description']) & isset($_POST['dep_form_name']) & isset($_POST['depRecordMarker'])) {
    if (!empty($_POST['update_dep_name'])) {
        $updateID = nullControl($link, $_POST['id_dep_name']);
        $updateName = nullControl($link, $_POST['update_dep_name']);
        $dep_form_name = nullControl($link, $_POST['dep_form_name']);
        $update_dep_description = nullControl($link, $_POST['update_dep_description']);
        $depRecordMarker = nullControl($link, $_POST['depRecordMarker']);
        $nameUpdateDepartments = $link->query("SELECT * FROM departments WHERE id='$updateID'");
        while ($updateRow = mysqli_fetch_row($nameUpdateDepartments)) {
            $transferUpdateDepartmentsDoctors = mysqli_query($link, "UPDATE doctors SET department='$updateName' WHERE department='$updateRow[1]'");
        }
        $updateDepartments = mysqli_query($link, "UPDATE departments SET dpname ='$updateName', form_name ='$dep_form_name', descript ='$update_dep_description', recordMarker ='$depRecordMarker' WHERE id='$updateID'");
        if ($updateDepartments) {
            infMessage("Поздравляем!", "Отделение успешно обновлено!");
        } else {
            die('Error : (' . $mysqli->errno . ') ' . $mysqli->error);
        }
    }
}


?>
<div class="col-xs-12 department_page">
    <?php
    //Список отделений
    if (!isset($_GET['dep'])) {
    ?>

        <p class="col-xs-6 pageNameLabel">Управление отделениями</p>
        <p class="col-xs-6 text-right gordon">
            <button data-fancybox data-src="#newDepartment" data-modal="true" href="javascript:;" class="btn btn-primary"><i class="fas fa-plus"></i></button>
        </p>
        <div style="display: none;max-width:1000px;" id="newDepartment">
            <form method="post" action="?options=departments">
                <h3 class="modal-title">Добавление нового отделения</h3>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="exampleInputappointment2">Название подразделения</label>
                        <input type="text" class="form-control" id="exampleInputappointment2" name="dep_name" placeholder="Введите название подразделения">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Добавить</button>
                <button data-fancybox-close class="btn btn-danger">Отмена</button>
            </form>
        </div>



    <?php
        echo "
            <div class='col-xs-12 departmentList'>
        ";
        $result = $link->query("SELECT * FROM departments ORDER BY dpname");
        $result_counter = 0;

        while ($row = mysqli_fetch_row($result)) {
            $user_count = $link->query("SELECT * FROM doctors WHERE department='$row[1]' AND form_appointment IN (1,2)");
            $doc_count = 0;
            while ($user_count1 = mysqli_fetch_row($user_count)) {
                $doc_count++;
            }
            $user_count = $link->query("SELECT * FROM doctors WHERE department='$row[1]' AND form_appointment IN (3,4)");
            $pers_count = 0;
            while ($user_count1 = mysqli_fetch_row($user_count)) {
                $pers_count++;
            }

            $result_counter++; //Подсчет количества отделений
            echo "  <a href='/admin/index.php?options=departments&dep=$row[0]'>
                        <div class='col-xs-12 departmentStroke'>
                            <div class='departmentNameStroke'>
                                $row[1] 
                                <div>
                                    <div class='appointment_35'>$row[2]</div>
                                    <div class='departmentDocCount'>Врачей: $doc_count</div>
                                    <div class='departmentPersCount'>Мед. персонал: $pers_count</div>
                                </div>
                            </div>
                        </div>
                    </a>";
        }
        echo "
                    <div class=\"col-xs-12 lastDepartmentStroke\">
                        <div class=\"row\">
                            <div class=\"col-xs-1 text-center\"><div class=\"row\"><p></p></div></div>
                            <div class=\"col-xs-9\"><div class=\"row\"><p>Всего отделений: $result_counter</p></div></div>
                            <div class=\"col-xs-1\"><div class=\"row\"><p></p></div></div>
                            <div class=\"col-xs-1\"><div class=\"row\"><p></p></div></div>
                        </div>
                    </div>";
        echo "
        </div>
        ";
    } else {
        //Страница конкретного отделения
        if (!empty($_GET['dep'])) {
            $idDep = strip_tags($_GET['dep']);
            $idDep = htmlspecialchars($idDep);
            $idDep = mysqli_real_escape_string($link, $idDep);
            $depInformation2 = $link->query("SELECT * FROM departments WHERE id='$idDep'");
            while ($rowDepInformation2 = mysqli_fetch_row($depInformation2)) {
                echo "
                    
                    <form class='updateDepartmentInformation' method=\"post\" action=\"?options=departments\">
                        <div class=\"form-group col-md-12\">
                            <p class='pageNameLabel2'>$rowDepInformation2[1]</p>
                            <input type=\"text\" class=\"form-control hidden\" name=\"id_dep_name\" value='$rowDepInformation2[0]'>
                            <label for=\"updateInputDepName\">Название подразделения:</label>
                            <input type=\"text\" class=\"form-control\" id=\"updateInputDepName\" name=\"update_dep_name\" maxlength='255' value='$rowDepInformation2[1]'>
                            <p class=\"text-right\"><span id=\"contDepName\">0</span>/255</p>
                            <label for=\"updateDescriptionInputDepName\">Описание подразделения:</label>
                            <textarea type=\"textarea\" class=\"form-control\" id=\"updateDescriptionInputDepName\" name=\"update_dep_description\" maxlength='500' rows='5'>$rowDepInformation2[3]</textarea>
                            <p class=\"text-right\"><span id=\"contDepDescription\">0</span>/500</p>
                            <label for=''>Сотрудники подразделения:</label>
                            <div class='col-xs-12 doctorsList'>
                            ";

                $result = mysqli_query($link, "SELECT * FROM doctors WHERE department='$rowDepInformation2[1]' ORDER BY form_appointment,last_name desc ");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                        <div class='doctorsListChild'>
                            <a href='/admin/index.php?options=doctorPage&profile=$row[id]' id='doctorListLink" . $row[id] . "'> 
                                <div class='doctorInformation'>
                                    <div class='doctorImg'><img src='gallery/" . $row[image_name] . "' class='img-rounded' width='75px'></div>
                                    <div class='doctorName' id='doctorName'>
                                    $row[last_name] $row[first_name] $row[middle_name]
                                    <span class='appointment_34'>$row[appointment]</span></div>
                                </div>
                                <div class='departmentMarker'>$row[department]</div>
                            </a>
                        </div>
                        ";
                }
                echo "              </div>          
                        </div>
                        <div class='form-group col-xs-6'>
                            <label for=\"depForm_name\">Идентификатор:</label>
                            <input type=\"text\" class=\"form-control\" id=\"depForm_name\" name=\"dep_form_name\" maxlength='50' value='$rowDepInformation2[2]'>
                            <p class=\"text-right\"><span id=\"contDepFormName\">0</span>/50</p>
                        </div>
                        <div class='form-group col-xs-6'>
                            <label for='depRecordMarker'>Запись на приём в отделение:</label>
                            <select class='form-control' name='depRecordMarker' id='depRecordMarker'>";
                giveRecordMarker($link, $idDep);
                echo " 
                            </select>
                        </div>
                        <div class='clearfix'></div>
                        <div class='form-group text-left col-xs-6'>
                            <button type=\"submit\" class=\"btn btn-default\">Изменить</button>
                            <a data-fancybox data-src=\"#confirm-deletion\" data-modal=\"true\" href=\"javascript:;\" class=\"btn btn-default\">Удалить</a>
                            <a href=\"content/paid.php?dep='$rowDepInformation2[1]'\" class=\"btn btn-default\">Печать сотрудников</a>
                            <div style=\"display: none;\" id=\"confirm-deletion\">
                                <h2>Подтвердите удаление!</h2>
                                <p>Вы точно хотите удалить отделение <b>$rowDepInformation2[1]</b>?</p>
                                
                                <div class='col-xs-6 text-right'>
                                    <button data-fancybox-close class=\"btn btn-danger\">Нет</button>
                                </div>
                                <div class='col-xs-6 text-left'>
                                    <a href=\"?options=departments&delete_dep=$idDep\" class=\"btn btn-success\">Да</a>
                                </div>
                            </div>
                        </div>
                        <div class='form-group text-right col-xs-6'>
                            <a href=\"/admin/index.php?options=departments\" class=\"btn btn-success\">Отмена</a>
                        </div>
                    </form>
                    <div class=\"clearfix\"></div>
                    
                    ";
            }
        }
    }
    ?>

</div>