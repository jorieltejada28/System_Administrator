<?php
session_start();
    include('dbcon.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        $_SESSION['email'] = $email;

        function generateOTP() {
            return rand(100000, 999999);
        }

        $otp = generateOTP();

        // Configure PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'peterparkerspi42@gmail.com';
            $mail->Password   = 'gsazehancqutzzud';
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('peterparkerspi42@gmail.com', 'Name');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'OTP Verification';
            $mail->Body    = 'Your OTP is: ' . $otp;

            $mail->send();

            $check_email_query = "SELECT * FROM admin WHERE email='$email'";
            $check_email_result = mysqli_query($con, $check_email_query);

            $token = bin2hex(random_bytes(64));

            if (mysqli_num_rows($check_email_result) <= 0) {
                $_SESSION['messageWarning'] = "Email is not Exist";
                header("Location: forgot.php");
                exit(0);
            } else {
                $query = "UPDATE admin SET otp = $otp WHERE email = '$email'";
                $query_run = mysqli_query($con, $query);
                header("Location: otp.php?token=$token");
                exit(0);
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X=UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="style/forgotpass.css"/>
    <link rel="icon" type="img/png" href="picture/logo.png">
    <title>Forgot Password</title>
</head>
<body>

<div class="container">
    <div class="forms">

        <!-- Forgot Password -->
        <div class="form login">
            <span class="title">Forgot Password</span>

            <form action="forgot-password.php" method="POST">
                <div class="input-field">
                    <input type="text" name="email" placeholder="Enter your email address" required>
                    <i class="uil uil-envelope icon"></i>
                </div>

                <div class="input-field button">
                    <input type="submit" value="Send">
                </div>
            </form>

        </div>

    </div>
</div>

<script src="forgotpass.js"></script>
</body>
</html>
