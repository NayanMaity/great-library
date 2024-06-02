<?php

session_start();

require_once("../configs/connect.php");

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$err_msg = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $book_id = $_POST['book_id'];
    $email = test_input($_POST['email']);

    if (empty($email)) {

        $err_msg['emt_err'] = "emt_err";
        echo $err_msg['emt_err'];
    } else {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err_msg['email_err'] = "email_err";
            echo $err_msg['email_err'];
        } else {

            $searchUser = "SELECT * FROM user WHERE user_email='$email' and user_show='1'";
            $resUser = $gl_db->conn->query($searchUser);

            $data = $resUser->fetch_all(MYSQLI_ASSOC);

            if (count($data) == 0) {

                $err_msg['dne_err'] = "dne_err";
                echo $err_msg['dne_err'];
            } else {

                $user_id = $data[0]['user_id'];

                date_default_timezone_set("Asia/Kolkata");
                $issue_date = date("d/m/y");
                $return_date = date("d/m/y", strtotime("+10 days"));

                $data = [
                    "book_id" => $book_id,
                    "user_id" => $user_id,
                    "issue_date" => $issue_date,
                    "return_date" => $return_date
                ];

                $type = "iiss";

                echo $gl_db->insert("issue", $data, $type);
            }
        }
    }
}
