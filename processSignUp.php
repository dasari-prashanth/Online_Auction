<?php
$servername = "localhost";
$username = "root";
$password = "pr@sh@nth1@";

mysql_connect($servername, $username, $password);
mysql_select_db('cs687_teamproject');
//echo "connected sucessfully";
$Fname=$_POST["Fname"];
$Lname=$_POST["Lname"];
$Mname=$_POST["Mname"];
$Email=$_POST["email"];
$password=$_POST["password"];
$username2=$_POST["username"];

$result = mysql_query("INSERT INTO User_Details ( F_Name, L_Name, M_Name, Email_ID, User_name, Password ) VALUES ( '$Fname', '$Lname', '$Mname', '$Email', '$username2' ,'$password' );");
if($result){
	mysql_close();
	session_start();
	$_SESSION['username'] = $username2;
	$_SESSION['logged_in'] = true;
	echo '<script>window.location = "SignInSucess.php";</script>';
}

else {
	echo '<script>alert("Signup Failed. Please use a different Username/email.");window.location = "Signup.php"</script>';
}
?>
