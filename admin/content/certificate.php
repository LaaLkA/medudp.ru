<div class="col-xs-12 department_page">
    <p class="col-xs-8 pageNameLabel">Сотрудники с просроченными сертификатами</p>
    <div class='col-xs-12 doctorsList'>
        <?php
$result = mysqli_query($link, "SELECT * FROM doctors WHERE endsert<now() ORDER BY last_name");
$num_result = mysqli_num_rows($result);

while ($row = mysqli_fetch_assoc($result)) {
    if ($row[department]!=='Архив') {
        if ($row[department]!=='Администрация') {
        $convertEndSert = convertDate($row[endsert]);
        echo "
            <div class='doctorsListChild'>
                    <a href='/admin/index.php?options=doctorPage&profile=$row[id]&search={$_POST['search']}' id='doctorListLink" . $indexb . "'> 
                        <div class='doctorInformation'>
                            <div class='doctorImg'><img src='gallery/" . $row[image_name] . "' class='img-rounded' width='75px'></div>
                            <div class='doctorName' id='doctorName'>
                            $row[last_name] $row[first_name] $row[middle_name]
                            <span class='appointment_34'>$row[appointment]</span>
                            <span class='alert-danger-date'>До $convertEndSert</span>
                            </div>
                            
                        </div>
                        <div class='departmentMarker'>$row[department]</div>
                    </a>
            </div>
        ";
        }
    }
}
?>
    </div>
</div>
