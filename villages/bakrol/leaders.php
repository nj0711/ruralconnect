<?php
include_once 'admin/config.php';
$obj = new ConnDb();

/* --------------------------------------------------------------
   SAFE DATA FETCH – ONE TRY/CATCH FOR THE WHOLE PAGE
   -------------------------------------------------------------- */
$pillarsAll          = [];   // all leaders (used in Section 2 & 3)
$pillarsThree        = [];   // first 3 non-sarpanch/mla (Section 1)
$sarpanchMla         = [];   // only sarpanch & mla (Section 3)

try {
    $tbl = 'pillarofcommunity';

    // 1. First 3 leaders (exclude sarpanch/mla) – Section 1
    $sql = "SELECT * FROM {$tbl}
            WHERE typeofleader NOT IN ('sarpanch','mla')
            AND   visibility = 'on'
            LIMIT 3";
    $pillarsThree = $obj->selectdata($tbl, $sql);
    if (!is_array($pillarsThree)) $pillarsThree = [];

    // 2. ALL leaders (exclude sarpanch/mla) – Section 2 carousel
    $sql = "SELECT * FROM {$tbl}
            WHERE typeofleader NOT IN ('sarpanch','mla')
            AND   visibility = 'on'";
    $pillarsAll = $obj->selectdata($tbl, $sql);
    if (!is_array($pillarsAll)) $pillarsAll = [];

    // 3. Only sarpanch & mla – Section 3 grid
    $sql = "SELECT * FROM {$tbl}
            WHERE typeofleader IN ('sarpanch','mla')
            AND   visibility = 'on'";
    $sarpanchMla = $obj->selectdata($tbl, $sql);
    if (!is_array($sarpanchMla)) $sarpanchMla = [];
} catch (Exception $e) {
    // Any DB problem → everything becomes an empty array
    $pillarsThree = $pillarsAll = $sarpanchMla = [];
}

/* --------------------------------------------------------------
   HELPER: get the first usable image from JSON array
   -------------------------------------------------------------- */
function firstImage(array $photos, string $fallback = 'assets/image/no-leader.jpg'): string
{
    $first = $photos[0] ?? '';
    return $first ? "admin/pages/uploadedimages/{$first}" : $fallback;
}
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
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- plugins css -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/reey-font/stylesheet.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="assets/vendor/flaticon/css/flaticon_towngov.css">
    <link rel="stylesheet" href="assets/vendor/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/vendor/youtube-popup/youtube-popup.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/image/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/image/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/image/favicons/site.webmanifest">
</head>

<body>

    <?php include "header.php"; ?>

    <div class="page-wrapper">

        <!-- ==================== PAGE BANNER ==================== -->
        <section class="page-banner" style="background-image:url('./assets/image/rjk/image1.jpg');">
            <div class="container"></div>
        </section>

        <!-- ==================== INTRO ==================== -->
        <section class="about-one-section">
            <div class="container">
                <div class="row row-gutter-y-40">
                    <div class="about-one-inner">
                        <?php $temp_db = explode('_', $db); ?>
                        <h2 class="section-title">Welcome to <?= ucwords($temp_db[1]); ?> Town Council</h2>
                        <p>Welcome to <?= ucwords($temp_db[1]); ?>, where the rhythm of life beats with the harmony of community …</p>
                        <h5 class="about-one-inner-text">Join us as we celebrate our shared journey …</h5>
                        <div class="row row-gutter-y-30">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="about-one-card">
                                    <div class="about-one-card-number">01</div>
                                    <div class="about-one-card-content">
                                        <h5>Going Above and Beyond</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="about-one-card">
                                    <div class="about-one-card-number">02</div>
                                    <div class="about-one-card-content">
                                        <h5>Committed to People First</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION 1 – FIRST 3 LEADERS ==================== -->
        <?php if (empty($pillarsThree)): ?>
            <section class="team-details-section" style="margin-top:-150px">
                <div class="container text-center py-5">
                    <h3>No leaders found for this section.</h3>
                </div>
            </section>
            <?php else: foreach ($pillarsThree as $i => $p):
                $photos = json_decode($p['photo'] ?? '[]', true) ?: [];
                $img    = firstImage($photos);
            ?>
                <section class="team-details-section" style="margin-top:-150px">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-12 col-lg-6">
                                <div class="team-details-image">
                                    <img src="<?= $img ?>" class="img-fluid" alt="<?= htmlspecialchars($p['name']); ?>"
                                        style="height:600px;width:100%;object-fit:cover;">
                                </div>
                            </div>
                            <div class="col-12 col-lg-5">
                                <div class="team-details-title-one">
                                    <h2><?= htmlspecialchars($p['name']); ?></h2>
                                    <span><?= htmlspecialchars($p['profession']); ?></span>
                                </div>

                                <div class="team-details-text">
                                    <p style="margin-top:-40px"><?= nl2br(htmlspecialchars($p['description'])); ?></p>
                                </div>

                                <div class="team-details-list">
                                    <h3>Education</h3>
                                    <div class="team-details-box">
                                        <p><?= htmlspecialchars($p['education']); ?></p>
                                    </div>

                                    <h3 style="margin-top:20px">Political Career</h3>
                                    <div class="team-details-box">
                                        <p><?= nl2br(htmlspecialchars($p['politicalcareer'])); ?></p>
                                        <p><?= nl2br(htmlspecialchars($p['positionsheld'])); ?></p>
                                    </div>

                                    <h3 style="margin-top:20px">Role in Independence Movement</h3>
                                    <div class="team-details-box">
                                        <p><?= nl2br(htmlspecialchars($p['roleinindependencemovement'])); ?></p>
                                    </div>

                                    <h3 style="margin-top:20px">Details</h3>
                                    <div class="team-details-box">
                                        <p><?= nl2br(htmlspecialchars($p['description'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <br><br>
        <?php endforeach;
        endif; ?>

        <!-- ==================== SECTION 2 – CAROUSEL (all non-sarpanch/mla) ==================== -->
        <?php if (empty($pillarsAll)): ?>
            <section class="client-section" style="margin-top:-50px">
                <div class="container text-center py-4">
                    <h5 class="client-text">Pillar of the Community</h5>
                    <p>No data available.</p>
                </div>
            </section>
        <?php else: ?>
            <section class="client-section" style="margin-top:-50px">
                <h5 class="client-text">Pillar of the Community</h5>
                <div class="container">
                    <div class="client-carousel owl-carousel owl-theme">
                        <?php foreach ($pillarsAll as $p):
                            $photos = json_decode($p['photo'] ?? '[]', true) ?: [];
                            $img    = firstImage($photos);
                        ?>
                            <div class="item">
                                <img src="<?= $img ?>" class="img-fluid" alt="<?= htmlspecialchars($p['name']); ?>">
                                <div class="about-one-card-content">
                                    <h5><?= htmlspecialchars($p['name']); ?></h5>
                                </div>
                                <div class="about-one-card-content">
                                    <h5 style="font-size:15px;color:green;"><?= htmlspecialchars($p['profession']); ?></h5>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- ==================== SECTION 3 – SARPANCH / MLA GRID ==================== -->
        <?php if (empty($sarpanchMla)): ?>
            <section class="team-section">
                <div class="container text-center py-5">
                    <h3>No Sarpanch / MLA data found.</h3>
                </div>
            </section>
        <?php else: ?>
            <section class="team-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="team-inner">
                                <div class="section-tagline">team members</div>
                                <h2 class="section-title">Meet our Professional Town Council</h2>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="team-box">
                                <p>Guiding our town's journey with wisdom and dedication …</p>
                            </div>
                        </div>
                    </div>

                    <div class="row row-gutter-y-30" style="justify-content:center;">
                        <?php foreach ($sarpanchMla as $p):
                            $photos = json_decode($p['photo'] ?? '[]', true) ?: [];
                            $img    = firstImage($photos);
                        ?>
                            <div class="col-12 col-md-6 col-xl-3">
                                <div class="team-card">
                                    <div class="team-card-img">
                                        <img src="<?= $img ?>" class="img-fluid" alt="<?= htmlspecialchars($p['name']); ?>">
                                    </div>
                                    <div class="team-card-content">
                                        <h4><?= htmlspecialchars($p['name']); ?></h4>
                                        <p><?= ucwords(htmlspecialchars($p['typeofleader'])); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    </div><!-- .page-wrapper -->

    <?php include "footer.php"; ?>

    <!-- search popup & scroll-to-top (unchanged) -->
    <div class="search-popup">…</div>
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