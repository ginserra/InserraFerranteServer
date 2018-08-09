<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
include '../resizeImage.php';

$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);


$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$image = $request->image;
//$new_image=resize_image($image,800,400);
$title_ = $request->title;
$title=str_replace("'","\'",$title_);
$id_type = $request->id_type;


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($title!=""){

    $sql = "INSERT INTO `work`(`image`,`title`,`id_type`) VALUES ('$image','$title','$id_type')";

    if ($conn->query($sql) === TRUE) {
        echo "New record WORK created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>