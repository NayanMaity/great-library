<?php

require_once("../configs/connect.php");

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true) {
    header("location:login.php");
    die();
}

$id = $_POST['id'];

$data = ($gl_db->search_user_data("author", "author_id", $id))[0];

echo "  <div class='modal-header'>
            <h1 class='modal-title fs-5' id='exampleModalToggleLabel2'>Author Edit</h1>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
            <form action='' id='author-edit-form' class='row g-3' method='post' enctype='multipart/form-data'>  
                <div class='col-12'>
                    <p id='update-err-msg' class='text-center'></p>
                </div>
                <div class='col-12'>
                    <input type='hidden' class='form-control' id='author-update-id' name='author-update-id' value='" . $data['author_id'] . "'>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Name</label>
                    <input type='text' class='form-control' id='author-update-name' name='author-update-name' value='" . $data['author_name'] . "'>
                </div>
                <div class='col-12 text-center'>
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
