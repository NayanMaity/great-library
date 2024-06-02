<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = $_POST['user_id'];

    $data = $gl_db->search_user_data("user", "user_id", $id);

    foreach ($data as $user_data) {

        if ($user_data['user_avatar'] !== null) {

            echo "
            <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalToggleLabel'>Profile</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <form action='' id='student-profile-show'>
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
                        </form>
                </div>
                <div class='modal-footer d-flex align-items-center justify-content-center'>
                  <button id='std-profile-edit-btn' data-id='" . $user_data['user_id'] . "' class='btn btn-primary' data-bs-target='#std-reg-modal-2-toggle' data-bs-toggle='modal'>
                        Edit Profile
                    </button>
                  <button id='std-book-issue-btn' data-id='" . $user_data['user_id'] . "' class='btn btn-primary' data-bs-target='#std-reg-modal-2-toggle' data-bs-toggle='modal'>
                        Issue Book
                    </button>
                </div>
        ";
        } else {

            echo "
            <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalToggleLabel'>Profile</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <form action='' id='student-profile-show'>
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
                        </form>
                </div>
                <div class='modal-footer d-flex align-items-center justify-content-center'>
                    <button id='std-profile-edit-btn' data-id='" . $user_data['user_id'] . "' class='btn btn-primary' data-bs-target='#std-reg-modal-2-toggle' data-bs-toggle='modal'>
                        Edit Profile
                    </button>
                    <button id='std-book-issue-btn' data-id='" . $user_data['user_id'] . "' class='btn btn-primary' data-bs-target='#std-reg-modal-2-toggle' data-bs-toggle='modal'>
                        Issue Book
                    </button>
                </div>
        ";
        }
    }
}
