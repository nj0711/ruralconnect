<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Municipal Services || Village On Web</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning-gradient: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
            --municipal-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            --infrastructure-gradient: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 20px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Municipal Services Section */
        .municipal-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .service-tabs {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .nav-tabs {
            border: none;
            display: flex;
            background: var(--municipal-gradient);
        }

        .nav-tabs .nav-link {
            color: rgba(255, 255, 255, 0.8);
            border: none;
            padding: 1rem 2rem;
            font-weight: 500;
            font-family: 'Manrope', sans-serif;
            transition: var(--transition);
            border-radius: 0;
            flex: 1;
            text-align: center;
        }

        .nav-tabs .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-tabs .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            border: none;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h1 {
            font-family: 'Manrope', sans-serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            position: relative;
        }

        .section-title h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--infrastructure-gradient);
            border-radius: 2px;
        }

        .section-title p {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            font-family: 'Inter', sans-serif;
        }

        /* Modern Service Cards */
        .service-card-container {
            position: relative;
        }

        .service-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
        }

        .service-card:hover {
            transform: translateY(-12px) rotateX(2deg) rotateY(2deg);
            box-shadow: var(--card-shadow-hover);
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--infrastructure-gradient);
            z-index: 2;
        }

        .service-image-container {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .service-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .service-card:hover .service-image {
            transform: scale(1.05);
        }

        .service-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            padding: 1.5rem;
            color: white;
            transform: translateY(100%);
            transition: var(--transition);
        }

        .service-card:hover .service-overlay {
            transform: translateY(0);
        }

        .service-name-overlay {
            font-family: 'Manrope', sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .service-type-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.25rem 0.5rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
            color: white;
            display: inline-block;
        }

        /* Service Card Content */
        .service-content {
            padding: 1.75rem;
            position: relative;
        }

        .service-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .service-main-info {
            flex-grow: 1;
        }

        .service-name {
            font-family: 'Manrope', sans-serif;
            font-size: 1.375rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }

        .service-location {
            color: #6c757d;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .service-type {
            background: var(--infrastructure-gradient);
            color: white;
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .service-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #28a745;
            flex-shrink: 0;
        }

        .status-text {
            color: #28a745;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Service Details Grid */
        .service-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .detail-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(52, 152, 219, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #3498db;
            font-size: 0.875rem;
        }

        .detail-content h6 {
            font-family: 'Manrope', sans-serif;
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }

        .detail-value {
            color: #6c757d;
            font-size: 0.875rem;
            line-height: 1.4;
        }

        /* Read More Button */
        .read-more-btn {
            background: var(--infrastructure-gradient);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: auto;
            width: 100%;
        }

        .read-more-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .read-more-btn:hover::before {
            left: 100%;
        }

        .read-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
            color: white;
            text-decoration: none;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(248, 249, 250, 0.5);
            border-radius: var(--border-radius);
            border: 2px dashed #dee2e6;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .empty-state h3 {
            color: #495057;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .empty-state p {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Service Modal Enhancements */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 0;
            border: none;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 1000px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: var(--card-shadow-hover);
            position: relative;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 2.5rem;
            font-weight: bold;
            line-height: 1;
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            z-index: 10;
            cursor: pointer;
            transition: var(--transition);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close:hover,
        .close:focus {
            color: #000 !important;
            text-decoration: none;
            cursor: pointer !important;
            background: rgba(0, 0, 0, 0.1);
            transform: scale(1.1);
        }

        .modal-body {
            padding: 2.5rem;
            position: relative;
        }

        .service-modal-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(0, 0, 0, 0.08);
        }

        .service-modal-name {
            font-family: 'Manrope', sans-serif;
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .service-modal-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .modal-detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .modal-detail-section {
            background: #f8f9fa;
            padding: 1.75rem;
            border-radius: 15px;
            border-left: 4px solid #3498db;
        }

        .modal-detail-section h5 {
            font-family: 'Manrope', sans-serif;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.1rem;
        }

        .detail-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.875rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(52, 152, 219, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #3498db;
            font-size: 0.875rem;
            margin-top: 0.125rem;
        }

        .detail-label {
            font-weight: 500;
            color: #495057;
            min-width: 150px;
            font-size: 0.95rem;
        }

        .detail-value {
            color: #2c3e50;
            font-weight: 400;
            flex-grow: 1;
            line-height: 1.4;
        }

        /* Schedule Display */
        .schedule-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 1.5rem;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .schedule-item {
            background: white;
            padding: 1rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
            border-left: 4px solid #3498db;
        }

        .schedule-time {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.25rem;
        }

        .schedule-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Contact Section */
        .contact-section {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: 2px solid #ffc107;
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1.5rem 0;
        }

        .contact-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .contact-icon {
            width: 48px;
            height: 48px;
            background: #ffc107;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #856404;
            font-size: 1.25rem;
        }

        .contact-title {
            color: #856404;
            font-weight: 700;
            margin: 0;
            font-size: 1.25rem;
        }

        .contact-options {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .contact-option {
            background: white;
            color: #495057;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            border: 2px solid #ffc107;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .contact-option:hover {
            background: #ffc107;
            color: #856404;
            transform: translateY(-2px);
            text-decoration: none;
        }

        /* Status Indicators */
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .status-good {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: 1px solid #28a745;
        }

        .status-fair {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: 1px solid #ffc107;
        }

        .status-poor {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid #dc3545;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .municipal-section {
                padding: 40px 0;
            }

            .section-title h1 {
                font-size: 2rem;
            }

            .service-details-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .service-content {
                padding: 1.25rem;
            }

            .service-name {
                font-size: 1.25rem;
            }

            .empty-state {
                padding: 2rem 1rem;
            }

            .nav-tabs {
                flex-direction: column;
            }

            .nav-tabs .nav-link {
                padding: 0.75rem 1rem;
            }

            .modal-content {
                width: 95%;
                margin: 2.5% auto;
            }

            .modal-body {
                padding: 1.5rem;
            }

            .modal-detail-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .detail-item {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }

            .detail-label {
                min-width: auto;
                font-size: 0.9rem;
            }

            .schedule-grid {
                grid-template-columns: 1fr;
            }

            .contact-options {
                flex-direction: column;
            }
        }

        @media (max-width: 576px) {
            .service-card:hover {
                transform: translateY(-4px);
            }

            .service-header {
                flex-direction: column;
                gap: 0.75rem;
                align-items: stretch;
            }

            .service-status {
                justify-content: center;
            }

            .service-image-container {
                height: 180px;
            }
        }

        /* Loading Animation for Images */
        .service-image-loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Smooth Modal Transitions */
        .modal.show .modal-dialog {
            transform: scale(1);
            opacity: 1;
        }

        .modal.fade .modal-dialog {
            transform: scale(0.8);
            opacity: 0;
            transition: all 0.3s ease-out;
        }

        /* Gallery Styles */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            aspect-ratio: 4/3;
            cursor: pointer;
            transition: var(--transition);
        }

        .gallery-item:hover {
            transform: scale(1.02);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay i {
            color: white;
            font-size: 1.5rem;
        }
    </style>

</head>

<body>

    <?php include "header.php"; ?>
    <!-- connection -->
    <?php
    include_once('admin/config.php');
    $obj = new ConnDb();

    // Drainage Data
    $drainage_query = "SELECT * FROM drainage WHERE visibility = 'on'";
    $drainage_result = $obj->selectdata("drainage", $drainage_query);

    // Water Supply Data
    $watersupply_query = "SELECT * FROM watersupply WHERE visibility = 'on'";
    $watersupply_result = $obj->selectdata("watersupply", $watersupply_query);

    // Washrooms Data
    $washrooms_query = "SELECT * FROM washrooms WHERE visibility = 'on'";
    $washrooms_result = $obj->selectdata("washrooms", $washrooms_query);
    ?>

    <div class="page-wrapper">
        <section class="page-banner" style="background-image: url('./assets/image/rjk/image1.jpg');">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Municipal Infrastructure Services</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Municipal Services</li>
                        </ol>
                    </nav>
                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section>
        <!--page-banner-->

        <!-- Municipal Services Section -->
        <section class="municipal-section">
            <div class="container">
                <div class="section-title">
                    <h1>Essential Infrastructure Services</h1>
                    <p class="lead">Access comprehensive information about our village's municipal infrastructure including drainage systems, water supply schedules, and public washroom facilities. Stay informed about maintenance schedules and contact details for reporting issues.</p>
                </div>

                <!-- Service Tabs Navigation -->
                <div class="service-tabs">
                    <ul class="nav nav-tabs" id="serviceTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="drainage-tab" data-bs-toggle="tab" data-bs-target="#drainage" type="button" role="tab">
                                <i class="fas fa-tint me-2"></i>Drainage System
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="watersupply-tab" data-bs-toggle="tab" data-bs-target="#watersupply" type="button" role="tab">
                                <i class="fas fa-faucet me-2"></i>Water Supply
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="washrooms-tab" data-bs-toggle="tab" data-bs-target="#washrooms" type="button" role="tab">
                                <i class="fas fa-restroom me-2"></i>Washrooms
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="serviceTabContent">
                        <!-- Drainage Tab -->
                        <div class="tab-pane fade show active" id="drainage" role="tabpanel">
                            <?php if (empty($drainage_result) || $drainage_result == "No Data Found!"): ?>
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-tint"></i>
                                    </div>
                                    <h3>No Drainage Information</h3>
                                    <p>No drainage system information is currently available. This section will be updated with details about our village's drainage infrastructure.</p>
                                    <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
                                        <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                            <i class="fas fa-envelope me-2"></i>Report Issue
                                        </a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row g-4 service-card-container">
                                    <?php foreach ($drainage_result as $row => $drainage): ?>
                                        <?php
                                        $drainageModalId = "drainageModal" . $row;
                                        $addressParts = explode('@', $drainage['address']);
                                        $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Village Area';
                                        $statusClass = strtolower($drainage['systemcondition']) == 'good' ? 'status-good' : (strtolower($drainage['systemcondition']) == 'fair' ? 'status-fair' : 'status-poor');
                                        ?>
                                        <!-- Enhanced Drainage Card -->
                                        <div class="col-12">
                                            <div class="service-card h-100 position-relative">
                                                <!-- Drainage Image Container -->


                                                <!-- Drainage Content -->
                                                <div class="service-content">
                                                    <div class="service-header">
                                                        <div class="service-main-info">
                                                            <h4 class="service-name">Village Drainage System</h4>
                                                            <div class="service-location"><?php echo $fullAddress; ?></div>
                                                            <span class="service-type">Municipal Infrastructure</span>
                                                        </div>

                                                        <div class="service-status">
                                                            <div class="status-indicator" style="background: <?php echo strtolower($drainage['systemcondition']) == 'good' ? '#28a745' : (strtolower($drainage['systemcondition']) == 'fair' ? '#ffc107' : '#dc3545'); ?>;"></div>
                                                            <span class="status-text"><?php echo htmlspecialchars($drainage['systemcondition']); ?></span>
                                                        </div>
                                                    </div>

                                                    <!-- Drainage Quick Details -->
                                                    <div class="service-details-grid">
                                                        <div class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
                                                                <i class="fas fa-expand-arrows-alt"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Coverage</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($drainage['coveragearea']); ?> sqm</div>
                                                            </div>
                                                        </div>

                                                        <div class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71;">
                                                                <i class="fas fa-tint-drop"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Capacity</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($drainage['capacity']); ?> m³</div>
                                                            </div>
                                                        </div>

                                                        <div class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                                                                <i class="fas fa-cogs"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($drainage['type']); ?></div>
                                                            </div>
                                                        </div>

                                                        <?php if (!empty($drainage['phoneno'])): ?>
                                                            <div class="detail-item">
                                                                <div class="detail-icon" style="background: rgba(231, 76, 60, 0.1); color: #e74c3c;">
                                                                    <i class="fas fa-phone"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Support</h6>
                                                                    <div class="detail-value">
                                                                        <a href="tel:<?php echo htmlspecialchars($drainage['phoneno']); ?>" style="color: #6c757d; text-decoration: none;">
                                                                            <?php echo htmlspecialchars($drainage['phoneno']); ?>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <!-- Drainage Read More Button -->
                                                    <div style="margin-top: auto;">
                                                        <button class="read-more-btn" onclick="openDrainageModal('<?php echo $drainageModalId; ?>')">
                                                            <i class="fas fa-info-circle"></i>
                                                            <span>View Details</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Water Supply Tab -->
                        <div class="tab-pane fade" id="watersupply" role="tabpanel">
                            <?php if (empty($watersupply_result) || $watersupply_result == "No Data Found!"): ?>
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-faucet"></i>
                                    </div>
                                    <h3>No Water Supply Information</h3>
                                    <p>No water supply information is currently available. This section will be updated with our village's water distribution schedule and infrastructure details.</p>
                                    <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
                                        <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                            <i class="fas fa-envelope me-2"></i>Report Issue
                                        </a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row g-4 service-card-container">
                                    <?php foreach ($watersupply_result as $row => $watersupply): ?>
                                        <?php
                                        $watersupplyModalId = "watersupplyModal" . $row;
                                        $addressParts = explode('@', $watersupply['address']);
                                        $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Village Area';
                                        $timeArray = json_decode($watersupply['watersupplyschedule'], true);
                                        $statusClass = strtolower($watersupply['systemcondition']) == 'good' ? 'status-good' : (strtolower($watersupply['systemcondition']) == 'fair' ? 'status-fair' : 'status-poor');
                                        ?>
                                        <!-- Enhanced Water Supply Card -->
                                        <div class="col-12">
                                            <div class="service-card h-100 position-relative">
                                                <!-- Water Supply Image Container -->


                                                <!-- Water Supply Content -->
                                                <div class="service-content">
                                                    <div class="service-header">
                                                        <div class="service-main-info">
                                                            <h4 class="service-name">Village Water Supply</h4>
                                                            <div class="service-location"><?php echo $fullAddress; ?></div>
                                                            <span class="service-type">Water Infrastructure</span>
                                                        </div>

                                                        <div class="service-status">
                                                            <div class="status-indicator" style="background: <?php echo strtolower($watersupply['systemcondition']) == 'good' ? '#28a745' : (strtolower($watersupply['systemcondition']) == 'fair' ? '#ffc107' : '#dc3545'); ?>;"></div>
                                                            <span class="status-text"><?php echo htmlspecialchars($watersupply['systemcondition']); ?></span>
                                                        </div>
                                                    </div>

                                                    <!-- Water Supply Quick Details -->
                                                    <div class="service-details-grid">
                                                        <div class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71;">
                                                                <i class="fas fa-tint"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Capacity</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($watersupply['capacity']); ?> L</div>
                                                            </div>
                                                        </div>

                                                        <div class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                                                                <i class="fas fa-home"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Source</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($watersupply['sourcetype']); ?></div>
                                                            </div>
                                                        </div>

                                                        <div class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
                                                                <i class="fas fa-calendar-alt"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Installed</h6>
                                                                <div class="detail-value"><?php echo date('M Y', strtotime($watersupply['installationdate'] ?? 'now')); ?></div>
                                                            </div>
                                                        </div>

                                                        <?php if (!empty($watersupply['contactphone'])): ?>
                                                            <div class="detail-item">
                                                                <div class="detail-icon" style="background: rgba(231, 76, 60, 0.1); color: #e74c3c;">
                                                                    <i class="fas fa-phone"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Support</h6>
                                                                    <div class="detail-value">
                                                                        <a href="tel:<?php echo htmlspecialchars($watersupply['contactphone']); ?>" style="color: #6c757d; text-decoration: none;">
                                                                            <?php echo htmlspecialchars($watersupply['contactphone']); ?>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <!-- Water Supply Read More Button -->
                                                    <div style="margin-top: auto;">
                                                        <button class="read-more-btn" onclick="openWaterSupplyModal('<?php echo $watersupplyModalId; ?>')">
                                                            <i class="fas fa-info-circle"></i>
                                                            <span>Schedule & Details</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Washrooms Tab -->
                        <div class="tab-pane fade" id="washrooms" role="tabpanel">
                            <?php if (empty($washrooms_result) || $washrooms_result == "No Data Found!"): ?>
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-restroom"></i>
                                    </div>
                                    <h3>No Washroom Information</h3>
                                    <p>No public washroom information is currently available. This section will be updated with locations and maintenance schedules for our village's public facilities.</p>
                                    <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
                                        <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                            <i class="fas fa-envelope me-2"></i>Report Issue
                                        </a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row g-4 service-card-container">
                                    <?php foreach ($washrooms_result as $row => $washroom): ?>
                                        <?php
                                        $washroomModalId = "washroomModal" . $row;
                                        $addressParts = explode('@', $washroom['address']);
                                        $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Public Area';
                                        $statusClass = strtolower($washroom['washroomcondition']) == 'good' ? 'status-good' : (strtolower($washroom['washroomcondition']) == 'fair' ? 'status-fair' : 'status-poor');
                                        ?>
                                        <!-- Enhanced Washroom Card -->
                                        <div class="col-12">
                                            <div class="service-card h-100 position-relative">
                                                <!-- Washroom Image Container -->


                                                <!-- Washroom Content -->
                                                <div class="service-content">
                                                    <div class="service-header">
                                                        <div class="service-main-info">
                                                            <h4 class="service-name">Public Washrooms</h4>
                                                            <div class="service-location"><?php echo $fullAddress; ?></div>
                                                            <span class="service-type">Public Facilities</span>
                                                        </div>

                                                        <div class="service-status">
                                                            <div class="status-indicator" style="background: <?php echo strtolower($washroom['washroomcondition']) == 'good' ? '#28a745' : (strtolower($washroom['washroomcondition']) == 'fair' ? '#ffc107' : '#dc3545'); ?>;"></div>
                                                            <span class="status-text"><?php echo htmlspecialchars($washroom['washroomcondition']); ?></span>
                                                        </div>
                                                    </div>

                                                    <!-- Washroom Quick Details -->
                                                    <div class="service-details-grid">
                                                        <div class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71;">
                                                                <i class="fas fa-users"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Facilities</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($washroom['numberofwashrooms']); ?> units</div>
                                                            </div>
                                                        </div>

                                                        <div class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                                                                <i class="fas fa-venetian-mask"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($washroom['facilitytype']); ?></div>
                                                            </div>
                                                        </div>

                                                        <div class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Location</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($washroom['locationdescription']); ?></div>
                                                            </div>
                                                        </div>

                                                        <?php if (!empty($washroom['phoneno'])): ?>
                                                            <div class="detail-item">
                                                                <div class="detail-icon" style="background: rgba(231, 76, 60, 0.1); color: #e74c3c;">
                                                                    <i class="fas fa-phone"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Support</h6>
                                                                    <div class="detail-value">
                                                                        <a href="tel:<?php echo htmlspecialchars($washroom['phoneno']); ?>" style="color: #6c757d; text-decoration: none;">
                                                                            <?php echo htmlspecialchars($washroom['phoneno']); ?>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <!-- Washroom Read More Button -->
                                                    <div style="margin-top: auto;">
                                                        <button class="read-more-btn" onclick="openWashroomModal('<?php echo $washroomModalId; ?>')">
                                                            <i class="fas fa-info-circle"></i>
                                                            <span>Facility Details</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Drainage Modals -->
        <?php if (!empty($drainage_result) && $drainage_result != "No Data Found!"): ?>
            <?php foreach ($drainage_result as $row => $drainage): ?>
                <?php
                $drainageModalId = "drainageModal" . $row;
                $addressParts = explode('@', $drainage['address']);
                $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Village Area';
                $photos = json_decode($drainage['photo'] ?? '[]', true);
                $photoGallery = is_array($photos) ? array_slice($photos, 0, 4) : [];
                ?>
                <!-- Enhanced Drainage Modal -->
                <div id="<?php echo $drainageModalId; ?>" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeDrainageModal('<?php echo $drainageModalId; ?>')">&times;</span>

                        <div class="modal-body">
                            <!-- Modal Header -->
                            <div class="service-modal-header">
                                <h1 class="service-modal-name">Drainage System Information</h1>
                                <div class="service-modal-subtitle">
                                    <span class="me-3">
                                        <i class="fas fa-map-pin me-1 text-muted"></i>
                                        <?php echo $fullAddress; ?>
                                    </span>
                                    <span class="me-3">
                                        <i class="fas fa-expand-arrows-alt me-1 text-primary"></i>
                                        <?php echo htmlspecialchars($drainage['coveragearea']); ?> sqm Coverage
                                    </span>
                                    <span class="<?php echo $statusClass; ?> status-badge">
                                        <i class="fas fa-info-circle me-1"></i>
                                        <?php echo htmlspecialchars($drainage['systemcondition']); ?> Condition
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Left Column - Main Info -->
                                <div class="col-lg-8">
                                    <!-- Photo Gallery -->
                                    <?php if (!empty($photoGallery)): ?>
                                        <div class="mb-4">
                                            <h5 class="mb-3">
                                                <i class="fas fa-images me-2 text-primary"></i>
                                                Infrastructure Gallery
                                            </h5>
                                            <div class="gallery-grid">
                                                <?php foreach ($photoGallery as $photo): ?>
                                                    <div class="gallery-item" onclick="openPhotoModal('./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>')">
                                                        <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>"
                                                            alt="Drainage Infrastructure"
                                                            loading="lazy">
                                                        <div class="gallery-overlay">
                                                            <i class="fas fa-expand-arrows-alt"></i>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Drainage Details -->
                                    <div class="modal-detail-section mb-4">
                                        <h5>
                                            <i class="fas fa-info-circle me-2 text-info"></i>
                                            System Information
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="detail-list">
                                                    <li class="detail-item">
                                                        <div class="detail-icon">
                                                            <i class="fas fa-tint-drop"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>System Type</h6>
                                                            <div class="detail-value"><?php echo htmlspecialchars($drainage['type']); ?></div>
                                                        </div>
                                                    </li>
                                                    <li class="detail-item">
                                                        <div class="detail-icon">
                                                            <i class="fas fa-expand-arrows-alt"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Coverage Area</h6>
                                                            <div class="detail-value"><?php echo htmlspecialchars($drainage['coveragearea']); ?> sqm</div>
                                                        </div>
                                                    </li>
                                                    <li class="detail-item">
                                                        <div class="detail-icon">
                                                            <i class="fas fa-cube"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Capacity</h6>
                                                            <div class="detail-value"><?php echo htmlspecialchars($drainage['capacity']); ?> m³</div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="detail-list">
                                                    <li class="detail-item">
                                                        <div class="detail-icon">
                                                            <i class="fas fa-calendar-check"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Established</h6>
                                                            <div class="detail-value"><?php echo !empty($drainage['establisheddate']) ? date('M Y', strtotime($drainage['establisheddate'])) : 'Not specified'; ?></div>
                                                        </div>
                                                    </li>
                                                    <li class="detail-item">
                                                        <div class="detail-icon">
                                                            <i class="fas fa-tools"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Last Maintenance</h6>
                                                            <div class="detail-value"><?php echo !empty($drainage['lastmaintenancedate']) ? date('M Y', strtotime($drainage['lastmaintenancedate'])) : 'Not specified'; ?></div>
                                                        </div>
                                                    </li>
                                                    <?php if (!empty($drainage['issuesreported'])): ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-exclamation-triangle"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Current Issues</h6>
                                                                <div class="detail-value"><?php echo nl2br(htmlspecialchars($drainage['issuesreported'])); ?></div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Maintenance History -->
                                    <?php if (!empty($drainage['maintenancehistory'])): ?>
                                        <div class="modal-detail-section">
                                            <h5>
                                                <i class="fas fa-history me-2 text-warning"></i>
                                                Maintenance History
                                            </h5>
                                            <div class="detail-value" style="color: #495057; line-height: 1.6;">
                                                <?php echo nl2br(htmlspecialchars($drainage['maintenancehistory'])); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Right Column - Contact & Actions -->
                                <div class="col-lg-4">
                                    <!-- Contact Section -->
                                    <?php if (!empty($drainage['phoneno'])): ?>
                                        <div class="contact-section mb-4">
                                            <div class="contact-header">
                                                <div class="contact-icon">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                                <h5 class="contact-title">Report Issues</h5>
                                            </div>
                                            <p class="text-warning mb-3">For drainage issues, blockages, or maintenance requests:</p>
                                            <div class="contact-options">
                                                <a href="tel:<?php echo htmlspecialchars($drainage['phoneno']); ?>" class="contact-option">
                                                    <i class="fas fa-phone me-2"></i>Call Support
                                                </a>
                                                <a href="contact.php" class="contact-option">
                                                    <i class="fas fa-envelope me-2"></i>Send Report
                                                </a>
                                                <button class="contact-option" onclick="shareService('Drainage System', '<?php echo urlencode($fullAddress); ?>')">
                                                    <i class="fas fa-share-alt me-2"></i>Share Info
                                                </button>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Contact Information -->
                                    <div class="modal-detail-section mb-4">
                                        <h5>
                                            <i class="fas fa-address-book me-2 text-success"></i>
                                            Management Information
                                        </h5>
                                        <ul class="detail-list">
                                            <?php if (!empty($drainage['entityname'])): ?>
                                                <li class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                        <i class="fas fa-building"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Entity</h6>
                                                        <div class="detail-value"><?php echo htmlspecialchars($drainage['entityname']); ?></div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>

                                            <?php if (!empty($drainage['entitytype'])): ?>
                                                <li class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
                                                        <i class="fas fa-layer-group"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Type</h6>
                                                        <div class="detail-value"><?php echo htmlspecialchars($drainage['entitytype']); ?></div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>

                                            <?php if (!empty($drainage['primarycontactperson'])): ?>
                                                <li class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                                                        <i class="fas fa-user-tie"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Contact Person</h6>
                                                        <div class="detail-value"><?php echo htmlspecialchars($drainage['primarycontactperson']); ?></div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>

                                            <li class="detail-item">
                                                <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </div>
                                                <div class="detail-content">
                                                    <h6>Address</h6>
                                                    <div class="detail-value"><?php echo nl2br(htmlspecialchars($fullAddress)); ?></div>
                                                </div>
                                            </li>

                                            <?php if (!empty($drainage['phoneno'])): ?>
                                                <li class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(231, 76, 60, 0.1); color: #e74c3c;">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Phone</h6>
                                                        <div class="detail-value">
                                                            <a href="tel:<?php echo htmlspecialchars($drainage['phoneno']); ?>" class="text-decoration-none">
                                                                <i class="fas fa-phone me-1"></i>
                                                                <?php echo htmlspecialchars($drainage['phoneno']); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>

                                            <?php if (!empty($drainage['fundingsource'])): ?>
                                                <li class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71;">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Funding</h6>
                                                        <div class="detail-value"><?php echo htmlspecialchars($drainage['fundingsource']); ?></div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>

                                    <!-- Quick Actions -->
                                    <div class="sticky-top" style="top: 20px;">
                                        <div class="card border-0 shadow-sm rounded-3 mb-3">
                                            <div class="card-header" style="background: var(--infrastructure-gradient); color: white; padding: 1rem; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                                <h6 class="mb-0 fw-semibold">
                                                    <i class="fas fa-tools me-2"></i>
                                                    Quick Actions
                                                </h6>
                                            </div>
                                            <div class="card-body p-3 mt-3">
                                                <div class="d-grid gap-2">
                                                    <?php if (!empty($drainage['phoneno'])): ?>
                                                        <a href="tel:<?php echo htmlspecialchars($drainage['phoneno']); ?>" class="btn btn-outline-success rounded-pill py-2">
                                                            <i class="fas fa-phone me-2"></i>Report Issue
                                                        </a>
                                                    <?php endif; ?>

                                                    <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-info rounded-pill py-2">
                                                        <i class="fas fa-map me-2"></i>View on Map
                                                    </a>

                                                    <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareService('Drainage System', '<?php echo urlencode($fullAddress); ?>')">
                                                        <i class="fas fa-share-alt me-2"></i>Share Information
                                                    </button>

                                                    <a href="contact.php" class="btn btn-outline-primary rounded-pill py-2">
                                                        <i class="fas fa-envelope me-2"></i>Contact Municipality
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Enhanced Water Supply Modals -->
            <?php if (!empty($watersupply_result) && $watersupply_result != "No Data Found!"): ?>
                <?php foreach ($watersupply_result as $row => $watersupply): ?>
                    <?php
                    $watersupplyModalId = "watersupplyModal" . $row;
                    $addressParts = explode('@', $watersupply['address']);
                    $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Village Area';
                    $photos = json_decode($watersupply['photo'] ?? '[]', true);
                    $photoGallery = is_array($photos) ? array_slice($photos, 0, 4) : [];
                    $timeArray = json_decode($watersupply['watersupplyschedule'], true);
                    ?>
                    <!-- Enhanced Water Supply Modal -->
                    <div id="<?php echo $watersupplyModalId; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeWaterSupplyModal('<?php echo $watersupplyModalId; ?>')">&times;</span>

                            <div class="modal-body">
                                <!-- Modal Header -->
                                <div class="service-modal-header">
                                    <h1 class="service-modal-name">Water Supply Information</h1>
                                    <div class="service-modal-subtitle">
                                        <span class="me-3">
                                            <i class="fas fa-map-pin me-1 text-muted"></i>
                                            <?php echo $fullAddress; ?>
                                        </span>
                                        <span class="me-3">
                                            <i class="fas fa-tint me-1 text-primary"></i>
                                            <?php echo htmlspecialchars($watersupply['capacity']); ?> L Capacity
                                        </span>
                                        <span class="<?php echo strtolower($watersupply['systemcondition']) == 'good' ? 'status-good' : (strtolower($watersupply['systemcondition']) == 'fair' ? 'status-fair' : 'status-poor'); ?> status-badge">
                                            <i class="fas fa-info-circle me-1"></i>
                                            <?php echo htmlspecialchars($watersupply['systemcondition']); ?> Condition
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Left Column - Main Info -->
                                    <div class="col-lg-8">
                                        <!-- Photo Gallery -->
                                        <?php if (!empty($photoGallery)): ?>
                                            <div class="mb-4">
                                                <h5 class="mb-3">
                                                    <i class="fas fa-images me-2 text-primary"></i>
                                                    Infrastructure Gallery
                                                </h5>
                                                <div class="gallery-grid">
                                                    <?php foreach ($photoGallery as $photo): ?>
                                                        <div class="gallery-item" onclick="openPhotoModal('./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>')">
                                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>"
                                                                alt="Water Supply Infrastructure"
                                                                loading="lazy">
                                                            <div class="gallery-overlay">
                                                                <i class="fas fa-expand-arrows-alt"></i>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Water Supply Details -->
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-info-circle me-2 text-info"></i>
                                                System Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-tint"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Source Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($watersupply['sourcetype']); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-align-left"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Description</h6>
                                                                <div class="detail-value"><?php echo nl2br(htmlspecialchars($watersupply['sourcedescription'])); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-cube"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Capacity</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($watersupply['capacity']); ?> L</div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-calendar-check"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Installed</h6>
                                                                <div class="detail-value"><?php echo !empty($watersupply['installationdate']) ? date('M Y', strtotime($watersupply['installationdate'])) : 'Not specified'; ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-tools"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Last Maintenance</h6>
                                                                <div class="detail-value"><?php echo !empty($watersupply['lastmaintenancedate']) ? date('M Y', strtotime($watersupply['lastmaintenancedate'])) : 'Not specified'; ?></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Water Supply Schedule -->
                                        <div class="schedule-container mb-4">
                                            <h5 class="mb-3">
                                                <i class="fas fa-clock me-2 text-warning"></i>
                                                Daily Supply Schedule
                                            </h5>
                                            <div class="schedule-grid">
                                                <div class="schedule-item">
                                                    <div class="schedule-time"><?php echo $timeArray['MorningStart'] ?? 'N/A'; ?> - <?php echo $timeArray['MorningEnd'] ?? 'N/A'; ?></div>
                                                    <div class="schedule-label">Morning Supply</div>
                                                </div>
                                                <div class="schedule-item">
                                                    <div class="schedule-time"><?php echo $timeArray['AfternoonStart'] ?? 'N/A'; ?> - <?php echo $timeArray['AfternoonEnd'] ?? 'N/A'; ?></div>
                                                    <div class="schedule-label">Afternoon Supply</div>
                                                </div>
                                                <div class="schedule-item">
                                                    <div class="schedule-time"><?php echo $timeArray['EveningStart'] ?? 'N/A'; ?> - <?php echo $timeArray['EveningEnd'] ?? 'N/A'; ?></div>
                                                    <div class="schedule-label">Evening Supply</div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <small class="text-muted">* Schedule may vary due to maintenance or demand</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column - Contact & Actions -->
                                    <div class="col-lg-4">
                                        <!-- Contact Section -->
                                        <?php if (!empty($watersupply['contactphone'])): ?>
                                            <div class="contact-section mb-4">
                                                <div class="contact-header">
                                                    <div class="contact-icon">
                                                        <i class="fas fa-faucet-drip"></i>
                                                    </div>
                                                    <h5 class="contact-title">Water Issues</h5>
                                                </div>
                                                <p class="text-warning mb-3">For low pressure, contamination, or supply interruptions:</p>
                                                <div class="contact-options">
                                                    <a href="tel:<?php echo htmlspecialchars($watersupply['contactphone']); ?>" class="contact-option">
                                                        <i class="fas fa-phone me-2"></i>Call Support
                                                    </a>
                                                    <a href="contact.php" class="contact-option">
                                                        <i class="fas fa-envelope me-2"></i>Send Report
                                                    </a>
                                                    <button class="contact-option" onclick="shareService('Water Supply', '<?php echo urlencode($fullAddress); ?>')">
                                                        <i class="fas fa-share-alt me-2"></i>Share Schedule
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Contact Information -->
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-address-book me-2 text-success"></i>
                                                Management Information
                                            </h5>
                                            <ul class="detail-list">
                                                <?php if (!empty($watersupply['entityname'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                            <i class="fas fa-building"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Entity</h6>
                                                            <div class="detail-value"><?php echo htmlspecialchars($watersupply['entityname']); ?></div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($watersupply['entitytype'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
                                                            <i class="fas fa-layer-group"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Type</h6>
                                                            <div class="detail-value"><?php echo htmlspecialchars($watersupply['entitytype']); ?></div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($watersupply['contactperson'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                                                            <i class="fas fa-user-tie"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Contact Person</h6>
                                                            <div class="detail-value"><?php echo htmlspecialchars($watersupply['contactperson']); ?></div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>

                                                <li class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Address</h6>
                                                        <div class="detail-value"><?php echo nl2br(htmlspecialchars($fullAddress)); ?></div>
                                                    </div>
                                                </li>

                                                <?php if (!empty($watersupply['contactphone'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(231, 76, 60, 0.1); color: #e74c3c;">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Phone</h6>
                                                            <div class="detail-value">
                                                                <a href="tel:<?php echo htmlspecialchars($watersupply['contactphone']); ?>" class="text-decoration-none">
                                                                    <i class="fas fa-phone me-1"></i>
                                                                    <?php echo htmlspecialchars($watersupply['contactphone']); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($watersupply['fundingsource'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71;">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Funding</h6>
                                                            <div class="detail-value"><?php echo htmlspecialchars($watersupply['fundingsource']); ?></div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>

                                        <!-- Quick Actions -->
                                        <div class="sticky-top" style="top: 20px;">
                                            <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                <div class="card-header" style="background: var(--infrastructure-gradient); color: white; padding: 1rem; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="fas fa-faucet me-2"></i>
                                                        Quick Actions
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3 mt-3">
                                                    <div class="d-grid gap-2">
                                                        <?php if (!empty($watersupply['contactphone'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($watersupply['contactphone']); ?>" class="btn btn-outline-success rounded-pill py-2">
                                                                <i class="fas fa-phone me-2"></i>Report Water Issue
                                                            </a>
                                                        <?php endif; ?>

                                                        <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-info rounded-pill py-2">
                                                            <i class="fas fa-map me-2"></i>View on Map
                                                        </a>

                                                        <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareService('Water Supply', '<?php echo urlencode($fullAddress); ?>')">
                                                            <i class="fas fa-share-alt me-2"></i>Share Schedule
                                                        </button>

                                                        <a href="contact.php" class="btn btn-outline-primary rounded-pill py-2">
                                                            <i class="fas fa-envelope me-2"></i>Contact Water Board
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Enhanced Washroom Modals -->
                <?php if (!empty($washrooms_result) && $washrooms_result != "No Data Found!"): ?>
                    <?php foreach ($washrooms_result as $row => $washroom): ?>
                        <?php
                        $washroomModalId = "washroomModal" . $row;
                        $addressParts = explode('@', $washroom['address']);
                        $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Public Area';
                        $photos = json_decode($washroom['photo'] ?? '[]', true);
                        $photoGallery = is_array($photos) ? array_slice($photos, 0, 4) : [];
                        ?>
                        <!-- Enhanced Washroom Modal -->
                        <div id="<?php echo $washroomModalId; ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeWashroomModal('<?php echo $washroomModalId; ?>')">&times;</span>

                                <div class="modal-body">
                                    <!-- Modal Header -->
                                    <div class="service-modal-header">
                                        <h1 class="service-modal-name">Public Washroom Facilities</h1>
                                        <div class="service-modal-subtitle">
                                            <span class="me-3">
                                                <i class="fas fa-map-pin me-1 text-muted"></i>
                                                <?php echo $fullAddress; ?>
                                            </span>
                                            <span class="me-3">
                                                <i class="fas fa-restroom me-1 text-primary"></i>
                                                <?php echo htmlspecialchars($washroom['numberofwashrooms']); ?> Facilities
                                            </span>
                                            <span class="<?php echo strtolower($washroom['washroomcondition']) == 'good' ? 'status-good' : (strtolower($washroom['washroomcondition']) == 'fair' ? 'status-fair' : 'status-poor'); ?> status-badge">
                                                <i class="fas fa-info-circle me-1"></i>
                                                <?php echo htmlspecialchars($washroom['washroomcondition']); ?> Condition
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Left Column - Main Info -->
                                        <div class="col-lg-8">
                                            <!-- Photo Gallery -->
                                            <?php if (!empty($photoGallery)): ?>
                                                <div class="mb-4">
                                                    <h5 class="mb-3">
                                                        <i class="fas fa-images me-2 text-primary"></i>
                                                        Facility Gallery
                                                    </h5>
                                                    <div class="gallery-grid">
                                                        <?php foreach ($photoGallery as $photo): ?>
                                                            <div class="gallery-item" onclick="openPhotoModal('./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>')">
                                                                <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>"
                                                                    alt="Washroom Facility"
                                                                    loading="lazy">
                                                                <div class="gallery-overlay">
                                                                    <i class="fas fa-expand-arrows-alt"></i>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <!-- Washroom Details -->
                                            <div class="modal-detail-section mb-4">
                                                <h5>
                                                    <i class="fas fa-info-circle me-2 text-info"></i>
                                                    Facility Information
                                                </h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul class="detail-list">
                                                            <li class="detail-item">
                                                                <div class="detail-icon">
                                                                    <i class="fas fa-restroom"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Facility Type</h6>
                                                                    <div class="detail-value"><?php echo htmlspecialchars($washroom['facilitytype']); ?></div>
                                                                </div>
                                                            </li>
                                                            <li class="detail-item">
                                                                <div class="detail-icon">
                                                                    <i class="fas fa-users"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Number of Units</h6>
                                                                    <div class="detail-value"><?php echo htmlspecialchars($washroom['numberofwashrooms']); ?></div>
                                                                </div>
                                                            </li>
                                                            <li class="detail-item">
                                                                <div class="detail-icon">
                                                                    <i class="fas fa-map-marker-alt"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Location</h6>
                                                                    <div class="detail-value"><?php echo htmlspecialchars($washroom['locationdescription']); ?></div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <ul class="detail-list">
                                                            <li class="detail-item">
                                                                <div class="detail-icon">
                                                                    <i class="fas fa-calendar-check"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Established</h6>
                                                                    <div class="detail-value"><?php echo !empty($washroom['establisheddate']) ? date('M Y', strtotime($washroom['establisheddate'])) : 'Not specified'; ?></div>
                                                                </div>
                                                            </li>
                                                            <li class="detail-item">
                                                                <div class="detail-icon">
                                                                    <i class="fas fa-tools"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Maintenance</h6>
                                                                    <div class="detail-value"><?php echo htmlspecialchars($washroom['maintenanceschedule']); ?></div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Maintenance Schedule -->
                                            <?php if (!empty($washroom['maintenanceschedule'])): ?>
                                                <div class="modal-detail-section">
                                                    <h5>
                                                        <i class="fas fa-calendar-alt me-2 text-warning"></i>
                                                        Maintenance Schedule
                                                    </h5>
                                                    <div class="detail-value" style="color: #495057; line-height: 1.6;">
                                                        <?php echo nl2br(htmlspecialchars($washroom['maintenanceschedule'])); ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Right Column - Contact & Actions -->
                                        <div class="col-lg-4">
                                            <!-- Contact Section -->
                                            <?php if (!empty($washroom['phoneno'])): ?>
                                                <div class="contact-section mb-4">
                                                    <div class="contact-header">
                                                        <div class="contact-icon">
                                                            <i class="fas fa-restroom"></i>
                                                        </div>
                                                        <h5 class="contact-title">Facility Support</h5>
                                                    </div>
                                                    <p class="text-warning mb-3">For cleanliness issues, maintenance, or accessibility concerns:</p>
                                                    <div class="contact-options">
                                                        <a href="tel:<?php echo htmlspecialchars($washroom['phoneno']); ?>" class="contact-option">
                                                            <i class="fas fa-phone me-2"></i>Call Support
                                                        </a>
                                                        <a href="contact.php" class="contact-option">
                                                            <i class="fas fa-envelope me-2"></i>Send Report
                                                        </a>
                                                        <button class="contact-option" onclick="shareService('Public Washrooms', '<?php echo urlencode($fullAddress); ?>')">
                                                            <i class="fas fa-share-alt me-2"></i>Share Location
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <!-- Contact Information -->
                                            <div class="modal-detail-section mb-4">
                                                <h5>
                                                    <i class="fas fa-address-book me-2 text-success"></i>
                                                    Management Information
                                                </h5>
                                                <ul class="detail-list">
                                                    <?php if (!empty($washroom['entityname'])): ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                                <i class="fas fa-building"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Entity</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($washroom['entityname']); ?></div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if (!empty($washroom['entitytype'])): ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
                                                                <i class="fas fa-layer-group"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($washroom['entitytype']); ?></div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if (!empty($washroom['primarycontactperson'])): ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(155, 89, 182, 0.1); color: #9b59b6;">
                                                                <i class="fas fa-user-tie"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Contact Person</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($washroom['primarycontactperson']); ?></div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>

                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Address</h6>
                                                            <div class="detail-value"><?php echo nl2br(htmlspecialchars($fullAddress)); ?></div>
                                                        </div>
                                                    </li>

                                                    <?php if (!empty($washroom['phoneno'])): ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(231, 76, 60, 0.1); color: #e74c3c;">
                                                                <i class="fas fa-phone"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Phone</h6>
                                                                <div class="detail-value">
                                                                    <a href="tel:<?php echo htmlspecialchars($washroom['phoneno']); ?>" class="text-decoration-none">
                                                                        <i class="fas fa-phone me-1"></i>
                                                                        <?php echo htmlspecialchars($washroom['phoneno']); ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if (!empty($washroom['fundingsource'])): ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71;">
                                                                <i class="fas fa-dollar-sign"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Funding</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($washroom['fundingsource']); ?></div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>

                                            <!-- Quick Actions -->
                                            <div class="sticky-top" style="top: 20px;">
                                                <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                    <div class="card-header" style="background: var(--infrastructure-gradient); color: white; padding: 1rem; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                                        <h6 class="mb-0 fw-semibold">
                                                            <i class="fas fa-restroom me-2"></i>
                                                            Quick Actions
                                                        </h6>
                                                    </div>
                                                    <div class="card-body p-3 mt-3">
                                                        <div class="d-grid gap-2">
                                                            <?php if (!empty($washroom['phoneno'])): ?>
                                                                <a href="tel:<?php echo htmlspecialchars($washroom['phoneno']); ?>" class="btn btn-outline-success rounded-pill py-2">
                                                                    <i class="fas fa-phone me-2"></i>Report Cleanliness Issue
                                                                </a>
                                                            <?php endif; ?>

                                                            <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-info rounded-pill py-2">
                                                                <i class="fas fa-map me-2"></i>Get Directions
                                                            </a>

                                                            <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareService('Public Washrooms', '<?php echo urlencode($fullAddress); ?>')">
                                                                <i class="fas fa-share-alt me-2"></i>Share Location
                                                            </button>

                                                            <a href="contact.php" class="btn btn-outline-primary rounded-pill py-2">
                                                                <i class="fas fa-envelope me-2"></i>Contact Municipality
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        </div>
                    </div>

                    <!-- Photo Modal -->
                    <div id="photoModal" class="modal">
                        <div class="modal-content photo-modal">
                            <span class="close" onclick="closePhotoModal()">&times;</span>
                            <div class="photo-container">
                                <img id="modalPhoto" src="" alt="Full size image">
                                <div class="photo-nav">
                                    <button id="prevPhoto" onclick="prevPhoto()" class="btn-nav"><i class="fas fa-chevron-left"></i></button>
                                    <button id="nextPhoto" onclick="nextPhoto()" class="btn-nav"><i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Starts Here -->
                    <?php include "footer.php"; ?>
                    <!--footer ends here-->

                    <!-- Scripts -->
                    <script src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
                    <script src="assets/vendor/jquery/jquery.min.js"></script>
                    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
                    <script src="assets/vendor/owl-carousel/owl.carousel.min.js"></script>
                    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
                    <script src="assets/vendor/counter-up/jquery.counterup.min.js"></script>
                    <script src="assets/vendor/youtube-popup/youtube-popup.jquery.js"></script>
                    <script src="assets/js/theme.js"></script>

                    <script>
                        // Enhanced Modal Functions
                        function openDrainageModal(modalId) {
                            const modal = document.getElementById(modalId);
                            modal.style.display = "block";
                            document.body.style.overflow = "hidden";
                            modal.classList.add('show');
                            setTimeout(() => modal.classList.remove('show'), 300);
                        }

                        function closeDrainageModal(modalId) {
                            const modal = document.getElementById(modalId);
                            modal.style.display = "none";
                            document.body.style.overflow = "auto";
                        }

                        function openWaterSupplyModal(modalId) {
                            const modal = document.getElementById(modalId);
                            modal.style.display = "block";
                            document.body.style.overflow = "hidden";
                            modal.classList.add('show');
                            setTimeout(() => modal.classList.remove('show'), 300);
                        }

                        function closeWaterSupplyModal(modalId) {
                            const modal = document.getElementById(modalId);
                            modal.style.display = "none";
                            document.body.style.overflow = "auto";
                        }

                        function openWashroomModal(modalId) {
                            const modal = document.getElementById(modalId);
                            modal.style.display = "block";
                            document.body.style.overflow = "hidden";
                            modal.classList.add('show');
                            setTimeout(() => modal.classList.remove('show'), 300);
                        }

                        function closeWashroomModal(modalId) {
                            const modal = document.getElementById(modalId);
                            modal.style.display = "none";
                            document.body.style.overflow = "auto";
                        }

                        // Photo Modal Functions
                        let currentPhotoIndex = 0;
                        let photoGallery = [];

                        function openPhotoModal(imageSrc) {
                            const modal = document.getElementById('photoModal');
                            const modalImg = document.getElementById('modalPhoto');
                            modalImg.src = imageSrc;
                            modal.style.display = "block";
                            document.body.style.overflow = "hidden";
                        }

                        function closePhotoModal() {
                            document.getElementById('photoModal').style.display = "none";
                            document.body.style.overflow = "auto";
                        }

                        function prevPhoto() {
                            currentPhotoIndex = Math.max(0, currentPhotoIndex - 1);
                            document.getElementById('modalPhoto').src = photoGallery[currentPhotoIndex];
                        }

                        function nextPhoto() {
                            currentPhotoIndex = Math.min(photoGallery.length - 1, currentPhotoIndex + 1);
                            document.getElementById('modalPhoto').src = photoGallery[currentPhotoIndex];
                        }

                        // Share Function
                        function shareService(serviceName, address) {
                            if (navigator.share) {
                                navigator.share({
                                    title: serviceName + ' - Village Municipal Services',
                                    text: 'Check out our village infrastructure services!',
                                    url: window.location.href
                                }).catch(console.error);
                            } else {
                                navigator.clipboard.writeText(`${serviceName}\n📍 ${address}\n${window.location.origin}`).then(() => {
                                    showToast('Service details copied to clipboard!', 'success');
                                }).catch(() => {
                                    showToast('Could not copy to clipboard', 'error');
                                });
                            }
                        }

                        // Toast Notification
                        function showToast(message, type = 'info') {
                            const toast = document.createElement('div');
                            toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
                            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; border-radius: 10px;';
                            toast.innerHTML = `
                                    <div class="d-flex">
                                        <div class="alert-icon me-3">
                                            <i class="fas fa-${type === 'success' ? 'check-circle' : (type === 'error' ? 'exclamation-triangle' : 'info-circle')} fa-lg"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <strong>${type === 'success' ? 'Success!' : (type === 'error' ? 'Error!' : 'Info')} </strong>${message}
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                `;

                            document.body.appendChild(toast);

                            setTimeout(() => {
                                const bsAlert = new bootstrap.Alert(toast);
                                bsAlert.close();
                            }, 3000);
                        }

                        // Enhanced modal close on outside click
                        window.onclick = function(event) {
                            const modals = document.querySelectorAll('.modal');
                            modals.forEach(modal => {
                                if (event.target === modal) {
                                    modal.style.display = "none";
                                    document.body.style.overflow = "auto";
                                }
                            });
                        }

                        // Keyboard navigation
                        document.addEventListener('keydown', function(event) {
                            if (event.key === 'Escape') {
                                const modals = document.querySelectorAll('.modal');
                                modals.forEach(modal => {
                                    if (modal.style.display === 'block') {
                                        modal.style.display = 'none';
                                        document.body.style.overflow = 'auto';
                                    }
                                });
                            }
                        });

                        // Smooth scroll to sections
                        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                            anchor.addEventListener('click', function(e) {
                                e.preventDefault();
                                const target = document.querySelector(this.getAttribute('href'));
                                if (target) {
                                    target.scrollIntoView({
                                        behavior: 'smooth',
                                        block: 'start'
                                    });
                                }
                            });
                        });

                        // Tab switching with smooth transitions
                        document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
                            tab.addEventListener('shown.bs.tab', function(e) {
                                const targetPane = document.querySelector(e.target.getAttribute('data-bs-target'));
                                if (targetPane) {
                                    targetPane.style.opacity = '0';
                                    targetPane.style.transform = 'translateY(20px)';
                                    setTimeout(() => {
                                        targetPane.style.transition = 'all 0.3s ease';
                                        targetPane.style.opacity = '1';
                                        targetPane.style.transform = 'translateY(0)';
                                    }, 100);
                                }
                            });
                        });

                        // Lazy loading for images
                        if ('IntersectionObserver' in window) {
                            const imageObserver = new IntersectionObserver((entries, observer) => {
                                entries.forEach(entry => {
                                    if (entry.isIntersecting) {
                                        const img = entry.target;
                                        img.src = img.dataset.src;
                                        img.classList.remove('lazy');
                                        imageObserver.unobserve(img);
                                    }
                                });
                            });

                            document.querySelectorAll('img[data-src]').forEach(img => {
                                imageObserver.observe(img);
                            });
                        }

                        // Initialize tooltips
                        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                            return new bootstrap.Tooltip(tooltipTriggerEl);
                        });

                        // Add loading animation to tabs on initial load
                        document.addEventListener('DOMContentLoaded', function() {
                            const tabPanes = document.querySelectorAll('.tab-pane');
                            tabPanes.forEach(pane => {
                                if (!pane.classList.contains('active')) {
                                    pane.style.opacity = '0';
                                    pane.style.transform = 'translateY(20px)';
                                }
                            });
                        });
                    </script>

                    <!-- Photo Modal Styles -->
                    <style>
                        .photo-modal {
                            max-width: 90vw;
                            max-height: 90vh;
                            width: auto;
                            height: auto;
                            margin: auto;
                            background: rgba(0, 0, 0, 0.95);
                        }

                        .photo-container {
                            position: relative;
                            width: 100%;
                            height: 80vh;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }

                        #modalPhoto {
                            max-width: 100%;
                            max-height: 100%;
                            object-fit: contain;
                            border-radius: 8px;
                            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
                        }

                        .photo-nav {
                            position: absolute;
                            top: 50%;
                            width: 100%;
                            display: flex;
                            justify-content: space-between;
                            padding: 0 1rem;
                            transform: translateY(-50%);
                            pointer-events: none;
                        }

                        .btn-nav {
                            background: rgba(0, 0, 0, 0.5);
                            color: white;
                            border: none;
                            width: 50px;
                            height: 50px;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            cursor: pointer;
                            transition: var(--transition);
                            pointer-events: all;
                            font-size: 1.25rem;
                        }

                        .btn-nav:hover {
                            background: rgba(0, 0, 0, 0.8);
                            transform: scale(1.1);
                        }

                        @media (max-width: 768px) {
                            .photo-container {
                                height: 70vh;
                            }

                            .btn-nav {
                                width: 40px;
                                height: 40px;
                                font-size: 1rem;
                            }
                        }
                    </style>

</body>

</html>