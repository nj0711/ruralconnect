<?php
include_once 'admin/config.php';
$obj = new ConnDb();
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leaders || RuralConnect Web</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- plugins css -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/reey-font/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/flaticon/css/flaticon_towngov.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/vendor/youtube-popup/youtube-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/image/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/image/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/image/favicons/site.webmanifest">
</head>

<body>


    <!--header--> <?php include "header.php"; ?>
    <!-- Header Ends Here -->


    <div class="page-wrapper">
        <section class="page-banner" style="background-image: url('./assets/image/rjk/image1.jpg');">
            <div class="container">

            </div><!-- container -->
        </section>
        <!--page-banner-->
        <section class="about-one-section">
            <div class="container">
                <div class="row row-gutter-y-40">

                    <div class="about-one-inner">

                        <?php
                        $temp_db = explode('_', $db);
                        ?>
                        <h2 class="section-title">Welcome to <?php echo ucwords($temp_db[1]); ?> Town Council</h2>
                        <p>Welcome to <?php echo ucwords($temp_db[1]); ?>, where the rhythm of life beats with the
                            harmony of community, and the echoes of our heritage resound through the streets. Nestled
                            amidst nature's embrace, our village is more than just a place; it's a tapestry of stories,
                            woven by the hands of generations past and present.</p>
                        <h5 class="about-one-inner-text">Join us as we celebrate our shared journey, rooted in tradition
                            yet reaching for the horizon of possibility.</h5>
                        <div class="row row-gutter-y-30">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="about-one-card">
                                    <div class="about-one-card-number">01</div>
                                    <div class="about-one-card-content">
                                        <h5>Going Above and Beyond</h5>
                                    </div>
                                </div><!-- about-one-card -->
                            </div><!-- col-xl-6 col-lg-6 col-md-6 -->
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="about-one-card">
                                    <div class="about-one-card-number">02</div>
                                    <div class="about-one-card-content">
                                        <h5>Committed to People First</h5>
                                    </div>
                                </div><!-- about-one-card -->
                            </div><!-- col-xl-6 col-lg-6 col-md-6 -->
                        </div><!-- row row-gutter-y-30 -->
                    </div><!-- about-one-inner -->


                </div><!-- row -->
            </div><!-- container -->
        </section>
        <!--about-one-section-->

        <!-- --------------------------------------------------- Section 1 ------------------------------------ -->
        <?php

        $val = $obj->selectdata("pillarofcommunity", "select * from pillarofcommunity WHERE typeofleader not in ('sarpanch','mla') limit 3");
        if ($val == "No Data Found!") {
            echo 'No Datafound';
        } else {

            $rows = count($val);
            for ($i = 0; $i < $rows; $i++) {
                if ($val[$i]['visibility'] == 'on') {

                    $name = $val[$i]['name'];
                    $bdy = $val[$i]['birthdate'];
                    $ddy = $val[$i]['dateofpassing'];
                    $datediff = $obj->selectdata("pillarofcommunity", 'select DATEDIFF(dateofpassing,birthdate) from pillarofcommunity');

                    $description = $val[$i]['description'];

                    $edu = $val[$i]['education'];
                    $plcarrier = $val[$i]['politicalcareer'];
                    $positionsheld = $val[$i]['positionsheld'];
                    $role = $val[$i]['roleinindependencemovement'];
                    $profession = $val[$i]['profession'];
                    $typeofleader = $val[$i]['typeofleader'];

                    $img = $val[$i]['photo'];

                    $uploadedFiles = json_decode($img, true);
                    $fileCount = count($uploadedFiles);
                    if ($fileCount > 1) {
                        $firstImage = $uploadedFiles[1];
                    } else {
                        $firstImage = $uploadedFiles[0];
                    }
                    // Fetch the first image

                    // Construct the full image path
                    $imagePath = 'admin/pages/uploadedimages/' . $firstImage;
        ?>

                    <section class="team-details-section" style="margin-top: -150px">
                        <div class="container">
                            <div class="row justify-content-between">
                                <div class="col-12 col-lg-6">
                                    <div class="team-details-image">
                                        <?php

                                        ?>
                                        <img src=<?php echo $imagePath; ?> class="img-fluid" alt="img-93"
                                            style="height:600px;width:100%;">

                                    </div>
                                    <!--team-details-image-->
                                </div>
                                <!--col-12 col-lg-6-->
                                <div class="col-12 col-lg-5">
                                    <div class="team-details-title-one">
                                        <h2><?php echo $name; ?></h2>
                                        <span><?php echo $profession; ?></span>
                                    </div>
                                    <!--team-details-title-one-->
                                    <!--team-details-socials-->
                                    <div class="team-details-info">
                                        <ul class="list-unstyled">
                                            <!--<li>years of live: <span><?php echo floor((implode($datediff[0]) / 365)); ?> Years (<?php echo $bdy; ?>-->
                                            <!--        – <?php echo $ddy; ?>)</span></li>-->
                                        </ul><!-- list-unstyled -->
                                    </div>
                                    <!--team-details-info-->
                                    <div class="team-details-text">

                                        <p style="margin-top:-40px"><?php $description; ?></p>
                                    </div>
                                    <br>
                                    <div class="team-details-list">
                                        <h3>Education</h3>
                                        <div class="team-details-list-item">
                                            <div class="row" style="margin-top:-20px">
                                                <div class="col-sm-12 col-lg-6 col-xl-6">
                                                    <div class="team-details-box">
                                                        <div class="team-details-year"></div>
                                                        <p><?php echo $edu; ?></p>
                                                        <!-- <p>Columbia University, CL</p> -->
                                                    </div>
                                                    <!--team-details-box-->
                                                </div>
                                                <!--col-sm-6 col-lg-6 col-xl-6-->

                                                <!--col-sm-6 col-lg-6 col-xl-6-->
                                            </div><!-- row -->
                                        </div>
                                        <!--team-details-list-item--><br><br>
                                        <h3 style="margin-top:-30px">Political Carrier</h3>
                                        <div class="team-details-list-item" style="margin-top:-20px">

                                            <!-- <div class="col-sm-12 col-lg-6 col-xl-6"> -->
                                            <div class="team-details-box">
                                                <div class="team-details-year"></div>
                                                <p><?php echo $plcarrier; ?>

                                                </p>
                                                <p><?php echo $positionsheld; ?>
                                                </p>
                                                <!-- <p>Columbia University, CL</p> -->
                                            </div>
                                            <!--team-details-box-->
                                            <!-- </div> -->
                                            <!--col-sm-6 col-lg-6 col-xl-6-->


                                        </div>
                                        <!--team-details-list-item--><br><br>
                                        <h3 style="margin-top:-30px">Role In Independence Movement</h3>
                                        <div class="team-details-list-item" style="margin-top:-20px">

                                            <!-- <div class="col-sm-12 col-lg-6 col-xl-6"> -->
                                            <div class="team-details-box">
                                                <div class="team-details-year"></div>
                                                <p><?php echo $role; ?>
                                                </p>
                                                <!-- <p>Columbia University, CL</p> -->
                                            </div>
                                            <!--team-details-box-->
                                            <!-- </div> -->
                                            <!--col-sm-6 col-lg-6 col-xl-6-->


                                        </div>
                                        <h3>Details</h3>
                                        <div class="team-details-list-item">
                                            <div class="row" style="margin-top:-20px">
                                                <div class="col-sm-12 col-lg-6 col-xl-6">
                                                    <div class="team-details-box">
                                                        <div class="team-details-year"></div>
                                                        <p><?php echo $description; ?></p>
                                                        <!-- <p>Columbia University, CL</p> -->
                                                    </div>
                                                    <!--team-details-box-->
                                                </div>
                                                <!--col-sm-6 col-lg-6 col-xl-6-->

                                                <!--col-sm-6 col-lg-6 col-xl-6-->
                                            </div><!-- row -->
                                        </div>
                                        <!--team-details-list-item-->
                                    </div>
                                    <!--team-details-list-->
                                </div>
                                <!--col-12 col-lg-12-->
                            </div><!-- row -->
                        </div><!-- container -->

                        <br><br>
                        <!--department-section-->
                    </section>
                    <!--team-details-section-->

        <?php }
            }
        } ?>

        <!-- --------------------------------------------------- Section 2 ------------------------------------ -->


        <?php

        $value = $obj->selectdata("pillarofcommunity", "select * from pillarofcommunity WHERE typeofleader not in ('sarpanch','mla')");
        if ($value == "No Data Found!") {
            echo 'No Datafound';
        } else {

        ?>

            <section class="client-section" style="margin-top:-50px">
                <h5 class="client-text">Pillar of the Community</h5><!-- client-text -->
                <div class="container">
                    <div class="client-carousel owl-carousel owl-theme">
                        <?php $r2 = count($value);
                        for ($i = 0; $i < $r2; $i++) {
                            if ($val[$i]['visibility'] == 'on') {
                                $name = $val[$i]['name'];
                                $bdy = $val[$i]['birthdate'];
                                $ddy = $val[$i]['dateofpassing'];
                                $datediff = $obj->selectdata("pillarofcommunity", 'select
                        DATEDIFF(dateofpassing,birthdate) from pillarofcommunity');
                                $profession = $val[$i]['profession'];
                                $description = $val[$i]['description'];

                                $edu = $val[$i]['education'];
                                $plcarrier = $val[$i]['politicalcareer'];


                                $img = $val[$i]['photo'];
                                $uploadedFiles = json_decode($img, true);
                                // Fetch the first image
                                $fileCount = count($uploadedFiles);
                                if ($fileCount > 1) {
                                    $firstImage = $uploadedFiles[1];
                                } else {
                                    $firstImage = $uploadedFiles[0];
                                }

                                // Construct the full image path
                                $imagePath = 'admin/pages/uploadedimages/' . $firstImage;
                        ?>

                                <div class="item">
                                    <img src=<?php echo $imagePath; ?> class="img-fluid" alt="img-61" style="opacity:1;">
                                    <div class="about-one-card-content">
                                        <h5 style="margin-right:25px"><?php echo $name; ?></h5>
                                    </div>
                                    <div class="about-one-card-content">
                                        <h5 style="font-size:15px;margin-right:30px;color:green;"><?php echo $profession; ?>
                                        </h5>
                                    </div>

                                </div>
                                <!--item-->

                        <?php }
                        }

                        ?>
                        <!--item-->
                    </div>
                    <!--client-carousel owl-carousel owl-theme-->
                </div>
                <!--container-->
            </section>






        <?php
        } ?>


        <!-- --------------------------------------------------- Section 3 ------------------------------------ -->
        <?php
        $v3 = $obj->selectdata("pillarofcommunity", "select * from pillarofcommunity WHERE typeofleader in ('sarpanch','mla')");

        if ($v3 == "No Data Found!") {
            echo 'No Datafound';
        } else {
        ?>
            <section class="team-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="team-inner">
                                <div class="section-tagline">team members</div>
                                <h2 class="section-title">Meet our Professional Town Council</h2>
                            </div>
                            <!--team-inner-->
                        </div>
                        <!--col-12 col-md-12 col-lg-6 col-xl-6-->
                        <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="team-box">
                                <p>Guiding our town's journey with wisdom and dedication, our council members light the path
                                    to progress, embodying the heart of community leadership.</p>
                            </div>
                            <!--team-box-->
                        </div>
                        <!--col-12 col-md-12 col-lg-6 col-xl-6-->
                    </div><!-- row -->
                    <div class="row row-gutter-y-30" style="    justify-content: center;">

                        <?php
                        $r3 = count($v3);

                        for ($i = 0; $i < $r3; $i++) {
                            if ($v3[$i]['visibility'] == 'on') {
                                $name = $v3[$i]['name'];
                                $bdy = $v3[$i]['birthdate'];
                                $ddy = $v3[$i]['dateofpassing'];
                                $datediff = $obj->selectdata("pillarofcommunity", 'select DATEDIFF(dateofpassing,birthdate) from pillarofcommunity');
                                $typeofleader = $v3[$i]['typeofleader'];
                                $description = $v3[$i]['description'];

                                $edu = $v3[$i]['education'];
                                $plcarrier = $v3[$i]['politicalcareer'];


                                $img = $v3[$i]['photo'];
                                $uploadedFiles = json_decode($img, true);
                                // Fetch the first image
                                $fileCount = count($uploadedFiles);
                                if ($fileCount > 1) {
                                    $firstImage = $uploadedFiles[1];
                                } else {
                                    $firstImage = $uploadedFiles[0];
                                }
                                // Construct the full image path
                                $imagePath = 'admin/pages/uploadedimages/' . $firstImage;
                        ?>

                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="team-card">
                                        <div class="team-card-img">
                                            <img src=<?php echo $imagePath; ?> class="img-fluid" alt="img-67">

                                        </div><!-- team-card-img -->
                                        <div class="team-card-content">
                                            <h4><?php echo $name; ?></h4>
                                            <p><?php echo ucwords($typeofleader); ?></p>
                                        </div><!-- team-card-content -->
                                    </div>
                                    <!--team-card-->
                                </div>
                                <!--col-12 col-md-6 col-xl-3-->

                                <!--col-12 col-md-6 col-xl-3-->
                            <?php } ?>
                    </div><!-- row -->
                </div><!-- container -->
            </section>

    <?php }
                    }
    ?>
    <!--team-section-->

    </div>
    <!--page-wrapper-->

    <!-- Footer Starts Here   --> <?php include "footer.php"; ?>
    <!-- Footer Ends Here -->



    <div class="search-popup">
        <div class="search-popup-overlay search-toggler"></div><!-- search-popup-overlay -->
        <div class="search-popup-content">
            <form action="#">
                <label for="search" class="sr-only">search here</label><!-- sr-only -->
                <input type="text" id="search" placeholder="Search Here...">
                <button type="submit" aria-label="search submit" class="search-btn">
                    <span><i class="flaticon-search-interface-symbol"></i></span>
                </button><!-- search-btn -->
            </form><!-- form -->
        </div><!-- search-popup-content -->
    </div><!-- search-popup -->
    <a href="#" class="scroll-to-top scroll-to-target" data-target="html"><i class="fa-solid fa-arrow-up"></i></a>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="assets/vendor/youtube-popup/youtube-popup.jquery.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>