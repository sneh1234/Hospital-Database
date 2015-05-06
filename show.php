  <!DOCTYPE html>
<html>

<style type="text/css">
.CSSTable {
  display: block;
  font-family: sans-serif;
  -webkit-font-smoothing: antialiased;
  font-size: 115%;
  overflow: auto;

  width: auto;
  }
  th {
    background-color: rgb(112, 196, 105);
    color: white;
    font-weight: normal;
    padding: 20px 30px;
    text-align: center;
  }
  td {
    background-color: rgb(238, 238, 238);
    color: rgb(111, 111, 111);
    padding: 20px 30px;
  }
  td._0d{
    background-color: #FF4545;
    color: rgb(111, 111, 111);
    }
  #edit{
    width: 180px;
    height: 64px;
    margin-top: -194px;
    float: right;
  }

</style>
<script type="text/javascript">

</script>
<body>
<div id='qq' class="CSSTable">
  <table id='t1'>

    <?php 
    require 'User.php';
  $dbname = "Medical";
  $table=$_GET['tablename'];
//  if($table=="Bill")
  //  $delete="";
  $update=$_GET['update'];

 $conn = mysql_connect($servername, $username, $password);
  $dbname="Medical";
  mysql_select_db($dbname);
  if(!$table && !$update)
  {
   
  $idd=$_GET['id'];

   $tab=$idd[strlen($idd)-1];
   $ida=intval($idd);
   //echo $tab;
   
   if($tab=="r")
    {
      $k='D'.$ida;

      $sql="DELETE FROM Login WHERE id='$k'";
      var_dump($sql);
      mysql_query($sql);
      $sql="DELETE FROM Visit where D_SSN=$ida";
      mysql_query($sql);
      $sql="DELETE FROM Doctor where D_SSN=$ida";
      var_dump($sql);
      mysql_query($sql);
      $table="Doctor";

    }

  if($tab=='t')
    {
       $k='P'.$ida;

      $sql="DELETE FROM Login WHERE id='$k'";
      mysql_query($sql);
      $sql="DELETE FROM Visit where P_SSN=$ida";
      mysql_query($sql);
      $sql="DELETE FROM Patient where P_SSN=$ida";
      mysql_query($sql);

      $table="Patient";
    }
  if($tab=='e')
   {
     $sql="DELETE FROM Medicine WHERE M_id = $ida";
     mysql_query($sql);
     $table="Medicine";
   }
   if($tab=='l')
   {
     $sql="DELETE FROM Bill WHERE Bill_Num = $ida";
     mysql_query($sql);
     $table="Bill";
    
   }

  
  
  //echo $table;
}
if($update)
{
  $sql="UPDATE Bill Set Status=1-Status where Bill_Num=$update";
   mysql_query($sql);
     $table="Bill";
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
  $field=array();
  $count=0;
  $sql = "SELECT * FROM $table";
  
  $result = $conn->query($sql);  
  $finfo=$result->fetch_fields();
  echo "<tr>";
  foreach ($finfo as $val) {
      if($val->name=='Status'|| $val->name=="Visit_id")
        ;
        else
        echo "<th>".$val->name ."</th>";
        $field[$count]=$val->name;
        //var_dump($field[$count-1]);
        $count=$count+1;
    }
    $result = $conn->query($sql);
    //echo "<th>Delete</th>";
  
    echo "</tr>";
    $j=0;
  if ($result->num_rows > 0) {

     // output data of each row


     while($row = $result->fetch_assoc()) {
      // var_dump($result->fetch_assoc);
     // if($field[0]=='Bill_Num')
      echo "<tr id=$j  onmouseover='Delete($j)'>";
    

     for($i=0;$i<$count;$i++){
      if($field[$i]=="Status" || $field[$i]=="Visit_id");
      else if($field[0]=='Bill_Num')
        echo "<td class=_".$row[$field[3]]."d >".$row[$field[$i]]."</td>";
      else
        echo "<td>" .$row[$field[$i]] ."</td>";
    
 }
  $k=$row[$field[$i-1]];
     if($field[$i-1]=='Due_Date')
      $k=$row[$field[0]];

    if($row[$field[3]]==1)
      $on="checked='checked'";
    else
      $on='unchecked';
  if($table=="Bill")
  echo "<td id=$j.d style='display:none;'><input type='checkbox' onclick=Update('$k') ".$on.">Paid</input></td>";

  echo "<td id=$j.d style='display:none;'> <a href='#$j' onclick=Confirm('$k+$table')> delete</a> </td>";
 $j++;
  echo "</tr>"; 

     }
} else {
     ;
}
?> 

  </table>
</body>
</html>
