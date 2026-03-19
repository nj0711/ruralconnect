<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Events & Festivals || RuralConnect Web</title>
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
            --festival-gradient: linear-gradient(135deg, #28a745, #20c997 100%);
            --celebration-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 20px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced Events Section */
        .events-section {
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
            background: var(--festival-gradient);
            border-radius: 2px;
        }

        .section-title p {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            font-family: 'Inter', sans-serif;
        }

        /* Modern Events Cards */
        .events-card-container {
            position: relative;
        }

        .events-card {
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

        .events-card:hover {
            transform: translateY(-12px) rotateX(2deg) rotateY(2deg);
            box-shadow: var(--card-shadow-hover);
        }

        .events-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--festival-gradient);
            z-index: 2;
        }

        .events-image-container {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .events-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .events-card:hover .events-image {
            transform: scale(1.05);
        }

        .events-overlay {
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

        .events-card:hover .events-overlay {
            transform: translateY(0);
        }

        .event-name-overlay {
            font-family: 'Manrope', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .event-type-badge {
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

        /* Events Card Content */
        .events-content {
            padding: 1.75rem;
            position: relative;
        }

        .events-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        .events-main-info {
            flex-grow: 1;
        }

        .event-name {
            font-family: 'Manrope', sans-serif;
            font-size: 1.375rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }

        .event-location {
            color: #6c757d;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .event-type {
            background: var(--festival-gradient);
            color: white;
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .event-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ff6b6b;
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
            color: #ff6b6b;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Event Details Grid */
        .event-details-grid {
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
            background: rgba(255, 107, 107, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ff6b6b;
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

        .date-badge {
            background: var(--festival-gradient);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            text-align: center;
            display: inline-block;
            margin-top: 0.25rem;
        }

        /* Read More Button */
        .read-more-btn {
            background: var(--festival-gradient);
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
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
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
            .events-section {
                padding: 40px 0;
            }

            .section-title h1 {
                font-size: 2rem;
            }

            .event-details-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .events-content {
                padding: 1.25rem;
            }

            .event-name {
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
            .events-card:hover {
                transform: translateY(-4px);
            }

            .events-header {
                flex-direction: column;
                gap: 0.75rem;
                align-items: stretch;
            }

            .event-status {
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

        .event-modal-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(0, 0, 0, 0.08);
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin: -2.5rem -2.5rem 2.5rem -2.5rem;
        }

        .event-modal-name {
            font-family: 'Manrope', sans-serif;
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .event-modal-subtitle {
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
            border-left: 4px solid #ff6b6b;
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
            background: rgba(255, 107, 107, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ff6b6b;
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

        /* Event Schedule Display */
        .schedule-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 1.5rem;
        }

        .schedule-timeline {
            position: relative;
            padding-left: 2rem;
            margin-top: 1rem;
        }

        .schedule-timeline::before {
            content: '';
            position: absolute;
            left: 0.5rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--festival-gradient);
        }

        .schedule-item {
            position: relative;
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .schedule-item::before {
            content: '';
            position: absolute;
            left: -2.5rem;
            top: 0.25rem;
            width: 12px;
            height: 12px;
            background: var(--festival-gradient);
            border-radius: 50%;
            border: 2px solid white;
            z-index: 1;
        }

        .schedule-date {
            font-weight: 600;
            color: #ff6b6b;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .schedule-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.25rem;
        }

        .schedule-description {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Registration Section */
        .registration-section {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: 2px solid #ffc107;
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1.5rem 0;
        }

        .registration-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .registration-icon {
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

        .registration-title {
            color: #856404;
            font-weight: 700;
            margin: 0;
            font-size: 1.25rem;
        }

        .registration-options {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .registration-option {
            background: white;
            color: #495057;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            border: 2px solid #ffc107;
            flex: 1;
            min-width: 120px;
            text-align: center;
        }

        .registration-option:hover {
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

            .event-modal-name {
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

            .schedule-timeline {
                padding-left: 1rem;
            }

            .schedule-item {
                padding-left: 1rem;
            }
        }

        @media (max-width: 576px) {
            .events-card:hover {
                transform: translateY(-4px);
            }

            .event-name {
                font-size: 1.125rem;
            }

            .events-content {
                padding: 1rem;
            }

            .registration-options {
                flex-direction: column;
            }
        }

        /* Loading Animation for Images */
        .events-image-loading {
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

        /* Event Countdown */
        .countdown-container {
            background: linear-gradient(135deg, var(--festival-gradient));
            color: white;
            padding: 1.5rem;
            border-radius: 15px;
            text-align: center;
            margin: 1rem 0;
        }

        .countdown-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .countdown-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            max-width: 300px;
            margin: 0 auto;
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.75rem;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .countdown-number {
            font-size: 1.5rem;
            font-weight: 700;
            display: block;
        }

        .countdown-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        /* Event Categories */
        .event-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .category-badge {
            background: rgba(255, 107, 107, 0.1);
            color: #ff6b6b;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            border: 1px solid rgba(255, 107, 107, 0.2);
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

        @media (max-width: 768px) {
            .countdown-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.75rem;
            }

            .countdown-number {
                font-size: 1.25rem;
            }
        }
    </style>

</head>

<body>

    <?php include "header.php"; ?>
    <!-- connection -->
    <?php
    include_once('admin/config.php');
    $obj = new ConnDb();

    $table = 'eventsfestivals';
    $values = 'SELECT * FROM eventsfestivals WHERE visibility = "on" ORDER BY startdate ASC';
    $events_result = $obj->selectdata($table, $values);
    ?>

    <div class="page-wrapper">
        <section class="page-banner">
            <div class="container">
                <div class="page-banner-title">
                    <h3>Events & Festivals</h3>
                  
                </div><!-- page-banner-title -->
            </div><!-- container -->
        </section>
        <!--page-banner-->

        <!-- Events Section -->
        <section class="events-section" id="events-section">
            <div class="container">
                <div class="section-title">
                    <h1>Upcoming Events & Festivals</h1>
                    <p class="lead">Celebrate the rich cultural heritage of our village through vibrant festivals, community events, and traditional celebrations. Join us in creating unforgettable memories!</p>
                </div>

                <?php if (empty($events_result) || $events_result == "No Data Found!"): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3>No Events Scheduled</h3>
                        <p>No upcoming events or festivals are currently scheduled in your village area. Check back soon for exciting celebrations and community gatherings!</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap mt-3">
                            <a href="contact.php" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                <i class="fas fa-envelope me-2"></i>Suggest Event
                            </a>
                            <a href="contact.php" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="fas fa-users me-2"></i>Contact Community
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row g-4 events-card-container">
                        <?php foreach ($events_result as $row => $event): ?>
                            <?php
                            $eventModalId = "eventModal" . $row;
                            $addressParts = explode('@', $event['venueaddress'] ?? $event['address'] ?? '');
                            $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Village Community Center';

                            // Calculate days remaining
                            $startDate = new DateTime($event['startdate']);
                            $today = new DateTime();
                            $daysRemaining = max(0, $startDate->diff($today)->days);
                            $status = $daysRemaining == 0 ? 'Today' : ($daysRemaining == 1 ? 'Tomorrow' : $daysRemaining . ' days');
                            ?>
                            <!-- Enhanced Event Card -->
                            <div class="col-lg-6 col-xl-4">
                                <div class="events-card h-100 position-relative">
                                    <!-- Event Image Container -->

                                    <!-- Event Content -->
                                    <div class="events-content">
                                        <div class="events-header">
                                            <div class="events-main-info">
                                                <h4 class="event-name"><?php echo htmlspecialchars($event['eventname']); ?></h4>
                                                <div class="event-location"><?php echo $fullAddress; ?></div>
                                                <span class="event-type"><?php echo htmlspecialchars($event['eventtype']); ?></span>
                                            </div>

                                            <div class="event-status">
                                                <div class="status-indicator"></div>
                                                <span class="status-text"><?php echo $status; ?></span>
                                            </div>
                                        </div>

                                        <!-- Event Quick Details -->
                                        <div class="event-details-grid">
                                            <div class="detail-item">
                                                <div class="detail-icon" style="background: rgba(255, 107, 107, 0.1); color: #ff6b6b;">
                                                    <i class="fas fa-calendar-day"></i>
                                                </div>
                                                <div class="detail-content">
                                                    <h6>Dates</h6>
                                                    <div class="detail-value">
                                                        <?php echo date('M d, Y', strtotime($event['startdate'])); ?>
                                                        <?php if ($event['enddate'] != $event['startdate']): ?>
                                                            <br><small class="text-muted">to <?php echo date('M d, Y', strtotime($event['enddate'])); ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="detail-item">
                                                <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                                <div class="detail-content">
                                                    <h6>Time</h6>
                                                    <div class="detail-value"><?php echo htmlspecialchars($event['time'] ?? 'All Day'); ?></div>
                                                </div>
                                            </div>

                                            <?php if (!empty($event['contactnumber'])): ?>
                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(108, 117, 125, 0.1); color: #6c757d;">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Contact</h6>
                                                        <div class="detail-value">
                                                            <a href="tel:<?php echo htmlspecialchars($event['contactnumber']); ?>" style="color: #6c757d; text-decoration: none;">
                                                                <?php echo htmlspecialchars($event['contactnumber']); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($event['capacity'])): ?>
                                                <div class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                        <i class="fas fa-users"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Capacity</h6>
                                                        <div class="detail-value"><?php echo htmlspecialchars($event['capacity']); ?> attendees</div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Event Read More Button -->
                                        <div style="margin-top: auto;">
                                            <button class="read-more-btn" onclick="openEventModal('<?php echo $eventModalId; ?>')">
                                                <i class="fas fa-ticket-alt"></i>
                                                <span>Event Details</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Enhanced Event Modals -->
        <?php if (!empty($events_result) && $events_result != "No Data Found!"): ?>
            <?php foreach ($events_result as $row => $event): ?>
                <?php
                $eventModalId = "eventModal" . $row;
                $addressParts = explode('@', $event['venueaddress'] ?? $event['address'] ?? '');
                $fullAddress = !empty($addressParts) ? implode(', ', array_filter($addressParts)) : 'Village Community Center';
                $photos = json_decode($event['photo'] ?? '[]', true);
                $photoGallery = is_array($photos) ? array_slice($photos, 0, 6) : [];

                // Parse schedule if available
                $scheduleItems = !empty($event['schedule']) ? json_decode($event['schedule'], true) : [];

                // Event categories
                $categories = !empty($event['categories']) ? explode(',', $event['categories']) : [];
                ?>
                <!-- Enhanced Event Modal -->
                <div id="<?php echo $eventModalId; ?>" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeEventModal('<?php echo $eventModalId; ?>')">&times;</span>

                        <div class="modal-body">
                            <!-- Modal Header -->
                            <div class="event-modal-header">
                                <h1 class="event-modal-name"><?php echo htmlspecialchars($event['eventname']); ?></h1>
                                <div class="event-modal-subtitle">
                                    <span class="me-3">
                                        <i class="fas fa-calendar-alt me-1 text-muted"></i>
                                        <?php echo date('F d, Y', strtotime($event['startdate'])); ?>
                                        <?php if ($event['enddate'] != $event['startdate']): ?>
                                            <span class="mx-1">to</span>
                                            <?php echo date('F d, Y', strtotime($event['enddate'])); ?>
                                        <?php endif; ?>
                                    </span>
                                    <span class="me-3">
                                        <i class="fas fa-map-pin me-1 text-muted"></i>
                                        <?php echo $fullAddress; ?>
                                    </span>
                                    <?php if (!empty($event['time'])): ?>
                                        <span>
                                            <i class="fas fa-clock me-1 text-muted"></i>
                                            <?php echo htmlspecialchars($event['time']); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Event Countdown -->
                                <?php
                                $startDate = new DateTime($event['startdate']);
                                $today = new DateTime();
                                $interval = $startDate->diff($today);
                                $days = $interval->days;
                                $hours = $interval->h;
                                $minutes = $interval->i;
                                $seconds = $interval->s;
                                ?>
                                <?php if ($days > 0): ?>
                                    <div class="countdown-container mt-3">
                                        <div class="countdown-title">Time Until Event</div>
                                        <div class="countdown-grid">
                                            <div class="countdown-item">
                                                <span class="countdown-number"><?php echo $days; ?></span>
                                                <span class="countdown-label">Days</span>
                                            </div>
                                            <div class="countdown-item">
                                                <span class="countdown-number"><?php echo $hours; ?></span>
                                                <span class="countdown-label">Hours</span>
                                            </div>
                                            <div class="countdown-item">
                                                <span class="countdown-number"><?php echo $minutes; ?></span>
                                                <span class="countdown-label">Minutes</span>
                                            </div>
                                            <div class="countdown-item">
                                                <span class="countdown-number"><?php echo $seconds; ?></span>
                                                <span class="countdown-label">Seconds</span>
                                            </div>
                                        </div>
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
                                                Event Gallery
                                            </h5>
                                            <div class="gallery-grid">
                                                <?php foreach ($photoGallery as $photo): ?>
                                                    <div class="gallery-item" onclick="openPhotoModal('./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>')">
                                                        <img src="./admin/pages/uploadedimages/<?php echo htmlspecialchars($photo); ?>"
                                                            alt="Event Gallery"
                                                            loading="lazy">
                                                        <div class="gallery-overlay">
                                                            <i class="fas fa-expand-arrows-alt"></i>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Event Categories -->
                                    <?php if (!empty($categories)): ?>
                                        <div class="mb-3">
                                            <h6 class="text-muted mb-2">
                                                <i class="fas fa-tags me-2"></i>Event Categories
                                            </h6>
                                            <div class="event-categories">
                                                <?php foreach ($categories as $category):
                                                    $category = trim($category);
                                                    if (!empty($category)):
                                                ?>
                                                        <span class="category-badge"><?php echo htmlspecialchars($category); ?></span>
                                                <?php endif;
                                                endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Event Details -->
                                    <div class="modal-detail-section mb-4">
                                        <h5>
                                            <i class="fas fa-info-circle me-2 text-info"></i>
                                            Event Information
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="detail-list">
                                                    <li class="detail-item">
                                                        <div class="detail-icon">
                                                            <i class="fas fa-calendar-week"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Event Type</h6>
                                                            <div class="detail-value"><?php echo htmlspecialchars($event['eventtype']); ?></div>
                                                        </div>
                                                    </li>
                                                    <li class="detail-item">
                                                        <div class="detail-icon">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </div>
                                                        <div class="detail-content">
                                                            <h6>Venue</h6>
                                                            <div class="detail-value"><?php echo $fullAddress; ?></div>
                                                        </div>
                                                    </li>
                                                    <?php if (!empty($event['organizer'])): ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-user-tie"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Organizer</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($event['organizer']); ?></div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="detail-list">
                                                    <?php if (!empty($event['capacity'])): ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-users"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Capacity</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($event['capacity']); ?> people</div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if (!empty($event['agegroup'])): ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-child"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Age Group</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($event['agegroup']); ?></div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if (!empty($event['entryfee'])): ?>
                                                        <li class="detail-item">
                                                            <div class="detail-icon">
                                                                <i class="fas fa-ticket-alt"></i>
                                                            </div>
                                                            <div class="detail-content">
                                                                <h6>Entry Fee</h6>
                                                                <div class="detail-value"><?php echo htmlspecialchars($event['entryfee']); ?></div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Event Description -->
                                    <?php if (!empty($event['description'])): ?>
                                        <div class="modal-detail-section mb-4">
                                            <h5>
                                                <i class="fas fa-align-left me-2 text-secondary"></i>
                                                About the Event
                                            </h5>
                                            <div class="detail-value" style="color: #495057; line-height: 1.6;">
                                                <?php echo nl2br(htmlspecialchars($event['description'])); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Event Schedule -->
                                    <?php if (!empty($scheduleItems) && is_array($scheduleItems)): ?>
                                        <div class="schedule-container mb-4">
                                            <h5 class="mb-3">
                                                <i class="fas fa-list-timeline me-2 text-warning"></i>
                                                Event Schedule
                                            </h5>
                                            <div class="schedule-timeline">
                                                <?php foreach ($scheduleItems as $item):
                                                    $itemDate = !empty($item['date']) ? date('M d, Y', strtotime($item['date'])) : date('M d, Y', strtotime($event['startdate']));
                                                ?>
                                                    <div class="schedule-item">
                                                        <div class="schedule-date"><?php echo $itemDate; ?></div>
                                                        <div class="schedule-title"><?php echo htmlspecialchars($item['title'] ?? 'Activity'); ?></div>
                                                        <div class="schedule-description"><?php echo htmlspecialchars($item['time'] ?? ''); ?> - <?php echo nl2br(htmlspecialchars($item['description'] ?? '')); ?></div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Right Column - Contact & Registration -->
                                <div class="col-lg-4">

                                    <!-- Contact Information -->
                                    <div class="modal-detail-section mb-4">
                                        <h5>
                                            <i class="fas fa-address-book me-2 text-success"></i>
                                            Contact Information
                                        </h5>
                                        <ul class="detail-list">
                                            <?php if (!empty($event['contactnumber'])): ?>
                                                <li class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(40, 167, 69, 0.1); color: #28a745;">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Phone</h6>
                                                        <div class="detail-value">
                                                            <a href="tel:<?php echo htmlspecialchars($event['contactnumber']); ?>" class="text-decoration-none">
                                                                <i class="fas fa-phone me-1"></i>
                                                                <?php echo htmlspecialchars($event['contactnumber']); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>

                                            <?php if (!empty($event['email'])): ?>
                                                <li class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                        <i class="fas fa-envelope"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Email</h6>
                                                        <div class="detail-value">
                                                            <a href="mailto:<?php echo htmlspecialchars($event['email']); ?>" class="text-decoration-none">
                                                                <i class="fas fa-envelope me-1"></i>
                                                                <?php echo htmlspecialchars($event['email']); ?>
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

                                            <?php if (!empty($event['website'])): ?>
                                                <li class="detail-item">
                                                    <div class="detail-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                                                        <i class="fas fa-globe"></i>
                                                    </div>
                                                    <div class="detail-content">
                                                        <h6>Website</h6>
                                                        <div class="detail-value">
                                                            <a href="<?php echo htmlspecialchars($event['website']); ?>" target="_blank" class="text-decoration-none">
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
                                            <div class="card-header" style="background: var(--festival-gradient); color: white; padding: 1rem; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                                <h6 class="mb-0 fw-semibold">
                                                    <i class="fas fa-ticket-alt me-2"></i>
                                                    Quick Actions
                                                </h6>
                                            </div>
                                            <div class="card-body p-3 mt-3">
                                                <div class="d-grid gap-2">
                                                    <?php if (!empty($event['registrationlink'])): ?>
                                                        <a href="<?php echo htmlspecialchars($event['registrationlink']); ?>" target="_blank" class="btn btn-warning rounded-pill py-2">
                                                            <i class="fas fa-globe me-2"></i>Register Online
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if (!empty($event['contactnumber'])): ?>
                                                        <a href="tel:<?php echo htmlspecialchars($event['contactnumber']); ?>" class="btn btn-outline-success rounded-pill py-2">
                                                            <i class="fas fa-phone me-2"></i>Call Organizer
                                                        </a>
                                                    <?php endif; ?>

                                                    <a href="https://maps.google.com/?q=<?php echo urlencode($fullAddress); ?>" target="_blank" class="btn btn-outline-info rounded-pill py-2">
                                                        <i class="fas fa-map me-2"></i>Get Directions
                                                    </a>

                                                    <button class="btn btn-outline-secondary rounded-pill py-2" onclick="shareEvent('<?php echo htmlspecialchars($event['eventname']); ?>', '<?php echo urlencode($fullAddress); ?>')">
                                                        <i class="fas fa-share-alt me-2"></i>Share Event
                                                    </button>

                                                    <?php if (!empty($event['website'])): ?>
                                                        <a href="<?php echo htmlspecialchars($event['website']); ?>" target="_blank" class="btn btn-outline-primary rounded-pill py-2">
                                                            <i class="fas fa-external-link-alt me-2"></i>Event Website
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
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
        function openEventModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
            modal.classList.add('show');
            setTimeout(() => modal.classList.remove('show'), 300);
        }

        function closeEventModal(modalId) {
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
        function shareEvent(eventName, address) {
            if (navigator.share) {
                navigator.share({
                    title: eventName + ' - Village Celebration',
                    text: 'Join us for this exciting event in our village!',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(`${eventName}\n📍 ${address}\n📅 ${new Date().toLocaleDateString()}\n${window.location.origin}`).then(() => {
                    showToast('Event details copied to clipboard!', 'success');
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

        // Dynamic countdown update
        function updateCountdown() {
            const countdownContainers = document.querySelectorAll('.countdown-container');
            countdownContainers.forEach(container => {
                // This would need server-side date calculation for accuracy
                // For demo purposes, we'll skip real-time updates
            });
        }

        // Initialize countdown on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCountdown();
            // Update every minute
            setInterval(updateCountdown, 60000);
        });

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