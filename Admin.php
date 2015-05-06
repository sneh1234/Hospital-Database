
<html>

	<?php session_start();
if(!isset($_SESSION['UserData']['Username']) || $_SESSION['UserData']['Username'] != 'Admin'){
	header("Location: Main.php");
	exit;
}
?>
	<head>
		 <link rel="stylesheet" type="text/css" href="./admin.css">
	</head>
</style>
			<script type="text/javascript">
			
var lastdelete='medicineform';
			var xmlhttp=new XMLHttpRequest();
			function getPatient () {

			
				xmlhttp.open("GET","show.php?tablename=Patient",true);
  				xmlhttp.send();
  				xmlhttp.onreadystatechange=function(){
  					if (xmlhttp.status==200 && xmlhttp.readyState==4){
  						console.log(xmlhttp.responseText);
  						document.getElementById("q").innerHTML=xmlhttp.responseText;

  					}
  				};
  				document.getElementById('medicineform').style.display='None';
  				document.getElementById('doctorform').style.display='None';
  				document.getElementById('patientform').style.display='None';
  			if(typeof(Storage) !== "undefined") {
            sessionStorage.clickcount = 0;
       			 }	
			}



function Update(row)
{
var answer = confirm("Are You Sure You want to Update");
if (answer){
	var Value,Key;
	xmlhttp.open("GET","show.php?update="+row,true);
	//alert("show.php?id="+row);
  				xmlhttp.send();
  				xmlhttp.onreadystatechange=function(){
  					if (xmlhttp.status==200 && xmlhttp.readyState==4){
  						console.log(xmlhttp.responseText);
  						document.getElementById("q").innerHTML=xmlhttp.responseText;
  					}
  				};
	

}

}





			function Delete(row)
{
	//global lastdelete;
	row=row.toString();
	row=row.concat('.d');
	//alert(row);
	document.getElementById(lastdelete).style.display="None";
	document.getElementById(row).style.display="";

	lastdelete=row;
}

function Confirm(row)
{
	var answer = confirm("Are You Sure You want to delete This Entry");
if (answer){
	var Value,Key;
	xmlhttp.open("GET","show.php?id="+row,true);
	//alert("show.php?id="+row);
  				xmlhttp.send();
  				xmlhttp.onreadystatechange=function(){
  					if (xmlhttp.status==200 && xmlhttp.readyState==4){
  						console.log(xmlhttp.responseText);
  						document.getElementById("q").innerHTML=xmlhttp.responseText;
  					}
  				};
  			
  

}
else{
        //some code
}


}
			function getDoctor () {
				xmlhttp.open("GET","show.php?tablename=Doctor",true);
  				xmlhttp.send();
  				xmlhttp.onreadystatechange=function(){
  					if (xmlhttp.status==200 && xmlhttp.readyState==4){
  						console.log(xmlhttp.responseText);
  						document.getElementById("q").innerHTML=xmlhttp.responseText;
  					}
  				};
  				document.getElementById('medicineform').style.display='None';
  				document.getElementById('doctorform').style.display='None';
  				document.getElementById('patientform').style.display='None';
  				if(typeof(Storage) !== "undefined") {
            sessionStorage.clickcount = 0;
       			 }
			}

			function getMedicine () {
				xmlhttp.open("GET","show.php?tablename=Medicine",true);
  				xmlhttp.send();
  				xmlhttp.onreadystatechange=function(){
  					if (xmlhttp.status==200 && xmlhttp.readyState==4){
  						console.log(xmlhttp.responseText);
  						document.getElementById("q").innerHTML=xmlhttp.responseText;
  					}
  				};
  				document.getElementById('medicineform').style.display='None';
  				document.getElementById('doctorform').style.display='None';
  				document.getElementById('patientform').style.display='None';
  				if(typeof(Storage) !== "undefined") {
            sessionStorage.clickcount = 0;
       			 }
			}
			function getBills(){
				xmlhttp.open("GET","show.php?tablename=Bill",true);
  				xmlhttp.send();
  				xmlhttp.onreadystatechange=function(){
  					if (xmlhttp.status==200 && xmlhttp.readyState==4){
  						console.log(xmlhttp.responseText);
  						document.getElementById("q").innerHTML=xmlhttp.responseText;
  					}
  				};
  				document.getElementById('medicineform').style.display='None';
  				document.getElementById('doctorform').style.display='None';
  				document.getElementById('patientform').style.display='None';
  				if(typeof(Storage) !== "undefined") {
            sessionStorage.clickcount = 0;
       			 }

			}

			function addPatient () {
				
				document.getElementById('medicineform').style.display='None';
				document.getElementById('doctorform').style.display='None';
				document.getElementById('patientform').style.display='';
				document.getElementById('q').innerHTML='';
					//	alert(document.getElementById('medicineform'));	
  			if(typeof(Storage) !== "undefined") {
        if (sessionStorage.clickcount) {
            sessionStorage.clickcount = 3;
        } else {
            sessionStorage.clickcount = 3;
        }

			}
			}	

			function addDoctor () {
				document.getElementById('medicineform').style.display='None';
				document.getElementById('doctorform').style.display='';
				document.getElementById('patientform').style.display='None';
				document.getElementById('q').innerHTML='';
					//	alert(document.getElementById('medicineform'));	
  			if(typeof(Storage) !== "undefined") {
        if (sessionStorage.clickcount) {
            sessionStorage.clickcount = 2;
        } else {
            sessionStorage.clickcount = 2;
        }

			}
			}

			function addMedicine () {
			/*	xmlhttp.open("GET","Medicine.php",true);
  				xmlhttp.send();
  				xmlhttp.onreadystatechange=function(){
  					if (xmlhttp.status==200 && xmlhttp.readyState==4){
  						console.log(xmlhttp.responseText);
  						document.getElementById("display").innerHTML=xmlhttp.responseText;
  					}
  				};*/
  			//	<?php echo 'asd' ;?>;
  				//alert('function called');
  				document.getElementById('q').innerHTML='';
  				document.getElementById('medicineform').style.display='';
  				document.getElementById('doctorform').style.display='None';	
  				document.getElementById('patientform').style.display='None';
  			//	alert(document.getElementById('medicineform'));	
  			if(typeof(Storage) !== "undefined") {
        if (sessionStorage.clickcount) {
            sessionStorage.clickcount = 1;
        } else {
            sessionStorage.clickcount = 1;
        }

			}
		}

		function a(){
			if(typeof(Storage) !== "undefined") {
        if (sessionStorage.clickcount==1) {
            addMedicine();
        }
        if(sessionStorage.clickcount==2){
        	addDoctor();
        	}
        if(sessionStorage.clickcount==3){
        	addPatient();
        }
        }
        }

    
		</script>


<?php 
require 'User.php';
 //header('Location: Medicine.php');
// header( 'Location: Main.php' );
  // Create connection
 $conn = mysql_connect($servername, $username, $password);
  $dbname="Medical";
  mysql_select_db($dbname);
  $nameErr = $quantityErr = $priceErr = $phoneErr = $expiryErrr="";
  $name = $price = $quantity = $expiry = "";

  	$nameErrd = $addressErrd = $officeErrd = $phoneErrd = $ageErrrd="";
	$named = $addressd = $officed = $phoned = $aged ="";

	$nameErrp = $addressErrp = $officeErrp = $phoneErrp = $ageErrrp="";
	$namep = $addressp = $officep = $phonep = $agep ="";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submitMedicine']))
    {
     if (empty($_POST["M_Name"])) {
       $nameErr = "Name is required";
     } else if(!ctype_alpha($_POST["M_Name"])) {
        $nameErr="Invalid Name";
     } else {
       $name = test_input($_POST["M_Name"]);
     }
    
     if (empty($_POST["Price"])) {
       $priceErr = "Price is required";
     } else {
       $price = test_input($_POST["Price"]);
     }
      
     if (empty($_POST["Quantity"])) {
       $quantityErr = "Quantity is required";
     } else {
       $quantity = test_input($_POST["Quantity"]);
     }


     if (empty($_POST["Expiry"])) {
       $expiryErr = "Expiry_Date is required";
     } else {
       $expiry = $_POST["Expiry"] ;
      // echo $expiry;
     }
     

   if($nameErr=="" && $priceErr == "" && $quantityErr== "" && $expiryErr == ""){
  $sql = "INSERT INTO Medicine (M_Name, Expiry, Price,Quantity)
   VALUES ('$name', '$expiry', '$price',$quantity)";
  if(mysql_query($sql)==TRUE){
  	echo '<script>sessionStorage.clickcount=0;</script>';
  //echo "Table Inserted";
  //mysql_close($conn);
  } else{
  echo "Error it doesnt work if all are not integer";
  }

  }
  else{
//echo '<script>addMedicine()</script>';
//echo '<script>addMedicine()</script>';
  //header('Location: Medicine.php');
  //header('Location: Main.php');	
  //	echo '<h1>asdas</h1>';
  }

	 }
	 if(isset($_POST['submitdoctor']))
	 {
	 	 if (empty($_POST["D_Name"])) {
	     $nameErrd = "Name is required";
	   } else if(!ctype_alpha($_POST["D_Name"])) {
	      $nameErrd="Invalid Name";
	   } else {
	     $named = test_input($_POST["D_Name"]);
	   }
	  
	   if (empty($_POST["Address"])) {
	     $addressErrd = "Address is required";
	   } else {
	     $addressd = test_input($_POST["Address"]);
	   }
	    
	   if (empty($_POST["Office"])) {
	     $officeErrd = "Office is required";
	   } else {
	     $officed = test_input($_POST["Office"]);
	   }


	   if (empty($_POST["Phone"])) {
	     $phoneErrd = "Phone no is required";
	   } else {
	     $phoned = test_input($_POST["Phone"]);
	   }
	  if (empty($_POST["Age"])) {
	     $ageErrd = "Age is required";
	   } else {
	     $aged = test_input($_POST["Age"]);
	     if(!ctype_digit($aged)){
	     	$ageErrd="Age must be integer";
	     }
	 }
	 if($nameErrd=="" && $addressErrd == "" && $officeErrd== "" && $phoneErrd == "" && $ageErrd== ""){
	$sql = "INSERT INTO Doctor (D_Name, Age, Address,Phone,Office)
	 VALUES ('$named', $aged, '$addressd',$phoned,'$officed')";
	if(mysql_query($sql)==TRUE){

	echo "<script>sessionStorage.clickcount=0;</script>";
	mysql_close($conn);
	//header( 'Location: Main.php' );
	} else{
	echo "Error it doesnt work if all are not integer";
	}

	}
 }
 if(isset($_POST['submitpatient']))
 {
 	 if (empty($_POST["P_Name"])) {
	     $nameErrp = "Name is required";
	   } else if(!ctype_alpha($_POST["P_Name"])) {
	      $nameErrp="Invalid Name";
	   } else {
	     $namep = test_input($_POST["P_Name"]);
	   }
	  
	   if (empty($_POST["Address"])) {
	     $addressErrp = "Address is required";
	   } else {
	     $addressp = test_input($_POST["Address"]);
	   }
	    
	   

	   if (empty($_POST["Phone"])) {
	     $phoneErrp = "Phone no is required";
	   } else {
	     $phonep = test_input($_POST["Phone"]);
	   }
	  
	  if (empty($_POST["Age"])) {
	     $ageErrp = "Age is required";
	   } else {
	     $agep = test_input($_POST["Age"]);
	     if(!ctype_digit($agep)){
	     	echo $agep;
	     	$ageErrp="Age must be integer";
	     }
	   }
	   

	 if($nameErrp=="" && $addressErrp == "" && $officeErrp== "" && $phoneErrp == "" && $ageErrp== ""){
	$sql = "INSERT INTO Patient (P_Name, Age, Address,Phone)
	 VALUES ('$namep', $agep, '$addressp',$phonep)";
	if(mysql_query($sql)==TRUE){

	//echo "Table Inserted";
	echo '<script>sessionStorage.clickcount=0;</script>';
	mysql_close($conn);
	//header( 'Location: Main.php' );
	} else{
	echo "Error it doesnt work if all are not integer";
	}
 }
}
}

//}

  function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }
  //echo $expiryErr;
  
  mysql_close($conn);
  ?>


	<body onload="a()">
			
			<div>
			<h1 style="font-size: 30px;
				  font-family: 'Open Sans', sans-serif;
				color: #996633;">Welcome Admin</h1>
			</div>

			 <header>
				<div class="nav">
				<ul>
				<li class="Patient"><a onclick="getPatient()" value="Patient" id="Patient">Patient</a></li>
				<li class="Doctor"><a onclick="getDoctor()" value="Doctor" id="Doctor">Doctor</a></li>
				<li class="Medicine"><a onclick="getMedicine()" value="Medicine" id="Medicine">Medicine</a></li>	
				<li class="Bills"><a onclick="getBills()" value="Bill" id="Bill">Bill</a></li>			
				</ul>
				</div>

				<div class="nav2">
					<ul>
						<li class="addPatient"><a onclick="addPatient()" value="addPatient" id="addPatient">Add Patient</a></li>
						<li class="addDoctor"><a onclick="addDoctor()" value="addPatient" id="addPatient">Add Doctor</a></li>
						<li class="addDoctor"><a onclick="addMedicine()" value="addPatient" id="addPatient">Add Medicine</a></li>
					</ul>
				</div>

				<div id="display" style="position: absolute;
top: 15%;
margin-left: 28.5%;
margin-top: 6%;">	
					<div id='q'></div>
				<form method="POST" action="Admin.php" class="basic-grey" id='medicineform' style='display:none;'>
     <h2>Add New Medicine</h2>
     <hr>
     Name:&nbsp&nbsp&nbsp&nbsp <input type="text" name="M_Name" value=<?php echo $name?>>
     <span class="error">* <?php echo $nameErr;?></span>
     <br><br>
     Price:&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="Price" value= <?php echo $price ?> >
     <span class="error">* <?php echo $priceErr;?></span>
     <br><br>
     Quantity: <input type="text" name="Quantity" value=  <?php echo $quantity?>>
     <span class="error">*<?php echo $quantityErr;?></span>
     <br><br>
     Expiry_Date:&nbsp&nbsp&nbsp
     <input type="text" name="Expiry" value=<?php echo $expiry ?>>
     <span class="error">* <?php echo $expiryErr;?></span>
     <br><br>
     
    
     <input type="submit" name="submitMedicine" value="Submit" onclick='addMedicine()'>
  </form> 
  <form method="POST" id='doctorform' action="Admin.php" class="basic-grey" style='display:none;'>
	   <h2>Add Doctor Entry</h2>
	   <hr>
	   Name:&nbsp&nbsp&nbsp&nbsp <input type="text" name="D_Name" value=<?php echo $named?>>
	   <span class="error">* <?php echo $nameErrd;?></span>
	   <br><br>
	   Age:&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="Age" value=<?php echo $aged ?>>
	   <span class="error">* <?php echo $ageErrd;?></span>
	   <br><br>
	   Address: <input type="text" name="Address" value=<?php echo $addressd?>>
	   <span class="error"><?php echo $addressErrd;?></span>
	   <br><br>
	   Office:&nbsp&nbsp&nbsp
	   <input type="text" name="Office" value=<?php echo $officed?>>
	   <span class="error">* <?php echo $officeErrd;?></span>
	   <br><br>
	   Phone:&nbsp&nbsp&nbsp
	   <input type="text" name="Phone" value=<?php echo $phoned ?>>
	   <span class="error">* <?php echo $phoneErrd;?></span>
	   <br><br> 
	  
	   <input type="submit" name="submitdoctor" value="Submit">
	</form>
	<form method="POST" id="patientform" action="Admin.php" class="basic-grey" style='display:none;'>
	   <h2>Add Patient Entry</h2>
	   <hr>
	   Name:&nbsp&nbsp&nbsp&nbsp <input type="text" name="P_Name" value=<?php echo $namep?>>
	   <span class="error">* <?php echo $nameErrp;?></span>
	   <br><br>
	   Age:&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="Age" value=<?php echo $agep ?>>
	   <span class="error">* <?php echo $ageErrp;?></span>
	   <br><br>
	   Address: <input type="text" name="Address" value=<?php echo $addressp?>>
	   <span class="error"><?php echo $addressErrp;?></span>
	   <br><br>
	   
	   Phone:&nbsp&nbsp&nbsp
	   <input type="text" name="Phone" value=<?php echo $phonep ?>>
	   <span class="error">* <?php echo $phoneErrp;?></span>
	   <br><br> 
	  
	   <input type="submit" name="submitpatient" value="Submit">
	</form>
</div>			
			</header>

	</body>

<a href='Logout.php' style="color:#FFF; text-decoration:none; margin-left:80%; margin-top:-33%; position:absolute;	font-size:20px; ">Logout</a>

			<!--<button onclick="getPatient()" value="Patient" id="Patient">Patient</button>
			<button onclick="getDoctor()" value="Doctor" id="Doctor">Doctor</button>
			<button onclick="getMedicine()" value="Medicine" id="Medicine">Medicine</button>
			-->

<style>
#display{
	position: absolute;
	top:20.6%;
	margin-left: 19.5%;
}
</style>

		
</html>
