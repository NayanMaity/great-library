<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

$search = $_POST['search'];

$selectSQL = "SELECT * FROM author WHERE author_show='1' AND author_name LIKE '%{$search}%'";

// $resSelect = $gl_db->search_user_data("author", "author_show", "1");

$resSelect = $gl_db->conn->query($selectSQL);

$data = $resSelect->fetch_all(MYSQLI_ASSOC);

if (count($data) > 0) {

    foreach ($resSelect as $author_data) {

        echo "<div class='d-flex align-items-center justify-content-between'>
                                <h5 class='listed-author-title'>" . $author_data['author_name'] . "</h5>
    
                                <div class='listed-author-action'>
                                    <button class='edit-author' data-id='" . $author_data['author_id'] . "' data-bs-target='#std-reg-modal-toggle' data-bs-toggle='modal'>Edit</button>
                                    <button class='delete-author' data-id='" . $author_data['author_id'] . "'>delete</button>
                                </div>
                            </div>";
    }
} else {

    echo "<h4>No record found.</h4>";
}
