<!DOCTYPE html>
<html lang="en">

<head>

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

    <!-- Theme CSS -->
    <link href="../../../../../../scss/main.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="../../../../../../index.html#page-top">
                    <i class="fa fa-home"></i> Home
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="page-scroll" href="#p2-form">Form</a>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Other Projects<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="project1.html">Project 1</a>
                            </li>
                            <li>
                                <a href="project2.html">Project 2</a>
                            </li>
                            <li>
                                <a href="project3.html">Project 3</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro" id="project2-intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Project 5</h1>
                        <p class="intro-text">A PHP powered email form.
                            <br>Scroll down for the form, scroll further for the output.</p>
                        <a href="#p2-form" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

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

    <!-- Form Section -->
    <section id="p2-form" class="content-section-medium text-center">
        <div class="p2-form-row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h3>Send me a Message</h3>
                        <h7><span class="error">* = required field</span></h7><br><br>
                        <form name="sentMessage" method="post" id="contactForm" novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#p2-form">
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label><span class="error">* <?php echo $nameError;?></span>Full Name <i class="fa fa-user"></i></label>
                                    <input type="text" class="form-control" id="name" name="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label><span class="error">* <?php echo $phoneError;?></span>Phone Number <i class="fa fa-phone"></i></label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required data-validation-required-message="Please enter your phone number.">
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label><span class="error">* <?php echo $emailError;?></span>Email Address <i class="fa fa-envelope-o"></i></label>
                                    <input type="email" class="form-control" id="email" name="email" required data-validation-required-message="Please enter your email address.">
                                </div>
                            </div>
                            <div class="control-group misc-group">
                                <h7><label for="question">Question</label> <input type="radio" name="msg_type" id="question" value="question"></h7>
                                <h7><label for="comment">Comment</label> <input type="radio" name="msg_type" id="comment" value="comment"></h7>
                                <h7><label for="urgent">Urgent</label> <input type="radio" name="msg_type" id="urgent" value="urgent"></h7>
                                <br>
                                <h7><label for="reply">Send a reply please!</label> <input type="checkbox" name="reply" id="reply" value="reply"></h7>
                                <br><br>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label><span class="error">* <?php echo $messageError;?></span>Message:</label>
                                    <textarea rows="10" cols="100" class="form-control" id="message" name="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                                </div>
                            </div>
                            <div id="success"></div>
                            <!-- For success/fail messages -->
                            <button type="submit" class="btn btn-primary" id="p2form">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    echo "<h2>Inputted data from previous (to be sent in Project 6):</h2>";
    echo "<h7><br>Name: </h7>";
    echo $name;
    echo "<h7><br>Phone number: </h7>";
    echo $phone;
    echo "<h7><br>Email: </h7>";
    echo $email;
    echo "<h7><br>Message: </h7>";
    echo $message;
    ?>

    <!-- Footer -->
    <footer>
        <div class="container content-section text-center">
            <p>Copyright &copy; Max Wason 2016</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="../../../../../../vendor/jquery/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../../../../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="../../../../../../js/main.js"></script>

</body>

</html>


