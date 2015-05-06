<html>
<head> <link rel="stylesheet" type="text/css" href="./signup.css"></head>
<body>
<?php
	require 'User.php';

	// Create connection
	$conn = new mysqli($servername, $username, $password, 'Medical');
	//$dbname="Medical";
	//mysql_select_db($dbname);
	$nameErr = $idErr = $passwordErr = $confirmErr = "";
	$id = $name = $password  ="";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	   $gender = $_POST["gender"];
	   if (empty($_POST["UserName"])) {
	     $nameErr = "Name is required";
	   } else {
	     $name = test_input($_POST["UserName"]);
	   }
	   $ida=$_POST["Id"];
		
		if (empty($_POST["Id"])) {
	     $idErr= "Id is required";
	   } else {
	 
	   //	var_dump($sql);
	   	//var_dump($conn);
	   	if($gender=='P')
	   	$result = $conn->query("SELECT * FROM Patient where P_SSN=$ida");
	   if($gender=='D')
	   	$result = $conn->query("SELECT * FROM Doctor where D_SSN=$ida");
	   //	mysqli_close($conn);
	   	//$conn=NULL:
	   //	var_dump($conn);
	  // 	var_dump($result);
	     $id = $gender.$_POST["Id"];
	     if($result->num_rows==0){
	     	$idErr="Id not present";
	     }
	 }
		
	   
	    
	   if (empty($_POST["Password"])) {
	     $passwordErr = "Password is required";
	   } else {
	     $password = $_POST["Password"];
	   }


	   if (empty($_POST["ConfirmPassword"])) {
	     $confirmErr="Confirm Password is required";
	   } else if($password == $_POST["ConfirmPassword"])
	   ;
	   else
	   	$confirmErr="Your password do not match ";
	  
	   
	   
	 //  $conn = mysql_connect($servername, $username, $password);
	//$dbname="Medical";
	//mysql_select_db($dbname);

	 if($nameErr=="" && $idErr == "" && $passwordErr== "" && $confirmErr == "" ){
	$sql = "INSERT INTO Login (username, Password, id)
	 VALUES ('$name', '$password', '$id')";
	// var_dump($sql);

	// $conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->query($sql)==TRUE){

	//echo "Table Inserted";
	//mysql_close($conn);
	header( 'Location: Main.php' );
	} else{
	echo "Error it doesnt work if all are not integer";
	}

	}
	else{
	//echo "Form is incorrect";
	}

	}

	function test_input($data) {
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	mysql_close($conn);
	?>

	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="basic-grey">
	   <h2>Registration</h2>
	   <hr>
	   UserName:&nbsp&nbsp&nbsp&nbsp <input type="text" name="UserName" value=<?php echo $name?>>
	   <span class="error">* <?php echo $nameErr;?></span>
	   <br><br>
	   Id:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="Id" >
	   <span class="error"><?php echo $idErr;?></span>
	   <br><br>
	   Password:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="password" name="Password">
	   <span class="error">* <?php echo $passwordErr;?></span>
	   <br><br>
	   Confirm Password: <input type="password" name="ConfirmPassword">
	   <span class="error"><?php echo $confirmErr;?></span>
	   <br><br>
	   
	   <input type="radio" name="gender" value="D" checked="checked">Doctor
   <input type="radio" name="gender" value="P">Patient
   <span class="error">* <?php echo $genderErr;?></span>
   <br><br>
	   <input type="submit" name="submit" value="Submit">
	</form>
