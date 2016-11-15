<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="defaultstyle.css"/>
<head>
    <title>Messaging</title>

</head>
<div id = "login">
    <?php
    session_start();
    echo"You are logged in as ".$_SESSION['username'];
    echo"<p><a href='logout.php'>Logout</a></p>";
    ?>
</div>


<body>
<div class = "container">

    <div id = "send_message">
        <form id= 'sendmessage' action='sendmessage.php' method='POST'>
            <fieldset>
                <legend>Send a New Message</legend>
                <p>Type in a username from the website and a message and submit.</p>
                <ol>
                    <li>
                        <label for="to">Message to:<em>*</em>:</label>
                        <input type = "text" name = "to">
                    </li>

                    <li>
                        <label for="message">Message:<em>*</em>:</label>
                        <textarea name="message" id="message"></textarea>
                    </li>


                    <div id= "submit_button">
                        <input type = "submit" value = "Send Message">
                    </div>
            </fieldset>
        </form>
    </div>

    <div id = "view_messages">
        <h3>Messages To You</h3><br>
        <p> New messages </p>
        <?php include 'display_messages.php' ?>
    </div>


</div>

</body>
</html>