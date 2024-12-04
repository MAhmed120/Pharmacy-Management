<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pharmacy Management - Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="container">
        <div class="card m-auto p-2">
            <div class="card-body">
                <form name="login-form" class="login-form" action="" method="post">
                    <div class="logo">
                        <img src="images/Ahmed2.jpg" class="profile" height="150px"/>
                        <h1 class="logo-caption"><span class="tweak">L</span>ogin</h1>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user text-white"></i></span>
                        </div>
                        <input name="username" type="text" class="form-control" placeholder="username" required>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key text-white"></i></span>
                        </div>
                        <input name="password" type="password" class="form-control" placeholder="password" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default btn-block btn-custom">Login</button>
                    </div>
                </form>

                <?php
                include 'php/db_connection.php'; // Ensure the path is correct
                session_start();

                // Check if the form is submitted
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = mysqli_real_escape_string($con, $_POST['username']);
                    $password = mysqli_real_escape_string($con, $_POST['password']);

                    // Query to check if the username and password are valid
                    $query = "SELECT * FROM admin_credentials WHERE USERNAME = '$username' AND PASSWORD = '$password'";
                    $result = mysqli_query($con, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        // User found, set session variables
                        $_SESSION['username'] = $username;

                        // Set IS_LOGGED_IN to TRUE
                        $update_query = "UPDATE admin_credentials SET IS_LOGGED_IN = TRUE WHERE USERNAME = '$username'";
                        mysqli_query($con, $update_query);

                        header("Location: home.php"); // Redirect to home page
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Username or password invalid!</div>";
                    }
                }
                ?>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <a class="text-light" onclick="$('#changePasswordModal').modal('show');" style="cursor: pointer;">Change Password</a> |
                    <a class="text-light" onclick="displayForgotPasswordForm();" style="cursor: pointer;">Forgot password?</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm" method="post">
                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmNewPassword">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                    <div id="passwordChangeMessage"></div>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Change Password Logic
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['currentPassword'])) {
        $username = $_SESSION['username'];
        $currentPassword = mysqli_real_escape_string($con, $_POST['currentPassword']);
        $newPassword = mysqli_real_escape_string($con, $_POST['newPassword']);
        $confirmNewPassword = mysqli_real_escape_string($con, $_POST['confirmNewPassword']);

        // Check if current password is correct
        $query = "SELECT * FROM admin_credentials WHERE USERNAME = '$username' AND PASSWORD = '$currentPassword'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Check if new passwords match
            if ($newPassword === $confirmNewPassword) {
                // Update the password in the database
                $update_query = "UPDATE admin_credentials SET PASSWORD = '$newPassword' WHERE USERNAME = '$username'";
                if (mysqli_query($con, $update_query)) {
                    echo "<div class='alert alert-success'>Password changed successfully!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Failed to change password. Please try again.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>New passwords do not match!</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Current password is incorrect!</div>";
        }
    }
    ?>
</body>
</html>
