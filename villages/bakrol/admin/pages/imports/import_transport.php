<?php
// imports/import_transport.php
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

// Define the exact fields from your template (EXCLUDING villageid and transportid)
$expected_headers = [
    'stationname',
    'stationtype',
    'address',
    'city',
    'zip',
    'contactno',
    'email',
    'ticketingprocess',
    'photo',
    'description',
    'visibility'
];

$table_name = 'transport';

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

            // Skip if no station name (required field)
            if (empty($row_data['stationname'])) {
                $error_count++;
                continue;
            }

            // Check for duplicate station name (same logic as your form)
            $checkStationName = "SELECT * FROM $table_name WHERE stationname='" . $obj->escape($row_data['stationname']) . "'";
            $chk = $obj->selectdata($table_name, $checkStationName);

            if ($chk == "No Data Found!") {
                // Try to insert
                if (insertTransportRecord($row_data, $obj, $table_name)) {
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
                <tr><td><strong>Duplicates (Station Name):</strong></td><td><span class='badge bg-warning'>$duplicate_count records</span></td></tr>
                <tr><td><strong>Errors:</strong></td><td><span class='badge bg-danger'>$error_count records</span></td></tr>
              </table>";
        echo "</div>
                        <div class='d-flex gap-2'>
                            <a href='../editform.php?tablename=transport' class='btn btn-primary back-btn'>👁️ View Transport List</a>
                            <a href='../transport.php' class='btn btn-secondary back-btn'>➕ Add New Transport</a>
                            <a href='../transport.php' class='btn btn-info back-btn'>📥 Import More</a>
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
                    <p>Please use the downloaded template and ensure you have data in the required fields (Station Name).</p>
                </div>
                <a href='../transport.php' class='btn btn-primary'>🔄 Try Again</a>
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
            <a href='../transport.php' class='btn btn-primary'>🔄 Try Again</a>
        </div>
    </body>
    </html>";
}

// Function to parse HTML table format (matches your template - 10 columns)
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

                // Only add row if we have meaningful data (at least stationname)
                if (!empty($row_data) && (count(array_filter($row_data)) > 1)) {
                    $data_rows[] = $row_data;
                }
            }
        }
    }

    return $data_rows;
}

// Function to parse actual XLSX file (10 columns)
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
        if (!empty($row_data) && (count(array_filter($row_data)) > 1)) {
            $data_rows[] = $row_data;
        }
    }

    $zip->close();
    return $data_rows;
}

// Function to insert record into database (villageid auto-added)
function insertTransportRecord($data, $obj, $table_name)
{
    try {
        // Define field mappings and data types
        $field_types = [
            'villageid' => 'integer',
            'stationname' => 'string',
            'stationtype' => 'string',
            'address' => 'text',
            'city' => 'string',
            'zip' => 'string',
            'contactno' => 'string',
            'email' => 'string',
            'ticketingprocess' => 'string',
            'description' => 'text',
            'visibility' => 'string'
        ];

        // Prepare data with proper cleaning
        $clean_data = [];
        foreach ($data as $field => $value) {
            if (isset($field_types[$field])) {
                switch ($field_types[$field]) {
                    case 'integer':
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

        // Combine address fields (same as your form logic)
        $full_address = $clean_data['address'] . '@' . $clean_data['city'] . '@' . $clean_data['zip'];

        // Handle photo as empty JSON array (since we can't upload files via Excel)
        $photo = json_encode([]);

        // Visibility default to 'off' if not provided
        $visibility = !empty($data['visibility']) ? $clean_data['visibility'] : 'off';

        // Build the INSERT query (exact same structure as your original form)
        $columns = [
            'villageid',
            'stationname',
            'stationtype',
            'address',
            'contactno',
            'email',
            'ticketingprocess',
            'photo',
            'description',
            'visibility'
        ];

        $values = [
            $clean_data['villageid'],
            $clean_data['stationname'],
            $clean_data['stationtype'],
            $full_address,
            $clean_data['contactno'],
            $clean_data['email'],
            $clean_data['ticketingprocess'],
            $photo,
            $clean_data['description'],
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
        error_log("Transport import error: " . $e->getMessage());
        return false;
    }
}
