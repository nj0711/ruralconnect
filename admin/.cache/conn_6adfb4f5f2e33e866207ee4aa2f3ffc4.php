<?php
namespace VillageNS_6adfb4f5f2e33e866207ee4aa2f3ffc4;

function __ns_mysqli($server, $user, $pass, $db = '') {
    return new \mysqli($server, $user, $pass, $db);
}

global $db;
$db = 'ruralconnectjol';

$db = "ruralconnectjol";

    class ConnDb {
        private $server = "localhost";
        private $user = "root";
        private $user_pass = "root";
        public $mysqli = null;
        public $conn = false;
        private $result = array();
        private $db;

        public function __construct() {
            global $db;
            $this->db = $db;

            if (!$this->conn) {
                $this->mysqli = __ns_mysqli($this->server, $this->user, $this->user_pass);
                if (mysqli_connect_error()) {
                    array_push($this->result, mysqli_connect_error());
                    $this->conn = false;
                    return;
                }

                if ($this->databaseExists($this->db)) {
                    $this->mysqli = __ns_mysqli($this->server, $this->user, $this->user_pass, $this->db);
                    $this->conn = true;
                }
            }
        }

        public function databaseExists($db) {
            $sql = "SHOW DATABASES LIKE '$db'";
            $res = $this->mysqli->query($sql);
            return $res && $res->num_rows == 1;
        }

        public function tableExists($table) {
            $sql = "SHOW TABLES FROM $this->db LIKE '$table'";
            $res = $this->mysqli->query($sql);
            return $res && $res->num_rows == 1;
        }

        public function insertdata($table, $values) {
            if ($this->tableExists($table)) {
                return $this->mysqli->query($values) ? "Data Inserted." : "Error: " . $this->mysqli->error;
            }
            return "Table $table does not exist!";
        }

        public function insertdata2($table, $values) {
            if ($this->tableExists($table)) {
                $this->mysqli->query($values);
                return $this->mysqli->insert_id;
            }
            return 0;
        }

        public function selectdata($table, $values) {
            if ($this->tableExists($table) && $res = $this->mysqli->query($values)) {
                $data = [];
                while ($row = $res->fetch_assoc()) $data[] = $row;
                return !empty($data) ? $data : 'No Data Found!';
            }
            return 'Table does not exist!';
        }

        public function updatedata($table, $values) {
            return $this->tableExists($table) && $this->mysqli->query($values);
        }

        public function deletedata($table, $values) {
            return $this->tableExists($table) && $this->mysqli->query($values);
        }

        public function escape($value) {
            return $this->mysqli->real_escape_string($value);
        }

        public function __destruct() {
            if ($this->mysqli) $this->mysqli->close();
        }
    }
    ?>
