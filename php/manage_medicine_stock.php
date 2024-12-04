<?php
require "db_connection.php";

if($con) {
  if(isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id = $_GET["id"];
    $query = "DELETE FROM medicines_stock WHERE ID = $id";
    $result = mysqli_query($con, $query);
    if($result) showStockEntries(0);
  }

  if(isset($_GET["action"]) && $_GET["action"] == "edit") {
    $id = $_GET["id"];
    showStockEntries($id);
  }

  if(isset($_GET["action"]) && $_GET["action"] == "update") {
    $id = $_GET["id"];
    $name = $_GET["name"];
    $batch_id = $_GET["batch_id"];
    $expiry_date = $_GET["expiry_date"];
    $quantity = $_GET["quantity"];
    $mrp = $_GET["mrp"];
    $rate = $_GET["rate"];
    updateStock($id, $name, $batch_id, $expiry_date, $quantity, $mrp, $rate);
  }

  if(isset($_GET["action"]) && $_GET["action"] == "search")
    searchStock(strtoupper($_GET["text"]), $_GET["tag"]);
}

function showStockEntries($id) {
  global $con;
  $seq_no = 0;
  $query = "SELECT * FROM medicines_stock";
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    $seq_no++;
    if($row['ID'] == $id)
      showEditOptionsRow($seq_no, $row);
    else
      showStockRow($seq_no, $row);
  }
}

function showStockRow($seq_no, $row) {
  echo '
    <tr>
      <td>'.$seq_no.'</td>
      <td>'.$row['NAME'].'</td>
      <td>'.$row['BATCH_ID'].'</td>
      <td>'.$row['EXPIRY_DATE'].'</td>
      <td>'.$row['QUANTITY'].'</td>
      <td>'.$row['MRP'].'</td>
      <td>'.$row['RATE'].'</td>
      <td>
        <button class="btn btn-info btn-sm" onclick="editStock('.$row['ID'].');"><i class="fa fa-pencil"></i></button>
        <button class="btn btn-danger btn-sm" onclick="deleteStock('.$row['ID'].');"><i class="fa fa-trash"></i></button>
      </td>
    </tr>';
}

function showEditOptionsRow($seq_no, $row) {
  echo '
    <tr>
      <td>'.$seq_no.'</td>
      <td><input type="text" class="form-control" value="'.$row['NAME'].'" id="name"></td>
      <td><input type="text" class="form-control" value="'.$row['BATCH_ID'].'" id="batch_id"></td>
      <td><input type="text" class="form-control" value="'.$row['EXPIRY_DATE'].'" id="expiry_date"></td>
      <td><input type="number" class="form-control" value="'.$row['QUANTITY'].'" id="quantity"></td>
      <td><input type="number" class="form-control" value="'.$row['MRP'].'" id="mrp"></td>
      <td><input type="number" class="form-control" value="'.$row['RATE'].'" id="rate"></td>
      <td>
        <button class="btn btn-success btn-sm" onclick="updateStock('.$row['ID'].');"><i class="fa fa-check"></i></button>
        <button class="btn btn-danger btn-sm" onclick="cancelEdit();"><i class="fa fa-times"></i></button>
      </td>
    </tr>';
}

function updateStock($id, $name, $batch_id, $expiry_date, $quantity, $mrp, $rate) {
  global $con;
  $query = "UPDATE medicines_stock SET NAME='$name', BATCH_ID='$batch_id', EXPIRY_DATE='$expiry_date', QUANTITY='$quantity', MRP='$mrp', RATE='$rate' WHERE ID=$id";
  mysqli_query($con, $query);
  showStockEntries(0);
}

function searchStock($text, $tag) {
  global $con;
  $column = $tag == "name" ? "NAME" : "BATCH_ID";
  $query = "SELECT * FROM medicines_stock WHERE UPPER($column) LIKE '%$text%'";
  $result = mysqli_query($con, $query);
  $seq_no = 0;
  while($row = mysqli_fetch_array($result)) {
    $seq_no++;
    showStockRow($seq_no, $row);
  }
}
?>
