<br>
<br>
<?php

$speaker_id     = $_GET['speakerID'];
$speaker        = mysqli_query($konek, "SELECT * FROM speakers WHERE speaker_id='$speaker_id'");
$d_speaker      = mysqli_fetch_array($speaker);
$hitung         = mysqli_num_rows($speaker);


if ($hitung == 0) {
    echo '<script>alert("Speakers is Not Found")
        location.replace("' . $base_url . '/url.php?p=home")</script>';
}



?>
<section id="speakers-details" class="wow fadeIn">
    <div class="container">
        <div class="section-header">
            <h2>Speaker Details</h2>
            <!-- <p>Praesentium ut qui possimus sapiente nulla.</p> -->
        </div>

        <div class="row">
            <div class="col-md-5">
                <?php
                if ($d_speaker['image_speaker'] != NULL) {
                    echo '<img src="files/speakers/' . $d_speaker['image_speaker'] . '" alt="Speaker 1" class="img-fluid">';
                } else {
                    echo '<img src="files/presenter/presenter.jpg" alt="Speaker 1" class="img-fluid">';
                }

                ?>

               
            </div>

            <div class="col-md-7">
                <div class="details">
                    <h2><?php echo $d_speaker['speaker_name']; ?></h2>
                    <p><?php echo $d_speaker['institution']; ?>.</p>

                    <?php echo $d_speaker['about_speaker']; ?>
                </div>
            </div>

        </div>
    </div>

</section>