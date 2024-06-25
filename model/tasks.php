<?php
function addTask($taskName)
{
    include '../db_connection/db.php';
    $user_id = $_SESSION['user_id'];

    $stmt = $connect->prepare("INSERT INTO tasks (user_id, task) VALUES (:user_id, :taskName)");

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':taskName', $taskName);
    $stmt->execute();
    if (!$connect->prepare()) {
        return true;
    }
    return false;
}
function updateTask($taskName)
{
    include '../db_connection/db.php';
    $task_id = $_POST["task_id"];
    $task = $_POST["task"];
    $user_id = $_SESSION['user_id'];
    $stmt = $connect->prepare("UPDATE tasks SET task=:task WHERE id=:task_id AND user_id=:user_id");

    $stmt->bindParam(':task', $task);
    $stmt->bindParam(':task_id', $task_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    if ($connect->prepare() !== TRUE) {
        echo "Error updating record: " . $connect->error;
    }
}

function deleteTask($taskName)
{
    include '../db_connection/db.php';
    $user_id = $_SESSION['user_id'];
    $task_id = $_GET["id"];
    $stmt = $connect->prepare("DELETE from tasks WHERE id=:task_id AND user_id=:user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':task_id', $task_id);
    $stmt->execute();
    if (!$connect->prepare()) {
        return true;
    }
    return false;
}


function mask_as($task_id, $mark_as)
{
    include '../db_connection/db.php';
    $user_id = $_SESSION['user_id'];
    $stmt = $connect->prepare("UPDATE tasks SET completed=:completed WHERE id=:task_id AND user_id=:user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':task_id', $task_id);
    $stmt->bindParam(':completed', $mark_as);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

function get_tasks($isCompleted = '')
{
    include './db_connection/db.php';
    $user_id = $_SESSION['user_id'];
    if ($isCompleted !== '') {
        $sql = "SELECT * FROM tasks WHERE completed = :completed and user_id = :user_id";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':completed', $isCompleted, PDO::PARAM_INT);
    } else {
        $sql = "SELECT * FROM tasks WHERE user_id = :user_id";
        $stmt = $connect->prepare($sql);
    }
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
