<div class="col-xs-12 department_page">

	<?php
	//Конкретный сотрудник
	if (!empty($_GET['profile'])) {
		$docID = nullControl($link, $_GET['profile']);
		$dwnProfile = $link->query("SELECT * FROM doctors WHERE id='$docID'");
		
		while ($row = mysqli_fetch_row($dwnProfile)) {
			echo "

	<p class='pageNameLabel2'>$row[5] $row[4] $row[6]</p>
   <form method='post' action='?options=doctors&search={$_GET['search']}' enctype='multipart/form-data'>

      <div class='row'>
            <p></p>
            <div class='form-group col-xs-6'>
               <input type='text' class='form-control hidden' id='update' name='update' value='$docID'>
               <img src='gallery/" . $row[11] . "' class='img-responsive'>
               <br>
               <label>
               	<span>Загрузить изображение</span>
                  <input type='file' name='user_photoUpdate'/>
               </label>
            </div>
            <div class='form-group col-xs-6'>
               <label for='exampleInputDepartment1'>Отделение*</label>
               <select name='department' id='exampleInputDepartment1' class='form-control'>";
			giveDepartmentList($link, $row[1]);
			echo " 
               </select>
            </div>
            <div class='form-group col-xs-6'>
               <label for='exampleInputappointment1'>Должность*</label>
               <input type='text' class='form-control' id='exampleInputappointment1' name='appointmentUpdate'
                     value='$row[2]'>
            </div>

            <div class='form-group col-xs-3'>
               <label for='nameDoctor2'>Фамилия*</label>
               <input type='text' class='form-control' id='nameDoctor2' name='lastname1'
                     value='$row[5]'>
            </div>
            <div class='form-group col-md-3'>
               <label for='nameDoctor1'>Имя*</label>
               <input type='text' class='form-control' id='nameDoctor1' name='firstname1'
                     value='$row[4]'>
            </div>
            <div class='form-group col-md-3'>
               <label for='nameDoctor3'>Отчество*</label>
               <input type='text' class='form-control' id='nameDoctor3' name='middlename1'
                     value='$row[6]'>
            </div>
            
            <div class='form-group col-xs-3'>
               <label for='exampleInputDepartment2'>Формальная должность*</label>
               <select name='form_appointment1' id='exampleInputDepartment2' class='form-control'>";
			giveAppointmentList($link, $row[3]);
			echo "       </select>
            </div>

            <div class='form-group col-xs-6'>
               <label for='jobTime1'>График работы сотрудника</label>
               <input type='text' class='form-control' id='jobTime1' name='jobtime1'
                     value='$row[7]'>
            </div>   
            
            <div class='form-group col-xs-6'>
               <label for='history1'>Краткая биография</label>
               <textarea class='form-control' rows='19' name='history1' id='doctor_textarea'>$row[8]</textarea>
            </div>
      </div>
      
      <div class='row'>
            <div class='form-group col-md-6'>
               <label for='speciality1'>Специальность по сертификату*</label>
               <input type='text' class='form-control' id='speciality1' name='speciality1'
                     value='$row[9]'>
            </div>
            <div class='form-group col-md-6'>
               <label for='endsert1'>Дата окончания сертификата*</label>
               <input type='date' class='form-control' id='endsert1' name='endsert1'
                     value='$row[10]'>
            </div>
      </div>
      <div class='row'>
            <div class='form-group col-md-6'>
               <label for='speciality2'>Специальность по дополнительному сертификату</label>
               <input type='text' class='form-control' id='speciality2' name='speciality2'
                     value='$row[12]'>
            </div>
            <div class='form-group col-md-6'>
               <label for='endsert2'>Дата окончания дополнительного сертификата</label>
               <input type='date' class='form-control' id='endsert2' name='endsert2'
                     value='$row[13]'>
            </div>
      </div>
      
      
      <div class='col-xs-12 form-group text-right'>
            <div class='row'>
               
               <button type='submit' class='btn btn-default'>Изменить</button>
               </form>
               
               <a data-fancybox data-src='#confirm-copy' data-modal='true' href='javascript:;' class='btn btn-default'>Копировать</a>
               <div style='display: none;' id='confirm-copy'>
                  <form method='post' action='?options=doctors&search={$_GET['search']}' enctype='multipart/form-data' id='copyPersonal'>
                  <input type='text' class='form-control hidden' id='update' name='copy' value='$row[0]'>
	                  <h2>Копирование сотрудника</h2>
	                  <p>Укажите отделение в которое необходимо скопировать сотрудника <b>$row[5] $row[4] $row[6]</b></p>
	                  <select name='toDepartment' id='exampleInputDepartment1' class='form-control'>";
								giveDepartmentList($link, $row[1]);
								echo " 
                        </select>
                        <br>
	                  <button data-fancybox-close class='btn btn-danger'>Отмена</button>
	                  <button type='submit' class='btn btn-success'>Копировать</button>
                  </form>
               </div>
               
               <a data-fancybox data-src='#confirm-deletion' data-modal='true' href='javascript:;' class='btn btn-default'>Удалить</a>
               
               <div style='display: none;' id='confirm-deletion'>
	               <h2>Подтвердите удаление!</h2>
	               <p>Вы точно хотите удалить сотрудника <b>$row[5] $row[4] $row[6]</b>?</p>
	               
	               <div class='col-xs-6 text-right'>
                        <button data-fancybox-close class='btn btn-danger'>Нет</button>
                  </div>
	               <div class='col-xs-6 text-left'>
                        <a href='?options=doctors&delete=$row[0]&search={$_GET['search']}' class='btn btn-success'>Да</a>
                  </div>
               </div>
               
               <a href='?options=doctors&search={$_GET['search']}' class='btn btn-primary'>Отмена</a>          
            </div>  
      </div>
		";
		} 
	} else {
		printf("Сотрудник не найден");
	}


	?>