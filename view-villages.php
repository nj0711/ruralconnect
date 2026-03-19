<?php include_once("admin/config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Villages || RuralConnect Web</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=stylesheet">
    <!-- plugins css -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/flaticon/css/flaticon_towngov.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/vendor/youtube-popup/youtube-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/image/villagelogo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/image/villagelogo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/villagelogo.png">
    <link rel="manifest" href="assets/image/favicons/site.webmanifest">
    <style>
        /* Villages Grid Section */
        .villages-grid-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .section-header {
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 2px;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #7f8c8d;
            font-weight: 400;
            max-width: 500px;
            margin: 0 auto;
        }

        /* Village Card Styles */
        .village-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            height: 100%;
            border: none;
        }

        .village-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .village-card-image {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .village-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .village-card:hover .village-card-image img {
            transform: scale(1.1);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #28a745, rgba(128, 128, 128, 0.8));
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .village-card:hover .card-overlay {
            opacity: 1;
        }

        .card-hover-content {
            text-align: center;
            color: white;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .village-card:hover .card-hover-content {
            transform: translateY(0);
        }

        .card-hover-content i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .card-hover-content span {
            font-size: 1.1rem;
            font-weight: 500;
        }

        /* Card Content */
        .village-card-content {
            padding: 1.5rem;
        }

        .card-location {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .card-location i {
            color: #28a745;
            margin-right: 0.5rem;
            width: 16px;
        }

        .card-title {
            margin-bottom: 1.5rem;
        }

        .card-title a {
            color: #2c3e50;
            text-decoration: none;
            font-size: 1.3rem;
            font-weight: 600;
            line-height: 1.3;
            transition: color 0.3s ease;
        }

        .card-title a:hover {
            color: #28a745;
        }

        .card-footer {
            padding-top: 1rem;
            border-top: 1px solid #ecf0f1;
        }

        /* Explore Button */
        .btn-explore {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-explore:hover {
            background: linear-gradient(45deg, #20c997, #28a745);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
            color: white;
        }

        .btn-explore i {
            transition: transform 0.3s ease;
        }

        .btn-explore:hover i {
            transform: translateX(3px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .villages-grid-section {
                padding: 60px 0;
            }

            .village-card-image {
                height: 180px;
            }

            .village-card-content {
                padding: 1.25rem;
            }
        }

        @media (max-width: 576px) {
            .row-cols-lg-3 {
                row-gap: 1.5rem;
            }

            .villageល .village-card {
                margin-bottom: 1.5rem;
            }
        }

        /* Loading Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .village-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .village-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .village-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .village-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .village-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .village-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .village-card:nth-child(6) {
            animation-delay: 0.6s;
        }
    </style>
</head>

<body>
    <!--header--> <?php include "header.php"; ?> <!-- Header Ends Here -->

    <div class="page-wrapper">
        <section class="page-banner" style="background-image: url(assets/image/bg/vlg2.jpg);">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Villages</h3>
                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section><!--page-banner-->
        <section class="villages-grid-section">
            <div class="container">
                <div class="section-header text-center mb-5">
                    <h2 class="section-title">Villages starting with '<?php echo isset($_GET['letter']) ? strtoupper(htmlspecialchars($_GET['letter'])) : ''; ?>'</h2>
                    <p class="section-subtitle">Discover the charm of rural Gujarat</p>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php
                    // Start output buffering to prevent accidental output before headers
                    ob_start();

                    if (isset($_GET['letter']) && preg_match('/^[a-zA-Z]$/', $_GET['letter'])) {
                        $letter = strtoupper($_GET['letter']); // Convert to uppercase for consistency

                        // SQL query to select villages starting with the specified letter
                        $sql = "SELECT * FROM villages WHERE village_name LIKE '$letter%'";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $villageName = htmlspecialchars($row['village_name']); // Sanitize output
                                $vName = ucfirst($villageName);
                                $villageSlug = strtolower(str_replace(' ', '-', $villageName)); // Better URL slug
                                $villageImg = !empty($row['village_img']) ? htmlspecialchars($row['village_img']) : 'assets/image/bg/vlg1.jpg'; // Fallback image

                    ?>
                                <div class="col">
                                    <div class="village-card">
                                        <div class="village-card-image"><img src="<?php echo $villageImg; ?>" alt="<?php echo $vName; ?>" class="card-img-top">
                                            <div class="card-overlay">
                                                <div class="card-hover-content"><i class="fas fa-map-marker-alt"></i><span>Explore Village</span></div>
                                            </div>
                                        </div>
                                        <div class="village-card-content">
                                            <div class="card-location">
                                                <i class="fas fa-map-pin"></i>
                                                <span><?php echo $vName; ?>, Anand, Gujarat</span>
                                            </div>
                                            <h3 class="card-title">
                                                <a href="villages/<?php echo $villageSlug; ?>/index.php" class="card-link"><?php echo $vName; ?></a>
                                            </h3>
                                            <div class="card-footer">
                                                <a href="villages/<?php echo $villageSlug; ?>/index.php" class="btn-explore">
                                                    <span>Discover More</span>
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        } else {
                            echo "<div class='col-12 text-center'><p>No villages found starting with '$letter'.</p></div>";
                        }
                    } else {
                        // JavaScript redirection if the 'letter' parameter is missing or invalid
                        echo "<script type='text/javascript'>
                                window.location.href = 'villages-list.php';
                              </script>";
                        exit();
                    }

                    // End output buffering and flush output
                    ob_end_flush();
                    ?>
                </div><!-- row -->
            </div><!-- container -->
        </section><!--villages-grid-section-->
    </div><!--page-wrapper-->

    <!-- Footer Starts Here --> <?php include "footer.php"; ?> <!-- Footer Ends Here -->

    <div class="search-popup">
        <div class="search-popup-overlay search-toggler"></div><!-- search-popup-overlay -->
        <div class="search-popup-content">
            <form action="search_village.php" method="GET">
                <label for="search" class="sr-only">search here</label><!-- sr-only -->
                <input type="text" id="search" name="village_name" placeholder="Search Here..." required>
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
        // Add smooth animations and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all village cards
            document.querySelectorAll('.village-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
</body>

</html>