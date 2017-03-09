<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Order-lists | E-Shopper</title>
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
				  <h4 class="active">Shopping History</h4>'
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="id">Order</td>
							<td class="date">Date</td>
							<td class="quantity">Quantity</td>
							<td class="total">Cost</td>
							<td class="note">Status</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($user as $item) {
								$order_id = $item->order_id;
								$status = $item->status;
								if ($status==0){
									$note = "Cancelled";
									$tmp = "select sum(quantity) as s FROM order_item_deleted Where order_id = '$order_id'";
								}
								else if ($status==2){
									$note = "Sent";
									$tmp = "select sum(quantity) as s FROM order_item Where order_id = '$order_id'";
								}
								else{
									$note = "Wait";
									$tmp = "select sum(quantity) as s FROM order_item Where order_id = '$order_id'";
								}
								$row = $this->db->query($tmp)->row();
								$quantity = $row->s; 
								$total = $item->total;
								$date = $item->order_created;
								echo '<tr>
										<td class="order_id">
											<h4>#'.$order_id.'</h4>
										</td>
										<td class="order_date">
											<h4>'.$date.'</h4>
										</td>
										<td class="order_quantity">
											<h4>'.$quantity.'</h4>
										</td>
										<td class="order_total">
											<h4 class="cart_total_price">'.$total.'.000 đ</h4>
										</td>
										<td class="order_note">
											<h4>'.$note.'</h4>
										</td>
										<td class="order_details">
											<a class="btn btn-default" href="'.site_url('order-details/'.$order_id).'" style="margin-left:5em">Details</a>
											&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
								if ($status==1)			
									echo '<a class="deleted" onclick="deleted_order('.$order_id.')"><i class="fa fa-times"></i></a>';
								echo'
										</td>

									</tr>';
							}
						 ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#order_list-->

	
    <script src="<?php echo base_url();?>Bootstrap/js/jquery.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/bootstrap.min.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/jquery.scrollUp.min.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/price-range.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/jquery.prettyPhoto.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/main.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/sweet-alert.js"></script>

</body>
</html>