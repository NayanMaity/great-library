<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $issue_id = $_POST['id'];
    $issue_status = $_POST['status'];

    date_default_timezone_set("Asia/Kolkata");
    $returned_data = date("d/m/y");

    $updateSQL = "UPDATE issue SET issue_status='$issue_status', returned_at='$returned_data' WHERE issue_id='$issue_id'";
    // $resUpdate = $gl_db->conn->query($updateSQL);

    if ($gl_db->conn->query($updateSQL)) {
        echo "success";
    } else {
        echo "failed";
    }
}
