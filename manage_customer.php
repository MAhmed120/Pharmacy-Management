<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Manage Customers</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/manage_customer.js"></script>
</head>
<body>
    <?php include("sections/sidenav.html"); ?>

    <div class="container-fluid">
      <div class="container">
        <?php
          require "php/header.php";
          createHeader('handshake', 'Manage Customers', 'Manage Existing Customer');
        ?>

        <div class="row">
          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Search :&emsp;</label>
            <input type="text" class="form-control" placeholder="Search Customer" onkeyup="searchCustomer(this.value);">
          </div>

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th style="width: 5%;">SL.</th>
                  <th style="width: 15%;">Customer Name</th>
                  <th style="width: 15%;">Contact Number</th>
                  <th style="width: 25%;">Address</th>
                  <th style="width: 15%;">Doctor's Name</th>
                  <th style="width: 15%;">Doctor's Address</th>
                  <th style="width: 10%;">Action</th>
                </tr>
              </thead>
              <tbody id="customers_div">
                <?php
                  require 'php/manage_customer.php';
                  showCustomers();
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
</body>
</html>
