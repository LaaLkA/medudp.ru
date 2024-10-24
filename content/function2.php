<?php


echo "<div class=\"row\">";
$doc_see = mysqli_query($link, "SELECT * FROM doctors WHERE department=$nameDep and appointment LIKE $appointmentName ORDER BY form_appointment, last_name ASC");
while ($row = mysqli_fetch_row($doc_see)) {

    echo "
            <div class='row doctorMainCard'>
                <div class=\"col-md-2 col-sm-2\">
                    <img src='https://www.medudp.ru/admin/gallery/" . $row[11] . "' class='img-rounded'>
                </div>
                <div class=\"col-md-8 col-sm-8 doctor_card\">
                    <h3>$row[5] $row[4] $row[6]</h3>
                    <p>$row[2]</p>";
    if (!empty($row[7])) {
        echo "<p><b><span style='color: darkred'>График приема:</span> </b> $row[7]</p>";
    }
    echo "              </div>
                <div class=\"col-sm-2 col-md-2 button_panel\">
                            <p class=\"text-center\"><button class=\"btn btn-info btn-sm bt_q\" type=\"button\" data-toggle=\"modal\" data-target=\"#myModal$row[0]\">Подробнее</button></p>";

    $checkRecordDep = mysqli_query($link, "SELECT * FROM departments WHERE dpname=$nameDep");
    while ($run = mysqli_fetch_row($checkRecordDep)) {
        if ($run[4] == 1) {
            if ($row[3] == 1 || $row[3] == 2) {
                if ($row[14] != 1) {
                    echo "<p class=\"text-center\"><button class=\"btn btn-primary btn-sm bt_m\" type=\"button\" data-toggle=\"modal\" data-target=\"#ModalRecord$row[0]\"><i class=\"fas fa-edit\"></i> Записаться</button></p>";
                }
            }
        }
    }

    echo "<div id=\"myModal$row[0]\" class=\"modal fade\">
                                <div class=\"modal-dialog modal-md\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-body\">
                                            <p class=\"text-center\">
                                            <img class=\"img-rounded\" src=\"https://www.medudp.ru/admin/gallery/$row[11]\" width='100%'>
                                            </p>
                                            <h3>$row[5] $row[4] $row[6]</h3>
                                            <p>$row[2]</p>";
    if (!empty($row[7])) {
        echo "<p><b><span style='color: darkred'> График приема:</span></b> $row[7]</p>";
    }
    echo nl2br($row[8]);
    if (!empty($row[9]) && !empty($row[10])) {
        echo "
            <br>
            <br>
            <p><b>Сведения о сертификате:</b> $row[9]</p>
            <p><b>Дата окончания сертификата:</b> $row[10]</p>

            ";
    }
    if (!empty($row[12]) && !empty($row[13])) {
        echo "
            <br>
            <p><b>Сведения о сертификате:</b> $row[12]</p>
            <p><b>Дата окончания сертификата:</b> $row[13]</p>

            ";
    }
    echo "
                           </div>
                                        <div class=\"modal-footer\">
                                            <button class=\"btn btn-default\" type=\"button\" data-dismiss=\"modal\">Закрыть</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <div class=\"clearfix\"></div>
            <div class=\"clearfix\"></div>";
    $recordName = $row[5].' '. $row[4].' '. $row[6];
    getRecordForm ($row[0],$recordName);
}

echo "</div>";
?>

