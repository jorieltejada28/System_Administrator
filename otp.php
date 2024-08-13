<?php
session_start();
    include('dbcon.php');

    if (!isset($_SESSION['email'])) {
        header("Location: error.php");
        exit(0);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify'])) {
        $email = $_SESSION['email'];
        $otp1 = $_POST['otp1'];
        $otp2 = $_POST['otp2'];
        $otp3 = $_POST['otp3'];
        $otp4 = $_POST['otp4'];
        $otp5 = $_POST['otp5'];
        $otp6 = $_POST['otp6'];

        $otp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;

        $check_otp_query = "SELECT * FROM admin WHERE email='$email' AND otp=$otp";
        $check_otp_result = mysqli_query($con, $check_otp_query);

        $token = bin2hex(random_bytes(64));
        
        if (mysqli_num_rows($check_otp_result) > 0) {
            header("Location: reset-password.php?token=$token");
            exit(0);
        } else {
            $_SESSION['messageWarning'] = "Invalid OTP. Please try again.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X=UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/otp.css"/>
    <link rel="icon" type="img/png" href="picture/logo.png">
    <title>Otp Veification Form</title>
</head>
<body>
    <!--Otp Verify-->
    <div class="container">
        <header>
            <i class="bx bxs-check-shield"></i>
        </header>
        <h4>Enter OTP Code</h4>
        <form action="otp.php" method="POST">
            <div class="input-field">
                <input type="number" name="otp1" required>
                <input type="number" name="otp2" required disabled>
                <input type="number" name="otp3" required disabled>
                <input type="number" name="otp4" required disabled>
                <input type="number" name="otp5" required disabled>
                <input type="number" name="otp6" required disabled>
            </div>
            <button type="submit" name="verify">Verify OTP</button>
        </form>
    </div>

    <script src="script/otp.js"></script>
</body>
</html>
