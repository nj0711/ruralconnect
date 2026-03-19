<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Other Services || RuralConnect Web</title>
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
	
	?>
    <div class="page-wrapper">
        <section class="page-banner" style="background-image: url('./assets/image/rjk/image1.jpg');">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Other Services</h3>
                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section>
        <!--page-banner-->
        <section class="department-one-section">
            <div class="container">
                <div class="row row-gutter-30">


                    <div class="about-one-inner">
                        <div class="team-details-title-one">
                            <h2>Drainage System Information</h2>

                            <?php
                                $obj = new ConnDb(); // Replace with your actual database name
                                $query = "SELECT * FROM drainage"; // Adjust table name and columns as needed
                                // Fetch data
                                $drainageData = $obj->selectdata("drainage", $query);

                                if ($drainageData != 'No Data Found!') {
                                    // Loop through and display each name
                                    foreach ($drainageData as $index => $drainage) {
                                        if($drainage['visibility']=='on'){
                            ?>
                            <p>
                                The drainage system is a <strong><?php echo $drainage['type']; ?></strong> currently in
                                <strong><?php echo $drainage['systemcondition']; ?> condition.</strong> It has a
                                capacity of <strong><?php echo $drainage['capacity']; ?> cubic meters</strong> and
                                covers an area of <strong><?php echo $drainage['coveragearea']; ?> square
                                    meters.</strong> Other information related to the drainage system is provided as -
                            </p>
                            <p>
                            <table>
                                <tr>
                                    <th style="padding-bottom: 10px; color:black">Maintenance Details</th>
                                </tr>
                                <tr>
                                    <td>Established Date:</td>
                                    <td><?php echo !empty($drainage['establisheddate']) ? $drainage['establisheddate'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Last Maintanance Date:</td>
                                    <td><?php echo !empty($drainage['lastmaintenancedate']) ? $drainage['lastmaintenancedate'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Issue Repoeted:</td>
                                    <td><?php echo !empty($drainage['issuesreported']) ? $drainage['issuesreported'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Maintanance History:</td>
                                    <td><?php echo !empty($drainage['maintenancehistory']) ? $drainage['maintenancehistory'] : 'None provided'; ?>
                                    </td>
                                </tr>
                            </table>
                            </p>
                            <p>
                            <table>
                                <tr>
                                    <th style="padding-bottom: 10px; color:black">Contact Details:</th>
                                </tr>
                                <tr>
                                    <td>Management Entity Name:</td>
                                    <td><?php echo !empty($drainage['entityname']) ? $drainage['entityname'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Management Entity Type:</td>
                                    <td><?php echo !empty($drainage['entitytype']) ? $drainage['entitytype'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Primary Contact Person:</td>
                                    <td><?php echo !empty($drainage['primarycontactperson']) ? $drainage['establisheddate'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contact No:</td>
                                    <td><?php echo !empty($drainage['phoneno']) ? $drainage['phoneno'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contact Address:</td>
                                    <td><?php echo !empty($drainage['address']) ? $drainage['address'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Funding Source:</td>
                                    <td><?php echo !empty($drainage['fundingsource']) ? $drainage['fundingsource'] : 'None provided'; ?>
                                    </td>
                                </tr>
                            </table>
                            </p>
                            <?php } }?>


                            <?php
    
} else {
    echo 'None Information is provided regarding to the Drainage system';
}
?>




                        </div>
                    </div>

                    <div class="about-one-inner">

                        <div class="team-details-title-one">
                            <h2>Water Supply Information</h2>
                            <?php
                                $query1 = "SELECT * FROM watersupply"; // Adjust table name and columns as needed
                                // Fetch data
                                $wsData = $obj->selectdata("watersupply", $query1);
                                if ($wsData != 'No Data Found!') {
                                    // Loop through and display each name
                                    foreach ($wsData as $index => $ws) {
                                        if($ws['visibility']=='on'){
                                        $timeArray = json_decode($ws['watersupplyschedule'], true);
                                        if (is_array($timeArray)) {
                                            $MorningStart = $timeArray['MorningStart']??'None provided';
                                            $MorningEnd = $timeArray['MorningEnd']??'None provided';
                                            $AfternoonStart = $timeArray['AfternoonStart']??'None provided';
                                            $AfternoonEnd = $timeArray['AfternoonEnd']??'None provided';
                                            $EveningStart = $timeArray['EveningStart']??'None provided';
                                            $EveningEnd = $timeArray['EveningEnd']??'None provided';
                                        } else {
                                            $MorningStart = $MorningEnd = $AfternoonStart = $AfternoonEnd = $EveningStart = $EveningEnd = 'None provided';
                                        }
                                ?>
                            <p>
                                The water supply system is described as
                                <strong><?php echo $ws['systemdescription']; ?></strong> with a capacity of
                                <strong><?php echo $ws['capacity']; ?></strong> liters and is currently in
                                <strong><?php echo $ws['systemcondition']; ?></strong> condition. Other information
                                related to the watersupply system is provided as -
                            </p>
                            <p>
                            <table>
                                <tr>
                                    <th style="padding-bottom: 10px; color:black">Other Details</th>
                                </tr>
                                <tr>
                                    <td>Source Type:</td>
                                    <td><?php echo !empty($ws['sourcetype']) ? $ws['sourcetype'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Source Description:</td>
                                    <td><?php echo !empty($ws['sourcedescription']) ? $ws['sourcedescription'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Installation Date:</td>
                                    <td><?php echo !empty($ws['installationdate']) ? $ws['installationdate'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Last Maintanance Date:</td>
                                    <td><?php echo !empty($ws['lastmaintenancedate']) ? $ws['lastmaintenancedate'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Morning time:</td>
                                    <td><?php echo $MorningStart; ?> To <?php echo $MorningEnd; ?></td>
                                </tr>
                                <tr>
                                    <td>Afternoon time:</td>
                                    <td><?php echo $AfternoonStart; ?> To <?php echo $AfternoonEnd; ?></td>
                                </tr>
                                <tr>
                                    <td>Evening time:</td>
                                    <td><?php echo $EveningStart; ?> To <?php echo $EveningEnd; ?></td>
                                </tr>
                            </table>
                            </p>
                            <p>
                            <table>
                                <tr>
                                    <th style="padding-bottom: 10px; color:black">Contact Details:</th>
                                </tr>
                                <tr>
                                    <td>Management Entity Name:</td>
                                    <td><?php echo !empty($ws['entityname']) ? $ws['entityname'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Management Entity Type:</td>
                                    <td><?php echo !empty($ws['entitytype']) ? $ws['entitytype'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Primary Contact Person:</td>
                                    <td><?php echo !empty($ws['contactperson']) ? $ws['contactperson'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contact No:</td>
                                    <td><?php echo !empty($ws['contactphone']) ? $ws['contactphone'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contact Address:</td>
                                    <td><?php echo !empty($ws['address']) ? $ws['address'] : 'None provided'; ?></td>
                                </tr>
                                <tr>
                                    <td>Funding Source:</td>
                                    <td><?php echo !empty($ws['fundingsource']) ? $ws['fundingsource'] : 'None provided'; ?>
                                    </td>
                                </tr>
                            </table>
                            </p>



                            <?php
                                        }
                                    }
                                } else {
                                    echo "None Information is provided regarding to the watersupply system";
                                }
                            ?>
                        </div>
                    </div>

                    <div class="about-one-inner">

                        <div class="team-details-title-one">
                            <h2>General Washrooms Information</h2>

                            <?php
$query2 = "SELECT * FROM washrooms"; // Adjust table name and columns as needed
// Fetch data
$wrData = $obj->selectdata("washrooms", $query2);
if ($wsData != 'No Data Found!') {
echo '<p>The availability of general washrooms -</p>';
// Loop through and display each name
foreach ($wrData as $index => $wr) {
    if($wr['visibility']=='on'){
?>
                            <p>
                            <table>
                                <tr>
                                    <th style="padding-bottom: 10px; color:black">Other Details</th>
                                </tr>
                                <tr>
                                    <td>No of washrooms:</td>
                                    <td><?php echo !empty($ws['numberofwashrooms']) ? $ws['numberofwashrooms'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Location Description:</td>
                                    <td><?php echo !empty($ws['locationdescription']) ? $ws['locationdescription'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Facility Type:</td>
                                    <td><?php echo !empty($ws['facilitytype']) ? $ws['facilitytype'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Washroom Condition:</td>
                                    <td><?php echo !empty($ws['washroomcondition']) ? $ws['washroomcondition'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Maintanance Schedule:</td>
                                    <td><?php echo !empty($ws['maintenanceschedule']) ? $ws['maintenanceschedule'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Installation Date:</td>
                                    <td><?php echo !empty($ws['establisheddate']) ? $ws['establisheddate'] : 'None provided'; ?>
                                    </td>
                                </tr>
                            </table>
                            </p>
                            <p>
                            <table>
                                <tr>
                                    <th style="padding-bottom: 10px; color:black">Contact Details:</th>
                                </tr>
                                <tr>
                                    <td>Management Entity Name:</td>
                                    <td><?php echo !empty($ws['entityname']) ? $ws['entityname'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Management Entity Type:</td>
                                    <td><?php echo !empty($ws['entitytype']) ? $ws['entitytype'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Primary Contact Person:</td>
                                    <td><?php echo !empty($ws['primarycontactperson	']) ? $ws['primarycontactperson	'] : 'None provided'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contact No:</td>
                                    <td><?php echo !empty($ws['phoneno']) ? $ws['phoneno'] : 'None provided'; ?></td>
                                </tr>
                                <tr>
                                    <td>Contact Address:</td>
                                    <td><?php echo !empty($ws['address']) ? $ws['address'] : 'None provided'; ?></td>
                                </tr>
                                <tr>
                                    <td>Funding Source:</td>
                                    <td><?php echo !empty($ws['fundingsource']) ? $ws['fundingsource'] : 'None provided'; ?>
                                    </td>
                                </tr>
                            </table>
                            </p>

                        </div>

                        <?php
}
}
} else {
echo "None Information is provided regarding to the watersupply system";
}
?>


                    </div><!-- row -->

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