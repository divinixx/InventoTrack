<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: index.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add Items - Dashboard</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://unicons.iconscout.com/release/v3.0.6/css/line.css'>
  <link rel="stylesheet" href="./dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="add_item.css">
  <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="manifest" href="img/site.webmanifest">
  <style>
    #date-time {
      font-size: 24px;
      color: #007BFF;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      background-color: #6F6486;
      border: 1px solid #ccc;
      list-style: none;
      padding: 0;
      margin: 0;
      color: white;
    }

    .dropdown:hover .dropdown-menu {
      display: block;
      color: white;
    }


    .dropdown-menu li a {
      display: block;
      padding: 10px;
      text-decoration: none;
      color: white;
    }

    .dropdown-menu li a:hover {
      background-color: #313348;
      color: white;
    }

    .container {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      background-color: #D1D5DB;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      margin-top: 50px;
      box-sizing: border-box;
    }

    form {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    label {
      margin-bottom: 8px;
      display: block;
    }

    input,
    select,
    textarea {
      flex: 1;
      padding: 10px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    select {
      appearance: none;
    }

    button {
      flex: 1;
      background-color: #6F6486;
      color: #fff;
      padding: 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }

    button:hover {
      background-color: #313348;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid #ddd;
    }

    th,
    td {
      padding: 15px;
      text-align: left;
    }

    h2 {
      color: white;
    }

    hr {
      border: 0;
      border-top: 1px solid #ddd;
      margin: 20px 0;
    }

    .flex-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }
  </style>
</head>

<body>
  <aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1">
    <i class="uil-bars close-aside d-md-none d-lg-none" data-close="show-side-navigation1"></i>
    <div class="sidebar-header d-flex justify-content-center align-items-center px-3 py-4">
      <img class="rounded-pill img-fluid" width="65" src="img/logo.png" alt="">
      <div class="ms-2">
        <h5 class="fs-6 mb-0">
          <a class="text-decoration-none" href="#">InventoTrack</a>
        </h5>
        <p class="mt-1 mb-0">"Inventory Simplified, Sales Amplified"
        </p>
      </div>
    </div>



    <ul class="categories list-unstyled ">
      <li>
        <i class="uil-estate fa-fw"></i><a href="admin_dashboard.php"> Dashboard</a>
      </li>
      <li class="dropdown">
        <i class="uil-bill fa-fw"></i><a href="#">Invoice</a>
        <ul class="dropdown-menu">
          <li><a href="invoice_create.php" style="color:white"><i class="fa fa-plus"></i>Create Invoice</a></li>
          <li><a href="manage_invoice.php" style="color:white"><i class="fa fa-cog"></i>Manage Invoices</a></li>
        </ul>
      </li>


      <li class="dropdown">
        <i class="uil-bill fa-fw"></i><a href="#">Purchases</a>
        <ul class="dropdown-menu">
          <li><a href="expenses.php" style="color:white"><i class="fa fa-plus"></i>Expenses</a></li>
          <li><a href="report.php" style="color:white"><i class="fa fa-cog"></i>Report</a></li>
          <li><a href="graph.php" style="color:white"><i class="fa fa-bar-chart"></i>Graph</a></li>
        </ul>
      </li>
      <li>
        <i class="uil-database fa-fw"></i><a href="inventory.php"> Inventory</a>
      </li>
      <li>
        <i class="uil-book-medical fa-fw"></i><a href="add_items.php"> Add Items</a>
      </li>
      <li>
        <i class="uil-chart fa-fw"></i><a href="sales_report.php"> Sales Report</a>
      </li>
      <li>
        <i class="uil-exclamation-circle fa-fw"></i><a href="low_stock.php"> Low Stocks</a>
      </li>


    </ul>
  </aside>

  <section id="wrapper">
    <nav class="navbar navbar-expand-md">
      <div class="container-fluid mx-2">
        <div class="navbar-header">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggle-navbar"
            aria-controls="toggle-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="uil-bars text-white"></i>
          </button>
          <a class="navbar-brand" href="#">Invento<span class="main-color">Track</span></a>
        </div>
        <div class="collapse navbar-collapse" id="toggle-navbar">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link " href="logout.php">
                Logout
              </a>


          </ul>
        </div>
      </div>
    </nav>

    <div class="p-4">
      <div class="welcome">
        <div class="content rounded-3 p-3">
          <h2 class="fs-3">Welcome
            <?php echo $_SESSION['admin_name'] ?>
          </h2>
          <h4 class="mb-0">Hello
            <?php echo $_SESSION['admin_name'] ?>, welcome to your InventoTrack dashboard!
          </h4><br>


          <h3 id="date-time">Current Date and Time (IST): Loading...</h3>



        </div>
      </div>

      <div class="container" style="color:black;">
        <form action="bill.php" method="post">
          <h2 style="color:black; display:flex; margin-right:800px">Invoice System</h2>

          <div class="flex-row">
            <div style="flex: 1; margin-right: 10px;">
              <label for="payment_status">Payment Status:</label>
              <select name="payment_status">
                <option value="paid">Paid</option>
                <option value="unpaid">Unpaid</option>
              </select>
            </div>

            <div style="flex: 1; margin-right: 10px;">
              <label for="date">Date:</label>
              <input type="date" name="date" required>
            </div>

            <div style="flex: 1;">
              <?php
              $invoiceNumber = date("Ymd") . mt_rand(1000, 9999);
              echo '<label for="invoice_number">Invoice Number:</label>';
              echo '<input type="text" name="invoice_number" value="' . $invoiceNumber . '" readonly>';
              ?>
            </div>
          </div>

          <hr>

          <div class="flex-row">
            <div style="flex: 1; margin-right: 10px;">
              <label for="customer_name">Customer Name:</label>
              <input type="text" name="customer_name" required>
            </div>

            <div style="flex: 1;">
              <label for="customer_contact">Customer Contact:</label>
              <input type="text" name="customer_contact" required>
            </div>
          </div>

          <hr>


          <div class="flex-row">
            <div style="display:flex; margin-right:800px; margin-top:20px;">
              <h3>Product Information</h3>
            </div>
            <div style="flex: 1; margin-right: 10px;">
              <label for="product_dropdown">Select Product:</label>
              <select name="product_dropdown" id="product_dropdown">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "inventory_management");
                if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM product";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['product_id'] . '" data-cost="' . $row['product_price'] . '">' . $row['product_id'] . ' - ' . $row['product_name'] . '</option>';
                }

                mysqli_close($conn);
                ?>
              </select>
            </div>

            <div style="flex: 1; margin-right: 10px;">
              <label for="units">Units:</label>
              <input type="number" name="units" required>
            </div>

            <div style="flex: 1; margin-right: 10px;">
              <label for="cost">Cost:</label>
              <input type="text" name="cost" placeholder="Cost" readonly>
            </div>

            <div style="flex: 1; margin-right: 10px;">
              <label for="discount">Discount:</label>
              <input type="number" name="discount" value="0">
            </div>


          </div>
          <div style="flex: 1;">
            <label for="include_tax">Include Tax (2.5%):</label>
            <input type="checkbox" name="include_tax" checked>
          </div>
          <button type="button" onclick="addProduct()">Add Product</button>

          <table id="invoice_table">
            <tr>
              <th>Product</th>
              <th>Units</th>
              <th>Cost</th>
              <th>Discount</th>
              <th>Subtotal</th>
              <th>Action</th>
            </tr>
          </table>

          <hr>

          <div class="flex-row">
            <div style="flex: 1; margin-right: 10px;">
              <label for="total_units">Total Units:</label>
              <input type="text" name="total_units" readonly>
            </div>
            <div style="flex: 1; margin-right: 10px;">
              <label for="total">Total:</label>
              <input type="text" name="total" readonly>
            </div>

            <div style="flex: 1; margin-right: 10px;">
              <label for="discount_amount">Discounts:</label>
              <input type="text" name="discount_amount" readonly>
            </div>

            <div style="flex: 1; margin-right: 10px;">
              <label for="tax">Tax:</label>
              <input type="text" name="tax" readonly>
            </div>

            <div style="flex: 1;">
              <label for="total_amount">Total Amount:</label>
              <input type="text" name="total_amount" readonly>
            </div>
          </div>
          <div>

            <label for="note">Note:</label>
            <textarea name="note" style="margin-right:800px"></textarea>

            <button type="submit" style="float:right;">Create Bill</button>
          </div>
        </form>

        <script>
          document.getElementById("product_dropdown").addEventListener("change", function () {
            var selectedOption = this.options[this.selectedIndex];
            var costInput = document.getElementsByName("cost")[0];

            costInput.value = parseFloat(selectedOption.getAttribute('data-cost')).toFixed(2);
          });

          function addProduct() {
            var productDropdown = document.getElementById("product_dropdown");
            var selectedOption = productDropdown.options[productDropdown.selectedIndex];

            var selectedProduct = selectedOption.text;
            var productId = selectedOption.value;
            var units = parseFloat(document.getElementsByName("units")[0].value);
            var cost = parseFloat(selectedOption.getAttribute('data-cost'));
            var discount = parseFloat(document.getElementsByName("discount")[0].value);

            document.getElementsByName("cost")[0].value = cost.toFixed(2);

            var table = document.getElementById("invoice_table");
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);

            cell1.innerHTML = selectedProduct;
            cell2.innerHTML = units;
            cell3.innerHTML = cost.toFixed(2);
            cell4.innerHTML = discount.toFixed(2);

            var subtotal = (units * cost) - discount;
            cell5.innerHTML = subtotal.toFixed(2);

            var deleteButton = document.createElement("button");
            deleteButton.innerHTML = "Delete";
            deleteButton.onclick = function () {
              deleteRow(row);
            };
            cell6.appendChild(deleteButton);

            updateTotals();
          }

          function deleteRow(row) {
            var table = document.getElementById("invoice_table");
            var rowIndex = row.rowIndex;

            table.deleteRow(rowIndex);

            updateTotals();
          }


          function updateTotals() {
            var table = document.getElementById("invoice_table");
            var rows = table.getElementsByTagName("tr");

            var total = 0;
            var discountTotal = 0;
            var totalUnits = 0;

            for (var i = 1; i < rows.length; i++) {
              var cells = rows[i].getElementsByTagName("td");

              var units = parseFloat(cells[1].innerHTML);
              var subtotal = parseFloat(cells[4].innerHTML);
              var discount = parseFloat(cells[3].innerHTML);

              totalUnits += units;
              total += subtotal;
              discountTotal += discount;

            }

            document.getElementsByName("total_units")[0].value = totalUnits.toFixed(2);
            document.getElementsByName("total")[0].value = total.toFixed(2);
            document.getElementsByName("discount_amount")[0].value = discountTotal.toFixed(2);

            var includeTax = document.getElementsByName("include_tax")[0].checked;
            var taxRate = 0.025; 

            if (includeTax) {
              var tax = total * taxRate;
              document.getElementsByName("tax")[0].value = tax.toFixed(2);
              total += tax;
            } else {
              document.getElementsByName("tax")[0].value = "0.00";
            }

            var totalAmount = total - discountTotal;
            document.getElementsByName("total_amount")[0].value = totalAmount.toFixed(2);
          }

        </script>
      </div>





    </div>
  </section>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js'></script>
  <script
    src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.jshttps://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
  <script src="./dashboard.js"></script>
  <script>
    function updateDateTime() {
      var dateTimeElement = document.getElementById('date-time');

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          dateTimeElement.innerHTML = xhr.responseText;
        }
      };
      xhr.open('GET', 'get_datetime.php', true);
      xhr.send();
    }

    setInterval(updateDateTime, 1000);
  </script>
</body>

</html>