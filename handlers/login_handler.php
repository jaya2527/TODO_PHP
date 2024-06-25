<?php
require_once('../db_connection/db.php');
require_once('../utils/util.php');
include '../model/tasks.php';
include '../model/users.php';
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("Location: /index.php");
    exit;
}

$errors = [];
$isError = false;
$_SESSION['u_error'] = [];

if (isset($_POST['username'])) {
    // Check for empty username
    if (empty($_POST['username'])) {
        $_SESSION['u_error'][] = "Username is required";
        $isError = true;
    }
}

$_SESSION['pass_error'] = [];

if (isset($_POST['password'])) {
    // Check for empty password
    if (empty($_POST['password'])) {
        $_SESSION['pass_error'][] = "Password is required";
        $isError = true;
    }
}

if ($isError) {
    redirect('login', 'error=true');
    exit;
}

get_user_by_username();









