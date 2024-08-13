<?php
session_start();
include('dbcon.php');

if (!isset($_SESSION['email'])) {
    header("Location: error.php");
    exit(0);
}

if (isset($_POST["save"])) {

    $email = mysqli_real_escape_string($con, $_SESSION['email']);

    $check_email_query = "SELECT * FROM admin WHERE email='$email'";
    $check_email_result = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_result) > 0) {
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

        if ($password == $cpassword) {
            // Hash the password before saving it to the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "UPDATE admin SET password = '$hashedPassword' WHERE email = '$email'";
            $query_run = mysqli_query($con, $query);

            if ($query_run) {
                $queryOtp = "UPDATE admin SET otp = '0' WHERE email = '$email'";
                $queryOtp_run = mysqli_query($con, $queryOtp);
                header("Location: index.php");
                session_destroy();
                exit(0);
            } else {
                $_SESSION['messageWarning'] = "Error in resetting password";
                header("Location: reset-password.php");
                exit(0);
            }
        } else {
            $_SESSION['messageWarning'] = "Passwords don't match";
            header("Location: reset-password.php");
            exit(0);
        }
    } else {
        $_SESSION['messageWarning'] = "Email is not registered";
        header("Location: reset-password.php");
        exit(0);
    }

    header("Location: reset-password.php");
    exit(0);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X=UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="style/reset-password.css"/>
    <link rel="icon" type="img/png" href="picture/logo.png">
    <title>New Password</title>
</head>
<body>
    <!--New Password-->
    <div class="container">
        <div class="forms">

            <div class="form login">
                <span class="title">Create New Password</span>

                <form action="reset-password.php" method="POST">
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Enter your new password" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="cpassword" class="password" placeholder="Confirm your new password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="save" value="Change Password">
                    </div>
                </form>

            </div>

        </div>
    </div>

    <script src="script/reset-password.js"></script>
</body>
</html>
