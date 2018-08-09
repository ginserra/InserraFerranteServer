<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$description_ = $request->description;
$description=str_replace("'","\'",$description_);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `work_desc` SET description='$description' where id = 1";

if ($conn->query($sql) === TRUE) {
    echo "update OK";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>