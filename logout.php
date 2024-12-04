<?php
require "php/db_connection.php"; // Make sure this path is correct

if ($con) {
    // Set the is_logged_in field to 0 (which represents false)
    $query = "UPDATE admin_credentials SET IS_LOGGED_IN = 0"; // Use 0 instead of 'false'
    $result = mysqli_query($con, $query);
    
    if ($result) {
        // Optionally you could redirect or show a message
        header("Location: login.php"); // Redirect to login page after logout
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con); // Show error message if query fails
    }
} else {
    echo "Database connection failed!";
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Logout</title>
    <script src="js/restrict.js"></script>
</head>
<body>
    <!-- Optional content while logging out -->
    <h1>Logging out...</h1>
</body>
</html>
