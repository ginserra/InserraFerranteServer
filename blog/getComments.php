<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$id_blog = $request->id_blog;


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `blog_comments` where id_blog='$id_blog'";
$result = $conn->query($sql);
 $rows = array();
if ($result->num_rows > 0) {


    while($row = $result->fetch_assoc()) {
//            echo "id: " . $row["id"]. " - type: " . $row["type"]. " " . $row["description"]. " "  . $row["subdescription"]. "<br>";
             $rows[] = $row;
        }
        print json_encode($rows);
} else {
//    echo "Error: " . $sql . "<br>" . $conn->error;
print json_encode($rows);
}

$conn->close();
?>