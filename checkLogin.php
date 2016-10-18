<?php
require_once 'utilityFunctions.php';
//no session here
if (isset($_POST['usr']) &&
    isset($_POST['psw']) &&
    strlen($_POST['usr']) != 0 &&
    strlen($_POST['psw']) != 0
) {

    $connection = myDbConnect();

    $user = mysqli_real_escape_string($connection, sanitizeString($_POST['usr']));
    //not necessary
    $psw = md5($_POST['psw']);

    $myquery = "SELECT * FROM users WHERE username='$user' AND password='$psw'";
    $queryres = mysqli_query($connection, $myquery);

    if (!$queryres) {
        // not ok
        mysqli_close($connection);
        header('Location: loginPage.php?msg=notOkLog');
        exit;
    } else {
        $row = mysqli_num_rows($queryres);
        if ($row == 1) {
            // ok, existing username and password
            mysqli_close($connection);
            //todo: at the exam put false argument to true -> https
            session_set_cookie_params(0, null, null, true, true);
            session_start();
            //new session id, clone old session, destroy old session 
            session_regenerate_id(true);
            $_SESSION['timer'] = time();
            $_SESSION['user'] = $user;
            header('Location: personalPage.php?msg=okLog');
            exit;
        } else {
            mysqli_close($connection);
            header('Location: loginPage.php?msg=notOkLog');
            exit;
        }
    }
} else {
    header('Location: loginPage.php?msg=emptyField');
    exit;
}

?>