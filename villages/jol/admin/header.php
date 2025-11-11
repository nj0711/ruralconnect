<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Your Custom CSS -->
    <style>
        select.goog-te-combo {
            padding: 5px 8px;
            border: 1px solid #afabab;
            border-radius: 10px;
        }

        .goog-te-gadget {
            font-size: 0px;
            margin-bottom: 20px;
        }

        div.skiptranslate.goog-te-gadget>span {
            display: none;
        }
    </style>
</head>

<body>

    <!--**********************************
        Main wrapper start
    ***********************************-->

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="index.php" class="brand-logo">
            <img src="images/villagelogo.png" alt="" height="70" width="70">
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
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="dashboard_bar">Dashboard</div>
                    </div>
                    <ul class="navbar-nav header-right">

                        <!-- Google Translate Widget -->
                        <!-- <li class="nav-item">
                            <div id="google_translate_element"></div>
                        </li> -->

                        <!-- Profile Dropdown -->
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                <img src="images/avatar/1.png" width="20" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="admin-profile.php" class="dropdown-item ai-icon">
                                    <svg class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="ms-2">Profile</span>
                                </a>
                                <a href="logout.php" class="dropdown-item ai-icon">
                                    <svg class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span class="ms-2">Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="dlabnav">
        <div class="dlabnav-scroll">
            <div class="dropdown header-profile2">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    <div class="header-info2 d-flex align-items-center">
                        <img src="images/avatar/1.png" alt="">
                        <div class="d-flex align-items-center sidebar-info">
                            <span class="font-w400 d-block">Village Admin</span>
                            <i class="fas fa-chevron-down ms-2"></i>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="admin-profile.php" class="dropdown-item ai-icon">
                        <svg class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="ms-2">Profile</span>
                    </a>
                    <a href="logout.php" class="dropdown-item ai-icon">
                        <svg class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span class="ms-2">Logout</span>
                    </a>
                </div>
            </div>

            <ul class="metismenu" id="menu">
                <li><a href="index.php"><i class="flaticon-025-dashboard"></i> <span class="nav-text">Dashboard</span></a></li>
                <li><a href="./pages/allpages.php"><i class="flaticon-022-copy"></i> <span class="nav-text">Add Data</span></a></li>
                <li><a href="./pages/service.php"><i class="fas fa-tools"></i> <span class="nav-text">Add Service</span></a></li>
                <li><a href="contact.php"><i class="flaticon-381-user-9"></i> <span class="nav-text">Contact</span></a></li>
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
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>