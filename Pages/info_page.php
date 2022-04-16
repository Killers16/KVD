<?php
include_once('extras/includes.php');
$result = $dbConn->query("SELECT id_info ,students.firstName,students.lastName,students.codes,students.years,courses.names as Cnames, professions.names as Pnames
FROM info
INNER JOIN students ON students.id_student = info.student_id
INNER JOIN courses ON courses.id_course = info.course_id
INNER JOIN professions ON professions.id_profession = info.profession_id ORDER BY id_info ASC");?>

<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<main>
<form method="get" class='flex'>

                Vārds: <input type="text" name="fname"  >
                Uzvārds: <input type="text" name="lname"  />
                Personas kods: <input type="text" name="code"/>
                Iestāšanas gads: <input type="text" name="year"/>
                <select name="students">

            </select>
                Info: <select name="info">
                    <?php
                        $infoService = new InfoService();

                        $infos = $infoService->getAllInfos($conn);
                         $studentsService = new StudentsService();
                         $courseService = new CoursesService();
                         $professionsService = new ProfessionsService();
                        
                         foreach($infos as $i){
                           
                          
                             $fName = $i->getStudent_id()->getFirstName();
                             $lName = $i->getStudent_id()->getLastName();
                             $code = $i ->getStudent_id()->getCodes();
                             $year = $i ->getStudent_id()->getYears();
                             $course = $i ->getCourse_id()->getNames();
                             $profession = $i ->getProfession_id()->getNames();  
                             
                             
                             echo "<option> $fName $lName  $code $year $course $profession</option>";
                                 
                         }
                    ?>
                     </select>
                <input type="submit" name="newInfos" value="Pievienot" /><input type="submit" name="editInfos" value="Labot" />
                <input type="submit" name="deleteInfos" value="Dzēst" />
 </form>
<table>
<tr>
<th>Nr.</th>
<th>Vārds</th>
<th>Uzvārds</th>
<th>Personas kods</th>
<th>Gads</th>
<th>Kurss</th>
<th>Profesija</th>
</tr>
    <?php
    $n = 1;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
    
<tr>
<td><?php echo htmlspecialchars($row['id_info'])?></td>
<td><?php echo htmlspecialchars($row['firstName'])?></td>
<td><?php echo htmlspecialchars($row['lastName'])?></td>
<td><?php echo htmlspecialchars($row['codes'])?></td>
<td><?php echo htmlspecialchars($row['years'])?></td>
<td><?php echo htmlspecialchars($row['Cnames'])?></td>
<td><?php echo htmlspecialchars($row['Pnames'])?></td>
 </tr>
        <?php
    ;} ?>
    </table>
</main>

</body>
</html>