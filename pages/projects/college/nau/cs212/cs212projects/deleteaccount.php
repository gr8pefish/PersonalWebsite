<?php

session_start();
$username = $_SESSION['username'];

include 'db_connection.php';

$deleteQuery = "DELETE FROM members WHERE username = '$username'";		//Remove the row from the session data
mysql_query($deleteQuery, $conn);

include 'logout.php';				//Reuse the same logout code to destroy the session and return to the home page

?>