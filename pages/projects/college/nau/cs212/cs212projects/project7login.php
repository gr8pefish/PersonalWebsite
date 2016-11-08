<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="defaultstyle.css"/>
<link rel="stylesheet" type="text/css" href="loginstyle.css"/>
<head>
    <title>Log into An Account</title>
    <link rel="shortcut icon" href="images/skylineicon.ico" >
</head>

<body>



<div class = "container">


    <div id = "headerpic">
    </div>

    <div id = "login_form">

        <form id= 'loginform' action='login.php' method='POST'>

            <fieldset>
                <legend>Login</legend>
                <ol>
                    <li>
                        <label for="username">Username<em>*</em>:</label>
                        <input type = "text" name = "username">
                    </li>
                    <li>
                        <label for="password">Password<em>*</em>:</label>
                        <input type = "password" name = "password">
                    </li>
                </ol>

                <div id= "submit_button">
                    <input type = "submit" value = "Login">
                </div>
        </form>

    </div>

</div>

</body>

</html>
