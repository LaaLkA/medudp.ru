<div class="col-xs-12 ">
    <a name="exp1"></a>
    <div class="row">
        <a href="?page=news#exp1" class="era_a"><h3 class="era"><i class="far fa-newspaper"></i> <b>НОВОСТИ</b></h3></a>
    </div>
</div>


<div class="col-xs-12 news_list">
    
        <?php
        $news_see = mysqli_query($link, "SELECT * FROM news ORDER BY id DESC LIMIT 5");
        while ($row = mysqli_fetch_assoc($news_see)) {
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
    
</div>