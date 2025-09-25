<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Electrification || Village On Web</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- plugins css -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/flaticon/css/flaticon_towngov.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/vendor/youtube-popup/youtube-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="modal.css">
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/image/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/image/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/image/favicons/site.webmanifest">


    <style>
        .close {
            color: #aaa;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            position: absolute;
            top: 10px;
            left: 20px;
        }

        .close:hover,
        .close:focus {
            color: black !important;
            text-decoration: none;
            cursor: pointer !important;
        }
    </style>

</head>

<body>

    <?php include "header.php"; ?>
    <!-- connection -->
    <?php
    include_once('admin/config.php');
    $obj = new ConnDb();
    $table = 'electrification';
    $values = 'SELECT * FROM  electrification';

    $result = $obj->selectdata($table, $values);

    //connection end

    ?>
    <div class="page-wrapper">
        <section class="page-banner">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Electrification</h3>
                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section>
        <!--page-banner-->
        <section class="department-one-section">
            <div class="container">
                <!-- <center>
					<h2 style="margin-bottom: 50px;">Schools</h2>
				</center> -->
                <div class="row row-gutter-30">
                    <?php
                    if (empty($result)) {
                        echo "<h2 style='margin-bottom: 50px;'>Electrification</h2>";
                    } else {
                        foreach ($result as $row => $electrification) {
                            if ($electrification['visibility'] == 'on') {
                                $modalId = "myModal" . $row;
                    ?>
                                <!-- card -->
                                <div class=" col-lg-6 col-xl-4 ">
                                    <div class="department-two-card">
                                        <div class="department-two-imgbox">
                                            <div class="department-two-img">
                                                <img src="<?php
                                                            $photos = json_decode($electrification['photo'], true);
                                                            // print_r($photos);
                                                            echo './admin/pages/uploadedimages/' . $photos[0];
                                                            ?>" class="img-fluid" alt="img-150">
                                            </div><!-- department-two-img -->
                                        </div><!-- department-two-imgbox -->
                                        <div class="department-two-content">
                                            <h4><a>
                                                    <?php
                                                    echo $electrification['companyname'];
                                                    ?>
                                                </a></h4>
                                            <br>
                                            <div class="department-two-button">
                                                <a href="javascript:void(0);" onclick="openModal('<?php echo $modalId; ?>')">
                                                    <i class="fa-solid fa-arrow-right-long"></i>
                                                    <span>Read More</span></a>
                                            </div><!-- department-two-button -->
                                        </div><!-- department-two-content -->
                                    </div>
                                    <!--department-two-card-->
                                </div>

                    <?php }
                        }
                    } ?>

                    <?php
                    if ($result != "No Data Found!") {
                        foreach ($result as $row => $electrification) {
                            if ($electrification['visibility'] == 'on') {
                                $modalId = "myModal" . $row; ?>
                                <!-- modal to display -->
                                <div id="myModal<?php echo $modalId; ?>" class="modal">
                                    <div class="modal-content">
                                        <b><span class="close" onclick="closeModal('<?php echo $modalId; ?>')">&times;</span>
                                            <div class="modal-body">
                                                <div class="text-content">
                                                    <h1><?php echo $electrification['companyname']; ?></h1>
                                                    <br>
                                                    <p><i class="fa-solid fa-location-dot">&nbsp;</i>
                                                        <?php // Retrieve concatenated address, city, pincode
                                                        $addressCityPincode = $electrification['officeaddress'];
                                                        $modifiedAddress = str_replace('@', ', ', $addressCityPincode);
                                                        echo $modifiedAddress ?></p>

                                                    <p><strong>Description</strong>: <br>
                                                        <?php echo !empty($electrification['description']) ? $electrification['description'] : 'None provided'; ?>
                                                    </p>

                                                    <p><strong>Service Area</strong>: <br>
                                                        <?php echo !empty($electrification['servicearea']) ? $electrification['servicearea'] : 'None provided'; ?>
                                                    </p>

                                                    <p><strong>Contact Information</strong>:
                                                        <br> Email Id:
                                                        <?php echo !empty($electrification['email']) ? $electrification['email'] : 'None provided'; ?>
                                                        <br> Phone No:
                                                        <?php echo !empty($electrification['contactno']) ? $electrification['contactno'] : 'None provided'; ?>
                                                    </p>

                                                    <p><strong>Emergency Information</strong>:
                                                        <br> Emergency contactno:
                                                        <?php echo !empty($electrification['emergencycontactno']) ? $electrification['emergencycontactno'] : 'None provided'; ?>
                                                        <br> Energy Resources Solar:
                                                        <?php echo !empty($electrification['energyresourcessolar']) ? $electrification['energyresourcessolar'] : 'None provided'; ?>
                                                        <br> Energy Resources Wind:
                                                        <?php echo !empty($electrification['energyresourceswind']) ? $electrification['energyresourceswind'] : 'None provided'; ?>
                                                        <br> Energy Resources Coal:
                                                        <?php echo !empty($electrification['energyresourcescoal']) ? $electrification['energyresourcescoal'] : 'None provided'; ?>
                                                        <br> Energy Resources Gas:
                                                        <?php echo !empty($electrification['energyresourcesgas']) ? $electrification['energyresourcesgas'] : 'None provided'; ?>
                                                    </p>

                                                    <p><strong>Supply Chain</strong>: <br>
                                                        <?php echo !empty($electrification['supplychain']) ? $electrification['supplychain'] : 'None provided'; ?>
                                                    </p>


                                                    <p> <b>Other Information:</b><br>

                                                        <?php
                                                        echo $electrification['description'];
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                    <?php }
                        }
                    } else {
                        echo '<h1>No Data Found!</h1>';
                    } ?>

                </div><!-- row -->
            </div><!-- container -->
        </section><!-- department-one-section -->
    </div>
    <!--page-wrapper-->


    <!-- Footer Starts Here -->
    <?php include "footer.php"; ?>
    <!--footer ends here-->


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
    <script src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="assets/vendor/youtube-popup/youtube-popup.jquery.js"></script>
    <script src="assets/js/theme.js"></script>
    <script>
        function openModal($modalId) {
            document.getElementById("myModal" + $modalId).style.display = "block";
        }

        function closeModal($modalId) {
            document.getElementById("myModal" + $modalId).style.display = "none";
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = "none";
            }
        }
    </script>
</body>

</html>