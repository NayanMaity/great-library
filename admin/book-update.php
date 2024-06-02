<?php

require_once("../configs/connect.php");

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true) {
    header("location:login.php");
    die();
}

$err_msg = [];

$book_id = $_POST['id'];

$book_data = ($gl_db->search_user_data("book", "book_id", $book_id))[0];

// print_r($book_data);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $img = $book_data['book_img'];
    // $img = $_FILES['book-update-img']['name'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $author = $_POST['author'];
    $cate = $_POST['cate'];

    if (empty($title) || empty($desc)) {
        $err_msg['emt_err'] = "emt_err";
        echo $err_msg['emt_err'];
    } else {

        if (!empty($_FILES['book-update-img']['name'])) {

            $books = $gl_db->get("book");
            $numBooks = count($books);

            $cate_data = $gl_db->search_user_data("category", "cate_id", $cate)[0];
            $cateName =  $cate_data['cate_name'];

            unlink("../uploads/" . $img);

            $img = "book_" . time() . "_" . str_replace(" ", "_", $cateName) . "_" . $numBooks . "_" . $_FILES['book-update-img']['name'];
            move_uploaded_file($_FILES['book-update-img']['tmp_name'], "../uploads/" . $img);
        }

        date_default_timezone_set("Asia/Kolkata");
        $update_data = date("y-m-d H:i:s");

        $updateSQL = "UPDATE book SET book_title='$title', book_desc='$desc', book_img='$img', author_id='$author', cate_id='$cate',
                      update_book_data='$update_data' WHERE book_id='$book_id'";

        if ($gl_db->conn->query($updateSQL)) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
