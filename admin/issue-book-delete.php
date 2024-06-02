<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $issue_id = $_POST['id'];

    $selectIssue = $gl_db->search_user_data("issue", "issue_id", $issue_id)[0];

    if ($selectIssue['issue_status'] == "not return") {
        echo "err";
    } else {

        $updateSQL = "UPDATE issue SET issue_show='0' WHERE issue_id='$issue_id'";
        // $resUpdate = $gl_db->conn->query($updateSQL);

        if ($gl_db->conn->query($updateSQL)) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
