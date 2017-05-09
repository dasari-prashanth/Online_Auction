<html>
<head>
	<link rel="stylesheet" type="text/css" href="CSS.css">
</head>
<title>Sell-it-Easy | My Events</title>
	<body>
	<div id="main">
		<h3>Welcome<?php
		session_start();
		$Person = $_SESSION['username']; 
		echo " " . $Person;
		?></h3>
		<div style="float:left"><a href= SignInSucess.php>Home</a></div>
		<div style="float:right"> <a href= Logout.php>Log Out</a></div>
		<br><br>
	
	<?php
	
		$servername = "localhost";
		$username = "root";
		$password = "pr@sh@nth1@";
		mysql_connect($servername, $username, $password);
		mysql_select_db('cs687_teamproject');
		
		$id = $_GET['id'];
		
		$result = mysql_query("SELECT * from event_details where User_name = '$id' ORDER BY Event_date");
	?>
	<div id="viewAds"> 
	All Events: 
	<table border=0>
		<table border=0>
		<tr bgcolor='#CCCCCC'>
		<td>Name</td>
		<td>Description</td>
		<td>Date</td>
		<td>Place</td>
		<td>Image</td>
		<td>Delete</td>
		</tr>
		<?php
		while($res = mysql_fetch_array($result)){
			echo '<tr>';
            echo '<td>'.$res["Event_name"].'</td>';
            echo '<td>'.$res["Event_Description"].'</td>'; 
            echo '<td>'.$res["Event_date"].'</td>';   
            echo '<td>'.$res["Place"].'</td>';
			echo '<td><img src="data:image/jpeg;base64,'.base64_encode($res["Event_Image"]).'" alt=" Error loading Image" width="100" height="100"/></td>  ';
            echo "<td><a href=\"editEvent.php?id=$res[Event_ID]\">Edit</a> | <a href=\"deleteEvent.php?id=$res[Event_ID]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td></tr>";
		}
		?>
	</table>
	</div>
	</div>
	</body>
</html>

