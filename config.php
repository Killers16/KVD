<?php ob_start();
header('Content-Type: text/html; charset=utf-8');
include_once('extras/includes.php');

$hostname = "localhost";
$user = "root";
$database = "KVD";

$conn = new mysqli($hostname, $user, 'root', $database);

if ($conn->connect_error) {
  die("Connection failed!" . $conn->connect_error);
}


try {
  $dbConn = new PDO("mysql:host={$hostname};dbname={$database}", $user, "root");
  $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $uri = $_SERVER['REQUEST_URI'];
} catch (Exception $e) {
  echo $e->getMessage();
}
