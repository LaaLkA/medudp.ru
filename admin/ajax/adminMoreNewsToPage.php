<?php

require_once "../../../porter.php";

$m = $_GET['start']+5;
$moreNewsSee = mysqli_query($link, "SELECT * FROM news ORDER BY id DESC LIMIT {$_GET['start']},5");
while ($row = mysqli_fetch_assoc($moreNewsSee)) {
    $dateNews = date("d.m.Y", strtotime($row[time]));
    echo "
                <div class='newsPageAdminChild'>
                    <a href='/admin/index.php?options=news&idNews=$row[id]'>  
                        <div class='newsImg'><img src='../img/news/little_" . $row[image_name] . "' class='img-rounded' width='200px'></div>
                        <div id='newsMetaInformation'>
                            <div class='newsTitle'><b>$row[title]</b></div>
                            <div class='newsSubInfo'>
                                <div class='newsDate'><i class='far fa-calendar-alt'></i> $dateNews</div>";
            if ($row[det_marker] == 1) {
                echo "          <div class='newsKids'><i class='fas fa-check'></i> Для детского корпуса</div>";
            }
        echo "          
                            </div>
                        </div>
                    </a>
                </div>
            ";
    $indexb++;
}
?>