<br>
<br>
<?php

$contentID     = $_GET['contentID'];
$content        = mysqli_query($konek, "SELECT * FROM home_content WHERE content_id='$contentID'");
$d_content     = mysqli_fetch_array($content);
$hitung         = mysqli_num_rows($content);


if ($hitung == 0) {
    echo '<script>alert("Pages is Not Found")
        location.replace("' . $base_url . '/url.php?p=home")</script>';
}



?>
<section id="speakers-details" class="wow fadeIn">
    <div class="container">
        <div class="section-header">
            <h2><?php echo $d_content['page_title']; ?></h2>
            <!-- <p>Praesentium ut qui possimus sapiente nulla.</p> -->
        </div>


            <div class="col-md-12">
                <div class="details">
                    
                    <?php echo $d_content['description']; ?>

                </div>
            </div>

        </div>
    </div>

</section>