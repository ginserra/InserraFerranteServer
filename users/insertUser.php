<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");


$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);


$postdata = file_get_contents("php://input");
$errors = array();

$request = json_decode($postdata);
$username = $request->username;
$email = $request->email;
$password = $request->password;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
$result1 = $conn->query($user_check_query);
if ($result1->num_rows > 0) {
	while($row1 = $result1->fetch_assoc()) {
		if ($row1['username'] === $username) {
      array_push($errors, "Username presente");
    }

    if ($row1['email'] === $email) {
      array_push($errors, "Email presente");
    }
	
	print json_encode($errors);
        }
      } 


if (count($errors) == 0) {
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


if($username!=""){

$sql = "INSERT INTO `users`(`username`,`email`,`password`) VALUES ('$username','$email','$hashedPassword')";

if ($conn->query($sql) === TRUE) {
        echo 0;
} else {
        echo "Error: " . $sql . "<br>" . $conn->error;
}
}
	
}



$conn->close();
?>