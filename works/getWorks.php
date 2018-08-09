<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `work`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 $rows = array();

    while($row = $result->fetch_assoc()) {
//            echo "id: " . $row["id"].  "<br>";
             $rows[] = $row;
        }
        print json_encode($rows);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>