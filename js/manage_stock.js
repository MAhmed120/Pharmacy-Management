function deleteStock(id) {
  if (confirm("Are you sure?")) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("stock_div").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "php/manage_medicine_stock.php?action=delete&id=" + id, true);
    xhttp.send();
  }
}

function editStock(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("stock_div").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "php/manage_medicine_stock.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updateStock(id) {
  var name = document.getElementById("name").value;
  var batch_id = document.getElementById("batch_id").value;
  var expiry_date = document.getElementById("expiry_date").value;
  var quantity = document.getElementById("quantity").value;
  var mrp = document.getElementById("mrp").value;
  var rate = document.getElementById("rate").value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("stock_div").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "php/manage_medicine_stock.php?action=update&id=" + id + "&name=" + name + "&batch_id=" + batch_id + "&expiry_date=" + expiry_date + "&quantity=" + quantity + "&mrp=" + mrp + "&rate=" + rate, true);
  xhttp.send();
}

function searchStock(text, tag) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("stock_div").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "php/manage_medicine_stock.php?action=search&text=" + text + "&tag=" + tag, true);
  xhttp.send();
}

function cancelEdit() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("stock_div").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "php/manage_medicine_stock.php?action=cancel", true);
  xhttp.send();
}
