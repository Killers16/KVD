<?php
ini_set('display_errors', '1');
include_once('../config.php');
if (isset($_POST['update'])) {
    $id_student = $_POST['id_student'];
    $firstName = $_POST['fistName'];
    $lastName = $_POST['lastName'];
    $codes = $_POST['codes'];
    $courses = $_POST['courses'];
    $professions = $_POST['professions'];
    $years = $_POST['years'];

    if (empty($firstName) {
        if (empty($firstName)) {
            echo "First name field is empty.";
        }
    } else {
        $sql = "UPDATE students SET firstName=:firstName, lastName=:lastName,
        codes=:codes,courses=:courses,professions=:professions,years=:years
        WHERE id_student=:id_student";
        $query = $dbConn->prepare($sql);

        $query->bindparam(':id_student', $id_student);
        $query->bindparam(':firstName', $firstName);
        $query->bindparam(':lastName', $lastName);
        $query->bindparam(':codes', $codes);
        $query->bindparam(':courses', $course);
        $query->bindparam(':professions', $professions);
        $query->bindparam(':years', $years);
        $query->execute();
    }
}
$id_student = $_GET['id_student'];

$sql = "SELECT * FROM students WHERE id_student=:id_student";
$query = $dbConn->prepare($sql);
$query->execute(array(':id_student' => $id_student));

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $codes = $row['codes'];
    $course = $row['courses'];
    $profession = $row['professions'];
    $years = $row['years'];
}
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/assets/product.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="div_top">
<h1>Product Edit</h1>
<button onclick="location.href='../Tables.php'">BACK</button>
</div>
<div class="line"></div>

<form action="" method="post" name="form">

    <table border="0">
        
        <tr>
            <td>Name</td>
            <td><input type="text" name="firstName" value="<?php echo $firstName; ?>"></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="lastName" value="<?php echo $lastName; ?>"></td>
        </tr>
        <tr>
            <td>Codes</td>
            <td><input type="text" name="codes" value="<?php echo $codes; ?>"></td>
        </tr>
        <tr>
            <td>Courses</td>
            <td><input type="text" name="course" value="<?php echo $courses; ?>"></td>
        </tr>
        <tr>
            <td>professions</td>
            <td><input type="text" name="profession" value="<?php echo $professions; ?>"></td>
        </tr>
        <tr>
            <td>years</td>
            <td><input type="text" name="years" value="<?php echo $years; ?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value=<?php echo $_GET['id_student']; ?>></td>
            <td><input type="submit" name="submit" value="Update"></td>
        </tr>
    </table>
</form>
</body>
</html>
