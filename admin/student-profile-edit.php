<?php

require_once("../configs/connect.php");

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true) {
    header("location:login.php");
    die();
}

$user_id = $_POST['user_id'];

$data = ($gl_db->search_user_data("user", "user_id", $user_id))[0];

echo "  <div class='modal-header'>
            <h1 class='modal-title fs-5' id='exampleModalToggleLabel2'>Student Profile Update</h1>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
            <form action='' id='std-profile-edit-form' class='row g-3' method='post' enctype='multipart/form-data'>  
                <div class='col-12'>
                    <p id='update-err-msg' class='text-center'></p>
                </div>
                <div class='col-12'>
                    <input type='hidden' class='form-control' id='std-update-id' name='std-update-id' value='" . $data['user_id'] . "'>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Name</label>
                    <input type='text' class='form-control' id='std-update-name' name='std-update-name' value='" . $data['user_name'] . "'>
                </div>
                <div class='col-12'>
                        <label class='form-label'>Email</label>
                    <input type='text' class='form-control' id='std-update-email' name='std-update-email' value='" . $data['user_email'] . "'>
                </div>
                <div class='col-12'>
                    <button type='submit' class='btn btn-primary'>
                        Update
                    </button>
                </div>
            </form>
            </div>
        <!-- <div class='modal-footer'>
            <button class='btn btn-primary' data-bs-target='#account-modal-toggle' data-bs-toggle='modal'>
                profile
            </button>
        </div> -->";
