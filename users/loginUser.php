<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$username = $request->username;
$password = $request->password;
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rows = array();
//select sull'username per prendere la password

$sql1 = "SELECT * FROM `users` where username = '$username' AND valid=1 ";
$result1 = $conn->query($sql1);
$password_from_db="";
if ($result1->num_rows > 0) {
	while($row1 = $result1->fetch_assoc()) {
		$password_from_db = $row1["password"];
        }
      } 


if (password_verify($password, $password_from_db)) {
    //echo "Accesso effettuato con successo\n";
	$sql = "SELECT * FROM `users` where username = '$username' AND valid=1 ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

	 	while($row = $result->fetch_assoc()) {
             $rows[] = $row;
        }
        print json_encode($rows);
	} else {
     print json_encode($rows);
		}
	
	}
else {
     print json_encode($rows);
}
 


$conn->close();
?>