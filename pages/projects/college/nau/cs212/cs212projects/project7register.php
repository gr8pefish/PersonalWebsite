<!DOCTYPE html>

<html>

<head>
    <title>Create An Account</title>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

</head>

<body>

<div class = "container">

    <div id = "headerpic">
    </div>

    <div id = "register_form">

        <h2>Create An Account</h2>

        <form method="post" action="registeruser.php">
            <fieldset>
                <legend>Register User</legend>
                <p>Please use valid contact information.</p>

                <ol>
                    <li>
                        <label for="username">Username<em>*</em>:</label>
                        <input type="text" id="username" name="username" onkeyup="validateName()"/>
                        <label id="nameComment"></label>
                    </li>

                    <li>
                        <label for="email">Email<em>*</em>:</label>
                        <input type="text" id="email" name="email" onkeyup="validateEmail()"/>
                        <label id="emailComment"></label>
                    </li>

                    <li>
                        <label for="password">Password<em>*</em>:</label>
                        <input type="password" id="password" name="password" onkeyup="validatePassword()"/>
                        <label id="passwordComment"></label>
                    </li>

                    <li>
                        <label for="password2">Password Again<em>*</em>:</label>
                        <input type="password" id="password2" name="password2" onkeyup="validatePassword()"/>
                        <label id="password2Comment"></label>
                    </li>

                </ol>
        </form>

        <div id= "submit_button">
            <input type="button" name="submit" onClick="return validateForm(this)" value="Register">
        </div>

        <div id = "feedback">
            <label id="formFeedback"></label>
        </div>


    </div>
    <script type="text/javascript" src="register.js"></script>

</div>


<!--To add in code to display the same form, only use all php verification.-->
<noscript>
    Your browser does not support JavaScript!

</noscript>


</body>

</html>
