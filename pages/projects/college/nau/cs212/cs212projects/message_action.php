<?php
include 'db_connection.php';

if (isset($_POST['delete'])){
    $messageids = $_POST["messageid"];
    $deleteQuery = "DELETE FROM messaging WHERE message_id = '$messageids'";		//Remove the message from the table
    $result = mysql_query($deleteQuery, $conn);
    header('Location: http://localhost/website/pages/projects/college/nau/cs212/cs212projects/project8message.php');

}

if (isset($_POST['markas'])){
    $messageids = $_POST["messageid"];
    $sql = "UPDATE messaging SET read_unread = 'b' WHERE message_id = '$messageids'" or die(mysql_error());
    $result = mysql_query($sql, $conn);
    if(! $result ){
        die('Could not update read: ' . mysql_error());			//If something happens
    }else{
        echo "<p><a href='account_info.php'>Email updated successfully!</a></p>";
    }

    header('Location: http://localhost/website/pages/projects/college/nau/cs212/cs212projects/project8message.php');
}
?>