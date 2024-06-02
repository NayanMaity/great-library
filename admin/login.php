<?php

session_start();

if (isset($_SESSION['admin_login_status'])) {
    header("location:admin-dashboard.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <div id="login-page-sec">
        <div class="container-lg d-flex align-items-center justify-content-center">
            <form class="row g-3" method="post" id="admin-login-form">
                <div class="col-12">
                    <p class="text-center text-white" style="font-size: 22px;">Login Form</p>
                </div>

                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="admin-login-email" name="admin-login-email">
                </div>

                <div class="col-12">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" id="admin-login-pass" name="admin-login-pass">
                </div>

                <div class="col-12 text-end ">
                    <a href="../search-email.php">forgot password</a>
                </div>

                <div class="col-12 ">
                    <button type="submit" name="admin-login-sub-btn" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>

    <div id="admin-login-popup">
        <div class="popup-box">
            <div class="row g-4">
                <div class="col-12 text-end">
                    <button id="close-popup"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <div id="admin-login-popup-msg" class="col-12 text-center mb-4">

                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/app.js"></script>
</body>

</html>