
<header id="header"><!--header-->
			 <div class="hidden baseurl"><?php echo site_url();?></div>
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?php echo site_url();?>" class="active"><i class="fa fa-home"></i>Home</a></li>
                                
                                <?php 
                              		
									if($this->session->has_userdata('login'))
										{
											$user = $this->session->userdata('login');
											// echo $this->session->userdata('login')->user_id;

											echo '<li><a href="'.site_url('order-lists/'.$this->session->userdata('login')->user_id).'">Shopping history</a></li>';
										} 
								?>
								<!-- <li><a href="contact-us.html">Contact</a></li> -->
							</ul>
						</div>
					</div>
					
					<div class="col-sm-4 cod-sm-offset-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php 
									if($this->session->has_userdata('login'))
										{
											$user = $this->session->userdata('login');
											echo '<li><a href="#"><i class="fa fa-user"></i> '.$user->user_name.'</a></li>';
										} 
								
									else
										echo '<li><a href="#"><i class="fa fa-user"></i> Account</a></li>';
								?>
								
								<li><a href='<?php echo''.site_url("cart/").'' ?>'><i class="fa fa-shopping-cart"></i> Cart
									<?php 
										if(!$this->session->has_userdata('cart')){
											$this->session->set_userdata('cart', array());
										}
										$sum = 0;
										foreach ($this->session->userdata('cart') as $key => $value) {
											$sum += $value;
										}
										if($sum>0)
											echo '<span class="badge" style="background:red">'.$sum.'</span>';
									 ?>
								</a></li>
								<?php 
									if($this->session->has_userdata('login'))
										echo '<li><a href='.site_url("user/logout").'><i class="fa fa-lock"> Logout</i></a></li>';
									else
										echo '<li><a href='.site_url("user/account").'><i class="fa fa-lock"> Login</i></a></li>';
								 ?>
								
							</ul>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form class="navbar-form navbar-right"  method="get" action="<?php echo site_url();?>search">
								<input type="text" placeholder="Search" name="key" class="search"/>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			
		</div><!--/header-bottom-->
	</header><!--/header-->