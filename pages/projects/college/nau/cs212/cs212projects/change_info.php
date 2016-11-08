<?php
include('db_connection.php');

session_start();
$sessionId = $_SESSION['id'];

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

//Prevent mySQL interjections(code being executed in the text fields)
$username = mysql_real_escape_string(stripslashes($username));
$email = mysql_real_escape_string(stripslashes($email));
$password = mysql_real_escape_string(stripslashes($password));
$password2 = mysql_real_escape_string(stripslashes($password2));

if ($username != ""){
    $query = mysql_query("SELECT * FROM members WHERE username='$username'");			//Check if Username already exists
    $numrows = mysql_num_rows($query);
    if($numrows==0){
        $sql = "UPDATE members SET username = '$username' WHERE id = '$sessionId'";
        $result = mysql_query($sql, $conn );
        if(! $result ){
            die('Could not update Username: ' . mysql_error());			//If something happens
        }else{
            session_unset($_SESSION['username']);			//Unset old username if changed
            $_SESSION['username'] = $username;			//Set a new session id with the updated username
            $sessionId = $_SESSION['username'];			//Reset the sessionID variable if the username is changed
            echo "<p><a href='account_info.php'>Username updated successfully!</a></p>";
        }
    }else{															//If selected username already exists
        echo "<p>Username already exists</p>";
        echo "<p><a href='account_info.php'>Please try another </a></p>";
    }
}

if ($email != ""){
    $sql = "UPDATE members SET email = '$email' WHERE id = '$sessionId' ";
    $result = mysql_query($sql, $conn );
    if(! $result ){
        die('Could not update Email: ' . mysql_error());			//If something happens
    }else{
        echo "<p><a href='account_info.php'>Email updated successfully!</a></p>";
    }
}


if ($password != ""){
    if ($password != $password2){						//If the passwords are not equal to each other
        echo "<p> The passwords do not match.</p>";
        echo "<p><a href='account_info.php'>Make sure they match!</a></p>";
    }else{
        $password = md5($password);

        $sql = "UPDATE members SET password = '$password' WHERE id = '$sessionId'";

        $result = mysql_query($sql, $conn );
        if(! $result ){
            die('Could not update Password: ' . mysql_error());			//If something happens
        }else{
            echo "<p><a href='account_info.php'>Password updated successfully!</a></p>";
        }
    }
}


?>