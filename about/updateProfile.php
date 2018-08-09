<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id= $request->id;
$image = $request->image;
$title_ = $request->title;
$title=str_replace("'","\'",$title_);
$content_ = $request->content;
$content=str_replace("'","\'",$content_);
$subtitle_=$request->subtitle;
$subtitle=str_replace("'","\'",$subtitle_);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `about` SET image='$image',title='$title',subtitle='$subtitle',content='$content' where id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "update OK";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>