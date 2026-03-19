<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Banking || RuralConnect Web</title>
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
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 20px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Department Cards */
        .banking-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
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
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .section-title p {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            font-family: 'Inter', sans-serif;
        }

        /* Modern Bank Cards */
        .bank-card-container {
            position: relative;
        }

        .bank-card {
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

        .bank-card:hover {
            transform: translateY(-12px) rotateX(2deg) rotateY(2deg);
            box-shadow: var(--card-shadow-hover);
        }

        .bank-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
            z-index: 2;
        }

        .bank-image-container {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .bank-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .bank-card:hover .bank-image {
            transform: scale(1.05);
        }

        .bank-overlay {
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

        .bank-card:hover .bank-overlay {
            transform: translateY(0);
        }

        .bank-name-overlay {
            font-family: 'Manrope', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .bank-type-badge {
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

        /* Bank Card Content */
        .bank-content {
            padding: 1.75rem;
            position: relative;
        }

        .bank-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .bank-main-info {
            flex-grow: 1;
        }

        .bank-name {
            font-family: 'Manrope', sans-serif;
            font-size: 1.375rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }

        .bank-branch {
            color: #6c757d;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .bank-type {
            background: var(--primary-gradient);
            color: white;
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .bank-status {
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

        .bank-status-text {
            color: #28a745;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Bank Details Grid */
        .bank-details-grid {
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
            background: var(--primary-gradient);
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
            .banking-section {
                padding: 40px 0;
            }

            .section-title h1 {
                font-size: 2rem;
            }

            .bank-details-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .bank-content {
                padding: 1.25rem;
            }

            .bank-name {
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
            .bank-card:hover {
                transform: translateY(-4px);
            }

            .bank-header {
                flex-direction: column;
                gap: 0.75rem;
                align-items: stretch;
            }

            .bank-status {
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

        .bank-modal-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(0, 0, 0, 0.08);
        }

        .bank-modal-name {
            font-family: 'Manrope', sans-serif;
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .bank-modal-subtitle {
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
            border-left: 4px solid #28a745;
            text-align: center;
        }

        .schedule-time {
            font-size: 1.25rem;
            font-weight: 700;
            color: #28a745;
            margin-bottom: 0.25rem;
        }

        .schedule-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

            .bank-modal-name {
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
            .bank-card:hover {
                transform: translateY(-4px);
            }

            .bank-name {
                font-size: 1.125rem;
            }

            .bank-content {
                padding: 1rem;
            }

            .schedule-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Loading Animation for Images */
        .bank-image-loading {
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
    $table = 'banks';
    $values = 'SELECT * FROM banks ';

    $result = $obj->selectdata($table, $values);

    // ATM Data
    $atm_values = 'SELECT * FROM banks';
    $atm_result = $obj->selectdata($table, $atm_values);
    ?>

    <div class="page-wrapper">
        <section class="page-banner">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Banking Services</h3>

                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section>
        <!--page-banner-->

        <!-- Banks Section -->
        <section class="banking-section">
            <div class="container">
                <div class="section-title">
                    <h1>Banks & Financial Services</h1>
                    <p class="lead">Access comprehensive banking services and ATMs in your village. Find branch locations, contact information, and service details for all your financial needs.</p>
                </div>

                <?php if (empty($result) || $result == "No Data Found!"): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <h3>No Banking Services Found</h3>
                        <p>Your village currently doesn't have any registered banking services. This section will be populated as banks and financial institutions are added to the system.</p>
                        <a href="contact.php" class="btn btn-primary rounded-pill px-4 py-2 mt-3">
                            <i class="fas fa-envelope me-2"></i>Contact Administration
                        </a>
                    </div>
                <?php else: ?>
                    <div class="row g-4 bank-card-container">
                        <?php foreach ($result as $row => $bank): ?>
                            <?php if ($bank['visibility'] == 'on'):
                                $modalId = "bankModal" . $row;
                                $timings = json_decode($bank['timeschedule'], true);
                                $addressParts = explode('@', $bank['address']);
                                $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                            ?>
                                <!-- Enhanced Bank Card -->
                                <div class="col-lg-6 col-xl-4">
                                    <div class="bank-card h-100 position-relative">
                                        <!-- Image Container -->
                                        <div class="bank-image-container">
                                            <?php
                                            $photos = json_decode($bank['photo'], true);
                                            $mainPhoto = !empty($photos) && is_array($photos) ? $photos[0] : 'assets/image/no-image-bank.jpg';
                                            ?>
                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($mainPhoto); ?>"
                                                class="bank-image"
                                                alt="<?php echo htmlspecialchars($bank['bankname']); ?>"
                                                onerror="this.src='assets/image/no-image-bank.jpg'"
                                                loading="lazy">

                                            <!-- Overlay -->
                                            <div class="bank-overlay">
                                                <h4 class="bank-name-overlay"><?php echo htmlspecialchars($bank['bankname']); ?></h4>
                                                <span class="bank-type-badge"><?php echo htmlspecialchars($bank['type'] ?? 'Bank'); ?></span>
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="bank-content">
                                            <div class="bank-header">
                                                <div class="bank-main-info">
                                                    <h4 class="bank-name"><?php echo htmlspecialchars($bank['bankname']); ?></h4>
                                                    <div class="bank-branch"><?php echo htmlspecialchars($bank['branchcode'] ?? 'Branch Code N/A'); ?></div>
                                                    <span class="bank-type"><?php echo ucfirst($bank['servicetype'] ?? 'Financial Service'); ?></span>
                                                </div>

                                                <div class="bank-status">
                                                    <div class="status-indicator" style="background: <?php echo $bank['operationalstatus'] == 'Open' ? '#28a745' : ($bank['operationalstatus'] == 'Closed' ? '#dc3545' : '#ffc107'); ?>;"></div>
                                                    <span class="bank-status-text"><?php echo htmlspecialchars($bank['operationalstatus'] ?? 'Active'); ?></span>
                                                </div>
                                            </div>

                                            <!-- Quick Details Grid -->
                                            <div class="bank-details-grid">
                                                <div class="detail-item">
                                                    <div class="detail-icon">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Location</h6>
                                                        <div class="detail-value"><?php echo $fullAddress; ?></div>
                                                    </div>
                                                </div>

                                                <div class="detail-item">
                                                    <div class="detail-icon">
                                                        <i class="fas fa-clock"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Hours</h6>
                                                        <div class="detail-value">
                                                            <?php if (!empty($timings['open']) && !empty($timings['close'])): ?>
                                                                <?php echo htmlspecialchars($timings['open']); ?> - <?php echo htmlspecialchars($timings['close']); ?>
                                                            <?php else: ?>
                                                                Hours not specified
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="detail-item">
                                                    <div class="detail-icon">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Contact</h6>
                                                        <div class="detail-value">
                                                            <?php if (!empty($bank['phoneno'])): ?>
                                                                <a href="tel:<?php echo htmlspecialchars($bank['phoneno']); ?>" style="color: #007bff; text-decoration: none;">
                                                                    <?php echo htmlspecialchars($bank['phoneno']); ?>
                                                                </a>
                                                            <?php else: ?>
                                                                Phone not available
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="detail-item">
                                                    <div class="detail-icon">
                                                        <i class="fas fa-envelope"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Email</h6>
                                                        <div class="detail-value">
                                                            <?php if (!empty($bank['email'])): ?>
                                                                <a href="mailto:<?php echo htmlspecialchars($bank['email']); ?>" style="color: #007bff; text-decoration: none;">
                                                                    <?php echo htmlspecialchars($bank['email']); ?>
                                                                </a>
                                                            <?php else: ?>
                                                                Email not available
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Read More Button -->
                                            <div style="margin-top: auto;">
                                                <button class="read-more-btn" onclick="openBankModal('<?php echo $modalId; ?>')">
                                                    <i class="fas fa-eye"></i>
                                                    <span>Read More Details</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <?php if (empty(array_filter($result, function ($bank) {
                        return $bank['visibility'] == 'on';
                    }))): ?>
                        <div class="col-12">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <h3>No Banking Services Available</h3>
                                <p>No banking services are currently listed for your village. This could mean:</p>
                                <ul class="text-start text-muted" style="max-width: 500px; margin: 1rem auto;">
                                    <li>Banks haven't been added to the system yet</li>
                                    <li>All services are set to private visibility</li>
                                    <li>Your village may not have banking facilities</li>
                                </ul>
                                <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
                                    <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                        <i class="fas fa-envelope me-2"></i>Contact Admin
                                    </a>
                                    <a href="index.php" class="btn btn-primary rounded-pill px-4 py-2">
                                        <i class="fas fa-home me-2"></i>Back to Home
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- ATM Section -->
        <section class="banking-section" style="background: rgba(248, 249, 250, 0.5);">
            <div class="container">
                <div class="section-title">
                    <h1>ATM Locations</h1>
                    <p class="lead">Find the nearest ATM machines for your cash withdrawal needs. 24/7 cash access at your fingertips.</p>
                </div>

                <?php if (empty($atm_result) || $atm_result == "No Data Found!"): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h3>No ATM Services Found</h3>
                        <p>No ATM locations are currently available in your village area.</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
                            <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                <i class="fas fa-envelope me-2"></i>Request ATM
                            </a>
                            <a href="#banks-section" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="fas fa-arrow-up me-2"></i>View Banks
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row g-4 bank-card-container">
                        <?php foreach ($atm_result as $row => $atm): ?>
                            <?php if ($atm['visibility'] == 'on'):
                                $atmModalId = "atmModal" . $row;
                                $addressParts = explode('@', $atm['address']);
                                $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                            ?>
                                <!-- Enhanced ATM Card -->
                                <div class="col-lg-6 col-xl-4">
                                    <div class="bank-card h-100 position-relative" style="border-left: 4px solid #28a745;">
                                        <!-- ATM Image Container -->
                                        <div class="bank-image-container" style="height: 200px;">
                                            <?php
                                            $photos = json_decode($atm['photo'], true);
                                            $atmPhoto = !empty($photos) && is_array($photos) ? $photos[0] : 'assets/image/no-image-atm.jpg';
                                            ?>
                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($atmPhoto); ?>"
                                                class="bank-image"
                                                alt="<?php echo htmlspecialchars($atm['bankname']); ?> ATM"
                                                onerror="this.src='assets/image/no-image-atm.jpg'"
                                                loading="lazy">

                                            <!-- ATM Overlay -->
                                            <div class="bank-overlay" style="background: linear-gradient(transparent, rgba(40, 167, 69, 0.9));">
                                                <h4 class="bank-name-overlay"><?php echo htmlspecialchars($atm['bankname']); ?> ATM</h4>
                                                <span class="bank-type-badge" style="background: rgba(255, 255, 255, 0.3);">24/7 Access</span>
                                            </div>
                                        </div>

                                        <!-- ATM Content -->
                                        <div class="bank-content">
                                            <div class="bank-header">
                                                <div class="bank-main-info">
                                                    <h4 class="bank-name"><?php echo htmlspecialchars($atm['bankname']); ?> ATM</h4>
                                                    <div class="bank-branch"><?php echo htmlspecialchars($atm['branchcode'] ?? 'ATM Location'); ?></div>
                                                    <span class="bank-type" style="background: #28a745;">Cash Point</span>
                                                </div>

                                                <div class="bank-status">
                                                    <div class="status-indicator" style="background: #28a745;"></div>
                                                    <span class="bank-status-text">24/7 Available</span>
                                                </div>
                                            </div>

                                            <!-- ATM Quick Details -->
                                            <div class="bank-details-grid">
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
                                                        <i class="fas fa-university"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Bank</h6>
                                                        <div class="detail-value"><?php echo htmlspecialchars($atm['bankname']); ?></div>
                                                    </div>
                                                </div>

                                                <?php if (!empty($atm['phoneno'])): ?>
                                                    <div class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Support</h6>
                                                            <div class="detail-value">
                                                                <a href="tel:<?php echo htmlspecialchars($atm['phoneno']); ?>" style="color: #6c757d; text-decoration: none;">
                                                                    <?php echo htmlspecialchars($atm['phoneno']); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                        <i class="fas fa-info-circle"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Status</h6>
                                                        <div class="detail-value"><?php echo htmlspecialchars($atm['operationalstatus'] ?? 'Operational'); ?></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ATM Read More Button -->
                                            <div style="margin-top: auto;">
                                                <button class="read-more-btn" style="background: linear-gradient(135deg, #28a745, #20c997);" onclick="openATMMModal('<?php echo $atmModalId; ?>')">
                                                    <i class="fas fa-credit-card"></i>
                                                    <span>ATM Details</span>
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

        <!-- Enhanced Bank Modals -->
        <?php if (!empty($result) && $result != "No Data Found!"): ?>
            <?php foreach ($result as $row => $bank): ?>
                <?php if ($bank['visibility'] == 'on'):
                    $modalId = "bankModal" . $row;
                    $timings = json_decode($bank['timeschedule'], true);
                    $addressParts = explode('@', $bank['address']);
                    $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                    $photos = json_decode($bank['photo'], true);
                    $photoGallery = is_array($photos) ? array_slice($photos, 0, 5) : [];
                ?>
                    <!-- Enhanced Bank Modal -->
                    <div id="<?php echo $modalId; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeBankModal('<?php echo $modalId; ?>')">&times;</span>

                            <div class="modal-body">
                                <!-- Modal Header -->
                                <div class="bank-modal-header">
                                    <h1 class="bank-modal-name"><?php echo htmlspecialchars($bank['bankname']); ?></h1>
                                    <div class="bank-modal-subtitle">
                                        <span class="me-3">
                                            <i class="fas fa-map-pin me-1 text-muted"></i>
                                            <?php echo $fullAddress; ?>
                                        </span>
                                        <span>
                                            <i class="fas fa-clock me-1 text-muted"></i>
                                            <?php echo !empty($timings['open']) ? htmlspecialchars($timings['open']) . ' - ' . htmlspecialchars($timings['close']) : 'Hours not specified'; ?>
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
                                                                    alt="Bank Image"
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
                                                                <i class="fas fa-building"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Branch Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($bank['type'] ?? 'Bank Branch'); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-code"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Branch Code</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($bank['branchcode'] ?? 'N/A'); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-cogs"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Service Type</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($bank['servicetype'] ?? 'Full Service'); ?></div>
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
                                                                <div class="detail-value"><?php echo nl2br(htmlspecialchars($bank['servicedescription'] ?? 'No description available.')); ?></div>
                                                            </div>
                                                        </li>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-list"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Additional Services</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($bank['otherserviceinformation'] ?? 'Standard banking services'); ?></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Operating Hours -->
                                        <?php if (!empty($timings) && (isset($timings['open']) || isset($timings['close']))): ?>
                                            <div class="schedule-container mb-4">
                                                <h5 class="mb-3">
                                                    <i class="fas fa-clock me-2 text-warning"></i>
                                                    Operating Hours
                                                </h5>
                                                <div class="schedule-grid">
                                                    <?php if (isset($timings['open']) && !empty($timings['open'])): ?>
                                                        <div class="schedule-item">
                                                            <div class="schedule-time"><?php echo htmlspecialchars($timings['open']); ?></div>
                                                            <div class="schedule-label">Opens</div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (isset($timings['close']) && !empty($timings['close'])): ?>
                                                        <div class="schedule-item">
                                                            <div class="schedule-time"><?php echo htmlspecialchars($timings['close']); ?></div>
                                                            <div class="schedule-label">Closes</div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="schedule-item" style="border-left: 4px solid #ffc107;">
                                                        <div class="schedule-time">Lunch Break</div>
                                                        <div class="schedule-label">12:00 PM - 1:00 PM</div>
                                                    </div>
                                                </div>
                                                <div class="text-center mt-3">
                                                    <small class="text-muted">* Hours may vary on holidays. Please call to confirm.</small>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Right Column - Contact & Quick Actions -->
                                    <div class="col-lg-4">
                                        <!-- Contact Information -->
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-address-book me-2 text-success"></i>
                                                Contact Information
                                            </h5>
                                            <ul class="detail-list">
                                                <?php if (!empty($bank['phoneno'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Phone</h6>
                                                            <div class="detail-value">
                                                                <a href="tel:<?php echo htmlspecialchars($bank['phoneno']); ?>" class="text-decoration-none">
                                                                    <i class="fas fa-phone me-1"></i>
                                                                    <?php echo htmlspecialchars($bank['phoneno']); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($bank['email'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Email</h6>
                                                            <div class="detail-value">
                                                                <a href="mailto:<?php echo htmlspecialchars($bank['email']); ?>" class="text-decoration-none">
                                                                    <i class="fas fa-envelope me-1"></i>
                                                                    <?php echo htmlspecialchars($bank['email']); ?>
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

                                                <?php if (!empty($bank['branchcode'])): ?>
                                                    <li class="detail-item">
                                                        <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                            <i class="fas fa-hashtag"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Branch Code</h6>
                                                            <div class="detail-value fw-semibold text-primary"><?php echo htmlspecialchars($bank['branchcode']); ?></div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>

                                        <!-- Quick Actions -->
                                        <div class="sticky-top" style="top: 20px;">
                                            <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                <div class="card-header bg-primary text-white py-3 rounded-top-3">
                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="fas fa-bolt me-2"></i>
                                                        Quick Actions
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3 mt-3">
                                                    <div class="d-grid gap-2">
                                                        <?php if (!empty($bank['phoneno'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($bank['phoneno']); ?>" class="btn btn-outline-success rounded-pill py-2">
                                                                <i class="fas fa-phone me-2"></i>Call Now
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (!empty($bank['email'])): ?>
                                                            <a href="mailto:<?php echo htmlspecialchars($bank['email']); ?>" class="btn btn-outline-primary rounded-pill py-2">
                                                                <i class="fas fa-envelope me-2"></i>Send Email
                                                            </a>
                                                        <?php endif; ?>

                                                        <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-info rounded-pill py-2">
                                                            <i class="fas fa-map me-2"></i>Get Directions
                                                        </a>

                                                        <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareBank('<?php echo htmlspecialchars($bank['bankname']); ?>', '<?php echo urlencode($fullAddress); ?>')">
                                                            <i class="fas fa-share-alt me-2"></i>Share
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <?php if (!empty($bank['otherserviceinformation']) || !empty($bank['servicedescription'])): ?>
                                    <div class="col-12">
                                        <div class="modal-detail-section">
                                            <h5>
                                                <i class="fas fa-list-ul me-2 text-secondary"></i>
                                                Additional Information
                                            </h5>
                                            <div class="row">
                                                <?php if (!empty($bank['servicedescription'])): ?>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-2">Service Description</h6>
                                                        <p class="text-muted"><?php echo nl2br(htmlspecialchars($bank['servicedescription'])); ?></p>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($bank['otherserviceinformation'])): ?>
                                                    <div class="col-md-4">
                                                        <h6 class="mb-2">Additional Services</h6>
                                                        <ul class="list-unstyled text-muted small">
                                                            <?php
                                                            $services = explode(',', $bank['otherserviceinformation']);
                                                            foreach ($services as $service) {
                                                                $service = trim($service);
                                                                if (!empty($service)) {
                                                                    echo "<li><i class='fas fa-check me-1 text-success'></i>" . htmlspecialchars($service) . "</li>";
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

        <!-- Enhanced ATM Modals -->
        <?php if (!empty($atm_result) && $atm_result != "No Data Found!"): ?>
            <?php foreach ($atm_result as $row => $atm): ?>
                <?php if ($atm['visibility'] == 'on'):
                    $atmModalId = "atmModal" . $row;
                    $addressParts = explode('@', $atm['address']);
                    $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Address not available';
                    $photos = json_decode($atm['photo'], true);
                    $atmPhotos = is_array($photos) ? array_slice($photos, 0, 3) : [];
                ?>
                    <!-- Enhanced ATM Modal -->
                    <div id="<?php echo $atmModalId; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeATMMModal('<?php echo $atmModalId; ?>')">&times;</span>

                            <div class="modal-body">
                                <!-- ATM Modal Header -->
                                <div class="bank-modal-header">
                                    <h1 class="bank-modal-name"><?php echo htmlspecialchars($atm['bankname']); ?> ATM</h1>
                                    <div class="bank-modal-subtitle">
                                        <span class="me-3">
                                            <i class="fas fa-map-pin me-1 text-muted"></i>
                                            <?php echo $fullAddress; ?>
                                        </span>
                                        <span class="text-success">
                                            <i class="fas fa-clock me-1"></i>
                                            24/7 Access Available
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- ATM Photos -->
                                    <?php if (!empty($atmPhotos)): ?>
                                        <div class="col-12 mb-4">
                                            <h5 class="mb-3">
                                                <i class="fas fa-images me-2 text-info"></i>
                                                ATM Location
                                            </h5>
                                            <div class="row g-2">
                                                <?php foreach ($atmPhotos as $photo): ?>
                                                    <div class="col-12">
                                                        <div class="position-relative overflow-hidden rounded-3 shadow-sm" style="aspect-ratio: 16/9; cursor: pointer;" onclick="openPhotoModal('./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>')">
                                                            <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>"
                                                                class="w-100 h-100 object-fit-cover"
                                                                alt="ATM Location"
                                                                style="transition: transform 0.3s ease;"
                                                                onmouseover="this.style.transform='scale(1.02)'"
                                                                onmouseout="this.style.transform='scale(1)'">
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- ATM Details -->
                                    <div class="col-lg-8">
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-credit-card me-2 text-success"></i>
                                                ATM Information
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                                <i class="fas fa-building"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Bank Name</h6>
                                                                <div class="detail-value fw-semibold"><?php echo htmlspecialchars($atm['bankname']); ?></div>
                                                            </div>
                                                        </li>

                                                        <?php if (!empty($atm['branchcode'])): ?>
                                                            <li class="detail-item">
                                                                <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                                    <i class="fas fa-hashtag"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Location Code</h6>
                                                                    <div class="detail-value"><?php echo htmlspecialchars($atm['branchcode']); ?></div>
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
                                                <div class="col-md-6">
                                                    <ul class="detail-list">
                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                                <i class="fas fa-clock"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Availability</h6>
                                                                <div class="detail-value">
                                                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                                                        <i class="fas fa-check me-1"></i>24/7 Access
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li class="detail-item">
                                                            <div class="detail-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                                                                <i class="fas fa-info-circle"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Status</h6>
                                                                <div class="detail-value">
                                                                    <span class="badge bg-success rounded-pill">
                                                                        <?php echo htmlspecialchars($atm['operationalstatus'] ?? 'Operational'); ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <?php if (!empty($atm['otherserviceinformation'])): ?>
                                                            <li class="detail-item">
                                                                <div class="detail-icon" style="background: rgba(52, 58, 64, 0.1); color: #343a40;">
                                                                    <i class="fas fa-list"></i>
                                                                </div>
                                                                <div class="detail-content">
                                                                    <h6>Features</h6>
                                                                    <div class="detail-value small">
                                                                        <?php
                                                                        $features = explode(',', $atm['otherserviceinformation']);
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

                                        <!-- ATM Quick Actions -->
                                        <div class="sticky-top" style="top: 20px;">
                                            <div class="card border-0 shadow-sm rounded-3 mb-3">
                                                <div class="card-header bg-success text-white py-3 rounded-top-3">
                                                    <h6 class="mb-0 fw-semibold">
                                                        <i class="fas fa-credit-card me-2"></i>
                                                        ATM Quick Actions
                                                    </h6>
                                                </div>
                                                <div class="card-body p-3 mt-3">
                                                    <div class="d-grid gap-2">
                                                        <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-success rounded-pill py-2">
                                                            <i class="fas fa-map me-2"></i>Get Directions
                                                        </a>

                                                        <?php if (!empty($atm['phoneno'])): ?>
                                                            <a href="tel:<?php echo htmlspecialchars($atm['phoneno']); ?>" class="btn btn-outline-primary rounded-pill py-2">
                                                                <i class="fas fa-phone me-2"></i>Bank Support
                                                            </a>
                                                        <?php endif; ?>

                                                        <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareATM('<?php echo htmlspecialchars($atm['bankname']); ?> ATM', '<?php echo urlencode($fullAddress); ?>')">
                                                            <i class="fas fa-share-alt me-2"></i>Share Location
                                                        </button>

                                                        <a href="banks.php#banks-section" class="btn btn-outline-info rounded-pill py-2">
                                                            <i class="fas fa-building me-2"></i>View Bank Branches
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
        function openBankModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            // Add smooth entrance animation
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closeBankModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        }

        function openATMMModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closeATMMModal(modalId) {
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
        function shareBank(bankName, address) {
            if (navigator.share) {
                navigator.share({
                    title: bankName + ' - Village Banking',
                    text: 'Check out this bank in our village!',
                    url: window.location.href
                }).catch(console.error);
            } else {
                // Fallback to copy to clipboard
                navigator.clipboard.writeText(`${bankName}\n${address}\n${window.location.origin}`).then(() => {
                    showToast('Bank details copied to clipboard!', 'success');
                }).catch(() => {
                    showToast('Could not copy to clipboard', 'error');
                });
            }
        }

        function shareATM(atmName, address) {
            if (navigator.share) {
                navigator.share({
                    title: atmName + ' - Village ATM',
                    text: 'ATM location shared from RuralConnect Web',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(`${atmName}\n${address}\n${window.location.origin}`).then(() => {
                    showToast('ATM details copied to clipboard!', 'success');
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

            // Auto remove after 3 seconds
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