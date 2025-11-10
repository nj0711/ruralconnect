<?php
// imports/import_pillarofcommunity.php
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

// Define the exact fields from your template (EXCLUDING villageid and pillarofcommunityid)
$expected_headers = [
    'name',
    'birthdate',
    'dateofpassing',
    'profession',
    'typeofleader',
    'education',
    'politicalcareer',
    'positionsheld',
    'roleinindependencemovement',
    'description',
    'photo',
    'visibility'
];

$createTableQuery = "
                       CREATE TABLE `pillarofcommunity` (
  `pillarofcommunityid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `dateofpassing` date DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `politicalcareer` varchar(255) DEFAULT NULL,
  `positionsheld` varchar(255) DEFAULT NULL,
  `roleinindependencemovement` varchar(255) DEFAULT NULL,
  `villageid` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin  CHECK (json_valid(`photo`)),
  `profession` varchar(500) DEFAULT NULL,
  `typeofleader` varchar(50) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
                        ";

// Run the create table query once (it won't recreate if already exists)
if (!$obj->tableExists('pillarofcommunity')) {
    if (!$obj->mysqli->query($createTableQuery)) {
        echo "<script>alert('Error creating table: " . $obj->mysqli->error . "');</script>";
    }
}

$table_name = 'pillarofcommunity';

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
        $selq = "select villageid from villagebasic";
        $village_res = $obj->selectdata("villagebasic", $selq);
        if ($village_res == "No Data Found!" || empty($village_res)) {
            echo "<div class='alert alert-danger'>Village ID not found in villagebasic table!</div>";
            exit();
        }
        $village_id = $village_res[0]['villageid'];

        // Process each row
        foreach ($imported_data as $row_data) {
            // AUTOMATICALLY ADD villageid from database
            $row_data['villageid'] = $village_id;

            // Skip if no name (required field based on your schema)
            if (empty($row_data['name'])) {
                $error_count++;
                continue;
            }

            // Check for duplicate name
            $checkDuplicate = "SELECT * FROM $table_name WHERE name='" . $obj->escape($row_data['name']) . "'";
            $chk = $obj->selectdata($table_name, $checkDuplicate);

            if ($chk == "No Data Found!") {
                // Try to insert
                if (insertPillarOfCommunityRecord($row_data, $obj, $table_name)) {
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
                        <h4 class='card-title'>Pillar of Community Import Results</h4>
                    </div>
                    <div class='card-body'>
                        <div class='alert alert-success'>";
        echo "<strong>✅ Import completed successfully!</strong><br>";
        echo "<strong>Village ID:</strong> Automatically set to <code>$village_id</code><br>";
        echo "<strong>📊 Summary:</strong><br>";
        echo "<table class='table table-sm summary-table'>
                <tr><td><strong>Inserted:</strong></td><td><span class='badge bg-success'>$inserted_count records</span></td></tr>
                <tr><td><strong>Duplicates (Name):</strong></td><td><span class='badge bg-warning'>$duplicate_count records</span></td></tr>
                <tr><td><strong>Errors:</strong></td><td><span class='badge bg-danger'>$error_count records</span></td></tr>
              </table>";
        echo "</div>
                        <div class='d-flex gap-2 flex-wrap'>
                            <a href='../editform.php?tablename=pillarofcommunity' class='btn btn-primary back-btn'>👥 View Pillars List</a>
                            <a href='../pillarofcommunity.php' class='btn btn-secondary back-btn'>➕ Add New Leader</a>
                            <a href='../pillarofcommunity.php#import-section' class='btn btn-info back-btn'>📥 Import More</a>
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
                    <p>Please use the downloaded template and ensure you have data in the required fields (Name).</p>
                </div>
                <a href='../pillarofcommunity.php' class='btn btn-primary'>🔄 Try Again</a>
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
            <a href='../pillarofcommunity.php' class='btn btn-primary'>🔄 Try Again</a>
        </div>
    </body>
    </html>";
}

// Function to parse HTML table format (matches your template - 11 columns now)
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

                // Only add row if we have meaningful data (at least name)
                if (!empty($row_data) && (count(array_filter($row_data)) > 1)) {
                    $data_rows[] = $row_data;
                }
            }
        }
    }

    return $data_rows;
}

// Function to parse actual XLSX file (11 columns now)
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

// Function to insert pillar of community record into database (villageid auto-added, photo as empty JSON)
function insertPillarOfCommunityRecord($data, $obj, $table_name)
{
    try {
        // Define field mappings and data types
        $field_types = [
            'villageid' => 'integer',
            'name' => 'string',
            'birthdate' => 'date',
            'dateofpassing' => 'date',
            'profession' => 'string',
            'typeofleader' => 'string',
            'education' => 'string',
            'politicalcareer' => 'text',
            'positionsheld' => 'text',
            'roleinindependencemovement' => 'text',
            'description' => 'text',
            'photo' => 'json',
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
                    case 'date':
                        // Validate date format (YYYY-MM-DD)
                        if (!empty($value)) {
                            $date = DateTime::createFromFormat('Y-m-d', $value);
                            if ($date && $date->format('Y-m-d') === $value) {
                                $clean_data[$field] = $obj->escape($value);
                            } else {
                                $clean_data[$field] = ''; // Clear invalid date
                            }
                        } else {
                            $clean_data[$field] = '';
                        }
                        break;
                    case 'string':
                        $clean_data[$field] = !empty($value) ? $obj->escape(trim($value)) : '';
                        break;
                    case 'text':
                        $clean_data[$field] = !empty($value) ? $obj->escape(trim($value)) : '';
                        break;
                    case 'json':
                        // Handle photo as empty JSON array (since we can't upload files via Excel)
                        if ($field == 'photo') {
                            $clean_data[$field] = json_encode([]);
                        }
                        break;
                    default:
                        $clean_data[$field] = !empty($value) ? $obj->escape(trim($value)) : '';
                }
            }
        }

        // Validate leader type (sarpanch, mla, other)
        $valid_leader_types = ['sarpanch', 'mla', 'other'];
        if (!empty($clean_data['typeofleader']) && !in_array($clean_data['typeofleader'], $valid_leader_types)) {
            $clean_data['typeofleader'] = 'other'; // Default to other
        } elseif (empty($clean_data['typeofleader'])) {
            $clean_data['typeofleader'] = 'other'; // Default if empty
        }

        // Validate birth date (must be past date)
        if (!empty($clean_data['birthdate'])) {
            $birth_date = DateTime::createFromFormat('Y-m-d', $clean_data['birthdate']);
            $today = new DateTime();
            if ($birth_date > $today) {
                $clean_data['birthdate'] = ''; // Clear future birth date
            }
        }

        // Validate date of passing (must be after birth date and past date if provided)
        if (!empty($clean_data['dateofpassing']) && !empty($clean_data['birthdate'])) {
            $birth_date = DateTime::createFromFormat('Y-m-d', $clean_data['birthdate']);
            $passing_date = DateTime::createFromFormat('Y-m-d', $clean_data['dateofpassing']);
            $today = new DateTime();

            if ($passing_date < $birth_date || $passing_date > $today) {
                $clean_data['dateofpassing'] = ''; // Clear invalid passing date
            }
        }

        // Set default visibility if not provided
        if (empty($clean_data['visibility'])) {
            $clean_data['visibility'] = 'off';
        }

        // Build the INSERT query (matching your exact form structure)
        $columns = [
            'villageid',
            'name',
            'birthdate',
            'dateofpassing',
            'profession',
            'typeofleader',
            'education',
            'politicalcareer',
            'positionsheld',
            'roleinindependencemovement',
            'description',
            'photo'
        ];

        $values = [
            $clean_data['villageid'],
            $clean_data['name'],
            $clean_data['birthdate'],
            $clean_data['dateofpassing'],
            $clean_data['profession'],
            $clean_data['typeofleader'],
            $clean_data['education'],
            $clean_data['politicalcareer'],
            $clean_data['positionsheld'],
            $clean_data['roleinindependencemovement'],
            $clean_data['description'],
            $clean_data['photo'] // Empty JSON array
        ];

        // Build query string
        $column_list = implode(', ', $columns);
        $value_placeholders = "'" . implode("', '", $values) . "'";

        $query = "INSERT INTO $table_name ($column_list) VALUES ($value_placeholders)";

        // Execute using your existing method
        $result = $obj->insertdata($table_name, $query);

        return ($result == "Data Inserted.");
    } catch (Exception $e) {
        error_log("Pillar of community import error: " . $e->getMessage());
        return false;
    }
}
