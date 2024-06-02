<?php

require_once("../configs/connect.php");

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true) {
    header("location:login.php");
    die();
}

$id = $_POST['id'];

$data = ($gl_db->search_user_data("book", "book_id", $id))[0];


$resAuthor = $gl_db->search_user_data("author", "author_show", "1");

$authorOption = "";
$authorOptionSeleceted = "";

foreach ($resAuthor as $data_author) {
    if ($data_author['author_id'] == $data['author_id']) {

        $authorOptionSeleceted = "<option value='" . $data_author['author_id'] . "' selected>" . $data_author['author_name'] . "</option>";
    } else {

        $authorOption .= "<option value='" . $data_author['author_id'] . "'>" . $data_author['author_name'] . "</option>";
    }
}
// echo $authorOption;


$resCate = $gl_db->search_user_data("category", "cate_show", "1");

$cateOption = "";
$cateOptionSeleceted = "";

foreach ($resCate as $data_cate) {
    if ($data_cate['cate_id'] == $data['cate_id']) {

        $cateOptionSeleceted = "<option value='" . $data_cate['cate_id'] . "' selected>" . $data_cate['cate_name'] . "</option>";
    } else {

        $cateOption .= "<option value='" . $data_cate['cate_id'] . "'>" . $data_cate['cate_name'] . "</option>";
    }
}



echo "  <div class='modal-header'>
            <h1 class='modal-title fs-5' id='exampleModalToggleLabel2'>Book Edit</h1>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
            <form action='' id='book-edit-form' class='row g-3' method='post' enctype='multipart/form-data'>  
                <div class='col-12'>
                    <p id='update-err-msg' class='text-center'></p>
                </div>
                <div class='col-12'>
                    <input type='hidden' class='form-control' id='book-update-id' name='book-update-id' value='" . $data['book_id'] . "'>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Image</label>
                    <img src='../uploads/" . $data['book_img'] . "' class='img-fluid' style='width:100px; display:block;'>
                    <input type='file' class='form-control mt-1' id='book-update-img' name='book-update-img'>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Title</label>
                    <input type='text' class='form-control' id='book-update-title' name='book-update-title' value='" . $data['book_title'] . "'>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Description</label>
                    <textarea class='form-control' id='book-update-desc' name='book-update-desc' rows='3'> " . $data['book_desc'] . " </textarea>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Author</label>
                    <select class='form-select' id='book-update-author' name='book-update-author' aria-label='Default select example'>" . $authorOptionSeleceted . $authorOption . "</select>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Category</label>
                    <select class='form-select' id='book-update-cate' name='book-update-cate' aria-label='Default select example'>" . $cateOptionSeleceted . $cateOption . "</select>
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
