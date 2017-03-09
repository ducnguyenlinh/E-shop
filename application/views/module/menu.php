				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian">
							<?php
								$sql = "SELECT * FROM category";
								$result =$this->db->query($sql)->result();
						 		foreach ($result as $row) {
									echo '<div class="panel panel-default">
											<div class="panel-heading">		
												<h4 class="panel-title"><a href="'.site_url('product/'.$row->category_link).'">'.$row->category_name.'</a></h4>
											</div>
										</div>';
								}
							  ?>
							
	
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Author</h2>
							<?php 
								echo '
								<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
								';
								$sql = "SELECT author,author_link, COUNT(id) FROM book_info GROUP BY author,author_link ORDER BY COUNT(id) DESC limit 5";
								$result =$this->db->query($sql)->result();
						 		foreach ($result as $row) {
									echo '<li><a href="'.site_url('author/'.$row->author_link).'"> <span class="pull-right">('.$row->count.')</span>'.$row->author.'</a></li>';
								}
								echo '
								</ul>
								</div>
								';
							 ?>
							
								
						</div><!--/brands_products-->
					
					</div>
				</div>