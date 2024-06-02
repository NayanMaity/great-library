<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

require_once("../configs/connect.php");

$search = $_POST['search'];

$selectSQL = "SELECT * FROM category WHERE cate_show='1' AND cate_name LIKE '%{$search}%'";

// $resSelect = $gl_db->search_user_data("category", "cate_show", "1");

$resSelect = $gl_db->conn->query($selectSQL);

$data = $resSelect->fetch_all(MYSQLI_ASSOC);

if (count($data) > 0) {

    foreach ($resSelect as $cate_data) {

        echo "<div class='listed-cate-box d-flex flex-wrap align-items-center justify-content-between'>
                                <h5 class='listed-cate-title'>" . $cate_data['cate_name'] . "</h5>
                                <div class='listed-cate-action'>
                                    <button class='view-category' data-id='" . $cate_data['cate_id'] . "' data-bs-target='#std-reg-modal-toggle' data-bs-toggle='modal'>View</button>
                                    <button class='delete-category' data-id='" . $cate_data['cate_id'] . "'>delete</button>
                                </div>
                            </div>";
    }
} else {

    echo "<h4>No record found.</h4>";
}
