<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotels & Hospitality || Village On Web</title>
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
            --hospitality-gradient: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            --luxury-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 20px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Hospitality Section */
        .hospitality-section {
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
            background: var(--hospitality-gradient);
            border-radius: 2px;
        }

        .section-title p {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            font-family: 'Inter', sans-serif;
        }

        /* Modern Hospitality Cards */
        .hospitality-card-container {
            position: relative;
        }

        .hospitality-card {
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

        .hospitality-card:hover {
            transform: translateY(-12px) rotateX(2deg) rotateY(2deg);
            box-shadow: var(--card-shadow-hover);
        }

        .hospitality-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--hospitality-gradient);
            z-index: 2;
        }

        .hospitality-image-container {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .hospitality-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .hospitality-card:hover .hospitality-image {
            transform: scale(1.05);
        }

        .hospitality-overlay {
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

        .hospitality-card:hover .hospitality-overlay {
            transform: translateY(0);
        }

        .hotel-name-overlay {
            font-family: 'Manrope', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hotel-type-badge {
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

        /* Hospitality Card Content */
        .hospitality-content {
            padding: 1.75rem;
            position: relative;
        }

        .hospitality-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .hospitality-main-info {
            flex-grow: 1;
        }

        .hotel-name {
            font-family: 'Manrope', sans-serif;
            font-size: 1.375rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }

        .location-area {
            color: #6c757d;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .hotel-type {
            background: var(--hospitality-gradient);
            color: white;
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .hotel-status {
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

        /* Hotel Details Grid */
        .hotel-details-grid {
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
            background: rgba(255, 154, 158, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ff9a9e;
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
            background: var(--hospitality-gradient);
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
            box-shadow: 0 8px 25px rgba(255, 154, 158, 0.3);
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
            .hospitality-section {
                padding: 40px 0;
            }

            .section-title h1 {
                font-size: 2rem;
            }

            .hotel-details-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .hospitality-content {
                padding: 1.25rem;
            }

            .hotel-name {
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
            .hospitality-card:hover {
                transform: translateY(-4px);
            }

            .hospitality-header {
                flex-direction: column;
                gap: 0.75rem;
                align-items: stretch;
            }

            .hotel-status {
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

        .hotel-modal-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(0, 0, 0, 0.08);
        }

        .hotel-modal-name {
            font-family: 'Manrope', sans-serif;
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .hotel-modal-subtitle {
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
            border-left: 4px solid #ff9a9e;
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
            background: rgba(255, 154, 158, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ff9a9e;
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

        /* Amenities Display */
        .amenities-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 1.5rem;
        }

        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 0.75rem;
        }

        .amenity-item {
            background: white;
            padding: 0.75rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
            border-left: 3px solid #ff9a9e;
            transition: var(--transition);
        }

        .amenity-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .amenity-icon {
            font-size: 1.5rem;
            color: #ff9a9e;
            margin-bottom: 0.5rem;
        }

        .amenity-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: #2c3e50;
            line-height: 1.3;
        }

        /* Booking Section */
        .booking-section {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: 2px solid #ffc107;
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1.5rem 0;
        }

        .booking-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .booking-icon {
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

        .booking-title {
            color: #856404;
            font-weight: 700;
            margin: 0;
            font-size: 1.25rem;
        }

        .booking-options {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .booking-option {
            background: white;
            color: #495057;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            border: 2px solid #ffc107;
        }

        .booking-option:hover {
            background: #ffc107;
            color: #856404;
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

            .hotel-modal-name {
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

            .amenities-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .hospitality-card:hover {
                transform: translateY(-4px);
            }

            .hotel-name {
                font-size: 1.125rem;
            }

            .hospitality-content {
                padding: 1rem;
            }

            .amenities-grid {
                grid-template-columns: 1fr;
            }

            .booking-options {
                flex-direction: column;
            }
        }

        /* Loading Animation for Images */
        .hospitality-image-loading {
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

        /* Rating Stars */
        .rating-stars {
            color: #ffc107;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .rating-text {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
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

    // Initialize as empty arrays to prevent foreach/array_filter errors
    $hotels_result     = [];
    $restaurants_result = [];

    try {
        // === HOTELS ===
        $table = 'hotels';
        $sql   = 'SELECT * FROM hotels';

        $hotels_result = $obj->selectdata($table, $sql);
        if (!is_array($hotels_result)) {
            $hotels_result = [];
        }

        // === RESTAURANTS ===
        $table = 'restaurants';
        $sql   = 'SELECT * FROM restaurants';

        $restaurants_result = $obj->selectdata($table, $sql);
        if (!is_array($restaurants_result)) {
            $restaurants_result = [];
        }
    } catch (Exception $e) {
        // If any table doesn't exist or query fails → treat as empty
        $hotels_result      = [];
        $restaurants_result = [];
    }
    ?>

    <div class="page-wrapper">
        <section class="page-banner">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Hospitality Services</h3>

                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section>
        <!--page-banner-->

        <!-- Hotels Section -->
        <section class="hospitality-section" id="hotels-section">
            <div class="container">
                <div class="section-title">
                    <h1>Hotels & Accommodations</h1>
                    <p class="lead">Discover comfortable stays and excellent hospitality services in your village area. Find the perfect accommodation for your next visit.</p>
                </div>

                <?php if (empty($hotels_result) || $hotels_result == "No Data Found!"): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <h3>No Hotels Found</h3>
                        <p>No hotels or accommodations are currently available in your village area. Check back soon for updates!</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
                            <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                <i class="fas fa-envelope me-2"></i>Request Information
                            </a>
                            <a href="#restaurants-section" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="fas fa-utensils me-2"></i>View Restaurants
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row g-4 hospitality-card-container">
                        <?php foreach ($hotels_result as $row => $hotel): ?>
                            <?php if ($hotel['visibility'] == 'on'):
                                $hotelModalId = "hotelModal" . $row;
                                $addressParts = explode('@', $hotel['address']);
                                $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                                $timings = json_decode($hotel['timeschedule'], true);
                                $bookingOption = $hotel['bookingprocess'] === "both" ? "Online & Offline" : ucfirst($hotel['bookingprocess']);
                            ?>
                                <!-- Enhanced Hotel Card -->
                                <div class="col-lg-6 col-xl-4">
                                    <div class="hospitality-card h-100 position-relative">
                                        <!-- Hotel Image Container -->
                                        <div class="hospitality-image-container">
                                            <?php
                                            $photos = json_decode($hotel['photo'], true);
                                            $hotelPhoto = !empty($photos) && is_array($photos) ? $photos[0] : 'assets/image/no-image-hotel.jpg';
                                            ?>
                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($hotelPhoto); ?>"
                                                class="hospitality-image"
                                                alt="<?php echo htmlspecialchars($hotel['hotelname']); ?>"
                                                onerror="this.src='assets/image/no-image-hotel.jpg'"
                                                loading="lazy">

                                            <!-- Hotel Overlay -->
                                            <div class="hospitality-overlay">
                                                <h4 class="hotel-name-overlay"><?php echo htmlspecialchars($hotel['hotelname']); ?></h4>
                                                <span class="hotel-type-badge"><?php echo htmlspecialchars($bookingOption); ?></span>
                                            </div>
                                        </div>

                                        <!-- Hotel Content -->
                                        <div class="hospitality-content">
                                            <div class="hospitality-header">
                                                <div class="hospitality-main-info">
                                                    <h4 class="hotel-name"><?php echo htmlspecialchars($hotel['hotelname']); ?></h4>
                                                    <div class="location-area"><?php echo $fullAddress; ?></div>
                                                    <span class="hotel-type"><?php echo $bookingOption; ?></span>
                                                </div>

                                                <div class="hotel-status">
                                                    <div class="status-indicator" style="background: #28a745;"></div>
                                                    <span class="status-text">Open</span>
                                                </div>
                                            </div>

                                            <!-- Hotel Quick Details -->
                                            <div class="hotel-details-grid">
                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                        <i class="fas fa-clock"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Check-in</h6>
                                                        <div class="detail-value"><?php echo $timings['open'] ?? '12:00 PM'; ?></div>
                                                    </div>
                                                </div>

                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Phone</h6>
                                                        <div class="detail-value">
                                                            <a href="tel:<?php echo htmlspecialchars($hotel['contactno']); ?>" style="color: #6c757d; text-decoration: none;">
                                                                <?php echo htmlspecialchars($hotel['contactno']); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if (!empty($hotel['websitelink'])): ?>
                                                    <div class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                            <i class="fas fa-globe"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Website</h6>
                                                            <div class="detail-value">
                                                                <a href="<?php echo htmlspecialchars($hotel['websitelink']); ?>" target="_blank" style="color: #007bff; text-decoration: none;">
                                                                    Visit Site
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($hotel['customerreviews'])): ?>
                                                    <div class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Rating</h6>
                                                            <div class="detail-value">
                                                                <div class="rating-stars">
                                                                    <?php
                                                                    $rating = $hotel['customerreviews'];
                                                                    for ($i = 1; $i <= 5; $i++) {
                                                                        echo $i <= $rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="rating-text"><?php echo $rating; ?>/5</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Hotel Read More Button -->
                                            <div style="margin-top: auto;">
                                                <button class="read-more-btn" onclick="openHotelModal('<?php echo $hotelModalId; ?>')">
                                                    <i class="fas fa-bed"></i>
                                                    <span>View Details</span>
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

        <!-- Restaurants Section -->
        <section class="hospitality-section" id="restaurants-section" style="background: rgba(248, 249, 250, 0.5);">
            <div class="container">
                <div class="section-title">
                    <h1>Restaurants & Dining</h1>
                    <p class="lead">Explore local culinary delights and dining experiences. Find the perfect restaurant for your next meal in the village.</p>
                </div>

                <?php if (empty($restaurants_result) || $restaurants_result == "No Data Found!"): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h3>No Restaurants Found</h3>
                        <p>No restaurants or dining options are currently available in your village area. Check back soon!</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
                            <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                <i class="fas fa-envelope me-2"></i>Suggest Restaurant
                            </a>
                            <a href="#hotels-section" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="fas fa-bed me-2"></i>View Hotels
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row g-4 hospitality-card-container">
                        <?php foreach ($restaurants_result as $row => $restaurant): ?>
                            <?php if ($restaurant['visibility'] == 'on'):
                                $restaurantModalId = "restaurantModal" . $row;
                                $addressParts = explode('@', $restaurant['address']);
                                $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                                $timings = json_decode($restaurant['timeschedule'], true);
                                $bookingOption = $restaurant['bookingprocess'] === "both" ? "Reservations Available" : ucfirst($restaurant['bookingprocess']);
                            ?>
                                <!-- Enhanced Restaurant Card -->
                                <div class="col-lg-6 col-xl-4">
                                    <div class="hospitality-card h-100 position-relative" style="border-left: 4px solid #28a745;">
                                        <!-- Restaurant Image Container -->
                                        <div class="hospitality-image-container">
                                            <?php
                                            $photos = json_decode($restaurant['photo'], true);
                                            $restaurantPhoto = !empty($photos) && is_array($photos) ? $photos[0] : 'assets/image/no-image-restaurant.jpg';
                                            ?>
                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($restaurantPhoto); ?>"
                                                class="hospitality-image"
                                                alt="<?php echo htmlspecialchars($restaurant['restaurantname']); ?>"
                                                onerror="this.src='assets/image/no-image-restaurant.jpg'"
                                                loading="lazy">

                                            <!-- Restaurant Overlay -->
                                            <div class="hospitality-overlay" style="background: linear-gradient(transparent, rgba(40, 167, 69, 0.9));">
                                                <h4 class="hotel-name-overlay"><?php echo htmlspecialchars($restaurant['restaurantname']); ?></h4>
                                                <span class="hotel-type-badge" style="background: rgba(255, 255, 255, 0.3);">Dining</span>
                                            </div>
                                        </div>

                                        <!-- Restaurant Content -->
                                        <div class="hospitality-content">
                                            <div class="hospitality-header">
                                                <div class="hospitality-main-info">
                                                    <h4 class="hotel-name"><?php echo htmlspecialchars($restaurant['restaurantname']); ?></h4>
                                                    <div class="location-area"><?php echo $fullAddress; ?></div>
                                                    <span class="hotel-type" style="background: #28a745;"><?php echo $bookingOption; ?></span>
                                                </div>

                                                <div class="hotel-status">
                                                    <div class="status-indicator" style="background: #28a745;"></div>
                                                    <span class="status-text">Open</span>
                                                </div>
                                            </div>

                                            <!-- Restaurant Quick Details -->
                                            <div class="hotel-details-grid">
                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                        <i class="fas fa-clock"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Hours</h6>
                                                        <div class="detail-value"><?php echo $timings['open'] ?? '11:00 AM'; ?> - <?php echo $timings['close'] ?? '10:00 PM'; ?></div>
                                                    </div>
                                                </div>

                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Phone</h6>
                                                        <div class="detail-value">
                                                            <a href="tel:<?php echo htmlspecialchars($restaurant['contactno']); ?>" style="color: #6c757d; text-decoration: none;">
                                                                <?php echo htmlspecialchars($restaurant['contactno']); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if (!empty($restaurant['websitelink'])): ?>
                                                    <div class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                            <i class="fas fa-globe"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Website</h6>
                                                            <div class="detail-value">
                                                                <a href="<?php echo htmlspecialchars($restaurant['websitelink']); ?>" target="_blank" style="color: #007bff; text-decoration: none;">
                                                                    Visit Site
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($restaurant['customerreviews'])): ?>
                                                    <div class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Rating</h6>
                                                            <div class="detail-value">
                                                                <div class="rating-stars">
                                                                    <?php
                                                                    $rating = $restaurant['customerreviews'];
                                                                    for ($i = 1; $i <= 5; $i++) {
                                                                        echo $i <= $rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="rating-text"><?php echo $rating; ?>/5</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Restaurant Read More Button -->
                                            <div style="margin-top: auto;">
                                                <button class="read-more-btn" style="background: linear-gradient(135deg, #28a745, #20c997);" onclick="openRestaurantModal('<?php echo $restaurantModalId; ?>')">
                                                    <i class="fas fa-utensils"></i>
                                                    <span>Menu & Details</span>
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

        <!-- Enhanced Hotel Modals -->
        <?php if (!empty($hotels_result) && $hotels_result != "No Data Found!"): ?>
            <?php foreach ($hotels_result as $row => $hotel): ?>
                <?php if ($hotel['visibility'] == 'on'):
                    $hotelModalId = "hotelModal" . $row;
                    $addressParts = explode('@', $hotel['address']);
                    $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                    $photos = json_decode($hotel['photo'], true);
                    $photoGallery = is_array($photos) ? array_slice($photos, 0, 6) : [];
                    $timings = json_decode($hotel['timeschedule'], true);
                    $bookingOption = $hotel['bookingprocess'] === "both" ? "Both online & offline" : ucfirst($hotel['bookingprocess']);
                    $amenitiesList = !empty($hotel['amenities']) ? explode(',', $hotel['amenities']) : [];
                ?>
                    <!-- Enhanced Hotel Modal -->
                    <div id="<?php echo $hotelModalId; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeHotelModal('<?php echo $hotelModalId; ?>')">&times;</span>

                            <div class="modal-body">
                                <!-- Modal Header -->
                                <div class="hotel-modal-header">
                                    <h1 class="hotel-modal-name"><?php echo htmlspecialchars($hotel['hotelname']); ?></h1>
                                    <div class="hotel-modal-subtitle">
                                        <span class="me-3">
                                            <i class="fas fa-map-pin me-1 text-muted"></i>
                                            <?php echo $fullAddress; ?>
                                        </span>
                                        <span class="me-3">
                                            <i class="fas fa-star me-1 text-warning"></i>
                                            <?php echo $hotel['customerreviews']; ?>/5 Rating
                                        </span>
                                        <span>
                                            <i class="fas fa-clock me-1 text-muted"></i>
                                            <?php echo $timings['open'] ?? '12:00 PM'; ?> - <?php echo $timings['close'] ?? '11:00 PM'; ?>
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
                                                    Photo Gallery
                                                </h5>
                                                <div class="gallery-grid">
                                                    <?php foreach ($photoGallery as $photo): ?>
                                                        <div class="gallery-item" onclick="openPhotoModal('./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>')">
                                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>"
                                                                alt="Hotel Gallery"
                                                                loading="lazy">
                                                            <div class="gallery-overlay">
                                                                <i class="fas fa-expand-arrows-alt"></i>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Hotel Details -->
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-info-circle me-2 text-info"></i>
                                                Hotel Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-building"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Property Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($hotel['type'] ?? 'Hotel'); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-bed"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Rooms Available</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($hotel['rooms'] ?? 'Multiple'); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-utensils"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>On-site Dining</h6>
                                                                <div class="detail-value"><?php echo !empty($hotel['dining']) ? 'Available' : 'Not Available'; ?></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <?php if (!empty($hotel['description'])): ?>
                                                            <li class="detail-item">
                                                                <div class="detail-icon">
                                                                    <i class="fas fa-align-left"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Description</h6>
                                                                    <div class="detail-value"><?php echo nl2br(htmlspecialchars(substr($hotel['description'], 0, 200))); ?>...</div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-shield-alt"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Check-in/out</h6>
                                                                <div class="detail-value">
                                                                    <small class="text-muted">Check-in: <?php echo $timings['open'] ?? '12:00 PM'; ?></small><br>
                                                                    <small class="text-muted">Check-out: <?php echo $timings['close'] ?? '11:00 AM'; ?></small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Amenities -->
                                        <?php if (!empty($amenitiesList)): ?>
                                            <div class="amenities-container mb-4">
                                                <h5 class="mb-3">
                                                    <i class="fas fa-concierge-bell me-2 text-warning"></i>
                                                    Amenities & Facilities
                                                </h5>
                                                <div class="amenities-grid">
                                                    <?php
                                                    $amenityIcons = [
                                                        'AC' => 'fas fa-fan',
                                                        'WiFi' => 'fas fa-wifi',
                                                        'Parking' => 'fas fa-parking',
                                                        'Pool' => 'fas fa-swimming-pool',
                                                        'Gym' => 'fas fa-dumbbell',
                                                        'Spa' => 'fas fa-spa',
                                                        'Restaurant' => 'fas fa-utensils',
                                                        'Laundry' => 'fas fa-tshirt',
                                                        'Room Service' => 'fas fa-bell-concierge'
                                                    ];

                                                    foreach ($amenitiesList as $amenity):
                                                        $amenity = trim($amenity);
                                                        if (!empty($amenity)):
                                                            $icon = $amenityIcons[$amenity] ?? 'fas fa-check-circle';
                                                    ?>
                                                            <div class="amenity-item">
                                                                <div class="amenity-icon">
                                                                    <i class="<?php echo $icon; ?>"></i>
                                                                </div>
                                                                <div class="amenity-name"><?php echo htmlspecialchars($amenity); ?></div>
                                                            </div>
                                                    <?php endif;
                                                    endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Right Column - Contact & Booking -->
                                    <div class="col-lg-4">
                                        <!-- Booking Section -->


                                        <!-- Contact Information -->
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-address-book me-2 text-success"></i>
                                                Contact Information
                                            </h5>
                                            <ul class="detail-list">
                                                <?php if (!empty($hotel['contactno'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Phone</h6>
                                                            <div class="detail-value">
                                                                <a href="tel:<?php echo htmlspecialchars($hotel['contactno']); ?>" class="text-decoration-none">
                                                                    <i class="fas fa-phone me-1"></i>
                                                                    <?php echo htmlspecialchars($hotel['contactno']); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($hotel['email'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Email</h6>
                                                            <div class="detail-value">
                                                                <a href="mailto:<?php echo htmlspecialchars($hotel['email']); ?>" class="text-decoration-none">
                                                                    <i class="fas fa-envelope me-1"></i>
                                                                    <?php echo htmlspecialchars($hotel['email']); ?>
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

                                                <?php if (!empty($hotel['websitelink'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                            <i class="fas fa-globe"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Website</h6>
                                                            <div class="detail-value">
                                                                <a href="<?php echo htmlspecialchars($hotel['websitelink']); ?>" target="_blank" class="text-decoration-none">
                                                                    <i class="fas fa-external-link-alt me-1"></i>
                                                                    Visit Website
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>

                                        <!-- Quick Actions -->
                                        <div class="sticky-top" style="top: 20px;">
                                            <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                <div class="card-header" style="background: var(--hospitality-gradient); color: white; padding: 1rem; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="fas fa-concierge-bell me-2"></i>
                                                        Quick Actions
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3 mt-3">
                                                    <div class="d-grid gap-2">
                                                        <?php if (!empty($hotel['websitelink'])): ?>
                                                            <a href="<?php echo htmlspecialchars($hotel['websitelink']); ?>" target="_blank" class="btn btn-primary rounded-pill py-2">
                                                                <i class="fas fa-globe me-2"></i>Book Online
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($hotel['contactno'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($hotel['contactno']); ?>" class="btn btn-outline-success rounded-pill py-2">
                                                                <i class="fas fa-phone me-2"></i>Call Hotel
                                                            </a>
                                                        <?php endif; ?>

                                                        <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-info rounded-pill py-2">
                                                            <i class="fas fa-map me-2"></i>Get Directions
                                                        </a>

                                                        <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareHotel('<?php echo htmlspecialchars($hotel['hotelname']); ?>', '<?php echo urlencode($fullAddress); ?>')">
                                                            <i class="fas fa-share-alt me-2"></i>Share Hotel
                                                        </button>
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

        <!-- Enhanced Restaurant Modals -->
        <?php if (!empty($restaurants_result) && $restaurants_result != "No Data Found!"): ?>
            <?php foreach ($restaurants_result as $row => $restaurant): ?>
                <?php if ($restaurant['visibility'] == 'on'):
                    $restaurantModalId = "restaurantModal" . $row;
                    $addressParts = explode('@', $restaurant['address']);
                    $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                    $photos = json_decode($restaurant['photo'], true);
                    $photoGallery = is_array($photos) ? array_slice($photos, 0, 6) : [];
                    $timings = json_decode($restaurant['timeschedule'], true);
                    $bookingOption = $restaurant['bookingprocess'] === "both" ? "Both online & offline" : ucfirst($restaurant['bookingprocess']);
                    $cuisines = !empty($restaurant['cuisine']) ? explode(',', $restaurant['cuisine']) : [];
                ?>
                    <!-- Enhanced Restaurant Modal -->
                    <div id="<?php echo $restaurantModalId; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeRestaurantModal('<?php echo $restaurantModalId; ?>')">&times;</span>

                            <div class="modal-body">
                                <!-- Modal Header -->
                                <div class="hotel-modal-header">
                                    <h1 class="hotel-modal-name"><?php echo htmlspecialchars($restaurant['restaurantname']); ?></h1>
                                    <div class="hotel-modal-subtitle">
                                        <span class="me-3">
                                            <i class="fas fa-map-pin me-1 text-muted"></i>
                                            <?php echo $fullAddress; ?>
                                        </span>
                                        <span class="me-3">
                                            <i class="fas fa-star me-1 text-warning"></i>
                                            <?php echo $restaurant['customerreviews']; ?>/5 Rating
                                        </span>
                                        <span>
                                            <i class="fas fa-clock me-1 text-muted"></i>
                                            <?php echo $timings['open'] ?? '11:00 AM'; ?> - <?php echo $timings['close'] ?? '10:00 PM'; ?>
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
                                                    Photo Gallery
                                                </h5>
                                                <div class="gallery-grid">
                                                    <?php foreach ($photoGallery as $photo): ?>
                                                        <div class="gallery-item" onclick="openPhotoModal('./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>')">
                                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>"
                                                                alt="Restaurant Gallery"
                                                                loading="lazy">
                                                            <div class="gallery-overlay">
                                                                <i class="fas fa-expand-arrows-alt"></i>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Restaurant Details -->
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-info-circle me-2 text-info"></i>
                                                Restaurant Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-utensils"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Cuisine Type</h6>
                                                                <div class="detail-value">
                                                                    <?php
                                                                    $cuisinesList = array_slice($cuisines, 0, 3);
                                                                    foreach ($cuisinesList as $cuisine):
                                                                        $cuisine = trim($cuisine);
                                                                        if (!empty($cuisine)):
                                                                    ?>
                                                                            <span class="badge bg-light text-dark me-1 mb-1"><?php echo htmlspecialchars($cuisine); ?></span>
                                                                    <?php endif;
                                                                    endforeach; ?>
                                                                    <?php if (count($cuisines) > 3): ?>
                                                                        <span class="text-muted">+<?php echo count($cuisines) - 3; ?> more</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-users"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Seating Capacity</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($restaurant['seating'] ?? '50+'); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-wifi"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>WiFi Available</h6>
                                                                <div class="detail-value"><?php echo !empty($restaurant['wifi']) ? 'Yes' : 'No'; ?></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <?php if (!empty($restaurant['description'])): ?>
                                                            <li class="detail-item">
                                                                <div class="detail-icon">
                                                                    <i class="fas fa-align-left"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>About Us</h6>
                                                                    <div class="detail-value"><?php echo nl2br(htmlspecialchars(substr($restaurant['description'], 0, 200))); ?>...</div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-dollar-sign"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Price Range</h6>
                                                                <div class="detail-value">
                                                                    <span class="badge bg-success rounded-pill"><?php echo htmlspecialchars($restaurant['price_range'] ?? 'Moderate'); ?></span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Specialties -->
                                        <?php if (!empty($cuisines)): ?>
                                            <div class="amenities-container mb-4">
                                                <h5 class="mb-3">
                                                    <i class="fas fa-fire me-2 text-danger"></i>
                                                    Specialties & Menu Highlights
                                                </h5>
                                                <div class="amenities-grid">
                                                    <?php
                                                    $cuisineIcons = [
                                                        'Indian' => 'fas fa-hotdog',
                                                        'Chinese' => 'fas fa-bowl-rice',
                                                        'Continental' => 'fas fa-cutlery',
                                                        'South Indian' => 'fas fa-drumstick-bite',
                                                        'North Indian' => 'fas fa-bread-slice',
                                                        'Fast Food' => 'fas fa-hamburger',
                                                        'Italian' => 'fas fa-pizza-slice',
                                                        'Mexican' => 'fas fa-taco'
                                                    ];

                                                    foreach ($cuisines as $cuisine):
                                                        $cuisine = trim($cuisine);
                                                        if (!empty($cuisine)):
                                                            $icon = $cuisineIcons[$cuisine] ?? 'fas fa-utensils';
                                                    ?>
                                                            <div class="amenity-item">
                                                                <div class="amenity-icon">
                                                                    <i class="<?php echo $icon; ?>"></i>
                                                                </div>
                                                                <div class="amenity-name"><?php echo htmlspecialchars($cuisine); ?></div>
                                                            </div>
                                                    <?php endif;
                                                    endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Right Column - Contact & Booking -->
                                    <div class="col-lg-4">
                                        <!-- Booking Section -->
                                        <div class="booking-section mb-4">
                                            <div class="booking-header">
                                                <div class="booking-icon">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                                <h5 class="booking-title">Make a Reservation</h5>
                                            </div>
                                            <p class="text-warning mb-3">Reserve your table now!</p>
                                            <div class="booking-options">
                                                <?php if (!empty($restaurant['websitelink'])): ?>
                                                    <a href="<?php echo htmlspecialchars($restaurant['websitelink']); ?>" target="_blank" class="booking-option">
                                                        <i class="fas fa-globe me-2"></i>Online Booking
                                                    </a>
                                                <?php endif; ?>
                                                <?php if ($bookingOption === "Both online & offline"): ?>
                                                    <a href="tel:<?php echo htmlspecialchars($restaurant['contactno']); ?>" class="booking-option">
                                                        <i class="fas fa-phone me-2"></i>Call to Reserve
                                                    </a>
                                                <?php endif; ?>
                                                <button class="booking-option" onclick="shareRestaurant('<?php echo htmlspecialchars($restaurant['restaurantname']); ?>', '<?php echo urlencode($fullAddress); ?>')">
                                                    <i class="fas fa-share-alt me-2"></i>Share
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Contact Information -->
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-address-book me-2 text-success"></i>
                                                Contact Information
                                            </h5>
                                            <ul class="detail-list">
                                                <?php if (!empty($restaurant['contactno'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Phone</h6>
                                                            <div class="detail-value">
                                                                <a href="tel:<?php echo htmlspecialchars($restaurant['contactno']); ?>" class="text-decoration-none">
                                                                    <i class="fas fa-phone me-1"></i>
                                                                    <?php echo htmlspecialchars($restaurant['contactno']); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($restaurant['email'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Email</h6>
                                                            <div class="detail-value">
                                                                <a href="mailto:<?php echo htmlspecialchars($restaurant['email']); ?>" class="text-decoration-none">
                                                                    <i class="fas fa-envelope me-1"></i>
                                                                    <?php echo htmlspecialchars($restaurant['email']); ?>
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

                                                <?php if (!empty($restaurant['websitelink'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                            <i class="fas fa-globe"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Website</h6>
                                                            <div class="detail-value">
                                                                <a href="<?php echo htmlspecialchars($restaurant['websitelink']); ?>" target="_blank" class="text-decoration-none">
                                                                    <i class="fas fa-external-link-alt me-1"></i>
                                                                    Visit Website
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>

                                        <!-- Quick Actions -->
                                        <div class="sticky-top" style="top: 20px;">
                                            <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                <div class="card-header bg-success text-white py-3 rounded-top-3">
                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="fas fa-utensils me-2"></i>
                                                        Quick Actions
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3 mt-3">
                                                    <div class="d-grid gap-2">
                                                        <?php if (!empty($restaurant['websitelink'])): ?>
                                                            <a href="<?php echo htmlspecialchars($restaurant['websitelink']); ?>" target="_blank" class="btn btn-success rounded-pill py-2">
                                                                <i class="fas fa-globe me-2"></i>View Menu Online
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($restaurant['contactno'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($restaurant['contactno']); ?>" class="btn btn-outline-success rounded-pill py-2">
                                                                <i class="fas fa-phone me-2"></i>Call Restaurant
                                                            </a>
                                                        <?php endif; ?>

                                                        <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-info rounded-pill py-2">
                                                            <i class="fas fa-map me-2"></i>Get Directions
                                                        </a>

                                                        <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareRestaurant('<?php echo htmlspecialchars($restaurant['restaurantname']); ?>', '<?php echo urlencode($fullAddress); ?>')">
                                                            <i class="fas fa-share-alt me-2"></i>Share Restaurant
                                                        </button>
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
        function openHotelModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closeHotelModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        }

        function openRestaurantModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closeRestaurantModal(modalId) {
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
        function shareHotel(hotelName, address) {
            if (navigator.share) {
                navigator.share({
                    title: hotelName + ' - Village Accommodation',
                    text: 'Check out this hotel in our village!',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(`${hotelName}\n${address}\n${window.location.origin}`).then(() => {
                    showToast('Hotel details copied to clipboard!', 'success');
                }).catch(() => {
                    showToast('Could not copy to clipboard', 'error');
                });
            }
        }

        function shareRestaurant(restaurantName, address) {
            if (navigator.share) {
                navigator.share({
                    title: restaurantName + ' - Village Dining',
                    text: 'Discover this restaurant in our village!',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(`${restaurantName}\n${address}\n${window.location.origin}`).then(() => {
                    showToast('Restaurant details copied to clipboard!', 'success');
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

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
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