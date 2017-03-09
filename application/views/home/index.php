<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
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

						<h2 class="title text-center">Hài hước - Truyện cười</h2>
						<?php 
							$sql = "SELECT * FROM book_info WHERE category_id = 1 ORDER BY created_at DESC Limit 8";
						 	
						 	$result =$this->db->query($sql)->result();
						foreach ($result as $row) {
							$name = $row->name;
							echo '

						<div class="col-sm-3">
						
							<div class="product-image-wrapper">
							
								<div class="single-products">
								<a href="'.site_url('book/'.$row->book_link).'">
									    <div class="productinfo text-center">

											<img src="'.$row->image.'" title = "'.$name.'"/>
											<h2>'.$row->price.'</h2>
											
											<p>'.$row->name.'</p>

											<a onclick="add_to_cart('.$row->id.');event.preventDefault();" href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
								</a>
										
								</div>
								
							</div>
							
						</div>
						
							';
						}
						 ?>
						
					</div><!--features_items-->
					<div class="category-tab"><!--category-tab-->
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Mới nhất</h2>
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<?php 
									$sql = "SELECT * FROM category WHERE category_id = 1";
						 			$result =$this->db->query($sql)->row();
						 			$row = $result;
						 			 $id1 = 1;

						 			echo '<li class="active"><a href="#'.$id1.'" data-toggle="tab">'.$row->category_name.'</a></li>';
								 
						 			$sql1 = "SELECT * FROM category WHERE category_id >1 AND category_id <6 ";
						 			$result1 =$this->db->query($sql1)->result();
						 			foreach ($result1 as $row1) {
						 				$id = $row1->category_id;
						 				echo '<li><a href="#'.$id.'" data-toggle="tab">'.$row1->category_name.'</a></li>';
						 			}
						 			
								 ?>
								
							</ul>
						</div>
						
						<div class="tab-content">
							<?php 
							echo '<div class="tab-pane fade active in" id="'.$id1.'" >';
								$category_id = $row->category_id;
								$sql_info = "SELECT image, name, price, created_at,book_link, id FROM book_info WHERE category_id = $category_id ORDER BY created_at DESC limit 4";
						 		$result_info =$this->db->query($sql_info)->result();

						 		foreach ($result_info as $row_info) {
						 			echo '
								 		<div class="col-sm-3">
											<div class="product-image-wrapper">
												<div class="single-products">
													<a href="'.site_url('book/'.$row_info->book_link).'">
													<div class="productinfo 		text-center">
														<img src="'.$row_info->image.'" alt="" />
														<h2>'.$row_info->price.'</h2>
														<p>'.$row_info->name.'</p>
														<a onclick="add_to_cart('.$row_info->id.'); event.preventDefault();" href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
													</div>
													</a>
												</div>
											</div>
										</div>
						 			';
						 		}
						 	echo '</div>';
							 ?>

							 <?php 
								$sql1 = "SELECT * FROM category WHERE category_id >1 AND category_id <6 ";
						 		$result1 =$this->db->query($sql1)->result();

						 		foreach ($result1 as $row1) {
									$id1 = $row1->category_id;
						 			$category_id1 = $row1->category_id;
						 			echo '<div class="tab-pane fade" id="'.$id1.'" >';
						 				$sql_info1 = "SELECT image, name, price, created_at, id,book_link FROM book_info WHERE category_id = $category_id1 ORDER BY created_at DESC limit 4";
						 				$result_info1 =$this->db->query($sql_info1)->result();

								 		foreach ($result_info1 as $row_info1) {
						 					echo '
										 		<div class="col-sm-3">
													<div class="product-image-wrapper">
														<div class="single-products">
															<a href="'.site_url('book/'.$row_info1->book_link).'">
															<div class="productinfo text-center">
																<img src="'.$row_info1->image.'" alt="" />
																<h2>'.$row_info1->price.'</h2>
																<p>'.$row_info1->name.'</p>
																<a onclick="add_to_cart('.$row_info1->id.'); event.preventDefault();" href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
															</div></a>
															
														</div>
													</div>
												</div>
						 					';
						 				}
						 				
						 			echo '</div>';
						 			}
							 ?>
							
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Tác phẩm được xem nhiều nhất</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">

							<div class="carousel-inner">
								<div class="item active">	
									<?php 
										
										$sql = "SELECT image,price,name,id,book_link FROM book_info ORDER BY view DESC Limit 3 OFFSET 0";
						 				$result =$this->db->query($sql)->result();
						 				// $result = pg_query($conn,$sql);
						 				foreach ($result as $row)
											echo '
											<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
											<a href="'.site_url('book/'.$row->book_link).'">
												<div class="productinfo text-center">
													<img src="'.$row->image.'" alt="" />
													<h2>'.$row->price.'</h2>
													<p>'.$row->name.'</p>
													<a onclick="add_to_cart('.$row->id.'); event.preventDefault();" href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
											</a>	
											</div>
										</div>
									</div>
										';
									 ?>
									
									
								</div>
								<div class="item">	
									<?php 
										
										$sql = "SELECT image,price,name,id,book_link FROM book_info ORDER BY view DESC Limit 3 OFFSET 3";
						 				$result =$this->db->query($sql)->result();

						 				foreach ($result as $row)
											echo '
											<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
											<a href="'.site_url('book/'.$row->book_link).'">
												<div class="productinfo text-center">
													<img src="'.$row->image.'" alt="" />
													<h2>'.$row->price.'</h2>
													<p>'.$row->name.'</p>
													<a onclick="add_to_cart('.$row->id.'); event.preventDefault();" href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
											</a>
											</div>
										</div>
									</div>
										';
									 ?>
									
								</div>
								<div class="item">	
									<?php 
										
										$sql = "SELECT image,price,name,id,book_link FROM book_info ORDER BY view DESC Limit 3 OFFSET 6";
						 	
						 				$result =$this->db->query($sql)->result();

						 				foreach ($result as $row)

											echo '
											<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
											<a href="'.site_url('book/'.$row->book_link).'">
												<div class="productinfo text-center">
													<img src="'.$row->image.'" alt="" />
													<h2>'.$row->price.'</h2>
													<p>'.$row->name.'</p>
													<a onclick="add_to_cart('.$row->id.'); event.preventDefault();" href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
											</a>
											</div>
										</div>
									</div>
										';
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