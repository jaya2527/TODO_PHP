<html>
<head>
    <title>ToDo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="/assets/style.css">
    <link rel="stylesheet" href="/assets/<?php echo $page ?>.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet"
          media="screen">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark px-2">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <div class="collapse navbar-collapse navbar-todo" id="navbarSupportedContent">
                <ul class="navbar-nav col">
                    <?php
                    if ($page == 'registration') {
                        echo '<li class="nav-item"><a class="nav-link" href="login.php">User Login</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="aboutus.php">About</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>';
                    } elseif ($page == 'login') {
                        echo '<li class="nav-item"><a class="nav-link" href="registration.php">Register</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="aboutus.php">About</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>';
                    } elseif ($page == 'index') {
                        echo '<li class="nav-item"><a class="nav-link rounded-3 me-2" href="index.php">Todo</a></li>';
                        echo '<li class="nav-item"><a class="nav-link rounded-3 me-2" href="aboutus.php">About</a></li>';
                        echo '<li class="nav-item"><a class="nav-link rounded-3 me-2" href="contact.php">Contact Us</a></li>';
                        echo '<li class="nav-item ms-auto"><a class="btn btn-sm btn-danger" href="logout.php">Logout</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="aboutus.php">About</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>';
                    }
                    ?>
            </div>
        </div>
</nav>

