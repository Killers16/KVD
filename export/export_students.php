<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "root", "KVD");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM students";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
      <th>ID</th>
      <th>Firstname</th>  
       <th>Lastname</th>  
      <th>Person code</th>
      <th>Codes</th> 
      <th>profwssions</th>  
       <th>Years</th>
     
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
 
  {  
   $output .=  '
    
     <td>'.$row["$i"].'</td>  
      <td>'.$row["firstName"].'</td>  
      <td>'.$row["lastName"].'</td>   
       <td>'.$row["codes"].'</td>    
       <td>'.$row["courses"].'</td>
       <td>'.$row["professions"].'</td> 
       <td>'.$row["years"].'</td>
                    </tr>
   ';
   
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Students_database.xls');
  echo $output;
 }
}
?>