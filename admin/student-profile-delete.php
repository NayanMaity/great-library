<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = $_POST['id'];

    date_default_timezone_set("Asia/Kolkata");
    $update_data = date("y-m-d H:i:s");

    $updateSQL = "UPDATE user SET user_show='0', update_user_data='$update_data' WHERE user_id='$id'";
    // $resUpdate = $gl_db->conn->query($updateSQL);

    if ($gl_db->conn->query($updateSQL)) {
        echo "success";
    } else {
        echo "failed";
    }
}
