function validateForm(){
    if(validateName() == true && validateEmail() == true && validatePassword() == true){
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var password2 = document.getElementById("password2").value;
        //Validation Finished, execute php to complete.
        $.ajax({
            type: 'POST',
            url: 'registeruser.php',
            data: {'username':username, 'email':email, 'password':password, 'password2':password2},
            dataType: 'json',
            success: function(data){
                var returnValue = data.return_value;
                var returnmessage = data.message;
                if(returnValue == 0){
                    producePrompt(returnmessage, "formFeedback", "black");
                    document.getElementById("feedback").style.backgroundColor = "#FF6666";
                    alert("User was unsuccessfully created.")
                }else{
                    producePrompt(returnmessage, "formFeedback", "black");
                    document.getElementById("feedback").style.backgroundColor = "#99FF66";
                }
            }
        });

    }
}

function validateName(){
    var username = document.getElementById("username").value;
    var nameRegex = /^[a-zA-Z0-9\-]+$/;
    if(username.length == 0){
        producePrompt("Name is Required", "nameComment", "#FF6666");
        colorField("username", "#FF6666");
        return false;
    }
    if(username.length > 15){
        producePrompt("Username is too Long", "nameComment", "#FF6666");
        colorField("username", "#FF6666");
        return false;
    }
    if(username.length < 4){
        producePrompt("Username is too Short", "nameComment", "#FF6666");
        colorField("username", "#FF6666");
        return false;
    }
    if(!username.match(nameRegex)){
        producePrompt("Username can only contain A-Z, a-z and '-'", "nameComment", "#FF6666");
        colorField("username", "#FF6666");
        return false;
    }

    producePrompt("Name is Valid", "nameComment", "#99FF66");
    colorField("username", "#99FF66");
    return true;
}

function validateEmail(){
    var email = document.getElementById("email").value;
    var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

    if(email.length == 0){
        producePrompt("Email is Required", "emailComment", "#FF6666");
        colorField("email", "#FF6666");
        return false;
    }
    if(!email.match(reEmail)) {
        producePrompt("Invalid Email", "emailComment", "#FF6666");
        colorField("email", "#FF6666");
        return false;
    }
    producePrompt("Valid Email", "emailComment", "#99FF66");
    colorField("email", "#99FF66");
    return true;
}

function validatePassword(){
    var password = document.getElementById("password").value;
    var password2 = document.getElementById("password2").value;
    var weakRegex = new RegExp("(?=.{6,}).*", "g");
    var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
    var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W).*$", "g");

    if(password.length == 0){
        producePrompt("Password Required", "passwordComment", "#FF6666");
        colorField("password", "#FF6666");
        return false;
    }
    if(password2.length == 0){
        producePrompt("Password Required", "password2Comment", "#FF6666");
        colorField("password2", "#FF6666");
        return false;
    }
    if(password != password2){
        producePrompt("Passwords must Match!", "passwordComment", "#FF6666");
        colorField("password", "#FF6666");
        return false;
    }
    if(password2 != password){
        producePrompt("Passwords must Match!", "password2Comment", "#FF6666");
        colorField("password2", "#FF6666");
        return false;
    }
    if(password == password2){

        if(password.length < 5){
            producePrompt("Passwords must be longer than 5 characters", "passwordComment", "#FF6666");
            producePrompt("Passwords must be longer than 5 characters", "password2Comment", "#FF6666");
            colorField("password", "#FF6666");
            colorField("password2", "#FF6666");
            return false;
        }else{

            if(mediumRegex.test(password)){
                producePrompt("Moderate Password", "passwordComment", "yellow");
                producePrompt("Moderate Password", "password2Comment", "yellow");
                colorField("password", "#99FF66");
                colorField("password2", "#99FF66");
                return true;
            }
            if(strongRegex.test(password)){
                producePrompt("Strong Password", "passwordComment", "#99FF66");
                producePrompt("Strong Password", "password2Comment", "#99FF66");
                colorField("password", "#99FF66");
                colorField("password2", "#99FF66");
                return true;
            }
            producePrompt("Weak Password", "passwordComment", "orange");
            producePrompt("Weak Password", "password2Comment", "orange");
            colorField("password", "#99FF66");
            colorField("password2", "#99FF66");
            return true;
        }
    }
}

function producePrompt(message, promptLocation, color){
    document.getElementById(promptLocation).innerHTML = message;
    document.getElementById(promptLocation).style.color = color;
}

function colorField(fieldLocation, color){
    document.getElementById(fieldLocation).style.background = color;
}
