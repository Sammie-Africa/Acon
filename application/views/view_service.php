<div class="banner-slider" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $setting['banner_service']; ?>)">
	<div class="bg"></div>
	<div class="bannder-table">
		<div class="banner-text">
			<h1><?php echo $page['service_heading']; ?></h1>
		</div>
	</div>
</div>

<div class="services-area pt_10 pb_40">
	<div class="container">
		<div class="row">
			<?php
			foreach($service as $row) {
				?>
				<div class="col-md-4 col-sm-6 col-xs-12 clear-three">
					<div class="services-item">
						<div class="services-photo" style="background-image: url(<?php echo base_url(); ?>public/uploads/<?php echo $row['photo']; ?>)"></div>
						<div class="services-text">
							<h3><a href="<?php echo base_url(); ?>service/view/<?php echo $row['id']; ?>"><?php echo $row['heading']; ?></a></h3>
							<?php echo $row['short_content']; ?>
							<div class="services-link">
								<a href="<?php echo base_url(); ?>service/view/<?php echo $row['id']; ?>"><?php echo READ_MORE; ?> <i class="fa fa-angle-double-right"></i></a>
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