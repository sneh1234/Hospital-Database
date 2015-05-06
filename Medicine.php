<html>
<style>
.error{color:red;}
</style>
<?php session_start();
if(!isset($_SESSION['UserData']['Username'])){
  header("Location: Main.php");
  exit;
}
?>
<style>
body {
      margin: 10px;
      padding: 0;
      
      background: url(./bg_main.jpg);
      }
.basic-grey {
    margin-left:auto;
    margin-right:auto;
    width:925px;

    background: #F7F7F7;
    padding: 25px 15px 25px 10px; 
    font: 18px Georgia, "Times New Roman", Times, serif;
    color: #888;
    text-shadow: 1px 1px 1px #FFF;
    border:1px solid #E4E4E4;
}
.basic-grey h1 {
    font-size: 25px;
    padding: 0px 0px 10px 40px;
    display: block;
    border-bottom:1px solid #E4E4E4;
    margin: -10px -15px 30px -10px;;
    color: #888;
}
.basic-grey h1>span {
    display: block;
    font-size: 11px;
}
.basic-grey label {
    display: block;
    margin: 0px;
}
.basic-grey label>span {
    float: left;
    width: 20%;
    text-align: right;
    padding-right: 10px;
    margin-top: 10px;
    color: #888;
}
.basic-grey input[type="text"], .basic-grey input[type="email"], .basic-grey textarea, .basic-grey select {
    border: 1px solid #DADADA;
    color: #888;
    height: 30px;
    margin-bottom: 16px;
    margin-right: 6px;
    margin-top: 2px;
    outline: 0 none;
    padding: 3px 3px 3px 5px;
    width: 70%;
    font-size: 12px;
    line-height:15px;
    box-shadow: inset 0px 1px 4px #ECECEC;
    -moz-box-shadow: inset 0px 1px 4px #ECECEC;
    -webkit-box-shadow: inset 0px 1px 4px #ECECEC;
}
.basic-grey textarea{
    padding: 5px 3px 3px 5px;
}
.basic-grey select {
    background: #FFF url('down-arrow.png') no-repeat right;
    background: #FFF url('down-arrow.png') no-repeat right);
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance: none;
    text-indent: 0.01px;
    text-overflow: '';
    width: 70%;
    height: 35px;
    line-height: 25px;
}
.basic-grey textarea{
    height:100px;
}
.basic-grey .button {
    background: #E27575;
    border: none;
    padding: 10px 25px 10px 25px;
    color: #FFF;
    box-shadow: 1px 1px 5px #B6B6B6;
    border-radius: 3px;
    text-shadow: 1px 1px 1px #9E3F3F;
    cursor: pointer;
}
.basic-grey .button:hover {
    background: #CF7A7A
}
</style>
<body>
<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
  require 'User.php';
  //echo "Welcome visitor";
  $doctorid=$_GET['id'];
  if(!$doctorid)
    header("location:Doctor.php");
  //echo $doctorid;
  // Create     connection
  $conn = mysql_connect($servername, $username, $password);
  $dbname="Medical";
  mysql_select_db($dbname);
  $visitComplaint=$visitDoctor=$visitDiagnose=$visitPrescription="";
  $complainErr=$diagnosisErr=$prescriptionErr;


  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $visitDate=date("d-m-Y");
      $visitTime=date("h:i:sa");
      if (empty($_POST["complaint"])) {
        $complainErr = "Whats complaint?";
      } else {
        $visitComplaint = test_input($_POST["complaint"]);
      }

     

    if (empty($_POST["P_Ssn"])) {
          $prescriptionErr = "Assign a valid patient id";
      } else {
        $visitPrescription =(int) test_input($_POST["P_Ssn"]);
      }
      
      if($complainErr=="" && $diagnosisErr=="" && $prescriptionErr=="" ){
          echo "done";
        $sql="INSERT INTO Visit(Visit_date, time, complaint, D_SSN, P_SSN )
            VALUES ('$visitDate', '$visitTime', '$visitComplaint', $doctorid, $visitPrescription)";


            if(mysql_query($sql)==TRUE){
            echo "Table Inserted";
            mysql_close($conn);
            header( 'Location: Doctor.php' );
          } 
          else{
            echo $sql;
            echo "Error it doesnt work if all are not integer";
          }

  }
  else{
    echo "Not working";

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


  <form method="POST" action="Medicine.php?id=<?php echo $doctorid?>" class="basic-grey">
     <h2>Add Visit of Patient</h2>
     <hr>
     Complaint: <input type="text" name="complaint" value=<?php echo $visitComplaint?>>
     <span class="error">* <?php echo $complaintErr;?></span>
     <br><br>
     Patient Id: <input type="text" name="P_Ssn" value=<?php echo $visitPrescription ?>>
     <span class="error">* <?php echo $prescriptionErr;?></span>
     <br><br>


    
     <input type="submit" name="submit" value="Submit">
  </form>
  
</body>
</html>
