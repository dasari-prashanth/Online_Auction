<html>
<head>
	<link rel="stylesheet" type="text/css" href="CSS.css">
</head>
<title>Sell-it-Easy | Wishlist</title>
	<body>
	<?php 
	session_start();
      if(!isset($_SESSION['logged_in'])) {
		   header("Location: SignIn.php"); 
	  } 
      
?>
	<div id="main">
		<h3>Welcome<?php
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
		
		$result = mysql_query("SELECT * from item_details, Wishlist where Item_Details.Item_ID = wishlist.Item_Id and Wishlist.User_name = '$id'");
	?>
	<div id="viewWishlist"> 
	Wishlist: 
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
		<td>Remove from Wishlist</td>
		</tr>
		<?php
		
		while($res = mysql_fetch_array($result)){
			$Item = $res["Item_ID"];
			$result4 = mysql_query("select Item_ID, GROUP_CONCAT(Category_Name) as Cat from Category where Item_ID = $Item GROUP BY Item_ID;");
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
            echo "<td><a href=\"RemoveFromWishlist.php?id=$res[Item_ID]\">Remove</a></td></tr>";
		}
		
		?>
	</table>
	</div>
	</div>
	</body>
</html>