<?php
include 'db_connection.php';

$to = $_POST['to'];
$message = $_POST['message'];
session_start();
$senderID = $_SESSION['id'];

$query = mysql_query("SELECT * FROM members WHERE username='".$to."'");
$numrows = mysql_num_rows($query);
if($numrows != 0){
    $row = mysql_fetch_assoc($query);		//Get the ID of the user to use
    $toID = $row['id'];

    date_default_timezone_set('America/Phoenix');
    $date = date('Y-m-d G:i:s');

    $sql = "INSERT INTO messaging(message_id, user_from_id, user_to_id, message, date_sent) 
			VALUES (NULL, '$senderID', '$toID' , '$message' , '$date')";

    $result = mysql_query($sql);
    if($result){
        echo"Message Sent!";
        echo "<p><a href='project8message.php'>Back to Messages</a></p>";
    }else{
        echo"Failed to send.";
    }

}else{
    echo 'Recipient Does not exist!';
}


?>