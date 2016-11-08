<?php
include('db_connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

//Prevent mySQL interjections(code being executed in the text fields)
$username = mysql_real_escape_string(stripslashes($username));
$password = mysql_real_escape_string(stripslashes($password));

//Find if the account exists
$query = mysql_query("SELECT * FROM members WHERE username='".$username."'");

$numrows = mysql_num_rows($query);


if($numrows==0){		//Account does not exist
    echo'The username is not in the database.';
    echo "<p><a href='./project7login.php'>Try again?</a></p>";
    echo "<p><a href='./project7register.php'>Register if you don't have an account.</a></p>";
}else{
    while($row = mysql_fetch_assoc($query)){
        $dbusername = $row['username'];
        $dbpassword = $row['password'];
        $dbId = $row['id'];
    }
    if($username==$dbusername && $password==$dbpassword){		//Account information matches
        session_start();				//Start the session
        $_SESSION['username'] = $dbusername;

//        Record account activity
        date_default_timezone_set('America/Phoenix');
        $loginDate = date('Y-m-d G:i:s');
        $sql = "INSERT INTO useractivity(username, login)
		VALUES ('$dbusername', '$loginDate')";

        $query2 = mysql_query("SELECT id FROM useractivity WHERE id= (select max(ID) from useractivity");
        $_SESSION['id'] = mysql_fetch_field($query2);

        $result = mysql_query($sql);
        if( ! $result){
            die('Could not update account activity: ' . mysql_error());		//Error accessing a variable
        }

        header('Location: http://localhost/website/pages/projects/college/nau/cs212/cs212projects/account_info.php');
        exit();
    }else{
        echo'Your password is incorrect.';
        echo "<p><a href='./project7login.php'>Try again</a></p>";
    }
}
?>