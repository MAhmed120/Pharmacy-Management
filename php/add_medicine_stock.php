<?php
require "db_connection.php";

if($con) {
  $medicine_name = $_POST["medicine_name"];
  $batch_id = strtoupper($_POST["batch_id"]); // Ensuring batch ID is uppercase
  $expiry_date = $_POST["expiry_date"];
  $quantity = $_POST["quantity"];
  $mrp = $_POST["mrp"];
  $rate = $_POST["rate"];

  // Check if the batch ID already exists to prevent duplicates
  $check_query = "SELECT * FROM medicines_stock WHERE BATCH_ID = '$batch_id'";
  $check_result = mysqli_query($con, $check_query);

  if(mysqli_num_rows($check_result) > 0) {
    echo "Batch ID $batch_id already exists!";
  } else {
    // Insert the new stock entry
    $query = "INSERT INTO medicines_stock (NAME, BATCH_ID, EXPIRY_DATE, QUANTITY, MRP, RATE) VALUES ('$medicine_name', '$batch_id', '$expiry_date', '$quantity', '$mrp', '$rate')";
    $result = mysqli_query($con, $query);

    if($result) {
      echo "Medicine stock added successfully.";
    } else {
      echo "Failed to add medicine stock.";
    }
  }
} else {
  echo "Database connection failed.";
}
?>
