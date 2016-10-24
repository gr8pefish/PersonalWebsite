<?php

// Check for empty fields
if(empty($_POST['name'])      ||
    empty($_POST['phone'])     ||
    empty($_POST['email'])     ||
    empty($_POST['message'])   ||
    !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
{
    echo "Invalid settings!";
    return false;
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$timestamp = strip_tags(htmlspecialchars($_SERVER['REQUEST_TIME']));

// Create the email and send the message
$to = 'mw834@nau.edu'; // This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nTimestamp: $timestamp\n\nName: $name\n\nSender's Email: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: mywebsite@nodomain.com\n"; // This is the email address the generated message will be from.
$headers .= "Reply-To: $email_address";
mail($to,$email_subject,$email_body,$headers);
echo "Message sent!";
return true;
?>


