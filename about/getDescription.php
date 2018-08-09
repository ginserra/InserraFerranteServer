<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$config=include('../config.php');
$security=include('../jwt.php');
$conn = new mysqli($config['host'], $config['user'], $config['pass'], $config['name']);
//$token="1eyJhbGciOiAiSFMyNTYiLCJ0eXAiOiAiSldUIn0=.eyJ1c2VybmFtZSI6InRlc3QiLCJwYXNzd29yZCI6InRlc3QifQ==.Nt0n/KBmAdvhlDkhasDWuxzvpwAxwN/LU3ufSkMeYjA=";
//$secret_key=$config['secret_key'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//if($security.checkJwt($token,$secret_key)) {

$sql = "SELECT * FROM `about_desc`";
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

//}







$conn->close();
?>