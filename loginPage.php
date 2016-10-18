<?php
require_once 'skeleton.php';
if (!isset($_SESSION['user'])) {

    if (!isset($_GET['msg'])) {
        echo "<p>Login using your credentials</p>";
    } else if ($_GET['msg'] == 'notOkLog') {
        echo "<p>Wrong Username or Password<p>";
    } else if ($_GET['msg'] == 'emptyField') {
        echo "<p>Fields should not be empty<p>";
    }
    echo "			
            <form action='checkLogin.php' method='POST' class='myform'>
                <label><span>Username </span><input type='text' name='usr' placeholder=' Your email' title='Insert your Username here'></label>
                <label><span>Password </span><input type='password' name='psw' placeholder=' Your password' title='Insert your password here'></label>
                <label><input type='submit' name='btn' value='LogIn'></label>
            </form>
            <p>New User? Register a new account <a href='registrationPage.php'>HERE</a></p>";
			echo "
			</div>
			</div>  
			</div>			
			</body>
			<script src='login.js'></script>
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