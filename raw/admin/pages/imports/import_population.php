<?php
// imports/import_population.php
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

// Define the exact fields from your template (EXCLUDING villageid and populationid)
$expected_headers = [
    'totalnoofmale',
    'totalnooffemale',
    'totalnoofchildren',
    'birthanddeathratio',
    'religionandpopulation',
    'occupationandpopulation',
    'educationandpopulation',
    'salaryandpopulation',
    'agewisemale',
    'agewisefemale',
];

$createTableQuery = "
                        CREATE TABLE `population` (
  `populationid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `villageid` int(11) DEFAULT NULL,
  `totalnoofmale` int(11) DEFAULT NULL,
  `totalnooffemale` int(11) DEFAULT NULL,
  `totalnoofchildren` int(11) DEFAULT NULL,
  `religionandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`religionandpopulation`)),
  `occupationandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`occupationandpopulation`)),
  `educationandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`educationandpopulation`)),
  `salaryandpopulation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`salaryandpopulation`)),
  `birthanddeathratio` varchar(10) DEFAULT NULL,
  `agewisemale` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`agewisemale`)),
  `agewisefemale` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`agewisefemale`))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
                        ";

// Run the create table query once (it won't recreate if already exists)
if (!$obj->tableExists('population')) {
    if (!$obj->mysqli->query($createTableQuery)) {
        echo "<script>alert('Error creating table: " . $obj->mysqli->error . "');</script>";
    }
}

$table_name = 'population';

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
            if (empty($row_data['totalnoofmale']) || empty($row_data['totalnooffemale']) || empty($row_data['totalnoofchildren'])) {
                $error_count++;
                continue;
            }

            // Check for duplicate population record (check if similar totals exist)
            $checkPopulation = "SELECT * FROM $table_name WHERE villageid='$village_id' AND totalnoofmale=" . intval($row_data['totalnoofmale']) . " AND totalnooffemale=" . intval($row_data['totalnooffemale']);
            $chk = $obj->selectdata($table_name, $checkPopulation);

            if ($chk == "No Data Found!") {
                // Try to insert
                if (insertPopulationRecord($row_data, $obj, $table_name, $village_id)) {
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
                <tr><td><strong>Duplicates (Population Totals):</strong></td><td><span class='badge bg-warning'>$duplicate_count records</span></td></tr>
                <tr><td><strong>Errors:</strong></td><td><span class='badge bg-danger'>$error_count records</span></td></tr>
              </table>";
        echo "</div>
                        <div class='d-flex gap-2'>
                            <a href='../editform.php?tablename=population' class='btn btn-primary back-btn'>👁️ View Population List</a>
                            <a href='../population.php' class='btn btn-secondary back-btn'>➕ Add New Population Data</a>
                            <a href='../population.php' class='btn btn-info back-btn'>📥 Import More</a>
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
                    <p>Please use the downloaded template and ensure you have data in the required fields (Total Males, Total Females, Total Children).</p>
                </div>
                <a href='../population.php' class='btn btn-primary'>🔄 Try Again</a>
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
            <a href='../population.php' class='btn btn-primary'>🔄 Try Again</a>
        </div>
    </body>
    </html>";
}

// Function to parse HTML table format (matches your template - 11 columns)
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

                // Only add row if we have meaningful data (at least total population numbers)
                if (!empty($row_data) && (
                    (!empty($row_data['totalnoofmale']) && is_numeric($row_data['totalnoofmale'])) ||
                    (!empty($row_data['totalnooffemale']) && is_numeric($row_data['totalnooffemale'])) ||
                    (!empty($row_data['totalnoofchildren']) && is_numeric($row_data['totalnoofchildren']))
                )) {
                    $data_rows[] = $row_data;
                }
            }
        }
    }

    return $data_rows;
}

// Function to parse actual XLSX file (11 columns)
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

        // Only add row if we have meaningful population data
        if (!empty($row_data) && (
            (!empty($row_data['totalnoofmale']) && is_numeric($row_data['totalnoofmale'])) ||
            (!empty($row_data['totalnooffemale']) && is_numeric($row_data['totalnooffemale'])) ||
            (!empty($row_data['totalnoofchildren']) && is_numeric($row_data['totalnoofchildren']))
        )) {
            $data_rows[] = $row_data;
        }
    }

    $zip->close();
    return $data_rows;
}

// Function to insert record into database (villageid auto-added)
function insertPopulationRecord($data, $obj, $table_name, $village_id)
{
    try {
        // Define field mappings and data types
        $field_types = [
            'villageid' => 'integer',
            'totalnoofmale' => 'integer',
            'totalnooffemale' => 'integer',
            'totalnoofchildren' => 'integer',
            'birthanddeathratio' => 'string',
            'religionandpopulation' => 'json',
            'occupationandpopulation' => 'json',
            'educationandpopulation' => 'json',
            'salaryandpopulation' => 'json',
            'agewisemale' => 'json',
            'agewisefemale' => 'json',
        ];

        // Prepare data with proper cleaning
        $clean_data = [];
        foreach ($data as $field => $value) {
            if (isset($field_types[$field])) {
                switch ($field_types[$field]) {
                    case 'integer':
                        $clean_data[$field] = !empty($value) && is_numeric($value) ? (int)$value : 0;
                        break;
                    case 'string':
                        $clean_data[$field] = !empty($value) ? $obj->escape(trim($value)) : '';
                        break;
                    case 'json':
                        // Handle JSON fields - try to parse if it's JSON string, otherwise create empty structure
                        if (!empty($value) && is_string($value)) {
                            // Try to decode JSON
                            $decoded = json_decode($value, true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                $clean_data[$field] = json_encode($decoded);
                            } else {
                                // If not valid JSON, create default structure based on field name
                                $clean_data[$field] = createDefaultJsonStructure($field);
                            }
                        } else {
                            $clean_data[$field] = createDefaultJsonStructure($field);
                        }
                        break;
                    default:
                        $clean_data[$field] = !empty($value) ? $obj->escape(trim($value)) : '';
                }
            }
        }

        // Set village ID
        $clean_data['villageid'] = $village_id;


        // Build the INSERT query (exact same structure as your original form)
        $columns = [
            'villageid',
            'totalnoofmale',
            'totalnooffemale',
            'totalnoofchildren',
            'birthanddeathratio',
            'religionandpopulation',
            'occupationandpopulation',
            'educationandpopulation',
            'salaryandpopulation',
            'agewisemale',
            'agewisefemale',
        ];

        $values = [
            $clean_data['villageid'],
            $clean_data['totalnoofmale'],
            $clean_data['totalnooffemale'],
            $clean_data['totalnoofchildren'],
            $clean_data['birthanddeathratio'],
            $clean_data['religionandpopulation'],
            $clean_data['occupationandpopulation'],
            $clean_data['educationandpopulation'],
            $clean_data['salaryandpopulation'],
            $clean_data['agewisemale'],
            $clean_data['agewisefemale'],
        ];

        // Build query string
        $column_list = implode(', ', $columns);
        $value_placeholders = "'" . implode("', '", $values) . "'";

        $query = "INSERT INTO $table_name ($column_list) VALUES ($value_placeholders)";

        // Execute using your existing method
        $result = $obj->insertdata($table_name, $query);

        return ($result == "Data Inserted.");
    } catch (Exception $e) {
        error_log("Population import error: " . $e->getMessage());
        return false;
    }
}

// Helper function to create default JSON structures for missing data
function createDefaultJsonStructure($field_name)
{
    switch ($field_name) {
        case 'religionandpopulation':
            return json_encode([
                'tot_hindus' => 0,
                'tot_muslims' => 0,
                'tot_christians' => 0,
                'tot_sikh' => 0,
                'tot_others' => 0
            ]);
        case 'occupationandpopulation':
            return json_encode([
                'tot_farmers' => 0,
                'tot_govEmp' => 0,
                'occ_3_name' => '',
                'occ_3' => 0,
                'occ_4_name' => '',
                'occ_4' => 0,
                'occ_5_name' => '',
                'occ_5' => 0
            ]);
        case 'educationandpopulation':
            return json_encode([
                'tot_10' => 0,
                'tot_12' => 0,
                'tot_ugs' => 0,
                'tot_pgs' => 0,
                'tot_nonedus' => 0
            ]);
        case 'salaryandpopulation':
            return json_encode([
                'inc_above_15' => 0,
                'inc_10_15' => 0,
                'inc_3_10' => 0,
                'inc_below_3' => 0
            ]);
        case 'agewisemale':
            return json_encode([
                'tot_100_m' => 0,
                'tot_80_m' => 0,
                'tot_60_m' => 0,
                'tot_40_m' => 0,
                'tot_20_m' => 0
            ]);
        case 'agewisefemale':
            return json_encode([
                'tot_100_f' => 0,
                'tot_80_f' => 0,
                'tot_60_f' => 0,
                'tot_40_f' => 0,
                'tot_20_f' => 0
            ]);
        default:
            return '{}';
    }
}
