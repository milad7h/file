<?php
$database_file = file_get_contents("database.json");
$database_info = json_decode($database_file);

$username = $database_info->username;
$servername = $database_info->servername;
$password = $database_info->password;
$database_name = $database_info->database_name;

// Create connection
$conn = new mysqli($servername, $username, $password, $database_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$type =  $_REQUEST['type'];
$area =  $_REQUEST['area'];
$total_price =  $_REQUEST['total'];
$hold =  $_REQUEST['hold'];
$floors =  $_REQUEST['floors'];
$floor =  $_REQUEST['floor'];
$upf =  $_REQUEST['upf'];
$unit =  $_REQUEST['unit'];
$cold_heat =  $_REQUEST['cold_heat'];
$parking =  $_REQUEST['parking'];
$elevator =  $_REQUEST['elevator'];
$terrace =  $_REQUEST['terrace'];
$facades =  $_REQUEST['facades'];
$kitchen =  $_REQUEST['kitchen'];
$service =  $_REQUEST['service'];
$phone =  $_REQUEST['phone'];
$address =  $_REQUEST['address'];
$discription =  $_REQUEST['discription'];
$shared =  $_REQUEST['shared'];
$owner =  $_REQUEST['owner'];
$userid = $_REQUEST['user_id'];

$sql = "INSERT INTO buy (user_id,type, area, total_price,hold,floors,floor,upf,unit,cold_heat,parking,elevator,terrace,facades,kitchen,service,phone,address,discription, shared, owner) VALUES ('$userid', '$type', '$area', '$total_price' , '$hold' ,'$floors' , '$floor','$upf' , '$unit','$cold_heat','$parking','$elevator','$terrace','$facades','$kitchen','$service','$phone', '$address','$discription', '$shared', '$owner')";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>