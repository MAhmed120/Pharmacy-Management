<?php
require 'php/db_connection.php';
$query = "SELECT COUNT(*) as count FROM customers";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
echo json_encode($row);
?>
