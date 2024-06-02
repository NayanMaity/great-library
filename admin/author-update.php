<?php


require_once("../configs/connect.php");

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true) {
    header("location:login.php");
    die();
}

$id = $_POST['id'];

$cate_data = ($gl_db->search_user_data("category", "cate_id", $id))[0];

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

    if (empty($name)) {

        $err_msg['emt_err'] = "emt_err";
        echo $err_msg['emt_err'];
    } else {

        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $err_msg['name_err'] = "name_err";
            echo $err_msg['name_err'];
        }

        if (count($err_msg) == 0) {

            date_default_timezone_set("Asia/Kolkata");
            $update_data = date("y-m-d H:i:s");

            $updateSQL = "UPDATE author SET author_name='$name', update_author_data='$update_data' WHERE author_id='$id'";
            // $resUpdate = $gl_db->conn->query($updateSQL);

            if ($gl_db->conn->query($updateSQL)) {
                echo "success";
            } else {
                echo "failed";
            }
        }
    }
}
