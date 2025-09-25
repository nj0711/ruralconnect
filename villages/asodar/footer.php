<?php 

$dbfooter = new ConnDb();

$temp_dbf = explode('_',$db);

?>
<section class="footer">
    <div class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-widget-logo">
                        <a href="index.html"><img src="assets/image/logo1.png" class="img-fluid" alt="img-25"></a>
                    </div><!-- footer-widget-logo -->
                    <div class="footer-widget-text">
                        <p>The <?php echo $temp_dbf[1]; ?> official guide to living, working, visiting and investing in
                            the
                            <?php echo $temp_dbf[1]; ?></p>
                    </div><!-- footer-widget-text -->

                </div>
                <!--col-lg-4-->
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <div class="footer-widget-explore">
                            <h4 class="footer-widget-title">Village At Glance</h4>
                            <ul class="list-unstyled">
                                <li><a href="banking.php">Banking</a></li>
                                <li><a href="education.php">Education</a></li>
                                <li><a href="electrification.php">Electrification</a></li>
                                <li><a href="emergencyservices.php">Emergency Services</a>
                                </li>
                                <li><a href="employmentcenters.php">Employment Centers</a>
                                </li>
                                <li><a href="entertainment.php">Entertainment</a></li>
                                <li><a href="eventsfestivals.php">Events & Festivals</a></li>

                            </ul><!-- list-unstyled -->
                        </div><!-- footer-widget-explore -->
                    </div>
                    <!--footer-widget-->
                </div>
                <!--col-lg-3-->
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <div class="footer-widget-department">

                            <h4 class="footer-widget-title">   </h4>

                            <ul class="list-unstyled">

                                <li><a href="fuel.php">Fuel</a></li>
                                <li><a href="health.php">Health</a></li>
                                <li><a href="hotels.php">Hotels</a></li>
                                <li><a href="DrainageDetails.php">Others</a></li>
                                <li><a href="placestoworship.php">Places To Worship</a></li>
                                <li><a href="transport.php">Public Transport</a></li>
                                <li><a href="tourism.php">Tourism</a></li>
                            </ul><!-- list-unstyled -->
                        </div><!-- footer-widget-department -->
                    </div>
                    <!--footer-widget-->
                </div>
                <!--col-lg-2-->
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <div class="footer-widget-contact">
                            <h4 class="footer-widget-title">Contact</h4>
                            <p><?php echo $temp_dbf[1]; ?>, Anand, Gujarat</p>
                        </div><!-- footer-widget-contact -->
                        <div class="footer-widget-contact-list">
                            <i class="fa-solid fa-envelope"></i>
                            <div class="footer-widget-contact-item">
                                <a href="mailto:help@villageonweb.com">help@villageonweb.com</a>
                            </div><!-- footer-widget-contact-item -->
                        </div><!-- footer-widget-contact-list -->

                    </div>
                    <!--footer-widget-->
                </div>
                <!--col-lg-3-->
            </div><!-- row -->
        </div><!-- container -->
    </div>
    <!--footer-inner-->
    <div class="bottom-footer">
        <div class="conatiner">
            <p>© Copyright 2024 by villageonweb.com</p>
        </div><!-- container -->
    </div>
    <!--bottom-footer-->
</section>