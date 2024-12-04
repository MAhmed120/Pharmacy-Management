<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Medicine Stock</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/suggestions.js"></script>
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- including side navigations -->
    <?php include("sections/sidenav.html"); ?>

    <div class="container-fluid">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('boxes', 'Add Medicine Stock', 'Add New Medicine Stock Entry');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <div class="row col col-md-6">
            <form action="php/add_medicine_stock.php" method="post">
              <div class="form-group">
                <label for="medicine_name">Medicine Name:</label>
                <input type="text" class="form-control" name="medicine_name" id="medicine_name" placeholder="Enter Medicine Name" required>
              </div>

              <div class="form-group">
                <label for="batch_id">Batch ID:</label>
                <input type="text" class="form-control" name="batch_id" id="batch_id" placeholder="Enter Batch ID" required>
              </div>

              <div class="form-group">
                <label for="expiry_date">Expiry Date (MM/YY):</label>
                <input type="text" class="form-control" name="expiry_date" id="expiry_date" placeholder="MM/YY" pattern="(0[1-9]|1[0-2])\/\d{2}" required>
              </div>

              <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter Quantity" required>
              </div>

              <div class="form-group">
                <label for="mrp">MRP:</label>
                <input type="number" step="0.01" class="form-control" name="mrp" id="mrp" placeholder="Enter MRP" required>
              </div>

              <div class="form-group">
                <label for="rate">Rate:</label>
                <input type="number" step="0.01" class="form-control" name="rate" id="rate" placeholder="Enter Rate" required>
              </div>

              <button type="submit" class="btn btn-primary">Add Stock</button>
            </form>
          </div>
        </div>
        <!-- form content end -->

        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
