<?php
foreach($category as $row) {
	$category_name = $row['category_name'];
}
?>

<div class="banner-slider" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $setting['banner_category']; ?>)">
	<div class="bg"></div>
	<div class="bannder-table">
		<div class="banner-text">
			<h1>Category: <?php echo $category_name; ?></h1>
		</div>
	</div>
</div>

<div class="blog-area bg-area pt_30 pb_60 blog-clear">
	<div class="container">
		<div class="row">
			<?php
			$i=0;
			foreach ($news as $row) {
				$i++;
				?>
				<div class="col-md-4 col-sm-4 clear-item">
					<div class="blog-item common-text">
						<div class="blog-photo" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $row['photo']; ?>)"></div> 
						<div class="blog-author ">
							<ul>
					           	<li class="gro">
									Posted On: <?php echo $row['news_date']; ?>
								</li>
								<li><i class="fa fa-user-circle-o"></i>Admin</li>
							</ul>
						</div>
						<div class="blog-text">
							<h3>
								<a href="<?php echo base_url(); ?>news/view/<?php echo $row['news_id']; ?>"><?php echo $row['news_title']; ?></a>
							</h3>
							<p>
								<?php echo $row['news_short_content']; ?>
							</p>
							<div class="services-link">
								<a href="<?php echo base_url(); ?>news/view/<?php echo $row['news_id']; ?>">Read More<i class="fa fa-angle-double-right"></i></a>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>				 
		</div>
	</div>
</div>