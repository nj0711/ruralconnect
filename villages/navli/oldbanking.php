<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Banking || Village On Web</title>
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
    $table = 'banks';
    $values = 'SELECT * FROM  banks WHERE type="bank"';

    $result = $obj->selectdata($table, $values);

    //connection end

    ?>
    <div class="page-wrapper">
        <section class="page-banner">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Banking</h3>
                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section>
        <!--page-banner-->

        <section class="department-one-section">
            <h1 style="text-align: center;">Banks</h1>
            <?php
            $values = 'SELECT * FROM banks ';


            $result = $obj->selectdata($table, $values);
            ?>
            <div class="container">
                <!-- <center>
					<h2 style="margin-bottom: 50px;">Schools</h2>
				</center> -->
                <div class="row row-gutter-30">
                    <?php
                    if (empty($result)) {
                        echo "<h2 style='margin-bottom: 50px;'>Schools</h2>";
                    } else {
                        foreach ($result as $row => $bank) {
                            if ($bank['visibility'] == 'on') {
                                $modalId = "myModal" . $row;
                    ?>
                                <!-- card -->
                                <div class=" col-lg-6 col-xl-4 ">
                                    <div class="department-two-card">
                                        <div class="department-two-imgbox">
                                            <div class="department-two-img">
                                                <img src="<?php
                                                            $photos = json_decode($bank['photo'], true);

                                                            echo './admin/pages/uploadedimages/' . $photos[0];
                                                            ?>" class="img-fluid" alt="img-150">
                                            </div><!-- department-two-img -->
                                        </div><!-- department-two-imgbox -->
                                        <div class="department-two-content">
                                            <h4><a>
                                                    <?php
                                                    echo $bank['bankname'];
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
                        foreach ($result as $row => $bank) {
                            if ($bank['visibility'] == 'on') {

                                $modalId = "myModal" . $row; ?>
                                <!-- modal to display -->
                                <div id="myModal<?php echo $modalId; ?>" class="modal">
                                    <div class="modal-content">
                                        <b><span class="close" onclick="closeModal('<?php echo $modalId; ?>')">&times;</span>
                                            <div class="modal-body">
                                                <div class="text-content">
                                                    <h1>
                                                        <?php
                                                        echo $bank['bankname'];
                                                        ?>
                                                    </h1>
                                                    <br>
                                                    <p><i class="fa-solid fa-location-dot">&nbsp;</i>
                                                        <?php
                                                        $addressCityPincode = $bank['address'];
                                                        $modifiedAddress = str_replace('@', ', ', $addressCityPincode);
                                                        echo $modifiedAddress;
                                                        ?>
                                                    </p>
                                                    <p> <strong>Contact Information</strong>:<br> Email Id:
                                                        <?php echo !empty($bank['email']) ? $bank['email'] : 'None provided'; ?><br>
                                                        Phone No:
                                                        <?php echo !empty($bank['phoneno']) ? $bank['phoneno'] : 'None provided'; ?><br>
                                                        Branch Code:
                                                        <?php echo !empty($bank['branchcode']) ? $bank['branchcode'] : 'None provided'; ?>
                                                    </p>
                                                    <p><strong>Service Information</strong>:<br> Operational Status:
                                                        <?php echo !empty($bank['operationalstatus']) ? $bank['operationalstatus'] : 'None provided'; ?>
                                                        <br> Other Service Information:
                                                        <?php echo !empty($bank['otherserviceinformation']) ? $bank['otherserviceinformation'] : 'None provided'; ?>
                                                        <br> Service Type:
                                                        <?php echo !empty($bank['servicetype']) ? $bank['servicetype'] : 'None provided'; ?>
                                                        <br> Service Description:
                                                        <?php echo !empty($bank['servicedescription']) ? $bank['servicedescription'] : 'None provided'; ?>
                                                    </p>
                                                    <p><strong>Hours</strong>: (Hours might differ)<br>
                                                        <?php $timings = json_decode($bank['timeschedule'], true); ?>
                                                        Opening Time: <?php echo $timings['open'] ?? 'None provided'; ?><br>
                                                        Closing Time: <?php echo $timings['close'] ?? 'None provided'; ?>
                                                    </p>
                                                </div>

                                            </div>
                                    </div>
                                </div>

                    <?php  }
                        }
                    } else {
                        echo '<h1>No Data Found!</h1>';
                    } ?>

                </div><!-- row -->
            </div><!-- container -->
        </section><!-- department-one-section -->

        <h1 style="text-align: center;">ATM</h1>
        <section class="department-one-section">

            <?php
            $values = 'SELECT * FROM banks';

            $result = $obj->selectdata($table, $values);
            ?>
            <div class="container">
                <!-- <center>
					<h2 style="margin-bottom: 50px;">Schools</h2>
				</center> -->
                <div class="row row-gutter-30">
                    <?php
                    if (empty($result)) {
                        echo "<h2 style='margin-bottom: 50px;'>No Data Found</h2>";
                    } else {
                        foreach ($result as $row => $bank) {
                            $modalId = "my2Modal" . $row;
                    ?>
                            <!-- card -->
                            <div class=" col-lg-6 col-xl-4 ">
                                <div class="department-two-card">
                                    <div class="department-two-imgbox">
                                        <div class="department-two-img">
                                            <img src="<?php
                                                        $photos = json_decode($bank['photo'], true);

                                                        echo './admin/pages/uploadedimages/' . $photos[0];
                                                        ?>" class="img-fluid" alt="img-150">
                                        </div><!-- department-two-img -->
                                    </div><!-- department-two-imgbox -->
                                    <div class="department-two-content">
                                        <h4><a>
                                                <?php
                                                echo $bank['bankname'];
                                                ?>
                                            </a></h4>
                                        <br>
                                        <div class="department-two-button">
                                            <a href="javascript:void(0);" onclick="open2Modal('<?php echo $modalId; ?>')">
                                                <i class="fa-solid fa-arrow-right-long"></i>
                                                <span>Read More</span></a>
                                        </div><!-- department-two-button -->
                                    </div><!-- department-two-content -->
                                </div>
                                <!--department-two-card-->
                            </div>

                    <?php }
                    } ?>

                    <?php
                    if ($result != "No Data Found!") {
                        foreach ($result as $row => $bank) {
                            $modalId = "my2Modal" . $row; ?>
                            <!-- modal to display -->
                            <div id="my2Modal<?php echo $modalId; ?>" class="modal">
                                <div class="modal-content">
                                    <b><span class="close" onclick="close2Modal('<?php echo $modalId; ?>')">&times;</span>
                                        <div class="modal-body">
                                            <div class="text-content">
                                                <h1>
                                                    <?php
                                                    echo $bank['bankname'];
                                                    ?>
                                                </h1>
                                                <br>
                                                <p><i class="fa-solid fa-location-dot">&nbsp;</i>
                                                    <?php
                                                    $addressCityPincode = $bank['address'];
                                                    $modifiedAddress = str_replace('@', ', ', $addressCityPincode);
                                                    echo $modifiedAddress;
                                                    ?>
                                                </p>
                                                <p> <strong>Contact Information</strong>:<br> Email Id:
                                                    <?php echo !empty($bank['email']) ? $bank['email'] : 'None provided'; ?><br>
                                                    Phone No:
                                                    <?php echo !empty($bank['phoneno']) ? $bank['phoneno'] : 'None provided'; ?><br>
                                                    Branch Code:
                                                    <?php echo !empty($bank['branchcode']) ? $bank['branchcode'] : 'None provided'; ?>
                                                </p>
                                                <p><strong>Service Information</strong>:<br> Operational Status:
                                                    <?php echo !empty($bank['operationalstatus']) ? $bank['operationalstatus'] : 'None provided'; ?>
                                                    <br> Other Service Information:
                                                    <?php echo !empty($bank['otherserviceinformation']) ? $bank['otherserviceinformation'] : 'None provided'; ?>
                                                    <br> Service Type:
                                                    <?php echo !empty($bank['servicetype']) ? $bank['servicetype'] : 'None provided'; ?>
                                                    <br> Service Description:
                                                    <?php echo !empty($bank['servicedescription']) ? $bank['servicedescription'] : 'None provided'; ?>
                                                </p>
                                                <p><strong>Hours</strong>: (Hours might differ)<br>
                                                    <?php $timings = json_decode($bank['timeschedule'], true); ?>
                                                    Opening Time: <?php echo $timings['open'] ?? 'None provided'; ?><br>
                                                    Closing Time: <?php echo $timings['close'] ?? 'None provided'; ?>
                                                </p>
                                            </div>

                                        </div>
                                </div>
                            </div>

                    <?php }
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

        function open2Modal($modalId) {

            document.getElementById("my2Modal" + $modalId).style.display = "block";
        }

        function close2Modal($modalId) {

            document.getElementById("my2Modal" + $modalId).style.display = "none";
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