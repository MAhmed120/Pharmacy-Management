<?php
require "db_connection.php";

if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $invoice_number = $_GET["invoice_number"];
    $query = "DELETE FROM invoices WHERE INVOICE_ID = $invoice_number";
    $result = mysqli_query($con, $query);
    if (!empty($result))
        showInvoices();
}

if (isset($_GET["action"]) && $_GET["action"] == "refresh") {
    showInvoices();
}

if (isset($_GET["action"]) && $_GET["action"] == "search") {
    $searchText = strtoupper(trim($_GET["text"]));
    if (!empty($searchText)) {
        searchInvoice($searchText, $_GET["tag"]);
    } else {
        showInvoices();
    }
}

if (isset($_GET["action"]) && $_GET["action"] == "print_invoice") {
    printInvoice($_GET["invoice_number"]);
}

function showInvoices() {
    require "db_connection.php";
    if ($con) {
        $seq_no = 0;
        $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_array($result)) {
            $seq_no++;
            showInvoiceRow($seq_no, $row);
        }
    }
}

function showInvoiceRow($seq_no, $row) {
    ?>
    <tr>
        <td><?php echo $seq_no; ?></td>
        <td><?php echo $row['INVOICE_ID']; ?></td>
        <td><?php echo $row['NAME']; ?></td>
        <td><?php echo $row['INVOICE_DATE']; ?></td>
        <td><?php echo $row['TOTAL_AMOUNT']; ?></td>
        <td><?php echo $row['TOTAL_DISCOUNT']; ?></td>
        <td><?php echo $row['NET_TOTAL']; ?></td>
        <td>
            <button class="btn btn-warning btn-sm" onclick="printInvoice(<?php echo $row['INVOICE_ID']; ?>);">
                <i class="fa fa-fax"></i>
            </button>
            <button class="btn btn-danger btn-sm" onclick="deleteInvoice(<?php echo $row['INVOICE_ID']; ?>);">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
    <?php
}

function searchInvoice($text, $column) {
    require "db_connection.php";
    if ($con) {
        $seq_no = 0;
        if ($column == 'INVOICE_ID' || $column == "INVOICE_DATE") {
            $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE invoices.$column = '$text'";
        } else {
            $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE UPPER(customers.$column) LIKE '%$text%'";
        }
        $result = mysqli_query($con, $query);
        if (!$result) {
            echo "Error executing query: " . mysqli_error($con);
            return;
        }
        while ($row = mysqli_fetch_array($result)) {
            $seq_no++;
            showInvoiceRow($seq_no, $row);
        }
    }
}

function printInvoice($invoice_number) {
    require "db_connection.php";
    global $con; // Make sure the connection is available in included templates
    if ($con) {
        // Fetch invoice details
        $query = "SELECT * FROM invoices WHERE INVOICE_ID = $invoice_number";
        $result = mysqli_query($con, $query);
        $invoice_row = mysqli_fetch_array($result);

        if (!$invoice_row) {
            echo "No invoice details found.";
            return;
        }

        // Assigning invoice data to variables
        $invoice_date = $invoice_row['INVOICE_DATE'];
        $total_amount = $invoice_row['TOTAL_AMOUNT'];
        $total_discount = $invoice_row['TOTAL_DISCOUNT'];
        $net_total = $invoice_row['NET_TOTAL'];

        // Fetch customer details
        $query = "SELECT * FROM customers WHERE ID = " . $invoice_row['CUSTOMER_ID'];
        $result = mysqli_query($con, $query);
        $customer_row = mysqli_fetch_array($result);

        if (!$customer_row) {
            echo "No customer details found.";
            return;
        }

        // Assigning customer data to variables
        $customer_name = $customer_row['NAME'];
        $address = $customer_row['ADDRESS'];
        $contact_number = $customer_row['CONTACT_NUMBER'];
        $doctor_name = $customer_row['DOCTOR_NAME'];
        $doctor_address = $customer_row['DOCTOR_ADDRESS'];

        // Include the invoice template
        include("invoice_template.php");
    }
}
?>
