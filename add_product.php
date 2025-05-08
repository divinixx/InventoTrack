<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_name = $_POST['product_name'];
$product_description = $_POST['product_description'];
$product_price = $_POST['product_price'];
$product_quantity = $_POST['product_quantity'];
$dealer_name = $_POST['dealer_name'];

$product_id = mt_rand(100000, 999999); 

// Handle image upload
$target_dir = "uploads/";
$original_file_name = $_FILES["product_img"]["name"];
$target_file = $target_dir . basename($original_file_name);

if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO product (product_id, product_name, product_description, product_price, product_quantity, dealer_name, product_img)
            VALUES ($product_id, '$product_name', '$product_description', $product_price, $product_quantity, '$dealer_name', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo '<html>';
        echo '<head>';
        echo '<title>Product Added</title>';
        echo '</head>';
        echo '<body>';
        echo '<div style="text-align: center; background-color: #fff; max-width: 600px; margin: 20px auto; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">';
        echo '<button onclick="window.print()" style="float: right; margin-bottom: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; padding: 10px 15px; cursor: pointer;">Print</button>';
        echo '<button onclick="goToOtherPage()" style="float: left; margin-bottom: 10px; background-color: #dc3545; color: #fff; border: none; border-radius: 5px; padding: 10px 15px; cursor: pointer;">Exit</button>';
        echo '<h2 style="color: #007bff;">Product Added Successfully</h2>';
        echo '<p>Product ID: ' . $product_id . '</p>';
        echo '<p>Product Name: ' . $product_name . '</p>';
        echo '<p>Product Description: ' . $product_description . '</p>';
        echo '<p>Product Price: ' . $product_price . '</p>';
        echo '<p>Product Quantity: ' . $product_quantity . '</p>';
        echo '<p>Dealer Name: ' . $dealer_name . '</p>';
        echo '<img src="' . $target_file . '" alt="Product Image" style="max-width: 300px; height: auto; margin-top: 10px;">'; // Adjust the max-width here
        echo '</div>';
        echo '</body>';
        echo '</html>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Sorry, there was an error uploading your file.";
}

$conn->close();
?>

<script>
    function goToOtherPage() {
        window.location.href = "add_items.php"; 
    }
</script>
