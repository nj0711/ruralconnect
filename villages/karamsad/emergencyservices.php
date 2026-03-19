<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Emergency Services || RuralConnect Web</title>
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
            --danger-gradient: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            --warning-gradient: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
            --info-gradient: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            --emergency-gradient: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 20px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Emergency Section */
        .emergency-section {
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
            background: var(--emergency-gradient);
            border-radius: 2px;
        }

        .section-title p {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            font-family: 'Inter', sans-serif;
        }

        /* Modern Emergency Cards */
        .emergency-card-container {
            position: relative;
        }

        .emergency-card {
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

        .emergency-card:hover {
            transform: translateY(-12px) rotateX(2deg) rotateY(2deg);
            box-shadow: var(--card-shadow-hover);
        }

        .emergency-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--emergency-gradient);
            z-index: 2;
        }

        .emergency-image-container {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .emergency-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .emergency-card:hover .emergency-image {
            transform: scale(1.05);
        }

        .emergency-overlay {
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

        .emergency-card:hover .emergency-overlay {
            transform: translateY(0);
        }

        .service-name-overlay {
            font-family: 'Manrope', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .service-type-badge {
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

        /* Emergency Card Content */
        .emergency-content {
            padding: 1.75rem;
            position: relative;
        }

        .emergency-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .emergency-main-info {
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
            background: var(--emergency-gradient);
            color: white;
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .emergency-status {
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
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        .status-text {
            color: #28a745;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Emergency Details Grid */
        .emergency-details-grid {
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
            background: rgba(220, 53, 69, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #dc3545;
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

        /* Emergency Call Button */
        .emergency-call-btn {
            background: var(--danger-gradient);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: auto;
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
            animation: emergencyPulse 2s infinite;
        }

        @keyframes emergencyPulse {
            0% {
                box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
            }

            50% {
                box-shadow: 0 8px 35px rgba(220, 53, 69, 0.5);
            }

            100% {
                box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
            }
        }

        .emergency-call-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .emergency-call-btn:hover::before {
            left: 100%;
        }

        .emergency-call-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(220, 53, 69, 0.4);
            color: white;
            text-decoration: none;
            animation: none;
        }

        /* Quick Info Button */
        .quick-info-btn {
            background: var(--warning-gradient);
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

        .quick-info-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
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
            .emergency-section {
                padding: 40px 0;
            }

            .section-title h1 {
                font-size: 2rem;
            }

            .emergency-details-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .emergency-content {
                padding: 1.25rem;
            }

            .service-name {
                font-size: 1.25rem;
            }

            .emergency-call-btn {
                width: 100%;
                justify-content: center;
            }

            .empty-state {
                padding: 2rem 1rem;
            }
        }

        @media (max-width: 576px) {
            .emergency-card:hover {
                transform: translateY(-4px);
            }

            .emergency-header {
                flex-direction: column;
                gap: 0.75rem;
                align-items: stretch;
            }

            .emergency-status {
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
            max-width: 800px;
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

        .emergency-modal-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(0, 0, 0, 0.08);
        }

        .emergency-modal-name {
            font-family: 'Manrope', sans-serif;
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .emergency-modal-subtitle {
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
            border-left: 4px solid #dc3545;
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
            background: rgba(220, 53, 69, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #dc3545;
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

        /* Emergency Contact Section */
        .emergency-contact-section {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe6e6 100%);
            border: 2px solid #dc3545;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            text-align: center;
        }

        .emergency-contact-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .emergency-contact-icon {
            width: 60px;
            height: 60px;
            background: #dc3545;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .emergency-contact-title {
            color: #dc3545;
            font-weight: 700;
            margin: 0;
            font-size: 1.5rem;
        }

        .emergency-contact-number {
            background: #dc3545;
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            font-size: 1.25rem;
            margin: 1rem 0;
            transition: var(--transition);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
            animation: emergencyPulse 2s infinite;
        }

        .emergency-contact-number:hover {
            background: #c82333;
            color: white;
            transform: translateY(-3px);
            text-decoration: none;
            box-shadow: 0 12px 35px rgba(220, 53, 69, 0.4);
            animation: none;
        }

        /* Service Type Specific Styling */
        .service-type-medical .modal-detail-section {
            border-left-color: #28a745;
        }

        .service-type-medical .detail-icon {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .service-type-police .modal-detail-section {
            border-left-color: #007bff;
        }

        .service-type-police .detail-icon {
            background: rgba(0, 123, 255, 0.1);
            color: #007bff;
        }

        .service-type-fire .modal-detail-section {
            border-left-color: #ffc107;
        }

        .service-type-fire .detail-icon {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
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

            .emergency-modal-name {
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
            .emergency-card:hover {
                transform: translateY(-4px);
            }

            .service-name {
                font-size: 1.125rem;
            }

            .emergency-content {
                padding: 1rem;
            }
        }

        /* Loading Animation for Images */
        .emergency-image-loading {
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
    $table = 'emergencyservices';
    $values = 'SELECT * FROM emergencyservices';

    $result = $obj->selectdata($table, $values);

    // Police Services Data
    $police_values = 'SELECT * FROM emergencyservices';
    $police_result = $obj->selectdata($table, $police_values);

    // Fire Services Data
    $fire_values = 'SELECT * FROM emergencyservices';
    $fire_result = $obj->selectdata($table, $fire_values);
    ?>

    <div class="page-wrapper">
        <section class="page-banner">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Emergency Services</h3>
                   
                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section>
        <!--page-banner-->





        <!-- Police Emergency Section -->
        <section class="emergency-section" id="police-section" style="background: rgba(248, 249, 250, 0.5);">
            <div class="container">
                <div class="section-title">
                    <h1>Emergency Services</h1>
                    <p class="lead">Get immediate assistance for security emergencies in your village.</p>
                </div>

                <?php if (empty($police_result) || $police_result == "No Data Found!"): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>No Police Services Found</h3>
                        <p>No police emergency services are currently available in your village area.</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
                            <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                <i class="fas fa-envelope me-2"></i>Request Service
                            </a>
                            <a href="#medical-section" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="fas fa-arrow-up me-2"></i>Medical Services
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row g-4 emergency-card-container">
                        <?php foreach ($police_result as $row => $service): ?>
                            <?php if ($service['visibility'] == 'on'):
                                $policeModalId = "policeModal" . $row;
                                $addressParts = explode('@', $service['address']);
                                $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                            ?>
                                <!-- Enhanced Police Service Card -->
                                <div class="col-lg-6 col-xl-4">
                                    <div class="emergency-card h-100 position-relative service-type-police" style="border-left: 4px solid #007bff;">
                                        <!-- Image Container -->

                                        <!-- Content -->
                                        <div class="emergency-content">
                                            <div class="emergency-header">
                                                <div class="emergency-main-info">
                                                    <h4 class="service-name"><?php echo htmlspecialchars($service['servicename']); ?></h4>
                                                    <div class="service-location"><?php echo $fullAddress; ?></div>
                                                    <span class="service-type" style="background: #007bff;">Law Enforcement</span>
                                                </div>

                                                <div class="emergency-status">
                                                    <div class="status-indicator" style="background: #007bff;"></div>
                                                    <span class="status-text">24/7 Response</span>
                                                </div>
                                            </div>

                                            <!-- Quick Details Grid -->
                                            <div class="emergency-details-grid">
                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Station</h6>
                                                        <div class="detail-value"><?php echo $fullAddress; ?></div>
                                                    </div>
                                                </div>

                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                        <i class="fas fa-shield-alt"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Service Type</h6>
                                                        <div class="detail-value"><?php echo htmlspecialchars($service['servicetype'] ?? 'Police'); ?></div>
                                                    </div>
                                                </div>

                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                        <i class="fas fa-clock"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Availability</h6>
                                                        <div class="detail-value">24/7 Emergency Response</div>
                                                    </div>
                                                </div>

                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                        <i class="fas fa-info-circle"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Services</h6>
                                                        <div class="detail-value"><?php echo htmlspecialchars($service['otherserviceinformation'] ?? 'Full police services'); ?></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Police Call Button -->
                                            <div style="margin-top: auto;">
                                                <?php if (!empty($service['contactnumber'])): ?>
                                                    <a href="tel:<?php echo htmlspecialchars($service['contactnumber']); ?>" class="emergency-call-btn" style="background: linear-gradient(135deg, #007bff, #0056b3);">
                                                        <i class="fas fa-phone"></i>
                                                        <span>Call Police</span>
                                                        <i class="fas fa-shield-alt"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <button class="quick-info-btn" style="background: #007bff;" onclick="openPoliceModal('<?php echo $policeModalId; ?>')">
                                                        <i class="fas fa-info-circle"></i>
                                                        <span>Station Details</span>
                                                    </button>
                                                <?php endif; ?>
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



        <!-- Enhanced Medical Service Modals -->
        <?php if (!empty($result) && $result != "No Data Found!"): ?>
            <?php foreach ($result as $row => $service): ?>
                <?php if ($service['visibility'] == 'on'):
                    $modalId = "medicalModal" . $row;
                    $addressParts = explode('@', $service['address']);
                    $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                    // $photos = json_decode($service['photo'], true);
                    // $photoGallery = is_array($photos) ? array_slice($photos, 0, 5) : [];
                ?>
                    <!-- Enhanced Medical Service Modal -->
                    <div id="<?php echo $modalId; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeMedicalModal('<?php echo $modalId; ?>')">&times;</span>

                            <div class="modal-body">
                                <!-- Modal Header -->
                                <div class="emergency-modal-header">
                                    <h1 class="emergency-modal-name"><?php echo htmlspecialchars($service['servicename']); ?></h1>
                                    <div class="emergency-modal-subtitle">
                                        <span class="me-3">
                                            <i class="fas fa-map-pin me-1 text-muted"></i>
                                            <?php echo $fullAddress; ?>
                                        </span>
                                        <span class="text-success">
                                            <i class="fas fa-ambulance me-1"></i>
                                            <?php echo htmlspecialchars($service['servicetype'] ?? 'Medical Emergency'); ?> - 24/7
                                        </span>
                                    </div>
                                </div>

                                <!-- Emergency Contact Section -->
                                <div class="emergency-contact-section">
                                    <div class="emergency-contact-header">
                                        <div class="emergency-contact-icon">
                                            <i class="fas fa-ambulance"></i>
                                        </div>
                                        <h3 class="emergency-contact-title">MEDICAL EMERGENCY</h3>
                                    </div>
                                    <?php if (!empty($service['contactnumber'])): ?>
                                        <p class="text-danger mb-4 fs-5">For life-threatening emergencies, accidents, or urgent medical assistance:</p>
                                        <a href="tel:<?php echo htmlspecialchars($service['contactnumber']); ?>" class="emergency-contact-number">
                                            <i class="fas fa-phone"></i>
                                            <?php echo htmlspecialchars($service['contactnumber']); ?>
                                            <i class="fas fa-ambulance ms-2"></i>
                                        </a>
                                        <div class="mt-3">
                                            <small class="text-muted">24/7 Medical Emergency Response</small>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <!-- Left Column - Main Info -->
                                    <div class="col-lg-8">
                                        <!-- Photo Gallery -->
                                        <?php if (!empty($photoGallery)): ?>
                                            <div class="mb-4">
                                                <h5 class="mb-3">
                                                    <i class="fas fa-images me-2 text-primary"></i>
                                                    Service Gallery
                                                </h5>
                                                <div class="row g-2">

                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Service Details -->
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-info-circle me-2 text-info"></i>
                                                Service Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-ambulance"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Service Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($service['servicetype'] ?? 'Medical Emergency'); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-clock"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Availability</h6>
                                                                <div class="detail-value">24/7 Emergency Response</div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-stethoscope"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Specialties</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($service['otherserviceinformation'] ?? 'General emergency care'); ?></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Full Address</h6>
                                                                <div class="detail-value"><?php echo nl2br(htmlspecialchars($fullAddress)); ?></div>
                                                            </div>
                                                        </li>
                                                        <?php if (!empty($service['description'])): ?>
                                                            <li class="detail-item">
                                                                <div class="detail-icon">
                                                                    <i class="fas fa-info-circle"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Description</h6>
                                                                    <div class="detail-value"><?php echo nl2br(htmlspecialchars($service['description'])); ?></div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column - Quick Actions -->
                                    <div class="col-lg-4">
                                        <!-- Quick Actions -->
                                        <div class="sticky-top" style="top: 20px;">
                                            <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                <div class="card-header bg-success text-white py-3 rounded-top-3">
                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="fas fa-bolt me-2"></i>
                                                        Quick Actions
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3 mt-3">
                                                    <div class="d-grid gap-2">
                                                        <?php if (!empty($service['contactnumber'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($service['contactnumber']); ?>" class="btn btn-success rounded-pill py-2 mb-2">
                                                                <i class="fas fa-ambulance me-2"></i>Call Medical Emergency
                                                            </a>
                                                        <?php endif; ?>

                                                        <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-success rounded-pill py-2">
                                                            <i class="fas fa-map me-2"></i>Get Directions
                                                        </a>

                                                        <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareEmergency('<?php echo htmlspecialchars($service['servicename']); ?>', '<?php echo urlencode($fullAddress); ?>', 'Medical')">
                                                            <i class="fas fa-share-alt me-2"></i>Share Contact
                                                        </button>

                                                        <a href="#medical-section" class="btn btn-outline-info rounded-pill py-2">
                                                            <i class="fas fa-list me-2"></i>View All Medical
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

        <!-- Enhanced Police Service Modals -->
        <?php if (!empty($police_result) && $police_result != "No Data Found!"): ?>
            <?php foreach ($police_result as $row => $service): ?>
                <?php if ($service['visibility'] == 'on'):
                    $policeModalId = "policeModal" . $row;
                    $addressParts = explode('@', $service['address']);
                    $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                    // $photos = json_decode($service['photo'], true);
                    // $photoGallery = is_array($photos) ? array_slice($photos, 0, 5) : [];
                ?>
                    <!-- Enhanced Police Service Modal -->
                    <div id="<?php echo $policeModalId; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closePoliceModal('<?php echo $policeModalId; ?>')">&times;</span>

                            <div class="modal-body">
                                <!-- Modal Header -->
                                <div class="emergency-modal-header">
                                    <h1 class="emergency-modal-name"><?php echo htmlspecialchars($service['servicename']); ?></h1>
                                    <div class="emergency-modal-subtitle">
                                        <span class="me-3">
                                            <i class="fas fa-map-pin me-1 text-muted"></i>
                                            <?php echo $fullAddress; ?>
                                        </span>
                                        <span class="text-primary">
                                            <i class="fas fa-shield-alt me-1"></i>
                                            <?php echo htmlspecialchars($service['servicetype'] ?? 'Police Emergency'); ?> - 24/7
                                        </span>
                                    </div>
                                </div>

                                <!-- Emergency Contact Section -->
                                <div class="emergency-contact-section" style="border-color: #007bff; background: linear-gradient(135deg, #e7f3ff 0%, #d1ecf1 100%);">
                                    <div class="emergency-contact-header">
                                        <div class="emergency-contact-icon" style="background: #007bff;">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <h3 class="emergency-contact-title" style="color: #007bff;">POLICE EMERGENCY</h3>
                                    </div>
                                    <?php if (!empty($service['contactnumber'])): ?>
                                        <p class="text-primary mb-4 fs-5">For crime reporting, security threats, or immediate police assistance:</p>
                                        <a href="tel:<?php echo htmlspecialchars($service['contactnumber']); ?>" class="emergency-contact-number" style="background: #007bff;">
                                            <i class="fas fa-phone"></i>
                                            <?php echo htmlspecialchars($service['contactnumber']); ?>
                                            <i class="fas fa-shield-alt ms-2"></i>
                                        </a>
                                        <div class="mt-3">
                                            <small class="text-muted">24/7 Police Emergency Response</small>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="row">
                                    <!-- Left Column - Main Info -->
                                    <div class="col-lg-8">
                                        <!-- Photo Gallery -->
                                        <?php if (!empty($photoGallery)): ?>
                                            <div class="mb-4">
                                                <h5 class="mb-3">
                                                    <i class="fas fa-images me-2 text-primary"></i>
                                                    Station Gallery
                                                </h5>
                                                <div class="row g-2">

                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Service Details -->
                                        <div class="modal-detail-section mb-4 service-type-police">
                                            <h5>
                                                <i class="fas fa-info-circle me-2 text-info"></i>
                                                Police Station Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-shield-alt"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Station Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($service['servicetype'] ?? 'Police Station'); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-clock"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Operation Hours</h6>
                                                                <div class="detail-value">24/7 Law Enforcement</div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-users"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Personnel</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($service['otherserviceinformation'] ?? 'Full staff coverage'); ?></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Full Address</h6>
                                                                <div class="detail-value"><?php echo nl2br(htmlspecialchars($fullAddress)); ?></div>
                                                            </div>
                                                        </li>
                                                        <?php if (!empty($service['description'])): ?>
                                                            <li class="detail-item">
                                                                <div class="detail-icon">
                                                                    <i class="fas fa-info-circle"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Station Info</h6>
                                                                    <div class="detail-value"><?php echo nl2br(htmlspecialchars($service['description'])); ?></div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column - Quick Actions -->
                                    <div class="col-lg-4">
                                        <!-- Quick Actions -->
                                        <div class="sticky-top" style="top: 20px;">
                                            <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                <div class="card-header" style="background: linear-gradient(135deg, #007bff, #0056b3); color: white; padding: 0.75rem; border-radius: 0.25rem 0.25rem 0 0;">

                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="fas fa-bolt me-2"></i>
                                                        Quick Actions
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3 mt-3">
                                                    <div class="d-grid gap-2">
                                                        <?php if (!empty($service['contactnumber'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($service['contactnumber']); ?>" class="btn btn-primary rounded-pill py-2 mb-2">
                                                                <i class="fas fa-shield-alt me-2"></i>Call Police Emergency
                                                            </a>
                                                        <?php endif; ?>

                                                        <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-primary rounded-pill py-2">
                                                            <i class="fas fa-map me-2"></i>Get Directions
                                                        </a>

                                                        <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareEmergency('<?php echo htmlspecialchars($service['servicename']); ?>', '<?php echo urlencode($fullAddress); ?>', 'Police')">
                                                            <i class="fas fa-share-alt me-2"></i>Share Station
                                                        </button>

                                                        <a href="#police-section" class="btn btn-outline-info rounded-pill py-2">
                                                            <i class="fas fa-list me-2"></i>View All Police
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
        function openMedicalModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closeMedicalModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        }

        function openPoliceModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closePoliceModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        }

        function openFireModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closeFireModal(modalId) {
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
        function shareEmergency(serviceName, address, type) {
            const serviceType = type.charAt(0).toUpperCase() + type.toLowerCase();
            if (navigator.share) {
                navigator.share({
                    title: serviceName + ' - ' + serviceType + ' Emergency',
                    text: 'Emergency service contact shared from RuralConnect Web',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(`${serviceName}\n${address}\nEmergency: ${serviceType}\n${window.location.origin}`).then(() => {
                    showToast(`${serviceType} details copied to clipboard!`, 'success');
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

        // Auto-dial emergency numbers on button click with confirmation
        document.addEventListener('click', function(e) {
            if (e.target.closest('.emergency-call-btn') || e.target.closest('.emergency-contact-number')) {
                e.preventDefault();
                const phoneNumber = e.target.closest('a').href.replace('tel:', '');
                if (confirm(`Call ${phoneNumber} for emergency assistance?`)) {
                    window.location.href = `tel:${phoneNumber}`;
                }
            }
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