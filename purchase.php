<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dealer_name = $_POST["dealer_name"];
    $dealer_address = isset($_POST["dealer_address"]) ? $_POST["dealer_address"] : "";
    $reason = $_POST["reason"];
    $date = $_POST["date"];
    $amount = $_POST["amount"];

    $target_dir = "purchase_pdf/";
    $bill_pdf = $target_dir . basename($_FILES["bill_pdf"]["name"]);

    if (move_uploaded_file($_FILES["bill_pdf"]["tmp_name"], $bill_pdf)) {

        $servername = "localhost"; 
        $username = "root";    
        $password = "";      
        $dbname = "inventory_management";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO purchase (dealer_name, dealer_address, reason, date, amount, bill_pdf)
                VALUES ('$dealer_name', 
                        " . ($dealer_address ? "'$dealer_address'" : "NULL") . ", 
                        '$reason', 
                        '$date', 
                        $amount, 
                        " . ($bill_pdf ? "'$bill_pdf'" : "NULL") . ")";
        if ($conn->query($sql) === TRUE) {
            echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Confirmation</title>
  <style>
                body {
                  font-family: 'Arial', sans-serif;
                  background-color: #2A2B3D;
                  margin: 0;
                  padding: 0;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  min-height: 100vh;
                }

                .confirmation-card {
                  background-color: #6F6486;
                  color: #fff;
                  border-radius: 10px;
                  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                  padding: 20px;
                  max-width: 400px;
                  width: 100%;
                  position: relative;
                  animation: fadeIn 0.5s ease-in-out;
                }

                h2 {
                  margin: 0 0 10px;
                }

                p {
                  margin: 10px 0;
                }

                @keyframes fadeIn {
                  from {
                    opacity: 0;
                  }
                  to {
                    opacity: 1;
                  }
                }
              </style>
</head>
<body>
  <div class='confirmation-card'>
    <h2>Bill Uploaded Successfully!</h2>
    <p><strong>Dealer Name:</strong> $dealer_name</p>
    <p><strong>Dealer Address:</strong> $dealer_address</p>
    <p><strong>Reason:</strong> $reason</p>
    <p><strong>Date:</strong> $date</p>
    <p><strong>Amount:</strong> $amount</p>
    <p><strong>Bill PDF Path:</strong> $bill_pdf</p>
  </div>

  <script>
    // Remove the confirmation card after 5 seconds
    setTimeout(() => {
      document.querySelector('.confirmation-card').style.display = 'none';
      // Redirect to another page after 5 seconds
      window.location.href = 'expenses.php';
    }, 5000);
  </script>
</body>
</html>
";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Confirmation</title>
  <style>
                body {
                  font-family: 'Arial', sans-serif;
                  background-color: #2A2B3D;
                  margin: 0;
                  padding: 0;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  min-height: 100vh;
                }

                .confirmation-card {
                  background-color: #6F6486;
                  color: #fff;
                  border-radius: 10px;
                  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                  padding: 20px;
                  max-width: 400px;
                  width: 100%;
                  position: relative;
                  animation: fadeIn 0.5s ease-in-out;
                }

                h2 {
                  margin: 0 0 10px;
                }

                p {
                  margin: 10px 0;
                }

                @keyframes fadeIn {
                  from {
                    opacity: 0;
                  }
                  to {
                    opacity: 1;
                  }
                }
              </style>
</head>
<body>
  <div class='confirmation-card'>
    <h2>Error Uploading File!</h2>
    
  </div>

  <script>
    // Remove the confirmation card after 5 seconds
    setTimeout(() => {
      document.querySelector('.confirmation-card').style.display = 'none';
      // Redirect to another page after 5 seconds
      window.location.href = 'expenses.php';
    }, 5000);
  </script>
</body>
</html>
";
    }
} else {
    header("expenses.php");
    exit();
}
?>