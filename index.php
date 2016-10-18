<?php
require_once 'utilityFunctions.php';
require_once 'skeleton.php';
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'loggedOut') {
        echo "<p>Correctly logged out</p>";
    }
}
reservations(); // show all the reservations

echo "</div>
</div>
</div>
</body>
</html>";
?>