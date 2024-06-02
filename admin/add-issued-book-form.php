<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $book_id = $_POST['book_id'];

    echo "<div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalToggleLabel'>Issue Book</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
    
                    <div class='modal-body'>
                        <form action='' id='add-issued-book-form' class='row g-3' method='post'>
                            <div class='col-12'>
                                <input type='hidden' class='form-control' id='add-issued-book-id' name='add-issued-book-id' value='". $book_id ."'>
                            </div>
                            <div class='col-12'>
                                <input type='text' class='form-control' id='add-issued-book-email' name='add-issued-book-email' placeholder='User email'>
                            </div>
                            <div class='col-12 text-center '>
                                <button id='add-issued-book-btn' type='submit' class='btn btn-primary'>
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>";
}
