<?php
require "db_connection.php";

if($con) {
    if(isset($_GET['action'])) {
        switch ($_GET['action']) {
            case "supplier":
                showSuggestions($con, "suppliers", "supplier");
                break;
            case "customer":
                showSuggestions($con, "customers", "customer");
                break;
            case "medicine":
                showSuggestions($con, "medicines", "medicine");
                break;
            case "customers_address":
                getValue($con, $_GET['action'], "ADDRESS");
                break;
            case "customers_contact_number":
                getValue($con, $_GET['action'], "CONTACT_NUMBER");
                break;
        }
    }
}

function showSuggestions($con, $table, $action) {
    // Check if 'text' is provided in the request
    if (isset($_GET["text"])) {
        $text = strtoupper($_GET["text"]);
        $query = "SELECT * FROM $table WHERE UPPER(NAME) LIKE '%$text%'";
        $result = mysqli_query($con, $query);

        // Check if any rows are returned
        if(mysqli_num_rows($result) == 0) {
            echo '<div class="list-group-item list-group-item-action font-italic" style="padding: 5px;" disabled>No suggestions...</div>';
        } else {
            // Loop through the results and output suggestions
            while($row = mysqli_fetch_array($result)) {
                // Check if 'NAME' key exists
                if (isset($row['NAME'])) {
                    echo '<input type="button" class="list-group-item list-group-item-action" value="'.$row['NAME'].'" style="padding: 5px; outline: none;" onclick="suggestionClick(this.value, \''.$action.'\');">';
                }
            }
        }
    }
}

function getValue($con, $action, $column) {
    // Check if 'name' is provided in the request
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        $query = "SELECT * FROM customers WHERE NAME = '$name'";
        $result = mysqli_query($con, $query);
        // Ensure there are results before trying to access them
        if ($row = mysqli_fetch_array($result)) {
            // Check if the requested column exists
            if (isset($row[$column])) {
                echo $row[$column];
            }
        }
    }
}
?>
