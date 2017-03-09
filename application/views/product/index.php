<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product | E-Shopper</title>
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
	<section>
		<div class="container">
			<div class="row">
				<?php $this->load->view('module/menu');?>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<?php 
						$name = $category->category_name;
						
						echo '<h2 class="title text-center">'.$name.'</h2>';
						
						foreach ($book_info as $row) {
							echo '
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
									<a href="'.site_url('book/'.$row->book_link).'">
									    <div class="productinfo text-center">
											<img src="'.$row->image.'"  title = "'.$row->name.'"/>
											<h2>'.$row->price.'</h2>
											<p>'.$row->name.'</p>
											<a onclick="add_to_cart('.$row->id.'); event.preventDefault();" href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</a>	
								</div>
								
							</div>
						</div>

							';
						}
						 echo $this->pagination->create_links(); // tạo link phân trang 
						?>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
  
    <script src="<?php echo base_url();?>Bootstrap/js/jquery.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/bootstrap.min.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/jquery.scrollUp.min.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/price-range.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/jquery.prettyPhoto.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/main.js"></script>
  	<script src="<?php echo base_url();?>Bootstrap/js/sweet-alert.js"></script>
    


</body>
</html>