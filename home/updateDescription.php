<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
$database=include('../config.php');


 $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $id= $request->id;
    $type = $request->type;
    $desc = $request->description;
    $minidesc = $request->subdescription;


// Create connection
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `home` SET description='$desc',subdescription='$minidesc' where id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "update OK";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>