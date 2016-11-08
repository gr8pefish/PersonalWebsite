<?php
include 'db_connection.php';

echo '<h2>Administrator Options</h2>';
echo '<div id = "#">';
echo '<form action="archive.php">';
echo '<input type="submit" value="Archive Log">';
echo '</form>';
echo '</div>';

//Display user activity by searching by ID
echo '<div id = user_activity>';
echo '<form method = "POST">';
echo '<input type = "text" name="searchname"';
echo '<div id ="searchbutton">';
echo '<input type = "submit" name = "findactivity" value="Find User Activity">';
echo '</div>';
echo '</form>';
if (isset($_POST['findactivity'])){
    $searchname = $_POST['searchname'];
    //Check if the account exists
    $query = mysql_query("SELECT * FROM members WHERE username='".$searchname."'");
    $numrows = mysql_num_rows($query);

    if($numrows != 0){
        while($row = mysql_fetch_assoc($query)){
            $searchID = $row['id'];
        }
        mysql_select_db("mw834", $conn);
        $sql1 = "SELECT * FROM useractivity";
        $memberData = mysql_query($sql1, $conn);
        echo "<h4>$searchname's Activity:</h4>";
        echo "<table border = 1>
			<tr>
			<th>Id</th>
			<th>name</th>
			<th>Login Time</th>
			<th>Logout Time</th>
			</tr>";
        while($record1 = mysql_fetch_array($memberData)){
            if($record1['id'] == $searchID){
                echo "<tr>";
                echo "<td>".$record1['id']."</td>";
                echo "<td>".$record1['username']."</td>";
                echo "<td>".$record1['login']."</td>";
                echo "<td>".$record1['logout']."</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }else{
        echo "User does not exist.";
    }
}


//Print out all members information
echo '<div id = "display_users">';

mysql_select_db("mw834", $conn);
$sql = "SELECT * FROM members";
$memberData = mysql_query($sql, $conn);

echo "<h4>All Users Information:</h4>";
echo "<table border = 1>
	<tr>
	<th>Id</th>
	<th>Name</th>
	<th>Email</th>
	</tr>";

while($record = mysql_fetch_array($memberData)){
    echo "<tr>";
    echo "<td>".$record['id']."</td>";
    echo "<td>".$record['username']."</td>";
    echo "<td>".$record['email']."</td>";
    echo "</tr>";
}
echo "</table>";
mysql_close($conn);
echo '</div>';

?>