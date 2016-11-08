<?php
session_start();
include 'db_connection.php';

//Record logout time
$username = $_SESSION['username'];
$id = $_SESSION['id'];

date_default_timezone_set('America/Phoenix');
$logoutDate = date('Y-m-d G:i:s');

$sql = "UPDATE useractivity SET logout = '$logoutDate' WHERE (id = '$id' AND logout is null) ";

$result = mysql_query($sql, $conn );
$result = mysql_query($sql);
if( ! $result){
    die('Could not update account activity: ' . mysql_error());		//Error accessing a variable
}

//session_unset($_SESSION['id']);  Individual session unset. (Left for reference)

session_destroy(); //Remove all sessions that currently exist

header('Location: http://localhost/website/pages/projects/college/nau/cs212/cs212projects/project7login.php');
exit();
?>