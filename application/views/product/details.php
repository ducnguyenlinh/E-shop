<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product Details | E-Shopper</title>
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
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<?php 
									$row = $book;
									echo '
										<img src="'.$row->image.'" alt="" />
									';
									$category_id = $row->category_id;
									$id = $row->id;
								 ?>

							</div>
							
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<!-- <img src="images/product-details/new.jpg" class="newarrival" alt="" /> -->
								<?php 
								if(!array_key_exists($row->id, $_SESSION['cart']) AND $row->quantity_in >0)
									$value_quantity = 1;
								else if(array_key_exists($row->id, $_SESSION['cart']) AND ($row->quantity_in - $_SESSION['cart'][$row->id] >0))
									$value_quantity = 1;
								else
									$value_quantity = "";
									echo '<h2>'.$row->name.'</h2>';
									echo '
									<span>
									<span>'.$row->price.'</span>
									<label class="cart_quantity_input_label">Quantity:</label>
									<input class="cart_quantity_input '.$row->id.'" type="text" name="quantity" value="'.$value_quantity.'"/>
									<button type="button" class="btn btn-fefault cart" onclick="event.preventDefault();add_to_cart_quantity('.$row->id.'); ">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									</span>
									';


									echo '
									<p><b>Author:</b> '.$row->author.'</p>
									<p><b>Quantity:</b> '.$row->category_name.'</p>
									';
								 ?>
								
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<br/>
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Products Infomation</h2>
						<?php 
							echo '<h4 style = "color: #6666ff">'.$row->name.'</h4>';
							echo '<p>'.$row->description.'</p>';
						 	$view=$row->view+1;

						 ?>
						 <br/>

					</div>
					<table class="table table-condensed">
					 	<tr class="info">
         					<td>Producer</td>
          					<td><?php echo $row->publisher; ?></td>
        				</tr>
				        <tr class="active">
				          <td>Weight (gram)</td>
				          <td><?php echo $row->mass; ?></td>
				        </tr>
				        <tr class="info">
				          <td>Size</td>
				          <td><?php echo $row->size; ?></td>
				        </tr>
				        <tr class="active">
				          <td>Author</td>
				          <td><?php echo $row->author; ?></td>
				        </tr>
				        <tr class="info">
				          <td>Pages</td>
				          <td><?php echo $row->number_of_page; ?></td>
				        </tr>
				        <tr class="active">
				          <td>Publish date</td>
				          <td><?php echo $row->date_published; ?></td>
				        </tr>
				        <tr class="info">
				          <td>Category</td>
				          <td><?php echo $row->category_name; ?></td>
				        </tr>
				       
					</table>
					<?php 
						$sql = "UPDATE book_info SET view=$view WHERE id='$id' ";
						$this->db->query($sql);
					 ?>
					<br/>
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Same Category</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	

									<?php 
									$tmp = "SELECT category_id, name, image, price,id,book_link FROM book_info WHERE category_id = '$book->category_id' AND id !='$id'  Limit 3 OFFSET 0";
									// echo $tmp;
									$result =$this->db->query($tmp)->result();
								foreach ($result as $row){
									echo '
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
												<a href="'.site_url('book/'.$row->book_link).'">
													<img src="'.$row->image.'" alt="" />
													<h2>'.$row->price.'</h2>
													<p>'.$row->name.'</p>
													
												</a>
												<a onclick="add_to_cart('.$row->id.'); event.preventDefault();" href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
											</div>
										</div>
									</div>
								';
								}
								
								?>	

								</div>
								<div class="item">	
									<?php 
									$tmp = "SELECT category_id, name, image, price,id,book_link FROM book_info WHERE category_id = '$book->category_id' AND id !='$id'  Limit 3 OFFSET 3";
									// echo $tmp;
									$result =$this->db->query($tmp)->result();
								foreach ($result as $row){
									echo '
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
												<a href="'.site_url('book/'.$row->book_link).'">
													<img src="'.$row->image.'" alt="" />
													<h2>'.$row->price.'</h2>
													<p>'.$row->name.'</p>
												</a>
												<a onclick="add_to_cart('.$row->id.'); event.preventDefault();" href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								';
								}
								
								?>	
									
								</div>
								<div class="item">	
									<?php 
									$tmp = "SELECT category_id, name, image, price,id,book_link FROM book_info WHERE category_id = '$book->category_id' AND id !='$id'  Limit 3 OFFSET 6";
									// echo $tmp;
									$result =$this->db->query($tmp)->result();
								foreach ($result as $row){
									echo '
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
												<a href="'.site_url('book/'.$row->book_link).'">
													<img src="'.$row->image.'" alt="" />
													<h2>'.$row->price.'</h2>
													<p>'.$row->name.'</p>
												</a>
												<a onclick="add_to_cart('.$row->id.'); event.preventDefault();" href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								';
								}
								
								?>	
									
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
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