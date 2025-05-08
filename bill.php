<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice System</title>
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="manifest" href="img/site.webmanifest">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        header img {
            max-height: 50px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            margin: 0 0 10px;
        }

        strong {
            font-weight: bold;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            
            bottom: 10px;
            left: 20px;
            color: #777;
        }
    </style>
</head>
<body style="background:#D1D5DB">
    <div class="container" style="margin-top:60px">
        <header>
        <div style="display: flex; align-items: center;">
    <img src="img/logo.png" alt="Company Logo" style="width: 50px; height: 50px; margin-right: 10px;">
    <h2>InventoTrack</h2>
</div>

            <!-- Add the path to your company logo above -->
            <a href="invoice_create.php"><button>Exit</button></a>

        </header>

        <?php
        // Database connection
        $conn = mysqli_connect("localhost", "root", "", "inventory_management");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $paymentStatus = isset($_POST["payment_status"]) ? $_POST["payment_status"] : "";
            $date = isset($_POST["date"]) ? $_POST["date"] : "";
            $invoiceNumber = isset($_POST["invoice_number"]) ? $_POST["invoice_number"] : "";
            $customerName = isset($_POST["customer_name"]) ? $_POST["customer_name"] : "";
            $customerContact = isset($_POST["customer_contact"]) ? $_POST["customer_contact"] : "";
            $totalUnits = isset($_POST["total_units"]) ? $_POST["total_units"] : 0;
            $total = isset($_POST["total"]) ? $_POST["total"] : 0;
            $discount = isset($_POST["discount_amount"]) ? $_POST["discount_amount"] : 0;
            $tax = isset($_POST["tax"]) ? $_POST["tax"] : 0;
            $totalAmount = isset($_POST["total_amount"]) ? $_POST["total_amount"] : 0;
            $note = isset($_POST["note"]) ? $_POST["note"] : "";

            $sellQuery = "INSERT INTO sell (payment_status, date, invoice_no, customer_name, customer_contact, total_units, total, discount, tax, total_amount, note) VALUES ('$paymentStatus', '$date', '$invoiceNumber', '$customerName', '$customerContact', $totalUnits, $total, $discount, $tax, $totalAmount, '$note')";

            if (!mysqli_query($conn, $sellQuery)) {
                die("Error in sellQuery: " . mysqli_error($conn));
            }

            $sellID = mysqli_insert_id($conn);

            $table = isset($_POST["invoice_table"]) ? $_POST["invoice_table"] : [];

            foreach ($table as $row) {
                $productName = $row["product_name"];
                $productUnits = $row["product_units"];

                $productQuery = "INSERT INTO sell_product (invoice_no, date, product_name, product_units) VALUES ($sellID, '$date', '$productName', $productUnits)";
                
                if (!mysqli_query($conn, $productQuery)) {
                    die("Error in productQuery: " . mysqli_error($conn));
                }

                $updateProductQuery = "UPDATE product SET product_quantity = product_quantity - $productUnits WHERE product_name = '$productName'";
                
                if (!mysqli_query($conn, $updateProductQuery)) {
                    die("Error in updateProductQuery: " . mysqli_error($conn));
                }
            }

            echo '<h2>Invoice Details</h2>';
            echo '<p><strong>Payment Status:</strong> ' . $paymentStatus . '</p>';
            echo '<p><strong>Date:</strong> ' . $date . '</p>';
            echo '<p><strong>Invoice Number:</strong> ' . $invoiceNumber . '</p>';
            echo '<p><strong>Customer Name:</strong> ' . $customerName . '</p>';
            echo '<p><strong>Customer Contact:</strong> ' . $customerContact . '</p>';
            echo '<p><strong>Total Units:</strong> ' . $totalUnits . '</p>';
            echo '<p><strong>Total:</strong> ' . $total . '</p>';
            echo '<p><strong>Discount:</strong> ' . $discount . '</p>';
            echo '<p><strong>Tax:</strong> ' . $tax . '</p>';
            echo '<p><strong>Total Amount:</strong> ' . $totalAmount . '</p>';
            echo '<p><strong>Note:</strong> ' . $note . '</p>';
        }

        mysqli_close($conn);
        ?>

        <button onclick="window.print()">Print Invoice</button>

        <footer style="margin-top:10px">
            Designed by Burhanuddin Bohra
        </footer>
    </div>
</body>
</html>
