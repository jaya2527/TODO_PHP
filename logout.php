<?php
include 'utils/util.php';
include 'model/tasks.php';
session_start();
session_destroy();
redirect('login');
