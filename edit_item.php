<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_management";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch product details from the database based on the product_id
    $sql = "SELECT * FROM product WHERE product_id = '$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Retrieve product details
        $product_name = $row['product_name'];
        $product_description = $row['product_description'];
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        // ...
    }
}

date_default_timezone_set('Asia/Kolkata');
$new_date = date('Y-m-d H:i:s'); // Updated date and time format

if (isset($_POST['update_product'])) {
    // Handle the form submission to update the product details
    $product_id = $_POST['product_id'];
    $new_product_name = $_POST['product_name'];
    $new_product_description = $_POST['product_description'];
    $new_product_price = $_POST['product_price'];
    $new_product_quantity = $_POST['product_quantity'];

    // Perform the actual product update in the database
    $update_sql = "UPDATE product SET
                    product_name = '$new_product_name',
                    product_description = '$new_product_description',
                    product_price = '$new_product_price',
                    product_quantity = '$new_product_quantity',
                    date = '$new_date',
                    WHERE product_id = '$product_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<h5>Product with ID $product_id has been updated.</h5>";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>


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
    </style>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #252636;
            margin: 0;
            padding: 0;
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

            <div class="update-page">
                <h2>Edit Product</h2>
                <h3>Product ID :
                    <?php echo $product_id ?>
                </h3>
                <form method="post" action="update_successful.php">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" value="<?php echo $product_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="product_description">Product Description</label>
                        <textarea name="product_description"><?php echo $product_description; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        <input type="number" name="product_price" value="<?php echo $product_price; ?>">
                    </div>
                    <div class="form-group">
                        <label for="product_quantity">Product Quantity</label>
                        <input type="number" name="product_quantity" value="<?php echo $product_quantity; ?>">
                    </div>
\                    <button type="submit" name="update_product" class="update-button">Update Product</button>
                </form>
            </div>

            <?php
            if (isset($_POST['update_product'])) {
                $product_id = $_POST['product_id'];
                $new_product_name = $_POST['product_name'];

                $update_sql = "UPDATE product SET product_name = '$new_product_name' WHERE product_id = '$product_id'";

                if ($conn->query($update_sql) === TRUE) {
                    echo "<div class='success-message'>Product has been updated successfully.</div>";
                    echo "<script>
                setTimeout(function () {
                    window.location.href = 'inventory.php';
                }, 2000);
            </script>";
                } else {
                    echo "Error updating product: " . $conn->error;
                }
            }
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
</body>

</html>