<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "root", "KVD");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM courses";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                  <th>ID</th> 
                  <th>Name</th>  
          
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <td>'.$row["$i"].'</td>  
     <td>'.$row["names"].'</td>  
     
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Courses_database.xls');
  echo $output;
 }
}
?>