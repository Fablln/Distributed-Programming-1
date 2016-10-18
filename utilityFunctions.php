<?php

//NUMBER of machines
$machines = 4;
$password = '';
$id = '';
function mySessionCheck()
{
    //todo: at exam put false argument to true -> https
    session_set_cookie_params(0, null, null, true, true);
    session_start();
    $allowed_idle = 120; // 2 minutes

    if (!isset($_SESSION['IPaddress']))
        $_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];

    if (!isset($_SESSION['userAgent']))
        $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];

    if ($_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR'] ||
        $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT']
    ) {
        session_regenerate_id(false);
        session_unset();    // empty session
        session_destroy();  // destroy session
    }

    if (isset($_SESSION['user'])) {
        if (isset($_SESSION['timer'])) {
            $idle = time() - $_SESSION['timer'];
            if ($idle < $allowed_idle) {
                $_SESSION['timer'] = time(); // update use count timer
                return 1;
            }
            //if user out of time i do not destroy his session -> i can send him a message
        }

        //if i'm here there was some error
        session_regenerate_id(true);
        session_unset();    // empty session
        session_destroy();  // destroy session

        return 0;

    } else {
        // guest user
        $_SESSION['guest'] = 'guest';
        return 2;
    }
}

function myCookieCheck()
{
    /*try to set the cookie*/
    setcookie("foo", "bar",null,null,null,true,true);
    if (isset($_COOKIE['foo'])) {
        return true;
    } else {
        if (!isset($_GET["refresh"])) {
            /*refresh only one time*/
            $url=parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
            header("Refresh:0; url={$url}?refresh=1");
            exit;
        } else {
            return false;
        }
    }
}

function sanitizeString($var)
{
    //todo: some operations are not always necessary
    //$var = strip_tags($var);
    $var = htmlentities($var);
    //$var = stripcslashes($var);
    return $var;
}

function myDbConnect()
{
    $conn = mysqli_connect('localhost', $id, $password, $id);
    if (!$conn) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    return $conn;
}

function reservations()
{
    $connection = myDbConnect();

    $myquery = "SELECT * FROM reservations ORDER BY hour_s";

    $queryres = mysqli_query($connection, $myquery);
    if (!$queryres) {
        mysqli_close($connection);
        die("Query error." . mysqli_error($connection));
    }
    $rowNumber = mysqli_num_rows($queryres);

    if ($rowNumber == 0) {
        echo "<h3>Reservations is empty</h3>";
    } else {
        echo "<h3>Reservations</h3>";
        echo "<table class='reservation'><tr><th>Start Time</th><th>Duration</th><th>Machine</th></tr>";
        for ($i = 0; $i < $rowNumber; $i++) {
            $thisRow = mysqli_fetch_array($queryres);
            echo "<tr>
			<td> {$thisRow["hour_s"] }</td>  
			<td> {$thisRow["duration"]} </td>
			<td> {$thisRow["machine"]} </td> 
			</tr>";
        }
        echo "</table>";
    }
    mysqli_free_result($queryres);
    mysqli_close($connection);
}

function userReservations($user)
{
    $connection = myDbConnect();

    $user = mysqli_real_escape_string($connection, sanitizeString($user));

    $myquery = "SELECT * FROM reservations WHERE username='$user' ORDER BY hour_s DESC";

    $queryres = mysqli_query($connection, $myquery);
    if (!$queryres) {
        mysqli_close($connection);
        die("Query error." . mysqli_error($connection));
    }
    $rowNumber = mysqli_num_rows($queryres);

    echo "<h3>Your active Reservations</h3>";
    if ($rowNumber == 0) {
        echo "<h3>You haven't made any reservation yet.</h3>";
    } else {
        echo "<table class='reservation'><tr><th hidden></th><th>Start Time</th><th>Duration</th><th>Machine</th></tr>";

        for ($i = 0; $i < $rowNumber; $i++) {
            $thisRow = mysqli_fetch_array($queryres);
            $delID = $thisRow["id"];
            echo "<tr>
            <td hidden>{$thisRow["res_time"] }</td>
			<td>{$thisRow["hour_s"] }</td>
			<td>{$thisRow["duration"]}</td>
			<td>
			<form class='deleteform' method='post' action='deleteReservation.php'>
			{$thisRow["machine"]}
			<input class='deletebtn' name='deleteBTN' type='submit' value='Delete'/>
			<input type='hidden' name='delID' value=$delID></form>
			
			</td>
		
			</tr>";
        }
        echo "</table>";
    }
    mysqli_free_result($queryres);
    mysqli_close($connection);
}

?>