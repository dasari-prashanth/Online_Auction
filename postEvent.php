<html>
	<head><title>Post-an-Event</title>
		<link rel="stylesheet" type="text/css" href="CSS.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</head>
	<body id="postAddBody">
	<?php 
		session_start();
      if(!isset($_SESSION['logged_in'])) {
		   header("Location: SignIn.php"); 
	  } ?>	
	<a href="SignInSucess.php" style="float:left">Home</a>
	<a href="Logout.php" style="float:right">Logout</a>
	<center>
		<h2 id="postAddH1"> Post an Event </h2>
		<form method="post" enctype="multipart/form-data">
		<table border="0">
			<tr><td><h2 class="postAddH2">Event Name:</h2></td><td>  <input type="text" name="EventName" required /></td></tr>
			<tr><td><h2 class="postAddH2">Description:</h2></td><td><input type="text" name="Description" required/></td></tr>
			<tr><td><h2 class="postAddH2">Place:</h2></td><td><input type="text" name="Place" required/></td></tr>
			<tr><td><h1>Event Date:</h1></td><td><input type="date" name="EventDate" required/></td></tr>
			<tr><td><h2 class="postAddH2">Image (Max 8Mb): </h2></td> <td> <input type="file" name="image" required/></td></tr>
		</table><br><br>
			<input type="submit" name="sumit" value="Post Event" />
			<input id="submit1" type="reset" value="Clear"/>
		</form>
	</center>
		<?php
			if(isset($_POST['sumit']) && !empty($_POST['sumit'])){
				if(getimagesize($_FILES['image']['tmp_name']) == FALSE){
					echo '<script>alert("Please select an Image.")';
				}
				else {
					
					$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
					
					saveimage($image);
				}
			}
			
			function saveimage($image){
				$EventName = $_POST["EventName"];
				$Description = $_POST["Description"];
				$Date = date("Y-m-d",strtotime($_POST["EventDate"]));
				$Address = $_POST["Place"];
				$EventId = rand();
				
				$Username = $_SESSION["username"];
				$servername = "localhost";
				$username = "root";
				$password = "pr@sh@nth1@";

				mysql_connect($servername, $username, $password);
				mysql_select_db('cs687_teamproject');
				$qry="insert into Event_Details (Event_ID,Event_name,User_name,Event_Description,Event_date,Place,Event_Flag,Event_Image) values ( '$EventId','$EventName','$Username','$Description','$Date','$Address','1','$image')";
				$result  = mysql_query($qry)or die("Upload Error " . mysql_errno().":" .mysql_error());
				if($result){
					echo '<script>alert("Event posted sucessfully!!");window.location = "SignInSucess.php";</script>';
					mysql_close();
					
				}
				echo "<script>alert('Action Failed!!<br>Please post Again');</script>";
			}
				
		?>
	</body>
</html>