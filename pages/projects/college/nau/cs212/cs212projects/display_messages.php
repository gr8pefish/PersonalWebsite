<?php

include 'db_connection.php';

$recipient = $_SESSION['username'];//Get username from the session

$sql = mysql_query("SELECT id FROM members WHERE username ='".$recipient."'") or die(mysql_error());
$recipient_id = mysql_fetch_assoc($sql);
$recipient = $recipient_id['id']; //get id from username
$query = mysql_query("SELECT * FROM messaging WHERE user_to_id ='".$recipient."'") or die(mysql_error());

$numrows = mysql_num_rows($query);

if($numrows==0){
    echo 'You have no mail!';
}else{
    $message = mysql_fetch_array($query);		//Get username from the id that is saved in the message

    //Only display the messages that have not been marked as read.
    $query = mysql_query("SELECT * FROM messaging WHERE (user_to_id ='".$recipient."' AND read_unread = 'a')") or die(mysql_error());
    while($message = mysql_fetch_assoc($query)){
        $fromID = $message['user_from_id'];
        $sql = mysql_query("SELECT username FROM members WHERE id ='".$fromID."'") or die(mysql_error());
        $from_username = mysql_fetch_assoc($sql);
        $sender = $from_username['username'];
        $sqldate = $message['date_sent'];			//Reformat date into a more readable form.
        $date = strtotime($sqldate);
        $formatteddate = date('M d, Y', $date);

        $messageid = $message['message_id'];

        echo '<div id = unread_message>';
        echo '<p>From: '.$sender.'<br></p>';		//Echo out sender
        echo '<p>Message: '.$message['message'].'<br></p>';		//Echo out message
        echo '<p>Date Sent: '.$formatteddate.'<br></p>';		//Print date
        //To mark a message as read, or to delete the message.
        echo '<form name = "delete_message" action = "message_action.php" method ="POST"> 
					<input type="submit" name="markas" value="Mark as Read">	
					<input type="submit" name="delete" value="Delete Message">	
					<input type="hidden" name="messageid" value= '.$messageid.' >
					</form>';

        echo '</div>';
    }
    echo '<p>Read Messages</p>';

    $query = mysql_query("SELECT * FROM messaging WHERE (user_to_id ='".$recipient."' AND read_unread = 'b')") or die(mysql_error());	//For messages marked as read
    while($message = mysql_fetch_assoc($query)){
        $fromID = $message['user_from_id'];
        $sql = mysql_query("SELECT username FROM members WHERE id ='".$fromID."'") or die(mysql_error());
        $from_username = mysql_fetch_assoc($sql);
        $sender = $from_username['username'];
        $sqldate = $message['date_sent'];			//Reformat date into a more readable form.
        $date = strtotime($sqldate);
        $formatteddate = date('M d, Y', $date);

        $messageid = $message['message_id'];

        echo '<div id = read_message>';
        echo '<p>From: '.$sender.'<br></p>';		//Echo out sender
        echo '<p>Message: '.$message['message'].'<br></p>';		//Echo out message
        echo '<p>Date Sent: '.$formatteddate.'<br></p>';		//Print date

        echo '<form name = "delete_message" action = "message_action.php" method ="POST">
					<input type="submit" name="delete" value="Delete Message">
					<input type="hidden" name="messageid" value= '.$messageid.' >
					</form>';

        echo '</div>';
    }

}
?>
