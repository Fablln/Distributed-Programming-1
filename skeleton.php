<?php

if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on")
{
	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
	exit();
}


require_once 'utilityFunctions.php';
$cookieEnabled = myCookieCheck();
if (!$cookieEnabled) {
    echo "<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<title>Machine Reservation</title>
		<link href='styles.css' rel='stylesheet' type='text/css' />
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
	</head>	
	<body>
		<div id='myheader'>
			<h1>Machine Reservation System</h1>
		</div>
		
		<div id='mytable'>
			<div id='myrow'>
				<div id='mynavbar'>
				</div>
				<div id='mymain'>	
					<p>Cookies must be enabled in order to navigate the website</p>
				</div>
			</div>
		</div>
	</body>
</html>";
    exit;
}
$session_return = mySessionCheck();
if ($session_return == 1) {
    $user_logged = $_SESSION['user'];

    echo "	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>Machine Reservation</title>
	<link href='styles.css' rel='stylesheet' type='text/css' />
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>

	</head>
	<body>
		<div id='myheader'>
			<h1>Machine Reservation System</h1>			
			<a href='logOut.php'>Log Out</a>
			<p>$user_logged</p> 
			
			<noscript>INFO: Javascript is currently disabled on your browser.</noscript>
		</div>
		
		<div id='mytable'>
		<div id='myrow'>
			<div id='mynavbar'>
				<ul>
				<li><a href='index.php'/>HOME</a></li>
				<li><a href='personalPage.php'/>Personal Page</a></li>
				<li><a href='logOut.php'>Log Out</a></li>
				</ul>
			</div>
		
			<div id='mymain'>
	 
";
} else {
    echo "	
	 <!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>Machine Reservation</title>
	<link href='styles.css' rel='stylesheet' type='text/css'  />
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
  	
	</head>
	<body>
		<div id='myheader'>
		<h1>Machine Reservation System</h1>		
		<noscript>INFO: Javascript is currently disabled on your browser.</noscript>
		</div>
		
		<div id='mytable'>
			<div id='myrow'>
				<div id='mynavbar'>
					<ul>
						<li><a href='index.php'/>HOME</a></li>
						<li><a href='loginPage.php'/>Log In</a></li>
						<li><a href='personalPage.php'/>Personal Page</a></li>
						<li><a href='registrationPage.php'/>Registration Page</a></li>
					</ul>
				</div>
				<div id='mymain'>
";
}
?>