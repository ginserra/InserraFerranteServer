<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
$database=include('../config.php');


 $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $type = $request->type;
    $desc = $request->description;
    $minidesc = $request->subdescription;



$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `home`(`type`,`description`,`subdescription`) VALUES ('$type','$desc','$minidesc')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>