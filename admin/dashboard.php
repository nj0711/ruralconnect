<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: index.php");
    exit();
}

// Session timeout
$timeout_duration = 600;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

/* --------------------------------------------------------------
   SUPER ADMIN DASHBOARD – FULLY MOBILE RESPONSIVE
   Requires: admin/helpers.php (final __ns_mysqli version)
   -------------------------------------------------------------- */
require_once __DIR__ . '/helpers.php';

$villageFiles = getAllVillages();

$global = [
    'villages' => 0,
    'infrastructure' => 0,
    'health' => 0,
    'education' => 0,
    'finance' => 0,
    'transport' => 0,
    'hospitality' => 0,
    'tourism' => 0,
    'community' => 0,
    'population' => 0
];

$perVillage = [];

foreach ($villageFiles as $village => $cfgPath) {
    $conn = getVillageConn($cfgPath);
    if (!$conn) continue;

    $stats = array_fill_keys(array_keys($global), 0);

    $tables = [
        'watersupply' => 'infrastructure',
        'drainage' => 'infrastructure',
        'washrooms' => 'infrastructure',
        'electrification' => 'infrastructure',
        'hospitals' => 'health',
        'emergencyservices' => 'health',
        'education' => 'education',
        'banks' => 'finance',
        'fuelstation' => 'finance',
        'transport' => 'transport',
        'hotels' => 'hospitality',
        'restaurants' => 'hospitality',
        'tourismplaces' => 'tourism',
        'entertainment' => 'tourism',
        'eventsfestivals' => 'tourism',
        'placestoworship' => 'community',
        'pillarofcommunity' => 'community',
        'employmentcenters' => 'community',
        'population' => 'population'
    ];

    foreach ($tables as $table => $cat) {
        $result = $conn->selectdata($table, "SELECT COUNT(*) AS c FROM `$table`");
        $count = is_array($result) && isset($result[0]['c']) ? (int)$result[0]['c'] : 0;
        $stats[$cat] += $count;
        $global[$cat] += $count;
    }

    $global['villages']++;
    $perVillage[$village] = $stats;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | Super Admin Panel</title>
    <link rel="shortcut icon" type="image/png" href="images/villagelogo.png">

    <!-- Your Original Styles -->
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #667eea;
            --success: #1cc88a;
            --warning: #f6c23e;
            --info: #36b9cc;
            --danger: #e74a3b;
            --purple: #6f42c1;
            --teal: #20c997;
            --orange: #fd7e14;
        }

        body,
        html {
            height: 100%;
            margin: 0;
            background: #f8f9fc;
            font-family: 'Segoe UI', sans-serif;
        }

        .container-fluid {
            padding: 1rem;
        }

        /* Global Stats - Responsive */
        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 1.2rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .07);
            transition: .3s;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
        }

        .stat-icon {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 0.3rem;
        }

        /* Village Cards - Fully Responsive */
        .village-card {
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .07);
            transition: .3s;
            margin-bottom: 1rem;
        }

        .village-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
        }

        .village-header {
            background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
            color: white;
            padding: 0.9rem 1rem;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .chart-container {
            height: 180px;
            padding: 0.5rem 0;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.6rem;
            margin: 0.8rem 0;
        }

        .service-item {
            background: #f8f9fc;
            border-radius: 10px;
            padding: 0.6rem;
            font-size: 0.8rem;
            text-align: center;
            transition: .2s;
        }

        .service-item:hover {
            background: #e9ecef;
            transform: scale(1.02);
        }

        .service-value {
            font-weight: 700;
            font-size: 1rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .stat-card {
                padding: 1rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            .stat-icon {
                font-size: 1.5rem;
            }

            .village-header {
                font-size: 1rem;
                padding: 0.8rem;
            }

            .chart-container {
                height: 160px;
            }

            .service-grid {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }

            .service-item {
                padding: 0.5rem;
                font-size: 0.75rem;
            }

            .service-value {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .container-fluid {
                padding: 0.5rem;
            }

            .stat-card {
                padding: 0.8rem;
            }

            .stat-value {
                font-size: 1.3rem;
            }

            .village-header {
                font-size: 0.95rem;
            }

            .chart-container {
                height: 140px;
            }
        }
    </style>
</head>

<body>
    <div id="main-wrapper">
        <?php include('header.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">

                <!-- GLOBAL SUMMARY -->
                <div class="row g-3 mb-4">
                    <div class="col-12 text-center">
                        <!-- <h2 class="fw-bold text-primary mb-1" style="font-size: 1.5rem;">VillageOnWeb</h2>
                        <p class="text-muted" style="font-size: 0.9rem;">Super Admin Dashboard</p> -->
                    </div>

                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="stat-card text-primary">
                            <div class="stat-icon">Village</div>
                            <h2 class="stat-value"><?= $global['villages'] ?></h2>
                            <p class="stat-label">Villages</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="stat-card text-success">
                            <div class="stat-icon">Infrastructure</div>
                            <h2 class="stat-value"><?= number_format($global['infrastructure']) ?></h2>
                            <p class="stat-label">Facilities</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="stat-card text-warning">
                            <div class="stat-icon">Health</div>
                            <h2 class="stat-value"><?= number_format($global['health']) ?></h2>
                            <p class="stat-label">Services</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="stat-card text-info">
                            <div class="stat-icon">Education</div>
                            <h2 class="stat-value"><?= number_format($global['education']) ?></h2>
                            <p class="stat-label">Institutes</p>
                        </div>
                    </div>
                </div>

                <!-- VILLAGE CARDS -->
                <h3 class="fw-bold text-dark mb-3" style="font-size: 1.3rem;">Village Breakdown</h3>
                <div class="row g-3">
                    <?php foreach ($perVillage as $village => $data): ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card village-card">
                                <div class="village-header text-capitalize">
                                    <?= htmlspecialchars($village) ?>
                                </div>
                                <div class="card-body p-3">

                                    <!-- SERVICE GRID -->
                                    <div class="service-grid">
                                        <div class="service-item">
                                            <div class="service-value text-primary"><?= $data['infrastructure'] ?></div>
                                            <div>Infra</div>
                                        </div>
                                        <div class="service-item">
                                            <div class="service-value text-success"><?= $data['health'] ?></div>
                                            <div>Health</div>
                                        </div>
                                        <div class="service-item">
                                            <div class="service-value text-warning"><?= $data['education'] ?></div>
                                            <div>Edu</div>
                                        </div>
                                        <div class="service-item">
                                            <div class="service-value text-info"><?= $data['finance'] ?></div>
                                            <div>Finance</div>
                                        </div>
                                        <div class="service-item">
                                            <div class="service-value" style="color: var(--purple);"><?= $data['transport'] ?></div>
                                            <div>Transport</div>
                                        </div>
                                        <div class="service-item">
                                            <div class="service-value text-danger"><?= $data['hospitality'] ?></div>
                                            <div>Hospitality</div>
                                        </div>
                                        <div class="service-item">
                                            <div class="service-value" style="color: var(--teal);"><?= $data['tourism'] ?></div>
                                            <div>Tourism</div>
                                        </div>
                                        <div class="service-item">
                                            <div class="service-value" style="color: var(--orange);"><?= $data['community'] ?></div>
                                            <div>Community</div>
                                        </div>
                                    </div>

                                    <!-- RADAR CHART -->
                                    <div class="chart-container">
                                        <canvas id="radar-<?= htmlspecialchars($village) ?>"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!-- Footer -->
        <div class="footer">
            <div class="copyright">
                <p style="font-size: 0.8rem;">© Copyright <?php echo date("Y"); ?> by Sadar Patel University</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/apexchart/apexchart.js"></script>
    <script src="vendor/chartjs/chart.bundle.min.js"></script>
    <script src="vendor/peity/jquery.peity.min.js"></script>
    <script src="js/dashboard/dashboard-1.js"></script>
    <script src="vendor/owl-carousel/owl.carousel.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>

    <script>
        const villageData = <?= json_encode($perVillage) ?>;
        Object.entries(villageData).forEach(([v, d]) => {
            const maxVal = Math.max(...Object.values(d)) + 1;
            new Chart(document.getElementById('radar-' + v), {
                type: 'radar',
                data: {
                    labels: ['Infra', 'Health', 'Edu', 'Fin', 'Trans', 'Hosp', 'Tour', 'Comm'],
                    datasets: [{
                        data: [d.infrastructure, d.health, d.education, d.finance, d.transport, d.hospitality, d.tourism, d.community],
                        backgroundColor: 'rgba(102, 126, 234, 0.15)',
                        borderColor: '#667eea',
                        pointBackgroundColor: '#667eea',
                        pointBorderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            ticks: {
                                display: false
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                            pointLabels: {
                                font: {
                                    size: 10
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)'
                        }
                    }
                }
            });
        });

        // Your carousel
        function JobickCarousel() {
            jQuery('.front-view-slider').owlCarousel({
                loop: false,
                margin: 20,
                nav: true,
                dots: true,
                navText: ['', ''],
                responsive: {
                    0: {
                        items: 1
                    },
                    480: {
                        items: 1
                    },
                    767: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        }
        jQuery(window).on('load', () => setTimeout(JobickCarousel, 1000));
    </script>
</body>

</html>