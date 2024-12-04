<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pharmacy Management - Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
                    <a class="text-light" onclick="displayForgotPasswordForm();" style="cursor: pointer;">Forgot password?</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
