<?php
require "db_connection.php";

if ($con) {
  $action = $_GET["action"] ?? '';

  switch ($action) {
    case "delete":
      $id = $_GET["id"];
      deletePurchase($id);
      break;
    case "edit":
      $id = $_GET["id"];
      showPurchases($id);
      break;
    case "update":
      $id = $_GET["id"];
      $suppliers_name = ucwords($_GET["suppliers_name"]);
      $invoice_date = $_GET["invoice_date"];
      $grand_total = $_GET["grand_total"];
      $payment_status = $_GET["payment_status"];
      updatePurchase($id, $suppliers_name, $invoice_date, $grand_total, $payment_status);
      break;
    case "cancel":
      showPurchases(0);
      break;
    case "search":
      $text = strtoupper($_GET["text"]);
      $tag = $_GET["tag"];
      searchPurchase($text, $tag);
      break;
    default:
      echo "Invalid action";
      break;
  }
}

function deletePurchase($id) {
  global $con;
  $query = "DELETE FROM purchases WHERE VOUCHER_NUMBER = $id";
  $result = mysqli_query($con, $query);
  if ($result) {
    showPurchases(0);
  }
}

function showPurchases($id) {
  global $con;
  $seq_no = 0;
  $query = "SELECT * FROM purchases";
  $result = mysqli_query($con, $query);

  while ($row = mysqli_fetch_array($result)) {
    $seq_no++;
    if ($row['VOUCHER_NUMBER'] == $id) {
      showEditOptionsRow($seq_no, $row);
    } else {
      showPurchaseRow($seq_no, $row);
    }
  }
}

function showPurchaseRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['VOUCHER_NUMBER']; ?></td>
    <td><?php echo $row['SUPPLIER_NAME']; ?></td>
    <td><?php echo $row['INVOICE_NUMBER'] ?? 'N/A'; ?></td> <!-- Add check for 'INVOICE_NUMBER' -->
    <td><?php echo $row['PURCHASE_DATE']; ?></td>
    <td><?php echo $row['TOTAL_AMOUNT']; ?></td>
    <td><?php echo $row['PAYMENT_STATUS']; ?></td>
    <td>
      <button class="btn btn-info btn-sm" onclick="editPurchase(<?php echo $row['VOUCHER_NUMBER']; ?>);">
        <i class="fa fa-pencil"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deletePurchase(<?php echo $row['VOUCHER_NUMBER']; ?>);">
        <i class="fa fa-trash"></i>
      </button>
    </td>
  </tr>
  <?php
}

function showEditOptionsRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['VOUCHER_NUMBER']; ?></td>
    <td>
      <input id="suppliers_name" type="text" class="form-control" value="<?php echo $row['SUPPLIER_NAME']; ?>" placeholder="Supplier Name" disabled>
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['INVOICE_NUMBER'] ?? ''; ?>" id="invoice_number" disabled> <!-- Add check for 'INVOICE_NUMBER' -->
    </td>
    <td>
      <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="<?php echo $row['PURCHASE_DATE']; ?>">
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['TOTAL_AMOUNT']; ?>" id="grand_total" name="grand_total">
    </td>
    <td>
      <select id="payment_status" class="form-control">
        <option value="DUE" <?php if ($row['PAYMENT_STATUS'] == "DUE") echo "selected"; ?>>DUE</option>
        <option value="PAID" <?php if ($row['PAYMENT_STATUS'] == "PAID") echo "selected"; ?>>PAID</option>
      </select>
    </td>
    <td>
      <button class="btn btn-success btn-sm" onclick="updatePurchase(<?php echo $row['VOUCHER_NUMBER']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updatePurchase($id, $suppliers_name, $invoice_date, $grand_total, $payment_status) {
  global $con;
  $query = "UPDATE purchases SET SUPPLIER_NAME = '$suppliers_name', PURCHASE_DATE = '$invoice_date', TOTAL_AMOUNT = $grand_total, PAYMENT_STATUS = '$payment_status' WHERE VOUCHER_NUMBER = $id";
  $result = mysqli_query($con, $query);
  if ($result) {
    showPurchases(0);
  }
}

function searchPurchase($text, $column) {
  global $con;
  $seq_no = 0;
  $query = "SELECT * FROM purchases WHERE $column LIKE '%$text%'";
  $result = mysqli_query($con, $query);
  while ($row = mysqli_fetch_array($result)) {
    $seq_no++;
    showPurchaseRow($seq_no, $row);
  }
}
?>
