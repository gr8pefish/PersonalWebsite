<!DOCTYPE html>
<?php
/* Email Form
* This is a simple email form that is used to demonstrate PHP validation. This
* particular file also demonstrates using PHP to display HTML elements
*/
$labels = array("name" => "Your name", "phone" => "Your phone number", "email" => "Your email", "message" => "Your message");
?>
<html>
<head>
    <title>Example Form</title>
    <!--Add some styling to the page-->
    <style type ="text/css">
        <!--
        form {margin: 1.5em 0 0 0; padding: 0;}
        .field {padding-top: .5em}
        label {font-weight: bold; float: left; width: 20%;
            margin-right: 1em; text-align: right;}
        #submit {margin-left: 35%; padding-top: 1em;}
        -->
    </style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project 5</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../../../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../../../../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!--PHP Validation-->
<?php

// define error variables and set to empty values
$nameError = $emailError = $phoneError = $messageError = "";
// define varibale and set to empty values
$name = $email = $phone = $message = "";

//If posting correctly
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Name checking
    if (empty($_POST["name"])) {
        $nameError = "Name is required!\n ";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameError = "Only letters and white space allowed";
        }
    }

    //Phone number checking
    if (empty($_POST["phone"])) {
        $phoneError = "Phone Number is required!\n ";
    } else {
        $phone = test_input($_POST["phone"]);
    }

    //Email checking
    if (empty($_POST["email"])) {
        $emailError = "Email is required!\n ";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format! ";
        }
    }

    //Message checking
    if (empty($_POST["message"])) {
        $messageError = "Message is required!\n ";
    } else {
        $message = test_input($_POST["message"]);
    }
}

//Removes special characters so it can easily be printed on the screen
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<h3>Please fill out the form and click submit to send an email.</h3>
<form action="" method="POST" novalidate>
    <?php
    /* Loop that displays the form fields */
    foreach ($labels as $field => $label) {
        /* echo the label */
        echo "<div class='field'>\n
 <label for='$field'>$label</label>\n";

        /* echo the appropriate field */
        if ($field === "name")
        {
            echo "<input type='text' name='$field' id='$field' value= '$name'
 size='65' maxlength='65' />\n";
            echo $nameError;
        }

        if ($field === "phone")
        {
            echo "<input type='text' name='$field' id='$field' value= '$phone'
 size='65' maxlength='65' />\n";
            echo $phoneError;
        }

        if ($field === "message")
        {
            echo "<input type='text' name='$field' id='$field' value= '$message'
 size='65' maxlength='65' />\n";
            echo $messageError;
        }

        if ($field === "email")
        {
            echo "<input type='email' name='$field' id='$field' value= '$email'
 size='65' maxlength='65' />\n";
            echo $emailError;
        }

        /* echo the end of the field div */
        echo "</div>\n";
    }

    /* Display the submit button */
    echo "<div id='submit'>\n
 <input type='submit' value='Send Message'>\n
 </div>\n</form>\n</body>\n</html>";
    ?>