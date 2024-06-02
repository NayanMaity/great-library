<?php

session_start();

if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true) {
    header("location:login.php");
    die();
}

require_once("./configs/connect.php");



$bookSQL = "SELECT book.*, author.author_id, author.author_name, category.cate_id, category.cate_name  FROM book LEFT JOIN author ON 
            book.author_id = author.author_id LEFT JOIN category ON book.cate_id = category.cate_id WHERE book_show = '1'";

$resSelect = $gl_db->conn->query($bookSQL);
$data = $resSelect->fetch_all(MYSQLI_ASSOC);


foreach ($data as $book_data) {

    echo "<div class='listed-book-box'>
                            <img src='./uploads/" . $book_data['book_img'] . "' class='img-fluid' alt='book img'>
                            <h5 class='listed-book-title'>" . $book_data['book_title'] . "</h5>
                            <p class='listed-book-author'>" . $book_data['author_name'] . "</p>
                            <p class='listed-book-author'>" . $book_data['cate_name'] . "</p>
                            <div class='book-action'>
                                <button class='user-book-view book-btn' data-id='" . $book_data['book_id'] . "' data-bs-target='#book-details-modal-toggle' data-bs-toggle='modal'><i class='fa-regular fa-eye'></i></button>
                            </div>
                        </div>";
}
