<?php ob_start();
header('Content-Type: text/html; charset=utf-8');
include_once('includes.php');

$hostname = "localhost";
$user = "admin";
$database = "KVD";

$conn = new mysqli($hostname, $user, 'admin', $database);

if ($conn->connect_error) {
  die("Connection failed!" . $conn->connect_error);
}





