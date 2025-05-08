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
        h1 {
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .product-details {
            display: none;
        }

        .bill {
            margin-top: 20px;
        }
    </style>
    <script>
        function showProductDetails() {
            var productID = document.getElementById("product_id").value;
            var productDetails = document.querySelector('.product-details');

            if (productID !== "") {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        if (data.product_name) {
                            productDetails.style.display = 'block';
                            document.getElementById("product_name").innerText = data.product_name;
                            document.getElementById("product_price").innerText = '$' + data.product_price;
                        } else {
                            productDetails.style.display = 'none';
                            alert("Product not found");
                        }
                    }
                };
                xhr.open("GET", "get_product_details.php?product_id=" + productID, true);
                xhr.send();
            } else {
                productDetails.style.display = 'none';
            }
        }
    </script>
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

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "inventory_management";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['submit'])) {
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];

                $customer_id = sprintf("%08d", mt_rand(1, 99999999));

                $total_product = 0;
                $total_cost = 0;

                $selected_products = [];

                if (isset($_POST['product'])) {
                    foreach ($_POST['product'] as $product_id => $quantity) {
                        $sql = "SELECT product_name, product_price FROM product WHERE product_id = $product_id";
                        $result = $conn->query($sql);
                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            $product_name = $row['product_name'];

                            $product_price = floatval($row['product_price']);

                            $quantity = intval($quantity);

                            $product_cost = $product_price * $quantity;

                            $total_product += $quantity;
                            $total_cost += $product_cost;

                            $selected_products[] = [
                                'name' => $product_name,
                                'quantity' => $quantity,
                                'price' => $product_price,
                                'cost' => $product_cost,
                            ];
                        }
                    }
                }

                $insert_sql = "INSERT INTO customer (customer_id, customer_name, customer_contact, total_product, total_cost)
                       VALUES ('$customer_id', '$customer_name', '$customer_contact', $total_product, $total_cost)";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "Invoice created successfully. Customer ID: $customer_id";
                } else {
                    echo "Error creating invoice: " . $conn->error;
                }

                if (!empty($selected_products)) {
                    echo '<div class="product-cart">';
                    echo '<h2>Selected Products</h2>';
                    echo '<table>';
                    echo '<tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Cost</th></tr>';
                    foreach ($selected_products as $product) {
                        echo '<tr>';
                        echo '<td>' . $product['name'] . '</td>';
                        echo '<td>$' . number_format($product['price'], 2) . '</td>';
                        echo '<td>' . $product['quantity'] . '</td>';
                        echo '<td>$' . number_format($product['cost'], 2) . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '<p>Total Cost: $' . number_format($total_cost, 2) . '</p>';
                    echo '</div>';
                }
            }
            ?>

            <form method="post" action="">
                <label for="customer_name">Customer Name:</label>
                <input type="text" name="customer_name" required><br>
                <label for="customer_contact">Customer Contact:</label>
                <input type="text" name="customer_contact" required><br>
                <label for="product_id">Enter Product ID:</label>
                <input type="text" id="product_id" onkeyup="showProductDetails()">
                <div class="product-details">
                    <h2>Selected Product</h2>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            <td id="product_name"></td>
                            <td id="product_price"></td>
                        </tr>
                    </table>
                </div>
                <label for="quantity">Enter Quantity:</label>
                <input type="number" name="quantity" min="1" required>
                <br>
                <input type="submit" name="submit" value="Create Invoice">
            </form>





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