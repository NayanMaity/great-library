<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

$issue_id = $_POST['id'];
$issue_status = $_POST['status'];


$bookSQL = "SELECT issue.*, book.*, user.*, author.author_name, category.cate_name FROM issue LEFT JOIN book ON issue.book_id = book.book_id 
            LEFT JOIN author ON book.author_id = author.author_id LEFT JOIN category ON book.cate_id = category.cate_id LEFT JOIN user ON
            issue.user_id = user.user_id WHERE issue_id = '$issue_id' AND issue_show = '1'";

$resSelect = $gl_db->conn->query($bookSQL);
$data = $resSelect->fetch_all(MYSQLI_ASSOC);


if ($issue_status == "ib") {

    foreach ($data as $issue_data) {

        echo " <div class='modal-header'>
            <h1 class='modal-title fs-5' id='exampleModalToggleLabel2'>Book Edit</h1>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
            <form action='' class='row g-3'> 
                <div class='col-12'>
                    <label class='form-label'>Image</label>
                    <img src='../uploads/" . $issue_data['book_img'] . "' class='img-fluid' style='width:100px; display:block;'>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Title</label>
                    <input type='text' class='form-control' id='book-title' name='book-title' value='" . $issue_data['book_title'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Author</label>
                    <input type='text' class='form-control' id='book-author' name='book-author' value='" . $issue_data['author_name'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Category</label>
                    <input type='text' class='form-control' id='book-cate' name='book-cate' value='" . $issue_data['cate_name'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>User Name</label>
                    <input type='text' class='form-control' id='user-name' name='user-name' value='" . $issue_data['user_name'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>User Email</label>
                    <input type='text' class='form-control' id='user-email' name='user-email' value='" . $issue_data['user_email'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Issue Status</label>
                    <input type='text' class='form-control' id='issue_status' name='issue_status' value='" . $issue_data['issue_status'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Issue Date</label>
                    <input type='text' class='form-control' id='issue_date' name='issue_date' value='" . $issue_data['issue_date'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Return Date</label>
                    <input type='text' class='form-control' id='return_date' name='return_date' value='" . $issue_data['return_date'] . "' disabled>
                </div>
                ";
    }
} else {

    foreach ($data as $issue_data) {

        echo " <div class='modal-header'>
            <h1 class='modal-title fs-5' id='exampleModalToggleLabel2'>Book Edit</h1>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
            <form action='' id='issue-book-update-form' method='post' class='row g-3'> 
                <div class='col-12'>
                    <input type='hidden' class='form-control' id='issue-book-id' name='issue-book-id' value='" . $issue_data['issue_id'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Image</label>
                    <img src='../uploads/" . $issue_data['book_img'] . "' class='img-fluid' style='width:100px; display:block;'>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Title</label>
                    <input type='text' class='form-control' id='issue-book-title' name='issue-book-title' value='" . $issue_data['book_title'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Author</label>
                    <input type='text' class='form-control' id='issue-book-author' name='issue-book-author' value='" . $issue_data['author_name'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Category</label>
                    <input type='text' class='form-control' id='issue-book-cate' name='issue-book-cate' value='" . $issue_data['cate_name'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>User Name</label>
                    <input type='text' class='form-control' id='issue-user-name' name='issue-user-name' value='" . $issue_data['user_name'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>User Email</label>
                    <input type='text' class='form-control' id='issue-user-email' name='issue-user-email' value='" . $issue_data['user_email'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Issue Status</label>
                    <select class='form-select' id='issue-book-status' name='issue-book-status' aria-label='Default select example'>
                        <option value='not return' selected>Not Return</option>
                        <option value='return'>Return</option>
                    </select>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Issue Date</label>
                    <input type='text' class='form-control' id='issue_date' name='issue_date' value='" . $issue_data['issue_date'] . "' disabled>
                </div>
                <div class='col-12'>
                    <label class='form-label'>Return Date</label>
                    <input type='text' class='form-control' id='return_date' name='return_date' value='" . $issue_data['return_date'] . "' disabled>
                </div>
                <div class='col-12 text-center'>
                    <button type='submit' class='btn btn-primary'>
                        Update
                    </button>
                </div>
                ";
    }
}
