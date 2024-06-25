
<?php
$page="registration";
session_start();
include 'db_connection/db.php';
include 'utils/util.php';
include 'model/tasks.php';
include 'template/header.php';

?>

<div class="container">
    <h2>User Registration</h2>
    <form action="handlers/register_handler.php" method="post" enctype="multipart/form-data">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name">
        <span class="error"><?php print_errors('first_error'); ?></span>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name">
        <span class="error"><?php print_errors('last_error'); ?></span>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number">
        <span class="error"><?php print_errors('number_error'); ?></span>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <span class="error"><?php print_errors('user_error'); ?></span>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span class="error"><?php print_errors('password_error'); ?></span>

        <label for="file_path">Profile Image:</label>
        <input type="file" id="file_path" name="file_path" accept="image/*">
        <span class="error"><?php print_errors('image_error'); unset($_SESSION['image_error']);?></span>


        <input type="submit" value="Register">
    </form>
</div>
<?php
include 'template/footer.php';

