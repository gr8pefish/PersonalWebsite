<?php
include 'db_connection.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

//Prevent mySQL interjections(code being executed in the text fields)
$username = mysql_real_escape_string(stripslashes($username));
$email = mysql_real_escape_string(stripslashes($email));
$password = mysql_real_escape_string(stripslashes($password));
$password2 = mysql_real_escape_string(stripslashes($password2));

if($username == "" || $email == ""){
    echo json_encode(array('return_value' => '0',
        'message' => 'User was unsuccessfully registered, missing required fields.'));
}else{
    if($password != $password2){
        echo json_encode(array('return_value' => '0',
            'message' => 'User was unsuccessfully registered, passwords do not match.'));
    }else{

        $query = mysql_query("SELECT * FROM members WHERE username='".$username."'");
        $numrows = mysql_num_rows($query);
        if($numrows != 0){
            echo json_encode(array('return_value' => '0',
                'message' => 'User was unsuccessfully registered, username already exists.'));
        }else{
            date_default_timezone_set('America/Phoenix');
            $date = date('Y-m-d G:i:s');				//Get proper date for mysql DateTime

            $sql = "INSERT INTO members(username, email, password) 
			VALUES ('$username', '$email' , '$password')";

            $result = mysql_query($sql);
            if($result){
                echo json_encode(array('return_value' => '1',
                    'message' => 'User was successfully registered. <a href="./project7login.php">Login Here</a>'));		//User was registered
            }else{
                echo json_encode(array('return_value' => '0',
                    'message' => 'User was unsuccessfully registered, database problem.'));
            }
        }
    }
}

?>