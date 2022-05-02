<?php
session_start();
include('config.php');

require '../import/Classes/PHPExcel/Autoloader.php';



if(isset($_POST['import']))
{
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PHPExcel\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach($data as $row)
        {
            if($count > 0)
            {
                $firstName = $row['0'];
                $lastName = $row['1'];
                $code = $row['2'];
                $cource = $row['3'];
                $profession = $row['4'];
                $year = $row['5'];
                

                $studentQuery = "INSERT INTO students(firstName,lastName,codes,courses,professions,years) VALUES ('$firstName','$lastName','$code',$cource','$profession','$year')";
                $result = mysqli_query($con, $studentQuery);
                $msg = true;
            }
            else
            {
                $count = "1";
            }
        }

        if(isset($msg))
        {
            $_SESSION['message'] = "Successfully Imported";
            header('Location: ../KVD/index.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Imported";
            header('Location: ../KVD/index.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        header('Location: ../KVD/index.php');
        exit(0);
    }
}

?>