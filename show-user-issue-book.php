<?php

session_start();

if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true) {
    header("location:login.php");
    die();
}

$user_id = $_SESSION['user_id'];


require_once("./configs/connect.php");


$bookSQL = "SELECT issue.*, book.*, author.author_id, author.author_name, category.cate_id, category.cate_name  FROM issue 
            LEFT JOIN book ON issue.book_id = book.book_id LEFT JOIn author ON book.author_id = author.author_id 
            LEFT JOIN category ON book.cate_id = category.cate_id WHERE user_id = '$user_id' AND issue_show = '1'";

$resSelect = $gl_db->conn->query($bookSQL);
$data = $resSelect->fetch_all(MYSQLI_ASSOC);


foreach ($data as $book_data) {

    echo "<div class='listed-book-box'>
                            <img src='./uploads/" . $book_data['book_img'] . "' class='img-fluid' alt='book img'>
                            <h5 class='listed-book-title'>" . $book_data['book_title'] . "</h5>
                            <p class='listed-book-author'>" . $book_data['author_name'] . "</p>
                            <p class='listed-book-author'>" . $book_data['cate_name'] . "</p>
                            <!-- <p class='book-issue-date'>Issue: " . $book_data['issue_date'] . "</p>
                            <p class='book-return-date'>Not return: " . $book_data['return_date'] . "</p> -->
                        </div>";
}
