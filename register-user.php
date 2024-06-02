<?php

session_start();

if (isset($_SESSION['login_status'])) {
    header("location:index.php");
    die();
}

require_once("./configs/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $pass = md5(test_input($_POST['pass']));

    $err_msg = [];
    // $avatar = $_FILES['reg-avatar']['name'];

    if (empty($name) || empty($email) || empty($pass)) {

        $err_msg['emt_err'] = "emt_err";
        echo $err_msg['emt_err'];
    } else {

        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $err_msg['name_err'] = "name_err";
            echo $err_msg['name_err'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err_msg['email_err'] = "email_err";
            echo $err_msg['email_err'];
        }

        if (count($err_msg) == 0) {

            $resSearch = $gl_db->search_user_data("user", "user_email", $email);

            if (count($resSearch) > 0) {

                $err_msg["alr_err"] = "alr_err";
                echo $err_msg['alr_err'];
            } else {

                $avatar = null;

                if (!empty($_FILES['reg-avatar']['name'])) {
                    
                    $avatar = time() . "_" . str_replace(" ", "_", $name) . "_" . $_FILES['reg-avatar']['name'];
                    move_uploaded_file($_FILES['reg-avatar']['tmp_name'], "uploads/" . $avatar);
                }

                date_default_timezone_set("Asia/Kolkata");
                $create_date = date("y-m-d H:i:s");
                $update_date = date("y-m-d H:i:s");

                $data = [
                    "user_name" => $name,
                    "user_email" => $email,
                    "user_pass" => $pass,
                    "user_avatar" => $avatar,
                    "create_user_data" => $create_date,
                    "update_user_data" => $update_date
                ];

                $type = "ssssss";

                echo $gl_db->insert("user", $data, $type);
            }
        }
    }
}
