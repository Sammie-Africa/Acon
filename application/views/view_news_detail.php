<?php
// Update data for view count for this news page
// Getting current view count
// $statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_id=?");
// $statement->execute(array($_REQUEST['id']));
// $result = $statement->fetchAll();
// foreach ($result as $row) 
// {
// 	$current_total_view = $row['total_view'];
// }
// $updated_total_view = $current_total_view+1;

// Updating database for view count
//$statement = $pdo->prepare("UPDATE tbl_news SET total_view=? WHERE news_id=?");
//$statement->execute(array($updated_total_view,$_REQUEST['id']));

?>
<div class="banner-slider" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $news['banner']; ?>)">
	<div class="bg"></div>
	<div class="bannder-table">
		<div class="banner-text">
			<h1><?php echo $news['news_title']; ?></h1>
		</div>
	</div>
</div>


<div class="single-service-area pt_30 pb_60 common-text">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="single-service-item">
					<div class="single-service-photo">
						<img src="<?php echo base_url(); ?>public/uploads/<?php echo $news['photo']; ?>" class="img-responsive" alt="">
					</div>
					<div class="single-service-text">
						<div class="single-blog-author mb_20">
							<ul>
								<li class="gro"><i class="fa fa-calendar"></i><?php echo $news['news_date']; ?></li>
								<li class="" style="margin-left: -10px;"><i class="fa fa-user-circle-o"></i><?php echo ADMIN; ?></li>
							</ul>
						</div>
						<p>
							<?php echo $news['news_content']; ?>
						</p>
						<h3><?php echo SHARE_THIS; ?></h3>

						<!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_google_plus"></a>
<a class="a2a_button_pinterest"></a>
<a class="a2a_button_linkedin"></a>
<a class="a2a_button_digg"></a>
<a class="a2a_button_tumblr"></a>
<a class="a2a_button_reddit"></a>
<a class="a2a_button_stumbleupon"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
						
						<?php if($comment == 'On'): ?>
						<h3><?php echo COMMENTS; ?></h3>
						<?php
						// Getting the full url of the current page
						$final_url = base_url().'news/view/'.$_REQUEST['id'];
						?>
						<!-- Facebook Comment Main Code (got from facebook website) -->
						<div class="fb-comments" data-href="<?php echo $final_url; ?>" data-numposts="5"></div>
						<?php endif; ?>

					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="sidebar"> 
					
					<div class="sidebar-item">
						<div class="sidebar-item searchbar-item">
							<?php echo form_open(base_url().'search'); ?>
								<div class="input-group">
									<?php
										$data = array(
											'type'         => 'text',
											'name'         => 'search_string',
											'class'        => 'form-control',
											'autocomplete' => 'off',
											'placeholder'  => SEARCH_NEWS
										);
										echo form_input($data);
									?>
									<span class="input-group-btn">
										<?php
											$data = array(
												'name'    => 'form1',
												'class'   => 'btn btn-default',
												'type'    => 'submit',
												'content' => '<i class="fa fa-search"></i>'
											);
											echo form_button($data);
										?>
							  		</span>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>	

					<div class="sidebar-item">		
						<h3><?php echo CATEGORY; ?></h3>		
						<ul>
							<?php
							foreach ($news_category as $row) {
								?>
								<li><a href="<?php echo base_url(); ?>category/view/<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></a></li>
								<?php
							}
							?>
						</ul>
					</div>	

					<div class="sidebar-item">		
						<h3><?php echo LATEST_NEWS; ?></h3>		
						<ul>
							<?php
							$i=0;
							foreach ($latest_news as $row) {
								$i++;
								if($i>$setting['total_recent_post']) {break;}
								?>
								<li><a href="<?php echo base_url(); ?>news/view/<?php echo $row['news_id']; ?>"><?php echo $row['news_title']; ?></a></li>
								<?php
							}
							?>
						</ul>
					</div>


					<div class="sidebar-item">		
						<h3><?php echo POPULAR_NEWS; ?></h3>		
						<ul>
							<?php
							$i=0;
							foreach ($popular_news as $row) {
								$i++;
								if($i>$setting['total_popular_post']) {break;}
								?>
								<li><a href="<?php echo base_url(); ?>news/view/<?php echo $row['news_id']; ?>"><?php echo $row['news_title']; ?></a></li>
								<?php
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>