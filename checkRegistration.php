<?php
require_once 'utilityFunctions.php';
//no session here
if ((isset($_POST['user']) &&
        isset($_POST['first']) &&
        isset($_POST['last']) &&
        isset($_POST['psw']) &&
        isset($_POST['cpsw'])) &&
    strlen($_POST['first']) != 0 &&
    strlen($_POST['last']) != 0 &&
    strlen($_POST['psw']) != 0 &&
    strlen($_POST['cpsw']) != 0 &&
    strlen($_POST['user']) != 0 &&
    filter_var($_POST["user"], FILTER_VALIDATE_EMAIL)
) {

    $connection = myDbConnect();

    // sanitize input
    $req_user = mysqli_real_escape_string($connection, sanitizeString($_POST['user']));
    $req_first = mysqli_real_escape_string($connection, sanitizeString($_POST['first']));
    $req_last = mysqli_real_escape_string($connection, sanitizeString($_POST['last']));
    $req_psw = $_POST['psw'];
    $req_cpsw = $_POST['cpsw'];

    //second check to avoid truncation and empty fields
    if (!(strlen($req_user) != 0 && strlen($req_user) <= 32 &&
        strlen($req_first) != 0 && strlen($req_first) <= 32 &&
        strlen($req_last) != 0 && strlen($req_last) <= 32 &&
        strlen($req_psw) != 0 && strlen($req_psw) <= 32 &&
        strlen($req_cpsw) != 0 && strlen($req_cpsw) <= 32)
    ) {
        mysqli_close($connection);
        header('Location: registrationPage.php?msg=wrong');
        exit;
    }

    if (strcmp($req_cpsw, $req_psw) != 0) {
        mysqli_close($connection);
        header('Location: registrationPage.php?msg=noMatch');
        exit;
    }

    $req_psw = md5($req_psw);


    $myquery = "SELECT * FROM users WHERE username='$req_user'";

    $queryres = mysqli_query($connection, $myquery);

    if (!$queryres) {
        // not ok
        mysqli_close($connection);
        die("Query error." . mysqli_error($connection));
    } else {
        $row = mysqli_num_rows($queryres);
        if ($row == 0) {
            $myquery = "INSERT INTO users (username, firstname, lastname, password) VALUES('$req_user' , '$req_first', '$req_last', '$req_psw' )";
            if (mysqli_query($connection, $myquery)) {
                mysqli_close($connection);
                session_start();
                $_SESSION['timer'] = time();
                $_SESSION['user'] = $req_user;
                header('Location: personalPage.php');
                exit;
            } else {
                mysqli_close($connection);
                die("Query error." . mysqli_error($connection));
            }
        } else {
            // already picked
            mysqli_close($connection);
            header('Location: registrationPage.php?msg=email');
            exit;
        }
    }
} else {
    // redirect
    header('Location: registrationPage.php?msg=wrong');
    exit;
}

?>