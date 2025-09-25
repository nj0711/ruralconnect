<?php
session_start();
if (!isset($_SESSION['village_admin_email'])) {
    header("Location: index.php");
    exit();
}

// Set the timeout duration (in seconds)
$timeout_duration = 600; // 10 minutes

// Check if last activity is set and calculate the inactivity period
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Last request was over 10 minutes ago, so destroy the session
    session_unset();     // Unset session variables
    session_destroy();   // Destroy the session
    header("Location: index.php"); // Redirect to login page
    exit();
}

// Update the last activity timestamp to the current time
$_SESSION['LAST_ACTIVITY'] = time();

include("./config.php");
$obj = new ConnDb();

$query = "select * from villagebasic";
$res = $obj->selectdata("villagebasic", $query);

$name = $res[0]['name'] ?? 'Village Admin';

// Get village ID - handle your selectdata return format
$selQ = "select villageid from villagebasic";
$village_result = $obj->selectdata("villagebasic", $selQ);
$village_id = 1; // Default fallback
if ($village_result != "No Data Found!" && is_array($village_result) && !empty($village_result)) {
    $village_id = $village_result[0]['villageid'];
}

// Function to get service statistics - Updated for your selectdata function
function getServiceStats($obj, $table_name, $village_id, $name)
{
    try {
        // Get visible count
        $visible_query = "SELECT COUNT(*) as count FROM $table_name WHERE villageid = $village_id AND visibility = 'on'";
        $visible_result = $obj->selectdata($table_name, $visible_query);

        // Get total count
        $total_query = "SELECT COUNT(*) as count FROM $table_name WHERE villageid = $village_id";
        $total_result = $obj->selectdata($table_name, $total_query);

        $visible_count = 0;
        $total_count = 0;

        // Handle visible count
        if ($visible_result != "No Data Found!" && is_array($visible_result) && !empty($visible_result)) {
            $visible_count = intval($visible_result[0]['count']);
        }

        // Handle total count
        if ($total_result != "No Data Found!" && is_array($total_result) && !empty($total_result)) {
            $total_count = intval($total_result[0]['count']);
        }

        return [
            'name' => $name,
            'visible' => $visible_count,
            'total' => $total_count,
            'percentage' => $total_count > 0 ? round(($visible_count / $total_count) * 100, 1) : 0
        ];
    } catch (Exception $e) {
        error_log("Service stats error for $table_name: " . $e->getMessage());
        return [
            'name' => $name,
            'visible' => 0,
            'total' => 0,
            'percentage' => 0
        ];
    }
}

// Get statistics for all services - Updated for your selectdata function
$services_stats = [
    'Banking' => getServiceStats($obj, 'banks', $village_id, 'Banking'),
    'Hospitals' => getServiceStats($obj, 'hospitals', $village_id, 'Hospitals'),
    'Education' => getServiceStats($obj, 'education', $village_id, 'Education'),
    'Emergency Services' => getServiceStats($obj, 'emergencyservices', $village_id, 'Emergency Services'),
    'Employment Centers' => getServiceStats($obj, 'employmentcenters', $village_id, 'Employment Centers'),
    'Events & Festivals' => getServiceStats($obj, 'eventsfestivals', $village_id, 'Events & Festivals'),
    'Fuel Stations' => getServiceStats($obj, 'fuelstation', $village_id, 'Fuel Stations'),
    'Hotels' => getServiceStats($obj, 'hotels', $village_id, 'Hotels'),
    'Restaurants' => getServiceStats($obj, 'restaurants', $village_id, 'Restaurants'),
    'Tourism Places' => getServiceStats($obj, 'tourismplaces', $village_id, 'Tourism Places'),
    'Places to Worship' => getServiceStats($obj, 'placestoworship', $village_id, 'Places to Worship'),
    'Pillar of Community' => getServiceStats($obj, 'pillarofcommunity', $village_id, 'Pillar of Community')
];

// Calculate overall statistics
$total_services = count($services_stats);
$total_visible = array_sum(array_column($services_stats, 'visible'));
$total_records = array_sum(array_column($services_stats, 'total'));
$overall_percentage = $total_records > 0 ? round(($total_visible / $total_records) * 100, 1) : 0;

// Get top services by count
$top_services = [];
foreach ($services_stats as $service) {
    if ($service['total'] > 0) {
        $top_services[] = $service;
    }
}
usort($top_services, function ($a, $b) {
    return $b['total'] - $a['total'];
});
$top_services = array_slice($top_services, 0, 5); // Top 5

// Calculate active services (services with data)
$active_services = 0;
foreach ($services_stats as $service) {
    if ($service['total'] > 0) {
        $active_services++;
    }
}

// Generate recent activity data (simplified for your function)
$chart_labels = [];
$chart_data = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $chart_labels[] = date('M d', strtotime("-$i days"));

    // Get daily activity for this date
    $daily_query = "SELECT COUNT(*) as count FROM (
        SELECT created_at FROM banks WHERE villageid = $village_id AND DATE(created_at) = '$date'
        UNION ALL SELECT created_at FROM hospitals WHERE villageid = $village_id AND DATE(created_at) = '$date'
        UNION ALL SELECT created_at FROM education WHERE villageid = $village_id AND DATE(created_at) = '$date'
    ) combined";
    $daily_result = $obj->selectdata("combined", $daily_query);

    $daily_count = 0;
    if ($daily_result != "No Data Found!" && is_array($daily_result) && !empty($daily_result)) {
        $daily_count = intval($daily_result[0]['count']);
    }
    $chart_data[] = $daily_count;
}

echo "<script>
    const villageName = '" . addslashes($name) . "';
    const servicesStats = " . json_encode($services_stats) . ";
    const topServices = " . json_encode($top_services) . ";
    const chartLabels = " . json_encode($chart_labels) . ";
    const chartData = " . json_encode($chart_data) . ";
    const activeServices = $active_services;
</script>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page Title -->
    <title>Dashboard | <?php echo htmlspecialchars($name); ?> Admin Panel</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="images/villagelogo.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Dashboard CSS -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --secondary-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);

            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 20px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 15px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-gradient);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lds-ripple {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ripple div {
            position: absolute;
            border: 4px solid #fff;
            opacity: 1;
            border-radius: 50%;
            animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
        }

        .lds-ripple div:nth-child(2) {
            animation-delay: -0.5s;
        }

        @keyframes lds-ripple {
            0% {
                top: 36px;
                left: 36px;
                width: 0;
                height: 0;
                opacity: 1;
            }

            100% {
                top: 0px;
                left: 0px;
                width: 72px;
                height: 72px;
                opacity: 0;
            }
        }

        /* Main Container */
        #main-wrapper {
            min-height: 100vh;
        }

        /* Dashboard Hero Section */
        .dashboard-hero {
            background: var(--primary-gradient);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            position: relative;
            overflow: hidden;
        }

        .dashboard-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.1;
        }

        .dashboard-hero .container {
            position: relative;
            z-index: 2;
        }

        #typewriter {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: clamp(2rem, 5vw, 3.5rem);
            display: inline-block;
            overflow: hidden;
            border-right: 3px solid rgba(255, 255, 255, 0.8);
            white-space: nowrap;
            margin: 0 auto;
            letter-spacing: 2px;
            animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
            background: linear-gradient(45deg, #fff, rgba(255, 255, 255, 0.8));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @keyframes typing {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent;
            }

            50% {
                border-color: rgba(255, 255, 255, 0.8);
            }
        }

        .lead {
            font-size: 1.25rem;
            font-weight: 300;
            opacity: 0.9;
            margin-top: 1rem !important;
        }

        /* Stat Cards */
        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
            opacity: 0;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow-hover);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card .card-body {
            padding: 1.5rem;
        }

        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            line-height: 1;
        }

        .stat-card h6 {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            opacity: 0.8;
        }

        .stat-card .rounded-circle {
            transition: var(--transition);
        }

        .stat-card:hover .rounded-circle {
            transform: scale(1.1);
        }

        /* Service Cards */
        .service-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary-gradient);
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
        }

        .service-card .card-header {
            background: transparent !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
            padding: 1.25rem 1.5rem;
        }

        .service-card .card-title {
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .service-card .table {
            margin: 0;
        }

        .service-card .table th {
            background: rgba(0, 123, 255, 0.02);
            border-top: none;
            font-weight: 500;
            color: #495057;
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }

        .service-card .table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-color: rgba(0, 0, 0, 0.03);
        }

        .service-card .progress {
            height: 8px;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .service-card .progress-bar {
            border-radius: 10px;
            transition: width 0.6s ease;
            background: var(--info-gradient);
            box-shadow: 0 2px 4px rgba(0, 123, 255, 0.2);
        }

        /* Quick Action Buttons */
        .quick-action-btn {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid rgba(0, 123, 255, 0.2);
            color: #2c3e50;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .quick-action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .quick-action-btn:hover::before {
            left: 100%;
        }

        .quick-action-btn:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-color: #007bff;
            color: #007bff;
            text-decoration: none;
        }

        .quick-action-btn i {
            transition: var(--transition);
        }

        .quick-action-btn:hover i {
            transform: scale(1.2);
        }

        .quick-action-btn small {
            font-size: 0.75rem;
            opacity: 0.8;
        }

        /* Top Services */
        .top-service {
            background: var(--primary-gradient);
            color: white;
            border: none;
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .top-service::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .top-service:hover::before {
            left: 100%;
        }

        .top-service:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
            text-decoration: none;
        }

        /* Recent Activity Card */
        .recent-activity {
            background: var(--warning-gradient);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
        }

        .recent-activity .card-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: none;
            color: white;
        }

        .recent-activity .card-title {
            color: white;
            font-weight: 600;
        }

        /* Needs Attention Card */
        .needs-attention {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 193, 7, 0.2);
            backdrop-filter: blur(10px);
        }

        .needs-attention .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .needs-attention .list-group-item {
            border: none;
            padding: 1rem;
            margin-bottom: 0.5rem;
            border-radius: 10px;
            background: rgba(255, 193, 7, 0.05);
            transition: var(--transition);
            border-left: 4px solid #ffc107;
        }

        .needs-attention .list-group-item:hover {
            background: rgba(255, 193, 7, 0.1);
            transform: translateX(5px);
        }

        /* Import Summary Cards */
        .import-summary-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .import-summary-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .import-summary-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow-hover);
        }

        .import-summary-card .border-primary {
            border-left: 4px solid #007bff !important;
        }

        .import-summary-card .border-success {
            border-left: 4px solid #28a745 !important;
        }

        .import-summary-card .border-info {
            border-left: 4px solid #17a2b8 !important;
        }

        .import-summary-card .border-warning {
            border-left: 4px solid #ffc107 !important;
        }

        /* Progress Bars */
        .health-score-progress {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 50px;
            height: 12px;
            overflow: hidden;
        }

        .health-score-progress .progress-bar {
            border-radius: 50px;
            transition: width 1s ease-in-out;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
        }

        .health-score-progress .progress-bar-success {
            background: var(--success-gradient);
        }

        /* Buttons */
        .btn {
            border-radius: 25px;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4191 100%);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: var(--success-gradient);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #0d8b74 0%, #2dd885 100%);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .btn-info {
            background: var(--info-gradient);
            border: none;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #45a1f3 0%, #00e6f6 100%);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
        }

        .btn-warning {
            background: var(--warning-gradient);
            border: none;
            color: white;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #e877f5 0%, #f34d59 100%);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
            color: white;
        }

        /* Export Buttons */
        .export-btn {
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }

        .export-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .export-btn:hover::after {
            width: 300px;
            height: 300px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-hero {
                padding: 2rem 0;
                margin-bottom: 2rem;
            }

            #typewriter {
                font-size: 1.75rem !important;
            }

            .lead {
                font-size: 1rem !important;
            }

            .stat-card h3 {
                font-size: 2rem;
            }

            .quick-action-btn {
                padding: 1rem !important;
                margin: 2px !important;
            }

            .quick-action-btn i {
                font-size: 1.5rem !important;
            }

            .quick-action-btn small {
                font-size: 0.7rem !important;
            }

            .chart-container {
                height: 280px !important;
            }

            .service-card .table th,
            .service-card .table td {
                padding: 0.75rem !important;
                font-size: 0.875rem;
            }
        }

        @media (max-width: 576px) {
            .dashboard-hero h1 {
                font-size: 1.5rem !important;
            }

            .stat-card {
                margin-bottom: 1rem;
            }

            .btn-group-sm .btn {
                padding: 0.375rem 0.75rem;
                font-size: 0.75rem;
            }

            .top-service {
                padding: 0.75rem !important;
            }

            .top-service .badge {
                font-size: 0.75rem !important;
                padding: 0.25rem 0.5rem !important;
            }
        }

        /* Loading Animation for Charts */
        .chart-loading {
            position: relative;
        }

        .chart-loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            margin: -20px 0 0 -20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gradient);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4191 100%);
        }
    </style>
</head>

<body class="bg-gradient">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
        <div class="mt-3 text-white text-center">
            <div class="spinner-border spinner-border-sm me-2" role="status"></div>
            <small>Loading Dashboard...</small>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include('./header.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- Dashboard Hero Section -->
            <section class="dashboard-hero">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 text-center">
                            <h1 id="typewriter" class="display-4 fw-bold mb-3"></h1>
                            <div class="row justify-content-center g-3">
                                <div class="col-auto">
                                    <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-pill px-4 py-2">
                                        <i class="fas fa-home me-2"></i>
                                        <small><?php echo htmlspecialchars($name); ?></small>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-pill px-4 py-2">
                                        <i class="fas fa-chart-line me-2"></i>
                                        <small><?php echo $overall_percentage; ?>% Complete</small>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-pill px-4 py-2">
                                        <i class="fas fa-database me-2"></i>
                                        <small><?php echo $total_records; ?> Records</small>
                                    </div>
                                </div>
                            </div>
                            <p class="lead mt-4 opacity-90">Comprehensive overview of village services, population, and analytics</p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="container-fluid px-4">
                <!-- Overall Statistics Cards -->
                <div class="row mb-5 g-4">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card stat-card h-100 text-center position-relative overflow-hidden">
                            <div class="card-body py-4">
                                <div class="position-absolute top-0 start-0 bg-primary bg-opacity-10 rounded-end" style="height: 100%; width: 20px;"></div>
                                <div class="mb-3">
                                    <i class="fas fa-database fa-3x text-primary mb-3"></i>
                                </div>
                                <h3 class="text-primary mb-1 fw-bold"><?php echo number_format($total_records); ?></h3>
                                <h6 class="text-muted mb-0">Total Records</h6>
                                <small class="text-muted d-block mt-1">Across all services</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card stat-card h-100 text-center position-relative overflow-hidden">
                            <div class="card-body py-4">
                                <div class="position-absolute top-0 end-0 bg-success bg-opacity-10 rounded-start" style="height: 100%; width: 20px;"></div>
                                <div class="mb-3">
                                    <i class="fas fa-eye fa-3x text-success mb-3"></i>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <h3 class="text-success mb-0 me-2 fw-bold"><?php echo number_format($total_visible); ?></h3>
                                    <small class="text-success fw-bold"><?php echo $overall_percentage; ?><span class="fs-6">%</span></small>
                                </div>
                                <h6 class="text-muted mb-0">Visible Entries</h6>
                                <small class="text-muted d-block mt-1">Publicly accessible data</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card stat-card h-100 text-center position-relative overflow-hidden">
                            <div class="card-body py-4">
                                <div class="position-absolute top-0 start-50 translate-middle-x bg-info bg-opacity-10 rounded-bottom" style="height: 20px; width: 100%;"></div>
                                <div class="mb-3">
                                    <i class="fas fa-th fa-3x text-info mb-3"></i>
                                </div>
                                <h3 class="text-info mb-1 fw-bold"><?php echo $active_services; ?></h3>
                                <h6 class="text-muted mb-0">Active Services</h6>
                                <small class="text-muted d-block mt-1"><?php echo $total_services - $active_services; ?> inactive</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card stat-card h-100 text-center position-relative overflow-hidden">
                            <div class="card-body py-4">
                                <div class="position-absolute bottom-0 end-0 bg-warning bg-opacity-10 rounded-top-left" style="height: 20px; width: 50%;"></div>
                                <div class="mb-3">
                                    <i class="fas fa-bolt fa-3x text-warning mb-3"></i>
                                </div>
                                <h3 class="text-warning mb-1 fw-bold"><?php echo date('d'); ?></h3>
                                <h6 class="text-muted mb-0">Today's Activity</h6>
                                <small class="text-muted d-block mt-1">Updated today</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Grid -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card service-card position-relative overflow-hidden">
                            <div class="position-absolute top-0 start-0" style="height: 4px; width: 100%; background: var(--primary-gradient);"></div>
                            <div class="card-header bg-white border-0 position-relative">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0 fw-semibold">
                                        <i class="fas fa-bolt text-primary me-2"></i>
                                        Quick Actions
                                    </h5>
                                    <small class="text-muted">Navigate to your services</small>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="banks.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 mb-2" style="width: 60px; height: 60px;">
                                                <i class="fas fa-university text-primary" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-primary">Banking</small>
                                            <small class="text-muted text-center mt-1">Financial Services</small>
                                        </a>
                                    </div>

                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="hospitals.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-3 mb-2" style="width: 60px; height: 60px;">
                                                <i class="fas fa-hospital text-success" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-success">Hospitals</small>
                                            <small class="text-muted text-center mt-1">Healthcare</small>
                                        </a>
                                    </div>

                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="education.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="bg-info bg-opacity-10 rounded-circle p-3 mb-2" style="width: 60px; height: 60px;">
                                                <i class="fas fa-graduation-cap text-info" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-info">Education</small>
                                            <small class="text-muted text-center mt-1">Schools & Colleges</small>
                                        </a>
                                    </div>

                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="emergencyservices.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="bg-danger bg-opacity-10 rounded-circle p-3 mb-2" style="width: 60px; height: 60px;">
                                                <i class="fas fa-ambulance text-danger" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-danger">Emergency</small>
                                            <small class="text-muted text-center mt-1">24/7 Services</small>
                                        </a>
                                    </div>

                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="employmentcenters.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="bg-warning bg-opacity-10 rounded-circle p-3 mb-2" style="width: 60px; height: 60px;">
                                                <i class="fas fa-briefcase text-warning" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-warning">Employment</small>
                                            <small class="text-muted text-center mt-1">Job Centers</small>
                                        </a>
                                    </div>

                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="tourismplaces.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="bg-secondary bg-opacity-10 rounded-circle p-3 mb-2" style="width: 60px; height: 60px;">
                                                <i class="fas fa-mountain text-secondary" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-secondary">Tourism</small>
                                            <small class="text-muted text-center mt-1">Attractions</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Service Statistics Table -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card service-card position-relative overflow-hidden">
                            <div class="position-absolute top-0 start-0" style="height: 4px; width: 100%; background: var(--primary-gradient);"></div>
                            <div class="card-header bg-white border-0 position-relative">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div>
                                        <h5 class="card-title mb-0 fw-semibold">
                                            <i class="fas fa-chart-bar text-primary me-2"></i>
                                            Service Statistics
                                        </h5>
                                        <small class="text-muted">Complete overview of all village services</small>
                                    </div>
                                    <div class="btn-group btn-group-sm mt-2 mt-md-0" role="group">
                                        <button type="button" class="btn btn-outline-primary btn-filter active px-3 py-1" onclick="filterServices('all')" data-filter="all">
                                            <i class="fas fa-th me-1"></i>All
                                        </button>
                                        <button type="button" class="btn btn-outline-success btn-filter px-3 py-1" onclick="filterServices('health')" data-filter="health">
                                            <i class="fas fa-heartbeat me-1"></i>Health
                                        </button>
                                        <button type="button" class="btn btn-outline-info btn-filter px-3 py-1" onclick="filterServices('education')" data-filter="education">
                                            <i class="fas fa-book me-1"></i>Education
                                        </button>
                                        <button type="button" class="btn btn-outline-warning btn-filter px-3 py-1" onclick="filterServices('tourism')" data-filter="tourism">
                                            <i class="fas fa-mountain me-1"></i>Tourism
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0" id="servicesTable">
                                        <thead class="table-light sticky-top">
                                            <tr>
                                                <th class="border-0 py-3 px-4">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-list me-2 text-primary"></i>
                                                        Service
                                                    </div>
                                                </th>
                                                <th class="border-0 py-3 px-3 text-center">Total</th>
                                                <th class="border-0 py-3 px-3 text-center">Visible</th>
                                                <th class="border-0 py-3 px-4">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-chart-line me-2 text-info"></i>
                                                        Visibility
                                                    </div>
                                                </th>
                                                <th class="border-0 py-3 px-3 text-center">Status</th>
                                                <th class="border-0 py-3 px-3 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            <?php foreach ($services_stats as $service): ?>
                                                <?php
                                                $status_class = $service['total'] == 0 ? 'bg-light text-dark' : ($service['percentage'] == 100 ? 'bg-success text-white' : ($service['percentage'] > 75 ? 'bg-info text-white' : 'bg-warning text-dark'));
                                                $status_text = $service['total'] == 0 ? 'Empty' : ($service['percentage'] == 100 ? 'Complete' : ($service['percentage'] > 75 ? 'Good' : 'Needs Work'));
                                                ?>
                                                <tr data-category="<?php echo getServiceCategory($service['name']); ?>" data-total="<?php echo $service['total']; ?>">
                                                    <td class="py-3 px-4">
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-light rounded-circle p-2 me-3 shadow-sm" style="width: 45px; height: 45px;">
                                                                <i class="<?php echo getServiceIcon($service['name']); ?> text-primary fs-5"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="fw-semibold text-dark"><?php echo $service['name']; ?></div>
                                                                <small class="text-muted d-block"><?php echo getServiceCategory($service['name']); ?></small>
                                                            </div>
                                                            <?php if ($service['total'] > 0): ?>
                                                                <span class="badge bg-primary bg-opacity-75 ms-2"><?php echo $service['total']; ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td class="py-3 px-3 text-center">
                                                        <span class="fw-bold fs-5 text-dark"><?php echo $service['total']; ?></span>
                                                        <?php if ($service['total'] > 0): ?>
                                                            <small class="text-muted d-block">records</small>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="py-3 px-3 text-center">
                                                        <span class="badge <?php echo $service['visible'] > 0 ? 'bg-success' : 'bg-secondary'; ?> fs-6 px-3 py-2">
                                                            <?php echo $service['visible']; ?>
                                                        </span>
                                                    </td>
                                                    <td class="py-3 px-4">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 me-3">
                                                                <div class="progress rounded-pill" style="height: 10px;" role="progressbar" aria-valuenow="<?php echo $service['percentage']; ?>" aria-valuemin="0" aria-valuemax="100">
                                                                    <div class="progress-bar rounded-pill <?php echo $service['percentage'] > 75 ? 'bg-success' : ($service['percentage'] > 50 ? 'bg-info' : 'bg-warning'); ?>"
                                                                        style="width: <?php echo $service['percentage']; ?>%;"></div>
                                                                </div>
                                                            </div>
                                                            <span class="fw-semibold text-dark"><?php echo $service['percentage']; ?>%</span>
                                                        </div>
                                                    </td>
                                                    <td class="py-3 px-3 text-center">
                                                        <span class="badge <?php echo $status_class; ?> px-3 py-2 fw-semibold">
                                                            <?php echo $status_text; ?>
                                                        </span>
                                                    </td>
                                                    <td class="py-3 px-3 text-center">
                                                        <a href="<?php echo getServiceLink($service['name']); ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1">
                                                            <i class="fas fa-external-link-alt me-1"></i>
                                                            <small>Manage</small>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Charts Section -->
                <div class="row mb-5 g-4">
                    <div class="col-xl-8">
                        <div class="card service-card position-relative overflow-hidden">
                            <div class="position-absolute top-0 start-0" style="height: 4px; width: 100%; background: var(--info-gradient);"></div>
                            <div class="card-header bg-white border-0">
                                <h5 class="card-title mb-0 fw-semibold">
                                    <i class="fas fa-chart-pie text-info me-2"></i>
                                    Service Distribution
                                </h5>
                                <small class="text-muted">Breakdown of total records across all categories</small>
                            </div>
                            <div class="card-body p-4">
                                <div class="chart-container position-relative">
                                    <canvas id="serviceChart"></canvas>
                                    <div class="position-absolute top-0 end-0 p-3 bg-white bg-opacity-90 rounded-bottom-start shadow-sm">
                                        <small class="text-muted d-block mb-1">Total: <?php echo number_format($total_records); ?></small>
                                        <small class="text-success fw-semibold"><?php echo $overall_percentage; ?>% Complete</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card service-card position-relative overflow-hidden h-100">
                            <div class="position-absolute top-0 start-0" style="height: 4px; width: 100%; background: var(--warning-gradient);"></div>
                            <div class="card-header bg-white border-0">
                                <h5 class="card-title mb-0 fw-semibold">
                                    <i class="fas fa-trophy text-warning me-2"></i>
                                    Top Services
                                </h5>
                                <small class="text-muted">Most active services by record count</small>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush rounded-bottom" style="max-height: 400px; overflow-y: auto;">
                                    <?php if (!empty($top_services)): ?>
                                        <?php foreach ($top_services as $index => $service): ?>
                                            <a href="<?php echo getServiceLink($service['name']); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3 border-0 position-relative overflow-hidden">
                                                <div class="d-flex align-items-center flex-grow-1">
                                                    <div class="bg-light rounded-circle p-2 me-3 shadow-sm" style="width: 45px; height: 45px;">
                                                        <i class="<?php echo getServiceIcon($service['name']); ?> text-primary fs-6"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-semibold text-dark mb-1"><?php echo $service['name']; ?></div>
                                                        <small class="text-muted d-block mb-1"><?php echo $service['visible']; ?> visible of <?php echo $service['total']; ?></small>
                                                        <div class="progress progress-sm" style="height: 4px;">
                                                            <div class="progress-bar bg-primary" style="width: <?php echo $service['percentage']; ?>%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="badge bg-primary rounded-pill fs-6 px-2 py-1"><?php echo $service['total']; ?></span>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="list-group-item text-center py-5 border-0">
                                            <div class="bg-light rounded-circle p-4 mb-3 mx-auto d-inline-block" style="width: 80px; height: 80px;">
                                                <i class="fas fa-chart-line fa-2x text-muted"></i>
                                            </div>
                                            <h6 class="text-muted mb-2">No Data Yet</h6>
                                            <p class="text-muted mb-3 small">Start adding services to see your top performers</p>
                                            <a href="banks.php" class="btn btn-outline-primary btn-sm rounded-pill">Begin</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Needs Attention -->
                <div class="row g-4 mb-5">
                    <div class="col-xl-6">
                        <div class="card recent-activity position-relative overflow-hidden h-100">
                            <div class="position-absolute top-0 start-0" style="height: 4px; width: 100%; background: rgba(255,255,255,0.3);"></div>
                            <div class="card-header bg-transparent border-0 text-white position-relative">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0 fw-semibold text-white">
                                        <i class="fas fa-chart-line me-2 opacity-100"></i>
                                        Recent Activity
                                    </h5>
                                    <small class="text-white opacity-75">Last 7 days</small>
                                </div>
                            </div>
                            <div class="card-body p-4 position-relative">
                                <div class="chart-container">
                                    <canvas id="activityChart"></canvas>
                                </div>
                                <div class="text-center mt-3">
                                    <div class="row g-2 justify-content-center text-white opacity-90">
                                        <div class="col-auto">
                                            <small class="d-block text-center">
                                                <span class="badge bg-light text-dark rounded-pill px-2 py-1"><?php echo end($chart_data); ?></span>
                                                <br><small>Today</small>
                                            </small>
                                        </div>
                                        <div class="col-auto">
                                            <small class="d-block text-center">
                                                <span class="badge bg-light text-dark rounded-pill px-2 py-1"><?php echo $chart_data[3]; ?></span>
                                                <br><small>4 days ago</small>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card needs-attention position-relative overflow-hidden h-100">
                            <div class="position-absolute top-0 start-0" style="height: 4px; width: 100%; background: var(--warning-gradient);"></div>
                            <div class="card-header bg-white border-0">
                                <h5 class="card-title mb-0 fw-semibold">
                                    <i class="fas fa-exclamation-triangle me-2 text-warning"></i>
                                    Needs Attention
                                </h5>
                                <small class="text-muted">Services requiring your immediate action</small>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                                    <?php
                                    $needs_attention = array_filter($services_stats, function ($service) {
                                        return $service['total'] > 0 && $service['percentage'] < 75;
                                    });

                                    if (!empty($needs_attention)):
                                        $needs_attention = array_values($needs_attention);
                                        foreach (array_slice($needs_attention, 0, 5) as $index => $service):
                                            $priority = $index < 3 ? 'high' : 'medium';
                                            $priority_class = $priority === 'high' ? 'border-danger border-3' : 'border-warning border-2';
                                    ?>
                                            <a href="<?php echo getServiceLink($service['name']); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3 border-start <?php echo $priority_class; ?> <?php echo $service['percentage'] < 25 ? 'bg-danger bg-opacity-10' : 'bg-warning bg-opacity-10'; ?>">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded-circle p-2 me-3 shadow-sm" style="width: 40px; height: 40px;">
                                                        <i class="<?php echo getServiceIcon($service['name']); ?> text-primary fs-6"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-semibold text-dark mb-1"><?php echo $service['name']; ?></div>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <small class="text-muted me-2"><?php echo $service['visible']; ?> of <?php echo $service['total']; ?> visible</small>
                                                            <div class="progress flex-grow-1" style="height: 6px;">
                                                                <div class="progress-bar <?php echo $service['percentage'] < 25 ? 'bg-danger' : 'bg-warning'; ?>" style="width: <?php echo $service['percentage']; ?>%"></div>
                                                            </div>
                                                            <small class="fw-semibold ms-2 <?php echo $service['percentage'] < 25 ? 'text-danger' : 'text-warning'; ?>"><?php echo $service['percentage']; ?>%</small>
                                                        </div>
                                                        <small class="badge <?php echo $service['percentage'] < 25 ? 'bg-danger' : 'bg-warning'; ?> text-white rounded-pill px-2 py-1">
                                                            <?php echo $service['percentage'] < 25 ? 'Critical' : 'Urgent'; ?>
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <span class="badge bg-primary rounded-pill"><?php echo $service['total']; ?></span>
                                                </div>
                                            </a>
                                        <?php
                                        endforeach;
                                    else: ?>
                                        <div class="list-group-item text-center py-5 border-0 bg-success bg-opacity-10">
                                            <div class="bg-success bg-opacity-20 rounded-circle p-4 mb-3 mx-auto d-inline-block" style="width: 80px; height: 80px;">
                                                <i class="fas fa-check-circle fa-2x text-success"></i>
                                            </div>
                                            <h6 class="text-success mb-2 fw-semibold">All Services Healthy!</h6>
                                            <p class="text-success opacity-75 mb-3 small">Your village data is well-maintained</p>
                                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                                <a href="banks.php" class="btn btn-outline-success btn-sm rounded-pill px-3 py-1">
                                                    <i class="fas fa-plus me-1"></i>Add More
                                                </a>
                                                <a href="dashboard.php" class="btn btn-success btn-sm rounded-pill px-3 py-1">
                                                    View Analytics
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Import Summary -->
                <div class="row g-4 mb-5">
                    <div class="col-12">
                        <div class="card service-card position-relative overflow-hidden">
                            <div class="position-absolute top-0 start-0" style="height: 4px; width: 100%; background: var(--success-gradient);"></div>
                            <div class="card-header bg-white border-0">
                                <h5 class="card-title mb-0 fw-semibold">
                                    <i class="fas fa-file-import text-success me-2"></i>
                                    Import & Data Health
                                </h5>
                                <small class="text-muted">Monitor your data completion and import new records</small>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="import-summary-card border-start border-primary border-3 text-center h-100">
                                            <div class="card-body py-4">
                                                <div class="mb-3">
                                                    <i class="fas fa-database fa-3x text-primary mb-3"></i>
                                                </div>
                                                <h3 class="text-primary mb-1 fw-bold"><?php echo number_format($total_records); ?></h3>
                                                <h6 class="text-muted mb-2">Total Records</h6>
                                                <small class="text-primary d-block">
                                                    <i class="fas fa-arrow-up me-1"></i>
                                                    <?php echo $active_services; ?> services active
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="import-summary-card border-start border-success border-3 text-center h-100">
                                            <div class="card-body py-4">
                                                <div class="mb-3">
                                                    <i class="fas fa-eye fa-3x text-success mb-3"></i>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center mb-3">
                                                    <h3 class="text-success mb-0 me-2 fw-bold"><?php echo number_format($total_visible); ?></h3>
                                                    <span class="badge bg-success rounded-pill px-3 py-2 fs-6"><?php echo $overall_percentage; ?><small>%</small></span>
                                                </div>
                                                <h6 class="text-muted mb-0">Public Entries</h6>
                                                <small class="text-success d-block mt-1">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    Excellent visibility
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="import-summary-card border-start border-info border-3 text-center h-100">
                                            <div class="card-body py-4">
                                                <div class="mb-3">
                                                    <i class="fas fa-th fa-3x text-info mb-3"></i>
                                                </div>
                                                <h3 class="text-info mb-1 fw-bold"><?php echo $active_services; ?></h3>
                                                <h6 class="text-muted mb-2">Active Categories</h6>
                                                <div class="progress progress-sm mb-2 mx-auto" style="width: 80%;">
                                                    <div class="progress-bar bg-info rounded-pill" style="width: <?php echo min(($active_services / $total_services) * 100, 100); ?>%"></div>
                                                </div>
                                                <small class="text-info d-block">
                                                    <i class="fas fa-layer-group me-1"></i>
                                                    <?php echo $total_services - $active_services; ?> inactive
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="import-summary-card border-start border-warning border-3 text-center h-100">
                                            <div class="card-body py-4">
                                                <div class="mb-3">
                                                    <i class="fas fa-clock fa-3x text-warning mb-3"></i>
                                                </div>
                                                <h3 class="text-warning mb-1 fw-bold"><?php echo date('H:i'); ?></h3>
                                                <h6 class="text-muted mb-2">Last Updated</h6>
                                                <small class="text-warning d-block mt-1">
                                                    <i class="fas fa-sync-alt me-1"></i>
                                                    Auto-sync enabled
                                                </small>
                                                <div class="mt-3">
                                                    <small class="text-muted d-block mb-1">Next sync:</small>
                                                    <small class="badge bg-light text-dark rounded-pill"><?php echo date('H:i', time() + 1800); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Data Health Score -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="card bg-white rounded-3 shadow-sm border-0">
                                            <div class="card-body text-center p-4">
                                                <h6 class="text-muted mb-3 fw-semibold">Data Health Score</h6>
                                                <div class="d-flex align-items-center justify-content-center mb-3">
                                                    <div class="me-3">
                                                        <i class="fas fa-heart fa-2x <?php echo $overall_percentage >= 80 ? 'text-success' : ($overall_percentage >= 50 ? 'text-warning' : 'text-danger'); ?>"></i>
                                                    </div>
                                                    <div class="health-score-progress rounded-pill overflow-hidden flex-grow-1 mx-3" style="height: 16px; max-width: 300px;">
                                                        <div class="progress-bar rounded-pill <?php echo $overall_percentage >= 80 ? 'bg-success' : ($overall_percentage >= 50 ? 'bg-warning' : 'bg-danger'); ?>"
                                                            role="progressbar" style="width: <?php echo $overall_percentage; ?>%;"
                                                            aria-valuenow="<?php echo $overall_percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <span class="fw-bold fs-4 text-dark"><?php echo $overall_percentage; ?><small>%</small></span>
                                                </div>
                                                <div class="d-flex justify-content-center gap-3 flex-wrap">
                                                    <?php if ($overall_percentage >= 80): ?>
                                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                                            <i class="fas fa-check-circle me-1"></i>
                                                            Excellent
                                                        </span>
                                                    <?php elseif ($overall_percentage >= 50): ?>
                                                        <span class="badge bg-warning rounded-pill px-3 py-2 text-dark">
                                                            <i class="fas fa-star me-1"></i>
                                                            Good Progress
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger rounded-pill px-3 py-2">
                                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                                            Needs Attention
                                                        </span>
                                                    <?php endif; ?>
                                                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1" onclick="showDataHealthTips()">
                                                        <i class="fas fa-lightbulb me-1"></i>
                                                        Tips
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

                <!-- Enhanced Export Section -->
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card service-card position-relative overflow-hidden">
                            <div class="position-absolute top-0 start-0" style="height: 4px; width: 100%; background: var(--danger-gradient);"></div>
                            <div class="card-header bg-white border-0">
                                <h5 class="card-title mb-0 fw-semibold">
                                    <i class="fas fa-download text-success me-2"></i>
                                    Export & Import Options
                                </h5>
                                <small class="text-muted">Download reports or import new data</small>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-3">
                                        <a href="export_all.php" class="btn btn-success export-btn w-100 rounded-pill text-white position-relative overflow-hidden">
                                            <i class="fas fa-file-excel me-2"></i>
                                            <span class="position-relative z-index-1">Export All Data</span>
                                            <small class="d-block text-success-50 mt-1">Excel format</small>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="export_summary.php" class="btn btn-info export-btn w-100 rounded-pill text-white position-relative overflow-hidden">
                                            <i class="fas fa-file-pdf me-2"></i>
                                            <span class="position-relative z-index-1">Summary Report</span>
                                            <small class="d-block text-info-50 mt-1">PDF format</small>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <button onclick="exportCSV()" class="btn btn-outline-secondary export-btn w-100 rounded-pill position-relative overflow-hidden">
                                            <i class="fas fa-download me-2"></i>
                                            <span class="position-relative z-index-1">CSV Export</span>
                                            <small class="d-block text-muted mt-1">Custom format</small>
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <button onclick="printDashboard()" class="btn btn-outline-primary export-btn w-100 rounded-pill position-relative overflow-hidden">
                                            <i class="fas fa-print me-2"></i>
                                            <span class="position-relative z-index-1">Print Dashboard</span>
                                            <small class="d-block text-muted mt-1">Current view</small>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-4 pt-3 border-top">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="card border-0 bg-light rounded-3 h-100">
                                                <div class="card-body text-center p-4">
                                                    <i class="fas fa-file-upload fa-3x text-success mb-3"></i>
                                                    <h6 class="text-success mb-2 fw-semibold">Bulk Import</h6>
                                                    <p class="text-muted small mb-3">Import multiple records at once</p>
                                                    <a href="#" class="btn btn-outline-success btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#importModal">
                                                        <i class="fas fa-plus me-1"></i>Start Import
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border-0 bg-light rounded-3 h-100">
                                                <div class="card-body text-center p-4">
                                                    <i class="fas fa-history fa-3x text-info mb-3"></i>
                                                    <h6 class="text-info mb-2 fw-semibold">Import History</h6>
                                                    <p class="text-muted small mb-3">View previous import activities</p>
                                                    <a href="#" class="btn btn-outline-info btn-sm rounded-pill">
                                                        <i class="fas fa-list me-1"></i>View History
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
            </div>
        </div>

        <?php include('../footer.php'); ?>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <div class="modal-header bg-primary text-white rounded-top-3">
                    <h5 class="modal-title fw-bold mb-0" id="importModalLabel">
                        <i class="fas fa-file-import me-2"></i>Bulk Import Services
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-file-excel fa-3x text-success mb-3"></i>
                                    <h6 class="text-success mb-2">Excel Import</h6>
                                    <p class="text-muted small mb-3">Import multiple records from Excel templates</p>
                                    <a href="#" class="btn btn-outline-success btn-sm rounded-pill">
                                        <i class="fas fa-download me-1"></i>Download Template
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-database fa-3x text-info mb-3"></i>
                                    <h6 class="text-info mb-2">Database Import</h6>
                                    <p class="text-muted small mb-3">Import from external database connections</p>
                                    <a href="#" class="btn btn-outline-info btn-sm rounded-pill">
                                        <i class="fas fa-plug me-1"></i>Connect Database
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info rounded-3" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Tip:</strong> Use the Excel template for fastest imports. Each service has its own template format.
                    </div>
                </div>
                <div class="modal-footer bg-light rounded-bottom-3 border-0">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <a href="#" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-file-upload me-2"></i>Start Import
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/global/global.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>

    <script>
        // Enhanced Typewriter effect with better animation
        const capitalizedName = villageName.charAt(0).toUpperCase() + villageName.slice(1);
        const text = 'Welcome To ' + capitalizedName + ' Admin Panel';
        let index = 0;
        const speed = 120;
        const element = document.getElementById("typewriter");

        function typeWriter() {
            if (index < text.length) {
                element.innerHTML += text.charAt(index);
                index++;
                setTimeout(typeWriter, speed);
            } else {
                // Pause and restart after 3 seconds
                setTimeout(() => {
                    element.style.borderRightColor = 'transparent';
                    setTimeout(() => {
                        element.innerHTML = '';
                        index = 0;
                        element.style.borderRightColor = 'rgba(255, 255, 255, 0.8)';
                        typeWriter();
                    }, 500);
                }, 3000);
            }
        }

        // Start typewriter when page loads
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', typeWriter);
        } else {
            typeWriter();
        }

        // Enhanced Service icons mapping
        const serviceIcons = {
            'Banking': 'fas fa-university',
            'Hospitals': 'fas fa-hospital',
            'Education': 'fas fa-graduation-cap',
            'Emergency Services': 'fas fa-ambulance',
            'Employment Centers': 'fas fa-briefcase',
            'Events & Festivals': 'fas fa-calendar-alt',
            'Fuel Stations': 'fas fa-gas-pump',
            'Hotels': 'fas fa-hotel',
            'Restaurants': 'fas fa-utensils',
            'Tourism Places': 'fas fa-mountain',
            'Places to Worship': 'fas fa-mosque',
            'Pillar of Community': 'fas fa-users'
        };

        function getServiceIcon(serviceName) {
            return serviceIcons[serviceName] || 'fas fa-cogs';
        }

        function getServiceLink(serviceName) {
            const links = {
                'Banking': 'banks.php',
                'Hospitals': 'hospitals.php',
                'Education': 'education.php',
                'Emergency Services': 'emergencyservices.php',
                'Employment Centers': 'employmentcenters.php',
                'Events & Festivals': 'eventsfestivals.php',
                'Fuel Stations': 'fuelstation.php',
                'Hotels': 'hotels.php',
                'Restaurants': 'restaurants.php',
                'Tourism Places': 'tourismplaces.php',
                'Places to Worship': 'placestoworship.php',
                'Pillar of Community': 'pillarofcommunity.php'
            };
            return links[serviceName] || 'editform.php?tablename=' + serviceName.toLowerCase().replace(/ /g, '');
        }

        function getServiceCategory(serviceName) {
            const categories = {
                'Banking': 'economy',
                'Hospitals': 'health',
                'Education': 'education',
                'Emergency Services': 'health',
                'Employment Centers': 'economy',
                'Events & Festivals': 'culture',
                'Fuel Stations': 'economy',
                'Hotels': 'tourism',
                'Restaurants': 'tourism',
                'Tourism Places': 'tourism',
                'Places to Worship': 'culture',
                'Pillar of Community': 'community'
            };
            return categories[serviceName] || 'general';
        }

        // Enhanced Charts initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Preloader animation
            const preloader = document.getElementById('preloader');
            if (preloader) {
                setTimeout(() => {
                    preloader.style.opacity = '0';
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 300);
                }, 1500);
            }

            // Service Distribution Chart with enhanced styling
            const serviceCtx = document.getElementById('serviceChart');
            if (serviceCtx && servicesStats.length > 0) {
                const ctx = serviceCtx.getContext('2d');
                const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
                gradient1.addColorStop(0, '#667eea');
                gradient1.addColorStop(1, '#764ba2');

                const gradient2 = ctx.createLinearGradient(0, 0, 400, 0);
                gradient2.addColorStop(0, '#f093fb');
                gradient2.addColorStop(1, '#f5576c');

                new Chart(serviceCtx, {
                    type: 'doughnut',
                    data: {
                        labels: servicesStats.map(service => service.name),
                        datasets: [{
                            data: servicesStats.map(service => service.total),
                            backgroundColor: [
                                gradient1, gradient2, '#4facfe', '#00f2fe', '#43e97b',
                                '#fa709a', '#fee140', '#f79540', '#f37055', '#ef4e7b',
                                '#a8edea', '#fed6e3', '#667eea'
                            ],
                            borderColor: [
                                'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)',
                                'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)',
                                'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)',
                                'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)',
                                'rgba(255,255,255,0.8)'
                            ],
                            borderWidth: 3,
                            borderRadius: 10,
                            hoverOffset: 8,
                            cutout: '60%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 25,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    font: {
                                        size: 12,
                                        family: 'Poppins',
                                        weight: '500'
                                    },
                                    color: '#6c757d'
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0,0,0,0.8)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                borderColor: '#007bff',
                                borderWidth: 1,
                                cornerRadius: 10,
                                displayColors: true,
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                        return [
                                            `${context.label}`,
                                            `${context.parsed} records`,
                                            `(${percentage}%)`
                                        ];
                                    }
                                }
                            }
                        },
                        animation: {
                            animateRotate: true,
                            duration: 2000,
                            easing: 'easeOutBounce'
                        }
                    }
                });

                // Remove loading text
                const chartContainer = serviceCtx.closest('.chart-container');
                chartContainer.querySelectorAll('.text-muted').forEach(el => el.remove());
            }

            // Recent Activity Chart with enhanced styling
            const activityCtx = document.getElementById('activityChart');
            if (activityCtx && chartLabels.length > 0) {
                const ctx = activityCtx.getContext('2d');
                new Chart(activityCtx, {
                    type: 'line',
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            label: 'New Records Added',
                            data: chartData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: function(context) {
                                return context.dataset.data[context.dataIndex] > 0 ? 'rgba(75, 192, 192, 1)' : 'rgba(75, 192, 192, 0.3)';
                            },
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 6,
                            pointHoverRadius: 8,
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                            pointHoverBorderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    font: {
                                        family: 'Poppins',
                                        size: 12,
                                        weight: '500'
                                    },
                                    color: 'rgba(255,255,255,0.9)',
                                    padding: 20,
                                    usePointStyle: true
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0,0,0,0.85)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                                cornerRadius: 8,
                                displayColors: false,
                                callbacks: {
                                    title: function(context) {
                                        return `Date: ${context[0].label}`;
                                    },
                                    label: function(context) {
                                        const value = context.parsed.y;
                                        return value > 0 ? `Added ${value} record${value > 1 ? 's' : ''}` : 'No new records';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(255,255,255,0.1)',
                                    drawBorder: false
                                },
                                ticks: {
                                    color: 'rgba(255,255,255,0.7)',
                                    stepSize: 1,
                                    font: {
                                        family: 'Poppins',
                                        size: 11
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: 'rgba(255,255,255,0.7)',
                                    font: {
                                        family: 'Poppins',
                                        size: 11
                                    }
                                }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },
                        animation: {
                            duration: 2000,
                            easing: 'easeOutQuart'
                        },
                        elements: {
                            point: {
                                hoverBorderWidth: 4
                            }
                        }
                    }
                });

                // Remove loading text for activity chart
                const activityContainer = activityCtx.closest('.chart-container');
                activityContainer.querySelectorAll('.text-muted').forEach(el => el.remove());
            }

            // Enhanced filter functionality
            initServiceFilter();

            // Enhanced quick action tooltips
            initTooltips();

            // Add smooth animations to stat cards
            initCardAnimations();

            // Initialize modal
            const importModal = new bootstrap.Modal(document.getElementById('importModal'));
        });

        // Enhanced filter functionality
        function initServiceFilter() {
            const rows = document.querySelectorAll('#servicesTable tbody tr');
            const filterButtons = document.querySelectorAll('.btn-filter');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.getAttribute('data-filter');
                    filterServices(category);

                    // Update button states
                    filterButtons.forEach(btn => {
                        btn.classList.remove('btn-primary', 'active', 'shadow-sm');
                        btn.classList.add('btn-outline-primary');
                    });

                    this.classList.remove('btn-outline-primary');
                    this.classList.add('btn-primary', 'active', 'shadow-sm');
                });
            });

            // Initial filter state
            filterServices('all');
        }

        function filterServices(category) {
            const rows = document.querySelectorAll('#servicesTable tbody tr');
            let visibleCount = 0;
            let activeCount = 0;

            rows.forEach(row => {
                const rowCategory = row.getAttribute('data-category');
                const total = parseInt(row.getAttribute('data-total') || 0);

                if (category === 'all' || rowCategory === category) {
                    row.style.display = '';
                    if (total > 0) {
                        visibleCount++;
                        activeCount++;
                    }
                } else {
                    row.style.display = 'none';
                }
            });

            // Update header
            const header = document.querySelector('.card-header .card-title');
            if (header) {
                const icon = category === 'all' ? 'fa-th' : (category === 'health' ? 'fa-heartbeat' : (category === 'education' ? 'fa-book' : 'fa-mountain'));
                header.innerHTML = `<i class="fas ${icon} me-2 text-primary"></i>Service Statistics <span class="badge bg-primary bg-opacity-75 rounded-pill ms-2">${visibleCount} services</span>`;
            }
        }

        // Enhanced tooltips
        function initTooltips() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add custom tooltips to quick action buttons
            document.querySelectorAll('.quick-action-btn').forEach(btn => {
                const serviceName = btn.querySelector('small').textContent.trim();
                btn.setAttribute('data-bs-toggle', 'tooltip');
                btn.setAttribute('data-bs-placement', 'top');
                btn.setAttribute('title', `Manage ${serviceName} services and records`);
                btn.setAttribute('data-bs-html', 'true');
            });
        }

        // Card animations
        function initCardAnimations() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.stat-card, .service-card, .quick-action-btn').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        }

        // Enhanced CSV export
        function exportCSV() {
            let csvContent = "Service,Total Records,Visible Records,Visibility Percentage,Status\n";

            servicesStats.forEach(service => {
                const status = service.total == 0 ? 'Empty' :
                    (service.percentage == 100 ? 'Complete' :
                        (service.percentage > 75 ? 'Good' : 'Needs Work'));
                csvContent += `"${service.name}","${service.total}","${service.visible}","${service.percentage}%","${status}"\n`;
            });

            // Create and download file
            const blob = new Blob([csvContent], {
                type: 'text/csv;charset=utf-8;'
            });
            const link = document.createElement("a");
            const url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", `village-dashboard-${new Date().toISOString().split('T')[0]}.csv`);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Enhanced print function
        function printDashboard() {
            // Create printable version
            const printContent = document.querySelector('.container-fluid').innerHTML;
            const originalContent = document.body.innerHTML;
            document.body.innerHTML = `
                <div style="font-family: 'Poppins', sans-serif; padding: 2rem; max-width: 800px; margin: 0 auto; background: white;">
                    <h1 style="text-align: center; color: #2c3e50; margin-bottom: 2rem;">${villageName} Dashboard</h1>
                    <h2 style="color: #007bff; margin-bottom: 1rem;">Service Statistics</h2>
                    ${document.querySelector('#servicesTable').outerHTML}
                    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #eee; text-align: center;">
                        <p style="color: #6c757d; font-size: 0.9rem;">Generated on ${new Date().toLocaleDateString()} at ${new Date().toLocaleTimeString()}</p>
                        <p style="color: #6c757d; font-size: 0.8rem;">${villageName} Admin Panel</p>
                    </div>
                </div>
            `;

            window.print();

            // Restore original content
            document.body.innerHTML = originalContent;

            // Reinitialize scripts
            if (typeof typeWriter === 'function') typeWriter();
            if (typeof initServiceFilter === 'function') initServiceFilter();
        }

        // Data health tips modal
        function showDataHealthTips() {
            const tips = [{
                    title: 'Complete Basic Services First',
                    text: 'Start with essential services like Banking, Hospitals, and Education to establish a strong foundation.',
                    priority: 'primary'
                },
                {
                    title: 'Improve Visibility',
                    text: 'Make sure to set visibility to "on" for important services that should be publicly accessible.',
                    priority: 'info'
                },
                {
                    title: 'Regular Updates',
                    text: 'Keep your data current by updating service information monthly and adding new entries as they become available.',
                    priority: 'warning'
                },
                {
                    title: 'Add Photos',
                    text: 'Services with photos get 3x more engagement. Upload high-quality images for better user experience.',
                    priority: 'success'
                },
                {
                    title: 'Complete All Categories',
                    text: 'Aim for 100% completion across all service categories for comprehensive village coverage.',
                    priority: 'secondary'
                }
            ];

            let tipsHtml = '<div class="modal fade" id="tipsModal" tabindex="-1">';
            tipsHtml += '<div class="modal-dialog modal-lg modal-dialog-centered">';
            tipsHtml += '<div class="modal-content rounded-4 shadow-lg">';
            tipsHtml += '<div class="modal-header bg-primary text-white rounded-top-3">';
            tipsHtml += '<h5 class="modal-title fw-bold mb-0"><i class="fas fa-lightbulb me-2"></i>Data Health Tips</h5>';
            tipsHtml += '<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>';
            tipsHtml += '</div>';
            tipsHtml += '<div class="modal-body p-4">';

            tips.forEach(tip => {
                tipsHtml += `
                    <div class="card border-0 mb-3 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div class="bg-${tip.priority} bg-opacity-10 rounded-circle p-2 me-3 mt-1" style="width: 40px; height: 40px;">
                                    <i class="fas fa-${tip.priority === 'primary' ? 'star' : (tip.priority === 'info' ? 'info-circle' : (tip.priority === 'warning' ? 'exclamation-triangle' : 'check-circle'))} text-${tip.priority}" style="font-size: 0.875rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-semibold mb-1 text-${tip.priority}">${tip.title}</h6>
                                    <p class="text-muted small mb-0">${tip.text}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            tipsHtml += '</div>';
            tipsHtml += '<div class="modal-footer bg-light rounded-bottom-3 border-0">';
            tipsHtml += '<button type="button" class="btn btn-primary rounded-pill px-4" data-bs-dismiss="modal">';
            tipsHtml += '<i class="fas fa-check me-2"></i>Got it!';
            tipsHtml += '</button>';
            tipsHtml += '</div>';
            tipsHtml += '</div></div></div>';

            // Create and show modal
            const modalElement = document.createElement('div');
            modalElement.innerHTML = tipsHtml;
            document.body.appendChild(modalElement);

            const tipsModal = new bootstrap.Modal(modalElement.firstElementChild);
            tipsModal.show();

            // Clean up after modal is hidden
            modalElement.firstElementChild.addEventListener('hidden.bs.modal', function() {
                document.body.removeChild(modalElement);
            });
        }

        // Preload animation completion
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });
    </script>

    <?php
    // Helper functions (can be moved to a separate file)
    function getServiceIcon($serviceName)
    {
        $icons = [
            'Banking' => 'fas fa-university',
            'Hospitals' => 'fas fa-hospital',
            'Education' => 'fas fa-graduation-cap',
            'Emergency Services' => 'fas fa-ambulance',
            'Employment Centers' => 'fas fa-briefcase',
            'Events & Festivals' => 'fas fa-calendar-alt',
            'Fuel Stations' => 'fas fa-gas-pump',
            'Hotels' => 'fas fa-hotel',
            'Restaurants' => 'fas fa-utensils',
            'Tourism Places' => 'fas fa-mountain',
            'Places to Worship' => 'fas fa-mosque',
            'Pillar of Community' => 'fas fa-users'
        ];
        return $icons[$serviceName] ?? 'fas fa-cogs';
    }

    function getServiceLink($serviceName)
    {
        $links = [
            'Banking' => 'banks.php',
            'Hospitals' => 'hospitals.php',
            'Education' => 'education.php',
            'Emergency Services' => 'emergencyservices.php',
            'Employment Centers' => 'employmentcenters.php',
            'Events & Festivals' => 'eventsfestivals.php',
            'Fuel Stations' => 'fuelstation.php',
            'Hotels' => 'hotels.php',
            'Restaurants' => 'restaurants.php',
            'Tourism Places' => 'tourismplaces.php',
            'Places to Worship' => 'placestoworship.php',
            'Pillar of Community' => 'pillarofcommunity.php'
        ];
        return $links[$serviceName] ?? 'editform.php?tablename=' . strtolower(str_replace(' ', '', $serviceName));
    }

    function getServiceCategory($serviceName)
    {
        $categories = [
            'Banking' => 'economy',
            'Hospitals' => 'health',
            'Education' => 'education',
            'Emergency Services' => 'health',
            'Employment Centers' => 'economy',
            'Events & Festivals' => 'culture',
            'Fuel Stations' => 'economy',
            'Hotels' => 'tourism',
            'Restaurants' => 'tourism',
            'Tourism Places' => 'tourism',
            'Places to Worship' => 'culture',
            'Pillar of Community' => 'community'
        ];
        return $categories[$serviceName] ?? 'general';
    }
    ?>
</body>

</html>