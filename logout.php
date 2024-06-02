<?php

session_start();

if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true) {
    header("location:login.php");
    die();
}

session_unset();
session_destroy();
header("location:login.php");
