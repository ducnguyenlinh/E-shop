<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Search | E-Shopper</title>
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
<!-- 					<h2>Result</h2>
 -->					<div class="features_items"><!--features_items-->

						<?php
						    if(isset($_GET['key']))
						    	if (count($book) < 1)
						    		echo '<h2> Could not find any book...</h2>';
						    	else{
						    	echo '<h2> There are '.count($book).' books found...</h2>';

							foreach ($book as $row) {
							echo '
								<div class="col-sm-12 padding-right">
									<div class="product-details"><!--product-details-->
							';
								echo '
									<div class="col-sm-5">
									<div class="view-product">
								';

								echo '<a href="'.site_url('book/'.$row->book_link).'"><img src="'.$row->image.'" alt="" /></a>';
								echo '
								</div>
							</div>
								';
								 echo '
              					<div class="col-sm-7">
                					<div class="product-information"><!--/product-information-->
              					';
              					echo '<a href="'.site_url('book/'.$row->book_link).'"><h2>'.$row->name.'</h2></a>';

              					if(!array_key_exists($row->id, $_SESSION['cart']) AND $row->quantity_in >0)
									$value_quantity = 1;
								else if(array_key_exists($row->id, $_SESSION['cart']) AND ($row->quantity_in - $_SESSION['cart'][$row->id] >0))
									$value_quantity = 1;
								else
									$value_quantity = "";

              					echo '<span><span>'.$row->price.'</span>
					                  	<label class="cart_quantity_input_label">Quantity:</label>
										<input class="cart_quantity_input '.$row->id.'" type="text" name="quantity" value="'.$value_quantity.'"/>
										<button type="button" class="btn btn-fefault cart" onclick="event.preventDefault();add_to_cart_quantity('.$row->id.'); ">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
										</button>
					                	</span>';
					              echo '
					                  <p><b>Author:</b> '.$row->author.'</p>
					                  <a href="'.site_url('product/'.$row->category_link).'"><p><b>Category:</b> '.$row->category_name.'</p></a>
					                  ';
					              echo '
					              
					                </div><!--/product-information-->
					              </div>
					              '; 
							echo '
								
								</div><!--/product-details-->
								</div>
							';
						}
						}
						 ?>
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