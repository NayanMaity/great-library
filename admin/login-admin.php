<?php

session_start();

if (isset($_SESSION['admin_login_status'])) {
    header("location:admin-dashboard.php");
    die();
}

require_once("../configs/connect.php");



if ($_SERVER['REQUEST_METHOD'] == "POST") {


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = test_input($_POST['email']);
    $pass = md5(test_input($_POST['pass']));

    $err_msg = [];

    if (empty($email) || empty($pass)) {
        $err_msg['emt_err'] = "emt_err";
        echo $err_msg['emt_err'];
    } else {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err_msg['email_err'] = "email_err";
            echo $err_msg['email_err'];
        }

        $resUser = $gl_db->search_user("user", "user_email", "user_email", $email);

        if (count($resUser) == 1) {

            $sql = "SELECT * FROM user WHERE user_email = '$email' AND user_pass = '$pass' AND user_role='admin' AND user_show='1'";
            $resSerch = $gl_db->conn->query($sql);

            if (mysqli_num_rows($resSerch) == 1) {
                echo "success";

                $data =  $resSerch->fetch_assoc();

                $_SESSION['admin_login_status'] = true;
                $_SESSION['user_id'] = $data['user_id'];
                $_SESSION['user_role'] = "admin";
            } else {
                echo "failed";
            }
        } else {
            $err_msg['user_err'] = "user_err";
            echo $err_msg['user_err'];
        }
    }
}
