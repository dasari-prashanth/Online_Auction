<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<title>Sell-it-Easy | Homepage</title>
	<link rel="stylesheet" type="text/css" href="CSS.css">

<script>
$(document).ready(function (){
	$('button').click(function() {
	var str = "AddToWishlist.php?id=" + $(this).attr('id');
	window.location = str;
});
});

</script>

</head>
	<body id="SigninSuccessBody">
	<div id="main">
	<?php 
	session_start();
      if(!isset($_SESSION['logged_in'])) {
		   header("Location: SignIn.php"); 
	  } 
      
?>
		<h1> &nbsp Welcome<?php
		$Person = $_SESSION['username']; 
		echo " " . $Person;
		?></h1>
		<div style="float:left"><a href = postadd.php>Post an Ad</a> | <a href = postEvent.php>Post an Event</a> | <?php echo "<a href = ViewMyAds.php?id=$Person>My Ads</a>";?> | <?php echo "<a href = ViewMyEvents.php?id=$Person>My Events</a>";?></div>
		<div style="float:right"> <?php echo "<a href = Wishlist.php?id=$Person>Wishlist</a>";?> | <?php echo "<a href= editProfile.php?id=$Person>Edit Profile</a>"?> | <a href= Logout.php>Log Out</a></div>
		<br><br>
	
	<?php
	
		$servername = "localhost";
		$username = "root";
		$password = "pr@sh@nth1@";
		mysql_connect($servername, $username, $password);
		mysql_select_db('cs687_teamproject');
		
		$todayDate = date("Y-m-d");
		mysql_query("UPDATE Event_Details SET Event_Flag= 0 WHERE Event_date < '$todayDate'");
		
		$result = mysql_query("SELECT * from Item_Details");
	?>
	<div id="viewAds"> 
	All Ads: 
	<table border=0>
		<tr bgcolor='#CCCCCC'>
		<td>Name</td>
		<td>Description</td>
		<td>Cost</td>
		<td>Condition</td>
		<td>Phone Number</td>
		<td>Address</td>
		<td>Category</td>
		<td>Image</td>
		<td>Add to Wishlist</td>
		</tr>
		<?php
		
		while($res = mysql_fetch_array($result)){
			
			$Item = $res["Item_ID"];
			$result4 = mysql_query("select Item_ID, GROUP_CONCAT(Category_Name) as Cat from Category where Item_ID = $Item	 GROUP BY Item_ID;");
			$Cat = mysql_fetch_array($result4);
			echo '<tr>';
            echo '<td>'.$res["Item_Name"].'</td>';
            echo '<td>'.$res["Item_Description"].'</td>';
            echo '<td>'.$res["Cost"].'</td>';   
            echo '<td>'.$res["Item_Condition"].'</td>';    
            echo '<td>'.$res["Phone_Number"].'</td>';
            echo '<td>'.$res["Address"].'</td>';
            echo '<td>'.$Cat["Cat"].'</td>';
            echo '<td><img src="data:image/jpeg;base64,'.base64_encode($res["Item_Image"]).'" alt=" Error loading Image" width="100" height="100"/></td>  ';
			
			$response = mysql_query("SELECT * from Wishlist where User_name = '$Person' and Item_ID = $Item ");
			$res2 = mysql_fetch_array($response);
			if($res2){
				echo '<td>Added to wishlist</td></tr>';
			}
			else{
				echo "<td><button id=\"$res[Item_ID]\">Add To Wishlist</button></td>";
			}
			//echo "<td><button id=\"$res[Item_ID]\">Add To Wishlist</button></td>";
			//echo "<td><a href=\"AddToWishlist.php?id=$res[Item_ID]\">Add</a></td></tr>";
			//remember to delete from wislist table when deleting add from  myAds
		}
		
		?>
	</table>
	</div>
	<br><br>
	<div id="viewEvents">
	Upcoming Events:
		<table border=0>
		<tr bgcolor='#CCCCCC'>
		<td>Name</td>
		<td>Description</td>
		<td>Date</td>
		<td>Place</td>
		<td>Image</td>
		</tr>
		<?php
		$result1 = mysql_query("SELECT * from event_details WHERE Event_Flag = 1 ORDER BY Event_date");
		while($res = mysql_fetch_array($result1)){
			echo '<tr>';
            echo '<td>'.$res["Event_name"].'</td>';
            echo '<td>'.$res["Event_Description"].'</td>'; 
            echo '<td>'.$res["Event_date"].'</td>';   
            echo '<td>'.$res["Place"].'</td>';
			echo '<td><img src="data:image/jpeg;base64,'.base64_encode($res["Event_Image"]).'" alt=" Error loading Image" width="100" height="100"/></td>  ';
		}
		?>
	</table>
	</div><br>
	<div id="viewExpiredEvents">
	Expired Events:
		<table border=0>
		<tr bgcolor='#CCCCCC'>
		<td>Name</td>
		<td>Description</td>
		<td>Date</td>
		<td>Place</td>
		<td>Image</td>
		</tr>
		<?php
		$result3 = mysql_query("SELECT * from event_details where Event_Flag = 0 ORDER BY Event_date");
		if (mysql_num_rows($result3)==0){
			echo "<br> NO EXPIRED EVENTS";}
		else {
			while($res = mysql_fetch_array($result3)){
			echo '<tr>';
            echo '<td>'.$res["Event_name"].'</td>';
            echo '<td>'.$res["Event_Description"].'</td>';  
            echo '<td>'.$res["Event_date"].'</td>';     
            echo '<td>'.$res["Place"].'</td>';
			echo '<td><img src="data:image/jpeg;base64,'.base64_encode($res["Event_Image"]).'" alt=" Error loading Image" width="100" height="100"/></td>  ';
		}
		}	
		?>
	</table>
	</div>
	</div>
	</body>
</html>

