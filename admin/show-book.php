<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

if (isset($_POST['cate_id'])) {

    $cate_id = $_POST['cate_id'];

    $bookSQL = "SELECT book.*, author.author_id, author.author_name, category.cate_id, category.cate_name  FROM book LEFT JOIN author ON 
            book.author_id = author.author_id LEFT JOIN category ON book.cate_id = category.cate_id WHERE book_show = '1' AND book.cate_id = '$cate_id'";

    $resSelect = $gl_db->conn->query($bookSQL);
    $data = $resSelect->fetch_all(MYSQLI_ASSOC);


    foreach ($data as $book_data) {

        echo "<div class='listed-book-box'>
                            <img src='../uploads/" . $book_data['book_img'] . "' class='img-fluid' alt='book img'>
                            <h5 class='listed-book-title'>" . $book_data['book_title'] . "</h5>
                            <p class='listed-book-author'>" . $book_data['author_name'] . "</p>
                            <p class='listed-book-author'>" . $book_data['cate_name'] . "</p>
                            <div class='book-action'>
                                <button class='book-edit book-btn' data-id='" . $book_data['book_id'] . "' data-bs-target='#std-reg-modal-toggle' data-bs-toggle='modal'><i class='fa-regular fa-pen-to-square'></i></button>
                                <button class='book-delete book-btn' data-id='" . $book_data['book_id'] . "'><i class='fa-regular fa-trash-can'></i></button>
                                <button class='book-issue book-btn' data-id='" . $book_data['book_id'] . "' data-bs-target='#std-reg-modal-toggle' data-bs-toggle='modal'><i class='fa-solid fa-file-circle-plus'></i></button>
                            </div>
                        </div>";
    }
} else {

    $bookSQL = "SELECT book.*, author.author_id, author.author_name, category.cate_id, category.cate_name  FROM book LEFT JOIN author ON 
            book.author_id = author.author_id LEFT JOIN category ON book.cate_id = category.cate_id WHERE book_show = '1'";

    $resSelect = $gl_db->conn->query($bookSQL);
    $data = $resSelect->fetch_all(MYSQLI_ASSOC);


    foreach ($data as $book_data) {

        echo "<div class='listed-book-box'>
                            <img src='../uploads/" . $book_data['book_img'] . "' class='img-fluid' alt='book img'>
                            <h5 class='listed-book-title'>" . $book_data['book_title'] . "</h5>
                            <p class='listed-book-author'>" . $book_data['author_name'] . "</p>
                            <p class='listed-book-author'>" . $book_data['cate_name'] . "</p>
                            <div class='book-action'>
                                <button class='book-edit book-btn' data-id='" . $book_data['book_id'] . "' data-bs-target='#std-reg-modal-toggle' data-bs-toggle='modal'><i class='fa-regular fa-pen-to-square'></i></button>
                                <button class='book-delete book-btn' data-id='" . $book_data['book_id'] . "'><i class='fa-regular fa-trash-can'></i></button>
                                <button class='book-issue book-btn' data-id='" . $book_data['book_id'] . "' data-bs-target='#std-reg-modal-toggle' data-bs-toggle='modal'><i class='fa-solid fa-file-circle-plus'></i></button>
                            </div>
                        </div>";
    }
}
