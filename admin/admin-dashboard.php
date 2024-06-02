<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

// print_r($_SESSION['user_role']);

require_once("../configs/connect.php");

$selectUser = $gl_db->search_user_data("user", "user_show", "1");
// $countUser = $gl_db->conn->query($selectUser);

$selectCate = $gl_db->search_user_data("category", "cate_show", "1");
// print_r($selectCate);

$selectAuthor =  $gl_db->search_user_data("author", "author_show", "1");
// $countAuthor = $gl_db->conn->query($selectAuthor);

$selectBook = $gl_db->search_user_data("book", "book_show", "1");
// $countBook = $gl_db->conn->query($selectBook);

$selectIssueBook = $gl_db->search_user_data("issue", "issue_show", "1");
// echo mysqlI_num_rows($resUser);

$selectNRB = "SELECT * FROM issue WHERE issue_status = 'not return' AND issue_show='1'";
$resNRB = $gl_db->conn->query($selectNRB);
$data_NRB = $resNRB->fetch_all(MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Great Library</title>

    <link rel="stylesheet" href="../assets/css/style.css">

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
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach ($selectCate as $cate) : ?>
                                    <li><span class="dropdown-item dropdown-cate" data-cateId="<?php echo $cate['cate_id'] ?>"><?php echo $cate['cate_name'] ?></span></li>
                                <?php endforeach ?>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <span class="nav-link main-info-author-box">Authors</span>
                        </li>

                        <li class="nav-item">
                            <span class="nav-link main-info-book-box">Books</span>
                        </li>

                        <li class="nav-item">
                            <span class="nav-link issue-book-info-box">Issued Book</span>
                        </li>

                        <li class="nav-item">
                            <span class="nav-link add-std" data-bs-target="#std-reg-modal-toggle" data-bs-toggle="modal">Student
                                Registation</span>
                        </li>

                        <li class="nav-item">
                            <span id="admin-account-show-btn" class="nav-link" data-bs-target="#account-modal-toggle" data-bs-toggle="modal">Account</span>
                        </li>

                        <!-- <li class="nav-item">
                            <span class="nav-link">Logout</span>
                        </li> -->


                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Start Student Register Modal -->
    <div class="modal fade" id="std-reg-modal-toggle" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modal-content-1" class="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="std-reg-modal-2-toggle" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div id="modal-content-2" class="modal-content">

            </div>
        </div>
    </div>
    <!-- End Student Register Modal -->

    <!--Start Account Modal -->
    <div class="modal fade" id="account-modal-toggle" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="admin-profile-show">

                    </form>
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-center">
                    <button id="admin-profile-edit-btn" class="btn btn-primary" data-bs-target="#account-update-modal-toggle" data-bs-toggle="modal">
                        Edit Profile
                    </button>

                    <button id="admin-logout-btn" class="btn btn-danger">Logout</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="account-update-modal-toggle" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Profile Update</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="admin-profile-edit-form" class="row g-3" method="post" enctype="multipart/form-data">

                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#account-modal-toggle" data-bs-toggle="modal">
                        profile
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--End Account Modal -->

    <section id="main">
        <div class="container-lg">
            <div class="main-inner">
                <h3 class="main-head">Admin Dashboard</h3>

                <div class="row main-info g-4">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="main-info-box main-info-book-box listed-book-info-box">
                            <i class="fa-solid fa-book"></i>
                            <p id="listed-book-count" class="main-info-box-count"><?php echo count($selectBook) ?></p>
                            <p class="main-info-box-title">Listed Books</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="main-info-box issue-book-info-box">
                            <i class="fa-solid fa-book-open-reader"></i>
                            <p id="issue-book-count" class="main-info-box-count"><?php echo count($selectIssueBook) ?></p>
                            <p class="main-info-box-title">Book Issued</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="main-info-box  not-return-book-info-box">
                            <i class="fa-solid fa-recycle"></i>
                            <p id="not-return-book-count" class="main-info-box-count"><?php echo count($data_NRB) ?></p>
                            <p class="main-info-box-title">Books Not Returend Yet</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="main-info-box reg-user-info-box">
                            <i class="fa-solid fa-users"></i>
                            <p id="reg-user-count"><?php echo count($selectUser) ?></p>
                            <p class="main-info-box-title">Registered Users</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="main-info-box main-info-author-box lisetd-author-info-box">
                            <i class="fa-solid fa-user-pen"></i>
                            <p id="lisetd-author-count"><?php echo count($selectAuthor) ?></p>
                            <p class="main-info-box-title">Listed Author</p>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="main-info-box listed-gategory-info-box">
                            <i class="fa-solid fa-list"></i>
                            <p id="listed-gategory-count"><?php echo count($selectCate) ?></p>
                            <p class="main-info-box-title">Listed Categories</p>
                        </div>
                    </div>
                </div>

                <div class="main-table-inner main-table-inner-user">
                    <div class="row g-4  main-table-inner-head">
                        <div class="col-12 col-sm-6">
                            <h6>Registered User</h6>
                        </div>

                        <div class="col-12 col-sm-6 d-flex justify-content-start  justify-content-sm-end">
                            <input type="text" class="form-control" name="" id="registred-user-search" placeholder="Search user">
                        </div>
                    </div>

                    <div class="text-end mt-2"><span id="add-user" class="add-std" data-bs-target="#std-reg-modal-toggle" data-bs-toggle="modal">+ Add user</span></div>

                    <div id="registred-user" class="registred-user d-flex flex-column justify-content-start">

                    </div>
                </div>

                <div class="main-table-inner main-table-inner-cate">
                    <div class="row g-4  main-table-inner-head">
                        <div class="col-12 col-sm-6">
                            <h6>Listed categories</h6>
                        </div>

                        <div class="col-12 col-sm-6 d-flex justify-content-start  justify-content-sm-end">
                            <input type="text" class="form-control" name="" id="list-cate-search" placeholder="Search categories">
                        </div>
                    </div>

                    <div class="text-end mt-2"><span id="add-cate" class="add-cate" data-bs-target="#std-reg-modal-toggle" data-bs-toggle="modal">+ Add category</span></div>

                    <div id="listed-categories" class="listed-categories d-flex flex-column justify-content-start">

                    </div>
                </div>

                <div class="main-table-inner main-table-inner-book">
                    <div class="row g-4  main-table-inner-head">
                        <div class="col-12 col-sm-6">
                            <h6>Listed Books</h6>
                        </div>
                        <div class="col-12 col-sm-6 d-flex justify-content-start  justify-content-sm-end">
                            <input type="text" class="form-control" name="" id="list-book-search" placeholder="Search books">
                        </div>
                    </div>

                    <div class="text-end mt-2"><span id="add-book" class="add-cate" data-bs-target="#std-reg-modal-toggle" data-bs-toggle="modal">+ Add Book</span></div>

                    <div id="listed-book" class="listed-books d-flex flex-wrap justify-content-start  ">
                    </div>
                </div>

                <div class="main-table-inner main-table-inner-issued-book">
                    <div class="row g-4  main-table-inner-head">
                        <div class="col-12 col-sm-6">
                            <h6>Issued Books</h6>
                        </div>
                        <div class="col-12 col-sm-6 d-flex justify-content-start justify-content-sm-end">
                            <!-- <input type="text" class="form-control" name="" id="issued-book-search" placeholder="Search books"> -->
                        </div>
                    </div>

                    <!-- <div class="text-end mt-2"><span id="add-book" class="add-cate" data-bs-target="#std-reg-modal-toggle" data-bs-toggle="modal">+ Add Book</span></div> -->

                    <div id="listed-issued-book" class="listed-books d-flex flex-wrap justify-content-start  ">
                        <!-- <div class="listed-book-box">
                            <img src="../assets/images/books/com-1.jpg" class="img-fluid" alt="">
                            <h5 class="listed-book-title">Le langage C</h5>
                            <p class="listed-book-author">By Brian W. Kernighan</p>
                            <p class="book-issue-date">Issue: 20-20-20</p>
                            <p class="book-return-date">Not return: 30-20-20</p>
                        </div> -->
                    </div>
                </div>

                <div class="main-table-inner main-table-inner-author">
                    <div class="row g-4  main-table-inner-head">
                        <div class="col-12 col-sm-6">
                            <h6>Listed Author</h6>
                        </div>

                        <div class="col-12 col-sm-6 d-flex justify-content-start  justify-content-sm-end">
                            <input type="text" class="form-control" name="" id="list-author-search" placeholder="Search Authors">
                        </div>
                    </div>

                    <div class="text-end mt-2"><span id="add-author" class="add-cate" data-bs-target="#std-reg-modal-toggle" data-bs-toggle="modal">+ Add Author</span></div>

                    <div id="listed-author">

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="std-reg-popup">
        <div class="popup-box">
            <div class="row g-4">
                <div class="col-12 text-end">
                    <button id="close-popup"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <div id="std-reg-popup-msg" class="col-12 text-center mb-4">
                    <i class="fa-solid fa-circle-check"></i> Register Successfull
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/app.js"></script>
</body>

</html>