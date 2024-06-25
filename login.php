<?php
$page="login";
session_start();
include 'db_connection/db.php';
include 'utils/util.php';
include './model/users.php';
include './template/header.php';
protect();
?>

<body>
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form action="handlers/login_handler.php" method="post">
    <h3>Login Here</h3>
    <style="color:white";>
    Username: <input type="text" name="username">

    <?php
    login_errors('u_error');
    ?>

    Password: <input type="password" name="password">

    <?php
    login_errors('pass_error');
    ?>

    <input class="button" type="submit" value="Login">
    <a href="/forget.php">Forgot Password?</a>


</form>
<a href="/registration.php" >Register
</a>

</body>
</html>