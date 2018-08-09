<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");



$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$description = $request->description;
$visibility = $request->visibility;

$desc=str_replace("'","\'",$description);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `blog_desc` SET description='$desc',visibility='$visibility' where id = 1";


if ($conn->query($sql) === TRUE) {
    echo "update OK";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>