<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$database_file = file_get_contents("database.json");
$database_info = json_decode($database_file);

$username = $database_info->username;
$servername = $database_info->servername;
$password = $database_info->password;
$database_name = $database_info->database_name;


$link =  mysqli_connect($servername, $username, $password, $database_name);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$id = $_REQUEST['rid'];

if($id){
     // Prepare a select statement
    $sql = "SELECT * FROM rental WHERE id = $id";
    if($stmt = mysqli_prepare($link, $sql)){
         // Bind variables to the prepared statement as parameters
        
        
        // Set parameters
        
        // Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
$result = mysqli_stmt_get_result($stmt);

// Check number of rows in the result set
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	echo "<div class=\"case\" id=\"rent".$row['id'] . "\" >
<div class=\"row\">
<input name=\"type\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12 \" placeholder=\"نوع :  " .$row['type']." \" type=\"text\" disabled=\"disabled\">

<input name=\"area\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"مساحت : " .$row['area']."  \"  type=\"text\"  id=\"erAArea\">


<input name=\"mortgage\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"رهن : " .$row['mortgage']." \"  type=\"text\" id=\"erAMortgage\">


<input name=\"rent\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"اجاره :  " .$row['rent']." \"  type=\"text\" id=\"erARent\">


</div>
<div class=\"row\">

<input name=\"floors\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"تعداد طبقات :  " .$row['floors']." \"  type=\"text\" id=\"erAfloors\">
<input name=\"floor\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"طبقه :  " .$row['floor']." \"  type=\"text\" id=\"erAFloor\">
<input name=\"upf\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"واحد در طبقه :  " .$row['upf']." \"  type=\"text\" id=\"erAUPF\">
<input name=\"unit\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"واحد : " .$row['unit']." \"  type=\"text\" id=\"erAUnit\">
</div>
<div class=\"row\">

<input name=\"cold_heat\" class=\"form-control  col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"گرمایش-سرمایش : " .$row['cold_heat']." \" type=\"text\" id=\"erACH\">
<input name=\"parking\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"پارکینگ :  " .$row['parking']." \" type=\"text\" id=\"erAParking\">
<input name=\"elevator\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"آسانسور :  " .$row['elevator']." \" type=\"text\" id=\"erAElevator\">
<input name=\"terrace\ class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"تراس :  " .$row['terrace']."  \" type=\"text\" id=\"erATerrace\">
</div>
<div class=\"row\">

<input name=\"facades\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"نما و پوشش :  " .$row['facades']." \"  type=\"text\" id=\"erAFacades\">
<input name=\"kitchen\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"کابینت :  " .$row['kitchen']." \"  type=\"text\" id=\"erAKitchen\">
<input name=\"service\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"سرویس : " .$row['service']." \"  type=\"text\" id=\"erAService\">
<input name=\"hold\" class=\"form-control col-6 col-md-3 col-lg-3 col-sm-12\" placeholder=\"سن :  " .$row['hold']." \"  type=\"text\" id=\"erAHold\">
</div>
<div class=\"row\">
<input name=\"address\" class=\"form-control col-6 col-md-6 col-lg-6 col-sm-12\" placeholder=\"آدرس : " .$row['address']." \"  type=\"text\" id=\"erAAddress\">
<input name=\"phone\" class=\"form-control col-3 col-md-3 col-lg-3 col-sm-12\" placeholder=\"شماره : " .$row['phone']." \" type=\"text\" id=\"erAPhone\">
<input name=\"owner\" class=\"form-control col-3 col-md-3 col-lg-3 col-sm-12\" placeholder=\"مالک : " .$row['owner']." \"  type=\"text\" id=\"erAOwner\">
</div>
<div class=\"row\">
<input name=\"discription\" class=\"form-control col-12\" placeholder=\"توضیحات  " .$row['discription']." \"  type=\"text\" id=\"erADisc\">
</div>							    
<button class=\"uk-button btn my-1 btn-success text-center\" id=\"".$row['id'] . "\" onclick=\"edit_my_rent_now(this.id)\"   type=\"submit\" > ویرایش  </button>
</div> " ;
            } else{
                echo "<p class=\"text-center mt-4\">موردی یافت نشد</p>";
            }
        } 
        else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statemet
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($link);
?>