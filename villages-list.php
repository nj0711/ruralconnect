<?php include_once("admin/config.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Villages || Village On Web</title>
	<!-- google font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
</head>
<body>

<!--header--> <?php include"header.php"; ?> <!-- Header Ends Here -->

<div class="page-wrapper">
	<section class="page-banner" style="background-image: url(assets/image/bg/village.jpg); ">
		<div class="container">
			<div class="page-banner-title">
				<h3>Villages</h3>
			</div><!-- page-banner-title -->
		</div><!-- container -->			
	</section><!--page-banner-->
	<section class="event-three-section">
	    
		<div class="event-section-outer">
			<div class="container">
				<div class="row row-gutter-y-30">
				<?php 
					$table=mysqli_query($conn,"select * from villages");
	                
					while($row=mysqli_fetch_array($table)){
					    $villageName = $row['village_name']; // Sanitize output
					    $vName = ucfirst($villageName); 	
						echo"
				
						<div class='col-12 col-lg-6 col-xl-6'>
							<div class='event-card'>
								<div class='event-card-image'>
									<div class='event-card-image-inner'>
										<a href='villages/$row[village_name]/index.php'><img src='assets/image/event/km.jpeg' height='250px' width='250px' class='img-fluid' style='margin-top:30px;' alt='img-164'></a>		
										
									</div><!-- event-card-image-inner -->
								</div><!--event-card-image-->
								<div class='event-card-content'>
									<div class='event-card-info'>
										<ul class='list-unstyled'>
											<li>
												<i class='fa-sharp fa-solid fa-location-pin'></i>
												<span>$vName, Anand, Gujarat</span>
											</li><!-- li -->
										</ul><!-- list-unstyled -->
									</div><!--event-card-info-->
									<div class='event-card-title'>
										<h4><a href='villages/$row[village_name]/index.php'>$vName</a></h4>
									</div><!-- event-card-title -->
								</div><!--event-card-content-->
							</div><!--event-card-->
						</div><!--col-12 col-lg-6 col-xl-6-->
					"; } ?>

				</div><!-- row -->
			</div><!-- container -->
		</div><!-- event-section-outer -->
	</section><!--event-three-section-->
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
<script src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/owl-carousel/owl.carousel.min.js"></script>
<script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="assets/vendor/counter-up/jquery.counterup.min.js"></script>
<script src="assets/vendor/youtube-popup/youtube-popup.jquery.js"></script>
<script src="assets/js/theme.js"></script>
</body>
</html>