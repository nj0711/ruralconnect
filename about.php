<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>About || Village On Web</title>
	<!-- google font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
	<link rel="apple-touch-icon" sizes="180x180" href="assets/image/villagelogo.png">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/image/villagelogo.png>
	<link rel="icon" type="image/png" sizes="16x16" href="assets/image/villagelogo.png">
	<link rel="manifest" href="assets/image/favicons/site.webmanifest">
</head>
<body>


<!--header--> <?php include"header.php"; ?> <!-- Header Ends Here --> 


<div class="page-wrapper">
	<section class="page-banner" style="background-image: url('./assets/image/rjk/image1.jpg');">
		<div class="container">
			
			<div class="page-banner-title">
				<h3>About</h3>
			</div><!-- page-banner-title -->
		</div><!-- container -->			
	</section><!--page-banner-->
	<section class="about-one-section">
		<div class="container">
			<div class="row row-gutter-y-40">
				<div class="col-lg-12 col-xl-6">
					<div class="about-one-inner">
						<div class="section-tagline">
							About Us
						</div><!-- section-tagline -->
						<h2 class="section-title">Welcome to Village On Web</h2>
							<p>Welcome to Anand, where the rhythm of life beats with the harmony of community, and the echoes of our heritage resound through the streets. Nestled amidst nature's embrace, our village is more than just a place; it's a tapestry of stories, woven by the hands of generations past and present.</p>
							<h5 class="about-one-inner-text">Join us as we celebrate our shared journey, rooted in tradition yet reaching for the horizon of possibility.</h5>
						<div class="row row-gutter-y-30">
							<div class="col-xl-6 col-lg-6 col-md-6">
								<div class="about-one-card">
									<div class="about-one-card-number">01</div>
									<div class="about-one-card-content"><h5>Going Above and Beyond</h5></div>
								</div><!-- about-one-card -->
							</div><!-- col-xl-6 col-lg-6 col-md-6 -->
							<div class="col-xl-6 col-lg-6 col-md-6">
								<div class="about-one-card">
									<div class="about-one-card-number">02</div>
									<div class="about-one-card-content"><h5>Committed to People First</h5></div>
								</div><!-- about-one-card -->
							</div><!-- col-xl-6 col-lg-6 col-md-6 -->
						</div><!-- row row-gutter-y-30 -->
					</div><!-- about-one-inner -->
				</div><!--col-lg-6-->
				<div class="col-lg-12 col-xl-6">
					<div class="about-one-image">
						<img src="assets/image/shapes/shape-1.png" class="floated-image-one" alt="img-58">
						<!-- <img src="assets/image/rjk/clay-1139098_1920 (1).jpg" alt="img-59" class="img-fluid"> -->
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d472095.2834835611!2d72.44727966427457!3d22.419825128802298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e4e85a867cd19%3A0x64a1210193f0e73b!2sAnand%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1731406436382!5m2!1sen!2sin" width="570" height="479" style="    height: 500px;border:0;width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="img-fluid"></iframe>
					</div><!--about-one-image-->
				</div><!--col-lg-6-->
			</div><!-- row -->
		</div><!-- container -->
	</section><!--about-one-section-->

</div><!--page-wrapper-->		

<!-- Footer Starts Here   --> <?php include"footer.php"; ?> <!-- Footer Ends Here -->



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