<div class="banner-slider" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $setting['banner_gallery']; ?>)">
	<div class="bg"></div>
	<div class="bannder-table">
		<div class="banner-text">
			<h1><?php echo $page['gallery_heading']; ?></h1>
		</div>
	</div>
</div>


<div class="caption-photo-area ptb-60" style="margin-top:-20px;">
	<div class="container">
		<div class="row">
			<?php
			foreach ($gallery as $row) {
				?>
				<div class="col-md-3 col-sm-4 col-xs-12 clear-four">
					<div class="caption-item">
						<div class="caption-photo" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $row['photo_name']; ?>)">
							<div class="caption-bg"></div>
							<div class="caption-box">
								<div class="caption-table">
									<div class="caption-icon">
										<a href="<?php echo base_url(); ?>public/uploads/<?php echo $row['photo_name']; ?>" data-lightbox="lightbox-item"><i class="fa fa-search-plus"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="caption-text">
							<p><?php echo $row['photo_caption']; ?></p>
						</div>
					</div>
				</div>
				<?php
			}
			?>

		</div>
	</div>
</div>