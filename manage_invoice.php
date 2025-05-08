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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wyay6tVCNSYqN/xs5lPmAdByFDp1fuPrpg" crossorigin="anonymous">

  <style>
    #date-time {
      font-size: 24px;
      color: #007BFF;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    /* Style for the dropdown menu items */
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

    button {
      padding: 5px;
      color: white;
      background-color: #6F6486;
    }
  </style>
</head>

<body>
  <!-- partial:index.partial.html -->
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
          <li>
            <a class="nav-link " href="logout.php">
              Logout
            </a>
            </li>
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

      <div class="search-bar">
        <input type="text" id="searchInput" class="search-input" placeholder="Search..." onkeyup="searchData()">
        <input type="text" id="searchMonth" class="search-input" placeholder="Search by Month..."
          onkeyup="searchByMonth()">
        <input type="text" id="searchDate" class="search-input" placeholder="Search by Date..."
          onkeyup="searchByDate()">
      </div>

      <?php
      // Connect to your database (replace with your actual credentials)
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "inventory_management";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $message = ""; // Initialize an empty message variable
      
      if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $idToDelete = $_GET['id'];

        $deleteSql = "DELETE FROM sell WHERE id = $idToDelete";
        if ($conn->query($deleteSql) === TRUE) {
          $message = "<h5>Record deleted successfully!</h5>";
          echo "<script>
                setTimeout(function () {
                    window.location.href = 'manage_invoice.php';
                }, 2000);
              </script>";
        } else {
          $message = "<h5>Error deleting record: </h5>" . $conn->error;
          echo "<script>
                setTimeout(function () {
                    window.location.href = 'manage_invoice.php';
                }, 2000);
              </script>";

        }
      }



      // ... (rest of your code)
      
      // Display the message
      if (!empty($message)) {
        echo "<p>$message</p>";
      }

      // Retrieve data from the database and order by date
      $sql = "SELECT * FROM sell WHERE 1=1"; // Start the query with WHERE 1=1 to simplify adding conditions later
      
      // General Search
      if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $sql .= " AND (
                invoice_no LIKE '%$search%'
                OR customer_name LIKE '%$search%'
                OR customer_contact LIKE '%$search%'
                OR payment_status LIKE '%$search%'
            )";
      }

      // Search by Month
      if (isset($_GET['searchMonth']) && !empty($_GET['searchMonth'])) {
        $searchMonth = $_GET['searchMonth'];
        $sql .= " AND MONTH(date) = $searchMonth";
      }

      // Search by Date
      if (isset($_GET['searchDate']) && !empty($_GET['searchDate'])) {
        $searchDate = $_GET['searchDate'];
        $sql .= " AND DATE(date) = '$searchDate'";
      }

      $sql .= " ORDER BY date DESC"; // Complete the SQL query
      
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
                        <th>Actions</th>
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
                        <td>
                        <button href='?action=delete&id={$row['id']}' onclick='return confirmDelete({$row['id']})'>Delete</button>
                        <a href='edit_invoice.php?invoice_no={$row['invoice_no']}'><button>Update</button></a>

                        
                    </a>
                    
                        </td>
                    </tr>";
        }

        echo "</table>";
      } else {
        echo "0 results";
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
    function confirmDelete(id) {
      var confirmDelete = confirm("Are you sure you want to delete this record?");
      if (confirmDelete) {
        window.location.href = '?action=delete&id=' + id;
      }
      return false; 
    }

    function updateData(id) {
      window.location.href = 'edit_invoice.php?id=' + id;
    }

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


    function searchByMonth() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("searchMonth");
      filter = input.value.toUpperCase();
      table = document.getElementsByTagName("table")[0];
      tr = table.getElementsByTagName("tr");

      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; 
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

    function searchByDate() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("searchDate");
      filter = input.value.toUpperCase();
      table = document.getElementsByTagName("table")[0];
      tr = table.getElementsByTagName("tr");

      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; 
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

  </script>
</body>

</html>