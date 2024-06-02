<?php


require_once("../configs/connect.php");

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true) {
    header("location:login.php");
    die();
}

$id = $_POST['id'];

$user_data = ($gl_db->search_user_data("user", "user_id", $id))[0];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $err_msg = [];

    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);

    if (empty($name) || empty($email)) {

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

        if ($email == $user_data['user_email']) {

            if (count($err_msg) == 0) {

                date_default_timezone_set("Asia/Kolkata");
                $update_data = date("y-m-d H:i:s");

                $updateSQL = "UPDATE user SET user_name='$name', user_email='$email', update_user_data='$update_data' WHERE user_id='$id'";
                // $resUpdate = $gl_db->conn->query($updateSQL);

                if ($gl_db->conn->query($updateSQL)) {
                    echo "success";
                } else {
                    echo "failed";
                }
            }
        } else {

            $searchUser = $gl_db->search_user("user", "user_email", "user_email", $email);
            if (count($searchUser) > 0) {

                $err_msg['alr_err'] = "alr_err";
                echo $err_msg['alr_err'];
            } else {

                if (count($err_msg) == 0) {

                    date_default_timezone_set("Asia/Kolkata");
                    $update_data = date("y-m-d H:i:s");

                    $updateSQL = "UPDATE user SET user_name='$name', user_email='$email', update_user_data='$update_data' WHERE user_id='$id'";
                    // $resUpdate = $gl_db->conn->query($updateSQL);

                    if ($gl_db->conn->query($updateSQL)) {
                        echo "success";
                    } else {
                        echo "failed";
                    }
                }
            }
        }
    }
}
