<?php
session_start();
include("dbcon.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $query = "SELECT * FROM admin WHERE email=?";
    $query_run = mysqli_prepare($con, $query);

    if ($query_run) {
        mysqli_stmt_bind_param($query_run, 's', $email);
        mysqli_stmt_execute($query_run);
        $result = mysqli_stmt_get_result($query_run);

        $token = bin2hex(random_bytes(64));

        if ($result && mysqli_num_rows($result) == 1) {
            $userData = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $userData['password'])) {
                // Store email in the session
                $_SESSION['email'] = $userData['email'];

                // Redirect to dashboard with token
                header("Location: dashboard/home.php?token=$token");
                exit();
            } else {
                $_SESSION['messageWarning'] = "Invalid Password";
            }
        } else if (empty($email) || empty($password)) {
            $_SESSION['messageWarning'] = "Please Input Email and Password";
        } else {
            $_SESSION['messageWarning'] = "Invalid Email";
        }
    } else {
        die("Prepared statement failed.");
    }

    header("Location: index.php");
    exit(0);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css"/>
    <link rel="icon" type="img/png" href="picture/logo.png">
    <title>Admin Login</title>
</head>
<body>
    <div class="container">
        <div class="forms">
            <!-- Login -->
            <div class="form login">
                <?php include('messageWarning.php'); ?>
                <span class="title">Welcome to Administrator</span>
                <form action="index.php" method="POST">
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        <a href="forgot-password.php" class="text">Forgot password?</a>
                    </div>
                    <div class="input-field button">
                        <input type="submit" name="login" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>