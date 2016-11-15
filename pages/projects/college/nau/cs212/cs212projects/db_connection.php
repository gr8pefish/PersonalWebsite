<?php
    $dbhost = 'tund.cefns.nau.edu'; //'localhost'; //
    $dbuser = 'mw834';
    $dbpass = 'e2tyvhR9PjbpjTjm'; //'password'; //
    $db = 'mw834';

    $conn = mysql_connect("$dbhost","$dbuser","$dbpass")or die(mysql_error());
    $select = mysql_select_db("$db")or die(mysql_error());

?>