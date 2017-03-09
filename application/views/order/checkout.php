<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Check out | E-Shopper</title>
    <link rel="shortcut icon" href="<?php echo base_url("Bootstrap/images/favicon.ico"); ?>" />
    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>Bootstrap/js/html5shiv.js"></script>
    <![endif]--> 
    <link href="<?php echo base_url("Bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("Bootstrap/css/font-awesome.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("Bootstrap/css/prettyPhoto.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("Bootstrap/css/price-range.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("Bootstrap/css/animate.css"); ?>" rel="stylesheet">
	<link href="<?php echo base_url("Bootstrap/css/main.css"); ?>" rel="stylesheet">
	<link href="<?php echo base_url("Bootstrap/css/responsive.css"); ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("Bootstrap/css/sweet-alert.css"); ?>">
</head><!--/head-->

<body>
	<?php $this->load->view('module/header');?>
	<?php
		$city = isset($_SESSION['city'])? $_SESSION['city'] : "";
		$district = isset($_SESSION['district'])? $_SESSION['district'] : "";
		$address = isset($_SESSION['address'])? $_SESSION['address'] : "";
		$receiver = isset($_SESSION['receiver'])? $_SESSION['receiver'] : "";
		$phone = isset($_SESSION['phone'])? $_SESSION['phone'] : "";
	?>
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Products Information</h3>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<!-- <ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Thanh toán tiền mặt khi nhận hàng</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Thẻ ATM</label>
							</li>
						</ul> -->
						<ul class="user_info">
							<li class="single_field">
								<label>City:</label>
								<select id="city" name="city">
									<option>-----</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>District:</label>
								<select class="quan" id="district" name="district"></select>
							
							</li>
						</ul>

						<div class="shopper-info">
							<form>
								<input type="text" placeholder="Address" class="user_address" value="<?php echo $address;?>">
								<input type="text" placeholder="Receiver" class="receiver" value="<?php echo $receiver;?>">
								<input type="text" placeholder="Phone Number" class = "phone" value="<?php echo $phone;?>">
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<?php 
							$sum = $_SESSION['sum'];
							echo '
								<ul>
									<li>Cost: <span>'.$sum.'.000 đ</span></li>
									<li>Tax: <span>0đ</span></li>
									<li>Shipping fee: <span>Free</span></li>
									<li>Total: <span>'.$sum.'.000 đ</span></li>
								</ul>
							';
						 ?>
							<a class="btn btn-default check_out" href="" onclick="buy(); event.preventDefault();">Buy</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	

    <script src="<?php echo base_url();?>Bootstrap/js/jquery.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/bootstrap.min.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/jquery.scrollUp.min.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/price-range.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/jquery.prettyPhoto.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/main.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/sweet-alert.js"></script>


    <script type="text/javascript">
    	loadCity();
    	
    	
    	$(document).ready(function(){
    		$('.quan').hide();
    		$('#city').change(function() {
    			loadDistrict($(this).find(':selected').val());
    			$('.quan').show();
    		});
    		
    	});

    	function loadCity(){

	$.ajax({
		type: "POST",
		url: $('.baseurl').text()+"order/quan",
		data: "get=city"
	})
	.done(function(data) {
		result = JSON.parse(data);
		$(result).each(function(){
			$("#city").append($('<option>',{
				value: this.id,
				text: this.ten
			}));
		})
	});
}


function loadDistrict(cityId){
        $("#district").children().remove();
        $.ajax({
            type: "POST",
            url: $('.baseurl').text()+"order/quan",
            data: "get=district&cityId=" + cityId
            }).done(function( data ) {
            	// alert(data);
            	result = JSON.parse(data);
            	
                $(result).each(function(){
                    $("#district").append($('<option>', {
                        value: this.id,
                        text: this.ten
                    }));
                })
            });
            }
    	   
    </script>
</body>
</html>