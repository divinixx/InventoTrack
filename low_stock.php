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
  </style>
  <style>
    .product-container {

      display: flex;
      flex-wrap: wrap;
    }

    .product-card {
      background-color: #6F6486;
      color: white;
      display: flex;
      margin: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 100%;
    }

    .product-card img {
      width: 150px;
      height: 150px;
      margin-right: 20px;
    }

    .product-details-left {
      flex: 1;
    }

    .product-details-right {
      flex: 1;
      margin-left: 40px;
    }

    h5 {
      padding: 5px;
    }

    .confirmation-dialog {
      color: white;
      font-size: 20px;
    }

    h5 {
      color: white;
    }

    .edit-button {
      background-color: #4CAF50;
      /* Green */
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 25px;
      cursor: pointer;
    }

    .delete-button {
      background-color: #f44336;
      /* Red */
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 25px;
      cursor: pointer;
    }

    .dropdown {
      position: relative;

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


      <h1 style="color:white; margin-top:20px">Low Stock</h1>
      <div class="product-container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "inventory_management";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['delete1'])) {
          $product_id = $_POST['product_id'];

          echo '
        <div class="confirmation-dialog">
            <p>Are you sure you want to delete this product ( ID =' . $product_id . ' )? </p>
            <form method="post" style="colour:white;">
                <input type="hidden" name="confirmed_delete" value="' . $product_id . '">
                <button type="submit" name="delete_confirmed" style="  padding: 0px 10px; border-radius:5px; font-size:20px">Yes, Delete</button>
                <button type="submit" name="cancel_delete" style="  padding: 0px 10px; border-radius:5px; font-size:20px">No, Cancel</button>
            </form>
        </div>
    ';
        }

        if (isset($_POST['delete_confirmed'])) {
          $product_id = $_POST['confirmed_delete'];

          $delete_sql = "DELETE FROM product WHERE product_id = '$product_id'";
          if ($conn->query($delete_sql) === TRUE) {
            echo "<h5>Product with ID $product_id has been deleted.</h5>
        <script>
                setTimeout(function () {
                    window.location.href = 'low_stock.php';
                }, 3000);
            </script>";
          } else {
            echo "Error deleting product: " . $conn->error;
          }
        } elseif (isset($_POST['cancel_delete'])) {
          echo "<h5>Deletion has been canceled.</h5>
    <script>
                setTimeout(function () {
                    window.location.href = 'low_stock.php';
                }, 3000);
            </script>";
        }

        $searchTerm = ""; 

        if (isset($_POST['search'])) {
          $searchTerm = $_POST['search'];
        }

        $sql = "SELECT * FROM product WHERE product_quantity > 0 && product_quantity<=6 AND (product_name LIKE '%$searchTerm%' OR product_description LIKE '%$searchTerm%' OR product_id LIKE '%$searchTerm%' OR product_price LIKE '%$searchTerm%' OR date LIKE '%$searchTerm%' OR dealer_name LIKE '%$searchTerm%' OR product_quantity LIKE '%$searchTerm%')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<div class="product-card" style="background-color: #f5c30f;">';
            echo '<img src="' . $row['product_img'] . '" alt="' . $row['product_name'] . '" width="150" height="150">';
            echo '<div class="product-details-left">';
            echo '<h4>Product ID: ' . $row['product_id'] . '</h4>';
            echo '<h2> ' . $row['product_name'] . '</h2>';
            echo '<h6> ' . $row['product_description'] . '</h6>';
            echo '</div>';
            echo '<div class="product-details-right">';
            echo '<h5>Product Price: ₹' . $row['product_price'] . '</h5>';
            echo '<h5>Product Quantity: ' . $row['product_quantity'] . '</h5>';
            echo '<h5>Updated At: ' . date("d-m-Y", strtotime($row['date'])) . '</h5>';

            echo '<form method="post">';
            echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
            echo '<button type="submit" name="delete1" style="background:red; color:white; padding: 0px 10px; border-radius:5px; font-size:15px">Delete</button>';
            echo '<a href="edit_item.php?product_id=' . $row['product_id'] . '" class="edit-button" style="margin-left:10px; text-decoration:none;">Edit</a>';
            echo '</form>';

            echo '</div>';
            echo '</div>';
          }
        } else {
          echo '"<h4 style="color:white;">No products found.</h4>"';
        }

        $conn->close();
        ?>





      </div>

      <h1 style="color:white; margin-top:80px">Out Of Stock </h1>
      <div class="product-container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "inventory_management";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['delete2'])) {
          $product_id = $_POST['product_id'];

          echo '
        <div class="confirmation-dialog">
            <p>Are you sure you want to delete this product ( ID =' . $product_id . ' )? </p>
            <form method="post" style="colour:white;">
                <input type="hidden" name="confirmed_delete" value="' . $product_id . '">
                <button type="submit" name="delete_confirmed" style="  padding: 0px 10px; border-radius:5px; font-size:20px">Yes, Delete</button>
                <button type="submit" name="cancel_delete" style="  padding: 0px 10px; border-radius:5px; font-size:20px">No, Cancel</button>
            </form>
        </div>
    ';
        }

        if (isset($_POST['delete_confirmed'])) {
          $product_id = $_POST['confirmed_delete'];

          $delete_sql = "DELETE FROM product WHERE product_id = '$product_id'";
          if ($conn->query($delete_sql) === TRUE) {
            echo "<h5>Product with ID $product_id has been deleted.</h5>
        <script>
                setTimeout(function () {
                    window.location.href = 'low_stock.php';
                }, 3000);
            </script>";
          } else {
            echo "Error deleting product: " . $conn->error;
          }
        } elseif (isset($_POST['cancel_delete'])) {
          echo "<h5>Deletion has been canceled.</h5>
    <script>
                setTimeout(function () {
                    window.location.href = 'low_stock.php';
                }, 3000);
            </script>";
        }

        $searchTerm = ""; 
        
        if (isset($_POST['search'])) {
          $searchTerm = $_POST['search'];
        }

        $sql = "SELECT * FROM product WHERE product_quantity = 0 && product_quantity<=6 AND (product_name LIKE '%$searchTerm%' OR product_description LIKE '%$searchTerm%' OR product_id LIKE '%$searchTerm%' OR product_price LIKE '%$searchTerm%' OR date LIKE '%$searchTerm%' OR dealer_name LIKE '%$searchTerm%' OR product_quantity LIKE '%$searchTerm%')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<div class="product-card" style="background-color: #e82e41;">';
            echo '<img src="' . $row['product_img'] . '" alt="' . $row['product_name'] . '" width="150" height="150">';
            echo '<div class="product-details-left">';
            echo '<h4>Product ID: ' . $row['product_id'] . '</h4>';
            echo '<h2> ' . $row['product_name'] . '</h2>';
            echo '<h6> ' . $row['product_description'] . '</h6>';
            echo '</div>';
            echo '<div class="product-details-right">';
            echo '<h5>Product Price: ₹' . $row['product_price'] . '</h5>';
            echo '<h5>Product Quantity: ' . $row['product_quantity'] . '</h5>';
            echo '<h5>Updated At: ' . date("d-m-Y", strtotime($row['date'])) . '</h5>';

            echo '<form method="post">';
            echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
            echo '<button type="submit" name="delete2" style="background:red; color:white; padding: 0px 10px; border-radius:5px; font-size:15px">Delete</button>';
            echo '<a href="edit_item.php?product_id=' . $row['product_id'] . '" class="edit-button" style="margin-left:10px; text-decoration:none;">Edit</a>';
            echo '</form>';

            echo '</div>';
            echo '</div>';
          }
        } else {
          echo '"<h4 style="color:white;">No products found.</h4>"';
        }

        $conn->close();
        ?>





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