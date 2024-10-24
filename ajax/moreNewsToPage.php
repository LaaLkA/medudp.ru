<?php

require_once "../../porter.php";

$m = $_GET['start']+10;

$moreNewsSee = mysqli_query($link, "SELECT * FROM news ORDER BY id DESC LIMIT {$_GET['start']},10");
while ($row = mysqli_fetch_assoc($moreNewsSee)) {
    $newsDate = date("d.m.Y", strtotime($row[time]));
    $short_link = mb_substr($row[3], 0, 250);
    echo "
    <a class='a_news' href='?page=news&news=$row[id]#exp1'>
                <div class='col-xs-12 news_bl_1'>
                    
                        <div class='col-xs-3'>
                            <div class='row'>
                            <img src='https://www.medudp.ru/img/news/little_$row[image_name]' alt='$row[title]' class='img-rounded img_news'>
                            </div>
                        </div>
                        <div class='col-xs-9'>

                            <h3 class='newsTitle'><b>$row[title]</b></h3>
                            <p class='date_line'>$newsDate</p>
                            
                        </div>
                    
                </div>
            </a>
";
}
?>