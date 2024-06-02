<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

$status = $_POST['status'];

if ($status == "ib") {

    $bookSQL = "SELECT issue.*, book.* FROM issue LEFT JOIN book ON issue.book_id = book.book_id WHERE issue_show = '1'";

    $resSelect = $gl_db->conn->query($bookSQL);
    $data = $resSelect->fetch_all(MYSQLI_ASSOC);


    foreach ($data as $issue_data) {

        echo "<div class='listed-book-box'>
                            <img src='../uploads/" . $issue_data['book_img'] . "' class='img-fluid' alt='book img'>
                            <h5 class='listed-book-title'>" . $issue_data['book_title'] . "</h5>
                            <div class='book-action'>
                                <button class='issued-book-view book-btn'  data-status='ib' data-id='" . $issue_data['issue_id'] . "' data-bs-target='#std-reg-modal-toggle' data-bs-toggle='modal'><i class='fa-regular fa-eye'></i></button>
                                <button class='issued-book-delete book-btn' data-id='" . $issue_data['issue_id'] . "'><i class='fa-regular fa-trash-can'></i></button>
                            </div>
                        </div>";
    }
} else {

    $bookSQL = "SELECT issue.*, book.* FROM issue LEFT JOIN book ON issue.book_id = book.book_id WHERE issue_status = 'not return' 
                AND issue_show = '1'";

    $resSelect = $gl_db->conn->query($bookSQL);
    $data = $resSelect->fetch_all(MYSQLI_ASSOC);


    foreach ($data as $issue_data) {

        echo "<div class='listed-book-box'>
                            <img src='../uploads/" . $issue_data['book_img'] . "' class='img-fluid' alt='book img'>
                            <h5 class='listed-book-title'>" . $issue_data['book_title'] . "</h5>
                            <div class='book-action'>
                                <button class='issued-book-view book-btn'  data-status='nrb' data-id='" . $issue_data['issue_id'] . "' data-bs-target='#std-reg-modal-toggle' data-bs-toggle='modal'><i class='fa-regular fa-eye'></i></button>
                                <!-- <button class='issued-book-delete book-btn' data-id='" . $issue_data['issue_id'] . "'><i class='fa-regular fa-trash-can'></i></button> -->
                            </div>
                        </div>";
    }
}
