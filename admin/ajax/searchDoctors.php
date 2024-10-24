<?php

require_once "../../../porter.php";

$search = '%' . $_POST['search'] . '%';
$indexb = 0;

$searchDoctors = mysqli_query($link, "SELECT * FROM doctors WHERE (last_name LIKE '$search' OR first_name LIKE '$search' OR middle_name LIKE '$search' OR appointment LIKE '$search') AND department != 'Архив'");
if ($searchDoctors->num_rows) {
	echo "<h2 class='doctorsCategory'>Действующие сотрудники</h2>";
	while ($row = mysqli_fetch_assoc($searchDoctors)) {
		echo "
				<div class='doctorsListChild'>
					<a href='/admin/index.php?options=doctorPage&profile=$row[id]&search={$_POST['search']}' id='doctorListLink" . $indexb . "'> 
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
		$indexb++;
	}
}

$indexb = 3000;

$searchArchiveDoctors = mysqli_query($link, "SELECT * FROM doctors WHERE (last_name LIKE '$search' OR first_name LIKE '$search' OR middle_name LIKE '$search' OR appointment LIKE '$search') AND department = 'Архив'");
if ($searchArchiveDoctors->num_rows) {
	echo "<h2 class='doctorsCategory'>Сотрудники в архиве</h2>";
	while ($row = mysqli_fetch_assoc($searchArchiveDoctors)) {
		echo "
			<div class='doctorsListChild'>
				<a href='/admin/index.php?options=doctorPage&profile=$row[id]&search={$_POST['search']}' id='doctorListLink" . $indexb . "'> 
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
		$indexb++;
	}
}

mysqli_close($link);
