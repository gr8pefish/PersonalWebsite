<!DOCTYPE html>
<html>

<head>
    <title>Update Account Information</title>

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
    <div id = "messageLink">
        <p><a href="project8message.php">Messages</a></p>
    </div>

    <div id = "change_information">
        <form id= 'change_info' action='change_info.php' method='POST'>
            <fieldset>
                <legend>Update Account Information</legend>
                <p>Fill in the areas you want to update and submit.</p>
                <ol>
                    <li>
                        <label for="username">Username<em>*</em>:</label>
                        <input type = "text" name = "username">
                    </li>
                    <li>
                        <label for="email">Email<em>*</em>:</label>
                        <input type="text" name="email">
                    </li>
                    <li>
                        <label for="password">Password<em>*</em>:</label>
                        <input type = "password" name = "password">
                    </li>
                    <li>
                        <label for="password2">Password Again<em>*</em>:</label>
                        <input type = "password" name = "password2">
                    </li>

                    <div id= "submit_button">
                        <input type = "submit" value = "Change Information">
                    </div>
            </fieldset>
        </form>
        <div id = "delete_user">
            <p>To remove your account from the database click the button below. Warning: The account and records will be permanently removed!</p>
            <div id = "delete_button">
                <form action="deleteaccount.php">
                    <input type="submit" value="Delete Account">
                </form>
            </div>
        </div>

        <?php

        echo '<div id = "admin_options">';
        include 'extra_db_info.php';
        echo '</div>';

        ?>

    </div>
</div>

</body>
</html>