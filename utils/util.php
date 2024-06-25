<?php
function print_errors($key)
{
    if (isset($_SESSION[$key]) && is_array($_SESSION[$key]) && count($_SESSION[$key]) > 0) {
        // Start a loop through each error in the array
        foreach ($_SESSION[$key] as $error) {
            // Output a <p> tag with the error message
            echo '<p class="error">' . $error . '</p>';
        }
        // Clear the error messages after displaying them
        $_SESSION[$key] = array();
    }
}

function login_errors($key)
{
    if (isset($_SESSION[$key]) && is_array($_SESSION[$key]) && count($_SESSION[$key]) > 0) {
        // Start a loop through each error in the array
        foreach ($_SESSION[$key] as $error_login) {
            // Output a <p> tag with the error message
            echo '<p class="error">' . $error_login . '</p>';
        }
        // Clear the error messages after displaying them
        $_SESSION[$key] = array();
    }
}

function redirect($pageName, $queryParameters = '')
{
    $url = "Location:/" . $pageName . ".php";
    if (!empty($queryParameters)) {
        $url = $url . '?' . $queryParameters;
    }
    header($url);
    exit;
}



function is_user_loggedin()
{
    if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
        header("Location:/login.php");
        exit;
    }
    return true;
}

function protect()
{
    if
    (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
        header('location:/index.php');
    }
}


function set_current_user(array $row)
{
    if (!is_array($row)) {
        return false;
    }

    $_SESSION['username'] = $row['username'];
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['last_name'] = $row['last_name'];
    $_SESSION['phone_number'] = $row['phone_number'];
    $_SESSION['file_path'] = $row['file_path'];
}


function get_current_user_info()
{
    return array(
        "first_name" => $_SESSION['first_name'],
        "last_name" => $_SESSION['last_name'],
        "phone_number" => $_SESSION['phone_number'],
        "username" => $_SESSION['username'],
        "file_path" => $_SESSION['file_path']
    );
}


?>

<?php
function print_user_info()
{
    $userDetails = get_current_user_info();
    $file_path = $userDetails['file_path']; // Assuming 'image_path' is the column name in your database

    ?>
    <div class="card mb-3 position-relative py-2 px-4 border border-secondary cont ms-auto container "
         style="max-width: 540px;">
        <div class="row g-0 ">
            <div class="col-md-4">
                <img src="<?php echo $file_path; ?>" class="img-fluid rounded-circle rounded-5 mt-4 " alt="image">
            </div>
            <div class="col-md-8 ">
                <div class="card-body col g-4">
                    <h5 class="card-title text-center">USER DETAILS</h5>

                    <ul class="list-group list-group-flush text-center list-group-horizontal">
                        <li class="list-group-item "><strong>First Name
                                <br></strong><?php echo $userDetails['first_name']; ?></li>
                        <li class="list-group-item"><strong>Last Name
                                <br></strong><?php echo $userDetails['last_name']; ?></li>
                    </ul>
                    <ul class="list-group list-group-flush text-center list-group-horizontal">
                        <li class="list-group-item "><strong>Username
                                <br></strong><?php echo $userDetails['username']; ?></li>
                        <li class="list-group-item"><strong>Phone Number<br>
                            </strong><?php echo $userDetails['phone_number']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
}
function upload($file)
{
    if (empty($file['name'])) {
        $response['error'] = true;
        $response['message'] = "Profile is required";
        return $response;
    }
    $response=[];
    if (isset($file['name'])) {
        $uploads_dir = "../uploads/";
        $filename=pathinfo($file["name"],PATHINFO_FILENAME);
        $timestamp=date("YmdHis");
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $uploadFile =$uploads_dir . $filename. '_' . $timestamp . '.' . $imageFileType;

        if ($file["size"] > 500000) {
            $response['error']=true;
            $response['message']="Sorry your file is too large";
            return $response;
        }
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedExtensions)) {
            $response ['error']=true;
            $response ['message']="Sorry only jpeg, jpg, png, & GIF files are required";
            return $response;
        }
        if (move_uploaded_file($file["tmp_name"], $uploadFile)) {
            return [
                'error' => false,
                "path" => $uploadFile
            ];
        }
        return [
            'error' => true,
            "message" => "File not uploaded"
        ];
    }
}
?>

