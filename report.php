<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: index.php");
}


?>
<?php
$servername = "localhost"; 
$username = "root";     
$password = "";     
$dbname = "inventory_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM purchase ORDER BY date DESC";
$result = $conn->query($sql);

$search = isset($_GET['search']) ? $_GET['search'] : '';
$searchCriteria = isset($_GET['search_criteria']) ? $_GET['search_criteria'] : 'dealer_name';

if (!empty($search)) {
  $sql = "SELECT * FROM purchase 
            WHERE $searchCriteria LIKE '%$search%'
            ORDER BY date DESC";
  $result = $conn->query($sql);
} else {
  $sql = "SELECT * FROM purchase ORDER BY date DESC";
  $result = $conn->query($sql);
}
$conn->close();
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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
  </style>
  <style>


    h1 {
      color: #343a40;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #dee2e6;
    }

    th {
      background-color: #343a40;
      color: white;
    }

    tr:hover {
      background-color: #f5f5f5;
    }

    .delete-btn {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 8px 16px;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      margin-top: 5px;
      cursor: pointer;
      border-radius: 4px;
      transition: background-color 0.3s;
    }

    .delete-btn:hover {
      background-color: #c82333;
    }

    .search-form {
      margin-bottom: 20px;
    }

    .search-criteria,
    .search-input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-right: 10px;
    }

    .search-btn {
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .search-btn:hover {
      background-color: #0056b3;
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

      <h1 style="color:white;">Expenses</h1>

      <form class="search-form" action="" method="get">
        <select name="search_criteria" class="search-criteria">
          <option value="dealer_name">Dealer Name</option>
          <option value="dealer_address">Dealer Address</option>
          <option value="reason">Reason</option>
          <option value="date">Date</option>
          <option value="amount">Amount</option>
        </select>
        <input type="text" name="search" class="search-input" placeholder="Search...">
        <input type="submit" class="search-btn" value="Search">
      </form>

      <table>
        <tr>
          <th>Dealer Name</th>
          <th>Dealer Address</th>
          <th>Reason</th>
          <th>Date</th>
          <th>Amount</th>
          <th>Bill PDF</th>
          <th>Action</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['dealer_name'] . "</td>";
          echo "<td>" . $row['dealer_address'] . "</td>";
          echo "<td>" . $row['reason'] . "</td>";
          echo "<td>" . $row['date'] . "</td>";
          echo "<td>" . $row['amount'] . "</td>";
          echo "<td><a href='" . $row['bill_pdf'] . "' target='_blank'>View Bill</a></td>";
          echo "<td><button class='delete-btn' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button></td>";
          echo "</tr>";
        }
        ?>
      </table>

      <script>
        function confirmDelete(itemId) {
          var confirmDelete = confirm("Are you sure you want to delete this item?");
          if (confirmDelete) {
            window.location.href = 'delete.php?id=' + itemId;
          }
        }
      </script>

      <script>
        $(document).ready(function () {
          $('#search-input').on('input', function () {
            var searchCriteria = $('.search-criteria').val();
            var searchValue = $(this).val();

            $.ajax({
              type: 'GET',
              url: 'report.php', 
              data: {
                search_criteria: searchCriteria,
                search: searchValue
              },
              success: function (response) {
                $('#search-results').html(response);
              },
              error: function (xhr, status, error) {
                console.error(xhr.responseText);
              }
            });
          });

          function openModal(pdfUrl) {
            console.log("Opening modal with PDF: " + pdfUrl);

            $('#pdf-iframe').attr('src', pdfUrl);

            $('#bill-modal').css('display', 'block');
          }

          function closeModal() {
            console.log("Closing modal");

            $('#pdf-iframe').attr('src', '');

            $('#bill-modal').css('display', 'none');
          }
        });
      </script>





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