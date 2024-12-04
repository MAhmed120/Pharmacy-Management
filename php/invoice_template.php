<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Template</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        .invoice-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            margin: 0;
        }
        .invoice-details, .customer-details, .medicine-details {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <div class="invoice-header">
        <h1>Invoice</h1>
        <p><strong>Invoice Number:</strong> <?php echo $invoice_number; ?></p>
        <p><strong>Date:</strong> <?php echo $invoice_date; ?></p>
    </div>

    <div class="customer-details">
        <h4>Customer Details</h4>
        <p><strong>Name:</strong> <?php echo $customer_name; ?></p>
        <p><strong>Address:</strong> <?php echo $address; ?></p>
        <p><strong>Contact Number:</strong> <?php echo $contact_number; ?></p>
        <p><strong>Doctor's Name:</strong> <?php echo $doctor_name; ?></p>
        <p><strong>Doctor's Address:</strong> <?php echo $doctor_address; ?></p>
    </div>

    <div class="medicine-details">
        <h4>Medicine Details</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Medicine Name</th>
                    <th>Expiry Date</th>
                    <th>Quantity</th>
                    <th>MRP</th>
                    <th>Discount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetching medicine details from sales table
                $seq_no = 1;
                $query = "SELECT * FROM sales WHERE INVOICE_NUMBER = $invoice_number";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $seq_no++ . "</td>";
                    echo "<td>" . $row['MEDICINE_NAME'] . "</td>";
                    echo "<td>" . $row['EXPIRY_DATE'] . "</td>";
                    echo "<td>" . $row['QUANTITY'] . "</td>";
                    echo "<td>" . $row['MRP'] . "</td>";
                    echo "<td>" . $row['DISCOUNT'] . "%</td>";
                    echo "<td>" . $row['TOTAL'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="invoice-summary">
        <h4>Summary</h4>
        <p><strong>Total Amount:</strong> <?php echo $total_amount; ?></p>
        <p><strong>Total Discount:</strong> <?php echo $total_discount; ?></p>
        <p><strong>Net Total:</strong> <?php echo $net_total; ?></p>
    </div>
</div>

</body>
</html>
