<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Public Transport || RuralConnect Web</title>
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
            --transport-gradient: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 20px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Transport Section */
        .transport-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
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
            background: var(--transport-gradient);
            border-radius: 2px;
        }

        .section-title p {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            font-family: 'Inter', sans-serif;
        }

        /* Modern Transport Cards */
        .transport-card-container {
            position: relative;
        }

        .transport-card {
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

        .transport-card:hover {
            transform: translateY(-12px) rotateX(2deg) rotateY(2deg);
            box-shadow: var(--card-shadow-hover);
        }

        .transport-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--transport-gradient);
            z-index: 2;
        }

        .transport-image-container {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .transport-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .transport-card:hover .transport-image {
            transform: scale(1.05);
        }

        .transport-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
            padding: 2rem 1.5rem 1.5rem;
            color: white;
            transform: translateY(100%);
            transition: var(--transition);
        }

        .transport-card:hover .transport-overlay {
            transform: translateY(0);
        }

        .station-name-overlay {
            font-family: 'Manrope', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .transport-type-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            color: white;
            display: inline-block;
        }

        /* Transport Card Content */
        .transport-content {
            padding: 1.75rem;
            position: relative;
        }

        .transport-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .transport-main-info {
            flex-grow: 1;
        }

        .station-name {
            font-family: 'Manrope', sans-serif;
            font-size: 1.375rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }

        .service-area {
            color: #6c757d;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .transport-type {
            background: var(--transport-gradient);
            color: white;
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .transport-status {
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

        /* Transport Details Grid */
        .transport-details-grid {
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
            background: rgba(0, 123, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #007bff;
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
            background: var(--transport-gradient);
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
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .transport-section {
                padding: 40px 0;
            }

            .section-title h1 {
                font-size: 2rem;
            }

            .transport-details-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .transport-content {
                padding: 1.25rem;
            }

            .station-name {
                font-size: 1.25rem;
            }

            .read-more-btn {
                width: 100%;
                justify-content: center;
            }

            .empty-state {
                padding: 2rem 1rem;
            }
        }

        @media (max-width: 576px) {
            .transport-card:hover {
                transform: translateY(-4px);
            }

            .transport-header {
                flex-direction: column;
                gap: 0.75rem;
                align-items: stretch;
            }

            .transport-status {
                justify-content: center;
            }
        }

        /* Modal Enhancements */
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
            max-width: 900px;
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

        .transport-modal-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(0, 0, 0, 0.08);
        }

        .transport-modal-name {
            font-family: 'Manrope', sans-serif;
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .transport-modal-subtitle {
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
            border-left: 4px solid #007bff;
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
            background: rgba(0, 123, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #007bff;
            font-size: 0.875rem;
            margin-top: 0.125rem;
        }

        .detail-label {
            font-weight: 500;
            color: #495057;
            min-width: 120px;
            font-size: 0.95rem;
        }

        .detail-value {
            color: #2c3e50;
            font-weight: 400;
            flex-grow: 1;
            line-height: 1.4;
        }

        /* Transport Services Display */
        .services-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 1.5rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .service-item {
            background: white;
            padding: 1rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
            border-left: 4px solid #007bff;
        }

        .service-icon {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 0.5rem;
        }

        .service-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.25rem;
        }

        .service-status {
            color: #28a745;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Emergency Contact Section */
        .emergency-section {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: 2px solid #ffc107;
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1.5rem 0;
        }

        .emergency-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .emergency-icon {
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

        .emergency-title {
            color: #856404;
            font-weight: 700;
            margin: 0;
            font-size: 1.25rem;
        }

        .emergency-phone {
            background: #dc3545;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            margin-top: 0.5rem;
            transition: var(--transition);
        }

        .emergency-phone:hover {
            background: #c82333;
            color: white;
            transform: translateY(-2px);
            text-decoration: none;
        }

        /* Ticket Badge */
        .ticket-badge {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            margin: 0.25rem;
        }

        .tickets-container {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 12px;
            margin-top: 1rem;
            border-left: 4px solid #007bff;
        }

        .tickets-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }

        /* Route Display */
        .route-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 1.5rem;
        }

        .route-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .route-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .route-item:last-child {
            border-bottom: none;
        }

        .route-icon {
            color: #007bff;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .route-details {
            flex-grow: 1;
        }

        .route-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.25rem;
        }

        .route-time {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Modal Responsive */
        @media (max-width: 768px) {
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

            .transport-modal-name {
                font-size: 1.75rem;
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
        }

        @media (max-width: 576px) {
            .transport-card:hover {
                transform: translateY(-4px);
            }

            .station-name {
                font-size: 1.125rem;
            }

            .transport-content {
                padding: 1rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Loading Animation for Images */
        .transport-image-loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            height: 220px;
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
    </style>

</head>

<body>

    <?php include "header.php"; ?>
    <!-- connection -->
    <?php
    include_once('admin/config.php');
    $obj = new ConnDb();
    $table = 'transport';
    $values = 'SELECT * FROM transport';

    $result = $obj->selectdata($table, $values);

    // Transport Station Data
    $station_values = 'SELECT * FROM transport';
    $station_result = $obj->selectdata($table, $station_values);
    ?>

    <div class="page-wrapper">
        <section class="page-banner">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Public Transport</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Transport</li>
                        </ol>
                    </nav>
                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section>
        <!--page-banner-->

        <!-- Transport Stations Section -->
        <section class="transport-section" style="background: rgba(248, 249, 250, 0.5);">
            <div class="container">
                <div class="section-title">
                    <h1>Transport Stations & Services</h1>
                    <p class="lead">Locate bus stands, railway stations, and transport hubs in your village area for easy travel and connectivity.</p>
                </div>

                <?php if (empty($station_result) || $station_result == "No Data Found!"): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-bus"></i>
                        </div>
                        <h3>No Transport Stations Found</h3>
                        <p>No bus stands, railway stations, or transport facilities are currently available in your village area.</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
                            <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                <i class="fas fa-envelope me-2"></i>Request Information
                            </a>
                            <a href="#transport-section" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="fas fa-arrow-up me-2"></i>View Providers
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row g-4 transport-card-container">
                        <?php foreach ($station_result as $row => $station): ?>
                            <?php if ($station['visibility'] == 'on'):
                                $stationModalId = "stationModal" . $row;
                                $addressParts = explode('@', $station['address']);
                                $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                            ?>
                                <!-- Enhanced Transport Station Card -->
                                <div class="col-lg-6 col-xl-4">
                                    <div class="transport-card h-100 position-relative" style="border-left: 4px solid #28a745;">
                                        <!-- Station Image Container -->
                                        <div class="transport-image-container" style="height: 200px;">
                                            <?php
                                            $photos = json_decode($station['photo'], true);
                                            $stationPhoto = !empty($photos) && is_array($photos) ? $photos[0] : 'assets/image/no-image-transport.jpg';
                                            ?>
                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($stationPhoto); ?>"
                                                class="transport-image"
                                                alt="<?php echo htmlspecialchars($station['stationname']); ?> Station"
                                                onerror="this.src='assets/image/no-image-transport.jpg'"
                                                loading="lazy">

                                            <!-- Station Overlay -->
                                            <div class="transport-overlay" style="background: linear-gradient(transparent, rgba(40, 167, 69, 0.9));">
                                                <h4 class="station-name-overlay"><?php echo htmlspecialchars($station['stationname']); ?> Station</h4>
                                                <span class="transport-type-badge" style="background: rgba(255, 255, 255, 0.3);">Transport Hub</span>
                                            </div>
                                        </div>

                                        <!-- Station Content -->
                                        <div class="transport-content">
                                            <div class="transport-header">
                                                <div class="transport-main-info">
                                                    <h4 class="station-name"><?php echo htmlspecialchars($station['stationname']); ?> Station</h4>
                                                    <div class="service-area"><?php echo htmlspecialchars($station['servicearea'] ?? 'Local Coverage'); ?></div>
                                                    <span class="transport-type" style="background: #28a745;"><?php echo htmlspecialchars($station['stationtype'] ?? 'Transport Hub'); ?></span>
                                                </div>

                                                <div class="transport-status">
                                                    <div class="status-indicator" style="background: #28a745;"></div>
                                                    <span class="status-text">Operational</span>
                                                </div>
                                            </div>

                                            <!-- Station Quick Details -->
                                            <div class="transport-details-grid">
                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Location</h6>
                                                        <div class="detail-value"><?php echo $fullAddress; ?></div>
                                                    </div>
                                                </div>

                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                        <i class="fas fa-bus"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Station Type</h6>
                                                        <div class="detail-value"><?php echo htmlspecialchars($station['stationtype'] ?? 'Multi-modal'); ?></div>
                                                    </div>
                                                </div>

                                                <?php if (!empty($station['contactno'])): ?>
                                                    <div class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Support</h6>
                                                            <div class="detail-value">
                                                                <a href="tel:<?php echo htmlspecialchars($station['contactno']); ?>" style="color: #6c757d; text-decoration: none;">
                                                                    <?php echo htmlspecialchars($station['contactno']); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                        <i class="fas fa-ticket-alt"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Ticketing</h6>
                                                        <div class="detail-value"><?php echo $station['ticketingprocess'] == "both" ? 'Online & Offline' : ucfirst($station['ticketingprocess']); ?></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Station Read More Button -->
                                            <div style="margin-top: auto;">
                                                <button class="read-more-btn" style="background: linear-gradient(135deg, #28a745, #20c997);" onclick="openStationModal('<?php echo $stationModalId; ?>')">
                                                    <i class="fas fa-bus"></i>
                                                    <span>Station Details</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Enhanced Transport Company Modals -->
        <?php if (!empty($result) && $result != "No Data Found!"): ?>
            <?php foreach ($result as $row => $company): ?>
                <?php if ($company['visibility'] == 'on'):
                    $modalId = "transportModal" . $row;
                    $addressParts = explode('@', $company['address']);
                    $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                    $photos = json_decode($company['photo'], true);
                    $photoGallery = is_array($photos) ? array_slice($photos, 0, 5) : [];
                ?>
                    <!-- Enhanced Transport Company Modal -->
                    <div id="<?php echo $modalId; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeTransportModal('<?php echo $modalId; ?>')">&times;</span>

                            <div class="modal-body">
                                <!-- Modal Header -->
                                <div class="transport-modal-header">
                                    <h1 class="transport-modal-name"><?php echo htmlspecialchars($company['stationname']); ?></h1>
                                    <div class="transport-modal-subtitle">
                                        <span class="me-3">
                                            <i class="fas fa-map-pin me-1 text-muted"></i>
                                            <?php echo $fullAddress; ?>
                                        </span>
                                        <span>
                                            <i class="fas fa-bus me-1 text-muted"></i>
                                            <?php echo htmlspecialchars($company['servicearea'] ?? 'Regional Coverage'); ?>
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
                                                    Gallery
                                                </h5>
                                                <div class="row g-2">
                                                    <?php foreach ($photoGallery as $photo): ?>
                                                        <div class="col-6 col-md-4">
                                                            <div class="position-relative overflow-hidden rounded-3 shadow-sm" style="aspect-ratio: 4/3; cursor: pointer;" onclick="openPhotoModal('./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>')">
                                                                <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>"
                                                                    class="w-100 h-100 object-fit-cover"
                                                                    alt="Transport Station Image"
                                                                    style="transition: transform 0.3s ease;"
                                                                    onmouseover="this.style.transform='scale(1.05)'"
                                                                    onmouseout="this.style.transform='scale(1)'">
                                                                <div class="position-absolute top-2 right-2 bg-dark bg-opacity-50 rounded-circle p-1 d-none">
                                                                    <i class="fas fa-expand text-white text-xs"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Company Details -->
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-info-circle me-2 text-info"></i>
                                                Station Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-building"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Station Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($company['stationtype'] ?? 'Multi-modal'); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-globe"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Service Area</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($company['servicearea'] ?? 'Regional'); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-users"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Daily Passengers</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($company['capacity'] ?? 'High Volume'); ?></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-info-circle"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Description</h6>
                                                                <div class="detail-value"><?php echo nl2br(htmlspecialchars($company['description'] ?? 'No description available.')); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-list"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Facilities</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($company['facilities'] ?? 'Standard facilities'); ?></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Transport Services -->
                                        <div class="services-container mb-4">
                                            <h5 class="mb-3">
                                                <i class="fas fa-route me-2 text-warning"></i>
                                                Available Services
                                            </h5>
                                            <div class="services-grid">
                                                <div class="service-item">
                                                    <div class="service-icon">
                                                        <i class="fas fa-bus"></i>
                                                    </div>
                                                    <div class="service-name">Bus Services</div>
                                                    <div class="service-status">Available</div>
                                                </div>

                                                <div class="service-item">
                                                    <div class="service-icon">
                                                        <i class="fas fa-train"></i>
                                                    </div>
                                                    <div class="service-name">Rail Services</div>
                                                    <div class="service-status"><?php echo strpos($company['stationtype'], 'Railway') !== false ? 'Available' : 'Not Available'; ?></div>
                                                </div>

                                                <div class="service-item">
                                                    <div class="service-icon">
                                                        <i class="fas fa-taxi"></i>
                                                    </div>
                                                    <div class="service-name">Auto/Taxi</div>
                                                    <div class="service-status">Available</div>
                                                </div>

                                                <div class="service-item">
                                                    <div class="service-icon">
                                                        <i class="fas fa-parking"></i>
                                                    </div>
                                                    <div class="service-name">Parking</div>
                                                    <div class="service-status">Available</div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <small class="text-muted">* Contact station for specific service schedules.</small>
                                            </div>
                                        </div>

                                        <!-- Ticketing Information -->
                                        <div class="tickets-container mb-4">
                                            <h5 class="mb-3">
                                                <i class="fas fa-ticket-alt me-2 text-success"></i>
                                                Ticketing Information
                                            </h5>
                                            <div class="tickets-grid">
                                                <span class="ticket-badge">
                                                    <i class="fas fa-laptop"></i>
                                                    <?php echo $company['ticketingprocess'] == "online" ? 'Online Only' : ($company['ticketingprocess'] == "both" ? 'Online Available' : 'Offline Only'); ?>
                                                </span>
                                                <?php if ($company['ticketingprocess'] == "both"): ?>
                                                    <span class="ticket-badge">
                                                        <i class="fas fa-cash-register"></i>
                                                        Counter Booking
                                                    </span>
                                                <?php endif; ?>
                                                <span class="ticket-badge">
                                                    <i class="fas fa-clock"></i>
                                                    24/7 Operations
                                                </span>
                                            </div>
                                            <div class="text-center mt-2">
                                                <small class="text-muted">* Online booking available for major routes</small>
                                            </div>
                                        </div>

                                        <!-- Sample Routes -->
                                        <div class="route-container mb-4">
                                            <h5 class="mb-3">
                                                <i class="fas fa-route me-2 text-info"></i>
                                                Popular Routes
                                            </h5>
                                            <ul class="route-list">
                                                <li class="route-item">
                                                    <i class="fas fa-arrow-right route-icon"></i>
                                                    <div class="route-details">
                                                        <div class="route-name">Village to City Center</div>
                                                        <div class="route-time">Every 30 mins | 25 km</div>
                                                    </div>
                                                </li>
                                                <li class="route-item">
                                                    <i class="fas fa-arrow-right route-icon"></i>
                                                    <div class="route-details">
                                                        <div class="route-name">Local Village Routes</div>
                                                        <div class="route-time">Hourly service | 10 km</div>
                                                    </div>
                                                </li>
                                                <li class="route-item">
                                                    <i class="fas fa-train route-icon"></i>
                                                    <div class="route-details">
                                                        <div class="route-name">Express Train</div>
                                                        <div class="route-time">Daily 2 services | 150 km</div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="text-center mt-3">
                                                <small class="text-muted">* Timetable subject to change</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column - Contact & Emergency -->
                                    <div class="col-lg-4">
                                        <!-- Emergency Contact -->
                                        <?php if (!empty($company['emergencycontactno'])): ?>
                                            <div class="emergency-section mb-4">
                                                <div class="emergency-header">
                                                    <div class="emergency-icon">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                    </div>
                                                    <h5 class="emergency-title">Emergency Contact</h5>
                                                </div>
                                                <p class="text-danger mb-3">For transport emergencies, lost items, or urgent travel assistance:</p>
                                                <a href="tel:<?php echo htmlspecialchars($company['emergencycontactno']); ?>" class="emergency-phone">
                                                    <i class="fas fa-phone"></i>
                                                    <?php echo htmlspecialchars($company['emergencycontactno']); ?>
                                                </a>
                                                <div class="mt-2">
                                                    <small class="text-muted">24/7 Emergency Support</small>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Contact Information -->
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-address-book me-2 text-success"></i>
                                                Contact Information
                                            </h5>
                                            <ul class="detail-list">
                                                <?php if (!empty($company['contactno'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Station Phone</h6>
                                                            <div class="detail-value">
                                                                <a href="tel:<?php echo htmlspecialchars($company['contactno']); ?>" class="text-decoration-none">
                                                                    <i class="fas fa-phone me-1"></i>
                                                                    <?php echo htmlspecialchars($company['contactno']); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($company['email'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Email</h6>
                                                            <div class="detail-value">
                                                                <a href="mailto:<?php echo htmlspecialchars($company['email']); ?>" class="text-decoration-none">
                                                                    <i class="fas fa-envelope me-1"></i>
                                                                    <?php echo htmlspecialchars($company['email']); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>

                                                <li class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Full Address</h6>
                                                        <div class="detail-value"><?php echo nl2br(htmlspecialchars($fullAddress)); ?></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Quick Actions -->
                                        <div class="sticky-top" style="top: 20px;">
                                            <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                <div class="card-header" style="background: var(--transport-gradient); color: white; padding: 1rem; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="fas fa-bus me-2"></i>
                                                        Quick Actions
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3 mt-3">
                                                    <div class="d-grid gap-2">
                                                        <?php if (!empty($company['emergencycontactno'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($company['emergencycontactno']); ?>" class="btn btn-danger rounded-pill py-2">
                                                                <i class="fas fa-exclamation-triangle me-2"></i>Emergency
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($company['contactno'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($company['contactno']); ?>" class="btn btn-outline-success rounded-pill py-2">
                                                                <i class="fas fa-phone me-2"></i>Call Station
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($company['email'])): ?>
                                                            <a href="mailto:<?php echo htmlspecialchars($company['email']); ?>" class="btn btn-outline-primary rounded-pill py-2">
                                                                <i class="fas fa-envelope me-2"></i>Send Email
                                                            </a>
                                                        <?php endif; ?>

                                                        <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-info rounded-pill py-2">
                                                            <i class="fas fa-map me-2"></i>Get Directions
                                                        </a>

                                                        <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareTransport('<?php echo htmlspecialchars($company['stationname']); ?>', '<?php echo urlencode($fullAddress); ?>')">
                                                            <i class="fas fa-share-alt me-2"></i>Share
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <?php if (!empty($company['description']) || !empty($company['facilities'])): ?>
                                    <div class="col-12">
                                        <div class="modal-detail-section">
                                            <h5>
                                                <i class="fas fa-list-ul me-2 text-secondary"></i>
                                                Additional Information
                                            </h5>
                                            <div class="row">
                                                <?php if (!empty($company['description'])): ?>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-2">Station Overview</h6>
                                                        <p class="text-muted"><?php echo nl2br(htmlspecialchars($company['description'])); ?></p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($company['facilities'])): ?>
                                                    <div class="col-md-4">
                                                        <h6 class="mb-2">Station Facilities</h6>
                                                        <ul class="list-unstyled text-muted small">
                                                            <?php
                                                            $facilityItems = explode(',', $company['facilities']);
                                                            foreach ($facilityItems as $item) {
                                                                $item = trim($item);
                                                                if (!empty($item)) {
                                                                    echo "<li><i class='fas fa-check me-1 text-success'></i>" . htmlspecialchars($item) . "</li>";
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Enhanced Station Modals -->
        <?php if (!empty($station_result) && $station_result != "No Data Found!"): ?>
            <?php foreach ($station_result as $row => $station): ?>
                <?php if ($station['visibility'] == 'on'):
                    $stationModalId = "stationModal" . $row;
                    $addressParts = explode('@', $station['address']);
                    $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                    $photos = json_decode($station['photo'], true);
                    $stationPhotos = is_array($photos) ? array_slice($photos, 0, 3) : [];
                ?>
                    <!-- Enhanced Station Modal -->
                    <div id="<?php echo $stationModalId; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeStationModal('<?php echo $stationModalId; ?>')">&times;</span>

                            <div class="modal-body">
                                <!-- Station Modal Header -->
                                <div class="transport-modal-header">
                                    <h1 class="transport-modal-name"><?php echo htmlspecialchars($station['stationname']); ?> Station</h1>
                                    <div class="transport-modal-subtitle">
                                        <span class="me-3">
                                            <i class="fas fa-map-pin me-1 text-muted"></i>
                                            <?php echo $fullAddress; ?>
                                        </span>
                                        <span class="text-success">
                                            <i class="fas fa-bus me-1"></i>
                                            <?php echo htmlspecialchars($station['servicearea'] ?? 'Local Transport Hub'); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Station Photos -->
                                    <?php if (!empty($stationPhotos)): ?>
                                        <div class="col-12 mb-4">
                                            <h5 class="mb-3">
                                                <i class="fas fa-images me-2 text-info"></i>
                                                Station Gallery
                                            </h5>
                                            <div class="row g-2">
                                                <?php foreach ($stationPhotos as $photo): ?>
                                                    <div class="col-12">
                                                        <div class="position-relative overflow-hidden rounded-3 shadow-sm" style="aspect-ratio: 16/9; cursor: pointer;" onclick="openPhotoModal('./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>')">
                                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>"
                                                                class="w-100 h-100 object-fit-cover"
                                                                alt="Transport Station Facility"
                                                                style="transition: transform 0.3s ease;"
                                                                onmouseover="this.style.transform='scale(1.02)'"
                                                                onmouseout="this.style.transform='scale(1)'">
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Station Details -->
                                    <div class="col-lg-8">
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-bus me-2 text-success"></i>
                                                Station Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                                <i class="fas fa-building"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Operator</h6>
                                                                <div class="detail-value fw-semibold"><?php echo htmlspecialchars($station['stationname']); ?></div>
                                                            </div>
                                                        </li>

                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                                <i class="fas fa-route"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Station Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($station['stationtype'] ?? 'Multi-modal'); ?></div>
                                                            </div>
                                                        </li>

                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Full Address</h6>
                                                                <div class="detail-value"><?php echo nl2br(htmlspecialchars($fullAddress)); ?></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                                <i class="fas fa-clock"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Operation</h6>
                                                                <div class="detail-value">
                                                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                                                        <i class="fas fa-check me-1"></i>24/7 Operations
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Rating</h6>
                                                                <div class="detail-value">
                                                                    <span class="badge bg-warning text-dark rounded-pill">
                                                                        <i class="fas fa-star me-1"></i>4.2★
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <?php if (!empty($station['description'])): ?>
                                                            <li class="detail-item">
                                                                <div class="detail-icon" style="background: rgba(52, 58, 64, 0.1); color: #343a40;">
                                                                    <i class="fas fa-list"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Features</h6>
                                                                    <div class="detail-value small">
                                                                        <?php
                                                                        $features = explode(',', $station['description']);
                                                                        foreach ($features as $feature) {
                                                                            $feature = trim($feature);
                                                                            if (!empty($feature)) {
                                                                                echo "<span class='badge bg-light text-dark rounded-pill me-1 mb-1 px-2 py-1'>" . htmlspecialchars($feature) . "</span>";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Station Quick Actions -->
                                        <div class="sticky-top" style="top: 20px;">
                                            <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                <div class="card-header bg-success text-white py-3 rounded-top-3">
                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="fas fa-bus me-2"></i>
                                                        Station Quick Actions
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3 mt-3">
                                                    <div class="d-grid gap-2">
                                                        <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-success rounded-pill py-2">
                                                            <i class="fas fa-map me-2"></i>Get Directions
                                                        </a>

                                                        <?php if (!empty($station['contactno'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($station['contactno']); ?>" class="btn btn-outline-primary rounded-pill py-2">
                                                                <i class="fas fa-phone me-2"></i>Station Inquiry
                                                            </a>
                                                        <?php endif; ?>

                                                        <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareStation('<?php echo htmlspecialchars($station['stationname']); ?> Station', '<?php echo urlencode($fullAddress); ?>')">
                                                            <i class="fas fa-share-alt me-2"></i>Share Location
                                                        </button>

                                                        <a href="transport.php#transport-section" class="btn btn-outline-info rounded-pill py-2">
                                                            <i class="fas fa-building me-2"></i>View All Stations
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
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
        function openTransportModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closeTransportModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        }

        function openStationModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closeStationModal(modalId) {
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

        // Share Functions
        function shareTransport(stationName, address) {
            if (navigator.share) {
                navigator.share({
                    title: stationName + ' - Village Transport',
                    text: 'Check out this transport station in our village!',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(`${stationName}\n${address}\n${window.location.origin}`).then(() => {
                    showToast('Station details copied to clipboard!', 'success');
                }).catch(() => {
                    showToast('Could not copy to clipboard', 'error');
                });
            }
        }

        function shareStation(stationName, address) {
            if (navigator.share) {
                navigator.share({
                    title: stationName + ' - Transport Station',
                    text: 'Transport station location shared from RuralConnect Web',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(`${stationName}\n${address}\n${window.location.origin}`).then(() => {
                    showToast('Station details copied to clipboard!', 'success');
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