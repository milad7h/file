<?php 
   require_once ('./imports/MysqliDb.php');
   $database_file = file_get_contents("database.json");
    $database_info = json_decode($database_file);

    $username = $database_info->username;
    $servername = $database_info->servername;
    $password = $database_info->password;
    $database_name = $database_info->database_name;

    $db = new MysqliDb (Array (
                'host' => $servername,
                'username' => $password, 
                'password' => $password,
                'db'=> $database_name,
                'port' => 3306,
                'charset' => 'utf8_general_ci'));

$total_price = 0 ;
if(isset($_REQUEST['area'])){
    $area = $_REQUEST['area'];
}
if(isset($_REQUEST['price'])){
    $total_price = $_REQUEST['price'];
}

$db->orderBy("b.id","Desc");
$db->join("users u", "b.user_id=u.id", "LEFT");
$db->where('shared' , "on");
$db->where('area', $area, '>=');
$db->where('total_price', $total_price, '>=');

$cols = Array ("u.id","b.id","user_id","type", "area" ,"total_price","floors", "floor" , "upf", "unit", "terrace", "service", "kitchen", "hold", "elevator" , "facades", "cold_heat", "mobile", "u.address" , "discription", "parking",);
$buys_shared = $db->get('buy b' , null, $cols);
if($db->count == 0){
    echo "<div class=\"text-center mt-4\"> در حال حاضر فایلی ندارید </div>";
}else{
foreach ($buys_shared as $key=>$row) {

echo "<div class=\"s-sells  s-sell-".$row['id'] . " \">


<div class=\"case my-4 \" id=\"b".$row['id'] . "\">

<div class=\"row rent" .$row['id'].  " rent-fade\">
    <div class=\"col-6 col-sm-12\">
        کد : ". $row["id"]. "
    </div>
</div>                     
<div class=\"row buyf". $row["id"] . "\">
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >نوع :" . $row["type"] . 
    "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >متراژ :" .$row["area"]. "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >قیمت کل :" .$row["total_price"]. "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >سن : " . $row["hold"]. "</div>
</div>
<div class=\"row buyf" . $row['id'] ."\">
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >تعداد طبقات : " .$row["floors"]. "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >طبقه : ".$row["floor"]. "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >تعداد واحد در طبقه :" . $row["upf"] . "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >واحد :" .$row["unit"] . "</div>
</div> 

<div class=\"row buyf". $row['id'] . "\">
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >گرمایش-سرمایش :" . $row["cold_heat"] . "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >پارکینگ : "  . $row["parking"] . "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >آسانسور:" . $row["elevator"] . "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >تراس : " . $row["terrace"] . "</div>
</div>
<div class=\"row buyf". $row['id'] . "\">
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >نما، پوشش:" . $row["facades"] . "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >کابینت :" . $row["kitchen"] . "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >سرویس: " . $row["service"] . "</div>
    <div class=\"col-6 col-md-3 col-lg-3 col-sm-12  case-info\" >شماره تماس :" .  $row["mobile"] . "</div>                                                
</div>
<div class=\"row buyf" . $row['id'] . "\" style=\"text-align: right;\">
    <div class=\"col-9 col-md-9 col-lg-9 col-sm-12 case-info\">آدرس :" . $row["address"] . "</div>
  
    
</div>
<div class=\"row buyf". $row['id']. "\" style=\"text-align: right;\">
    <div class=\"col-12\">توضیحات: " . $row["discription"] . "</div>
</div>
</div>
</div>
";
}
}
?>