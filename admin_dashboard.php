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
  <title>InventoTrack - Dashboard</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://unicons.iconscout.com/release/v3.0.6/css/line.css'>
  <link rel="stylesheet" href="./dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    td {
      color: white;
    }

    th {
      background-color: #f2f2f2;
    }

    .search-bar {
      margin: 20px 0;
    }

    .search-input {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .search-button {
      padding: 8px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .green-text {
      color: green;
    }

    .red-text {
      color: red;
    }

    h5 {
      color: white;
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
              <a class="nav-link " href="logout.php" style="color:white;">
                Logout
              </a>


          </ul>
        </div>
      </div>
    </nav>

    <div class="p-4">
      <div class="welcome">
        <div class="content rounded-3 p-3">
          <h1 class="fs-3">Welcome
            <?php echo $_SESSION['admin_name'] ?>
          </h1>
          <h4 class="mb-0">Hello
            <?php echo $_SESSION['admin_name'] ?>, welcome to your InventoTrack dashboard!
          </h4><br>


          <h3 id="date-time">Current Date and Time (IST): Loading...</h3>



        </div>
      </div>
      <?php
      $conn = new mysqli("localhost", "root", "", "inventory_management");

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $currentDate = date("Y-m-d");


      $customerQuery = "SELECT COUNT(*) AS totalCustomers FROM sell WHERE date = '$currentDate'";
      $customerResult = $conn->query($customerQuery);
      $totalCustomers = ($customerResult->num_rows > 0) ? $customerResult->fetch_assoc()['totalCustomers'] : 0;


      $salesQuery = "SELECT SUM(total_amount) AS totalSales FROM sell WHERE date = '$currentDate'";
      $salesResult = $conn->query($salesQuery);
      $totalSales = ($salesResult->num_rows > 0) ? $salesResult->fetch_assoc()['totalSales'] : 0;


      $productQuery = "SELECT SUM(total_units) AS totalUnits FROM sell WHERE date = '$currentDate'";
      $productResult = $conn->query($productQuery);
      $totalUnits = ($productResult->num_rows > 0) ? $productResult->fetch_assoc()['totalUnits'] : 0;


      $productQuery = "SELECT COUNT(*) AS lowStock FROM product WHERE product_quantity > 0 AND product_quantity <= 6";
      $lowStockResult = $conn->query($productQuery);
      $totallowStock = ($lowStockResult->num_rows > 0) ? $lowStockResult->fetch_assoc()['lowStock'] : 0;



      $productQuery = "SELECT COUNT(*) AS outOfStock FROM product WHERE product_quantity = 0";
      $outOfStockResult = $conn->query($productQuery);
      $totaloutOfStock = ($outOfStockResult->num_rows > 0) ? $outOfStockResult->fetch_assoc()['outOfStock'] : 0;



      $currentMonth = date("Y-m"); 
      $purchaseQuery = "SELECT SUM(amount) AS totalExpense FROM purchase WHERE  date = '$currentDate'";
      $purchaseResult = $conn->query($purchaseQuery);
      $totalPurchase = ($purchaseResult->num_rows > 0) ? $purchaseResult->fetch_assoc()['totalExpense'] : 0;


      $conn->close();
      ?>

      <section class="statistics mt-4">
        <div class="row">
          <div class="col-lg-4">
            <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
              <i class="uil-users-alt fs-2 text-center bg-primary rounded-circle"></i>
              <div class="ms-3">
                <div class="d-flex align-items-center">
                  <h3 class="mb-0">
                    <?php echo $totalCustomers; ?>
                  </h3><span class="d-block ms-2" style="font-size:20px"> Customers</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
              <i class="uil-bill fs-2 text-center bg-success rounded-circle"></i>
              <div class="ms-3">
                <div class="d-flex align-items-center">
                  <h3 class="mb-0">
                    <?php echo $totalSales; ?>
                  </h3>
                  <span class="d-block ms-2" style="font-size:20px">Sales</span>
                </div>

              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box d-flex rounded-2 align-items-center p-3">
              <i class="uil-shopping-cart fs-2 text-center  rounded-circle" style="background-color: #6610f2"></i>
              <div class="ms-3">
                <div class="d-flex align-items-center">
                  <h3 class="mb-0">
                    <?php echo $totalUnits; ?>
                  </h3> <span class="d-block ms-2" style="font-size:20px">Products </span>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="statistics mt-4">
        <div class="row">
          <div class="col-lg-4">
            <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
              <i class="uil-exclamation-circle fs-2 text-center bg-warning rounded-circle"></i>
              <div class="ms-3">
                <div class="d-flex align-items-center">
                  <h3>
                    <?php echo $totallowStock; ?>
                  </h3>
                  <span class="d-block ms-2" style="font-size:20px">Low Stocks</span>
                </div>

              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
              <i class="uil-exclamation-circle fs-2 text-center bg-danger rounded-circle"></i>
              <div class="ms-3">
                <div class="d-flex align-items-center">
                  <h3>
                    <?php echo $totaloutOfStock; ?>
                  </h3>
                  <span class="d-block ms-2" style="font-size:20px">Out Of Stocks</span>
                </div>

              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box d-flex rounded-2 align-items-center p-3">
              <i class="uil-dollar-alt fs-2 text-center  rounded-circle" style="background-color: #fd7e14"></i>
              <div class="ms-3">
                <div class="d-flex align-items-center">
                  <h3>
                    <?php echo $totalPurchase; ?>
                  </h3> <span class="d-block ms-2" style="font-size:20px">Expenses</span>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>

      <h2 style="color:white; margin-top:25px; text-align: center;">Today Sales</h2>
      <div class="search-bar">
        <input type="text" id="searchInput" class="search-input" placeholder="Search..." onkeyup="searchData()">

      </div>

      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "inventory_management";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $currentDate = date("Y-m-d");
      $sql = "SELECT * FROM sell WHERE 1=1 AND date = '$currentDate'"; 
      
      
      if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $sql .= " AND (
                invoice_no LIKE '%$search%'
                OR customer_name LIKE '%$search%'
                OR customer_contact LIKE '%$search%'
                OR payment_status LIKE '%$search%'
            )";
      }

      $sql .= " ORDER BY date DESC";
      
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<table>
                    <tr>
                        <th>Date</th>
                        <th>Invoice No.</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Payment Status</th>
                        <th>Total Units</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Total Amount</th>
                        <th>Note</th>
                    </tr>";

        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                        <td>{$row['date']}</td>
                        <td>{$row['invoice_no']}</td>
                        <td>{$row['customer_name']}</td>
                        <td>{$row['customer_contact']}</td>
                        <td class='" . ($row['payment_status'] == 'paid' ? 'green-text' : 'red-text') . "'>{$row['payment_status']}</td>
                        <td>{$row['total_units']}</td>
                        <td>{$row['total']}</td>
                        <td>{$row['discount']}</td>
                        <td>{$row['tax']}</td>
                        <td>{$row['total_amount']}</td>
                        <td>{$row['note']}</td>
                        
                    </tr>";
        }

        echo "</table>";
      } else {
        echo "<h5>0 results<h5>";
      }

      $conn->close();
      ?>




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
  <script>


    function searchData() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      table = document.getElementsByTagName("table")[0];
      tr = table.getElementsByTagName("tr");

      for (i = 0; i < tr.length; i++) {
        if (i === 0) {
          continue;
        }

        var found = false;
        for (var j = 1; j <= 4; j++) { 
          td = tr[i].getElementsByTagName("td")[j];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              found = true;
              break;
            }
          }
        }

        if (found) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }







  </script>
</body>

</html>