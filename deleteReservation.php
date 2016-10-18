<?php
require_once 'utilityFunctions.php';
$validsession = mySessionCheck();
if ($validsession == 1) {        //user is logged in

    $connection = myDbConnect();

    if (isset($_POST['delID']) && filter_var($_POST['delID'], FILTER_VALIDATE_INT)) {
        $delID = mysqli_real_escape_string($connection, sanitizeString($_POST['delID']));
        date_default_timezone_set('Europe/Rome');
        $today = date("H:i:s");

        $myquery = "DELETE FROM reservations WHERE id = $delID and TIME_TO_SEC('{$today}') >= TIME_TO_SEC(res_time) +60 and username = '{$_SESSION["user"]}'  LIMIT 1";


        if (!mysqli_query($connection, $myquery)) {
            mysqli_close($connection);
            die("Query error." . mysqli_error($connection));
        } else {
            $rowNumber = mysqli_affected_rows($connection);
            if ($rowNumber == 0) {
                mysqli_close($connection);
                header('Location: personalPage.php?msg=noTime');
                exit;
            } else {
                mysqli_close($connection);
                header('Location: personalPage.php?msg=deleteOK');
                exit;
            }
        }
    } else {
        header('Location: personalPage.php?msg=invalidInput');
        exit;
    }
}// not valid session
else {
    header('Location: personalPage.php');
    exit;
}


?>