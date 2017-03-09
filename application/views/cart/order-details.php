<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Order-details | E-Shopper</title>
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
							<td class="total">Total </td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
							$row = $user;
							$receiver = $row->receiver;
							$address = $row->address;
							$phone = $row->phone;
							$id = $row->order_id;
							$status = $row->status;


							$city = $city->ten;
							$district = $district->ten;
						?>

						<?php 
							$sum = 0;
							if ($status==1 || $status ==2)
								$sql = "select * from order_item where order_id = '$id'";
							else
								$sql = "select * from order_item_deleted where order_id = '$id'";
							$result = $this->db->query($sql)->result();
							foreach ($result as $item) {
								$key = $item->item_id;
								$value = $item->quantity;
								$tmp = "select image, name, id, price from book_info where id = '$key'";
								$row = $this->db->query($tmp)->row();
								echo '<tr>
										<td class="cart_product">
											<a href="product-details.php?id='.$row->id.'"><img src="'.$row->image.'" alt=""></a>
										</td>
										<td class="cart_description">
											<h4><a href="product-details.php?id='.$row->id.'">'.$row->name.'</a></h4>
										</td>
										<td class="cart_price">
											<p>'.$row->price.'</p>
										</td>
										<td class="cart_price">
											<p>'.$value.'</p>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">'.$row->price*$value.'.000 đ</p>
										</td>
									</tr>';
									$sum += $row->price*$value;
							}
						 ?>
						
					</tbody>
				</table>
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
									<li>Cost: <span>'.$sum.'.000 đ</span></li>
									<li>Tax: <span>0đ</span></li>
									<li>Shipping fee: <span>Free</span></li>
									<li>Total: <span>'.$sum.'.000 đ</span></li>
								</ul>
							';
						 ?>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="total_area">
						<?php 
							echo '
								<ul>
									<li>Receiver: <span>'.$receiver.'</span></li>
									<li>Address: <span>'.$address.'</span></li>
									<li>District:<span>'.$district.'</span></li>
									<li>City: <span>'.$city.'</span> </li>
									<li>Phone number: <span>'.$phone.'</span></li>
								</ul>
							';
						 ?>
					</div>
				</div>
			</div>
		</div>
		<center>
		<?php
		echo'<a class="btn btn-default check_out" href="'.site_url().'">OK</a>';
		if ($status==1)
			echo' <a class="btn btn-default check_out" onclick="deleted_order('.$id.');">Cancel order</a>';
		?>
		</center>	

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