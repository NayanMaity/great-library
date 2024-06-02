<?php

require_once("./configs/connect.php");

session_start();

if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true) {
    header("location:login.php");
    die();
}

$id = $_POST['id'];

$selectBook = "SELECT book.*, author.author_name, category.cate_name FROM book LEFT JOIN author ON book.author_id = author.author_id 
               LEFT JOIN category ON book.cate_id = category.cate_id WHERE book_id='$id'";

$resSelect = $gl_db->conn->query($selectBook);
$data = $resSelect->fetch_all(MYSQLI_ASSOC)[0];


echo "  <div class='modal-header'>
            <h1 class='modal-title fs-5' id='exampleModalToggleLabel2'>Book Details</h1>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
            <form action='' class='row g-3'>
                <div class='col-12'>
                    <label class='form-label'>Image</label>
                    <img src='./uploads/" . $data['book_img'] . "' class='img-fluid' style='width:100px; display:block;'>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Title</label>
                    <input type='text' class='form-control' id='book-title' name='book-title' value='" . $data['book_title'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Description</label>
                    <textarea class='form-control' id='book-desc' name='book-desc' rows='5' disabled> " . $data['book_desc'] . " </textarea>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Author</label>
                    <input type='text' class='form-control' id='book-author' name='book-author' value='" . $data['author_name'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Category</label>
                    <input class='form-control' id='book-cate' name='book-cate' value='" . $data['cate_name'] . "' disabled>
                </div>
            </form>
        </div>";
