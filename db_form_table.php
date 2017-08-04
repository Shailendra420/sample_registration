<!DOCTYPE html>
<html>
	<head>
		<style>
			body {
				background-color: cornflowerblue;
				
			}
		</style>
	</head>
	<body>
		<?php
			$name = $lastname = $userName = $password = $imageFile = "";
			$servername = "localhost";
			$username = "root";
			$dbpassword = "";
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["imageFile"]["name"]);//echo "<pre>";print_r($_FILES);
			include 'uploads';
			// Create connection
			$conn = mysqli_connect($servername, $username, $dbpassword);
			mysqli_select_db($conn,'mydb');

			// Check connection
			if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			}
			echo "Connected successfully" . "<br>";
			
			
			$sql = "SELECT id, firstname, lastname, username, password, modify, imagefile FROM users";
			//$sql = "UPDATE users SET imagefile= '$target_file' WHERE id='LAST_INSERT_ID()'"
			$result = mysqli_query($conn, $sql);
			print_r($result);
			echo "<pre>";
			if (mysqli_num_rows($result) > 0) {
			 //output data of each row
			echo "<table cellpadding='10'><tr><th>Sr no.</th><th>Name</th><th>Lastname</th><th>Username</th><th>Password</th><th>Modify</th><th>Imagefile</th></tr>";
			
			$i = 1;
			//$row["modify"] = "edit";
			while($row = mysqli_fetch_assoc($result)) {
				//print_r($row);
			
			echo "<tr><td>". $i ."</td> <td>" . $row["firstname"]."</td> <td>" . $row["lastname"]."</td> <td>" . $row["username"]."</td>  <td>" . $row["password"]."</td> <td><a href=\"update_form.php?id=".$row["id"]."\">" . $row["modify"] ."</a></td> <td>". $row["imagefile"] . "</td> </tr>" . "<br>";
			$i++;
			}
			echo "<table>";
			} else {
			echo "0 results";
			}
			


			mysqli_close($conn);
		?>
	</body>
</html>		