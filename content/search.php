<div class="col-md-12 col-sm-12">
    <div class="row">
        <a name="exp1"></a>
        <h3 class="era"><span class="glyphicon glyphicon-send"></span> <Strong>Результаты поиска</Strong></h3>
    </div>
</div>

<div class="col-sm-12 fon_block">

    <div class="col-sm-3 col-md-3 poisk">
        <div class="row">
            <form role="form" method="post" action="?page=search#exp1">
                <div class="input-group">
                    <input name="search_text" type="text" class="form-control input-sm" placeholder="Поиск по сайту">
                    <span class="input-group-btn">
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="clearfix"></div>

    <?php
    if (isset($_POST['search_text'])) {
        if (empty($_POST['search_text'])) {
            echo "<h4>Извините. По вашему запросу ничего не найдено =(</h4>";
        }else {
            $search_text = strip_tags($_POST['search_text']);
            $search_text = htmlspecialchars($search_text);
            $search_text = mysqli_real_escape_string($link, $search_text);

            $dep_search = mysqli_query($link, 'SELECT * FROM departments WHERE name LIKE "%'.$search_text.'%"');
            if (!$dep_search) {
                echo "<h4>Извините. По вашему запросу ничего не найдено =(</h4>";
            }else {
                $counter = 1;
                while ($row = mysqli_fetch_row($dep_search)) {
                    echo "<br><p class='dep_info'>$counter.<a href='?page=department_page&department_name=$row[2]#exp1'>$row[1]</a></p>";
                    echo "<small>$row[3]</small>";
                    $counter++;
                }
            }
        }
    }
    ?>
</div>