<?php
session_start();
    include('../dbcon.php');
    if (!isset($_SESSION['email'])) {
        header("Location: ../error.php");
        exit();
    }
    $token = bin2hex(random_bytes(64));
    $_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X=UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="http://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style/dashboard.css"/>
    <link rel="icon" type="img/png" href="../picture/logo.png">
    <title>Legal Management System</title>
</head>
<body class="dark">
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="../dashboard/home.php?token=<?php echo $token; ?>">
                        <span class="icon1"><ion-icon name="business-outline"></ion-icon>`</span>
                        <span class="title1">Administrative</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/home.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="grid-outline"></ion-icon></span>
                        <span class="title">DOCUMENT MANAGEMENT</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/reservation.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="paper-plane-outline"></ion-icon></span>
                        <span class="title">FACILITIES RESERVATION</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/legal.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="scale-outline"></ion-icon></span>
                        <span class="title">LEGAL MANAGEMENT</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/visitor.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="man-outline"></ion-icon></span>
                        <span class="title">VISITOR MANAGEMENT</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/colaboration.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="-outline"></ion-icon></span>
                        <span class="title">COLAB COMMUNICATION</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/register.php?token=<?php echo $token; ?>">
                        <span class="icon"><ion-icon name="-outline"></ion-icon></span>
                        <span class="title">ADD ADMIN</span>
                    </a>
                </li>
                <li>
                    <form action="../logout.php" method="POST">
                        <a href="../logout.php">
                            <span class="icon"><ion-icon name="log-in-outline"></ion-icon></span>
                            <span class="title">LOGOUT</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
       
      
        <div class="main" id="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="list-outline"></ion-icon>
                </div>
                <div class="search">
                    <p>Welcome to Administrative</p>
                </div>
                <div class="user">
                    <img src="" alt="">
                    <h1 class="log">A</h1>
                </div>            
            </div>
                 
            <div class="cardBox">
                <div class="card-header">
                    <h4>Legal Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-stripe">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client Name</th>
                            <th>Case Name</th>
                            <th>Case Description</th>
                            <th>Case Status</th>
                            <th>Add Case</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div> 
            </div>

        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../script/dashboard.js"></script>
</body>
</html>