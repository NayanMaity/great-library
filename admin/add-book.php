<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $title = test_input($_POST['title']);
    $desc = test_input($_POST['desc']);
    $img = $_FILES['add-book-img']['name'];
    $author = test_input($_POST['author']);
    $cate = test_input($_POST['cate']);


    $err_msg = [];

    if (empty($title) || empty($desc) || empty($img) || empty($author) || empty($cate)) {

        $err_msg['emt_err'] = "emt_err";
        echo $err_msg['emt_err'];
    } else {

        if (count($err_msg) == 0) {

            if (!empty($_FILES['add-book-img']['name'])) {

                $books = $gl_db->get("book");
                $numBooks = count($books);

                $cate_data = $gl_db->search_user_data("category", "cate_id", $cate)[0];
                $cateName =  $cate_data['cate_name'];

                $img = "book_" . time() . "_" . str_replace(" ", "_", $cateName) . "_" . $numBooks . "_" . $_FILES['book-update-img']['name'];
                move_uploaded_file($_FILES['book-update-img']['tmp_name'], "../uploads/" . $img);

                // $img = time() . "_" . str_replace(" ", "_", $title) . "_" . $_FILES['add-book-img']['name'];
                // move_uploaded_file($_FILES['add-book-img']['tmp_name'], "../uploads/" . $img);
            }

            date_default_timezone_set("Asia/Kolkata");
            $create_date = date("y-m-d H:i:s");
            $update_date = date("y-m-d H:i:s");

            $data = [
                "book_title" => $title,
                "book_desc" => $desc,
                "book_img" => $img,
                "author_id" => $author,
                "cate_id" => $cate,
                "create_book_data" => $create_date,
                "update_book_data" => $update_date
            ];

            $type = "sssssss";

            echo $gl_db->insert("book", $data, $type);
        }
    }
}
