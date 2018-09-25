<?php
$servername = "localhost";
	$username = "firstlan_mi";
	$password = "Mn12mn12";
	$dbname = "firstlan_file";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$type =  $_REQUEST['type'];
$area =  $_REQUEST['area'];
$rent =  $_REQUEST['rent'];
$mortgage = $_REQUEST['mortgage'];
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

$sql = "INSERT INTO rental (user_id,type, area, rent, mortgage,hold,floors,floor,upf,unit,cold_heat,parking,elevator,terrace,facades,kitchen,service,phone,address,discription, shared, owner) VALUES ('$userid', '$type', '$area', '$rent' ,'$mortgage', '$hold' ,'$floors' , '$floor','$upf' , '$unit','$cold_heat','$parking','$elevator','$terrace','$facades','$kitchen','$service','$phone', '$address','$discription', '$shared', '$owner')";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>