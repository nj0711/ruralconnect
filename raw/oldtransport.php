<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Public Transport || Village On Web</title>
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
    <!-- Header Starts --> <?php include "header.php";  ?> <!-- Header ends -->
    <!-- connection -->
    <?php
    include_once('admin/config.php');
    $obj = new ConnDb();
    $table = 'transport';
    $values = 'SELECT * FROM  transport';

    $result = $obj->selectdata($table, $values);

    // if (!$result) {
    //     echo "No Data Found";
    // } else {
    //     print_r($result);
    // }

    ?> <!-- connection  -->

    <div class="page-wrapper">
        <section class="page-banner">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Public Transport</h3>
                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section><!--page-banner-->
        <section class="department-one-section">
            <div class="container">
                <div class="row row-gutter-30">
                    <?php
                    if ($result!='No Data Found!') {
                        foreach ($result as $row => $transport) {
                            if($transport['visibility']=='on'){
                            $modalId = "myModal" . $row; ?>

                            <!-- card -->
                            <div class=" col-lg-6 col-xl-4 ">
                                <div class="department-two-card">
                                    <div class="department-two-imgbox">
                                        <div class="department-two-img">
                                            <img src="<?php
                                                        $photos = json_decode($transport['photo'], true);
                                                        // print_r($photos);
                                                        echo './admin/pages/uploadedimages/' . $photos[0];
                                                        ?>"
                                                class="img-fluid" alt="img-150">
                                        </div><!-- department-two-img -->
                                    </div><!-- department-two-imgbox -->
                                    <div class="department-two-content">
                                        <h4><a>
                                                <?php
                                                echo $transport['stationname'];
                                                ?>
                                            </a></h4>
                                        <br>
                                        <div class="department-two-button">
                                            <a href="javascript:void(0);" onclick="openModal('<?php echo $modalId; ?>')">
                                                <i class="fa-solid fa-arrow-right-long"></i>
                                                <span>Read More</span></a>
                                        </div><!-- department-two-button -->
                                    </div><!-- department-two-content -->
                                </div><!--department-two-card-->
                            </div>


                    <?php } }
                    }
                    else{
                        echo '<h1> No Data Found! </h1>';
                    } ?>

                    <?php
                    if ($result!='No Data Found!') {
                        foreach ($result as $row => $transport) {
                            if($transport['visibility']=='on'){
                            $modalId = "myModal" . $row; ?>

                            <!-- modal to display -->
                            <div id="myModal<?php echo $modalId; ?>" class="modal">
                                <div class="modal-content">
                                    <b><span class="close" onclick="closeModal('<?php echo $modalId; ?>')">&times;</span>
                                        <div class="modal-body">
                                            <div class="text-content">
                                                <h1>
                                                    <?php
                                                    echo $transport['stationname'];
                                                    ?>
                                                </h1>
                                                <br>
                                                <p><i class="fa-solid fa-location-dot">&nbsp;</i>
                                                    <?php
                                                    $cleanedAddress = str_replace('@', ',', $transport['address']);
                                                    echo $cleanedAddress;
                                                    ?>
                                                </p>
                                                <p> <b>Contact no:</b>
                                                    <?php
                                                    echo $transport['contactno'];
                                                    ?>
                                                </p>
                                                <p> <b>Email ID:</b>
                                                    <?php
                                                    echo $transport['email'];
                                                    ?>
                                                </p>
                                                <p><b> Ticket Process:</b>
                                                    <?php
                                                    if ($transport['ticketingprocess'] == "both") {
                                                        echo "Both Online and Offline";
                                                    } else {
                                                        echo $transport['ticketingprocess'];
                                                    }
                                                    ?>
                                                </p>
                                                <p> <b>Station type :</b>
                                                    <?php
                                                    echo $transport['stationtype'];
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="text-content">
                                                <p> <b>Other Information:</b><br>

                                                    <?php
                                                    echo $transport['description'];
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                </div>
                            </div>
                    <?php }
                    } }
                   ?>

                </div><!-- row -->
            </div><!-- container -->
        </section><!-- department-one-section -->
    </div><!--page-wrapper-->

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
    <!-- js for modal -->
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