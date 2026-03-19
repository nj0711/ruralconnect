<?php include_once("admin/config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RuralConnect Web</title>
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
	<link rel="icon" type="image/png" sizes="32x32" href="assets/image/villagelogo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/image/villagelogo.png">
	<link rel="manifest" href="assets/image/favicons/site.webmanifest">

	<style>
		/* Scroll Menu Styles */
		div.scrollmenu {
			background-color: #e8e8e8;
			overflow: auto;
			white-space: nowrap;
			padding: 10px 0;
		}

		div.scrollmenu a {
			display: inline-block;
			color: #01313c;
			text-align: center;
			padding: 14px 20px;
			text-decoration: none;
		}

		div.scrollmenu a:hover {
			background-color: #777;
		}

		/* Button Style */
		.btnn {
			display: inline-block;
			padding: 5px 10px;
			height: 20px;
			line-height: 20px;
			width: 20px;
			text-align: center;
			text-decoration: none;
			border-radius: 5px;
			font-size: 14px;
			font-weight: bold;
			color: #fff;
			background-color: #007bff;
			text-transform: uppercase;
		}

		.btnn:hover {
			background-color: #0062cc;
		}

		/* Main Slider */
		.main-slider-swiper .item {
			position: relative;
			width: 100%;
		}

		.item-slider-bg {
			width: 100%;
			height: auto;
			background-size: cover;
			background-position: center;
		}

		/* About Section */
		.about-image img {
			max-width: 100%;
			height: auto;
		}

		.about-inner {
			margin-top: 20px;
		}

		.section-title-box {
			margin-bottom: 30px;
		}

		/* Portfolio Section */
		.portfolio-content {
			margin-top: 20px;
		}

		.portfolio-card {
			margin-bottom: 30px;
		}

		/* Footer */
		.search-popup {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: rgba(0, 0, 0, 0.5);
			display: none;
			justify-content: center;
			align-items: center;
		}

		.search-popup-content {
			background: white;
			padding: 20px;
			border-radius: 5px;
			width: 80%;
			max-width: 500px;
		}

		/* Scroll to Top Button */
		.scroll-to-top {
			position: fixed;
			bottom: 10px;
			right: 10px;
			background-color: #007bff;
			padding: 10px;
			border-radius: 50%;
			color: white;
			cursor: pointer;
		}

		/* Media Queries */
		@media (max-width: 767px) {

			/* Adjustments for mobile screens */
			.scrollmenu {
				padding: 5px 0;
			}

			.scrollmenu a {
				padding: 10px 15px;
			}

			.portfolio-card {
				margin-bottom: 20px;
			}

			.main-slider-swiper .item {
				height: 300px;
			}
		}

		@media (max-width: 991px) {

			/* Tablet screens */
			.main-slider-swiper .item {
				height: 400px;
			}
		}
	</style>
</head>

<body>

	<!--header--> <?php include "header.php"; ?> <!-- Header Ends Here -->

	<section>
		<center>
			<div class="scrollmenu">
				<a href="view-villages.php?letter=a">A</a>
				<a href="view-villages.php?letter=b">B</a>
				<a href="view-villages.php?letter=c">C</a>
				<a href="view-villages.php?letter=d">D</a>
				<a href="view-villages.php?letter=e">E</a>
				<a href="view-villages.php?letter=f">F</a>
				<a href="view-villages.php?letter=g">G</a>
				<a href="view-villages.php?letter=h">H</a>
				<a href="view-villages.php?letter=i">I</a>
				<a href="view-villages.php?letter=j">J</a>
				<a href="view-villages.php?letter=k">K</a>
				<a href="view-villages.php?letter=l">L</a>
				<a href="view-villages.php?letter=m">M</a>
				<a href="view-villages.php?letter=n">N</a>
				<a href="view-villages.php?letter=o">O</a>
				<a href="view-villages.php?letter=p">P</a>
				<a href="view-villages.php?letter=q">Q</a>
				<a href="view-villages.php?letter=r">R</a>
				<a href="view-villages.php?letter=s">S</a>
				<a href="view-villages.php?letter=t">T</a>
				<a href="view-villages.php?letter=u">U</a>
				<a href="view-villages.php?letter=v">V</a>
				<a href="view-villages.php?letter=w">W</a>
				<a href="view-villages.php?letter=x">X</a>
				<a href="view-villages.php?letter=y">Y</a>
				<a href="view-villages.php?letter=z">Z</a>
			</div>
		</center>
	</section>

	<!--<div class="page-wrapper">
	<section class="main-slider">
		<div class="main-slider-swiper owl-carousel owl-theme">
			<div class="item">
				<div class="item-slider-bg" style="background-image: url(assets/image/bg/karamsad-bg.jpg);"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="slider-content">
								<h1 class="section-title">Karamsad</h1>
								<a href="villages/karamsad/index.php" class="btn btn-primary">Discover More</a>
							</div>--><!-- slider-content -->
	<!--	</div>--><!-- col-md-12 -->
	<!--	</div>--><!-- row -->
	<!--	</div>--><!-- container -->
	<!--	</div>--><!--item-->
	<!--	<div class="item">
				<div class="item-slider-bg" style="background-image: url(assets/image/bg/tarapur.jpg);"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="slider-content">
								<h1 class="section-title">Tarapur</h1>
								<a href="villages/tarapur/index.php" class="btn btn-primary">Discover More</a>
							</div>--><!-- slider-content -->
	<!--	</div>--><!-- col-md-12 -->
	<!--	</div>--><!-- row -->
	<!--	</div>--><!-- container -->
	<!--	</div>--><!--item-->
	<!--</div>--><!-- main-slider-swiper -->
	<!--</section>--><!--main-slider-->


	<div class="page-wrapper">
		<section class="main-slider">
			<div class="main-slider-swiper owl-carousel owl-theme">

				<?php
				// Fetch the last 2 villages 
				$query = "Select village_name from villages order by rand() limit 4";
				$result = mysqli_query($conn, $query);

				// Define the two default background images
				$defaultBackgrounds = [
					"assets/image/village_image/vlg_4.jpg",
					"assets/image/village_image/vlgg.jpg"
				];

				if ($result && mysqli_num_rows($result) > 0) {
					$i = 0;
					while ($row = mysqli_fetch_assoc($result)) {
						// Convert to sentence case
						$villageName = ucfirst(strtolower($row['village_name']));
						$folderName  = strtolower($row['village_name']);

						// Check if the village has its own image uploaded
						// (Make sure your villages table has a column named 'village_img')
						$imagePath = !empty($row['village_img']) ? $row['village_img'] : '';

						// Decide which background to use
						if (!empty($imagePath) && file_exists($imagePath)) {
							$bgImage = $imagePath;
						} else {
							$bgImage = $defaultBackgrounds[$i % 2]; // Use default one
						}

						$i++;
				?>

						<div class="item">
							<div class="item-slider-bg" style="background-image: url('<?php echo htmlspecialchars($bgImage); ?>');"></div>
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<div class="slider-content text-center">
											<h1 class="section-title"><?php echo htmlspecialchars($villageName); ?></h1>
											<a href="villages/<?php echo htmlspecialchars($folderName); ?>/index.php"
												class="btn btn-primary">Discover More</a>
										</div>
									</div>
								</div>
							</div>
						</div>

				<?php
					}
				} else {
					echo "<p class='text-center'>No villages found.</p>";
				}
				?>

			</div> <!-- main-slider-swiper -->
		</section>
	</div>




	<section class="about-section">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="about-image">
						<div class="about-image-inner ">
							<img src="assets/image/gallery/sardar.jpeg" class="img-fluid" alt="img-2" style="padding-top:10px;">
						</div><!--about-image-inner img-one-->
						<div class="about-image-inner img-two">
							<img src="assets/image/shapes/about-3.jpg" class="floated-image" alt="img-3">
							<img src="assets/image/gallery/sardar2.jpg" class="img-fluid" alt="img-4">
						</div><!--about-image-inner img-two-->
					</div><!--about-image-->
				</div><!--col-lg-6-->
				<div class="col-lg-6">
					<div class="about-inner">
						<div class="section-title-box">
							<div class="section-tagline">About</div><!-- section-tagline -->
							<h5 class="section-title">Welcome to Village</h5>
							<p>In the age of digitalization, the concept of showcasing village information online may seem unconventional, but it is increasingly becoming a trend with the rise of websites dedicated to displaying details about various villages. This innovative approach not only provides a platform for villages to promote themselves to a global audience but also serves as a valuable resource for individuals looking to explore and learn more about different communities. RuralConnect Web is at the forefront of this movement, offering a comprehensive database of village information accessible at your fingertips. Read on to discover how RuralConnect Web is revolutionizing the way we interact with and learn about villages online.</p>
						</div><!-- section-title-box -->
					</div><!-- about-inner -->
				</div><!--col-lg-6-->
			</div><!-- row -->
		</div><!-- container -->
	</section><!--about-section-->



	<!-- portfolio-content -->



	<section class="cta-five-section">
		<div class="container">
			<div class="cta-five-card">
				<div class="cta-five-card-icon">
					<i class="flaticon-file"></i>
				</div><!-- cta-five-card-icon -->
				<div class="cta-five-content">
					<h4>Download List Of Villages In Anand</h4>
					<p>There are many villages that can be found in Anand, but we may not be <br> able to list them all so you can check from this list.</p>
				</div><!-- cta-five-content -->
				<div class="cta-five-button">
					<a href="https://drive.google.com/uc?export=download&id=10QmdF6aO-x1cWkyjZlEOTtsZLpTeRCI9" class="btn btn-primary">Download Files</a>
				</div><!-- cta-five-button -->
				<div class="cta-five-img">
					<i class="flaticon-file"></i>
				</div><!-- cta-five-img -->
			</div><!--cta-five-card-->
		</div><!-- container -->
	</section><!--cta-five-section-->
	</div><!--page-wrapper-->

	<!-- Footer Starts Here   --> <?php include "footer.php"; ?> <!-- Footer Ends Here -->

	<!-- Mobile Nav in Footer.php page-->
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