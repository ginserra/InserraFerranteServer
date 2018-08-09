<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$security=include('../jwt.php');
$config=include('../config.php');
$conn = new mysqli($config['host'], $config['user'], $config['pass'], $config['name']);
$secret_key=$config['secret_key'];
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


	$token = $security.getJwt($request,$secret_key);

	 	while($row = $result->fetch_assoc()) {
             $rows[] = $row;
        }
        print $token;
	} else {
     print 0;
		}
	
	}//chudo if password_verify
else {
     print 0;
}
 


$conn->close();
?>