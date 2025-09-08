<?php
            // Define the database name globally
            $db = "villageonweb_mogri";  // Replace with your actual database name
            
            class ConnDb
            {
                private $server = "localhost";
                private $user = "root";
                private $user_pass = "";
                public $mysqli = null;
                public $conn = false;
                private $result = array();
                private $db;
            
                // Modify the constructor to use the global $db
                public function __construct()
                {
                    global $db;  // Access the global $db
                    $this->db = $db;
            
                    if (!$this->conn) {
                        $this->mysqli = new mysqli($this->server, $this->user, $this->user_pass);
                        $this->conn = true;
            
                        if ($this->mysqli->connect_error) {
                            array_push($this->result, $this->mysqli->connect_error);
                            print_r($this->result);
                            $this->conn = false;
                        }
            
                        if ($this->databaseExists($this->db)) {
                            $this->mysqli = new mysqli($this->server, $this->user, $this->user_pass, $this->db);
                        } else {
                            print_r($this->result[0]);
                        }
                    }
                }
            
                public function databaseExists($db)
                {
                    $sql = "SHOW DATABASES LIKE '$db'";
                    $res = $this->mysqli->query($sql);
                    if ($res) {
                        if ($res->num_rows == 1) {
                            return true;
                        } else {
                            array_push($this->result, $db . "  does not exist!");
                            return false;
                        }
                    }
                }
            
                public function insertdata($table, $values)
                {
                    if ($this->tableExists($table)) {
                        $sql = $values;
                        try {
                            $this->mysqli->query($sql);
                            return "Data Inserted.";
                        } catch (Exception $e) {
                            return "Data Already Exists!" . $e;
                        }
                    } else {
                        print_r($this->result[0]);
                    }
                }
            
                public function insertdata2($table, $values)
                {
                    if ($this->tableExists($table)) {
                        $sql = $values;
                        try {
                            $this->mysqli->query($sql);
                            return $this->mysqli->insert_id;
                        } catch (Exception $e) {
                            return "Data Already Exists!";
                        }
                    } else {
                        print_r($this->result[0]);
                    }
                }
            
                public function selectdata($table, $values)
                {
                    if ($this->tableExists($table)) {
                        $sql = $values;
                        if ($res = $this->mysqli->query($sql)) {
                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                                    $val[] = $row;
                                }
                                return $val;
                            } else {
                                array_push($this->result, "No Data Found!");
                                // print_r($this->result[0]);
                                return 'No Data Found!';
                            }
                        }
                    } else {
                        print_r($this->result[0]);
                    }
                }
            
                public function updatedata($table, $values)
                {
                    if ($this->tableExists($table)) {
                        $sql = $values;
                        if ($this->mysqli->query($sql)) {
                            return "Data Updated";
                        } else {
                            array_push($this->result, " Data updated Failed!");
                            print_r($this->result[0]);
                        }
                    } else {
                        print_r($this->result[0]);
                    }
                }
            
                public function deletedata($table, $values)
                {
                    if ($this->tableExists($table)) {
                        $sql = $values;
                        if ($this->mysqli->query($sql)) {
                            return "Data Deleted";
                        }
                    } else {
                        print_r($this->result[0]);
                    }
                }
            
                public function tableExists($table)
                {
                    $sql = "SHOW TABLES FROM $this->db LIKE '$table'";
                    $res = $this->mysqli->query($sql);
                    if ($res->num_rows == 1) {
                        return true;
                    } else {
                        array_push($this->result, $table . "  does not exist in DB!");
                        return false;
                    }
                }
            
                public function escape($value)
                {
                    return $this->mysqli->real_escape_string($value);
                }
            
                public function __destruct()
                {
                    if ($this->mysqli) {
                        if ($this->mysqli->close()) {
                            $this->conn = false;
                        }
                    }
                }
            }
            ?>