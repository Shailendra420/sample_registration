<?php
	$servername = "localhost";
	$username = "root";
	$dbpassword = "";
	$q = $_REQUEST['q'];//echo $q;//exit;
	// Create connection
	$conn = mysqli_connect($servername, $username, $dbpassword);
	mysqli_select_db($conn,'mydb');

	// Check connection
	/*if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully" . "<br>";*/
	$sql="SELECT username FROM users";//echo $sql;exit; //WHERE id = '".$q."'";
	//$result1 = mysqli_query($conn,$sql);
	$result = mysqli_query($conn, $sql);//print_r($result);//exit;
	$storeArray = Array();
	$arr = Array();
	while ($row = mysqli_fetch_array($result)) { //MYSQLI_ASSOC
    $storeArray[] =  $row['username'];//echo $storeArray . "<br>";
	//echo gettype($storeArray);
	} 
	//print_r($row);exit;
	//echo "<pre>";
	//print_r(array_values($storeArray));//exit;
		$arrlength = count($storeArray);//echo $arrlength;echo $q;exit;
		//for($i=0; $i<$arrlength; $i++){
			if (in_array($q, $storeArray)) {
				//echo $storeArray[$i];echo $q;exit;
				echo "Username is taken. Please try another one. ";
			} else {
				echo "Available, go ahead.";
			}
		//}
	
?>