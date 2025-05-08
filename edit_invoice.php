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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #252636;
            margin: 0;
            padding: 0;
        }

        .update-page {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .exit-button {
            background: #d9534f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .exit-button:hover {
            background: #c9302c;
        }

        .form-group {
            margin: 10px 0;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 16px;
        }

        .update-button {
            background: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .update-button:hover {
            background: #0056b3;
        }
        h5{
            
            margin: 20px;
            color:white;

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
                    <li><a href="invoice_create.php" style="color:white"><i class="fa fa-plus"></i>Create Invoice</a>
                    </li>
                    <li><a href="manage_invoice.php" style="color:white"><i class="fa fa-cog"></i>Manage Invoices</a>
                    </li>
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
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#toggle-navbar" aria-controls="toggle-navbar" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="uil-bars text-white"></i>
                    </button>
                    <a class="navbar-brand" href="#">Invento<span class="main-color">Track</span></a>
                </div>
                <div class="collapse navbar-collapse" id="toggle-navbar">
                    <ul class="navbar-nav ms-auto">
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
            <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_management";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$invoice_id = $_GET['invoice_no'];
$sql = "SELECT * FROM sell WHERE invoice_no = '$invoice_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $date = $row['date'];
    $invoice_no = $row['invoice_no'];
    $customer_name = $row['customer_name'];
    $customer_contact = $row['customer_contact'];
    $payment_status = $row['payment_status'];
    $total_units = $row['total_units'];
    $total = $row['total'];
    $discount = $row['discount'];
    $tax = $row['tax'];
    $total_amount = $row['total_amount'];
    $note = $row['note'];
} else {
    echo "Invoice not found.";
    exit();
}

if (isset($_POST['update_invoice'])) {
    $new_customer_name = $_POST['customer_name'];
    $new_customer_contact = $_POST['customer_contact'];
    $new_payment_status = $_POST['payment_status'];
    $new_total_units = $_POST['total_units'];
    $new_total = $_POST['total'];
    $new_discount = $_POST['discount'];
    $new_tax = $_POST['tax'];
    $new_total_amount = $_POST['total_amount'];
    $new_note = $_POST['note'];

    $update_sql = "UPDATE sell SET
                    customer_name = '$new_customer_name',
                    customer_contact = '$new_customer_contact',
                    payment_status = '$new_payment_status',
                    total_units = '$new_total_units',
                    total = '$new_total',
                    discount = '$new_discount',
                    tax = '$new_tax',
                    total_amount = '$new_total_amount',
                    note = '$new_note'
                    WHERE invoice_no = '$invoice_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<h5 >Invoice with ID $invoice_id has been updated.</h5>";
        echo "<script>
            setTimeout(function () {
                window.location.href = 'manage_invoice.php';
            }, 2000);
        </script>";
    } else {
        echo "Error updating invoice: " . $conn->error;
    }
}
?>

<!-- HTML Form for Updating Invoices -->
<div class="update-page">
    <h2>Edit Invoice</h2>
    <h3>Invoice ID: <?php echo $invoice_id ?></h3>
    <form method="post" action="">
        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
        </div>
        <div class="form-group">
            <label for="customer_contact">Customer Contact</label>
            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
        </div>
        <div class="form-group">
            <label for="payment_status">Payment Status</label>
            <select name="payment_status" style="padding:5px 2px;">
                <option value="paid" <?php echo ($payment_status == 'paid') ? 'selected' : ''; ?> >Paid</option>
                <option value="unpaid" <?php echo ($payment_status == 'unpaid') ? 'selected' : ''; ?>>Unpaid</option>
            </select>
        </div>
        <div class="form-group">
            <label for="total_units">Total Units</label>
            <input type="number" name="total_units" value="<?php echo $total_units; ?>">
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" name="total" value="<?php echo $total; ?>">
        </div>
        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="number" name="discount" value="<?php echo $discount; ?>">
        </div>
        <div class="form-group">
            <label for="tax">Tax</label>
            <input type="number" name="tax" value="<?php echo $tax; ?>">
        </div>
        <div class="form-group">
            <label for="total_amount">Total Amount</label>
            <input type="number" name="total_amount" value="<?php echo $total_amount; ?>">
        </div>
        <div class="form-group">
            <label for="note">Note</label>
            <textarea name="note"><?php echo $note; ?></textarea>
        </div>
        <button type="submit" name="update_invoice" class="update-button">Update Invoice</button>
    </form>
</div>

<?php
$conn->close();
?>

            






        </div>
    </section>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js'></script>
    <script
        src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.jshttps://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
    <script src="./dashboard.js"></script>
    <script>
        function updateDateTime() {
            // Get an element to display the date and time
            var dateTimeElement = document.getElementById('date-time');

            // Send an AJAX request to a PHP script to get the current date and time
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the content of the element with the response from PHP
                    dateTimeElement.innerHTML = xhr.responseText;
                }
            };
            xhr.open('GET', 'get_datetime.php', true);
            xhr.send();
        }

        // Update the date and time every second
        setInterval(updateDateTime, 1000);
    </script>
</body>

</html>