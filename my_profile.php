<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/my_profile.js"></script>
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
</head>
<body>
    <?php include("sections/sidenav.html"); ?>
    <div class="container-fluid">
        <div class="container">
            <?php
              require "php/header.php";
              createHeader('user', 'Profile', 'Manage Admin Details');
              require "php/db_connection.php";
              if ($con) {
                  $query = "SELECT * FROM admin_credentials";
                  $result = mysqli_query($con, $query);
                  $row = mysqli_fetch_array($result);
                  $pharmacy_name = isset($row['PHARMACY_NAME']) ? $row['PHARMACY_NAME'] : '';
                  $address = isset($row['ADDRESS']) ? $row['ADDRESS'] : '';
                  $email = isset($row['EMAIL']) ? $row['EMAIL'] : '';
                  $contact_number = isset($row['CONTACT_NUMBER']) ? $row['CONTACT_NUMBER'] : '';
                  $username = isset($row['USERNAME']) ? $row['USERNAME'] : '';
              }
            ?>
            <div class="row">
                <div class="row col col-md-6">
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label class="font-weight-bold" for="pharmacy_name">Pharmacy Name :</label>
                            <input id="pharmacy_name" type="text" class="form-control" value="<?php echo $pharmacy_name; ?>" placeholder="pharmacy name" disabled>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label class="font-weight-bold" for="address">Address :</label>
                            <textarea id="address" class="form-control" placeholder="address" disabled><?php echo $address; ?></textarea>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label class="font-weight-bold" for="email">Email :</label>
                            <input id="email" type="email" class="form-control" value="<?php echo $email; ?>" placeholder="email" disabled>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label class="font-weight-bold" for="contact_number">Contact Number :</label>
                            <input id="contact_number" type="number" class="form-control" value="<?php echo $contact_number; ?>" placeholder="contact number" disabled>
                        </div>
                    </div>
                    <div class="row col col-md-12">
                        <div class="col col-md-12 form-group">
                            <label class="font-weight-bold" for="username">Username :</label>
                            <input id="username" type="text" class="form-control" value="<?php echo $username; ?>" placeholder="username" disabled>
                        </div>
                    </div>

                    <div class="col col-md-12">
                        <hr class="col-md-12 float-left" style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
                    </div>

                    <div class="row col col-md-12 m-auto" id="edit">
                        <div class="col col-md-4 form-group float-right">
                            <button class="btn btn-primary form-control font-weight-bold" onclick="edit();">EDIT</button>
                        </div>
                        <div class="col col-md-4 form-group float-right">
                            <a href="change_password.php" class="btn btn-warning form-control font-weight-bold">Change Password</a>
                        </div>
                    </div>

                    <div class="row col col-md-12 m-auto" id="update_cancel" style="display: none;">
                        <div class="col col-md-4 form-group float-right">
                            <button class="btn btn-danger form-control font-weight-bold" onclick="edit(true);">CANCEL</button>
                        </div>
                        <div class="col col-md-4 form-group float-right">
                            <button class="btn btn-success form-control font-weight-bold" onclick="updateAdminDetails();">UPDATE</button>
                        </div>
                    </div>
                    <div id="admin_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center"></div>
                </div>
            </div>
            <hr style="border-top: 2px solid #ff5252;">
        </div>
    </div>
</body>
</html>
