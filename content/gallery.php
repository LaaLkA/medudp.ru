<div class="col-xs-12">
    <a name="exp1"></a>
    <div class="row">
        <h3 class="era"><i class="fa fa-picture-o" aria-hidden="true"></i> <Strong>ГАЛЕРЕЯ</Strong></h3>
    </div>
</div>


<div class="col-xs-12 gall_container">

    <?php

    $department = $link->query("SELECT `form_name`, `dpname` FROM departments ORDER BY dpname");
    while ($row = mysqli_fetch_row($department)) {
        $home = $_SERVER['DOCUMENT_ROOT'];
        $dir = $home . "/departments/$row[0]/gallery";
        $images = scandir($dir);

        if (count($images)>2) {
            $images = array_values(array_filter($images, function ($e) {
                return $e != (".") and $e != ("..");
            }));
            echo "<p class='galleryTitle'>$row[1]</p>";
            echo "<div class='col-xs-12 gallery'>";
            for ($i = 0; $i < count($images); $i++) {
                echo "
                    <a data-fancybox='gallery' href='/departments/$row[0]/gallery/$images[$i]'>
                        <img src='/departments/$row[0]/gallery/$images[$i]' class='img-rounded galleryImgPage' alt='$i'>
                    </a>
                ";
            }
            echo "</div>";
        }
    }

    ?>
</div>