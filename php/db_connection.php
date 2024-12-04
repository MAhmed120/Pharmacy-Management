<?php
// Define constants for database connection
if (!defined('SERVER')) {
    define('SERVER', 'localhost');
}
if (!defined('USERNAME')) {
    define('USERNAME', 'root');
}
if (!defined('PASSWORD')) {
    define('PASSWORD', ''); // Leave this empty if the root user has no password
}
if (!defined('DB')) {
    define('DB', 'pharmacy'); // Ensure this matches your database name
}
if (!defined('PORT')) {
    define('PORT', 3307); // Set to 3309 if that’s your custom MySQL port
}

// db_connection.php
$con = mysqli_connect(SERVER, USERNAME, PASSWORD, DB, PORT); // Added PORT parameter here

if (!$con) {
    die("<div class='text-danger text-center h5'>Oops, Unable to connect to the database: " . mysqli_connect_error() . "</div>");
}

// Function to check login status
if (!function_exists('checkLoginStatus')) {
    function checkLoginStatus($con) {
        if (isset($_GET['action']) && $_GET['action'] == 'is_logged_in') {
            $username = 'admin'; // Adjust this for dynamic checks if needed

            // Use prepared statements to prevent SQL injection
            $query = "SELECT IS_LOGGED_IN FROM admin_credentials WHERE USERNAME = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                $row = mysqli_fetch_array($result);
                echo isset($row['IS_LOGGED_IN']) ? $row['IS_LOGGED_IN'] : "User not found.";
            } else {
                echo "Error in querying the database: " . mysqli_error($con);
            }

            mysqli_stmt_close($stmt);
        }
    }
}

// Call the function to check login status
checkLoginStatus($con);
?>
