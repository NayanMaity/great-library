<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = $_POST['id'];

    $data = $gl_db->search_user_data("category", "cate_id", $id);

    foreach ($data as $cate_data) {
        echo "
            <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalToggleLabel'>Category Details</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <form action='' id='cate-details-show'>
                        <div class='row g-3'>
                            <div class='col-12'>
                                <input type='text' class='form-control' placeholder='Name' value='" . $cate_data['cate_name'] . "' disabled>
                            </div>
                            <div class='col-12'>
                                <textarea class='form-control' placeholder='Description' rows='3' disabled >" . $cate_data['cate_desc'] . "</textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class='modal-footer d-flex align-items-center justify-content-center'>
                  <button id='cate-details-edit-btn' data-id='" . $cate_data['cate_id'] . "' class='btn btn-primary' data-bs-target='#std-reg-modal-2-toggle' data-bs-toggle='modal'>
                        Edit Category
                    </button>
                </div>
        ";
    }
}
