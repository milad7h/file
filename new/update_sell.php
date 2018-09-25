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

$area =  $_REQUEST['area'];
$total = $_REQUEST['total'];
$hold =  $_REQUEST['hold'];
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
$owner =  $_REQUEST['owner'];
$id = $_REQUEST['id'];
echo $area;
echo $id;
echo $phone;
echo $total;
echo $terrace;
echo $service;
$sql = "UPDATE buy SET area = '$area', total_price = '$total',hold='$hold',floors = '$floor',upf='$upf',unit='$unit',cold_heat = '$cold_heat',parking = '$parking',elevator = '$elevator',terrace = '$terrace',facades = '$facades',kitchen = '$kitchen',service =' $service',phone =' $phone',address = '$address',discription =' $discription', owner =' $owner' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>