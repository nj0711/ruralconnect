<?php
session_start();
if (!isset($_SESSION['village_admin_email'])) {
    header("Location: index.php");
    exit();
}

// Timeout
$timeout_duration = 600;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

// DATABASE
require_once '../config.php';
$db = new ConnDb();
if (!$db->conn) {
    die("Database connection failed!");
}

$msg = $error = '';

// CREATE TABLE – FULL phpMyAdmin VALIDATION
if (isset($_POST['create_table'])) {
    $table_name = trim($_POST['table_name'] ?? '');

    // 1. Table name: valid format
    if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $table_name)) {
        $error = "<div class='alert alert-danger'>Invalid table name. Use letters, numbers, underscore only. Must start with letter or _.</div>";
    }
    // 2. Table already exists
    elseif ($db->tableExists($table_name)) {
        $error = "<div class='alert alert-danger'>Table <strong>$table_name</strong> already exists!</div>";
    } else {
        $cols = $_POST['col'] ?? [];
        $sql = "CREATE TABLE `$table_name` (";
        $primarySet = false;
        $usedNames = [];
        $indexNames = [];

        // 3. At least 1 column
        if (empty($cols)) {
            $error = "<div class='alert alert-danger'>Add at least one column.</div>";
        } else {
            foreach ($cols as $i => $c) {
                $name = trim($c['name'] ?? '');
                $type = strtoupper($c['type'] ?? '');
                $len  = trim($c['len'] ?? '');
                $null = !empty($c['null']);
                $def  = $c['def'] ?? '';
                $ai   = !empty($c['ai']);
                $index = $c['index'] ?? '';

                // 4. Column name: not empty
                if ($name === '') {
                    $error = "<div class='alert alert-danger'>Column " . ($i + 1) . ": Name is required.</div>";
                    break;
                }
                // 5. Column name: valid format
                if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $name)) {
                    $error = "<div class='alert alert-danger'>Column <strong>$name</strong>: Invalid name. Use letters, numbers, underscore.</div>";
                    break;
                }
                // 6. Column name: unique
                if (in_array($name, $usedNames)) {
                    $error = "<div class='alert alert-danger'>Column <strong>$name</strong>: Duplicate name.</div>";
                    break;
                }
                $usedNames[] = $name;

                // 7. Length required for certain types
                $needsLength = in_array($type, ['VARCHAR', 'CHAR', 'VARBINARY', 'BINARY']);
                if ($needsLength && $len === '') {
                    $error = "<div class='alert alert-danger'>Column <strong>$name</strong>: Length required for $type.</div>";
                    break;
                }

                $lenPart = ($needsLength && $len !== '') ? "($len)" : (in_array($type, ['DECIMAL', 'FLOAT']) && $len !== '' ? "($len)" : '');

                // 8. NULL: PRIMARY must be NOT NULL
                $isPrimary = ($index === 'PRIMARY');
                $nullPart = $isPrimary ? 'NOT NULL' : ($null ? 'NULL' : 'NOT NULL');

                // 9. DEFAULT: validate type
                $defPart = '';
                if ($def !== '' && $def !== 'NULL') {
                    if (in_array($type, ['INT', 'TINYINT', 'SMALLINT', 'MEDIUMINT', 'BIGINT', 'FLOAT', 'DOUBLE', 'DECIMAL']) && !is_numeric($def)) {
                        $error = "<div class='alert alert-danger'>Column <strong>$name</strong>: Default must be numeric for $type.</div>";
                        break;
                    } elseif (in_array($type, ['DATE', 'DATETIME', 'TIMESTAMP', 'TIME']) && !in_array($def, ['CURRENT_TIMESTAMP', 'NULL'])) {
                        $error = "<div class='alert alert-danger'>Column <strong>$name</strong>: Invalid default for $type.</div>";
                        break;
                    } elseif (!in_array($type, ['INT', 'TINYINT', 'SMALLINT', 'MEDIUMINT', 'BIGINT', 'FLOAT', 'DOUBLE', 'DECIMAL', 'DATE', 'DATETIME', 'TIMESTAMP', 'TIME']) && $def !== 'NULL') {
                        $defPart = " DEFAULT '" . $db->escape($def) . "'";
                    } elseif (is_numeric($def)) {
                        $defPart = " DEFAULT " . $db->escape($def);
                    }
                } elseif ($def === 'NULL') {
                    $defPart = ' DEFAULT NULL';
                }

                // 10. AUTO_INCREMENT: only INT + PRIMARY
                $aiPart = ($ai && $type === 'INT' && $isPrimary) ? ' AUTO_INCREMENT' : '';
                if ($ai && !$isPrimary) {
                    $error = "<div class='alert alert-danger'>Column <strong>$name</strong>: AUTO_INCREMENT requires PRIMARY KEY.</div>";
                    break;
                }

                // 11. PRIMARY KEY: only one
                if ($isPrimary && $primarySet) {
                    $error = "<div class='alert alert-danger'>Only one PRIMARY KEY allowed.</div>";
                    break;
                }

                // 12. Index name conflict (UNIQUE/INDEX)
                if (in_array($index, ['UNIQUE', 'INDEX']) && in_array($name, $indexNames)) {
                    $error = "<div class='alert alert-danger'>Index on <strong>$name</strong> already defined.</div>";
                    break;
                }
                if (in_array($index, ['UNIQUE', 'INDEX'])) {
                    $indexNames[] = $name;
                }

                // Build column definition
                $colDef = "`" . $db->escape($name) . "` $type$lenPart $nullPart$defPart$aiPart";

                if ($isPrimary && !$primarySet) {
                    $colDef .= ' PRIMARY KEY';
                    $primarySet = true;
                } elseif ($index === 'UNIQUE') {
                    $colDef .= ' UNIQUE';
                } elseif ($index === 'INDEX') {
                    $colDef .= ' INDEX';
                }

                $sql .= $colDef . ', ';
            }

            if (!isset($error)) {
                $sql = rtrim($sql, ', ') . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

                if ($db->mysqli->query($sql)) {
                    $msg = "<div class='alert alert-success'>Table <strong>$table_name</strong> created successfully!</div>";
                } else {
                    $error = "<div class='alert alert-danger'>SQL Error: " . $db->mysqli->error . "</div>";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Pages | Admin Panel</title>
    <link rel="shortcut icon" type="image/png" href="../images/villagelogo.png">
    <link href="../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/delete_btn.css" rel="stylesheet">
    <style>
        .col-row {
            border-bottom: 1px solid #eee;
            padding: 12px 0;
        }

        .col-row:hover {
            background: #f8f9fa;
        }

        .remove-col {
            color: #dc3545;
            cursor: pointer;
            font-weight: bold;
        }

        .sql-preview {
            background: #f1f3f5;
            padding: 15px;
            border-radius: 8px;
            font-family: monospace;
        }
    </style>
</head>

<body>
    <div id="main-wrapper">
        <?php include('header.php'); ?>

        <div class="content-body">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header  text-white">
                                <h4 class="mb-0">Create New Service Table</h4>
                            </div>
                            <div class="card-body">
                                <?= $msg ?>
                                <?= $error ?>

                                <form method="post" id="createForm">
                                    <div class="mb-3">
                                        <label class="form-label">Table Name</label>
                                        <input type="text" name="table_name" class="form-control" placeholder="e.g. theater" required>
                                    </div>

                                    <h5>Columns</h5>
                                    <div id="columnsContainer">

                                        <!-- ✅ Header Row for Column Titles -->
                                        <div class="col-row row g-2 align-items-center mb-2 fw-bold text-center border-bottom pb-1">
                                            <div class="col">Column Name</div>
                                            <div class="col">Type</div>
                                            <div class="col">Length / Values</div>
                                            <div class="col">Default</div>
                                            <div class="col">Null</div>
                                            <div class="col">Index</div>
                                            <div class="col">A.I.</div>
                                            <div class="col">Action</div>
                                        </div>

                                        <!-- ✅ Dynamic Column Inputs -->
                                        <?php for ($i = 0; $i < 4; $i++): ?>
                                            <div class="col-row row g-2 align-items-center mb-2">
                                                <div class="col">
                                                    <input type="text" name="col[<?= $i ?>][name]" class="form-control form-control-sm" placeholder="name" required>
                                                </div>

                                                <div class="col">
                                                    <select name="col[<?= $i ?>][type]" class="form-select form-select-sm" required>
                                                        <option value="INT">INT</option>
                                                        <option value="VARCHAR">VARCHAR</option>
                                                        <option value="TEXT">TEXT</option>
                                                        <option value="DATE">DATE</option>
                                                        <option value="TIMESTAMP">TIMESTAMP</option>
                                                        <option value="TIME">TIME</option>
                                                        <option value="YEAR">YEAR</option>
                                                        <option value="TINYINT">TINYINT</option>
                                                        <option value="SMALLINT">SMALLINT</option>
                                                        <option value="MEDIUMINT">MEDIUMINT</option>
                                                        <option value="BIGINT">BIGINT</option>
                                                        <option value="FLOAT">FLOAT</option>
                                                        <option value="DOUBLE">DOUBLE</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <input type="text" name="col[<?= $i ?>][len]" class="form-control form-control-sm" placeholder="255">
                                                </div>

                                                <div class="col">
                                                    <select name="col[<?= $i ?>][def]" class="form-select form-select-sm">
                                                        <option value="">None</option>
                                                        <option value="NULL">NULL</option>
                                                        <option value="0">0</option>
                                                        <option value="CURRENT_TIMESTAMP">CURRENT_TIMESTAMP</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <select name="col[<?= $i ?>][null]" class="form-select form-select-sm">
                                                        <option value="1">NULL</option>
                                                        <option value="0">NOT NULL</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <select name="col[<?= $i ?>][index]" class="form-select form-select-sm">
                                                        <option value="">--</option>
                                                        <option value="PRIMARY">PRIMARY</option>
                                                        <option value="UNIQUE">UNIQUE</option>
                                                        <option value="INDEX">INDEX</option>
                                                    </select>
                                                </div>

                                                <div class="col text-center">
                                                    <input type="checkbox" name="col[<?= $i ?>][ai]" value="1" class="form-check-input">
                                                    <small>A.I.</small>
                                                </div>

                                                <div class="col text-end">
                                                    <span class="remove-col text-danger" style="cursor:pointer;" onclick="this.parentElement.parentElement.remove()">X</span>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>


                                    <button type="button" class="btn btn-outline-secondary btn-sm mt-2" onclick="addRow()">+ Add Column</button>

                                    <div class="mt-4 text-end">
                                        <button type="button" class="btn btn-info me-2" onclick="previewSQL()">Preview SQL</button>
                                        <button type="submit" name="create_table" class="btn btn-success">Create Table</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="sqlModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>SQL Preview</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <pre class="sql-preview" id="sqlPreview"></pre>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="footer">
            <?php include('../footer.php'); ?>
        </div>

        <!-- Scripts -->
        <script src="../vendor/global/global.min.js"></script>
        <script src="../vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="../vendor/apexchart/apexchart.js"></script>
        <script src="../vendor/chartjs/chart.bundle.min.js"></script>
        <script src="../vendor/peity/jquery.peity.min.js"></script>
        <script src="../js/dashboard/dashboard-1.js"></script>
        <script src="../vendor/owl-carousel/owl.carousel.js"></script>
        <script src="../js/custom.min.js"></script>
        <script src="../js/dlabnav-init.js"></script>

        <script>
            function JobickCarousel() {
                jQuery('.front-view-slider').owlCarousel({
                    loop: false,
                    margin: 30,
                    nav: true,
                    autoplaySpeed: 3000,
                    navSpeed: 3000,
                    autoWidth: true,
                    paginationSpeed: 3000,
                    slideSpeed: 3000,
                    smartSpeed: 3000,
                    autoplay: false,
                    animateOut: 'fadeOut',
                    dots: true,
                    navText: ['', ''],
                    responsive: {
                        0: {
                            items: 1,
                            margin: 10
                        },
                        480: {
                            items: 1
                        },
                        767: {
                            items: 3
                        },
                        1750: {
                            items: 3
                        }
                    }
                });
            }
            jQuery(window).on('load', function() {
                setTimeout(function() {
                    JobickCarousel();
                }, 1000);
            });
        </script>

        <script>
            let colIndex = 4;

            function addRow() {
                const c = document.getElementById('columnsContainer');
                const r = document.createElement('div');
                r.className = 'col-row row g-2 align-items-center mb-2';
                r.innerHTML = `
        <div class="col"><input type="text" name="col[${colIndex}][name]" class="form-control form-control-sm" placeholder="name" required></div>
        <div class="col">
            <select name="col[${colIndex}][type]" class="form-select form-select-sm" required>
                <option value="INT">INT</option>
                <option value="VARCHAR">VARCHAR</option>
                <option value="TEXT">TEXT</option>
                <option value="DATE">DATE</option>
                <option value="TIMESTAMP">TIMESTAMP</option>
                <option value="TIME">TIME</option>
                <option value="YEAR">YEAR</option>
                <option value="TINYINT">TINYINT</option>
                <option value="SMALLINT">SMALLINT</option>
                <option value="MEDIUMINT">MEDIUMINT</option>
                <option value="BIGINT">BIGINT</option>
                <option value="FLOAT">FLOAT</option>
                <option value="DOUBLE">DOUBLE</option>
            </select>
        </div>
        <div class="col"><input type="text" name="col[${colIndex}][len]" class="form-control form-control-sm" placeholder="255"></div>
        <div class="col">
            <select name="col[${colIndex}][def]" class="form-select form-select-sm">
                <option value="">None</option>
                <option value="NULL">NULL</option>
                <option value="0">0</option>
                <option value="CURRENT_TIMESTAMP">CURRENT_TIMESTAMP</option>
            </select>
        </div>
        <div class="col">
            <select name="col[${colIndex}][null]" class="form-select form-select-sm">
                <option value="1">NULL</option>
                <option value="0">NOT NULL</option>
            </select>
        </div>
        <div class="col">
            <select name="col[${colIndex}][index]" class="form-select form-select-sm">
                <option value="">--</option>
                <option value="PRIMARY">PRIMARY</option>
                <option value="UNIQUE">UNIQUE</option>
                <option value="INDEX">INDEX</option>
            </select>
        </div>
        <div class="col text-center">
            <input type="checkbox" name="col[${colIndex}][ai]" value="1" class="form-check-input">
            <small>A.I.</small>
        </div>
        <div class="col text-end">
            <span class="remove-col" style="cursor:pointer;" onclick="this.parentElement.parentElement.remove()">X</span>
        </div>
    `;
                c.appendChild(r);
                colIndex++;
            }

            function previewSQL() {
                const fd = new FormData(document.getElementById('createForm'));
                fd.append('preview', '1');
                fetch('', {
                        method: 'POST',
                        body: fd
                    })
                    .then(r => r.text())
                    .then(h => {
                        const sql = new DOMParser().parseFromString(h, 'text/html').querySelector('#generatedSQL')?.innerText || 'Error';
                        document.getElementById('sqlPreview').textContent = sql;
                        new bootstrap.Modal(document.getElementById('sqlModal')).show();
                    });
            }
        </script>

        <?php
        if (isset($_POST['preview'])) {
            $sql = "CREATE TABLE `" . ($_POST['table_name'] ?? '') . "` (\n";
            foreach ($_POST['col'] as $c) {
                $len = !empty($c['len']) ? "({$c['len']})" : '';
                $null = !empty($c['null']) ? 'NULL' : 'NOT NULL';
                $def = '';
                if (!empty($c['def'])) {
                    if ($c['def'] === 'NULL') $def = ' DEFAULT NULL';
                    elseif (is_numeric($c['def'])) $def = " DEFAULT " . $db->escape($c['def']);
                    else $def = " DEFAULT '" . $db->escape($c['def']) . "'";
                }
                $ai = (!empty($c['ai']) && $c['type'] === 'INT' && !empty($c['index']) && $c['index'] === 'PRIMARY') ? ' AUTO_INCREMENT' : '';
                $name = $db->escape($c['name'] ?? '');
                $sql .= "  `$name` " . strtoupper($c['type'] ?? 'VARCHAR') . "$len $null$def$ai,\n";
            }
            $sql = rtrim($sql, ",\n") . "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            echo "<div id='generatedSQL' style='display:none'>$sql</div>";
            exit;
        }
        ?>
    </div>
</body>

</html>