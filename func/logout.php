<?php
session_start();
?>
<!DOCTYPE html>
<html>
<title>Session Logout</title>
<body>

<?php

// destroy the session

session_destroy();
header("Location: ../login.php"); 
?>

</body>
</html>
