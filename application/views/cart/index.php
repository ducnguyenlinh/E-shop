<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart | E-Shopper</title>
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

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <!-- <li><a href="#">Home</a></li> -->
				  <h4 class="active">Shopping Cart</h4>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Book</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							$sum = 0;
							foreach ($_SESSION['cart'] as $key => $value) {
								$tmp = "select image, name, id, price, book_link from book_info where id = '$key'";
								$row =$this->db->query($tmp)->row();
								echo '<tr>
										<td class="cart_product">
											<a href="'.site_url('book/'.$row->book_link).'"><img src="'.$row->image.'" alt=""></a>
										</td>
										<td class="cart_description">
											<h4><a href="'.site_url('book/'.$row->book_link).'">'.$row->name.'</a></h4>
										</td>
										<td class="cart_price">
											<p>'.$row->price.'</p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">
												<a class="cart_quantity_up" onclick = "add_quantity('.$key.');event.preventDefault();" href=""> + </a>
												<input class="cart_quantity_input '.$row->id.'" type="text" name="quantity" value="'.$value.'" onchange="myFunction(this.value,'.$key.')" autocomplete="off" size="2">
												<a class="cart_quantity_down" onclick = "minus_quantity('.$key.');" href=""> - </a>
											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">'.$row->price*$value.'.000 đ</p>
										</td>
										<td class="cart_delete">
											<a class="cart_quantity_delete" href="" onclick="remove_cart('.$key.')"><i class="fa fa-times"></i></a>
										</td>
									</tr>';
									$sum += $row->price*$value;
							}
							$_SESSION['sum'] = $sum;
						 ?>
						<script>
							
							</script>
					</tbody>
				</table>
				<center><a href="<?php echo site_url();?>" style = "font-size: 20px">Continue shopping</a></center>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Cart Information</h3>
			</div>
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<?php 
							echo '
								<ul>
									<li>Tổng tiền các sản phẩm: <span>'.$sum.'.000 đ</span></li>
									<li>Thuế: <span>0đ</span></li>
									<li>Phí dịch vụ: <span>Free</span></li>
									<li>Tổng tiền: <span>'.$sum.'.000 đ</span></li>
								</ul>
							';
						 ?>
							<a class="btn btn-default check_out" href="<?php echo site_url();?>">Continue shopping</a>
							<?php echo '<a class="btn btn-default check_out" href="'.site_url('order/checkout').'">Check out</a>'; ?>
							<!-- <a class="btn btn-default check_out" >Check out</a> -->
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

</body>
</html>