<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true) {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

$user_id = $_SESSION['user_id'];

$data = $gl_db->search_user_data("user", "user_id", $user_id);


foreach ($data as $user_data) {

    if ($user_data['user_avatar'] !== null) {

        echo "
            <div class='row g-3'>
                                <div class='col-12'>
                                    <div class='profile-img'>
                                        <img src='../uploads/" . $user_data['user_avatar'] . "' class='img-fluid' alt='user avatar'>
                                    </div>
                                </div>
                                <div class='col-12'>
                                    <input type='text' class='form-control' placeholder='Name' value='" . $user_data['user_name'] . "' disabled>
                                </div>
                                <div class='col-12'>
                                    <input type='text' class='form-control' placeholder='Email' value='" . $user_data['user_email'] . "' disabled>
                                </div>
                            </div>
        ";
    } else {

        echo "
            <div class='row g-3'>
                                <div class='col-12'>
                                    <div class='profile-img'>
                                        <img src='./assets/images/default_avatar.png' class='img-fluid' alt='user avatar'>
                                    </div>
                                </div>
                                <div class='col-12'>
                                    <input type='text' class='form-control' placeholder='Name' value='" . $user_data['user_name'] . "' disabled>
                                </div>
                                <div class='col-12'>
                                    <input type='text' class='form-control' placeholder='Email' value='" . $user_data['user_email'] . "' disabled>
                                </div>
                            </div>
        ";
    }
}
