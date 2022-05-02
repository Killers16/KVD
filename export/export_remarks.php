<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "root", "KVD");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM remarks";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <<th>Last Name</th> 
                         <th>filename</th>
                         <th>Remarks</th>
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
              
  
   <td>'.$row["firstName"].'</td>
   <td>'.$row["lastName"].'</td>  
   <td>'.$row["names"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Profession_database.xls');
  echo $output;
 }
}
?>