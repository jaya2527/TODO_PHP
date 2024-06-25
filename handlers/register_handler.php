<?php
include '../db_connection/db.php';
include '../utils/util.php';
include '../model/users.php';

session_start();

$errors = [];
$iserror = false;
$_SESSION['first_error'] = [];
if (isset($_POST['first_name'])) {

    if (empty($_POST['first_name'])) {
        $_SESSION['first_error'][] = "First Name is required";
    }
    $first_name = $_POST['first_name'];
    if (!preg_match("/^[a-zA-Z]*$/", $first_name))
        $_SESSION['first_error'][] = "Only letters and white space allowed";
    if (count($_SESSION['first_error'])) {
        $iserror = true; //indicate that an error has occurred
    }
}

$_SESSION['last_error'] = [];
if (isset($_POST['last_name'])) {
    //check for empty
    if (empty($_POST['last_name'])) {
        $_SESSION['last_error'][] = "Last Name is required";
    }
    $last_name = $_POST['last_name'];
    if (!preg_match("/^[a-zA-Z]*$/", $last_name))
        $_SESSION['last_error'][] = "Only letters and white space allowed";
    if (count($_SESSION['last_error'])) {
        $iserror = true;
    }
}

$_SESSION['number_error'] = [];
if (isset($_POST['phone_number'])) {
    if (empty($_POST['phone_number'])) {
        $_SESSION['number_error'][] = "Phone Number is required";

    }
    $phone_number = $_POST['phone_number'];
    ///^[0-9]{10}+$/
    if (!preg_match("/^[0-9]{10}+$/", $phone_number))  //i can also write this way $_POST['username']
        $_SESSION['number_error'][] = "Please Enter Valid Phone Number";
    if (count($_SESSION['number_error'])) {
        $iserror = true;
    }
}
$_SESSION['user_error'] = [];
if (isset($_POST['username'])) {
    //check for empty
    if (empty($_POST['username'])) {
        $_SESSION['user_error'][] = "Username is required";
    }
    //check for length long and short
    if (strlen($_POST['username']) < 4) {
        $_SESSION['user_error'][] = 'Username is too short ';
    }
    //check for pattern
    $username = $_POST['username'];
    if (!preg_match("/^[a-zA-Z]*$/", $username))  //i can also write this way $_POST['username']
        $_SESSION['user_error'][] = "Only letters and white space allowed";
    if (count($_SESSION['user_error'])) {
        $iserror = true;
    }
}
$_SESSION['password_error'] = [];
if (isset($_POST['password'])) {
    if (empty($_POST['password'])) {
        $_SESSION['password_error'] [] = "Password is required";
//    $iserror = true;
    }
    $password = $_POST['password'];
    if (!preg_match("#[A-Z]+#", $password))
        $_SESSION['password_error'][] = "Your Password Must Contain At Least 1 Capital Letter!";
    if (count($_SESSION['password_error'])) {
        $iserror = true;
    }
}
$_SESSION['image_error'] = [];
$file_response=''; //globally
if (isset($_FILES['file_path'])) {
    $file_response = upload($_FILES['file_path']);

    if ($file_response['error']) {
        $_SESSION['image_error'][] = $file_response['message'];
        $iserror = true;
    }

    if ($iserror) {
        redirect('registration', 'error=true');
    }
}
$registerUserData = [
    'first_name'=>$_POST['first_name'],
    'file' => $file_response,
];

insert_users_details($registerUserData);


