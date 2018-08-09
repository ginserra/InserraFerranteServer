<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);


$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
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

if($title!=""){

    $sql = "INSERT INTO `about`(`image`,`title`,`subtitle`,`content`) VALUES ('$image','$title','$subtitle','$content')";

    if ($conn->query($sql) === TRUE) {
        echo "New record about created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>