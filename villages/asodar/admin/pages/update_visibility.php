<?php
require '../config.php'; // Include your database connection file

$tableName = $_GET['tablename'];
$id = $_GET['updateid'];
$ls = $_GET['vi'];
$tableNameid = $tableName.'id';
$obj = new ConnDb();
$updateQuery = "UPDATE $tableName SET visibility = '$ls' WHERE $tableNameid = $id";
$result = $obj->updatedata($tableName,$updateQuery);

header("Location :editform.php?tablename=".$tableName);
exit();
?>
