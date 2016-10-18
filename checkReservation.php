<?php

require_once 'utilityFunctions.php';

$validsession = mySessionCheck();

if ($validsession == 1) {        //user is logged in
    if (
        isset($_POST['user']) &&
        isset($_POST['start']) &&
        isset($_POST['duration']) &&
        preg_match('/^([01]?[0-9]|2[0-3]):[0-5]?[0-9]$/', $_POST['start']) &&
        preg_match('/^([1-9][0-9]*)$/', $_POST['duration']) &&
        strcmp($_POST['user'], $_SESSION['user']) == 0
    ) {
        $valid = true;
        $inputHS = 0;
        $inputMS = 0;

        date_default_timezone_set('Europe/Rome');
        $today = date("H:i:s");

        //no need to sanitize numbers
        sscanf($_POST['start'], "%d:%d", $inputHS, $inputMS);
        sscanf($_POST['duration'], "%d", $inputDU);


        //now check if reservation remain in the day
        $timeEnd = (int)$inputHS * 60 + (int)$inputMS + (int)$inputDU;

        if ($timeEnd > 24 * 60) {
            $valid = false;
        }
        if ($valid) {
            // query the database

            $connection = myDbConnect();

            if ($GLOBALS["machines"] < 1) {
                header('Location: personalPage.php?msg=noMachine');
                exit;
            } else {
                $inputUS = mysqli_real_escape_string($connection, sanitizeString($_POST['user']));
                //no need to escape time

                $tmptable = "( SELECT 1 as machineNumber";
                for ($i = 2; $i <= $GLOBALS["machines"]; $i++) {
                    $tmptable .= " UNION ALL SELECT $i";
                }
                $tmptable .= " ) ";
                try{

                    mysqli_autocommit($connection,false);
                    $query =
                        "INSERT INTO reservations (username, hour_s, duration, machine, res_time)
                     SELECT '{$inputUS}','{$inputHS}:{$inputMS}:00',{$inputDU},machineNumber, '{$today}' FROM $tmptable tmp 
                     WHERE tmp.machineNumber NOT IN (
                     SELECT DISTINCT machine FROM reservations
                     WHERE !(
                            (TIME_TO_SEC('{$inputHS}:{$inputMS}:00')/60 +{$inputDU} <= TIME_TO_SEC(hour_s) / 60 ) 
                            ||
                            (TIME_TO_SEC('{$inputHS}:{$inputMS}:00')/60  >= TIME_TO_SEC(hour_s)/60 + duration )
                            ) 
                     ORDER BY machine FOR UPDATE) LIMIT 1";

                    $queryres = mysqli_query($connection, $query);

                    if (!$queryres) {
                        throw new Exception("query failed");
                    }

                    $rowNumber = mysqli_affected_rows($connection);
                    mysqli_commit($connection);

                    if ($rowNumber == 0) {

                        mysqli_close($connection);
                        header('Location: personalPage.php?msg=noMachine');
                        exit;
                    } else {

                        mysqli_close($connection);
                        header('Location: personalPage.php?msg=correct');
                        exit;
                    }
                }catch (Exception $e){

                    mysqli_rollback($connection);
                    mysqli_close($connection);
                    header('Location: personalPage.php?msg=db error');
                    exit;
                }
            }
        } else {
            // too long reservation
            header('Location: personalPage.php?msg=overDay');
            exit;
        }
    } else {
        // not valid input
        header('Location: personalPage.php?msg=invalidInput');
        exit;
    }
}// not valid session
else {
    header('Location: personalPage.php');
    exit;
}
?>