<div class="col-xs-12 department_page">
    <div class="col-xs-6 infWrapperMainAdminPage">
        <p class="pageNameLabel">Недавно добавленные отделения</p>
        <?php
        $result = $link->query("SELECT * FROM departments ORDER BY id DESC LIMIT 6");
        while ($row = mysqli_fetch_row($result)){
            echo "
            <a href='?options=departments&dep=$row[0]' class='mainPageDepartmentStroke'>
                
                    <p class='newsNameStroke2'>$row[1]</p>
                
            </a>
            ";
        };
        ?>
        <a href="?options=departments" class="btn btn-success btn-xs">Все отделения -></a>
    </div>

    <div class="col-xs-6 infWrapperMainAdminPage">
        <p class="pageNameLabel">Недавно добавленные сотрудники</p>
        <?php
        $result = $link->query("SELECT * FROM doctors ORDER BY id DESC LIMIT 6");
        while ($row = mysqli_fetch_row($result)){
            echo "
            <a href='?options=doctors&profile=$row[0]' class='mainPageDepartmentStroke'>
                <p class='newsNameStroke2'>$row[5] $row[4] $row[6]</p>
            </a>
            ";
        };
        ?>
        <a href="?options=departments" class="btn btn-success btn-xs">Все cотрудники -></a>
    </div>
    <div class="clearfix"></div>
    <div class="col-xs-6 infWrapperMainAdminPage">
        <p class="pageNameLabel">Недавно добавленные новости</p>
        <?php
        $result = $link->query("SELECT * FROM news ORDER BY id DESC LIMIT 6");
        while ($row = mysqli_fetch_row($result)){
            $convertDate = convertDate($row[4]);
            echo "
            <a href='?options=news&idNews=$row[0]' class='mainPageDepartmentStroke'>
                <p class='newsNameStroke'><span class='spanDepNameStroke'>$row[1]</span> <span class='spanDepNameStroke'>$convertDate</span></p>
            </a>
            ";
        };
        ?>
        <a href="?options=news" class="btn btn-success btn-xs">Все новости -></a>
    </div>
</div>