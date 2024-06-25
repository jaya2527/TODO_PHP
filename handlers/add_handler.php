

<?php
session_start();
include '../db_connection/db.php';
include '../utils/util.php';
include '../model/tasks.php';

is_user_loggedin();

$errors = [];
if (isset($_POST['action']) == "add_task" && empty($_POST['task'])) {
    $_SESSION['task_error'] = "Task is required";

    redirect('index');
}
unset($_SESSION['task_error']);


if (isset($_POST['action']) && $_POST["action"] == "add_task") {
    $params = '';
    if (!addTask($_POST['task'])) {
        $_SESSION['task_error'] = "Something went wrong";
        $params = 'error=true';
    }
    redirect('index', $params);
}

if (isset($_POST['action']) && $_POST["action"] == "update") {
    if (!isset ($_POST["task"], $_POST["id"]) && empty($_POST["task"]) && empty($_POST["id"])) {

        $_SESSION['update_error'][$_POST["task_id"]] = "Update is required";
        redirect('index');
    }
    updateTask('task');

    redirect('index');
}

if (isset($_GET['action']) && $_GET["action"] == "delete") {
    $params = '';
    if (!deleteTask($_POST['task'])) {
//    if (!isset($_GET["id"]) && empty($_GET["id"])) {
        $_SESSION ['task_error'] = "ID is required";
        $params = 'error_true';
    }
    redirect('index', $params);
}

if (isset($_GET['action']) && $_GET["action"] == "markAs") {
    if (isset($_GET['checked'])) {
        mask_as($_GET['id'],$_GET['checked']);
    }
    redirect('index');
}

