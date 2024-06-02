<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    echo "<div class='modal-header'>
                        <h1 class='modal-title fs-5' id='exampleModalToggleLabel'>Add Author</h1>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
    
                    <div class='modal-body'>
                        <form action='' id='add-author-form' class='row g-3' method='post'>
                            <div class='col-12'>
                                <input type='text' class='form-control' id='add-author-name' name='add-author-name' placeholder='Name'>
                            </div>
                            <div class='col-12 text-center '>
                                <button id='add-author-btn' type='submit' class='btn btn-primary'>
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>";
}
