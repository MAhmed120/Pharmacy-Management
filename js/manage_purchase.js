function deletePurchase(id) {
  if (confirm("Are you sure you want to delete this purchase?")) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
          if (xhttp.readyState == 4 && xhttp.status == 200) {
              document.getElementById('purchase_acknowledgement').innerHTML = xhttp.responseText;
          }
      };
      xhttp.open("GET", "php/manage_purchase.php?action=delete&id=" + id, true);
      xhttp.send();
  }
}

function editPurchase(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
          document.getElementById('purchases_div').innerHTML = xhttp.responseText;
      }
  };
  xhttp.open("GET", "php/manage_purchase.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updatePurchase(id) {
  var suppliers_name = document.getElementById("suppliers_name").value;
  var invoice_date = document.getElementById("invoice_date").value;
  var grand_total = document.getElementById("grand_total").value;
  var payment_status = document.getElementById("payment_type").value;

  if (invoice_date == "") {
      alert("Please enter a valid date.");
      return;
  }

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
          document.getElementById('purchases_div').innerHTML = xhttp.responseText;
      }
  };
  xhttp.open("GET", "php/manage_purchase.php?action=update&id=" + id + "&suppliers_name=" + suppliers_name + "&invoice_date=" + invoice_date + "&grand_total=" + grand_total + "&payment_status=" + payment_status, true);
  xhttp.send();
}

function searchPurchase(text, tag) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
          document.getElementById('purchases_div').innerHTML = xhttp.responseText;
      }
  };
  xhttp.open("GET", "php/manage_purchase.php?action=search&text=" + text + "&tag=" + tag, true);
  xhttp.send();
}
