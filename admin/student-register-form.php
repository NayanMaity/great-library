<?php

session_start();

if (!isset($_SESSION['admin_login_status']) || $_SESSION['admin_login_status'] !== true || $_SESSION['user_role'] !== "admin") {
    header("location:login.php");
    die();
}

echo "<div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalToggleLabel'>Student Registation</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>

                <div class='modal-body'>
                    <form action='' id='std-reg-form' class='row g-3' method='post' enctype='multipart/form-data'>
                        <div class='col-12'>
                            <input type='text' class='form-control' id='std-reg-name' name='std-reg-name' placeholder='Name'>
                        </div>
                        <div class='col-12'>
                            <input type='text' class='form-control' id='std-reg-email' name='std-reg-email' placeholder='Email'>
                        </div>
                        <div class='col-12'>
                            <input type='file' class='form-control' id='std-reg-avatar' name='std-reg-avatar' placeholder='Avatar'>
                        </div>
                        <div class='col-12 text-center '>
                            <button id='std-reg-btn' type='submit' class='btn btn-primary'>
                                Submit
                            </button>
                        </div>
                    </form>
                </div>";
