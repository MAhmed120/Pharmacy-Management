<?php
require "db_connection.php";

if ($con) {
    if (isset($_GET["action"])) {
        switch ($_GET["action"]) {
            case "delete":
                $id = (int)$_GET["id"]; // Sanitize input
                $query = "DELETE FROM customers WHERE ID = $id";
                $result = mysqli_query($con, $query);
                if ($result) {
                    showCustomers(0);
                } else {
                    echo "Failed to delete customer: " . mysqli_error($con);
                }
                break;

            case "edit":
                $id = (int)$_GET["id"]; // Sanitize input
                showCustomers($id); // Show edit form for specified ID
                break;

            case "update":
                $id = (int)$_GET["id"]; // Sanitize input
                $name = ucwords(mysqli_real_escape_string($con, $_GET["name"]));
                $contact_number = mysqli_real_escape_string($con, $_GET["contact_number"]);
                $address = ucwords(mysqli_real_escape_string($con, $_GET["address"]));
                $doctor_name = ucwords(mysqli_real_escape_string($con, $_GET["doctor_name"]));
                $doctor_address = ucwords(mysqli_real_escape_string($con, $_GET["doctor_address"]));
                $query = "UPDATE customers SET NAME = '$name', CONTACT_NUMBER = '$contact_number', ADDRESS = '$address', DOCTOR_NAME = '$doctor_name', DOCTOR_ADDRESS = '$doctor_address' WHERE ID = $id";
                $result = mysqli_query($con, $query);
                if ($result) {
                    showCustomers(0);
                } else {
                    echo "Failed to update customer: " . mysqli_error($con);
                }
                break;

            case "cancel":
                showCustomers(0);
                break;

            case "search":
                $text = strtoupper(mysqli_real_escape_string($con, $_GET["text"]));
                searchCustomer($text);
                break;
        }
    }
}

function showCustomers($id = 0) {
    global $con;
    $seq_no = 0;
    $query = "SELECT * FROM customers";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo "<tr><td colspan='7'>Error in query: " . mysqli_error($con) . "</td></tr>";
        return;
    }

    if (mysqli_num_rows($result) == 0) {
        echo "<tr><td colspan='7'>No customers found in the database.</td></tr>";
        return;
    }

    // Debugging output
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<!-- Debug row data: " . print_r($row, true) . " -->"; // Debugging output to inspect data
        $seq_no++;
        if (!isset($row['ID'])) {
            echo "<tr><td colspan='7'>Error: Missing customer ID in the retrieved data.</td></tr>";
            continue;
        }
        if ($row['ID'] == $id) {
            showEditOptionsRow($seq_no, $row);
        } else {
            showCustomerRow($seq_no, $row);
        }
    }
}

function showCustomerRow($seq_no, $row) {
    echo "<tr>";
    echo "<td>{$seq_no}</td>";
    echo "<td>" . htmlspecialchars($row['NAME'] ?? 'N/A') . "</td>";
    echo "<td>" . htmlspecialchars($row['CONTACT_NUMBER'] ?? 'N/A') . "</td>";
    echo "<td>" . htmlspecialchars($row['ADDRESS'] ?? 'N/A') . "</td>";
    echo "<td>" . htmlspecialchars($row['DOCTOR_NAME'] ?? 'N/A') . "</td>";
    echo "<td>" . htmlspecialchars($row['DOCTOR_ADDRESS'] ?? 'N/A') . "</td>";
    echo "<td>
            <button class='btn btn-info btn-sm' onclick='editCustomer(" . (int)$row['ID'] . ");'>
                <i class='fa fa-pencil'></i>
            </button>
            <button class='btn btn-danger btn-sm' onclick='deleteCustomer(" . (int)$row['ID'] . ");'>
                <i class='fa fa-trash'></i>
            </button>
          </td>";
    echo "</tr>";
}

function showEditOptionsRow($seq_no, $row) {
    echo "<tr>";
    echo "<td>{$seq_no}</td>";
    echo "<td><input type='text' class='form-control' value='" . htmlspecialchars($row['NAME'] ?? '') . "' placeholder='Customer Name' id='customer_name'></td>";
    echo "<td><input type='text' class='form-control' value='" . htmlspecialchars($row['CONTACT_NUMBER'] ?? '') . "' placeholder='Contact Number' id='contact_number'></td>";
    echo "<td><input type='text' class='form-control' value='" . htmlspecialchars($row['ADDRESS'] ?? '') . "' placeholder='Address' id='customer_address'></td>";
    echo "<td><input type='text' class='form-control' value='" . htmlspecialchars($row['DOCTOR_NAME'] ?? '') . "' placeholder='Doctor's Name' id='doctor_name'></td>";
    echo "<td><input type='text' class='form-control' value='" . htmlspecialchars($row['DOCTOR_ADDRESS'] ?? '') . "' placeholder='Doctor's Address' id='doctor_address'></td>";
    echo "<td>
            <button class='btn btn-success btn-sm' onclick='updateCustomer(" . (int)$row['ID'] . ");'><i class='fa fa-edit'></i></button>
            <button class='btn btn-danger btn-sm' onclick='cancel();'><i class='fa fa-close'></i></button>
          </td>";
    echo "</tr>";
}

function searchCustomer($text) {
    global $con;
    $seq_no = 0;
    $query = "SELECT * FROM customers WHERE UPPER(NAME) LIKE '%$text%' OR UPPER(DOCTOR_NAME) LIKE '%$text%'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo "Error in query: " . mysqli_error($con);
        return;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $seq_no++;
        showCustomerRow($seq_no, $row);
    }
}
?>
