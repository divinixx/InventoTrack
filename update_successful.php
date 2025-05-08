<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $sql = "SELECT * FROM product WHERE product_id = '$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['product_name'];
        $product_description = $row['product_description'];
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        
    }
}

if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $new_product_name = $_POST['product_name'];
    $new_product_description = $_POST['product_description'];
    $new_product_price = $_POST['product_price'];
    $new_product_quantity = $_POST['product_quantity'];

    $update_sql = "UPDATE product SET
                    product_name = '$new_product_name',
                    product_description = '$new_product_description',
                    product_price = '$new_product_price',
                    product_quantity = '$new_product_quantity'
                    WHERE product_id = '$product_id'";

    if ($conn->query($update_sql) === TRUE) {
    } else {
        echo "Error updating product: " . $conn->error;
    }
}


?>
<?php
    if (isset($_POST['update_product'])) {
        $product_id = $_POST['product_id'];
        $new_product_name = $_POST['product_name'];

        $update_sql = "UPDATE product SET product_name = '$new_product_name' WHERE product_id = '$product_id'";

        if ($conn->query($update_sql) === TRUE) {
            
        } else {
            echo "Error updating product: " . $conn->error;
        }
    }
    ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <title>InventoTrack - Dashboard</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://unicons.iconscout.com/release/v3.0.6/css/line.css'><link rel="stylesheet" href="./dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="manifest" href="img/site.webmanifest">
 <style>
.confirmation-page {
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 10px;
    width: 80%;
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.confirmation-page h2 {
    color: #007BFF;
    font-size: 24px;
    margin-bottom: 20px;
}

.confirmation-page p {
    font-size: 18px;
    margin-bottom: 20px;
}

.confirmation-page a {
    text-decoration: none;
    background: #007BFF;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    display: block;
    margin-top: 50px;
    transition: background-color 0.3s;
}

.confirmation-page a:hover {
    background: #0056b3;
}

 </style>
</head>
<body>
    <div class="confirmation-page" style="margin-top:50px">
        <h2>Product Updated</h2>
        <p>The product has been updated successfully.</p>
        <a href="inventory.php">Back to Inventory</a>
    </div>
</body>
<script>
                setTimeout(function () {
                    window.location.href = 'inventory.php';
                }, 3000);
            </script>
</html>
