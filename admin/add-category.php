<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
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

    $name = test_input($_POST['name']);
    $desc = test_input($_POST['desc']);

    $err_msg = [];

    if (empty($name) || empty($desc)) {

        $err_msg['emt_err'] = "emt_err";
        echo $err_msg['emt_err'];
    } else {

        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $err_msg['name_err'] = "name_err";
            echo $err_msg['name_err'];
        }

        if (count($err_msg) == 0) {

            date_default_timezone_set("Asia/Kolkata");
            $create_date = date("y-m-d H:i:s");
            $update_date = date("y-m-d H:i:s");

            $data = [
                "cate_name" => $name,
                "cate_desc" => $desc,
                "create_cate_data" => $create_date,
                "update_cate_data" => $update_date
            ];

            $type = "ssss";

            echo $gl_db->insert("category", $data, $type);
        }
    }
}
