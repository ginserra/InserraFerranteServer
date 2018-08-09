<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id_type= $request->id_type;

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `work` where id_type = '$id_type'";

$result = $conn->query($sql);
 $rows = array();
if ($result->num_rows > 0) {


    while($row = $result->fetch_assoc()) {
//            echo "id: " . $row["id"].  "<br>";
             $rows[] = $row;
        }
        print json_encode($rows);
} else {
//    echo "Error: " . $sql . "<br>" . $conn->error;
    print json_encode($rows);

}
$conn->close();
?>