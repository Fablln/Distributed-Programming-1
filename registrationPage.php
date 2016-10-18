<?php
//todo: indent html
require_once 'skeleton.php';

if (!isset($_SESSION['user'])) {
if (!isset($_GET['msg'])) {
    echo "<p>Please insert your desired credentials below.</p>";
} else {
    if ($_GET['msg'] == 'email') {
        echo "<p>Please choose another email</p>";
    } else if ($_GET['msg'] == 'wrong') {
        echo "<h1>Please check your credentials</h1>";
    } else if ($_GET['msg'] == 'noMatch') {
        echo "<p>Passwords don't match</p>";
    }
}
echo "	
	<form method='post' action='checkRegistration.php' class='myform'>
		<label><span>Username </span><input type='text' name='user' placeholder=' Your email' title='Insert Username Here'></label>
		<label><span>Name </span><input type='text' name='first' placeholder=' Your name' title='Insert name Here'></label>
		<label><span>Last name </span><input type='text' name='last' placeholder=' Your last name' title='Insert Last name Here'></label>
		<label><span>Password </span><input type='password' name='psw' placeholder=' Your password' title='Insert Password Here'></label>
		<label><span>Confirm Password </span><input type='password' placeholder=' Repeat password' name='cpsw' 
								title='Insert the same password inserted above' ></label>
		<span>&nbsp;</span><label><input type='submit' value='Register' name='tryReg'></label>
	</form>";

echo "</div>
</div>  
</div>	
</body>
<script src='registration.js'></script>
</html>";
	} else {
    echo "<p>You are logged in as {$_SESSION['user']}.<br><br>Aren't you {$_SESSION['user']}? You can <a href='logOut.php'> log out</a></p>";
	echo "
    </div>
    </div>  
    </div>			
    </body>
    </html>";
}


?>























?>