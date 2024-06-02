<?php

session_start();

if (isset($_SESSION['login_status'])) {
    header("location:index.php");
    die();
}

require_once("./configs/connect.php");

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$err_msg = [];

$id = $_GET['id'];

if (isset($_POST['pass-reset-btn'])) {

    $token = test_input($_POST['token']);
    $password = md5(test_input($_POST['password']));


    if (empty($token) || empty($password)) {

        $err_msg['emt_err'] = "Please fill the form.";
    } else {

        if (count($err_msg) <= 0) {

            $searchUser = "SELECT * FROM user WHERE user_id = '$id' AND token = '$token' AND user_show = '1'";
            $resSearch = mysqli_query($gl_db->conn, $searchUser);

            if (mysqli_num_rows($resSearch) == 1) {
                $data = mysqli_fetch_assoc($resSearch);

                $passSQL = "UPDATE user SET token = null, user_pass = '$password' WHERE user_id = '{$data['user_id']}'";
                $resPass = mysqli_query($gl_db->conn, $passSQL);

                if ($resPass) {

                    $name = $data['user_name'];
                    $email = $data['user_email'];

                    require_once("./vendor/mail/mail.php");
                    require_once("./vendor/mail/templates/pass-reset-conform-template.php");

                    sendMail($email, $name, $sub, $msg);
                    header("location: login.php");
                } else {
                    echo "<script>alert('Something went worng.');window.location.href='./search-email.php'</script>";
                }
            } else {
                echo "<script>alert('Your OTP dose not match');window.location.href='./search-email.php'</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search User</title>
    <link rel="stylesheet" href="./assets/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <div id="login-page-sec">
        <div class="container-lg d-flex align-items-center justify-content-center">
            <form class="row g-3" method="post" id="search-user-form">
                <div class="col-12">
                    <p class="text-center text-white" style="font-size: 22px;">Search User</p>
                </div>

                <div class="col-12">
                    <span style="color: red;">
                        <?php
                        if (isset($err_msg['emt_err'])) {
                            echo $err_msg['emt_err'];
                        }
                        ?>
                    </span>
                </div>

                <div class="col-12">
                    <label class="form-label">OTP</label>
                    <input type="text" class="form-control" id="token" name="token" placeholder="Enter your OTP...">
                </div>

                <div class="col-12">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="Enter your Password...">
                </div>

                <div class="col-12 text-center">
                    <button type="submit" name="pass-reset-btn" class="btn btn-primary">Get OTP</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="./assets/js/app.js"></script>
</body>

</html>