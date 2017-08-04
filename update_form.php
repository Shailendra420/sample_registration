<! DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--<script src="D:\dev\apps\htmlJs\public_html\googleRegistration.js"></script>-->
    <link rel="stylesheet" type="text/css" href="googleRegistration.css">
    <link rel="stylesheet" href="jackocnr-intl-tel-input-v3.5.2-0-g13ddd29\jackocnr-intl-tel-input-ece31e1\build\css\intlTelInput.css">
<img href="jackocnr-intl-tel-input-v3.5.2-0-g13ddd29\jackocnr-intl-tel-input-ece31e1\build\img\flags.png">
<link rel="stylesheet" href="Simple-Flexible-jQuery-Country-Select-Box-Plugin-countrySelector\Simple-Flexible-jQuery-Country-Select-Box-Plugin-countrySelector\src\css\jquery-countryselector.min.css">

</head>
<body>
	<?php
		$name = $lastname = $userName = $password = $retypePassword = $month = $day = $year = $gender = $mobileNumber = $email = $location = $imageFile = "";
			$nameErr =  "";
			//$q = $_GET['q'];echo $q;exit;
			//include 'ajax_username.php';
			//$row['id'] = $_GET['id'];
			//echo $row['id'];
			//echo "<pre>";
			//print_r($_SERVER);print_r($_REQUEST);print_r($_POST);print_r($_FILES);
				$servername = "localhost";
				$username = "root";
				$dbpassword = "";

				// Create connection
				$conn = mysqli_connect($servername, $username, $dbpassword);
				mysqli_select_db($conn,'mydb');

				// Check connection
				if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
				}
				echo "Connected successfully" . "<br>";
				
				$row_id = $_GET['id'];
				echo $row_id;
				$sql = "SELECT id, firstname, lastname, username, password, modify, imagefile FROM users WHERE id = ".$row_id;
			
				$result = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_assoc($result)) {
					$name = $row['firstname'];
					$lastname = $row['lastname'];
					$userName = $row['username'];
					$password = $row['password'];
					$target_file = $row['imagefile'];
				}
				/*$name = $_GET['firstname'];
				$lastname = $_GET['lastname'];
				$userName = $_GET['username'];
				$password = $_GET['password'];*/
				// Create connection
				//include 'ajax_username.php';
				
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				
			  if(empty($_REQUEST["name"])){
				  $nameErr = "Name field is empty";
			  }else{
			  $name = test_input($_REQUEST["name"]);
			  }
			  $lastname = test_input($_POST["lastname"]);
			  $userName = test_input($_POST["userName"]);
			  $password = test_input($_POST["password"]);
			  $retypePassword = test_input($_POST["retypePassword"]);
			  $month = test_input($_POST["month"]);
			  $day = test_input($_POST["day"]);
			  $year = test_input($_POST["year"]);
			  $gender = test_input($_POST["gender"]);
			  /*$mobileNumber = test_input($_POST["mobileNumber"]);
			  $email = test_input($_POST["email"]);
			  $location = test_input($_POST["location"]);*/
			  $target_dir = "uploads/";
			  $target_file = $target_dir . basename($_FILES["imageFile"]["name"]);echo "<pre>";print_r($_FILES);
			  $uploadOk = 1;
			  $imgFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			  if (isset($_POST["submit"])){
				$check = getimagesize($_FILES["imageFile"]["tmp_name"]);
					if($check !== false){
						echo "File is an image -" . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "File is not an image";
						$uploadOk = 0;
					}
			  }
			  // Check if file already exists.
			  if(file_exists($target_file)){
				  echo "Sorry, file already exists.";
				  $uploadOk = 0;
			  }
			  // Check file size.
			  if($_FILES["imageFile"]["size"] > 50000){
				  echo "File size too large.";
				  $uploadOk = 0;
			  }
			  // Allow certain formats of file.
			  if ($imgFileType !== "jpg" && $imgFileType !== "jpeg" && $imgFileType !== "png" && $imgFileType !== "gif"){
				echo "File should be jpg, jpeg, png or gif extention type.";
				$uploadOk = 0;
			  }
			  // Check if set to $uploadOk to 0.
			  if ($uploadOk == 0){
				echo "Sorry, your file was not uploaded.";
			  } else {
					if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)){
						echo "The file ". basename($_FILES["imageFile"]["name"]) . " is successfully uploaded.";
					} else {
						echo "Sorry, there was an error uploading your file";
					}
			  }
				$servername = "localhost";
				$username = "root";
				$dbpassword = "";

				// Create connection
				$conn = mysqli_connect($servername, $username, $dbpassword);
				mysqli_select_db($conn,'mydb');

				// Check connection
				if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
				}
				echo "Connected successfully" . "<br>";
				
				/*$sql = "INSERT INTO users (firstname, lastname, username, password)
				VALUES ('$name', '$lastname', '$userName', '$password')";
				if (empty($name) || empty($lastname) || empty($userName) || empty($password)){
					echo ("You left fields empty");
				}
				else if ($userName === $sql.users.username){
					echo "This username is taken. Please try again!";
				}
				if (mysqli_query($conn, $sql)) {
				echo "New record created successfully" . "<br>";
				header('location:db_form_table.php');
				} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}*/
				
				$sql = "UPDATE users SET firstname= '$name', lastname='$lastname', username='$userName',  imagefile='$target_file' WHERE id='$row_id'";
				//$res = mysql_query($sql) or trigger_error(mysql_error()." in ".$sql);
				if (mysqli_query($conn, $sql)) {
				echo "Record updated successfully";
				header('location:db_form_table.php');
				} else {
				echo "Error updating record: " . mysqli_error($conn);
				}
				}

				function test_input($data) {
				  $data = trim($data);
				  $data = stripslashes($data);
				  $data = htmlspecialchars($data);
				  return $data;
				}
				
				
			
	?>
    <header class="broad">
        <div class="row">
            <div class="col-md-1 col-md-push-11 col-xs-2 col-xs-push-10"><button type="button" class="btn btn-primary form-control">Sign in</button></div>
        </div>
    </header>
    <div class="container text-center top">
        <h1 class="font1">Create your account</h1>
    </div>
    <div class="container-fluid">
		
			<div class="container">
				<div class="containForm">
					<div class="margin">
						<form class="width" id="validate-form" method="post" action='' enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12"><label><strong>Name</strong></label></div>
							</div>

							<div class="form-group row">
								<div class="col-md-6 col-xs-6 padding">
									<div><input type="text" class="form-control common form-text" id="form-first" placeholder="First" name="name" value="<?php echo $name;?>"></div>
									
								</div>
								<div class="col-md-6 col-xs-6">
									<div><input type="text" class="form-control common form-text" id="form-last" placeholder="Last" name="lastname" value="<?php echo $lastname;?>"></div>

								</div>
								<div class="col-md-12 col-xs-12 space"><p class="error-text" id="error-name"></p></div>
							</div>


							<div class="row">
								<div class="col-md-12 col-xs-12" class="form-control"><label>Choose your username</label></div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 col-xs-12">
									<div><input type="text" class="form-control common form-text" id="form-username" name="userName" onkeyup="checkUserName(this.value)" value="<?php echo $userName;?>"></div>
									<span class="atgmail">@gmail.com</span>
									<div><p class="error-text" id="error-username" value=""></p></div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-xs-12" class="form-control"><label>Create a password</label></div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 col-xs-12">
									<div><input type="password" class="form-control common form-text" id="form-password" name="password" value="<?php echo $password;?>"></div>
									<div><p class="error-text" id="error-password"></p></div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-xs-12" class="form-control"><label>Confirm your password</label></div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 col-xs-12">
									<div><input type="password" class="form-control common form-text" id="form-retype-password" name="retypePassword" value="<?php echo $retypePassword;?>"></div>
									<div><p class="error-text" id="error-retype-password"></p></div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-xs-12" class="form-control"><label>Birthday</label></div>
							</div>

							<div class="form-group row">
								<div class="col-md-5 col-xs-5 padding">
								
									<select class="form-control common form-text" id="form-month" name="month" type="hidden">
										<option <?php echo ($month == '')?"selected":"" ?>>Month</option>
										<option <?php echo ($month == 'January')?"selected":"" ?>>January</option>
										<option <?php echo ($month == 'February')?"selected":"" ?>>February</option>
										<option <?php echo ($month == 'March')?"selected":"" ?>>March</option>
										<option <?php echo ($month == 'April')?"selected":"" ?>>April</option>
										<option <?php echo ($month == 'May')?"selected":"" ?>>May</option>
										<option <?php echo ($month == 'June')?"selected":"" ?>>June</option>
										<option <?php echo ($month == 'July')?"selected":"" ?>>July</option>
										<option <?php echo ($month == 'August')?"selected":"" ?>>August</option>
										<option <?php echo ($month == 'September')?"selected":"" ?>>September</option>
										<option <?php echo ($month == 'October')?"selected":"" ?>>October</option>
										<option <?php echo ($month == 'November')?"selected":"" ?>>November</option>
										<option <?php echo ($month == 'December')?"selected":"" ?>>December</option>
									</select>
								</div>
								<div class="col-md-3 col-xs-3 padding"><input class="form-control common form-text" id="form-day" placeholder="Day"  name="day" value="<?php echo $day;?>"></div>
								<div class="col-md-4 col-xs-4"><input class="form-control common form-text" id="form-year" placeholder="Year" name="year" value="<?php echo $year;?>"></div>
								<div class="col-md-12 col-xs-12 space"><p class="error-text" id="error-dob"></p></div>
							</div>
							<div class="row">
								<div class="col-md-12 col-xs-12" class="form-control"><label>Gender</label></div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 col-xs-12">
									<select class="form-control common form-text" id="form-gender" name="gender" value="<?php echo $gender;?>">
										<option <?php echo ($gender == '')?"selected":"" ?>>Select</option>
										<option <?php echo ($gender == 'Female')?"selected":"" ?>>Female</option>
										<option <?php echo ($gender == 'Male')?"selected":"" ?>>Male</option>
										<option <?php echo ($gender == 'Other')?"selected":"" ?>>Other</option>
										<option <?php echo ($gender == 'Rather not say')?"selected":"" ?>>Rather not say</option>
									</select>

									<div><p class="error-text" id="error-gender"></p></div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12 col-xs-12" class="form-control"><label>Mobile phone</label></div>
							</div>
							<div class="form-group row">
								<div class="intl-tel-input col-md-12 col-xs-12">
									<input id="input-phone" type="tel" class="form-control common form-text" id="form-mobile" name="mobileNumber">
									<div><p class="error-text" id="error-mobile"></p></div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-xs-12" class="form-control"><label>Your current email address</label></div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 col-xs-12">
									<input type="text" class="form-control common form-text" id="form-email" name="email">
									<div><p class="error-text" id="error-email"></p></div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-xs-12" class="form-control"><label>Location</label></div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 col-xs-12">
									<select class="form-control common form-text" id="form-location" data-role="country-selector" data-code-mode="alpha3" data-show-flag="false" name="location"></select>
									<div><p class="error-text" id="error-location"></p></div>
								</div>
							</div>

							<div class="form-group row">
								<div class="col-md-2 col-md-push-8 col-xs-2 col-xs-push-9">
									<input type="submit" name="submit" class="btn btn-primary form-cotrol" id="submit" value="Update">
									
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12 col-xs-12"><p class="form-control" id="confirmation"></p></div>
							</div>
							<input type="file" name="imageFile">
						</form>
					</div>
				</div>	
			</div>
		
	</div>
	
    <footer>
		<div class="container-fluid">
        <div class="row mar">
            <div class="col-md-2 col-md-push-1 col-xs-4 col-xs-push-1"><a href="#">Privacy & Terms</a></div>
            <div class="col-md-1 col-xs-6"><a href="#">Help</a></div>
        </div>
		</div>
    </footer>
	
    <script src="jackocnr-intl-tel-input-v3.5.2-0-g13ddd29\jackocnr-intl-tel-input-ece31e1\build\js\intlTelInput.min.js"></script>
    <script src="jackocnr-intl-tel-input-v3.5.2-0-g13ddd29\jackocnr-intl-tel-input-ece31e1\build\js\intlTelInput.js"></script>
	
    <script>
        $(document).ready(function () {
            $("#input-phone").intlTelInput({
                //allowExtensions: true,
                //autoFormat: false,
                //autoHideDialCode: false,
                //autoPlaceholder: false,
                //defaultCountry: "auto",
                //ipinfoToken: "yolo",
                //nationalMode: false,
                //numberType: "MOBILE",
                //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
                //preferredCountries: ['cn', 'jp'],
                //preventInvalidNumbers: true,
                //utilsScript: "lib/libphonenumber/build/utils.js"
				
            });
			//checkUserName();
        });
		
			var errorName = false;
			var errorLastname = false;
			var errorUsername = false;
			var errorPassword = false;
			var errorRetypePassword = false;
			var errorMonth = false;
			var errorDay = false;
			var errorYear = false;
			var errorGender = false;
		
        $(function () {
           /* $("#error-name").hide();*/
            $("#confirmation").hide();
            $("#form-first").focusout(function () { 
                checkName();
            });
			$(".form-text").focus(function () {
                insert();
            });
			$("#form-last").focusout(function () {
                checkLastName();
            });
			$("#form-username").focusout(function () {
                checkUserName();
            });
			$("#form-password").focusout(function () {
                checkPassword();
            });
			$("#form-retype-password").focusout(function () {
				reCheckPassword();
				equalTo();
            });
			$("#form-month").focusout(function () {
				checkMonth();
			});
			$("#form-day").focusout(function () {
				checkDay();
			});
			$("#form-year").focusout(function () {
				checkYear();
			});
			$("#form-gender").focusout(function () {
				checkGender();
			});
        });
		
		function insert(){
			var focusElement = $(".form-text").val();
			$("focusElement").css("border", "1px solid blue");
		}
        function checkName() {
            var name = $("#form-first").val();
            console.log("firstname " + name);
            if ((/^[\s]*$/i.test(name))) {
                $("#form-first").css("border", "1px solid red");
                $("#error-name").html("You can't leave this empty.").css("color","red");
                $("#error-name").show();
            } 
			else if ((/[0-9@#$%&*"]+/gi.test(name))) {
                $("#form-first").css("border", "1px solid red");
                $("#error-name").html("Please enter only alphabets.").css("color","red");
                $("#error-name").show();
            } 
			else  if ((/[a-zA-Z]+/i.test(name))) {
                $("#form-first").css("border","none");
                $("#error-name").html("").css("color","none");
                $("#error-name").hide();
				errorName = true;
            }
			
        }
		function checkLastName() {
            var lastName = $("#form-last").val();
            console.log("lastname " + lastName);
            if ((/^[^a-zA-Z]*$/g.test(lastName))) {
                $("#form-last").css("border", "1px solid red");
                $("#error-name").html("You can't leave this empty.").css("color","red");
                $("#error-name").show();
            } else {
                $("#form-last").css("border","none");
                $("#error-name").html("").css("");
                $("#error-name").hide();
				errorLastname = true;
            }
        }
		function checkUserName(userName) {
            var userName = document.getElementById("form-username").value;
            console.log("username " + userName);
            if (userName === "") {
                $("#form-username").css("border", "1px solid red");
                $("#error-username").html("You can't leave this empty.").css("color","red");
                $("#error-username").show();
            } else {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("error-username").innerHTML = xhttp.responseText;
				console.log("Response text is "+xhttp.responseText);
			}
			};
				xhttp.open("GET", "ajax_username.php?q=" + userName, true);
				xhttp.send();
			}
			/*else if((/^[a-z0-9.]+$/i.test(userName))){
                $("#form-username").css("border","none");
                $("#error-username").html("").css("");
                $("#error-username").hide();
				errorUsername = true;
            }*/
        }
		function checkPassword() {
            var password = $("#form-password").val();
			
            console.log("password " + password);
            if (password === ""){ 
		console.log("password in if " + password);
                $("#form-password").css("border", "1px solid red");
                $("#error-password").html("You can't leave this empty.").css("color","red");
                $("#error-password").show();
            } else if (/^[A-Za-z\d$@$!%*?&]{8,}$/g.test(password)){
                $("#form-password").css("border","none");
                $("#error-password").html("").css("");            
                $("#error-password").hide();
				errorPassword = true;
            }
        }
		function reCheckPassword() {
            var password1 = $("#form-retype-password").val();
			
            console.log("password1 " + password1);
            if (password1 === "") {
                $("#form-retype-password").css("border", "1px solid red");
                $("#error-retype-password").html("You can't leave this empty.").css("color","red");
                $("#error-retype-password").show();
				
            }
		}
			function equalTo(){
				var password = $("#form-password").val();
				var password1 = $("#form-retype-password").val();
				if(password !== ""){
					if(password1 === password){
						$("#form-retype-password").css("border","none");
						$("#error-retype-password").html("").css("");
						$("#error-retype-password").hide();
						errorRetypePassword = true;
					}else if(password1 !== ""){
						$("#form-retype-password").css("border", "1px solid red");
						$("#error-retype-password").html("These passwords dont match. Try again?").css("color","red");
						$("#error-retype-password").show();
					}
				}
			}
			function checkMonth() {
				var month = $("#form-month").val();
				console.log("month " + month);
				if (month === "Month") {
					$("#form-month").css("border", "1px solid red");
					$("#error-dob").html("Please choose appropriate month.").css("color","red");
					$("#error-dob").show();
				} else{
					$("#form-month").css("border","none");
					$("#error-dob").html("").css("");
					$("#error-dob").hide();
					errorMonth = true;
				}
			}
			function checkDay() {
				var x = $("#form-day").val();
				var month = $("#form-month").val();
				var day = parseInt(x);
				console.log("date " + day);
				if (x === "") {
					console.log("date " + day);
					$("#form-day").css("border", "1px solid red");
					$("#error-dob").html("You can't leave this empty.").css("color","red");
					$("#error-dob").show();
				}	
				 else if(day !== ""){
					if ((isNaN(day)) || day > 31) {
						$("#form-day").css("border", "1px solid red");
						$("#error-dob").html("Please enter valid date of the month.").css("color","red");
						$("#error-dob").show();
						}
						
						else {
						$("#form-day").css("border","none");
						$("#error-dob").html("").css("");
						$("#error-dob").hide();
						errorDay = true;
						}
				}
				
			}
			function checkYear() {
				var y = $("#form-year").val();
				var year = parseInt(y);
				console.log("year " + year);
				var d = new Date();
				var y1= d.getFullYear();
				var x = $("#form-day").val();
				var month = $("#form-month").val();
				var day = parseInt(x);
				var monthOf_31 = ["January","March","May","July","August","October","December"]; 
				var monthOfThirty = ["April","June","September","November"];
				var i = 0;
				if (y == "") {
					$("#form-year").css("border", "1px solid red");
					$("#error-dob").html("You can't leave this empty.").css("color","red");
					$("#error-dob").show();
				} else if ((isNaN(year)) || year > (y1 - 2)) {
						$("#form-year").css("border", "1px solid red");
						$("#error-dob").html("Please enter valid year.").css("color","red");
						$("#error-dob").show();
				}else if(day == 31 &&  (month == "April" || month == "June" || month == "September" || month == "November")){
						for(i=0;i<monthOfThirty.length;i++){
							if(monthOfThirty[i] == month){
							$("#form-year").css("border", "1px solid red");
							$("#error-dob").html("The month you entered only contains 30 days.").css("color","red");
							$("#error-dob").show();
								/*monthOf_30();*/
							}
						}
						
				}else if(month == "February" && day == 29 && year%4 != 0 ){
						$("#form-year").css("border", "1px solid red");
						$("#error-dob").html("The date you entered only appers in leap year.").css("color","red");
						$("#error-dob").show();	
				}
				else {
					$("#form-year").css("border","none");
					$("#error-dob").html("").css("");
					$("#error-dob").hide();
					errorYear = true;
				}
			}
			function checkGender() {
				var gender = $("#form-gender").val();
				console.log("gender " + gender);
				if (gender == "Select") {
					$("#form-gender").css("border", "1px solid red");
					$("#error-gender").html("Please choose appropriate option.").css("color","red");
					$("#error-gender").show();
				} else{
					$("#form-gender").css("border","none");
					$("#error-gender").html("").css("");
					$("#error-gender").hide();
					errorGender = true;
				}
			}
			$(function(){
				$("#submit").focus(function(){
					
					checkName();
					checkLastName();
					checkUserName();
					checkPassword();
					reCheckPassword();
					equalTo();
					checkMonth();
					checkDay();
					checkYear();
					checkGender();
					if(errorName == true 
					&& errorLastname == true 
					&& errorUsername == true 
					&& errorPassword == true 
					&& errorRetypePassword == true 
					&& errorMonth == true 
					&& errorDay == true 
					&& errorYear == true 
					&& errorGender == true){
						$("#confirmation").html("Everything looks good and your form has been submitted.");
						$("#confirmation").show();
					}else {
						$("#confirmation").html("Someting is missing.");
						$("#confirmation").show();
						
					}
					
					console.log("true or false: " + errorName);
					console.log("true or false: " + errorLastname);
					console.log("true or false: " + errorUsername);
					console.log("true or false: " + errorPassword);
					console.log("true or false: " + errorRetypePassword);
					console.log("true or false: " + errorMonth);
					console.log("true or false: " + errorDay);
					console.log("true or false: " + errorYear);
					console.log("true or false: " + errorGender);
					errorName = false;
					errorLastname = false;
					errorUsername = false;
					errorPassword = false;
					errorRetypePassword = false;
					errorMonth = false;
					errorDay = false;
					errorYear = false;
					errorGender = false;
				});
			});
			/*$(function(){
				$("#submit").focusout(function(){
					errorName = false;
					errorLastname = false;
					errorUsername = false;
					errorPassword = false;
					errorRetypePassword = false;
					errorMonth = false;
					errorDay = false;
					errorYear = false;
					errorGender = false;
					console.log("true or false: " + errorName);
					console.log("true or false: " + errorLastname);
					console.log("true or false: " + errorUsername);
					console.log("true or false: " + errorPassword);
					console.log("true or false: " + errorRetypePassword);
					console.log("true or false: " + errorMonth);
					console.log("true or false: " + errorDay);
					console.log("true or false: " + errorYear);
					console.log("true or false: " + errorGender);
				});
					
			});*/
			
					/*else {
						$("#form-day").css("border","none");
						$("#error-dob").html("").css("");
						$("#error-dob").hide();
					}*/
				
			
    </script>
    <!-- Code for country code goes here -->
    <script src="Simple-Flexible-jQuery-Country-Select-Box-Plugin-countrySelector\Simple-Flexible-jQuery-Country-Select-Box-Plugin-countrySelector\src\js\jquery.countrySelector.js"></script>
	
	<?php
		
		/*echo "hello";
		echo $name;
		echo $nameErr;
		echo "<br>";
		echo $lastname;
		echo "<br>";
		echo $userName;
		echo "<br>";
		echo $password;
		echo "<br>";
		echo $retypePassword;
		echo "<br>";
		echo $month;
		echo "<br>";
		echo $day;
		echo "<br>";
		echo $year;
		echo "<br>";
		echo $gender;
		echo "<br>";*/
		/*echo $mobileNumber;
		echo "<br>";
		echo $email;
		echo "<br>";
		echo $location;
		echo "<br>";*/
	?>
		
	
	
	
</body>