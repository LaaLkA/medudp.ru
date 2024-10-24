<div class="col-xs-12">
    <a name="exp1"></a>
    <div class="row">
        <h3 class="era"><span class="glyphicon glyphicon-send"></span> <Strong>Руководство</Strong></h3>
    </div>
</div>




<div class="col-xs-12 admine">
    <div class="row">
    <?php
    $nameDep="'Администрация'";
    $doc_see=mysqli_query($link, "SELECT * FROM doctors WHERE department=$nameDep ORDER BY form_appointment, last_name ASC");
    while ($row = mysqli_fetch_row($doc_see)) {
        echo "
            <a href=\"#myModal$row[0]\" data-toggle=\"modal\">
                <div class=\"col-xs-3\">
                    <div class='row'>
                        <img src='https://www.medudp.ru/admin/gallery/".$row[11]."' alt='".$row[5]." ".$row[4].' '.$row[6]."' class='imgAdministration'>
                        <div class=\"adminInfo\">
                            <h3>$row[5] $row[4] $row[6]</h3>
                            <p class='text-left'>$row[2]</p>
                        </div>
                    </div>
                </div>
            </a>
        ";
        echo"
             <div id=\"myModal$row[0]\" class=\"modal fade\">
                <div class=\"modal-dialog modal-md\">
                    <div class=\"modal-content\">
                        <div class=\"modal-body\">
                            <p class=\"text-center\"><img class=\"img-rounded\" src=\"https://www.medudp.ru/admin/gallery/$row[11]\" width='100%'></p>
                            <h3>$row[5] $row[4] $row[6]</h3>
                            <p>$row[2]</p>";
        if(!empty($row[7])) {
            echo "<p><b><span style='color: darkred'> График приема:</span></b> $row[7]</p>";
        }
        echo nl2br($row[8]);
        if(!empty($row[9]) && !empty($row[10])) {
            $convertEndSert = convertDate ($row[10]);
            echo "<br>
                <br>
                <p><b>Специальность:</b> $row[9]</p>
                <p><b>Дата окончания сертификата:</b> $convertEndSert</p>";
        }
        if(!empty($row[12]) && !empty($row[13])) {
            $convertEndSert2 = convertDate ($row[13]);
            echo "<br>
                <p><b>Специальность:</b> $row[12]</p>
                <p><b>Дата окончания сертификата:</b> $convertEndSert2</p>";
        }

        echo"            </div>
                            <div class=\"modal-footer\">
                                <button class=\"btn btn-default\" type=\"button\" data-dismiss=\"modal\">Закрыть</button>
                            </div>
                    </div>
                </div>
            </div>
        ";
    }
    ?>
    </div>
</div>