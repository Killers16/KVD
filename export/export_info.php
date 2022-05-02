<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "root", "KVD");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM info";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
       <tr>
       <th>Name</th>
      <th>Address</th>
       <th>City</th>
       <th>Postal Code</th>
       <th>Country</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
      
     <td>'.$row["student_id"].'</td>  
      <td>'.$row["course_id"].'</td>  
      <td>'.$row["profession_id"].'</td>   
      
                    </tr>
   ';
   
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=info_database.xls');
  echo $output;
 }
}
?>