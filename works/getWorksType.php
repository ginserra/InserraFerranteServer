<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT work_type.id,work_type.type,work_type.icon FROM `work_type`,WORK WHERE work.id_type=work_type.id";
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