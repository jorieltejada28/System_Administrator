<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../error.php");
    exit();
}

$token = bin2hex(random_bytes(64));
$_SESSION['token'] = $token;

if (isset($_POST["save"])) {
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $cpassword = filter_input(INPUT_POST, 'cpassword', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($password == $cpassword) {
        $check_email_query = "SELECT * FROM admin WHERE email='$email'";
        $check_email_result = mysqli_query($con, $check_email_query);

        if (mysqli_num_rows($check_email_result) > 0) {
            $_SESSION['messageWarning'] = "Email is Already Exist";
            header("Location: ../dashboard/register.php");
            exit(0);
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO admin (firstname, lastname, email, password) VALUES('$firstname', '$lastname', '$email', '$hashedPassword')";
            $query_run = mysqli_query($con, $query);

            $_SESSION['messageSuccess'] = "Register Successfully";
            header("Location: ../dashboard/register.php");
            exit(0);
        }
    } else {
        $_SESSION['messageWarning'] = "Password doesn't match";
        header("Location: ../dashboard/register.php");
        exit(0);
    }
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
    <link rel="stylesheet" href="../style/register.css"/>
    <link rel="icon" type="img/png" href="../picture/logo.png">
    <title>Registration</title>
</head>
<body>
    
    <div class="container">
        <div class="forms">

            <!-- register admin -->
            <div class="form login">
                <?php include('../messageWarning.php'); ?>
                <?php include('../messageSuccess.php'); ?>
                <span class="title">Add Admin</span>

                <form action="register.php" method="POST">
                    <div class="input-field">
                        <input type="text" name="firstname" placeholder="Enter your First name" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" name="lastname" placeholder="Enter your Last name" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Enter your Email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Enter your Password" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="cpassword" class="password" placeholder="Enter your Confirm Password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="save" value="Sign Up">
                    </div>
                </form>
                <div class="mt-3">
                    <a href="../dashboard/home.php?token=<?php echo $token; ?>" class="btn btn-secondary btn-block">
                        <i class="uil uil-arrow-left"></i> Back
                    </a>
                </div>

            </div>

        </div>
    </div>
    <script src="../script/register.js"></script>
</body>
</html>
