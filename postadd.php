<html>
	<head><title>Post-an-Ad</title>
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
		<h2 id="postAddH1"> Post an Advertisement </h2>
		<form method="post" enctype="multipart/form-data">
		<table border="0">
			<tr><td><h1 class="postAddH2">Item Name:</h1></td><td>  <input type="text" name="ItemName" required /></td></tr>
			<tr><td><h1 class="postAddH2">Condition:</h1></td><td><select name="condition">
							<option value="New" selected="selected">New</option>
							<option value="Used">Used</option>
						</select></td></tr>
			<tr><td><h1 class="postAddH2">Description:</h1></td><td><input type="text" name="Description" required/></td></tr>
			<tr><td><h1 class="postAddH2">Cost:      </h1> </td><td><input type="number" name="Cost" min="0" required/></td></tr>
			<tr><td><h1 class="postAddH2">Category: </h1> </td><td> <select name="Category[]" multiple="multiple">
							<option value="Books">Books</option>
							<option value="Electronics">Electronics & Computers</option>
							<option value="Health and Beauty">Beauty, Health & Food</option>
							<option value="Home,Furniture and Tools">Home, Garden & Tools</option>
							<option value="Clothing">Clothing, Shoes & Jewelry</option>
							<option value="Sports">Sports & Outdoors</option>
							<option value="Automotive">Automotive & Industrial</option>	
							<option value="Other" selected="selected">Other</option>
						</select></td></tr>
			<tr><td><h1 class="postAddH2">Phone number</h1></td><td><input name="PhoneNumber" type="tel" pattern="^\d{10}$"  placeholder="xxxxxxxxxx"  required /></td></tr>
			<tr><td><h1 class="postAddH2">Address: </h1></td><td>   <input type="text" name="Address" required/></td></tr>
			<tr><td><h1 class="postAddH2">Image (Max 8Mb): </h1></td> <td> <input type="file" name="image" required/></td></tr>
		</table><br><br>
			<input type="submit" name="sumit" value="Post Ad" />
			<input id="submit1" type="reset" value="Clear"/>
		</form>
	</center>
		<?php
			if(isset($_POST['sumit']) && !empty($_POST['sumit'])){
			//echo "In php ";
				if(getimagesize($_FILES['image']['tmp_name']) == FALSE){
					echo '<script>alert("Please select an Image.")';
				}
				else {
					$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
					saveimage($image);
				}
			}
			
			function saveimage($image){
				$ItemName = $_POST["ItemName"];
				$Description = $_POST["Description"];
				$Cost = $_POST["Cost"];
				$Category1 = $_POST["Category"];
				$Category = implode("," , $_POST["Category"]);
				$Phone = $_POST["PhoneNumber"];
				$Address = $_POST["Address"];
				$Condition = $_POST["condition"];
				$ItemId = rand();
				$Username = $_SESSION["username"];
				
				$servername = "localhost";
				$username = "root";
				$password = "pr@sh@nth1@";

				mysql_connect($servername, $username, $password);
				mysql_select_db('cs687_teamproject');
				$qry="insert into Item_Details (Item_ID,Item_Name,User_name,Item_Description,Cost,Phone_Number,Address,Item_Image,Item_Condition) values ( '$ItemId','$ItemName','$Username','$Description','$Cost','$Phone','$Address','$image','$Condition')";
				$result  = mysql_query($qry)or die("Upload Error " . mysql_errno().":" .mysql_error());
				if($result){
					for ($i=0; $i<sizeof($Category1); $i++)
					{
							$query="INSERT INTO Category (Item_ID,Category_Name) VALUES ('$ItemId','" . $Category1[$i] . "')";     

							mysql_query($query) or die ();
					}
					echo '<script>alert("Ad posted sucessfully");window.location = "SignInSucess.php";</script>';
					mysql_close();
					
				}
			}
		?>
	</body>
</html>