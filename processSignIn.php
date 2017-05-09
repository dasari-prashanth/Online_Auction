<?php
$username1 = $_POST["name"];
$password1 = $_POST["password"];
$servername = "localhost";
$username = "root";
$password = "pr@sh@nth1@";

mysql_connect($servername, $username, $password);
mysql_select_db('cs687_teamproject');
session_start();
$_SESSION['username'] = $username1;


//echo "connected sucessfully";

$result = mysql_query("select * from User_Details where User_name = '$username1' ")
			or die("failed to execute query:" . mysql_error());
$row = mysql_fetch_array($result);
if ($row["User_name"] == $username1 && $row["Password"] == $password1){
	mysql_close();
	$_SESSION['logged_in'] = true;
	echo '<script>window.location = "SignInSucess.php";</script>';
}
else{
	echo "<br><br><br><br><center><b>Invalid Username/Password!! Please try again.</b></center>";
	echo '<script>setTimeout(function () {window.location = "SignIn.php";}, 2000)</script>';
}


?>
