<!DOCTYPE html>
<html lang="en">
<head>

   <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="DexignLab">
	<meta name="robots" content="" >
	<meta name="keywords" content="admin dashboard, admin template, analytics, bootstrap, bootstrap 5, bootstrap 5 admin template, job board admin, job portal admin, modern, responsive admin dashboard, sales dashboard, sass, ui kit, web app, frontend">
	<meta name="description" content="We proudly present Jobick, a Job Admin dashboard HTML Template, If you are hiring a job expert you would like to build a superb website for your Jobick, it's a best choice.">
	<meta property="og:title" content="Jobick : Job Admin Dashboard Bootstrap 5 Template + FrontEnd">
	<meta property="og:description" content="We proudly present Jobick, a Job Admin dashboard HTML Template, If you are hiring a job expert you would like to build a superb website for your Jobick, it's a best choice." >
	<meta property="og:image" content="https://jobick.dexignlab.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">
	
	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- PAGE TITLE HERE -->
	<title>Jobick : Job Admin Dashboard Bootstrap 5 Template + FrontEnd</title>
	
	<!-- Favicon icon -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="./vendor/nestable2/css/jquery.nestable.min.css" rel="stylesheet">
	
	<!-- Style css -->
    <link href="css/style.css" rel="stylesheet">
	
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

	<?php include('header.php');  ?>
		
		<!--**********************************
            Content body start
        ***********************************-->
     <div class="content-body">
			<div class="container-fluid">
				<!-- Row -->
				<div class="row">
					<div class="col-xl-12">
						
						<div class="filter cm-content-box box-primary">
							<div class="content-title">
								<div class="cpa">
									<i class="fa fa-list-alt me-1"></i>Menu
								</div>
								<div class="tools">
									<a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
								</div>
							</div>
							<div class="cm-content-body form excerpt">
								<div class="card-body">
									<div class="row align-items-center p-3">
										<div class="col-xl-3 col-xxl-3 mb-xl-0 mb-3">
											<h6 class="mb-0">Select a menu to edit: <span class="required">* </span></h6>
										</div>
										<div class="col-xl-6 col-xxl-5 mb-xl-0 mb-3">
											<select class="form-control default-select dashboard-select-2 h-auto wide">
												<option value="AL">Select Menu</option>
												<option value="WY">India</option>
												<option value="WY">Information</option>
												<option value="WY">New Menu</option>
												<option value="WY">Page Menu</option>
											</select>
										</div>
										<div class="col-xl-3 col-xxl-4">
											<a href="javascript:void(0);" class="btn btn-primary">Select</a>
											<span class="mx-2">or</span>
											<a href="javascript:void(0);" class="text-primary">create new menu</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-4">
								<div class="filter cm-content-box box-primary">
									<div class="content-title">
										<div class="cpa">
											Menus
										</div>
										<div class="tools">
											<a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
										</div>
									</div>
									<div class="cm-content-body form excerpt">
										<div class="card-body">
											<div class="filter cm-content-box box-primary border">
												<div class="content-title border-0">
													<div class="cpa">
														page
													</div>
													<div class="tools">
														<a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
													</div>
												</div>
												<div class="cm-content-body form excerpt border-top">
													<div class="card-body ItemsCheckboxSec">
														<ul class=" tab-my nav nav-tabs" id="myTab" role="tablist">
														  <li class="nav-item" role="presentation">
															<button class="nav-link active" id="Viewall-tab" data-bs-toggle="tab" data-bs-target="#Viewall-tab-pane" type="button" role="tab" aria-controls="Viewall-tab-pane" aria-selected="true">View All</button>
														  </li>
														  <li class="nav-item" role="presentation">
															<button class="nav-link" id="Search-tab" data-bs-toggle="tab" data-bs-target="#Search-tab-pane" type="button" role="tab" aria-controls="Search-tab-pane" aria-selected="false">Search</button>
														  </li>
													 
														</ul>
														<div class="tab-content" id="myTabContent">
															<div class="tab-pane fade show active" id="Viewall-tab-pane" role="tabpanel" aria-labelledby="Viewall-tab" tabindex="0">
																<div class="menu-tabs">
																	<div class="form-check">
																	  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
																	  <label class="form-check-label" for="flexCheckDefault">
																		Privacy Policy 
																	  </label>
																	</div>
																	<div class="form-check">
																	  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
																	  <label class="form-check-label" for="flexCheckDefault-1">
																		Contact Us 
																	  </label>
																	</div>
																	<div class="form-check">
																	  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
																	  <label class="form-check-label" for="flexCheckDefault-2">
																		Important Information 
																	  </label>
																	</div>
																	<div class="form-check">
																	  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-3">
																	  <label class="form-check-label" for="flexCheckDefault-3">
																		About Us 
																	  </label>
																	</div>
																	<div class="form-check">
																	  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-4">
																	  <label class="form-check-label" for="flexCheckDefault-4">
																		Dummy Co 
																	  </label>
																	</div>
																</div>
															</div>
															<div class="tab-pane fade" id="Search-tab-pane" role="tabpanel" aria-labelledby="Search-tab" tabindex="0">
																	<div class="menu-tabs">
																	  <label for="exampleFormControlInput1" class="form-label">Search</label>
																	  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Page Name">
																	</div>
															</div>
															<div class="d-flex align-items-center flex-wrap">
																
																<a href="javascript:void(0);" class="checkAllInput">Select All</a><span class="mx-2">|</span>
																<a href="javascript:void(0);" class="unCheckAllInput">Deselect All</a>
															</div>
															<a  class="btn btn-primary btn-sm dz-menu-btn">Add to Menu</a>
														</div>
													</div>
													
												</div>
											</div>
											<div class="filter cm-content-box box-primary border">
												<div class="content-title border-0">
													<div class="cpa">
														Links 
													</div>
													<div class="tools">
														<a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
													</div>
												</div>
												<div class="cm-content-body form excerpt border-top">
													<div class="card-body">
														<div class="row align-items-center">
															<div class="col-xl-4">
																<h6>URL</h6>
															</div>
															<div class="col-xl-8">
																 <input type="text" class="form-control mb-2" placeholder="">
															</div>
															<div class="col-xl-4">
																<h6 class="mb-xl-0 text-nowrap ">Link Text</h6>
															</div>
															<div class="col-xl-8">
																 <input type="text" class="form-control" placeholder="Menu items">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-8">
								<div class="filter cm-content-box box-primary">
									<div class="content-title flex-wrap">
										<div class="cpa d-flex align-items-center flex-wrap">
											Menu Name
											<input type="text" class="form-control w-auto ms-2" placeholder="information">
										</div>
										<button type="button" class="btn btn-secondary ms-sm-auto mb-2 mb-sm-0">Save Menu</button>
									</div>
									<div class="cm-content-body form excerpt rounded-0">
										<div class="card-body">
											<h6 class="mb-0">Menu Structure</h6>
											<p>Add menu items from the column on the left.</p>
											<div class="col-xl-7">
												<div class="dd" id="nestable">
													<ol class="dd-list">
														<li class="dd-item menu-ac-item" data-id="1">
															<!-- <div class="dd-handle"></div> -->
															<div class="accordion" id="accordionExample-1">
																<div class="accordion-item">
																	<div class="accordion-header p-0" id="heading-1">
																		<div class="move-media dd-handle">
																			<i class="fa-solid fa-arrows-up-down-left-right"></i>
																		</div>
																	  <button class="accordion-button contact" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
																		Contact Us
																	  </button>
																	</div>
																	<div id="collapse-1" class="accordion-collapse collapse" aria-labelledby="heading-1" data-bs-parent="#accordionExample-1">
																		<div class="accordion-body">
																			<div class="row">
																				<div class="col-xl-12">
																					<form>
																					  <div class="mb-3">
																						<label  class="form-label">URL</label>
																						<input type="text" class="form-control" placeholder="https://bodyclub.dexignzone.com/xhtml/about-us.html">
																					  </div>
																					</form>													
																				</div>
																				<div class="col-xl-6">
																					<form>
																					  <div class="mb-3">
																						<label  class="form-label">Navigation Label</label>
																						<input type="text" class="form-control" placeholder="Contact Us">
																					  </div>
																					</form>
																				</div>
																				<div class="col-xl-6">
																					<form>
																					  <div class="mb-3">
																						<label  class="form-label">Title Attribute</label>
																						<input type="text" class="form-control" placeholder="Contact Us">
																					  </div>
																					</form>
																				</div>
																				<div class="d-flex align-items-center">
																					<a href="javascript:void(0);">Remove</a><span class="mx-2">|</span>
																					
																					<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
																					Cancel
																				  </a>
																				</div>
																			</div>												
																		</div>
																	</div>
																</div>
															</div>
														</li>
														<li class="dd-item menu-ac-item" data-id="2">
															<div class="accordion" id="accordionExample-2">
																<div class="accordion-item">
																	<div class="accordion-header p-0" id="heading-2">
																		<div class="move-media dd-handle">
																			<i class="fa-solid fa-arrows-up-down-left-right"></i>
																		</div>
																	  <button class="accordion-button contact" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="true" aria-controls="collapse-2">
																		Privacy Policy
																	  </button>
																	</div>
																	<div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionExample-2">
																		<div class="accordion-body">
																			<div class="row">
																				<div class="col-xl-6">
																					<form>
																					  <div class="mb-3">
																						<label  class="form-label">Navigation Label</label>
																						<input type="text" class="form-control" placeholder="Privacy Policy">
																					  </div>
																					</form>
																				</div>
																				<div class="col-xl-6">
																					<form>
																					  <div class="mb-3">
																						<label  class="form-label">Title Attribute</label>
																						<input type="text" class="form-control" placeholder="Privacy Policy">
																					  </div>
																					</form>
																				</div>
																				<div class="col-xl-12">
																					<p class="dz-terms">Original: <a href="javascript:void(0);">Privacy Policy</a></p>
																				</div>
																				<div class="d-flex align-items-center">
																					<a href="javascript:void(0);">Remove</a><span class="mx-2">|</span>
																					<a href="javascript:void(0);"  data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
																					Cancel
																				  </a>
																				</div>
																			</div>												
																		</div>
																	</div>
																</div>
															</div>
														</li>
														<li class="dd-item menu-ac-item" data-id="3">
															<div class="accordion" id="accordionExample-3">
																<div class="accordion-item">
																	<div class="accordion-header p-0" id="heading-3">
																		<div class="move-media dd-handle">
																			<i class="fa-solid fa-arrows-up-down-left-right"></i>
																		</div>
																	  <button class="accordion-button contact" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="true" aria-controls="collapse-3">
																		Terms and Conditions
																	  </button>
																	</div>
																	<div id="collapse-3" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordionExample-3">
																		<div class="accordion-body">
																			<div class="row">
																				<div class="col-xl-6">
																					<form>
																					  <div class="mb-3">
																						<label  class="form-label">Navigation Label</label>
																						<input type="text" class="form-control" placeholder="Terms and Conditions">
																					  </div>
																					</form>
																				</div>
																				<div class="col-xl-6">
																					<form>
																					  <div class="mb-3">
																						<label  class="form-label">Title Attribute</label>
																						<input type="text" class="form-control" placeholder="Terms and Conditions">
																					  </div>
																					</form>
																				</div>
																				<div class="col-xl-12">
																					<p class="dz-terms">Original: <a href="javascript:void(0);">Terms and Conditions</a></p>
																				</div>
																				<div class="d-flex align-items-center">
																					<a href="javascript:void(0);">Remove</a><span class="mx-2">|</span>
																					<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
																					Cancel
																				  </a>
																				</div>
																			</div>												
																		</div>
																	</div>
																</div>
															</div>
														</li>
														<li class="dd-item menu-ac-item" data-id="4">
															<div class="accordion" id="accordionExample-4">
																<div class="accordion-item">
																	<div class="accordion-header p-0" id="heading-4">
																		<div class="move-media dd-handle">
																			<i class="fa-solid fa-arrows-up-down-left-right"></i>
																		</div>
																	  <button class="accordion-button contact" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="true" aria-controls="collapse-4">
																		About Us
																	  </button>
																	</div>
																	<div id="collapse-4" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordionExample-4">
																		<div class="accordion-body">
																			<div class="row">
																				<div class="col-xl-6">
																					<form>
																					  <div class="mb-3">
																						<label  class="form-label">Navigation Label</label>
																						<input type="text" class="form-control" placeholder="About Us">
																					  </div>
																					</form>
																				</div>
																				<div class="col-xl-6">
																					<form>
																					  <div class="mb-3">
																						<label  class="form-label">Title Attribute</label>
																						<input type="text" class="form-control" placeholder="About Us">
																					  </div>
																					</form>
																				</div>
																				<div class="col-xl-12">
																					<p class="dz-terms">Original: <a href="javascript:void(0);">About Us</a></p>
																				</div>
																				<div class="d-flex align-items-center">
																					<a href="javascript:void(0);">Remove</a><span class="mx-2">|</span>
																					<a href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
																					Cancel
																				  </a>
																				</div>
																			</div>												
																		</div>
																	</div>
																</div>
															</div>
														</li>
														<li class="dd-item menu-ac-item" data-id="5">
															<div class="accordion" id="accordionExample-5">
																<div class="accordion-item">
																	<div class="accordion-header p-0" id="heading-5">
																		<div class="move-media dd-handle">
																			<i class="fa-solid fa-arrows-up-down-left-right"></i>
																		</div>
																	  <button class="accordion-button contact" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="true" aria-controls="collapse-5">
																		Important Information
																	  </button>
																	</div>
																	<div id="collapse-5" class="accordion-collapse collapse" aria-labelledby="heading-5" data-bs-parent="#accordionExample-5">
																		<div class="accordion-body">
																			<div class="row">
																				<div class="col-xl-6">
																					<form>
																					  <div class="mb-3">
																						<label  class="form-label">Navigation Label</label>
																						<input type="text" class="form-control" placeholder="Important Information">
																					  </div>
																					</form>
																				</div>
																				<div class="col-xl-6">
																					<form>
																					  <div class="mb-3">
																						<label  class="form-label">Title Attribute</label>
																						<input type="text" class="form-control" placeholder="">
																					  </div>
																					</form>
																				</div>
																				<div class="col-xl-12">
																					<p class="dz-terms">Original: <a href="javascript:void(0);">Terms and Conditions</a></p>
																				</div>
																				<div class="d-flex align-items-center">
																					<a href="javascript:void(0);">Remove</a><span class="mx-2">|</span>
																					<a href="javascript:void(0);"  type="button" data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
																					Cancel
																				  </a>
																				</div>
																			</div>												
																		</div>
																	</div>
																</div>
															</div>
														</li>
													</ol>
												</div>
											</div>
										</div>		
									</div>
									<div class="filter cm-content-box box-primary style-1 mb-0 border-0">
										<div class="content-title">
											<div class="cpa">
												Delete Menu
											</div>
											<button type="button" class="btn btn-secondary my-2">Save Menu</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
        <!--**********************************
            Content body end
        ***********************************-->
		
		
		
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://dexignlab.com/" target="_blank">DexignLab</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->
		
        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
	 <!-- Modal -->
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Job Title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal">
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Company Name<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="Name" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Position<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="Name" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Job Category<span class="text-danger scale5 ms-2">*</span></label>
										<select  class="nice-select default-select wide form-control solid">
										  <option selected>Choose...</option>
										  <option>QA Analyst</option>
										   <option>IT Manager</option>
										    <option>Systems Analyst</option>
										</select>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Job Type<span class="text-danger scale5 ms-2">*</span></label>
										<select  class="nice-select default-select wide form-control solid">
										  <option selected>Choose...</option>
										  <option>Part-Time</option>
										   <option>Full-Time</option>
										    <option>Freelancer</option>
										</select>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">No. of Vancancy<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="Name" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Select Experience<span class="text-danger scale5 ms-2">*</span></label>
										<select  class="nice-select default-select wide form-control solid">
										  <option selected>1 yr</option>
										  <option>2 Yr</option>
										   <option>3 Yr</option>
										    <option>4 Yr</option>
										</select>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Posted Date<span class="text-danger scale5 ms-2">*</span></label>
										<div class="input-group">
											 <div class="input-group-text"><i class="far fa-clock"></i></div>
											<input type="date" name="datepicker" class="form-control">
										</div>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Last Date To Apply<span class="text-danger scale5 ms-2">*</span></label>
										<div class="input-group">
											 <div class="input-group-text"><i class="far fa-clock"></i></div>
											<input type="date" name="datepicker" class="form-control">
										</div>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Close Date<span class="text-danger scale5 ms-2">*</span></label>
										<div class="input-group">
											 <div class="input-group-text"><i class="far fa-clock"></i></div>
											<input type="date" name="datepicker" class="form-control">
										</div>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Select Gender:<span class="text-danger scale5 ms-2">*</span></label>
										<select  class="nice-select default-select wide form-control solid">
										  <option selected>Choose...</option>
										  <option>Male</option>
										   <option>Female</option>
										</select>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Salary Form<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="$" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Salary To<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="$" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Enter City:<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="$" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Enter State:<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="State" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Enter Counter:<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="State" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Enter Education Level:<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="Education Level" aria-label="name">
									</div>
									<div class="col-xl-12 mb-4">
										  <label  class="form-label font-w600">Description:<span class="text-danger scale5 ms-2">*</span></label>
										  <textarea class="form-control solid" rows="5" aria-label="With textarea"></textarea>
									</div>
								</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	

    <!--**********************************
        Scripts
    ***********************************-->
  <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	
	<!-- Dashboard 1 -->
	<script src="js/dashboard/cms.js"></script>
	
	<!--nestable file-->
	 <script src="./vendor/nestable2/js/jquery.nestable.min.js"></script>
	 <!-- nestable plugins -->
	 <script src="./js/plugins-init/nestable-init.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>

   
	
	
	
</body>
</html>