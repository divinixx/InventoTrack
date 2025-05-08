<?php
require_once "config.php";

$admin_name = $password = $confirm_password = $position = $contact = $email = "";
$admin_name_err = $password_err = $confirm_password_err = $position_err = $contact_err = $email_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty(trim($_POST["admin_name"]))) {
        $admin_name_err = "Admin name cannot be blank";
    } else {
        $sql = "SELECT id FROM admin WHERE admin_name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_admin_name);

            $param_admin_name = trim($_POST['admin_name']);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $admin_name_err = "This admin name is already taken";
                } else {
                    $admin_name = trim($_POST['admin_name']);
                }
            } else {
                echo "Something went wrong";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot be less than 5 characters";
    } else {
        $password = trim($_POST['password']);
    }

    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $confirm_password_err = "Passwords should match";
    }

    if (empty(trim($_POST['position']))) {
        $position_err = "Position cannot be blank";
    } else {
        $position = trim($_POST['position']);
    }

    if (empty(trim($_POST['contact']))) {
        $contact_err = "Contact cannot be blank";
    } else {
        $contact = trim($_POST['contact']);
    }

    if (empty(trim($_POST['email']))) {
        $email_err = "Email cannot be blank";
    } else {
        $email = trim($_POST['email']);
    }

    if (empty($admin_name_err) && empty($password_err) && empty($confirm_password_err) && empty($position_err) && empty($contact_err) && empty($email_err)) {
        $sql = "INSERT INTO admin (admin_name,  position, contact, email,password) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssss", $param_admin_name,  $param_position, $param_contact, $param_email, $param_password,);

            $param_admin_name = $admin_name;
            $param_position = $position;
            $param_contact = $contact;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {
                header("location: redirect_admin.html");
                exit(); 
            } else {
                echo "Something went wrong... cannot redirect!";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css'>
    <link rel="stylesheet" href="./register.css">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="manifest" href="img/site.webmanifest">
</head>
<body>
<div class="container col s8" style="padding-top: 20px;">
    <div class="row">
        <nav>
            <div class="nav-wrapper">
                <div class="col s8">
                    <h3 class="brand-logo col s8">Please Register</h3>
                </div>
            </div>
        </nav>
    </div>
    <form class="col s14" action="" method="post">
        <div class="row">
            <div class="input-field hoverable col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="admin_name" type="text" class="validate"  name="admin_name" required>
                <label for="admin_name">Admin Name</label>
                
            </div>
            <div class="input-field hoverable col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="position" type="text" class="validate" name="position" required>
                <label for="position">Position</label>
                <span class="error"><?php echo $position_err; ?></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field hoverable col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="contact" type="text" class="validate" name="contact" required>
                <label for="contact">Contact No.</label>
                <span class="error"><?php echo $contact_err; ?></span>
            </div>
            <div class="input-field hoverable col s6">
                <i class="material-icons prefix">email</i>
                <input id="email" type="email" class="validate" name="email" required>
                <label for="email">Email</label>
                <span class="error"><?php echo $email_err; ?></span>
            </div>
        </div>
        <div class="row">
            <div class="input-field hoverable col s6">
                <i class="material-icons prefix">vpn_key</i>
                <input id="password" class="validate" name ="password" type="password" required>
                <label for="password">Password</label>
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <div class="input-field hoverable col s6">
                <i class="material-icons prefix">replay</i>
                <input id="confirm_password"  type="password" class="validate" name ="confirm_password" required>
                <label for="confirm_password">Retype Password</label>
                <span class="error"><?php echo $confirm_password_err; ?></span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
<script src='https://code.jquery.com/jquery-2.1.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>
</body>
</html>
