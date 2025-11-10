<?php
// imports/import_watersupply.php
include_once('../../config.php');

session_start();
if (!isset($_SESSION['village_admin_email'])) {
    header("Location: index.php");
    exit();
}

// Set the timeout duration (in seconds)
$timeout_duration = 600; // 10 minutes

// Check if last activity is set and calculate the inactivity period
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time();

$obj = new ConnDb();

// Define the exact fields from your template (EXCLUDING villageid and watersupplyid)
$expected_headers = [
    'systemdescription',
    'sourcetype',
    'sourcedescription',
    'installationdate',
    'capacity',
    'lastmaintenancedate',
    'systemcondition',
    'morningstart',
    'morningend',
    'afternoonstart',
    'afternoonend',
    'eveningstart',
    'eveningend',
    'entityname',
    'entitytype',
    'contactphone',
    'contactperson',
    'address',
    'fundingsource',
    'visibility'
];

$createTableQuery = "
                        CREATE TABLE `watersupply` (
  `watersupplyid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `villageid` int(11) DEFAULT NULL,
  `systemdescription` varchar(255) NOT NULL,
  `sourcetype` varchar(255) NOT NULL,
  `sourcedescription` varchar(255) NOT NULL,
  `installationdate` date NOT NULL,
  `capacity` bigint(20) NOT NULL,
  `lastmaintenancedate` date DEFAULT NULL,
  `systemcondition` varchar(255) DEFAULT NULL,
  `watersupplyschedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`watersupplyschedule`)),
  `entityname` varchar(255) NOT NULL,
  `entitytype` varchar(255) DEFAULT NULL,
  `contactphone` bigint(20) DEFAULT NULL,
  `contactperson` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `fundingsource` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
                        ";

// Run the create table query once (it won't recreate if already exists)
if (!$obj->tableExists('watersupply')) {
    if (!$obj->mysqli->query($createTableQuery)) {
        echo "<script>alert('Error creating table: " . $obj->mysqli->error . "');</script>";
    }
}

$table_name = 'watersupply';

if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
    $file = $_FILES['excel_file']['tmp_name'];
    $file_name = $_FILES['excel_file']['name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($file_ext, ['xls', 'xlsx'])) {
        echo "<div class='alert alert-danger'>Only .xls or .xlsx files are allowed.</div>";
        exit();
    }

    // Handle both HTML table format (from your template) and actual XLSX
    if ($file_ext == 'xls' || strpos(file_get_contents($file, false, null, 0, 1000), '<table') !== false) {
        // Handle HTML table format (like your template output)
        $html_content = file_get_contents($file);
        $imported_data = parseHtmlTable($html_content, $expected_headers);
    } else {
        // Handle actual XLSX file
        $imported_data = parseXlsxFile($file, $expected_headers);
    }

    if (!empty($imported_data)) {
        $inserted_count = 0;
        $error_count = 0;
        $duplicate_count = 0;

        // Get village ID ONCE from database (same as in your insert logic)
        $selQ = "select villageid from villagebasic";
        $village_res = $obj->selectdata("villagebasic", $selQ);
        if ($village_res == "No Data Found!" || empty($village_res)) {
            echo "<div class='alert alert-danger'>Village ID not found in villagebasic table!</div>";
            exit();
        }
        $village_id = $village_res[0]['villageid'];

        // Process each row
        foreach ($imported_data as $row_data) {
            // AUTOMATICALLY ADD villageid from database
            $row_data['villageid'] = $village_id;

            // Skip if required fields are missing
            if (empty($row_data['systemdescription']) || empty($row_data['sourcetype']) || empty($row_data['sourcedescription']) || empty($row_data['installationdate']) || empty($row_data['capacity']) || empty($row_data['entityname'])) {
                $error_count++;
                continue;
            }

            // Check for duplicate system description
            $checkSystem = "SELECT * FROM $table_name WHERE systemdescription='" . $obj->escape($row_data['systemdescription']) . "'";
            $chk = $obj->selectdata($table_name, $checkSystem);

            if ($chk == "No Data Found!") {
                // Try to insert
                if (insertWaterSupplyRecord($row_data, $obj, $table_name)) {
                    $inserted_count++;
                } else {
                    $error_count++;
                }
            } else {
                $duplicate_count++;
            }
        }

        // Show results
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Import Results</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
            <style>
                .results-container { max-width: 600px; margin: 50px auto; padding: 20px; }
                .back-btn { margin-top: 20px; margin-right: 10px; }
                .summary-table { margin-top: 20px; }
                .summary-table th { background-color: #f8f9fa; }
            </style>
        </head>
        <body>
            <div class='container results-container'>
                <div class='card'>
                    <div class='card-header'>
                        <h4 class='card-title'>Import Results</h4>
                    </div>
                    <div class='card-body'>
                        <div class='alert alert-success'>";
        echo "<strong>✅ Import completed successfully!</strong><br>";
        echo "<strong>Village ID:</strong> Automatically set to <code>$village_id</code><br>";
        echo "<strong>📊 Summary:</strong><br>";
        echo "<table class='table table-sm summary-table'>
                <tr><td><strong>Inserted:</strong></td><td><span class='badge bg-success'>$inserted_count records</span></td></tr>
                <tr><td><strong>Duplicates (System Description):</strong></td><td><span class='badge bg-warning'>$duplicate_count records</span></td></tr>
                <tr><td><strong>Errors:</strong></td><td><span class='badge bg-danger'>$error_count records</span></td></tr>
              </table>";
        echo "</div>
                        <div class='d-flex gap-2'>
                            <a href='../editform.php?tablename=watersupply' class='btn btn-primary back-btn'>👁️ View Water Supply List</a>
                            <a href='../watersupply.php' class='btn btn-secondary back-btn'>➕ Add New Water Supply</a>
                            <a href='../watersupply.php' class='btn btn-info back-btn'>📥 Import More</a>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>";
    } else {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Import Results</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body>
            <div class='container results-container'>
                <div class='alert alert-warning'>
                    <h5>⚠️ No valid data found</h5>
                    <p>Please use the downloaded template and ensure you have data in the required fields (System Description, Source Type, Source Description, Installation Date, Capacity, Entity Name).</p>
                </div>
                <a href='../watersupply.php' class='btn btn-primary'>🔄 Try Again</a>
            </div>
        </body>
        </html>";
    }
} else {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Import Error</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class='container results-container'>
            <div class='alert alert-danger'>
                <h5>❌ File upload failed</h5>
                <p>Please select a valid Excel file and try again.</p>
            </div>
            <a href='../watersupply.php' class='btn btn-primary'>🔄 Try Again</a>
        </div>
    </body>
    </html>";
}

// Function to parse HTML table format (matches your template - 20 columns)
function parseHtmlTable($html_content, $expected_headers)
{
    $data_rows = [];

    // Extract rows between <tr> tags (skip first row - headers)
    if (preg_match_all('/<tr[^>]*>(.*?)<\/tr>/s', $html_content, $tr_matches)) {
        foreach ($tr_matches[1] as $index => $tr_content) {
            // Skip header row (first row)
            if ($index === 0) continue;

            $row_data = [];
            // Extract cell data between <td> or <th> tags
            if (preg_match_all('/<(?:td|th)[^>]*>(.*?)<\/(?:td|th)>/s', $tr_content, $td_matches)) {
                $cell_count = 0;
                foreach ($td_matches[1] as $cell_content) {
                    // Clean up cell content (remove HTML tags, decode entities)
                    $clean_value = strip_tags($cell_content);
                    $clean_value = html_entity_decode($clean_value, ENT_QUOTES, 'UTF-8');
                    $clean_value = trim($clean_value);

                    // Map to expected header
                    if (isset($expected_headers[$cell_count])) {
                        $field_name = $expected_headers[$cell_count];
                        $row_data[$field_name] = $clean_value;
                    }
                    $cell_count++;
                }

                // Only add row if we have meaningful data (at least systemdescription or entityname)
                if (!empty($row_data) && (count(array_filter($row_data)) > 2)) {
                    $data_rows[] = $row_data;
                }
            }
        }
    }

    return $data_rows;
}

// Function to parse actual XLSX file (20 columns)
function parseXlsxFile($file_path, $expected_headers)
{
    $data_rows = [];

    $zip = new ZipArchive();
    if ($zip->open($file_path) !== true) {
        return $data_rows; // Return empty on failure
    }

    // Get shared strings
    $shared_xml = $zip->getFromName('xl/sharedStrings.xml');
    $strings = [];
    if ($shared_xml) {
        $shared_strings = simplexml_load_string($shared_xml);
        if ($shared_strings) {
            foreach ($shared_strings->si as $si) {
                $strings[] = (string)$si->t;
            }
        }
    }

    // Get sheet data
    $sheet_xml = $zip->getFromName('xl/worksheets/sheet1.xml');
    if (!$sheet_xml) {
        $zip->close();
        return $data_rows;
    }

    $sheet = simplexml_load_string($sheet_xml);
    if (!$sheet || !isset($sheet->sheetData)) {
        $zip->close();
        return $data_rows;
    }

    $rows = $sheet->sheetData->row;

    // Process data rows (skip header row)
    for ($i = 1; $i < count($rows); $i++) {
        $row = $rows[$i];
        $row_data = [];
        $col_index = 0;

        if (!isset($row->c)) continue;

        foreach ($row->c as $cell) {
            $cell_value = '';
            $cell_type = (string)$cell['t'];

            if ($cell_type == 's') {
                // String reference
                $string_index = (int)$cell->v;
                $cell_value = isset($strings[$string_index]) ? $strings[$string_index] : '';
            } else {
                // Direct value (numbers, dates, etc.)
                $cell_value = (string)$cell->v;
            }

            // Map to expected header
            if (isset($expected_headers[$col_index])) {
                $field_name = $expected_headers[$col_index];
                $row_data[$field_name] = trim($cell_value);
            }
            $col_index++;
        }

        // Only add row if we have meaningful data
        if (!empty($row_data) && (count(array_filter($row_data)) > 2)) {
            $data_rows[] = $row_data;
        }
    }

    $zip->close();
    return $data_rows;
}

// Function to insert record into database (villageid auto-added)
function insertWaterSupplyRecord($data, $obj, $table_name)
{
    try {
        // Define field mappings and data types
        $field_types = [
            'villageid' => 'integer',
            'systemdescription' => 'string',
            'sourcetype' => 'string',
            'sourcedescription' => 'string',
            'installationdate' => 'string',
            'capacity' => 'bigint',
            'lastmaintenancedate' => 'string',
            'systemcondition' => 'string',
            'morningstart' => 'string',
            'morningend' => 'string',
            'afternoonstart' => 'string',
            'afternoonend' => 'string',
            'eveningstart' => 'string',
            'eveningend' => 'string',
            'entityname' => 'string',
            'entitytype' => 'string',
            'contactphone' => 'bigint',
            'contactperson' => 'string',
            'address' => 'text',
            'fundingsource' => 'string',
            'visibility' => 'string'
        ];

        // Prepare data with proper cleaning
        $clean_data = [];
        foreach ($data as $field => $value) {
            if (isset($field_types[$field])) {
                switch ($field_types[$field]) {
                    case 'integer':
                    case 'bigint':
                        $clean_data[$field] = !empty($value) ? (int)$value : 0;
                        break;
                    case 'string':
                        $clean_data[$field] = !empty($value) ? $obj->escape(trim($value)) : '';
                        break;
                    case 'text':
                        $clean_data[$field] = !empty($value) ? $obj->escape(trim($value)) : '';
                        break;
                    default:
                        $clean_data[$field] = !empty($value) ? $obj->escape(trim($value)) : '';
                }
            }
        }

        // Create water supply schedule JSON (same structure as your form)
        $water_supply_schedule = json_encode([
            'MorningStart' => !empty($data['morningstart']) ? $clean_data['morningstart'] : '',
            'MorningEnd' => !empty($data['morningend']) ? $clean_data['morningend'] : '',
            'AfternoonStart' => !empty($data['afternoonstart']) ? $clean_data['afternoonstart'] : '',
            'AfternoonEnd' => !empty($data['afternoonend']) ? $clean_data['afternoonend'] : '',
            'EveningStart' => !empty($data['eveningstart']) ? $clean_data['eveningstart'] : '',
            'EveningEnd' => !empty($data['eveningend']) ? $clean_data['eveningend'] : ''
        ]);

        // Visibility default to 'off' if not provided
        $visibility = !empty($data['visibility']) ? $clean_data['visibility'] : 'off';

        // Build the INSERT query (exact same structure as your original form)
        $columns = [
            'villageid',
            'systemdescription',
            'sourcetype',
            'sourcedescription',
            'installationdate',
            'capacity',
            'lastmaintenancedate',
            'systemcondition',
            'watersupplyschedule',
            'entityname',
            'entitytype',
            'contactphone',
            'contactperson',
            'address',
            'fundingsource',
            'visibility'
        ];

        $values = [
            $clean_data['villageid'],
            $clean_data['systemdescription'],
            $clean_data['sourcetype'],
            $clean_data['sourcedescription'],
            $clean_data['installationdate'],
            $clean_data['capacity'],
            $clean_data['lastmaintenancedate'],
            $clean_data['systemcondition'],
            $water_supply_schedule,
            $clean_data['entityname'],
            $clean_data['entitytype'],
            $clean_data['contactphone'],
            $clean_data['contactperson'],
            $clean_data['address'],
            $clean_data['fundingsource'],
            $visibility
        ];

        // Build query string
        $column_list = implode(', ', $columns);
        $value_placeholders = "'" . implode("', '", $values) . "'";

        $query = "INSERT INTO $table_name ($column_list) VALUES ($value_placeholders)";

        // Execute using your existing method
        $result = $obj->insertdata($table_name, $query);

        return ($result == "Data Inserted.");
    } catch (Exception $e) {
        error_log("Water supply import error: " . $e->getMessage());
        return false;
    }
}
