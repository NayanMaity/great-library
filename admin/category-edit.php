<?php

require_once("../configs/connect.php");

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true) {
    header("location:login.php");
    die();
}

$id = $_POST['id'];

$data = ($gl_db->search_user_data("category", "cate_id", $id))[0];

echo "  <div class='modal-header'>
            <h1 class='modal-title fs-5' id='exampleModalToggleLabel2'>Category Details Edit</h1>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
            <form action='' id='cate-edit-form' class='row g-3' method='post' enctype='multipart/form-data'>  
                <div class='col-12'>
                    <p id='update-err-msg' class='text-center'></p>
                </div>
                <div class='col-12'>
                    <input type='hidden' class='form-control' id='cate-update-id' name='cate-update-id' value='" . $data['cate_id'] . "'>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Name</label>
                    <input type='text' class='form-control' id='cate-update-name' name='cate-update-name' value='" . $data['cate_name'] . "'>
                </div>
                <div class='col-12'>
                        <label class='form-label'>Description</label>
                    <textarea class='form-control' id='cate-update-desc' name='cate-update-desc'>" . $data['cate_desc'] . "</textarea>
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
