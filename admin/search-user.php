<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

$search = $_POST['search'];

$selectSQL = "SELECT * FROM user WHERE user_role='user' AND user_show='1' AND user_email LIKE '%{$search}%'";

$resSelect = $gl_db->conn->query($selectSQL);

$data = $resSelect->fetch_all(MYSQLI_ASSOC);

if (count($data) > 0) {

    foreach ($data as $user_data) {

        if ($user_data['user_avatar'] !== null) {

            echo "<div class='registred-user-box d-flex flex-wrap align-items-center justify-content-between'>
                                <div class='d-flex align-items-center'>
                                    <img src='../uploads/" . $user_data['user_avatar'] . "' class='img-fluid registred-user-img' alt='user avatar'>
                                    <h5 class='registred-user-email'>" . $user_data['user_email'] . "</h5>
                                </div>
                                <div>
                                    <button class='registred-user-view' data-id='" . $user_data['user_id'] . "' data-bs-target='#std-reg-modal-toggle' data-bs-toggle='modal'>View</button>
                                    <button class='registred-user-delete' data-id='" . $user_data['user_id'] . "'>Delete</button>
                                </div>
                            </div>";
        } else {

            echo "<div class='registred-user-box d-flex flex-wrap align-items-center justify-content-between'>
                                <div class='d-flex align-items-center'>
                                    <img src='../assets/images/default_avatar.png' class='img-fluid registred-user-img' alt='user avatar'>
                                    <h5 class='registred-user-email'>" . $user_data['user_email'] . "</h5>
                                </div>
                                <div>
                                    <button class='registred-user-view' data-id='" . $user_data['user_id'] . "' data-bs-target='#std-reg-modal-toggle' data-bs-toggle='modal'>View</button>
                                    <button class='registred-user-delete' data-id='" . $user_data['user_id'] . "'>Delete</button>
                                </div>
                            </div>";
        }
    }
} else {

    echo "<h4>No record found.</h4>";
}
