<html>
<head>
  <link rel="stylesheet" type="text/css" href="form.css">  

<style type="text/css">
  body{
    background-color: #A8A8A8;
  }
</style>

</head>


<?php
require 'User.php';

  // Create connection
  
  $dbname="Medical";
  $pid=$_GET['pid'];
   $conn = new mysqli($servername, $username, $password, $dbname);

   $sql="SELECT * FROM Visit where P_SSN=$pid order by Visit_date, time desc";
   $result=$conn->query($sql);
   $row=$result->fetch_assoc();
   $visitid=$row['Visit_id'];
   $sql="SELECT * FROM Prescription where Visit_id=$visitid";
   $result=$conn->query($sql);
   $MedicineCost=0;
   while($row=$result->fetch_assoc())
   {
    $mid=$row['M_id'];
    $sql="SELECT Price FROM Medicine where M_id=$mid";
    $result2=$conn->query($sql);
    $result2=$result2->fetch_assoc();
$MedicineCost+=$result2['Price']*$row['Quantity'];
   }

   $conn = mysql_connect($servername, $username, $password);
  mysql_select_db($dbname);


      $age=date("d-m-Y");

      


      $address=strftime("%d-%m-%Y", strtotime("$age + 15 day"));
    
    //  $c = date('m/y');
      $message = strval($c);
      //echo "<script type='text/javascript'>alert($message);</script>";    
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
      
      if (empty($_POST["Amount"])) {
        $nameErr = "Enter an amount";
      }
      else if(!ctype_digit($_POST["Amount"])){
        $nameErr = "Enter valid amount";
        var_dump($_POST["Amount"]);
      }     
       else {
         $name = intval($_POST["Amount"]);
      }

      $status=$_POST["Status"];
      $total=$name+$MedicineCost;
      var_dump($status);
      //echo '<script>alert(2)</script>';

   if($nameErr==""){
  $sql = "INSERT INTO Bill (Doctor_fees,Amount, Bill_Date, Due_Date, Status,Visit_id)
   VALUES ($name,$total, '$age', '$address', $status,$visitid)";
  if(mysql_query($sql)==TRUE){

  echo "Table Inserted";
  mysql_close($conn);
  header( 'Location: Doctor.php' );
  } else{
  echo $sql;
  }

  }
  else{
  //echo "Form is incorrect";
  }

  }

  mysql_close($conn);
  ?>
<body>

    <!--BEGIN #signup-form -->
    <div id="signup-form">
        
        <!--BEGIN #subscribe-inner -->
        <div id="signup-inner">
        
          <div class="clearfix" id="header">
                
                <h1>Bill Form</h1><br>
                <p style="margin-left:70%;">Date : <?php echo $age;?></p>
                
           
            </div>            
            <form id="send" action="Bill.php?pid=<?php echo $pid;?>" method="POST">
              
                <p>
                <label for="amount">Amount *</label>
                <input id="amount" type="text" name="Amount" value="" />
                <span class="error"> <?php echo $nameErr;?></span>
                </p>
                 <p>
                <label for="amount">Medicine Cost</label>
                <input id="amount" type="text" name="Amount" readonly="readonly" value="<?php echo $MedicineCost?>" />
                
                </p>                
                  
                <select name="Status">
                  <option  value="0">Not Paid</option>
                  <option  value="1">Paid</option>
                </select>

                <p>
                <button id="submit" type="submit" value="Submit">Submit</button>
                </p>
                
            </form>
            
    <div id="required">
    <p>* Required Fields<br/></p>
    </div>


            </div>
        
        <!--END #signup-inner -->
        </div>
        
    <!--END #signup-form -->   
    </div>  

</body>

</html>
