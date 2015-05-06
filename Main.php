<html>
<head> <link rel="stylesheet" type="text/css" href="./main.css"></head>


<style type="text/css">
@import url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);


</style>

<script src="js/prefixfree.min.js"></script>
 <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>


<body>

<?php
require 'User.php';
$val="";
// Create connection
$conn = mysql_connect($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$dbname='Medical';
// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (mysql_query($sql) === TRUE) {
  #  echo "Database created successfully";
    
} else {
 #   echo "Error creating database: " . $conn->mysql_error;
}
//select Database
mysql_select_db($dbname);
//Create tables
$sql="CREATE TABLE IF NOT EXISTS City ( Zip INT NOT NULL,
										City_Name VARCHAR(30) NOT NULL PRIMARY KEY)";

if(mysql_query($sql)==TRUE){
#echo "Table Inserted";
} else{
#echo "Error it doesnt work";
}
$sql="CREATE TABLE IF NOT EXISTS Record ( record_id INT NOT NULL,
											record_type VARCHAR(30))";
if(mysql_query($sql)==TRUE){
#echo "Table Inserted";
} else{
#echo "Error it doesnt work";
}
$sql="CREATE TABLE IF NOT EXISTS Doctor ( D_Name VARCHAR(30) NOT NULL,
											AGE INT NOT NULL ,
											Address VARCHAR(30) NOT NULL,
											Phone VARCHAR(14) NOT NULL,
											Office VARCHAR(30) NOT NULL,
											D_SSN INT NOT NULL PRIMARY KEY AUTO_INCREMENT)"; 
if(mysql_query($sql)==TRUE){
#echo "Table Inserted";
} else{
#echo "Error it doesnt work";
}
$sql="CREATE TABLE IF NOT EXISTS Medicine ( M_Name VARCHAR(30) NOT NULL,
											Expiry VARCHAR(14) NOT NULL ,
											Price INT NOT NULL,
											Quantity INT NOT NULL,
											M_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT)"; 
if(mysql_query($sql)==TRUE){
#echo "Table Inserted";
} else{
#echo "Error it doesnt work";
}
$sql="CREATE TABLE IF NOT EXISTS Patient ( P_Name VARCHAR(30) NOT NULL,
											AGE INT NOT NULL ,
											Address VARCHAR(30) NOT NULL,
											Phone VARCHAR(14) NOT NULL,
											P_SSN INT NOT NULL PRIMARY KEY AUTO_INCREMENT)"; 
if(mysql_query($sql)==TRUE){
#echo "Table Inserted";
} else{
#echo "Error it doesnt work";
}
$sql="CREATE TABLE IF NOT EXISTS Visit  (Visit_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
										 Visit_date VARCHAR(10) NOT NULL,
										 time VARCHAR(10) NOT NULL, 
										 complaint VARCHAR(50),
										 D_SSN int, FOREIGN KEY (D_SSN) REFERENCES Doctor(D_SSN),
										 P_SSN int, FOREIGN KEY (P_SSN) REFERENCES Patient(P_SSN))";
						
if(mysql_query($sql)==TRUE){
#echo "Table Inserted";
} else{
#echo "Error it doesnt work";
}


$sql="CREATE TABLE IF NOT EXISTS Diagnosis (Diagnose_Id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
											category VARCHAR(30) )";
if(mysql_query($sql)==TRUE){
#echo "Table Inserted";
} else{
#echo "Error it doesnt work";
}


$sql="CREATE TABLE IF NOT EXISTS Prescription(Prescription_Id int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
											 Visit_id int, FOREIGN KEY (Visit_id) REFERENCES Visit(Visit_id), 	
											 M_id int,
											 Quantity int NOT NULL,Pres VARCHAR(100))";
if(mysql_query($sql)==TRUE){
#echo "Table Inserted";
} else{
#echo "Error it doesnt work";
}



$sql="CREATE TABLE IF NOT EXISTS Bill ( Bill_Num INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
										 Doctor_fees INT ,
										 Amount INT,
										 Status boolean not null default 0,
										 Visit_id int, FOREIGN KEY (Visit_id) REFERENCES Visit(Visit_id),
										 Bill_Date VARCHAR(20), Due_Date VARCHAR(20))";
if(mysql_query($sql)==TRUE){
#echo "Table Inserted";
} else{
#echo "Error it doesnt work";
}


$Login='Login';

$sql="CREATE TABLE Login ( username VARCHAR(30) NOT NULL PRIMARY KEY ,
						 Password VARCHAR(30) NOT NULL,
						  id VARCHAR(30))";
if(mysql_query($sql)==TRUE){
	//$Login='Register for Admin';

	//echo '<script>alert("register")</script>';
	}
$Signup='Signup';

 /* Starts the session */
$conn = new mysqli($servername, $username, $password, $dbname);
		$logins = array();
		$identity=array();
		$sql = "SELECT * FROM Login";
		$result = $conn->query($sql);
	     while($row = $result->fetch_assoc()) {
   	  $logins[$row['username']]=$row['Password'];
 	  $identity[$row['username']]=$row['id'];  	  
 		}
 		if(count($logins)<1){
 			$Login='Register';
 			$val='Admin';
 			$readOnly='readonly=readOnly';
 			//echo "<script>alert(12)</script>";
 			$Signup='';
 		}
 		//var_dump($logins);
		session_start(); 	
	if(isset($_POST['Submit'])){
		
 		$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
		$Password = isset($_POST['Password']) ? $_POST['Password'] : '';
		$pass= md5($Password);
 		if(count($logins)<1)
 		{
 			echo $pass;
 			$sql = "INSERT INTO Login (username,Password,id)
	 			VALUES ('$Username','$Password','A')";
	 		if($Username==""|| $Password=="")
	 			$msg="<span style='color:red'>Fill Form </span>";

			else if(mysql_query($sql)==TRUE){
			//echo '<script>alert("You are register")</script>';
				echo $sql;
				$Login='Login';
				$Signup='Signup';

			}


 		}
 		else{
		
		$Signup='Signup';
		/* Check Username and Password existence in defined array */		
		if (isset($logins[$Username]) && $logins[$Username] == $Password){
			/* Success: Set session variables and redirect to Protected page  */
			$_SESSION['UserData']['Username']=$Username;
			if($Username=='Admin')
				header("location: Admin.php");
			else{
				$loginId=$identity[$Username];
				echo "$loginId";
				if($loginId[0]=="D")
					header("location:Doctor.php");
				else if($loginId[0]=="P")
					header("location:Patient.php");
			}
			exit;
		} else {
			/*Unsuccessful attempt: Set error message */
			$msg="<span style='color:red'>Invalid Login Details</span>";
		}
		}
}
	mysql_close($conn);
?>



     <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Medical<span>Database</span></div>
		</div>
		<div class="login">
		
		<form action="" method="post" name="Login_Form">
		 <?php if(isset($msg)){?>
		 <?php echo $msg;?>
		 <?php } ?>
				<input name="Username" id='user'type="text" placeholder="Usename"  class="Input" <?php echo $readOnly?> value=<?php echo $val ?> ><br>
				<input name="Password" type="password" placeholder="Password" class="Input"><br>
				<input name="Submit" type="submit" style="margin-top:20px; padding:5px;padding-left:10px; padding-right:10px;" value="<?php echo $Login?>" class="myButton">
				<h1><a href='signup.php'  style="color:#FFF; text-decoration:none; "  ><?php echo $Signup ?></a></h1>
		</div>



</body>


</html>
