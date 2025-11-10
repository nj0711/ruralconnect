 <!--**********************************
        Main wrapper start
    ***********************************-->


 <!--**********************************
            Nav header start
        ***********************************-->
 <div class="nav-header">
     <a href="../index.php" class="brand-logo">




         <img src="../images/villagelogo.png" alt="" height="70px" width="70px">

     </a>
     <div class="nav-control">
         <div class="hamburger">
             <span class="line"></span><span class="line"></span><span class="line"></span>
         </div>
     </div>
 </div>
 <!--**********************************
            Nav header end
        ***********************************-->

 <!--**********************************
            Chat box start
        ***********************************-->

 <!--**********************************
            Chat box End
        ***********************************-->

 <!--**********************************
            Header start
        ***********************************-->
 <div class="header">
     <div class="header-content">
         <nav class="navbar navbar-expand">
             <div class="collapse navbar-collapse justify-content-between">
                 <div class="header-left">
                     <div class="dashboard_bar">
                         Dashboard
                     </div>

                 </div>
                 <ul class="navbar-nav header-right">

                     <li class="nav-item dropdown header-profile">
                         <!-- <div id="google_translate_element" class="translate-widget container mt-4 p-3 text-center"> -->
                         </div>
                     </li>


                     <li class="nav-item dropdown header-profile">
                         <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                             <img src="../images/avatar/1.png" width="20" alt="">
                         </a>
                         <div class="dropdown-menu dropdown-menu-end">
                             <a href="../admin-profile.php" class="dropdown-item ai-icon">
                                 <svg id="icon-user2" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                     <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                     <circle cx="12" cy="7" r="4"></circle>
                                 </svg>
                                 <span class="ms-2">Profile </span>
                             </a>

                             <a href="../logout.php" class="dropdown-item ai-icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                     <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                     <polyline points="16 17 21 12 16 7"></polyline>
                                     <line x1="21" y1="12" x2="9" y2="12"></line>
                                 </svg>
                                 <span class="ms-2">Logout </span>
                             </a>
                         </div>
                     </li>
                 </ul>
             </div>
         </nav>
     </div>
 </div>
 <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

 <!--**********************************
            Sidebar start
        ***********************************-->
 <div class="dlabnav">
     <div class="dlabnav-scroll">
         <div class="dropdown header-profile2 ">
             <a class="nav-link " href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                 <div class="header-info2 d-flex align-items-center">
                     <img src="../images/avatar/1.png" alt="">
                     <div class="d-flex align-items-center sidebar-info">
                         <div>
                             <span class="font-w400 d-block">Village Admin</span>

                         </div>
                         <i class="fas fa-chevron-down"></i>
                     </div>

                 </div>
             </a>
             <div class="dropdown-menu dropdown-menu-end">
                 <a href="../admin-profile.php" class="dropdown-item ai-icon ">
                     <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                         <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                         <circle cx="12" cy="7" r="4"></circle>
                     </svg>
                     <span class="ms-2">Profile </span>
                 </a>

                 <a href="../logout.php" class="dropdown-item ai-icon">
                     <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                         <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                         <polyline points="16 17 21 12 16 7"></polyline>
                         <line x1="21" y1="12" x2="9" y2="12"></line>
                     </svg>
                     <span class="ms-2">Logout </span>
                 </a>
             </div>
         </div>
         <ul class="metismenu" id="menu">
             <li><a href="../index.php" aria-expanded="false">
                     <i class="flaticon-025-dashboard"></i>
                     <span class="nav-text">Dashboard</span>
                 </a>


             </li>


             <li><a href="allpages.php" aria-expanded="false">
                     <i class="flaticon-022-copy"></i>


                     <span class="nav-text">Add Data</span>

                 </a>
             </li>
             <li><a href="../contact.php" aria-expanded="false">
                     <i class="flaticon-381-user-9"></i>
                     <span class="nav-text">Contact</span>
                 </a>
             </li>

         </ul>


     </div>
 </div>
 <!--**********************************
            Sidebar end
        ***********************************-->
 <!-- Google Translate Script -->

 <script type="text/javascript">
     function googleTranslateElementInit() {
         new google.translate.TranslateElement({
             pageLanguage: 'en',
             includedLanguages: 'gu,mr,ta,te,ml,hi,kn,sd'
         }, 'google_translate_element');
     }
 </script>
 <script type="text/javascript"
     src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

 <!--************
            Sidebar end
        *************-->


 <!-- Custom CSS to Redesign the Div -->
 <style>
     select.goog-te-combo {
         padding: 5px 8px;
         border: 1px solid #afabab;
         border-radius: 10px;
     }

     .p-3 {
         padding: 0px !important;
     }

     .goog-te-gadget {
         font-size: 0px;
         margin-bottom: 20px;
     }

     div.skiptranslate.goog-te-gadget>span {
         display: none;
     }
 </style>