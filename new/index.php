<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>

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
                'username' => $username, 
                'password' => $password,
                'db'=> $database_name,
                'port' => 3306,
                'charset' => 'utf8_general_ci'));
?>

<!DOCTYPE html>
<html>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta charset="UTF-8">

	<head>

		<title>مدیریت فایل</title>

		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/uikit.min.css">
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/js/uikit.min.js"></script>
		<script src="vendor/js/uikit-icons.min.js"></script>
		<script src="vendor/jquery/jquery.min.js"></script>
</head>

<body>
	<div class="container mt-5">
			<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<p class="">  <a href="index.php?logout='1'" style="color: red;">خروج</a> <strong><?php echo $_SESSION['username']; echo $_SESSION['userId'];?></strong>
			</p> 
		<?php endif ?>
	</div>

	<div class="container" style="direction: rtl;">
		<div class=" col-12 col-sm-12 col-md-12">
			<!-- first bar	 -->
			<ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .switcher-container " >
				<li><a href="#"> AllFile</a></li>
				<li><a class="my-rent" href="#">فایل من</a></li>
				<li><a class="s-rent" href="#">فایل اشتراکی</a></li>
				<li><a href="#">فایل جدید +</a></li>	
			</ul>
			<ul class="uk-switcher switcher-container uk-margin"> 
				<li>
					<ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .switcher-container0">
						
					</ul>
					<ul class="uk-switcher switcher-container0  uk-margin" id="">
					</ul>
				</li>
				<li> <!-- first element of second -->
					<ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .switcher-container1">
						<li><a id="" href="#">رهن و اجاره</a></li>
						<li><a class="my-sell" id="new-sell" href="#">فروش</a></li>
					</ul>
					<ul class="uk-switcher switcher-container1  uk-margin" id="">
						<!-- my rent and mortage -->
						
						<li>
							<div class="row search-box">
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="rInId" type="number" name="id" placeholder="کد" autocomplete="off">
						        <select class="form-control col-md-2 col-md-2 col-lg-2 col-sm-12" id="rInType" name="type" style="height: 36px">
									<option>مسکونی</option>
									<option>اداری</option>
									<option>کلنگی</option>
									<option>زمین</option>
								</select> 
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="rInArea" type="number" name="area" placeholder="حداقل متراژ" autocomplete="off">
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="rInMortgage" type="number" name="mortgage" placeholder="حداقل رهن"  min="0" autocomplete="off">
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="rInRent" type="number" name="rent" min="0" placeholder="حداقل اجاره" autocomplete="off">
								<button class="uk-button col-md-2 btn-info search-button my-rent" style="height: 35px">جست و جو</button>
					    	</div>
							<div class="show-result-rental">

							</div>
						</li>
						<!-- my rent and mortage -->
						<li>
							<div class="row">
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="sInId" type="number" name="id" placeholder="کد" autocomplete="off">
						        <select class="form-control col-md-2 col-md-2 col-lg-2 col-sm-12" id="sInType" name="type" style="height: 36px">
									<option>مسکونی</option>
									<option>اداری</option>
									<option>کلنگی</option>
									<option>زمین</option>
								</select> 
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="sInArea" type="number" name="area" placeholder="حداقل متراژ" autocomplete="off">
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="sInTotal" type="number" name="total_price" placeholder="حداقل قیمت کل"  min="0" autocomplete="off">
								<button class="uk-button col-md-2 btn-info my-sell"  style="height: 35px">جست و جو</button>
						    </div>
							<div class="show-result-sell"> </div>
						</li>
					</ul>  <!-- second bar first for first of first bar -->
				</li> <!--first of second bar -->
				<li> <!-- second of second bar -->
					<ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .switcher-container2">
						<li><a class="s-rent" href="#">رهن و اجاره</a></li>
						<li><a class="s-sell" href="#">فروش</a></li>
					</ul>
					<ul class="uk-switcher switcher-container2  uk-margin">
						<li>
							<div class="row search-box">
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="srInId" type="number" name="id" placeholder="کد" autocomplete="off">
						        <select class="form-control col-md-2 col-md-2 col-lg-2 col-sm-12" id="srInType" name="type" style="height: 36px">
									<option>مسکونی</option>
									<option>اداری</option>
									<option>کلنگی</option>
									<option>زمین</option>
								</select> 
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="srInArea" type="number" name="area" placeholder="حداقل متراژ" autocomplete="off">
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="srInMortgage" type="number" name="mortgage" placeholder="حداقل رهن"  min="0" autocomplete="off">
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="srInRent" type="number" name="rent" min="0" placeholder="حداقل اجاره" autocomplete="off">
								<button class="uk-button col-md-2 btn-info search-button s-rent" style="height: 35px">جست و جو</button>
					    	</div>
					    	<div class="show-share-rent">
					    		<!-- result for shared rents  -->
					    	</div>
						</li>
						<li>
							<div class="row">
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="ssInId" type="number" name="id" placeholder="کد" autocomplete="off">
						        <select class="form-control col-md-2 col-md-2 col-lg-2 col-sm-12" id="ssInType" name="type" style="height: 36px">
									<option>مسکونی</option>
									<option>اداری</option>
									<option>کلنگی</option>
									<option>زمین</option>
								</select> 
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="ssInArea" type="number" name="area" placeholder="حداقل متراژ" autocomplete="off">
								<input class="col-md-2 col-md-2 col-lg-2 col-sm-12" id="ssInTotal" type="number" name="total_price" placeholder="حداقل قیمت کل"  min="0" autocomplete="off">
								<button class="uk-button col-md-2 btn-info s-sell"  style="height: 35px">جست و جو</button>
						    </div>
						    <div class="show-share-sell">
						    	<!-- result for shared sells -->
						    </div>	
						</li>
					</ul>
				</li>
				<li>
					<ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .switcher-container3">
						<li><a href="#">رهن و اجاره</a></li>
						<li><a href="#">فروش</a></li>
					</ul>
					<ul class="uk-switcher switcher-container3  uk-margin">
						<li>
							<div class="row">
								<select class="form-control col-md-3 col-md-3 col-lg-3 col-sm-12" name="type" id="rAType">
										<option>مسکونی</option>
									<option>اداری</option>
									<option>کلنگی</option>
									<option>زمین</option>
									</select>
									<input name="area" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="مساحت" type="number" id="rAArea">
									<input name="mortgage" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="رهن" type="text" id="rAMortgage">
									<input name="rent" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="اجاره" type="text" id="rARent">
				            </div>
				            <div class="row">
				            	<input name="floors" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="تعداد طبقات" type="text" id="rAFloors">
				            	<input name="floor" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="طبقه" type="text" id="rAFloor">
				            	 <input name="upf" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="واحد در طبقه" type="text" id="rAUPF">
				            	 <input name="unit" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="واحد" type="text" id="rAUnit">
				            </div>
				            <div class="row">
				            	<input name="cold_heat" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="گرمایش-سرمایش" type="text" id="rACH">
				            	<input name="parking" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="پارکینگ" type="text" id="rAParking">
				            	<input name="elevator" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="آسانسور" type="text" id="rAElevator">
				            	 <input name="terrace" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="تراس" type="text" id="rATerrace">
				            </div>
				            <div class="row">
				            	 <input name="facades" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="نما و پوشش" type="text" id="rAFacades">
				            	 <input name="kitchen" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="کابینت" type="text" id="rAKitchen">
				            	 <input name="service" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="سرویس" type="text" id="rAService">
				            	 <input name="hold" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="سن" type="text" id="rAHold">
				            	 
				            </div>
				            <div class="row">
				            	 <input name="address" class="form-control col-md-6 col-6 col-lg-6 col-sm-12" placeholder="آدرس" type="text" id="rAAddress">
				            	  <input name="phone" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="شماره" type="text" id="rAPhone">
				            	 <input name="owner" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="مالک" type="text" id="rAOwner">
				            </div>
				          	<div class="row">
				          		<input name="discription" class="form-control" placeholder="توضیحات" type="text" id="rADiscription">
				          	</div>
				            <div class="row">
					            <input name="shared" class="form-control col-1 col-lg-1 col-md-1" placeholder="" type="checkbox" id="rAShared">اشتراک گذاری برای نمایش به دیگران 
					    		<button class="uk-button mx-4 btn-success col-2 col-md-2 col-sm-3 col-lg-2 " type="submit"  value="فایل کن" id="add-rent"> فایل کن </button>
				            </div>		
						</li>
						<li>
							<div class="container">
    									<!-- <form id="sForm" > -->
								<div class="row">
									<select class="form-control col-md-3 col-md-3 col-lg-3 col-sm-12" name="type" id="sAType">
  										<option>مسکونی</option>
    									<option>اداری</option>
    									<option>کلنگی</option>
    									<option>زمین</option>
 									</select>
 									<input name="area" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="مساحت" type="number" id="sAArea" onfocus="this.value=''">
 									<input name="total_price" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="قیمت کل" type="text" id="sATotal" onfocus="this.value=''" >
 									<input name="hold" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="سن" type="text" id="sAHold">
					            </div>
					            <div class="row">
					            	<input name="floors" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="تعداد طبقات" type="text" id="sAFloors">
					            	<input name="floor" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="طبقه" type="text" id="sAFloor">
					            	 <input name="upf" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="واحد در طبقه" type="text" id="sAUnit">
					            	 <input name="unit" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="واحد" type="text" id="sAUPF">
					            </div>
					            <div class="row">
					            	<input name="cold_heat" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="گرمایش-سرمایش" type="text" id="sACH">
					            	<input name="parking" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="پارکینگ" type="text" id="sAParking">
					            	<input name="elevator" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="آسانسور" type="text" id="sAElevator">
					            	 <input name="terrace" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="تراس" type="text" id="sATerrace">
					            </div>
					            <div class="row">
					            	 <input name="facades" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="نما و پوشش" type="text" id="sAFacades">
					            	 <input name="kitchen" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="کابینت" type="text" id="sAKitchen">
					            	 <input name="service" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="سرویس" type="text" id="sAService">
					            	 <input name="phone" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="شماره" type="text" id="sAPhone">
					            	 
					            </div>
					            <div class="row">
					            	 <input name="address" class="form-control col-md-9 col-9 col-lg-9 col-sm-12" placeholder="آدرس" type="text" id="sAAddress">
					            	  
					            	 <input name="owner" class="form-control col-md-3 col-3 col-lg-3 col-sm-12" placeholder="مالک" type="text" id="sAOwner">
					            </div>
								          
								<div class="row">
									<input name="discription" class="form-control" placeholder="توضیحات" type="text" id="sADiscription">
								</div>
					            <div class="row">
					            	<input name="shared" class="form-control col-1 col-lg-1 col-md-1" placeholder="" type="checkbox" id="sAShared">اشتراک گذاری برای نمایش به دیگران 
					    			<button class="uk-button mx-4 btn-success col-2 col-md-2 col-sm-2 col-lg-1" type="submit"  value="فایل کن" id="add-sell"> فایل کن</button>
					            </div>	
								<!-- </form> -->
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div> 
	<script>


		$("document").ready(function() {
	    	setTimeout(function() {
				$("#my-rent").trigger('click');
			},10);
		});



		
		$("document").ready(function() {
			setTimeout(function() {
				$(".my-rent").click(function(){
					$(".my-rents").fadeOut();
					var inputId = $("#rInId").val();
					var inputType = $("#rInType").val();
			        var inputArea = $("#rInArea").val();
			        var inputMortgage = $("#rInMortgage").val();
			        var inputRent = $("#rInRent").val();
			        var identifier = "<?php print $_SESSION['userId']; ?>";
			        if(inputMortgage == ""){
		       			inputMortgage = 0;
			        }
			        if(inputArea == ""){
			       		inputArea = 0;
			        }
			        if(inputRent == ""){
			       		inputRent = 0;
			        }
			        var resultDropdown = $(".show-result-rental");
			        if(inputType.length){
		            $.get("backend-search-my-rental.php", {id : inputId, user_id : identifier, type: inputType, area :inputArea, mortgage :inputMortgage, rent: inputRent}).done(function(data){
		                // Display the returned data in browser
		                var a = data;
		                resultDropdown.html(data);
		            });
		        } else{
		            resultDropdown.empty();
		            alert("no mass")
		        }
				});
			},11);
		});

		$("document").ready(function() {
			setTimeout(function() {
				$(".s-rent").click(function(){
					$(".s-rents").fadeOut();
					var inputId = $("#srInId").val();
					var inputType = $("#srInType").val();
			        var inputArea = $("#srInArea").val();
			        var inputMortgage = $("#srInMortgage").val();
			        var inputRent = $("#srInRent").val();
			        if(inputMortgage == ""){
		       			inputMortgage = 0;
			        }
			        if(inputArea == ""){
			       		inputArea = 0;
			        }
			        if(inputRent == ""){
			       		inputRent = 0;
			        }
			        var resultDropdown = $(".show-share-rent");
			        if(inputType.length){
		            $.get("backend-search-shared-rental.php", {id : inputId, type: inputType, area :inputArea, mortgage :inputMortgage, rent: inputRent}).done(function(data){
		                // Display the returned data in browser
		                var a = data;
		                resultDropdown.html(data);
		            });
		        } else{
		            resultDropdown.empty();
		            alert("no mass")
		        }
				});
			},11);
		});

		function edit_my_rent(clicked_id){
			var id = clicked_id;
			$('.rent'+id).fadeOut();
			$('.rent_edit_enable').prop("disabled",true);
			var resultDropdown = $('.my-rent-'+id);
			$.get("edit-my-rent.php", {
				rid : id
			}).done(function(data, status){
				var a = data;
                resultDropdown.html(data);
            });
		
		}

		function edit_my_rent_now(clicked_id){
			var rid = clicked_id;
			var rarea = $("#erAArea").val();
			var rrent = $("#erARent").val();
			var rmortgage = $("#erAMortgage").val();
			var rhold = $("#erAHold").val();
			
			var rfloor = $("#erAFloor").val();
			var runit = $("#erAUnit").val();
			var rupf = $("#erAUPF").val();
			var rch = $("#erACH").val();
			var rparking = $("#erAParking").val();
			var relevator = $("#erAElevator").val();
			var rterrace = $("#erATerrace").val();
			var rfacades = $("#erAFacades").val();
			var rkitchen = $("#erAKitchen").val();
			var rservice = $("#erAService").val();
			var rphone = $("#erAPhone").val();
			var raddress = $("#erAAddress").val();
			var rowner = $("#erAOwner").val();
			var rdiscription = $("#erADisc").val();
			
			$.post("update_rent.php",{ id: rid, area : rarea, rent : rrent, mortgage : rmortgage, hold : rhold, floor : rfloor, unit : runit, upf: rupf, cold_heat : rch, parking :rparking, terrace : rterrace, elevator :relevator, facades: rfacades, kitchen : rkitchen, service : rservice, phone : rphone, address : raddress, owner : rowner, discription : rdiscription },function(data,status){
						// 
						$("#rent"+rid).fadeOut();
						$(".my-rent").trigger('click');

			});
		}

		function edit_my_sell(clicked_id){
			var id = clicked_id;
			$('.buyf'+id).fadeOut();
			$('.buy_edit_enable').prop("disabled",true);
			var resultDropdown = $('#buyf'+id);
			$.get("edit-my-sell.php", {
				rid : id
			}).done(function(data, status){
				var a = data;
                resultDropdown.html(data);
            });
		
		}

		function edit_my_sell_now(clicked_id){
			var rid = clicked_id;
			var rarea = $("#ebAArea").val();
			var rtotal = $("#ebATotal").val();
			var rhold = $("#ebAHold").val();
			
			var rfloor = $("#ebAFloor").val();
			var runit = $("#ebAUnit").val();
			var rupf = $("#ebAUPF").val();
			var rch = $("#ebACH").val();
			var rparking = $("#ebAParking").val();
			var relevator = $("#ebAElevator").val();
			var rterrace = $("#ebATerrace").val();
			var rfacades = $("#ebAFacades").val();
			var rkitchen = $("#ebAKitchen").val();
			var rservice = $("#ebAService").val();
			var rphone = $("#ebAPhone").val();
			var raddress = $("#ebAAddress").val();
			var rowner = $("#ebAOwner").val();
			var rdiscription = $("#ebADisc").val();
			
			$.post("update_sell.php",{ id: rid, area : rarea, total : rtotal, hold : rhold, floor : rfloor, unit : runit, upf: rupf, cold_heat : rch, parking :rparking, terrace : rterrace, elevator :relevator, facades: rfacades, kitchen : rkitchen, service : rservice, phone : rphone, address : raddress, owner : rowner, discription : rdiscription },function(data,status){
						// 
						alert(data);
						$("#sell"+rid).fadeOut();
						$(".my-sell").trigger('click');
			});
		}

		function del_my_rent(clicked_id){
			var id = clicked_id;
			$.post("del-my-rent.php", {
				rid : id
			}).done(function(data, status){
				
				$('.my-rent-'+id).fadeOut();
				alert("فایل رهن و اجاره شماره "+id+" حذف شد");
			});
		}

		function del_my_sell(clicked_id){
			var id = clicked_id;
			$.post("del-my-sell.php", {
				rid : id
			}).done(function(data, status){
				$('.my-sell-'+id).fadeOut();
				alert("فایل فروش شماره " + id+" حذف شد");
			});
		}

		$("document").ready(function() {
			setTimeout(function() {
				$(".my-sell").click(function(){
					$(".my-sells").fadeOut();
					var inputId = $("#sInId").val();
					var inputType = $("#sInType").val();
			        var inputArea = $("#sInArea").val();
			        var inputPrice = $("#sInTotal").val();
			        var identifier = "<?php print $_SESSION['userId']; ?>";
			        if(inputArea == ""){
			       		inputArea = 0;
			        }
			        if(inputPrice == ""){
			       		inputPrice = 0;
			        }
			        var resultDropdown = $(".show-result-sell");
			        if(inputType.length){
		            $.get("backend-search-my-sell.php", {id : inputId, user_id : identifier, type: inputType, area :inputArea, price: inputPrice}).done(function(data){
		                // Display the returned data in browser
		                var a = data;
		                resultDropdown.html(data);
		            });
		        } else{
		            resultDropdown.empty();
		            alert("no mass")
		        }
				});
			},11);
		});

		$("document").ready(function() {
			setTimeout(function() {
				$(".s-sell").click(function(){
					$(".s-sells").fadeOut();
					var inputId = $("#ssInId").val();
					var inputType = $("#ssInType").val();
			        var inputArea = $("#ssInArea").val();
			        var inputPrice = $("#ssInTotal").val();
			        if(inputArea == ""){
			       		inputArea = 0;
			        }
			        if(inputPrice == ""){
			       		inputPrice = 0;
			        }
			        var resultDropdown = $(".show-share-sell");
			        if(inputType.length){
		            $.get("backend-search-shared-sell.php", {id : inputId, type: inputType, area :inputArea, price: inputPrice}).done(function(data){
		                // Display the returned data in browser
		                var a = data;
		                resultDropdown.html(data);
		            });
		        } else{
		            resultDropdown.empty();
		            alert("no mass")
		        }
				});
			},11);
		});

		$("#add-rent").click(function(){
			var rtype = $("#rAType").val();
			var rarea = $("#rAArea").val();
			var rrent = $("#rARent").val();
			var rmortgage = $("#rAMortgage").val();
			var rhold = $("#rAHold").val();
			var rfloors = $("#rAFloors").val();
			var rfloor = $("#rAFloor").val();
			var runit = $("#rAUnit").val();
			var rupf = $("#rAUPF").val();
			var rch = $("#rACH").val();
			var rparking = $("#rAParking").val();
			var relevator = $("#rAElevator").val();
			var rterrace = $("#rATerrace").val();
			var rfacades = $("#rAFacades").val();
			var rkitchen = $("#rAKitchen").val();
			var rservice = $("#rAService").val();
			var rphone = $("#rAPhone").val();
			var raddress = $("#rAAddress").val();
			var rowner = $("#rAOwner").val();
			var rdiscription = $("#rADiscription").val();
			var rshared = $("#rAShared").val();
			if(rmortgage == ""){
				rmortgage = 0;
			}
			if(rrent == ""){
				rrent = 0;
			}
			$.post("insert_rent.php/?user_id=<?php echo $_SESSION['userId'] ?>",{ type : rtype, area : rarea, rent : rrent, mortgage : rmortgage, hold : rhold, floors : rfloors, floor : rfloor, unit : runit, upf: rupf, cold_heat : rch, parking :rparking, terrace : rterrace, elevator :relevator, facades: rfacades, kitchen : rkitchen, service : rservice, phone : rphone, address : raddress, owner : rowner, discription : rdiscription, shared : rshared },function(data,status){
						// 
						alert("فایل زهن جدید اضافه شد");
			});
		});
		$("#add-sell").click(function(){
			var stype = $("#sAType").val();
			var sarea = $("#sAArea").val();
			var stotal = $("#sATotal").val();
			var shold = $("#sAHold").val();
			var sfloors = $("#sAFloors").val();
			var sfloor = $("#sAFloor").val();
			var sunit = $("#sAUnit").val();
			var supf = $("#sAUPF").val();
			var sch = $("#sACH").val();
			var sparking = $("#sAParking").val();
			var selevator = $("#sAElevator").val();
			var sterrace = $("#sATerrace").val();
			var sfacades = $("#sAFacades").val();
			var skitchen = $("#sAKitchen").val();
			var sservice = $("#sAService").val();
			var sphone = $("#sAPhone").val();
			var saddress = $("#sAAddress").val();
			var sowner = $("#sAOwner").val();
			var sdiscription = $("#sADiscription").val();
			var sshared = $("#sAShared").val();
			if(stotal == ""){
				stotal = 0;
			}

			    
			$.post("insert_buy.php/?user_id=<?php echo $_SESSION['userId'] ?>",{ type : stype, area : sarea, total : stotal, hold : shold, floors : sfloors, floor : sfloor, unit : sunit, upf: supf, cold_heat : sch, parking :sparking, terrace : sterrace, elevator :selevator, facades: sfacades, kitchen : skitchen, service : sservice, phone : sphone, address : saddress, owner : sowner, discription : sdiscription, shared : sshared },function(data,status){
						// $("#sAShared").reset();
						alert(data);
				$('#new-sell').trigger('click');
				alert("فایل جدید اضافه شد");
			});
		});
	</script>
</body>
</html>
