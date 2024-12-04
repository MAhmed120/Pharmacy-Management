// Function to delete a customer
function deleteCustomer(id) {
    if (confirm("Are you sure you want to delete this customer?")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('customers_div').innerHTML = xhttp.responseText;
            } else if (xhttp.readyState == 4) {
                console.error("Failed to delete customer. Response:", xhttp.responseText);
            }
        };
        xhttp.open("GET", "php/manage_customer.php?action=delete&id=" + id, true);
        xhttp.send();
    }
}

// Function to edit a customer (shows edit form)
function editCustomer(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById('customers_div').innerHTML = xhttp.responseText;
        } else if (xhttp.readyState == 4) {
            console.error("Failed to edit customer. Response:", xhttp.responseText);
        }
    };
    xhttp.open("GET", "php/manage_customer.php?action=edit&id=" + id, true);
    xhttp.send();
}

// Function to update customer details
function updateCustomer(id) {
    var customer_name = document.getElementById("customer_name").value;
    var contact_number = document.getElementById("contact_number").value;
    var customer_address = document.getElementById("customer_address").value;
    var doctor_name = document.getElementById("doctor_name").value;
    var doctor_address = document.getElementById("doctor_address").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById('customers_div').innerHTML = xhttp.responseText;
        } else if (xhttp.readyState == 4) {
            console.error("Failed to update customer. Response:", xhttp.responseText);
        }
    };
    xhttp.open("GET", `php/manage_customer.php?action=update&id=${id}&name=${encodeURIComponent(customer_name)}&contact_number=${encodeURIComponent(contact_number)}&address=${encodeURIComponent(customer_address)}&doctor_name=${encodeURIComponent(doctor_name)}&doctor_address=${encodeURIComponent(doctor_address)}`, true);
    xhttp.send();
}

// Function to cancel the edit operation and show customers
function cancel() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById('customers_div').innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "php/manage_customer.php?action=cancel", true);
    xhttp.send();
}

// Function to search customers
function searchCustomer(text) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById('customers_div').innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "php/manage_customer.php?action=search&text=" + encodeURIComponent(text), true);
    xhttp.send();
}
