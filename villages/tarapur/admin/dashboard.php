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

include("config.php");
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
    const totalRecords = $total_records;
    const totalVisible = $total_visible;
    const overallPercentage = $overall_percentage;
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

    <!-- All StyleSheet -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">

    <!-- Globle CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            /* background: var(--primary-gradient); */
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s ease;
        }

        .lds-ripple {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ripple div {
            position: absolute;
            border: 4px solid rgba(255, 255, 255, 0.3);
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

        /* Typewriter Animation */
        #typewriter {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: clamp(2.5rem, 6vw, 4rem);
            display: inline-block;
            overflow: hidden;
            border-right: 3px solid rgba(255, 255, 255, 0.8);
            white-space: nowrap;
            margin: 0 auto;
            letter-spacing: 2px;
            animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
            background: linear-gradient(45deg, #2c3e50, rgba(255, 255, 255, 0.8));
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

        /* Dashboard Hero Section */
        .dashboard-hero {
            /* background: var(--primary-gradient); */
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

        /* Stat Cards */
        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            box-shadow: var(--card-shadow);
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
            padding: 1.75rem;
            text-align: center;
        }

        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1;
            color: #2c3e50;
        }

        .stat-card h6 {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.8;
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
            padding: 1.5rem 1.75rem;
        }

        .service-card .card-title {
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
            font-size: 1.25rem;
        }

        .service-card .table {
            margin: 0;
            font-size: 0.9rem;
        }

        .service-card .table th {
            background: rgba(0, 123, 255, 0.02);
            border-top: none;
            font-weight: 500;
            color: #495057;
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .service-card .table td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            border-color: rgba(0, 0, 0, 0.03);
        }

        .service-card .progress {
            height: 10px;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.05);
            overflow: hidden;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .service-card .progress-bar {
            border-radius: 10px;
            transition: width 0.6s ease;
            position: relative;
            overflow: hidden;
        }

        .service-card .progress-bar::after {
            content: attr(data-percentage);
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.75rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            z-index: 2;
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
            border-radius: var(--border-radius);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 120px;
        }

        .quick-action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
            z-index: 1;
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
            font-size: 2rem;
            margin-bottom: 0.75rem;
            transition: var(--transition);
            z-index: 2;
            position: relative;
        }

        .quick-action-btn:hover i {
            transform: scale(1.1);
            color: #007bff !important;
        }

        .quick-action-btn small {
            font-size: 0.85rem;
            opacity: 0.8;
            z-index: 2;
            position: relative;
            text-align: center;
        }

        .quick-action-btn .service-subtitle {
            font-size: 0.75rem;
            opacity: 0.6;
            margin-top: 0.25rem;
            z-index: 2;
            position: relative;
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
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 0.75rem;
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

        .top-service .rounded-circle {
            background: rgba(255, 255, 255, 0.2) !important;
            backdrop-filter: blur(10px);
        }

        .top-service .badge {
            background: rgba(255, 255, 255, 0.2) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Recent Activity Card */
        .recent-activity {
            background: var(--warning-gradient);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }

        .recent-activity::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
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
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
        }

        .needs-attention .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .needs-attention .list-group-item {
            border: none;
            padding: 1.25rem;
            margin-bottom: 0.5rem;
            border-radius: 12px;
            background: rgba(255, 193, 7, 0.05);
            transition: var(--transition);
            border-left: 4px solid #ffc107;
            position: relative;
            overflow: hidden;
        }

        .needs-attention .list-group-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 4px;
            background: #ffc107;
        }

        .needs-attention .list-group-item:hover {
            background: rgba(255, 193, 7, 0.1);
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.15);
        }

        .needs-attention .list-group-item .badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
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
            text-align: center;
        }

        .import-summary-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow-hover);
        }

        .import-summary-card .card-body {
            padding: 2rem;
        }

        .import-summary-card i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        .import-summary-card h3 {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        .import-summary-card h6 {
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
        }

        /* Progress Bars */
        .health-score-progress {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 50px;
            height: 16px;
            overflow: hidden;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .health-score-progress .progress-bar {
            border-radius: 50px;
            transition: width 1s ease-in-out;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
            position: relative;
        }

        .health-score-progress .progress-bar::after {
            content: attr(aria-valuenow) + '%';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.75rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            z-index: 2;
        }

        /* Buttons */
        .btn {
            border-radius: 25px;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border: none;
            font-size: 0.9rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4191 100%);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-success {
            background: var(--success-gradient);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #0d8b74 0%, #2dd885 100%);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
            color: white;
        }

        .btn-info {
            background: var(--info-gradient);
            color: white;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #45a1f3 0%, #00e6f6 100%);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
            color: white;
        }

        .btn-warning {
            background: var(--warning-gradient);
            color: white;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #e877f5 0%, #f34d59 100%);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
            color: white;
        }

        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }

        .btn-outline-primary:hover {
            background: #007bff;
            color: white;
            transform: translateY(-2px);
        }

        /* Filter Buttons */
        .btn-filter {
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            transition: var(--transition);
            border: 2px solid #dee2e6;
        }

        .btn-filter.active,
        .btn-filter:hover {
            border-color: #007bff;
            background: rgba(0, 123, 255, 0.1);
            transform: translateY(-1px);
        }

        .btn-filter.active {
            background: #007bff;
            color: white;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
        }

        /* Badges */
        .badge {
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .badge:empty {
            display: none;
        }

        /* Table Enhancements */
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
            transform: scale(1.01);
            transition: var(--transition);
        }

        .table th {
            position: sticky;
            top: 0;
            z-index: 10;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-hero {
                padding: 2.5rem 1rem;
                margin-bottom: 2rem;
            }

            #typewriter {
                font-size: 2rem !important;
            }

            .lead {
                font-size: 1.1rem !important;
                padding: 0 1rem;
            }

            .stat-card h3 {
                font-size: 2rem;
            }

            .quick-action-btn {
                padding: 1.25rem !important;
                margin-bottom: 1rem !important;
            }

            .quick-action-btn i {
                font-size: 1.75rem !important;
            }

            .service-card .table {
                font-size: 0.85rem;
            }

            .service-card .table th,
            .service-card .table td {
                padding: 0.75rem !important;
            }

            .btn-group-sm .btn {
                padding: 0.375rem 0.75rem;
                font-size: 0.8rem;
                margin: 0 1px;
            }

            .chart-container {
                height: 300px !important;
            }
        }

        @media (max-width: 576px) {
            #typewriter {
                font-size: 1.75rem !important;
                letter-spacing: 1px;
            }

            .stat-card {
                margin-bottom: 1.25rem;
            }

            .service-card .table-responsive {
                font-size: 0.8rem;
            }

            .top-service {
                padding: 1rem !important;
                margin-bottom: 0.75rem !important;
            }

            .top-service .badge {
                position: absolute;
                top: 0.5rem;
                right: 0.5rem;
                font-size: 0.7rem !important;
            }

            .needs-attention .list-group-item {
                padding: 1rem !important;
            }
        }

        /* Loading Animation for Charts */
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
            z-index: 10;
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

        /* Print Styles */
        @media print {

            .no-print,
            #preloader,
            .btn,
            .card-header {
                display: none !important;
            }

            .service-card {
                break-inside: avoid;
                margin-bottom: 1rem;
                box-shadow: none;
                border: 1px solid #dee2e6;
            }

            .table {
                font-size: 0.9rem;
            }

            body {
                background: white !important;
                font-size: 12pt;
            }
        }
    </style>

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>

    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include('header.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- Dashboard Hero Section -->


            <div class="container-fluid px-4">
                <!-- Overall Statistics Cards -->
                <div class="row mb-5 g-4">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card stat-card h-100 text-center position-relative overflow-hidden">
                            <div class="position-absolute top-0 start-0 bg-primary bg-opacity-10 rounded-end" style="height: 100%; width: 20px;"></div>
                            <div class="card-body py-4">
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
                            <div class="position-absolute top-0 end-0 bg-success bg-opacity-10 rounded-start" style="height: 100%; width: 20px;"></div>
                            <div class="card-body py-4">
                                <div class="mb-3">
                                    <i class="fas fa-eye fa-3x text-success mb-3"></i>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-3">
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
                            <div class="position-absolute top-0 start-50 translate-middle-x bg-info bg-opacity-10 rounded-bottom" style="height: 20px; width: 100%;"></div>
                            <div class="card-body py-4">
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
                            <div class="position-absolute bottom-0 end-0 bg-warning bg-opacity-10 rounded-top-left" style="height: 20px; width: 100%;"></div>
                            <div class="card-body py-4">
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
                                <div class="d-flex justify-content- align-items-center">
                                    <h5 class="d-flex card-title mb-0 fw-semibold">
                                        <i class="fas fa-bolt text-primary me-2"></i>
                                        Quick Actions
                                    </h5> &nbsp;
                                    <small class="text-muted">Navigate to your services</small>
                                </div>
                            </div>
                            <div class="card-body p-4 ">
                                <div class="row g-3">
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="pages/banks.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="d-flex justify-content-center align-items-center bg-primary bg-opacity-10 rounded-circle p-3 mb-2" style="height: 60px; width: 60px;">
                                                <i class="fas fa-university text-primary" style="font-size: 2.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-primary mt-2">Banking</small>
                                            <small class="text-muted text-center mt-1 service-subtitle">Financial Services</small>
                                        </a>
                                    </div>

                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="pages/hospitals.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="d-flex justify-content-center align-items-center bg-success bg-opacity-10 rounded-circle p-3 mb-2" style="height: 60px; width: 60px;">
                                                <i class="fas fa-hospital text-success" style="font-size: 2.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-success mt-2">Hospitals</small>
                                            <small class="text-muted text-center mt-1 service-subtitle">Healthcare</small>
                                        </a>
                                    </div>

                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="pages/education.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="d-flex justify-content-center align-items-center bg-info bg-opacity-10 rounded-circle p-3 mb-2" style="height: 60px; width: 60px;">
                                                <i class="fas fa-graduation-cap text-info" style="font-size: 2.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-info mt-2">Education</small>
                                            <small class="text-muted text-center mt-1 service-subtitle">Schools & Colleges</small>
                                        </a>
                                    </div>

                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="pages/emergencyservices.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="d-flex justify-content-center align-items-center bg-danger bg-opacity-10 rounded-circle p-3 mb-2" style="height: 60px; width: 60px;">
                                                <i class="fas fa-ambulance text-danger" style="font-size: 2.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-danger mt-2">Emergency</small>
                                            <small class="text-muted text-center mt-1 service-subtitle">24/7 Services</small>
                                        </a>
                                    </div>

                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="pages/employmentcenters.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="d-flex justify-content-center align-items-center bg-warning bg-opacity-10 rounded-circle p-3 mb-2" style="height: 60px; width: 60px;">
                                                <i class="fas fa-briefcase text-warning" style="font-size: 2.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-warning mt-2">Employment</small>
                                            <small class="text-muted text-center mt-1 service-subtitle">Job Centers</small>
                                        </a>
                                    </div>


                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <a href="pages/tourismplaces.php" class="quick-action-btn text-decoration-none h-100 d-flex flex-column align-items-center justify-content-center p-3 rounded-3 position-relative overflow-hidden">
                                            <div class="d-flex justify-content-center align-items-center bg-secondary bg-opacity-10 rounded-circle p-3 mb-2" style="height: 60px; width: 60px;">
                                                <i class="fas fa-mountain text-secondary" style="font-size: 2.5rem;"></i>
                                            </div>
                                            <small class="text-center fw-medium text-secondary mt-2">Tourism</small>
                                            <small class="text-muted text-center mt-1 service-subtitle">Attractions</small>
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
                                                            <div class="bg-light rounded-circle p-2 me-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
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
                                                                        style="width: <?php echo $service['percentage']; ?>%;" data-percentage="<?php echo $service['percentage']; ?>">
                                                                    </div>
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
                <!-- <div class="row mb-5 g-4">
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
                                            <a href="<?php echo getServiceLink($service['name']); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3 border-0 position-relative overflow-hidden top-service rounded mb-1">
                                                <div class="d-flex align-items-center flex-grow-1">
                                                    <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3" style="width: 45px; height: 45px;">
                                                        <i class="<?php echo getServiceIcon($service['name']); ?> text-white" style="font-size: 1.1rem;"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-bold text-white mb-1"><?php echo $service['name']; ?></div>
                                                        <small class="text-white-50"><?php echo $service['visible']; ?> visible of <?php echo $service['total']; ?></small>
                                                        <div class="progress progress-sm mt-1" style="height: 4px;">
                                                            <div class="progress-bar bg-light bg-opacity-50" style="width: <?php echo $service['percentage']; ?>%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="badge bg-white text-primary fs-6 px-2 py-1"><?php echo $service['total']; ?></span>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="list-group-item text-center py-5 border-0">
                                            <div class="bg-light rounded-circle p-4 mb-3 mx-auto d-inline-block" style="width: 80px; height: 80px;">
                                                <i class="fas fa-chart-line fa-2x text-muted"></i>
                                            </div>
                                            <h6 class="text-muted mb-2">No Data Yet</h6>
                                            <p class="text-muted mb-3 small">Start adding services to see your top performers</p>
                                            <a href="pages/banks.php" class="btn btn-outline-primary btn-sm rounded-pill">Begin</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Recent Activity & Needs Attention -->
                <!-- <div class="row g-4 mb-5">
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
                                                <a href="pages/banks.php" class="btn btn-outline-success btn-sm rounded-pill px-3 py-1">
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
                </div> -->

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

                <!-- Enhanced Export Section -->
                <!-- <div class="row g-4">
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
                </div> -->
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright by Sardar Patel University <?php echo date('Y'); ?> </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
	Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Apex Chart -->
    <script src="vendor/apexchart/apexchart.js"></script>
    <script src="vendor/chartjs/chart.bundle.min.js"></script>

    <!-- Chart piety plugin files -->
    <script src="vendor/peity/jquery.peity.min.js"></script>

    <!-- Dashboard 1 -->
    <script src="js/dashboard/dashboard-1.js"></script>

    <script src="vendor/owl-carousel/owl.carousel.js"></script>

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

        // Preloader animation
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 300);
            }
        });

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
                'Banking': 'pages/banks.php',
                'Hospitals': 'pages/hospitals.php',
                'Education': 'pages/education.php',
                'Emergency Services': 'pages/emergencyservices.php',
                'Employment Centers': 'pages/employmentcenters.php',
                'Events & Festivals': 'pages/eventsfestivals.php',
                'Fuel Stations': 'pages/fuelstation.php',
                'Hotels': 'pages/hotels.php',
                'Restaurants': 'pages/restaurants.php',
                'Tourism Places': 'pages/tourismplaces.php',
                'Places to Worship': 'pages/placestoworship.php',
                'Pillar of Community': 'pages/pillarofcommunity.php'
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

            // // Service Distribution Chart with enhanced styling
            // const serviceCtx = document.getElementById('serviceChart');
            // if (serviceCtx && servicesStats.length > 0) {
            //     const ctx = serviceCtx.getContext('2d');
            //     const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
            //     gradient1.addColorStop(0, '#667eea');
            //     gradient1.addColorStop(1, '#764ba2');

            //     const gradient2 = ctx.createLinearGradient(0, 0, 400, 0);
            //     gradient2.addColorStop(0, '#f093fb');
            //     gradient2.addColorStop(1, '#f5576c');

            //     new Chart(serviceCtx, {
            //         type: 'doughnut',
            //         data: {
            //             labels: servicesStats.map(service => service.name),
            //             datasets: [{
            //                 data: servicesStats.map(service => service.total),
            //                 backgroundColor: [
            //                     gradient1, gradient2, '#4facfe', '#00f2fe', '#43e97b',
            //                     '#fa709a', '#fee140', '#f79540', '#f37055', '#ef4e7b',
            //                     '#a8edea', '#fed6e3', '#667eea'
            //                 ],
            //                 borderColor: [
            //                     'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)',
            //                     'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)',
            //                     'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)',
            //                     'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)', 'rgba(255,255,255,0.8)',
            //                     'rgba(255,255,255,0.8)'
            //                 ],
            //                 borderWidth: 3,
            //                 borderRadius: 10,
            //                 hoverOffset: 8,
            //                 cutout: '60%'
            //             }]
            //         },
            //         options: {
            //             responsive: true,
            //             maintainAspectRatio: false,
            //             plugins: {
            //                 legend: {
            //                     position: 'bottom',
            //                     labels: {
            //                         padding: 25,
            //                         usePointStyle: true,
            //                         pointStyle: 'circle',
            //                         font: {
            //                             size: 12,
            //                             family: 'Poppins',
            //                             weight: '500'
            //                         },
            //                         color: '#6c757d'
            //                     }
            //                 },
            //                 tooltip: {
            //                     backgroundColor: 'rgba(0,0,0,0.8)',
            //                     titleColor: '#fff',
            //                     bodyColor: '#fff',
            //                     borderColor: '#007bff',
            //                     borderWidth: 1,
            //                     cornerRadius: 10,
            //                     displayColors: true,
            //                     callbacks: {
            //                         label: function(context) {
            //                             const total = context.dataset.data.reduce((a, b) => a + b, 0);
            //                             const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
            //                             return [
            //                                 `${context.label}`,
            //                                 `${context.parsed} records`,
            //                                 `(${percentage}%)`
            //                             ];
            //                         }
            //                     }
            //                 }
            //             },
            //             animation: {
            //                 animateRotate: true,
            //                 duration: 2000,
            //                 easing: 'easeOutBounce'
            //             }
            //         }
            //     });

            //     // Remove loading text
            //     const chartContainer = serviceCtx.closest('.chart-container');
            //     chartContainer.querySelectorAll('.text-muted').forEach(el => el.remove());
            // }

            // // Recent Activity Chart with enhanced styling
            // const activityCtx = document.getElementById('activityChart');
            // if (activityCtx && chartLabels.length > 0) {
            //     const ctx = activityCtx.getContext('2d');
            //     new Chart(activityCtx, {
            //         type: 'line',
            //         data: {
            //             labels: chartLabels,
            //             datasets: [{
            //                 label: 'New Records Added',
            //                 data: chartData,
            //                 borderColor: 'rgba(75, 192, 192, 1)',
            //                 backgroundColor: 'rgba(75, 192, 192, 0.1)',
            //                 borderWidth: 3,
            //                 fill: true,
            //                 tension: 0.4,
            //                 pointBackgroundColor: function(context) {
            //                     return context.dataset.data[context.dataIndex] > 0 ? 'rgba(75, 192, 192, 1)' : 'rgba(75, 192, 192, 0.3)';
            //                 },
            //                 pointBorderColor: '#fff',
            //                 pointBorderWidth: 2,
            //                 pointRadius: 6,
            //                 pointHoverRadius: 8,
            //                 pointHoverBackgroundColor: '#fff',
            //                 pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
            //                 pointHoverBorderWidth: 2
            //             }]
            //         },
            //         options: {
            //             responsive: true,
            //             maintainAspectRatio: false,
            //             plugins: {
            //                 legend: {
            //                     display: true,
            //                     position: 'top',
            //                     labels: {
            //                         font: {
            //                             family: 'Poppins',
            //                             size: 12,
            //                             weight: '500'
            //                         },
            //                         color: 'rgba(255,255,255,0.9)',
            //                         padding: 20,
            //                         usePointStyle: true
            //                     }
            //                 },
            //                 tooltip: {
            //                     backgroundColor: 'rgba(0,0,0,0.85)',
            //                     titleColor: '#fff',
            //                     bodyColor: '#fff',
            //                     borderColor: 'rgba(75, 192, 192, 1)',
            //                     borderWidth: 1,
            //                     cornerRadius: 8,
            //                     displayColors: false,
            //                     callbacks: {
            //                         title: function(context) {
            //                             return `Date: ${context[0].label}`;
            //                         },
            //                         label: function(context) {
            //                             const value = context.parsed.y;
            //                             return value > 0 ? `Added ${value} record${value > 1 ? 's' : ''}` : 'No new records';
            //                         }
            //                     }
            //                 }
            //             },
            //             scales: {
            //                 y: {
            //                     beginAtZero: true,
            //                     grid: {
            //                         color: 'rgba(255,255,255,0.1)',
            //                         drawBorder: false
            //                     },
            //                     ticks: {
            //                         color: 'rgba(255,255,255,0.7)',
            //                         stepSize: 1,
            //                         font: {
            //                             family: 'Poppins',
            //                             size: 11
            //                         }
            //                     }
            //                 },
            //                 x: {
            //                     grid: {
            //                         display: false
            //                     },
            //                     ticks: {
            //                         color: 'rgba(255,255,255,0.7)',
            //                         font: {
            //                             family: 'Poppins',
            //                             size: 11
            //                         }
            //                     }
            //                 }
            //             },
            //             interaction: {
            //                 intersect: false,
            //                 mode: 'index'
            //             },
            //             animation: {
            //                 duration: 2000,
            //                 easing: 'easeOutQuart'
            //             },
            //             elements: {
            //                 point: {
            //                     hoverBorderWidth: 4
            //                 }
            //             }
            //         }
            //     });

            //     // Remove loading text for activity chart
            //     const activityContainer = activityCtx.closest('.chart-container');
            //     activityContainer.querySelectorAll('.text-muted').forEach(el => el.remove());
            // }

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
            // Add tooltips to quick action buttons
            document.querySelectorAll('.quick-action-btn').forEach(btn => {
                const serviceName = btn.querySelector('small').textContent.trim();
                btn.setAttribute('data-bs-toggle', 'tooltip');
                btn.setAttribute('data-bs-placement', 'top');
                btn.setAttribute('title', `Manage ${serviceName} services and records`);
                btn.setAttribute('data-bs-html', 'true');
            });

            // Initialize Bootstrap tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    trigger: 'hover focus',
                    delay: {
                        show: 200,
                        hide: 100
                    }
                });
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

            document.querySelectorAll('.stat-card, .service-card, .quick-action-btn, .import-summary-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        }

        // Enhanced CSV export
        //!old
        // function exportCSV() {
        //     // alert("dsd");
        //     let csvContent = "Service,Total Records,Visible Records,Visibility Percentage,Status\n";

        //     servicesStats.forEach(service => {
        //         const status = service.total == 0 ? 'Empty' :
        //             (service.percentage == 100 ? 'Complete' :
        //                 (service.percentage > 75 ? 'Good' : 'Needs Work'));
        //         csvContent += `"${service.name}","${service.total}","${service.visible}","${service.percentage}%","${status}"\n`;
        //     });

        //     // Create and download file
        //     const blob = new Blob([csvContent], {
        //         type: 'text/csv;charset=utf-8;'
        //     });
        //     const link = document.createElement("a");
        //     const url = URL.createObjectURL(blob);
        //     link.setAttribute("href", url);
        //     link.setAttribute("download", `village-dashboard-${new Date().toISOString().split('T')[0]}.csv`);
        //     link.style.visibility = 'hidden';
        //     document.body.appendChild(link);
        //     link.click();
        //     document.body.removeChild(link);
        // }

        // Enhanced CSV export with more detailed data
        function exportCSV() {
            // Create comprehensive CSV with all service details
            let csvContent = "Village Dashboard Export - " + new Date().toLocaleDateString() + "\n\n";
            csvContent += "SUMMARY STATISTICS\n";
            csvContent += "Village,Total Records,Visible Records,Completion %,Active Services\n";
            csvContent += `"${villageName}",${totalRecords},${totalVisible},${overallPercentage}%,${activeServices}\n\n`;

            csvContent += "SERVICE BREAKDOWN\n";
            csvContent += "Service,Total Records,Visible Records,Visibility %,Status\n";

            servicesStats.forEach(service => {
                const status = service.total == 0 ? 'Empty' :
                    (service.percentage == 100 ? 'Complete' :
                        (service.percentage > 75 ? 'Good' : 'Partial'));
                csvContent += `"${service.name}","${service.total}","${service.visible}","${service.percentage}%","${status}"\n`;
            });

            csvContent += "\nTOP SERVICES\n";
            csvContent += "Rank,Service,Records,Visibility %\n";

            topServices.forEach((service, index) => {
                csvContent += `${index + 1},"${service.name}",${service.total},${service.percentage}%\n`;
            });

            csvContent += "\nRECENT ACTIVITY (Last 7 Days)\n";
            csvContent += "Date,New Records\n";

            chartLabels.forEach((label, index) => {
                csvContent += `"${label}",${chartData[index]}\n`;
            });

            csvContent += "\nDATA HEALTH METRICS\n";
            csvContent += "Metric,Value,Status\n";
            csvContent += "Overall Completion,${overallPercentage}%,${overallPercentage >= 80 ? 'Excellent' : (overallPercentage >= 50 ? 'Good' : 'Needs Work')}\n";
            csvContent += "Active Services,${activeServices}/${totalServices},Active\n";
            csvContent += "Data Freshness,Today,Current\n";
            csvContent += `Export Date,${new Date().toLocaleDateString()},Generated\n`;
            csvContent += `Export Time,${new Date().toLocaleTimeString()},Generated\n`;

            // Create and download file
            const blob = new Blob([csvContent], {
                type: 'text/csv;charset=utf-8;'
            });
            const link = document.createElement("a");
            const url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", `village-dashboard-detailed-${new Date().toISOString().split('T')[0]}.csv`);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Show success message
            showNotification('CSV export completed successfully!', 'success');
        }

        // Notification function for user feedback
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'success' ? 'success' : (type === 'error' ? 'danger' : 'info')} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : (type === 'error' ? 'exclamation-triangle' : 'info-circle')} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

            document.body.appendChild(notification);

            // Auto remove after 3 seconds
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(notification);
                bsAlert.close();
            }, 3000);
        }
        // Enhanced print function
        //!old 
        // function printDashboard() {
        //     // Hide elements that shouldn't be printed
        //     const noPrintElements = document.querySelectorAll('.no-print, #preloader, .btn, .card-header .btn-group, .modal');
        //     noPrintElements.forEach(el => el.style.display = 'none');

        //     // Add print-friendly styles
        //     const printStyles = `
        //         <style>
        //             @media print {
        //                 body { background: white !important; font-size: 12pt; }
        //                 .service-card { break-inside: avoid; margin-bottom: 1rem; box-shadow: none; border: 1px solid #dee2e6; }
        //                 .table { font-size: 0.9rem; width: 100%; }
        //                 .table th { background: #f8f9fa !important; position: static !important; }
        //                 h1, h2, h3 { color: #2c3e50 !important; }
        //                 .progress { display: none; }
        //             }
        //         </style>
        //     `;

        //     const printWindow = window.open('', '_blank');
        //     printWindow.document.write(`
        //         <!DOCTYPE html>
        //         <html>
        //         <head>
        //             <title>${villageName} Dashboard - ${new Date().toLocaleDateString()}</title>
        //             <meta charset="utf-8">
        //             ${printStyles}
        //             <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        //         </head>
        //         <body style="font-family: 'Poppins', sans-serif; padding: 2rem; max-width: 1000px; margin: 0 auto; background: white;">
        //             <header style="text-align: center; margin-bottom: 3rem; border-bottom: 3px solid #007bff; padding-bottom: 1rem;">
        //                 <h1 style="color: #007bff; margin: 0; font-size: 2rem;">${villageName} Village Dashboard</h1>
        //                 <p style="color: #6c757d; margin: 0.5rem 0 0 0; font-size: 1rem;">Generated on ${new Date().toLocaleDateString()} at ${new Date().toLocaleTimeString()}</p>
        //             </header>
        //             <div style="margin-bottom: 2rem;">
        //                 <h2 style="color: #2c3e50; margin-bottom: 1rem; border-bottom: 2px solid #eee; padding-bottom: 0.5rem;">Overall Statistics</h2>
        //                 <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
        //                     <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; text-align: center;">
        //                         <h3 style="color: #007bff; margin: 0 0 0.5rem 0; font-size: 2rem;">${totalRecords}</h3>
        //                         <p style="color: #6c757d; margin: 0; font-size: 0.9rem;">Total Records</p>
        //                     </div>
        //                     <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; text-align: center;">
        //                         <h3 style="color: #28a745; margin: 0 0 0.5rem 0; font-size: 2rem;">${totalVisible}</h3>
        //                         <p style="color: #6c757d; margin: 0; font-size: 0.9rem;">Visible Entries</p>
        //                     </div>
        //                     <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; text-align: center;">
        //                         <h3 style="color: #17a2b8; margin: 0 0 0.5rem 0; font-size: 2rem;">${activeServices}</h3>
        //                         <p style="color: #6c757d; margin: 0; font-size: 0.9rem;">Active Services</p>
        //                     </div>
        //                     <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; text-align: center;">
        //                         <h3 style="color: #ffc107; margin: 0 0 0.5rem 0; font-size: 2rem;">${overallPercentage}%</h3>
        //                         <p style="color: #6c757d; margin: 0; font-size: 0.9rem;">Completion Rate</p>
        //                     </div>
        //                 </div>
        //             </div>
        //             <h2 style="color: #2c3e50; margin-bottom: 1.5rem; border-bottom: 2px solid #eee; padding-bottom: 0.5rem;">Service Statistics</h2>
        //             ${document.querySelector('#servicesTable').outerHTML}
        //             <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid #eee; text-align: center; color: #6c757d;">
        //                 <p style="margin-bottom: 0.5rem; font-size: 0.9rem;">Generated on ${new Date().toLocaleDateString()} at ${new Date().toLocaleTimeString()}</p>
        //                 <p style="margin: 0; font-size: 0.8rem; opacity: 0.8;">${villageName} Village Admin Panel</p>
        //             </div>
        //         </body>
        //         </html>
        //     `);
        //     printWindow.document.close();
        //     printWindow.print();
        // }

        // Enhanced print function with better formatting
        function printDashboard() {
            // Create a comprehensive print version
            const printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>${villageName} Dashboard - ${new Date().toLocaleDateString()}</title>
            <meta charset="utf-8">
            <style>
                @media print {
                    body { 
                        font-family: 'Arial', sans-serif; 
                        margin: 0; 
                        padding: 1in; 
                        line-height: 1.4; 
                        color: #333; 
                        background: white !important;
                        -webkit-print-color-adjust: exact;
                        print-color-adjust: exact;
                    }
                    .no-print { display: none !important; }
                    .header-section { 
                        text-align: center; 
                        border-bottom: 3px solid #007bff; 
                        padding-bottom: 1.5rem; 
                        margin-bottom: 2.5rem;
                        page-break-after: avoid;
                    }
                    .header-section h1 { 
                        color: #007bff !important; 
                        margin: 0; 
                        font-size: 2.5rem; 
                        font-weight: bold;
                    }
                    .header-section p { 
                        color: #666 !important; 
                        margin: 0.75rem 0; 
                        font-size: 1.1rem;
                    }
                    .stats-grid {
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                        gap: 1.5rem;
                        margin: 2.5rem 0;
                        background: #f8f9fa;
                        padding: 2rem;
                        border-radius: 10px;
                        border-left: 5px solid #007bff;
                    }
                    .stat-item {
                        text-align: center;
                        padding: 1.5rem;
                        background: white;
                        border-radius: 8px;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                    }
                    .stat-number {
                        font-size: 2.5rem;
                        font-weight: bold;
                        color: #007bff;
                        margin-bottom: 0.5rem;
                    }
                    .stat-label {
                        color: #666;
                        font-size: 1rem;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                        margin: 0;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin: 2.5rem 0;
                        font-size: 0.95rem;
                        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                    }
                    th, td {
                        padding: 15px;
                        text-align: left;
                        border-bottom: 1px solid #e9ecef;
                    }
                    th {
                        background-color: #007bff !important;
                        color: white !important;
                        font-weight: 600;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                        font-size: 0.85rem;
                    }
                    tr:nth-child(even) {
                        background-color: #f8f9fa;
                    }
                    tr:hover {
                        background-color: #e3f2fd !important;
                    }
                    .status-badge {
                        padding: 6px 12px;
                        border-radius: 15px;
                        font-size: 0.8rem;
                        font-weight: 600;
                        text-transform: uppercase;
                    }
                    .status-complete { 
                        background: #d4edda !important; 
                        color: #155724 !important; 
                    }
                    .status-good { 
                        background: #d1ecf1 !important; 
                        color: #0c5460 !important; 
                    }
                    .status-partial { 
                        background: #fff3cd !important; 
                        color: #856404 !important; 
                    }
                    .status-empty { 
                        background: #f8d7da !important; 
                        color: #721c24 !important; 
                    }
                    .footer {
                        margin-top: 4rem;
                        padding-top: 2.5rem;
                        border-top: 2px solid #dee2e6;
                        text-align: center;
                        color: #6c757d;
                        font-size: 0.9rem;
                        page-break-before: always;
                    }
                    .overall-progress {
                        background: linear-gradient(135deg, #007bff, #0056b3) !important;
                        color: white !important;
                        padding: 1.5rem;
                        border-radius: 10px;
                        text-align: center;
                        margin: 2.5rem 0;
                        font-weight: 600;
                        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
                    }
                    .section-break {
                        page-break-before: always;
                        margin-top: 3rem;
                    }
                    @page {
                        margin: 1in;
                        size: A4;
                    }
                </style>
            </head>
            <body>
                <div class="header-section">
                    <h1>${villageName} Village Dashboard</h1>
                    <p>Comprehensive Services Summary Report</p>
                    <p>Generated on ${new Date().toLocaleDateString()} at ${new Date().toLocaleTimeString()}</p>
                </div>

                <div class="overall-progress">
                    <h3 style="margin: 0 0 1rem 0;">Overall Statistics Summary</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                        <div style="text-align: center; padding: 1rem; background: rgba(255,255,255,0.1); border-radius: 8px;">
                            <div style="font-size: 2.5rem; font-weight: bold; color: #e3f2fd; margin-bottom: 0.5rem;">${totalRecords}</div>
                            <div style="color: #e1f5fe; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">Total Records</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: rgba(255,255,255,0.1); border-radius: 8px;">
                            <div style="font-size: 2.5rem; font-weight: bold; color: #e8f5e8; margin-bottom: 0.5rem;">${totalVisible}</div>
                            <div style="color: #c8e6c9; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">Visible Entries</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: rgba(255,255,255,0.1); border-radius: 8px;">
                            <div style="font-size: 2.5rem; font-weight: bold; color: #e3f2fd; margin-bottom: 0.5rem;">${overallPercentage}%</div>
                            <div style="color: #bbdefb; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">Completion Rate</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: rgba(255,255,255,0.1); border-radius: 8px;">
                            <div style="font-size: 2.5rem; font-weight: bold; color: #fff3e0; margin-bottom: 0.5rem;">${activeServices}</div>
                            <div style="color: #ffcc80; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">Active Services</div>
                        </div>
                    </div>
                </div>

                <h2 style="color: #2c3e50; margin-bottom: 1.5rem; border-bottom: 2px solid #eee; padding-bottom: 0.75rem;">Detailed Service Statistics</h2>
                
                ${document.querySelector('#servicesTable').outerHTML}

                <div class="footer" style="margin-top: 4rem;">
                    <div style="border-top: 2px solid #dee2e6; padding-top: 2rem; margin-top: 2rem;">
                        <h4 style="color: #007bff; margin-bottom: 1rem; text-align: center;">Report Summary</h4>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin: 1rem 0;">
                            <div style="text-align: center; padding: 1rem; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #007bff;">
                                <div style="font-size: 1.5rem; font-weight: bold; color: #007bff; margin-bottom: 0.25rem;">${totalRecords}</div>
                                <div style="color: #666; font-size: 0.9rem;">Total Records Exported</div>
                            </div>
                            <div style="text-align: center; padding: 1rem; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #28a745;">
                                <div style="font-size: 1.5rem; font-weight: bold; color: #28a745; margin-bottom: 0.25rem;">${totalVisible}</div>
                                <div style="color: #666; font-size: 0.9rem;">Visible Records</div>
                            </div>
                            <div style="text-align: center; padding: 1rem; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #17a2b8;">
                                <div style="font-size: 1.5rem; font-weight: bold; color: #17a2b8; margin-bottom: 0.25rem;">${activeServices}</div>
                                <div style="color: #666; font-size: 0.9rem;">Active Services</div>
                            </div>
                        </div>
                        <p style="text-align: center; color: #666; margin: 2rem 0 0.5rem 0; font-size: 0.9rem;">
                            Generated by ${villageName} Village Admin Panel
                        </p>
                        <p style="text-align: center; color: #999; margin: 0; font-size: 0.8rem;">
                            Report Date: ${new Date().toLocaleDateString()} | Time: ${new Date().toLocaleTimeString()}
                        </p>
                    </div>
                </div>
            </body>
        </html>
    `;

            const printWindow = window.open('', '_blank', 'width=1000,height=800');
            printWindow.document.write(printContent);
            printWindow.document.close();

            // Auto-trigger print dialog after content loads
            printWindow.onload = function() {
                setTimeout(() => {
                    printWindow.print();
                    printWindow.onafterprint = function() {
                        printWindow.close();
                    };
                }, 1000);
            };
        }
        // Data health tips modal
        function showDataHealthTips() {
            const tips = [{
                    title: 'Complete Basic Services First',
                    text: 'Start with essential services like Banking, Hospitals, and Education to establish a strong foundation for your village profile.',
                    priority: 'primary',
                    icon: 'star'
                },
                {
                    title: 'Improve Visibility Settings',
                    text: 'Make sure to set visibility to "on" for important services that should be publicly accessible to visitors and residents.',
                    priority: 'info',
                    icon: 'info-circle'
                },
                {
                    title: 'Regular Data Updates',
                    text: 'Keep your information current by updating service details monthly and adding new entries as services are established.',
                    priority: 'warning',
                    icon: 'exclamation-triangle'
                },
                {
                    title: 'Add Service Photos',
                    text: 'Services with high-quality photos receive 3x more engagement. Upload images to make your listings more attractive.',
                    priority: 'success',
                    icon: 'check-circle'
                },
                {
                    title: 'Aim for 100% Completion',
                    text: 'Complete all service categories for comprehensive village coverage. This provides the most value to users and stakeholders.',
                    priority: 'secondary',
                    icon: 'lightbulb'
                }
            ];

            let tipsHtml = '<div class="modal fade" id="tipsModal" tabindex="-1">';
            tipsHtml += '<div class="modal-dialog modal-lg modal-dialog-centered">';
            tipsHtml += '<div class="modal-content rounded-4 shadow-lg border-0">';
            tipsHtml += '<div class="modal-header bg-primary text-white rounded-top-3">';
            tipsHtml += '<h5 class="modal-title fw-bold mb-0"><i class="fas fa-lightbulb me-2"></i>Data Health Tips</h5>';
            tipsHtml += '<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>';
            tipsHtml += '</div>';
            tipsHtml += '<div class="modal-body p-4">';

            tips.forEach(tip => {
                tipsHtml += `
                    <div class="card border-0 mb-3 shadow-sm hover-lift">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div class="bg-${tip.priority} bg-opacity-10 rounded-circle p-2 me-3 mt-1" style="width: 40px; height: 40px;">
                                    <i class="fas fa-${tip.icon} text-${tip.priority}" style="font-size: 0.875rem;"></i>
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
            tipsHtml += '<i class="fas fa-check me-2"></i>Got it, thanks!';
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

        // Initialize everything when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initServiceFilter();
            initTooltips();
            initCardAnimations();

            // Add loading animation to charts
            setTimeout(() => {
                document.querySelectorAll('.chart-container').forEach(container => {
                    const loadingText = container.querySelector('.text-muted');
                    if (loadingText) loadingText.remove();
                });
            }, 1000);
        });

        // Hover lift effect for cards
        document.querySelectorAll('.hover-lift').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Auto-refresh stats every 5 minutes (optional)
        setTimeout(function() {
            location.reload();
        }, 300000); // 5 minutes
    </script>

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
                                    <div class="d-grid gap-2">
                                        <a href="#" class="btn btn-outline-success rounded-pill">
                                            <i class="fas fa-download me-2"></i>Download Template
                                        </a>
                                        <button class="btn btn-success rounded-pill">
                                            <i class="fas fa-upload me-2"></i>Upload File
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-database fa-3x text-info mb-3"></i>
                                    <h6 class="text-info mb-2">Database Import</h6>
                                    <p class="text-muted small mb-3">Import from external database connections</p>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-outline-info rounded-pill">
                                            <i class="fas fa-plug me-2"></i>Connect Database
                                        </button>
                                        <a href="#" class="btn btn-info text-white rounded-pill">
                                            <i class="fas fa-cogs me-2"></i>API Integration
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info rounded-3 border-0" role="alert">
                        <i class="fas fa-info-circle me-2 float-start"></i>
                        <div class="d-inline">
                            <strong>Quick Tip:</strong> Use Excel templates for fastest imports. Each service has its own optimized template format for bulk data entry.
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light rounded-bottom-3 border-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="button" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-file-upload me-2"></i>Start Import
                    </button>
                </div>
            </div>
        </div>
    </div>

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
            'Banking' => 'pages/banks.php',
            'Hospitals' => 'pages/hospitals.php',
            'Education' => 'pages/education.php',
            'Emergency Services' => 'pages/emergencyservices.php',
            'Employment Centers' => 'pages/employmentcenters.php',
            'Events & Festivals' => 'pages/eventsfestivals.php',
            'Fuel Stations' => 'pages/fuelstation.php',
            'Hotels' => 'pages/hotels.php',
            'Restaurants' => 'pages/restaurants.php',
            'Tourism Places' => 'pages/tourismplaces.php',
            'Places to Worship' => 'pages/placestoworship.php',
            'Pillar of Community' => 'pages/pillarofcommunity.php'
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