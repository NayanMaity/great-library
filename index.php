<?php

require_once("./configs/connect.php");

session_start();

if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true) {
    header("location:login.php");
    die();
}

$user_id = $_SESSION['user_id'];

$selectIssueBook = $gl_db->search_user_data("issue", "issue_show", "1");

$selectIssueBook = "SELECT * FROM issue WHERE user_id = '$user_id' AND issue_show='1'";
$resIssue = $gl_db->conn->query($selectIssueBook);
$data_issue = $resIssue->fetch_all(MYSQLI_ASSOC);


$selectNRB = "SELECT * FROM issue WHERE issue_status = 'not return' AND user_id = '$user_id' AND issue_show='1'";
$resNRB = $gl_db->conn->query($selectNRB);
$data_NRB = $resNRB->fetch_all(MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Great Library</title>

    <link rel="stylesheet" href="./assets/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <header>
        <div class="container-lg ">
            <nav class="navbar navbar-expand-lg navbar-dark ">
                <!-- <div class="container-fluid"> -->
                <a class="navbar-brand" href="#">
                    <i class="fa-solid fa-book-open"></i> Great Library
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <span class="nav-link book-list-link">Listed Books</span>
                        </li>

                        <li class="nav-item">
                            <span id="user-account-show-btn" class="nav-link" data-bs-target="#account-modal-toggle" data-bs-toggle="modal">Account</span>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!--Start Account Modal -->
    <div class="modal fade" id="account-modal-toggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="user-profile-show">

                    </form>
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-center">
                    <button id="user-profile-edit-btn" class="btn btn-primary" data-bs-target="#account-update-modal-toggle" data-bs-toggle="modal">
                        Edit Profile
                    </button>

                    <button id="logout-btn" class="btn btn-danger">Logout</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="account-update-modal-toggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Profile Update</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="user-profile-edit-form" class="row g-3" method="post" enctype="multipart/form-data">

                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#account-modal-toggle" data-bs-toggle="modal">
                        Profile
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--End Account Modal -->

    <div class="modal fade" id="book-details-modal-toggle" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modal-content-book" class="modal-content">

            </div>
        </div>
    </div>

    <section id="main">
        <div class="container-lg">
            <div class="main-inner">
                <h3 class="main-head">Student Dashboard</h3>

                <div class="row main-info g-4">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="main-info-box issue-book-info-box-user">
                            <i class="fa-solid fa-book"></i>
                            <p id="issue-book-count" class="main-info-box-count"><?php echo count($data_issue); ?></p>
                            <p class="main-info-box-title">Book Issued</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="main-info-box not-return-book-info-box-user">
                            <i class="fa-solid fa-recycle"></i>
                            <p id="not-return-book-count" class="main-info-box-count"><?php echo count($data_NRB) ?></p>
                            <p class="main-info-box-title">Books Not Returend Yet</p>
                        </div>
                    </div>
                </div>

                <div class="main-table-inner main-table-inner-book-user">
                    <div class="row g-4  main-table-inner-head">
                        <div class="col-12 col-sm-6">
                            <h6>Listed Books</h6>
                        </div>
                        <div class="col-12 col-sm-6 d-flex justify-content-start  justify-content-sm-end">
                            <input type="text" class="form-control" name="" id="list-book-search-user" placeholder="Search books">
                        </div>
                    </div>

                    <div id="listed-book-user" class="listed-books d-flex flex-wrap justify-content-start">
                    </div>
                </div>

                <div class="main-table-inner main-table-inner-issue-book-user">
                    <div class="row g-4  main-table-inner-head">
                        <div class="col-12 col-sm-6">
                            <h6>Listed Books</h6>
                        </div>
                        <div class="col-12 col-sm-6 d-flex justify-content-start  justify-content-sm-end">
                            <input type="text" class="form-control" name="" id="issue-book-search-user" placeholder="Search books">
                        </div>
                    </div>

                    <div id="issue-book-user" class="listed-books d-flex flex-wrap justify-content-start  ">
                    </div>
                </div>

                <div class="main-table-inner main-table-inner-nrb-book-user">
                    <div class="row g-4  main-table-inner-head">
                        <div class="col-12 col-sm-6">
                            <h6>Listed Books</h6>
                        </div>
                        <div class="col-12 col-sm-6 d-flex justify-content-start  justify-content-sm-end">
                            <input type="text" class="form-control" name="" id="nrb-book-search-user" placeholder="Search books">
                        </div>
                    </div>

                    <div id="nrb-book-user" class="listed-books d-flex flex-wrap justify-content-start  ">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="home-popup">
        <div class="popup-box">
            <div class="row g-4">
                <div class="col-12 text-end">
                    <button id="close-popup"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <div id="home-popup-msg" class="col-12 text-center mb-4">

                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="./assets/js/app.js"></script>
</body>

</html>