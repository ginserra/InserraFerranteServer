<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$database=include('../config.php');
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['name']);


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql_truncate="TRUNCATE TABLE `work_type`";

if($conn->query($sql_truncate) === TRUE){

$query = "";
 foreach ($request as $key => $value) {

            //get the tweet details
            $type =$value->type;
            $icon = $value->icon;

            $query .= "INSERT INTO `work_type` (`type`,`icon`) VALUES ('".$type."', '".$icon."'); ";  // Make Multiple Insert Query

 }
   if (mysqli_multi_query($conn, $query)) {
        echo "update OK";
    }
    else{
         echo "Error: " . $quert . "<br>" . $conn->error;
    }

}



$conn->close();
?>