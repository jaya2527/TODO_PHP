<?php

function insert_users_details($registerUserData)
{
    include '../db_connection/db.php';

        $first_name = $registerUserData['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone_number'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
        $path = $registerUserData['file']['path'] ?? '';

    $stmt = $connect->prepare("INSERT INTO users (first_name, last_name, phone_number, username, password, file_path) VALUES (:first_name, :last_name, :phone_number, :username, :password, :file_path)");
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':file_path', $path); // Bind the file path obtained from upload function
    if ($stmt->execute()) {
        echo "Registration successful!";
        $_SESSION["registered"] = true;
        // Redirect the user to the new page
        redirect('login');
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Error: " . $errorInfo[2];
    }

}

function get_user_by_username()
{
include '../db_connection/db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

// Prepare the SQL statement to retrieve user by username
    $stmt = $connect->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($row) {
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Call set_current_user and pass $user data
            set_current_user($row);
            $_SESSION["loggedin"] = true;
            // Redirect the user to the new page
            redirect('index');
        } else {
            // Password is incorrect
            $_SESSION['pass_error'][] = "Password is not match";
            redirect('login');
        }
    } else {
        // Username not found
        $_SESSION['u_error'][] = "Username does not exist";
        redirect('login');
    }
}
