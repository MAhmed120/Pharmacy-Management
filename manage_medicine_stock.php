<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Medicine Stock</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/manage_stock.js"></script> <!-- JavaScript for managing stock -->
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- Including sidebar navigation -->
    <?php include("sections/sidenav.html"); ?>

    <div class="container-fluid">
      <div class="container">
        <!-- Header section -->
        <?php
          require "php/header.php";
          createHeader('cubes', 'Manage Medicine Stock', 'Manage Existing Medicine Stock');
        ?>
        <!-- Header section end -->

        <!-- Search and Table -->
        <div class="row">
          <div class="col-md-12 form-group form-inline">
            <label class="font-weight-bold" for="">Search:&emsp;</label>
            <input type="text" class="form-control" id="by_name" placeholder="By Medicine Name" onkeyup="searchStock(this.value, 'name');">
            &emsp;<input type="text" class="form-control" id="by_batch" placeholder="By Batch ID" onkeyup="searchStock(this.value, 'batch_id');">
          </div>

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>SL.</th>
                  <th>Medicine Name</th>
                  <th>Batch ID</th>
                  <th>Expiry Date</th>
                  <th>Quantity</th>
                  <th>MRP</th>
                  <th>Rate</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="stock_div">
                <?php
                  require 'php/manage_medicine_stock.php';
                  showStockEntries(0);
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
