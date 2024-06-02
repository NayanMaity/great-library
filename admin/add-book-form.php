<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

$resAuthor = $gl_db->search_user_data("author", "author_show", "1");

$authorOption = "";
foreach ($resAuthor as $data_author) {
    $authorOption .= "<option value='" . $data_author['author_id'] . "'>" . $data_author['author_name'] . "</option>";
}
// echo $authorOption;


$resCate = $gl_db->search_user_data("category", "cate_show", "1");

$cateOption = "";
foreach ($resCate as $data_cate) {
    $cateOption .= "<option value='" . $data_cate['cate_id'] . "'>" . $data_cate['cate_name'] . "</option>";
}
// echo $cateOption;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // print_r($resAuthor);
    // print_r($resCate);


    echo "<div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalToggleLabel'>Add Book</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>

                <div class='modal-body'>
                    <form action='' id='add-book-form' class='row g-3' method='post' enctype='multipart/form-data'>
                        <div class='col-12'>
                            <input type='text' class='form-control' id='add-book-title' name='add-book-title' placeholder='Title'>
                        </div>
                        <div class='col-12'>
                            <textarea class='form-control' id='add-book-desc' name='add-book-desc' placeholder='Description' rows='3'></textarea>
                        </div>
                        <div class='col-12'>
                            <input type='file' class='form-control' id='add-book-img' name='add-book-img' placeholder='Image'>
                        </div>
                        <div class='col-12'>
                            <select class='form-select' id='add-book-author' name='add-book-author' aria-label='Default select example'>
                                <option selected>Select Author</option>" . $authorOption . "
                            </select>
                        </div>
                        <div class='col-12'>
                            <select class='form-select' id='add-book-cate' name='add-book-cate' aria-label='Default select example'>
                                <option selected>Select Category</option>". $cateOption ."
                            </select>
                        </div>
                        <div class='col-12 text-center '>
                            <button id='add-book-btn' type='submit' class='btn btn-primary'>
                                Submit
                            </button>
                        </div>
                    </form>
                </div>";
}
