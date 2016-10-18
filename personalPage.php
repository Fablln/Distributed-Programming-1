<?php
require_once 'skeleton.php';
if (isset($_SESSION['user'])) {
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'correct') {
            echo "<p>Reservation properly made</p>";
        } else if ($_GET['msg'] == 'noMachine') {
            echo "<p>Reservation not made, all machines are occupied</p>";
        } else if ($_GET['msg'] == 'invalidInput') {
            echo "<p>Invalid input. Check your data</p>";
        } else if ($_GET['msg'] == 'deleteOK') {
            echo "<p>Reservation correctly deleted</p>";
        } else if ($_GET['msg'] == 'noTime') {
            echo "<p>Reservation not deleted, not enought time passed</p>";
        } else if ($_GET['msg'] == 'overDay') {
            echo "<p>Reservation not made, it goes in the day after</p>";
        } else if($_GET['msg'] == 'db error') {
			echo "<p>An error occured</p>";
		}
    }
    // display reservations
    reservations();

    $user = $_SESSION['user'];
    // display form for new reservations
    echo "	
	
	<form method='post' action='checkReservation.php' class='myform'>
		<h3>New Reservation Form</h3>
		<label><span>Start Time </span><input type='text' name='start' title='Start hour and minute, separated by :' placeholder=' hh:mm'/></label>
		<label><span>Duration </span><input type='text' name='duration' title=' Minutes of reservation' placeholder=' mm'/></label>
		<input type='hidden' name='user' value= '$user'>
		<input name='submitReservation' type='submit' value='Insert'/>
	</form>
	";

    // display users' reservations and allow delete

    userReservations($user);

} else if (!isset($_SESSION['guest'])) {
    echo "<p>Your timeout expired.<br>Please <a href='loginPage.php'>login</a> again.</p>";
} else {
    echo "<p>You must <a href='loginPage.php'>login</a> or <a href='registrationPage.php'>register</a> to see this page</p>";
}

echo "		
</div>
</div> 
</div>
</body>
<script src='personal.js'></script>
</html>";
?>
