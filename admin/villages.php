<?php include_once("config.php");

session_start();
if (!isset($_SESSION['admin_email'])) {
	header("Location: index.php");
	exit();
}

//Session management code

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

//session code ends
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Village List | Super Admin Panel</title>
	<link rel="shortcut icon" type="image/png" href="images/villagelogo.png">
	<link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<style>
		.card {
			transition: transform 0.3s ease, box-shadow 0.3s ease;
			border: none;
			border-radius: 15px;
			background: linear-gradient(135deg, #ffffff, #f0f4ff);
			box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
		}

		.card:hover {
			transform: translateY(-5px);
			box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
		}

		.jobs2 {
			padding: 20px;
			text-align: center;
		}

		.jobs2 h4 {
			color: #f93a0b;
			font-weight: 600;
		}

		.btn-outline-primary {
			border-color: #f93a0b;
			color: #f93a0b;
			transition: background-color 0.3s ease, color 0.3s ease;
		}

		.btn-outline-primary:hover {
			background-color: #f93a0b;
			color: #ffffff;
		}

		.search-row {
			background: linear-gradient(135deg, #ffffff, #f0f4ff);
			border-radius: 10px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			padding: 15px;
			margin-bottom: 15px;
			transition: transform 0.3s ease;
		}

		.search-row:hover {
			transform: translateY(-3px);
		}

		.search-row h2,
		.search-row h4 {
			color: #f93a0b;
		}

		svg rect[fill="#2769ee"] {
			fill: #f93a0b !important;
		}

		svg circle[fill="#ffe70c"] {
			fill: #facc15 !important;
		}
	</style>
</head>

<body>
	<div id="main-wrapper">
		<?php include('header.php'); ?>

		<div class="content-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12">
						<div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
							<div class="mb-4">
								<?php
								$result = mysqli_query($conn, "SELECT COUNT(*) AS village_count FROM villages");
								$row = mysqli_fetch_assoc($result);
								$count = $row['village_count'];
								echo "<p class='mb-2'>Showing $count Village(s)</p>";
								?>
							</div>
							<div class="d-flex align-items-center mb-4">
								<div class="default-tab job-tabs">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-bs-toggle="tab" href="#Boxed">
												<i class="fas fa-th-large"></i>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-bs-toggle="tab" href="#List1">
												<i class="fas fa-list"></i>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="Boxed" role="tabpanel">
								<div class="row">
									<?php
									$table = mysqli_query($conn, "select * from villages");
									while ($row = mysqli_fetch_array($table)) {

										// Dynamic base URL
										$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
										$host = $_SERVER['HTTP_HOST'];
										$basePath = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
										$adminURL = $protocol . $host . str_replace('/admin/', '/', $basePath) . 'villages/' . urlencode($row['village_name']) .  '/admin/';

										echo "<div class='col-xl-3 col-xxl-4 col-md-4 col-sm-6'>
            <div class='card'>
                <div class='jobs2 card-body'>
                    <div class='text-center'>
                        <span>
                            <svg class='mb-2' xmlns='http://www.w3.org/2000/svg' width='71' height='71' viewBox='0 0 71 71'>
                                <g transform='translate(-457 -443)'>
                                    <rect width='71' height='71' rx='12' transform='translate(457 443)' fill='#c5c5c5'></rect>
                                    <g transform='translate(457 443)'>
                                        <rect data-name='placeholder' width='71' height='71' rx='12' fill='#2769ee'></rect>
                                        <circle data-name='Ellipse 12' cx='18' cy='18' r='18' transform='translate(15 20)' fill='#fff'></circle>
                                        <circle data-name='Ellipse 11' cx='11' cy='11' r='11' transform='translate(36 15)' fill='#ffe70c' style='mix-blend-mode: multiply;isolation: isolate'></circle>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <h4 class='mb-0'><a href='javascript:void(0);'>{$row['village_name']}</a></h4>
                        <a href='$adminURL' target='_blank' class='btn btn-sm btn-outline-primary rounded me-2 mt-3'>Admin Login</a>
                    </div>
                </div>
            </div>
        </div>";
									}

									?>
								</div>
							</div>
							<div class="tab-pane fade" id="List1">
								<div class="row">
									<div class="col-12">
										<?php
										$table = mysqli_query($conn, "select * from villages");
										while ($row = mysqli_fetch_array($table)) {
											echo "<div class='d-flex flex-wrap search-row bg-white p-3 mb-3 rounded justify-content-between align-items-center'>
												<div class='d-flex col-xl-3 col-xxl-4 col-lg-4 col-sm-6 align-items-center'>
													<svg class='me-3' xmlns='http://www.w3.org/2000/svg' width='54' height='54' viewBox='0 0 71 71'>
														<g transform='translate(0.243)'>
															<rect width='71' height='71' rx='12' transform='translate(-0.243)' fill='#c5c5c5'/>
															<g transform='translate(-0.243)'>
																<rect data-name='placeholder' width='71' height='71' rx='12' fill='#2769ee'/>
																<ellipse data-name='Ellipse 12' cx='17.75' cy='18' rx='17.75' ry='18' transform='translate(14.947 20)' fill='#fff'/>
																<ellipse data-name='Ellipse 11' cx='10.743' cy='11' rx='10.743' ry='11' transform='translate(36.434 15)' fill='#ffe70c' style='mix-blend-mode: multiply;isolation: isolate'/>
															</g>
														</g>
													</svg>
													<div>
														<h2 class='title'><a href='javascript:void(0);' class='text-black'>$row[village_name]</a></h2>
													</div>
												</div>
												<div class='d-flex col-xl-3 col-xxl-4 col-lg-4 col-sm-6 align-items-center'>
													<img src='images/database.png' alt='Database icon' class='me-3 ml-lg-0 ml-sm-auto ms-0 mt-sm-0 mt-3' width='54' height='54'>
													<div>
														<h4 class='sub-title text-black'>$row[db_name]</h4>
													</div>
												</div>
												<div class='d-flex col-xl-3 col-xxl-4 col-lg-4 col-sm-6 mt-lg-0 mt-3 align-items-center'>
													<img src='images/user-svg.png' alt='User icon' class='me-3 ml-lg-0 ml-sm-auto ms-0 mt-sm-0 mt-3' width='54' height='54'>
													<div>
														<h4 class='sub-title text-black'>$row[admin_email]</h4>
													</div>
												</div>
												<div class='col-xl-2 col-xxl-12 text-xl-right text-lg-left text-sm-right col-lg-12 col-sm-6 mt-2'>
													<a href='https://villageonweb.in/villages/$row[village_name]/admin' target='_blank' class='btn btn-sm btn-outline-primary rounded me-2'> Admin Login</a>
												</div>
											</div>";
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer">
			<div class="copyright">
				<p>© Copyright <?php echo date("Y"); ?>by Sadar Patel University</p>
			</div>
		</div>
	</div>

	<script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
</body>

</html>