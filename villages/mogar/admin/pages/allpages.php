<?php


session_start();
if (!isset($_SESSION['village_admin_email'])) {
    header("Location: index.php");
    exit();
}

// Set the timeout duration (in seconds)
$timeout_duration = 600; // 10 minutes

// Check if last activity is set and calculate the inactivity period
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Last request was over 10 minutes ago, so destroy the session
    session_unset();     // Unset session variables
    session_destroy();   // Destroy the session
    header("Location: index.php"); // Redirect to login page
    exit();
}

// Update the last activity timestamp to the current time
$_SESSION['LAST_ACTIVITY'] = time();
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <!-- Meta -->
    <meta charset="utf-8">
    
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page Title -->
    <title> All Pages | Admin Panel</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="../images/villagelogo.png">

    <!-- All StyleSheet -->
    <link href="../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../vendor/owl-carousel/owl.carousel.css" rel="stylesheet">

    <!-- Globle CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/delete_btn.css" rel="stylesheet">

</head>

<body>



    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include('header.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">

                <!-- Here Edit Start -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Pages</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="post" action="#" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="cm-content-body form excerpt">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-bordered table-striped table-condensed flip-content">
                                                                <thead>
                                                                    <tr>
                                                                        <th>S.No</th>
                                                                        <th>Title</th>
                                                                       
                                                                        <!-- <th>Modified</th> -->
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>Bank</td>
                                                                      
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>


                                                                            <a href="banks.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=banks"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>2</td>
                                                                        <td>Drainage</td>
                                                                      
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="drainage.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=drainage"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>3</td>
                                                                        <td>Education</td>
                                                                       
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="education.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=education"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>4</td>
                                                                        <td>Electrification</td>
                                                                       
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                             <a href="electrification.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=electrification"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i> -->
                                                                            </a>
                                                                        </td>
                                                                    </tr>


                                                                    <td>5</td>
                                                                    <td>Entertainment</td>
                                                                   
                                                                    <!-- <td>18 Feb, 2024</td> -->
                                                                    <td>

                                                                        <a href="entertainment.php"
                                                                            class="btn btn-warning btn-sm content-icon">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>

                                                                        <a href="editform.php?tablename=entertainment"
                                                                            class="btn btn-warning btn-sm content-icon">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <!-- <a href="javascript:void(0);"
																		class="btn btn-danger btn-sm content-icon">
																		<i class="fa fa-times"></i> -->
                                                                        </a>
                                                                    </td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td>6</td>
                                                                    <td>Emergency Service</td>
                                                                   
                                                                    <!-- <td>18 Feb, 2024</td> -->
                                                                    <td>

                                                                        <a href="emergencyservices.php"
                                                                            class="btn btn-warning btn-sm content-icon">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>

                                                                        <a href="editform.php?tablename=emergencyservices"
                                                                            class="btn btn-warning btn-sm content-icon">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <!-- <a href="javascript:void(0);"
																		class="btn btn-danger btn-sm content-icon">
																		<i class="fa fa-times"></i> -->
                                                                        </a>
                                                                    </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>7</td>
                                                                        <td>Employment Centers</td>
                                                                        
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="employmentcenters.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=employmentcenters"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>8</td>
                                                                        <td>Event Festivals</td>
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="eventsfestivals.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=eventsfestivals"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>9</td>
                                                                        <td>Fuel station</td>
                                                                      
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="fuelstation.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=fuelstation"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>10</td>
                                                                        <td>Hospitals</td>
                                                                       
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="hospitals.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>

                                                                            <a href="editform.php?tablename=hospitals"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i> -->
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>11</td>
                                                                        <td>Hotels</td>
                                                                       
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="hotels.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=hotels"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>12</td>
                                                                        <td>Pillar of Community</td>
                                                                       
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="pillarofcommunity.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>

                                                                            <a href="editform.php?tablename=pillarofcommunity"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>13</td>
                                                                        <td>Place to Worship</td>
                                                                        
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="placestoworship.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=placestoworship"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>14</td>
                                                                        <td>Population</td>
                                                                     
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="editform.php?tablename=population"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=population"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>15</td>
                                                                        <td>Restaurants</td>
                                                                        
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="restaurants.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=restaurants"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>16</td>
                                                                        <td>Tourism Places</td>
                                                                       
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="tourismplaces.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=tourismplaces"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>17</td>
                                                                        <td>Transport</td>
                                                                        
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="transport.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>

                                                                            <a href="editform.php?tablename=transport"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>18</td>
                                                                        <td>Village basic</td>
                                                                       
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="editform.php?tablename=villagebasic"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>

                                                                            <a href="editform.php?tablename=villagebasic"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>19</td>
                                                                        <td>Washrooms</td>
                                                                       
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                            <a href="washrooms.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>
                                                                            <a href="editform.php?tablename=washrooms"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>20</td>
                                                                        <td>Water Supply</td>
                                                                       
                                                                        <!-- <td>18 Feb, 2024</td> -->
                                                                        <td>

                                                                           <a href="watersupply.php"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-plus"></i>
                                                                            </a>

                                                                            <a href="editform.php?tablename=watersupply"
                                                                                class="btn btn-warning btn-sm content-icon">
                                                                                <i class="fa fa-edit"></i>
                                                                            </a>
                                                                            <!-- <a href="javascript:void(0);"
																			class="btn btn-danger btn-sm content-icon">
																			<i class="fa fa-times"></i>
																		</a> -->
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                            <!-- <div
															class="d-flex align-items-center justify-content-xl-between flex-wrap justify-content-center">
															<span>Page 1 of 5, showing 2 records out of 8 total,
																starting on record 1, ending on 2</span>
															<nav aria-label="Page navigation example">
																<ul class="pagination mb-2 mb-sm-0">
																	<li class="page-item"><a class="page-link"
																			href="javascript:void(0);"><i
																				class="fa-solid fa-angle-left"></i></a>
																	</li>
																	<li class="page-item"><a class="page-link"
																			href="javascript:void(0);">1</a></li>
																	<li class="page-item"><a class="page-link"
																			href="javascript:void(0);">2</a></li>
																	<li class="page-item"><a class="page-link"
																			href="javascript:void(0);">3</a></li>
																	<li class="page-item"><a class="page-link "
																			href="javascript:void(0);"><i
																				class="fa-solid fa-angle-right"></i></a>
																	</li>
																</ul>
															</nav>
														</div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Here Edit End -->
                </div>
            </div>
            <!--**********************************
		Content body end
	***********************************-->
 


        </div>
     

    </div>

        <div class="footer">
            
        <?php include('../footer.php'); ?>    
        </div>


    <!--**********************************
	Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>
    <script src="../vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    <!-- Apex Chart -->
    <script src="../vendor/apexchart/apexchart.js"></script>
    <script src="../vendor/chartjs/chart.bundle.min.js"></script>

    <!-- Chart piety plugin files -->
    <script src="../vendor/peity/jquery.peity.min.js"></script>

    <!-- Dashboard 1 -->
    <script src="../js/dashboard/dashboard-1.js"></script>

    <script src="../vendor/owl-carousel/owl.carousel.js"></script>

    <script src="../js/custom.min.js"></script>
    <script src="../js/dlabnav-init.js"></script>


    <script>
    function JobickCarousel() {

        /*  testimonial one function by = owl.carousel.js */
        jQuery('.front-view-slider').owlCarousel({
            loop: false,
            margin: 30,
            nav: true,
            autoplaySpeed: 3000,
            navSpeed: 3000,
            autoWidth: true,
            paginationSpeed: 3000,
            slideSpeed: 3000,
            smartSpeed: 3000,
            autoplay: false,
            animateOut: 'fadeOut',
            dots: true,
            navText: ['', ''],
            responsive: {
                0: {
                    items: 1,

                    margin: 10
                },

                480: {
                    items: 1
                },

                767: {
                    items: 3
                },
                1750: {
                    items: 3
                }
            }
        })
    }

    jQuery(window).on('load', function() {
        setTimeout(function() {
            JobickCarousel();
        }, 1000);
    });
    </script>
</body>

</html>