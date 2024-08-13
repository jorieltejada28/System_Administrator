<?php
session_start();
include('../dbcon.php');

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $query = "SELECT firstname FROM admin WHERE email = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $response['success'] = true;
            $response['firstname'] = $row['firstname'];
        } else {
            $response['success'] = false;
            $response['error'] = "User not found";
        }

        mysqli_stmt_close($stmt);
    } else {
        $response['success'] = false;
        $response['error'] = "Prepared statement failed";
    }
} else {
    $response['success'] = false;
    $response['error'] = "User not logged in";
}

echo json_encode($response);
mysqli_close($con);
?>
