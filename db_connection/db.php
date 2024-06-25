<?php



// Connect to the database (you'll need to replace the credentials)
//$db_host = 'localhost';
//$db_user = 'root';
//$db_password = '';
//$db_name = 'registration';
//
//$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
//// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}



try {
    $db_host = 'localhost';
    $db_name='registration';
    $db_user = 'root';
    $db_password = '';
    $connect = new PDO(
        "mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
}
catch (PDOException $e) {
    echo "Error : " . $e->getMessage() . "<br/>";
    die();
}
//
//public function handleTaskValidator($type, $data)
//{
//    switch ($type) {
//        case 'add_error':
//            if (empty($data['task'])) {
//                echo "Task is required";
//            }
//            break;
//
//        case 'update_error':
//            if (empty($data["task"]) || empty($data["task_id"])) {
//                echo "Update is required";
//            }
//            break;
//
//        case 'delete_error':
//            if (!isset($data["id"]) || empty($data["id"])) {
//                echo "ID is required";
//            }
//            break;
//
//        default:
//            break;
//    }
//}