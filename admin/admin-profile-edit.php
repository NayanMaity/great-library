<?php

require_once("../configs/connect.php");

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true) {
    header("location:login.php");
    die();
}

$user_id = $_SESSION['user_id'];

$data = ($gl_db->search_user_data("user", "user_id", $user_id))[0];

echo "<div class='col-12'>
                <p id='update-err-msg' class='text-center'></p>
            </div>
            <div class='col-12'>
                <label class='form-label'>Name</label>
                <input type='text' class='form-control' id='admin-update-name' name='admin-update-name' value='" . $data['user_name'] . "'>
            </div>
            <div class='col-12'>
                 <label class='form-label'>Email</label>
                <input type='text' class='form-control' id='admin-update-email' name='admin-update-email' value='" . $data['user_email'] . "'>
            </div>
            <div class='col-12'>
                <label class='form-label'>Avatar</label>
                <input type='file' class='form-control' id='admin-update-avatar' name='admin-update-avatar'>
            </div>
            <div class='col-12'>
                <button type='submit' class='btn btn-primary'>
                    Update
                </button>
            </div>";
