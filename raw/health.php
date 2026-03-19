<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Health || RuralConnect Web</title>
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
            --health-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 20px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Health Section */
        .health-section {
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
            background: var(--health-gradient);
            border-radius: 2px;
        }

        .section-title p {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            font-family: 'Inter', sans-serif;
        }

        /* Modern Health Cards */
        .health-card-container {
            position: relative;
        }

        .health-card {
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

        .health-card:hover {
            transform: translateY(-12px) rotateX(2deg) rotateY(2deg);
            box-shadow: var(--card-shadow-hover);
        }

        .health-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--health-gradient);
            z-index: 2;
        }

        .health-image-container {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .health-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .health-card:hover .health-image {
            transform: scale(1.05);
        }

        .health-overlay {
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

        .health-card:hover .health-overlay {
            transform: translateY(0);
        }

        .hospital-name-overlay {
            font-family: 'Manrope', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .health-type-badge {
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

        /* Health Card Content */
        .health-content {
            padding: 1.75rem;
            position: relative;
        }

        .health-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .health-main-info {
            flex-grow: 1;
        }

        .hospital-name {
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

        .health-type {
            background: var(--health-gradient);
            color: white;
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .health-status {
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

        /* Health Details Grid */
        .health-details-grid {
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
            background: rgba(102, 126, 234, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #667eea;
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
            background: var(--health-gradient);
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
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
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
            .health-section {
                padding: 40px 0;
            }

            .section-title h1 {
                font-size: 2rem;
            }

            .health-details-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .health-content {
                padding: 1.25rem;
            }

            .hospital-name {
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
            .health-card:hover {
                transform: translateY(-4px);
            }

            .health-header {
                flex-direction: column;
                gap: 0.75rem;
                align-items: stretch;
            }

            .health-status {
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

        .health-modal-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(0, 0, 0, 0.08);
        }

        .health-modal-name {
            font-family: 'Manrope', sans-serif;
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .health-modal-subtitle {
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
            border-left: 4px solid #667eea;
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
            background: rgba(102, 126, 234, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #667eea;
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

        /* Health Services Display */
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
            border-left: 4px solid #667eea;
        }

        .service-icon {
            font-size: 2rem;
            color: #667eea;
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
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            border: 2px solid #dc3545;
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
            background: #dc3545;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .emergency-title {
            color: #721c24;
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

            .health-modal-name {
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
            .health-card:hover {
                transform: translateY(-4px);
            }

            .hospital-name {
                font-size: 1.125rem;
            }

            .health-content {
                padding: 1rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Loading Animation for Images */
        .health-image-loading {
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

        /* Doctor Badge */
        .doctor-badge {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-weight: 500;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            margin: 0.25rem;
        }

        .doctors-container {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 12px;
            margin-top: 1rem;
            border-left: 4px solid #667eea;
        }

        .doctors-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }
    </style>

</head>

<body>

    <?php include "header.php"; ?>
    <!-- connection -->
    <?php
    include_once('admin/config.php');
    $obj = new ConnDb();

    // Initialize as empty arrays to prevent foreach/array_filter errors
    $hospitals   = [];   // All hospitals and clinics
    $facilities  = [];   // Same data — can be used for filtering by type (PHC, CHC, etc.)

    try {
        $table = 'hospitals';
        $sql   = 'SELECT * FROM hospitals';

        // Fetch all hospitals and healthcare facilities
        $hospitals = $obj->selectdata($table, $sql);
        if (!is_array($hospitals)) {
            $hospitals = [];
        }

        // Fetch again (same data — safe for future filtering by type, ownership, etc.)
        $facilities = $obj->selectdata($table, $sql);
        if (!is_array($facilities)) {
            $facilities = [];
        }
    } catch (Exception $e) {
        // Table doesn't exist, query fails, or any DB error → treat as empty
        $hospitals  = [];
        $facilities = [];
    }
    ?>

    <div class="page-wrapper">
        <section class="page-banner">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Health Services</h3>
                    
                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section>
        <!--page-banner-->

        <!-- Health Facilities Section -->
        <section class="health-section" style="background: rgba(248, 249, 250, 0.5);">
            <div class="container">
                <div class="section-title">
                    <h1>Healthcare Facilities & Hospitals</h1>
                    <p class="lead">Find hospitals, clinics, and healthcare facilities in your village area for medical care and emergency services.</p>
                </div>

                <?php if (empty($facility_result) || $facility_result == "No Data Found!"): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h3>No Healthcare Facilities Found</h3>
                        <p>No hospitals or medical facilities are currently available in your village area.</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
                            <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                <i class="fas fa-envelope me-2"></i>Request Information
                            </a>
                            <a href="#health-section" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="fas fa-arrow-up me-2"></i>View Providers
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row g-4 health-card-container">
                        <?php foreach ($facility_result as $index => $facility): ?>
                            <?php if ($facility['visibility'] == 'on'):
                                $facilityModalId = "facilityModal" . $index;
                                $addressParts = explode('@', $facility['address']);
                                $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                            ?>
                                <!-- Enhanced Health Facility Card -->
                                <div class="col-lg-6 col-xl-4">
                                    <div class="health-card h-100 position-relative" style="border-left: 4px solid #28a745;">
                                        <!-- Facility Image Container -->
                                        <div class="health-image-container" style="height: 200px;">
                                            <?php
                                            $photos = json_decode($facility['photo'], true);
                                            $facilityPhoto = !empty($photos) && is_array($photos) ? $photos[0] : 'assets/image/no-image-hospital.jpg';
                                            ?>
                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($facilityPhoto); ?>"
                                                class="health-image"
                                                alt="<?php echo htmlspecialchars($facility['name']); ?> Facility"
                                                onerror="this.src='assets/image/no-image-hospital.jpg'"
                                                loading="lazy">

                                            <!-- Facility Overlay -->
                                            <div class="health-overlay" style="background: linear-gradient(transparent, rgba(40, 167, 69, 0.9));">
                                                <h4 class="hospital-name-overlay"><?php echo htmlspecialchars($facility['name']); ?> Facility</h4>
                                                <span class="health-type-badge" style="background: rgba(255, 255, 255, 0.3);">Medical Care</span>
                                            </div>
                                        </div>

                                        <!-- Facility Content -->
                                        <div class="health-content">
                                            <div class="health-header">
                                                <div class="health-main-info">
                                                    <h4 class="hospital-name"><?php echo htmlspecialchars($facility['name']); ?> Facility</h4>
                                                    <div class="service-area"><?php echo htmlspecialchars($facility['servicearea'] ?? 'Local Coverage'); ?></div>
                                                    <span class="health-type" style="background: #28a745;"><?php echo htmlspecialchars($facility['type'] ?? 'Healthcare'); ?></span>
                                                </div>

                                                <div class="health-status">
                                                    <div class="status-indicator" style="background: #28a745;"></div>
                                                    <span class="status-text">Open</span>
                                                </div>
                                            </div>

                                            <!-- Facility Quick Details -->
                                            <div class="health-details-grid">
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
                                                        <i class="fas fa-bed"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Capacity</h6>
                                                        <div class="detail-value"><?php echo htmlspecialchars($facility['patientcapacity'] ?? 'Standard'); ?> Beds</div>
                                                    </div>
                                                </div>

                                                <?php if (!empty($facility['contactno'])): ?>
                                                    <div class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Emergency</h6>
                                                            <div class="detail-value">
                                                                <a href="tel:<?php echo htmlspecialchars($facility['contactno']); ?>" style="color: #6c757d; text-decoration: none;">
                                                                    <?php echo htmlspecialchars($facility['contactno']); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                        <i class="fas fa-clock"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Hours</h6>
                                                        <div class="detail-value">24/7 Emergency</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Facility Read More Button -->
                                            <div style="margin-top: auto;">
                                                <button class="read-more-btn" style="background: linear-gradient(135deg, #28a745, #20c997);" onclick="openFacilityModal('<?php echo $facilityModalId; ?>')">
                                                    <i class="fas fa-hospital"></i>
                                                    <span>Facility Details</span>
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

        <!-- Enhanced Health Company Modals -->
        <?php if (!empty($result) && $result != "No Data Found!"): ?>
            <?php foreach ($result as $index => $company): ?>
                <?php if ($company['visibility'] == 'on'):
                    $modalId = "healthModal" . $index;
                    $addressParts = explode('@', $company['address']);
                    $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                    $photos = json_decode($company['photo'], true);
                    $photoGallery = is_array($photos) ? array_slice($photos, 0, 5) : [];
                    $timings = json_decode($company['timeduration'], true);
                ?>
                    <!-- Enhanced Health Company Modal -->
                    <div id="<?php echo $modalId; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeHealthModal('<?php echo $modalId; ?>')">&times;</span>

                            <div class="modal-body">
                                <!-- Modal Header -->
                                <div class="health-modal-header">
                                    <h1 class="health-modal-name"><?php echo htmlspecialchars($company['name']); ?></h1>
                                    <div class="health-modal-subtitle">
                                        <span class="me-3">
                                            <i class="fas fa-map-pin me-1 text-muted"></i>
                                            <?php echo $fullAddress; ?>
                                        </span>
                                        <span>
                                            <i class="fas fa-hospital me-1 text-muted"></i>
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
                                                                    alt="Healthcare Facility Image"
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
                                                Facility Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-hospital"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Facility Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($company['type'] ?? 'General Hospital'); ?></div>
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
                                                                <i class="fas fa-bed"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Patient Capacity</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($company['patientcapacity'] ?? 'Standard'); ?> Beds</div>
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
                                                                <h6>Specialties</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($company['specialties'] ?? 'General Medicine'); ?></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Health Services -->
                                        <div class="services-container mb-4">
                                            <h5 class="mb-3">
                                                <i class="fas fa-stethoscope me-2 text-warning"></i>
                                                Medical Services
                                            </h5>
                                            <div class="services-grid">
                                                <div class="service-item">
                                                    <div class="service-icon">
                                                        <i class="fas fa-user-md"></i>
                                                    </div>
                                                    <div class="service-name">General Medicine</div>
                                                    <div class="service-status">Available</div>
                                                </div>

                                                <div class="service-item">
                                                    <div class="service-icon">
                                                        <i class="fas fa-child"></i>
                                                    </div>
                                                    <div class="service-name">Pediatrics</div>
                                                    <div class="service-status">Available</div>
                                                </div>

                                                <div class="service-item">
                                                    <div class="service-icon">
                                                        <i class="fas fa-heartbeat"></i>
                                                    </div>
                                                    <div class="service-name">Emergency Care</div>
                                                    <div class="service-status">24/7</div>
                                                </div>

                                                <div class="service-item">
                                                    <div class="service-icon">
                                                        <i class="fas fa-pills"></i>
                                                    </div>
                                                    <div class="service-name">Pharmacy</div>
                                                    <div class="service-status">Available</div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <small class="text-muted">* Contact facility for specific service availability.</small>
                                            </div>
                                        </div>

                                        <!-- Sample Doctors -->
                                        <div class="doctors-container mb-4">
                                            <h5 class="mb-3">
                                                <i class="fas fa-user-md me-2 text-success"></i>
                                                Available Doctors
                                            </h5>
                                            <div class="doctors-grid">
                                                <span class="doctor-badge">
                                                    <i class="fas fa-user-md"></i>
                                                    Dr. Smith - General
                                                </span>
                                                <span class="doctor-badge">
                                                    <i class="fas fa-child"></i>
                                                    Dr. Johnson - Pediatrics
                                                </span>
                                                <span class="doctor-badge">
                                                    <i class="fas fa-stethoscope"></i>
                                                    Dr. Brown - Emergency
                                                </span>
                                            </div>
                                            <div class="text-center mt-2">
                                                <small class="text-muted">* Call for appointment scheduling</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Column - Contact & Emergency -->
                                    <div class="col-lg-4">
                                        <!-- Emergency Contact -->
                                        <div class="emergency-section mb-4">
                                            <div class="emergency-header">
                                                <div class="emergency-icon">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </div>
                                                <h5 class="emergency-title">Emergency Contact</h5>
                                            </div>
                                            <p class="text-danger mb-3">For medical emergencies, ambulance services, or urgent care:</p>
                                            <?php if (!empty($company['emergencycontactno'])): ?>
                                                <a href="tel:<?php echo htmlspecialchars($company['emergencycontactno']); ?>" class="emergency-phone">
                                                    <i class="fas fa-phone"></i>
                                                    <?php echo htmlspecialchars($company['emergencycontactno']); ?>
                                                </a>
                                            <?php else: ?>
                                                <a href="tel:<?php echo htmlspecialchars($company['contactno']); ?>" class="emergency-phone">
                                                    <i class="fas fa-phone"></i>
                                                    <?php echo htmlspecialchars($company['contactno']); ?>
                                                </a>
                                            <?php endif; ?>
                                            <div class="mt-2">
                                                <small class="text-muted">24/7 Emergency Services</small>
                                            </div>
                                        </div>

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
                                                            <h6>Main Phone</h6>
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
                                                <div class="card-header" style="background: var(--health-gradient); color: white; padding: 1rem; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="fas fa-hospital me-2 mt-3"></i>
                                                        Quick Actions
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3 mt-3">
                                                    <div class="d-grid gap-2">
                                                        <a href="tel:<?php echo htmlspecialchars($company['contactno']); ?>" class="btn btn-danger rounded-pill py-2">
                                                            <i class="fas fa-exclamation-triangle me-2"></i>Emergency
                                                        </a>

                                                        <?php if (!empty($company['contactno'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($company['contactno']); ?>" class="btn btn-outline-success rounded-pill py-2">
                                                                <i class="fas fa-phone me-2"></i>Call Hospital
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

                                                        <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareHealth('<?php echo htmlspecialchars($company['name']); ?>', '<?php echo urlencode($fullAddress); ?>')">
                                                            <i class="fas fa-share-alt me-2"></i>Share
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <?php if (!empty($company['description']) || !empty($company['specialties'])): ?>
                                    <div class="col-12">
                                        <div class="modal-detail-section">
                                            <h5>
                                                <i class="fas fa-list-ul me-2 text-secondary"></i>
                                                Additional Information
                                            </h5>
                                            <div class="row">
                                                <?php if (!empty($company['description'])): ?>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-2">Facility Overview</h6>
                                                        <p class="text-muted"><?php echo nl2br(htmlspecialchars($company['description'])); ?></p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($company['specialties'])): ?>
                                                    <div class="col-md-4">
                                                        <h6 class="mb-2">Medical Specialties</h6>
                                                        <ul class="list-unstyled text-muted small">
                                                            <?php
                                                            $specialtyItems = explode(',', $company['specialties']);
                                                            foreach ($specialtyItems as $item) {
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

        <!-- Enhanced Facility Modals -->
        <?php if (!empty($facility_result) && $facility_result != "No Data Found!"): ?>
            <?php foreach ($facility_result as $index => $facility): ?>
                <?php if ($facility['visibility'] == 'on'):
                    $facilityModalId = "facilityModal" . $index;
                    $addressParts = explode('@', $facility['address']);
                    $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                    $photos = json_decode($facility['photo'], true);
                    $facilityPhotos = is_array($photos) ? array_slice($photos, 0, 3) : [];
                    $timings = json_decode($facility['timeduration'], true);
                ?>
                    <!-- Enhanced Facility Modal -->
                    <div id="<?php echo $facilityModalId; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeFacilityModal('<?php echo $facilityModalId; ?>')">&times;</span>

                            <div class="modal-body">
                                <!-- Facility Modal Header -->
                                <div class="health-modal-header">
                                    <h1 class="health-modal-name"><?php echo htmlspecialchars($facility['name']); ?> Facility</h1>
                                    <div class="health-modal-subtitle">
                                        <span class="me-3">
                                            <i class="fas fa-map-pin me-1 text-muted"></i>
                                            <?php echo $fullAddress; ?>
                                        </span>
                                        <span class="text-success">
                                            <i class="fas fa-hospital me-1"></i>
                                            <?php echo htmlspecialchars($facility['servicearea'] ?? 'Community Healthcare'); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Facility Photos -->
                                    <?php if (!empty($facilityPhotos)): ?>
                                        <div class="col-12 mb-4">
                                            <h5 class="mb-3">
                                                <i class="fas fa-images me-2 text-info"></i>
                                                Facility Gallery
                                            </h5>
                                            <div class="row g-2">
                                                <?php foreach ($facilityPhotos as $photo): ?>
                                                    <div class="col-12">
                                                        <div class="position-relative overflow-hidden rounded-3 shadow-sm" style="aspect-ratio: 16/9; cursor: pointer;" onclick="openPhotoModal('./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>')">
                                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>"
                                                                class="w-100 h-100 object-fit-cover"
                                                                alt="Healthcare Facility"
                                                                style="transition: transform 0.3s ease;"
                                                                onmouseover="this.style.transform='scale(1.02)'"
                                                                onmouseout="this.style.transform='scale(1)'">
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Facility Details -->
                                    <div class="col-lg-8">
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-hospital me-2 text-success"></i>
                                                Facility Information
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
                                                                <div class="detail-value fw-semibold"><?php echo htmlspecialchars($facility['name']); ?></div>
                                                            </div>
                                                        </li>

                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                                <i class="fas fa-bed"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Capacity</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($facility['patientcapacity'] ?? 'Standard'); ?> Beds</div>
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
                                                                        <i class="fas fa-check me-1"></i>24/7 Emergency
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
                                                                        <i class="fas fa-star me-1"></i>4.7★
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <?php if (!empty($facility['description'])): ?>
                                                            <li class="detail-item">
                                                                <div class="detail-icon" style="background: rgba(52, 58, 64, 0.1); color: #343a40;">
                                                                    <i class="fas fa-list"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Features</h6>
                                                                    <div class="detail-value small">
                                                                        <?php
                                                                        $features = explode(',', $facility['description']);
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

                                        <!-- Facility Quick Actions -->
                                        <div class="sticky-top" style="top: 20px;">
                                            <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                <div class="card-header bg-success text-white py-3 rounded-top-3">
                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="fas fa-hospital me-2"></i>
                                                        Facility Quick Actions
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3 mt-3">
                                                    <div class="d-grid gap-2">
                                                        <a href="tel:<?php echo htmlspecialchars($facility['contactno']); ?>" class="btn btn-danger rounded-pill py-2">
                                                            <i class="fas fa-exclamation-triangle me-2"></i>Emergency
                                                        </a>

                                                        <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-success rounded-pill py-2">
                                                            <i class="fas fa-map me-2"></i>Get Directions
                                                        </a>

                                                        <?php if (!empty($facility['contactno'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($facility['contactno']); ?>" class="btn btn-outline-primary rounded-pill py-2">
                                                                <i class="fas fa-phone me-2"></i>Appointment
                                                            </a>
                                                        <?php endif; ?>

                                                        <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareFacility('<?php echo htmlspecialchars($facility['name']); ?> Facility', '<?php echo urlencode($fullAddress); ?>')">
                                                            <i class="fas fa-share-alt me-2"></i>Share Location
                                                        </button>

                                                        <a href="health.php#health-section" class="btn btn-outline-info rounded-pill py-2">
                                                            <i class="fas fa-building me-2"></i>View All Facilities
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
        function openHealthModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closeHealthModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        }

        function openFacilityModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closeFacilityModal(modalId) {
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
        function shareHealth(facilityName, address) {
            if (navigator.share) {
                navigator.share({
                    title: facilityName + ' - Village Healthcare',
                    text: 'Check out this healthcare facility in our village!',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(`${facilityName}\n${address}\n${window.location.origin}`).then(() => {
                    showToast('Facility details copied to clipboard!', 'success');
                }).catch(() => {
                    showToast('Could not copy to clipboard', 'error');
                });
            }
        }

        function shareFacility(facilityName, address) {
            if (navigator.share) {
                navigator.share({
                    title: facilityName + ' - Health Facility',
                    text: 'Healthcare facility location shared from RuralConnect Web',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(`${facilityName}\n${address}\n${window.location.origin}`).then(() => {
                    showToast('Facility details copied to clipboard!', 'success');
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