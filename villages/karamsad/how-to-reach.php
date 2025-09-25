<?php
include_once('admin/config.php');
$obj = new ConnDb();
$temp_db = explode('_',$db);
$res = $obj->selectdata("villagebasic","select * from villagebasic");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How To Visit || Village On Web</title>
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



    <!--header--> <?php include"header.php"; ?>
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
                    <div class="col-lg-12 col-xl-6">
                        <div class="about-one-inner">
                            <div class="section-tagline">
                                How To Reach <?php echo ucwords($temp_db[1]); ?>
                            </div><!-- section-tagline -->
                            <h2 class="section-title">Map to Reach <?php echo ucwords($temp_db[1]); ?></h2>

                            <p><?php echo $res[0]['mapdes'] ?></p>

                        </div><!-- about-one-inner -->
                    </div>
                    <!--col-lg-6-->
                    <div class="col-lg-12 col-xl-6">
                        <div class="about-one-image">
                            <img src="assets/image/shapes/shape-1.png" class="floated-image-one" alt="img-58">
                            <!-- <img src="assets/image/rjk/clay-1139098_1920 (1).jpg" alt="img-59" class="img-fluid"> -->
                            <?php
						$url='';
						
						if($res[0]['vmap']!=""){
						$url=  $res[0]['vmap'];?>
                            <iframe src="<?php echo $url; ?>" width="570" height="479"
                                style="height: 500px;border:0;width: 100%;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" class="img-fluid"></iframe>
                            <?php }
						else{
							echo '<h1>Map Not Found!</h1>';
						}
						?>

                        </div>
                        <!--about-one-image-->
                    </div>
                    <!--col-lg-6-->
                </div><!-- row -->
            </div><!-- container -->
        </section>
        <!--about-one-section-->


    </div>
    <!--page-wrapper-->

    <!-- Footer Starts Here   --> <?php include"footer.php"; ?>
    <!-- Footer Ends Here -->



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