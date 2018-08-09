<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);


$id = file_get_contents("php://input");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM `blog` WHERE id=$id;";
$sql.= "DELETE FROM `blog_comments` WHERE id_blog=$id;";

if ($conn->multi_query($sql)) {
    echo "Blog deleted";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>