<?php
include_once('admin/config.php');
$obj = new ConnDb();
$temp_db = explode('_', $db);

/* --------------------------------------------------------------
   SAFE DATA FETCH – ONE TRY/CATCH
   -------------------------------------------------------------- */
$pillarsFirst   = [];   // First leader (LIMIT 1)
$pillarsAll     = [];   // All leaders (carousel)
$population     = [];   // population row
$education      = [];   // education count
$villageBasic   = [];   // villagebasic area

try {
    // 1. First leader
    $sql = "SELECT * FROM pillarofcommunity WHERE visibility = 'on' LIMIT 1";
    $pillarsFirst = $obj->selectdata('pillarofcommunity', $sql);
    if (!is_array($pillarsFirst)) $pillarsFirst = [];

    // 2. All leaders
    $sql = "SELECT * FROM pillarofcommunity WHERE visibility = 'on'";
    $pillarsAll = $obj->selectdata('pillarofcommunity', $sql);
    if (!is_array($pillarsAll)) $pillarsAll = [];

    // 3. Population
    $population = $obj->selectdata('population', 'SELECT * FROM population');
    if (!is_array($population)) $population = [];

    // 4. Education
    $education = $obj->selectdata('education', 'SELECT * FROM education');
    if (!is_array($education)) $education = [];

    // 5. Village basic
    $villageBasic = $obj->selectdata('villagebasic', 'SELECT * FROM villagebasic');
    if (!is_array($villageBasic)) $villageBasic = [];
} catch (Exception $e) {
    $pillarsFirst = $pillarsAll = $population = $education = $villageBasic = [];
}

/* --------------------------------------------------------------
   HELPER: first image from JSON
   -------------------------------------------------------------- */
function firstImage($json, $fallback = 'assets/image/no-leader.jpg')
{
    $photos = json_decode($json ?? '[]', true) ?: [];
    $first = $photos[0] ?? '';
    return $first ? "admin/pages/uploadedimages/{$first}" : $fallback;
}

/* --------------------------------------------------------------
   POPULATION STATS
   -------------------------------------------------------------- */
$male = $female = 0;
if (!empty($population)) {
    $male = (int)($population[0]['totalnoofmale'] ?? 0);
    $female = (int)($population[0]['totalnooffemale'] ?? 0);
}
$totalPop = $male + $female;
$totalK = $totalPop > 0 ? floor($totalPop / 1000) : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RuralConnect Web</title>
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

    <style>





    </style>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Gender', 'Ratio'],
                ['Male', 55],
                ['Female', 45],
            ]);

            var data2 = google.visualization.arrayToDataTable([
                ['Religion', 'Ratio'],
                ['Hindu', 55],
                ['muslim', 45],
            ]);

            var options = {
                pieHole: 0,
                pieSliceTextStyle: {
                    color: 'white',

                },
                // legend: 'none'
            };

            var chart = new google.visualization.PieChart(document.getElementById('donut_single'));
            chart.draw(data, options);
            var chart2 = new google.visualization.PieChart(document.getElementById('donut_single2'));
            chart2.draw(data2, options);
        }
    </script>

</head>

<body>


    <!--header--> <?php include "header.php"; ?>
    <!-- Header Ends Here -->


    <div class="page-wrapper">
        <section class="main-slider">
            <div class="main-slider-swiper owl-carousel owl-theme" style="height: 450px;">
                <div class="item">
                    <div class="item-slider-bg" style="background-image: url(assets/image/rjk/image1.jpg)"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slider-content">

                                    <!-- <div class="slider-tagline">RuralConnect Web</div> -->
                                    <h1 class="section-title"><?php echo ucwords($temp_db[1]); ?></h1>

                                </div><!-- slider-content -->
                            </div><!-- col-md-12 -->
                        </div><!-- row -->
                    </div><!-- container -->
                </div>
                <!--item-->
                <div class="item">
                    <div class="item-slider-bg" style="background-image: url(assets/image/rjk/sardar.jpg)"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slider-content">
                                    <!-- <div class="slider-tagline">RuralConnect Web</div> -->
                                    <h1 class="section-title"><?php echo ucwords($temp_db[1]); ?></h1>
                                </div><!-- slider-content -->
                            </div><!-- col-md-12 -->
                        </div><!-- row -->
                    </div><!-- container -->
                </div>
                <!--item-->
            </div><!-- main-slider-swiper -->
        </section>
        <!--main-slider-->
        <section class="department-section" style="margin-top:1%;padding-bottom:0px;">
            <div class="container">
                <div class="department-section-inner">
                    <section class="client-section">
                        <div class="container">
                            <div class="client-carousel owl-carousel owl-theme">
                                <div class="item">
                                    <div class="department-card" style="padding-bottom:0px;">
                                        <div class="department-card-icon">
                                            <a href="banking.php"><i class="flaticon-bank"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="banking.php">Banking</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->

                                </div>
                                <!--item-->
                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="education.php"><i class="flaticon-education"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="education.php">Education</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->

                                </div>
                                <!--item-->
                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="electrification.php"><i class="flaticon-solar-panel"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="electrification.php">Electricfication</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>
                                <!--item-->
                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="emergencyservices.php"><i class="fa-solid fa-house-fire"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="emergencyservices.php">EmergencyServices</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>
                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="employmentcenters.php"><i
                                                    class="fa-solid fa-person-walking-luggage"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="employmentcenters.php">EmploymentCenters</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>
                                <!--item-->

                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="entertainment.php"><i class="flaticon-music-instrument"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="entertainment.php">Entertainment</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>
                                <!--item-->
                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="eventsfestivals.php"><i class="fa-solid fa-calendar-day"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="eventsfestivals.php">EventsFestivals</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>
                                <!--item-->
                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="fuel.php"><i class="flaticon-gas"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="fuel.php">Fuel</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>
                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="health.php"><i class="flaticon-hospital"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="health.php">Health</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>


                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="health.php"><i class="flaticon-home"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="hotels.php">Hotels</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>

                                <!--item-->
                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="health.php"><i class="fa fa-cog"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="DrainageDetails.php">Other Services</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>
                                <!--item-->
                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="placestoworship.php"><i class="flaticon-earth-globe"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="placestoworship.php">Places To Worship</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>
                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="transport.php"><i class="flaticon-transportation"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="transport.php">Public Transport</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>
                                <!--item-->
                                <div class="item">
                                    <div class="department-card">
                                        <div class="department-card-icon">
                                            <a href="tourism.php"><i class="flaticon-earth-globe"></i></a>
                                        </div><!-- department-card-icon -->
                                        <div class="department-card-content">
                                            <h5><a href="tourism.php">Tourism</a></h5>
                                        </div><!-- department-card-content -->
                                    </div>
                                    <!--department-card-->
                                </div>
                                <!--item-->

                            </div>
                            <!--client-carousel owl-carousel owl-theme-->
                        </div>
                        <!--container-->
                    </section>
                    <!--client-section-->
                </div>
                <!--department-section-inner-->
            </div><!-- container -->

        </section>





        <h5 class="client-text" style="text-decoration: underline;text-underline-position: under;">Pillar of the
            Community</h5><!-- client-text -->


        <?php if (empty($pillarsFirst)): ?>
            <p style="text-align:center; margin-top:20px;">No leader data available.</p>
        <?php else: $p = $pillarsFirst[0];
            $img = firstImage($p['photo'] ?? ''); ?>
            <section class="team-details-section" style="margin-top: -150px">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-12 col-lg-6">
                            <div class="team-details-image">
                                <img src="<?= $img ?>" class="img-fluid" alt="<?= htmlspecialchars($p['name']); ?>"
                                    style="height:600px;width:100%;">
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="team-details-title-one">
                                <h2><?= htmlspecialchars($p['name']); ?></h2>
                                <span>one of India's greatest leaders</span>
                            </div>
                            <div class="team-details-text">
                                <p style="margin-top:-40px"><?= nl2br(htmlspecialchars($p['description'])); ?></p>
                            </div>
                            <div class="team-details-list" style="margin-top:-30px">
                                <h3>Education</h3>
                                <div class="team-details-list-item">
                                    <div class="row" style="margin-top:-20px">
                                        <div class="col-sm-12 col-lg-6 col-xl-6">
                                            <div class="team-details-box">
                                                <div class="team-details-year"></div>
                                                <p><?= nl2br(htmlspecialchars($p['education'])); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 style="margin-top:-30px">Political Carrier</h3>
                                <div class="team-details-list-item" style="margin-top:-20px">
                                    <div class="team-details-box">
                                        <div class="team-details-year"></div>
                                        <p><?= nl2br(htmlspecialchars($p['politicalcareer'])); ?></p>
                                        <p><?= nl2br(htmlspecialchars($p['positionsheld'])); ?></p>
                                    </div>
                                </div>
                                <h3 style="margin-top:30px">Role In Independence Movement</h3>
                                <div class="team-details-list-item" style="margin-top:-30px">
                                    <div class="team-details-box">
                                        <div class="team-details-year"></div>
                                        <p><?= nl2br(htmlspecialchars($p['roleinindependencemovement'])); ?></p>
                                    </div>
                                </div>
                                <h3 style="margin-top:30px">Details</h3>
                                <div class="team-details-list-item">
                                    <div class="row" style="margin-top:-20px">
                                        <div class="col-sm-12 col-lg-6 col-xl-6">
                                            <div class="team-details-box">
                                                <div class="team-details-year"></div>
                                                <p><?= nl2br(htmlspecialchars($p['description'])); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if (empty($pillarsAll)): ?>
            <p style="text-align:center; margin-top:20px;">No community leaders found.</p>
        <?php else: ?>
            <section class="funfact-section" style="background:whitesmoke">
                <div class="event-details-gallery-box" style="margin-top:-80px">
                    <div class="event-details-carousel owl-carousel owl-theme" style="padding-left:5%; padding-right:5%;">
                        <?php foreach ($pillarsAll as $p): $img = firstImage($p['photo'] ?? ''); ?>
                            <div class="row row-gutter-30" style="margin-right:20px">
                                <div class="col-lg-6">
                                    <img src="<?= $img ?>" class="img-fluid" alt="<?= htmlspecialchars($p['name']); ?>" style="height:200px">
                                </div>
                                <div class="department-details-benefits-box">
                                    <h3><?= htmlspecialchars($p['name']); ?></h3>
                                    <p><?= htmlspecialchars($p['profession']); ?></p>
                                    <ul class="list-unstyled list-style">
                                        <?php foreach (explode('.', $p['positionsheld'] ?? '') as $s): if (trim($s)): ?>
                                                <li><i class="fa-solid fa-circle-arrow-right"></i>
                                                    <h5 style="margin-top:30px"><?= htmlspecialchars(trim($s)); ?></h5>
                                                </li>
                                        <?php endif;
                                        endforeach; ?>
                                        <?php foreach (explode('.', $p['roleinindependencemovement'] ?? '') as $s): if (trim($s)): ?>
                                                <li><i class="fa-solid fa-circle-arrow-right"></i>
                                                    <h5 style="margin-top:30px"><?= htmlspecialchars(trim($s)); ?></h5>
                                                </li>
                                        <?php endif;
                                        endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="btn btn-primary" style="margin-left:50px"><a href="leaders.php" style="color:white">View More</a></button>
            </section>
        <?php endif; ?>






        <section class="testimonial-section"
            style="padding-bottom:50px;background-image:url('assets/image/rjk/testibg2.jpg');background-position:top;">
            <!-- <section class="testimonial-section"> -->
            <div class="container">
                <div class="testimonial-name">TESTIMONIALS</div>
                <div class="testimonial-slider">
                    <div class="swiper testimonial-reviews">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="testimonial-content">
                                    <div class="testimonial-ratings">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div><!-- testimonial-ratings -->
                                    <div class="testimonial-text">
                                        The village website is a great resource for staying updated on community events
                                        and local news. It's easy to navigate and very informative.
                                    </div><!-- testimonial-text -->
                                    <div class="testimonial-thumb-card">
                                        <h5>Nishtha Dholakiya</h5>
                                        <!-- <span>Customer</span> -->
                                    </div><!-- testimonial-thumb-card -->
                                </div>
                                <!--testimonial-content-->
                            </div>
                            <!--swiper-slide-->
                            <div class="swiper-slide">
                                <div class="testimonial-content">
                                    <div class="testimonial-ratings">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div><!-- testimonial-ratings -->
                                    <div class="testimonial-text">
                                        I love the interactive map feature on the website. It's helpful for finding
                                        amenities and locating local businesses.
                                    </div><!-- testimonial-text -->
                                    <div class="testimonial-thumb-card">
                                        <h5>Riya M Panchal</h5>
                                        <!-- <span>Customer</span> -->
                                    </div><!-- testimonial-thumb-card -->
                                </div>
                                <!--testimonial-content-->
                            </div>
                            <!--swiper-slide-->
                            <div class="swiper-slide">
                                <div class="testimonial-content">
                                    <div class="testimonial-ratings">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div><!-- testimonial-ratings -->
                                    <div class="testimonial-text">
                                        The village website could improve by adding more detailed information about
                                        public services and facilities.
                                    </div><!-- testimonial-text -->
                                    <div class="testimonial-thumb-card">
                                        <h5>Nikita Darji</h5>
                                        <!-- <span>Member</span> -->
                                    </div><!-- testimonial-thumb-card -->
                                </div>
                                <!--testimonial-content-->
                            </div>
                            <!--swiper-slide-->
                        </div><!-- swiper-wrapper -->
                        <div class="swiper-pagination"></div>
                    </div>
                    <!--swiper testimonial-reviews-->

                    <!--testimonial-thumb-->
                </div>
                <!--testimonial-slider-->
            </div><!-- container -->
        </section>
        <!--testimonial-section-->





    </div>
    <!--page-wrapper-->



    <!-- Footer Starts Here   --> <?php include "footer.php"; ?>
    <!-- Footer Ends Here -->


    <!--mobile-nav-wrapper -->
    <!-- Mobile Nav in Footer.php page-->



    <a href="#" class="scroll-to-top scroll-to-target" data-target="html"><i class="fa-solid fa-arrow-up"></i></a>
    <!-- plugins js -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="assets/vendor/youtube-popup/youtube-popup.jquery.js"></script>
    <script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>