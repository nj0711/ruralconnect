<?php
include_once('admin/config.php');
$obj=new ConnDb();
$temp_db = explode('_',$db);
$selQ = "select villageid from villagebasic";
$res = $obj->selectdata("villagebasic", $selQ);
$village_id = $res[0]['villageid'];
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone_no=$_POST['phone'];
	$sub=$_POST['subject'];
	$msg=$_POST['message'];

	$q="INSERT INTO contacts (vid,name,email,phoneno,subject,msg) values ($village_id,'$name','$email','$phone_no','$sub','$msg')";

	$result = $obj->insertdata("contacts",$q);
if($result=='Data Inserted.'){?>
		<script> alert("Thank you for reaching out! Your message has been successfully sent."); </script>
	<?php }else{ ?>
		<script> alert("Your message was not sent successfully. Please try again!!"); </script>
	<?php }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact || Village On Web</title>
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
        <section class="page-banner" style="background-image: url(./assets/image/rjk/image1.jpg);">
            <div class="container">

                <div class="page-banner-title">
                    <h3>Contact</h3>
                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section>
        <!--page-banner-->
        <section class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="contact-box">
                            <div class="section-tagline">
                                WRITE A MESSAGE
                            </div><!-- section-tagline -->
                            <h1 class="section-title">Always Here to Help you</h1>
                            <p>Communication is key. Reach out to us with your inquiries, feedback, or simply to say
                                hello. We're here to listen and assist.</p>
                        </div><!-- contact-box -->
                    </div><!-- col-lg-4 -->
                    <div class="col-lg-8">
                        <form action="#" class="contact-form  contact-form-validated" method="post">
                            <div class="row row-gutter-10">
                                <div class="col-12 col-lg-6">
                                    <input type="text" id="name" class="input-text" placeholder="Your name" name="name"
                                        aria-required="true">
                                </div><!-- col-12 col-lg-6 -->
                                <div class="col-12 col-lg-6">
                                    <input type="email" id="email" class="input-text" placeholder="Email address"
                                        name="email" aria-required="true">
                                </div><!-- col-12 col-lg-6 -->
                                <div class="col-12 col-lg-6">
                                    <input type="text" id="phone" class="input-text" placeholder="Phone number"
                                        name="phone" aria-required="true">
                                </div><!-- col-12 col-lg-6 -->
                                <div class="col-12 col-lg-6">
                                    <input type="text" id="subject" class="input-text" placeholder="Subject"
                                        name="subject" aria-required="true">
                                </div><!-- col-12 col-lg-6 -->
                                <div class="col-12 col-lg-12">
                                    <textarea name="message" placeholder="Write a message" class="input-text"
                                        aria-required="true"></textarea>
                                </div><!-- col-12 col-lg-12 -->
                                <div class="col-12 col-lg-12">

                                    <input type="submit" class="btn btn-primary" value="Send a Message" name="submit" />
                                </div><!-- col-12 col-lg-12 -->
                            </div><!-- row -->
                        </form><!-- contact-form -->
                    </div><!-- col-lg-8 -->
                </div><!-- row -->
            </div><!-- container -->
        </section><!-- contact-section -->

        <div class="cta-four-section">
            <div class="container">
                <div class="cta-four-inner">
                    <div class="row row-gutter-y-20 ">
                        <div class="col-12 col-lg-6 col-xl-3">
                            <div class="cta-four-content">
                                <i class="flaticon-envelope-3"></i>
                                <div class="cta-four-content-box">
                                    <span>Write Email</span>
                                    <p>help@villageonweb.com</p>
                                </div><!-- cta-four-content-box -->
                            </div><!-- cta-four-content -->
                        </div><!-- col-12 col-lg-6 col-xl-3 -->
                        <div class="col-12 col-md-6 col-lg-6 col-xl-3">

                        </div><!-- col-12 col-md-6 col-lg-6 col-xl-3 -->
                        <div class="col-12 col-lg-6 col-xl-4">
                            <div class="cta-four-content">
                                <i class="flaticon-location-pin"></i>
                                <div class="cta-four-content-box">
                                    <span>Visit Office</span>
                                    <p><?php echo ucwords($temp_db[1]); ?>. Anand</p>
                                </div><!-- cta-four-content-box -->
                            </div><!-- cta-four-content -->
                        </div><!-- col-12 col-lg-6 col-xl-4 -->
                        <div class="col-12 col-lg-6 col-xl-2">
                            <div class="cta-four-content">
                                <div class="cta-four-widget-socials">

                                </div><!-- cta-four-widget-socials -->
                            </div><!-- cta-four-content -->
                        </div><!-- col-12 col-lg-6 col-xl-2 -->
                    </div><!-- row -->
                </div><!-- cta-four-inner -->
            </div><!-- container -->
        </div><!-- cta-four-section -->
    </div>
    <!--page-wrapper-->

    <!-- Footer Starts Here   --> <?php include"footer.php"; ?>
    <!-- Footer Ends Here -->


    
    <a href="#" class="scroll-to-top scroll-to-target" data-target="html"><i class="fa-solid fa-arrow-up"></i></a>
    <script src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/vendor/youtube-popup/youtube-popup.jquery.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>