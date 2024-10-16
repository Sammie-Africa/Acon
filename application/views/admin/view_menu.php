<?php
if(!$this->session->userdata('id')) {
    redirect(base_url().'admin/login');
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Menu</h1>
	</div>
</section>


<section class="content" style="min-height:auto;margin-bottom: -30px;">
	<div class="row">
		<div class="col-md-12">
			<?php if($error): ?>
			<div class="callout callout-danger">
			<p><?php echo $error; ?></p>
			</div>
			<?php endif; ?>

			<?php if($success): ?>
			<div class="callout callout-success">
			<p><?php echo $success; ?></p>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">
			
            <?php echo form_open(base_url().'admin/menu/update',array('class' => 'form-horizontal')); ?>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Home</label>
                            <div class="col-sm-4">
                                <select name="home_status" class="form-control">
                                    <option value="1" <?php if($menu['home_status'] == 1) {echo 'selected';} ?>>Show</option>
                                    <option value="0" <?php if($menu['home_status'] == 0) {echo 'selected';} ?>>Hide</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">About</label>
                            <div class="col-sm-4">
                                <select name="about_status" class="form-control">
                                    <option value="1" <?php if($menu['about_status'] == 1) {echo 'selected';} ?>>Show</option>
                                    <option value="0" <?php if($menu['about_status'] == 0) {echo 'selected';} ?>>Hide</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Gallery</label>
                            <div class="col-sm-4">
                                <select name="gallery_status" class="form-control">
                                    <option value="1" <?php if($menu['gallery_status'] == 1) {echo 'selected';} ?>>Show</option>
                                    <option value="0" <?php if($menu['gallery_status'] == 0) {echo 'selected';} ?>>Hide</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">FAQ</label>
                            <div class="col-sm-4">
                                <select name="faq_status" class="form-control">
                                    <option value="1" <?php if($menu['faq_status'] == 1) {echo 'selected';} ?>>Show</option>
                                    <option value="0" <?php if($menu['faq_status'] == 0) {echo 'selected';} ?>>Hide</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Service</label>
                            <div class="col-sm-4">
                                <select name="service_status" class="form-control">
                                    <option value="1" <?php if($menu['service_status'] == 1) {echo 'selected';} ?>>Show</option>
                                    <option value="0" <?php if($menu['service_status'] == 0) {echo 'selected';} ?>>Hide</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Portfolio</label>
                            <div class="col-sm-4">
                                <select name="portfolio_status" class="form-control">
                                    <option value="1" <?php if($menu['portfolio_status'] == 1) {echo 'selected';} ?>>Show</option>
                                    <option value="0" <?php if($menu['portfolio_status'] == 0) {echo 'selected';} ?>>Hide</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Testimonial</label>
                            <div class="col-sm-4">
                                <select name="testimonial_status" class="form-control">
                                    <option value="1" <?php if($menu['testimonial_status'] == 1) {echo 'selected';} ?>>Show</option>
                                    <option value="0" <?php if($menu['testimonial_status'] == 0) {echo 'selected';} ?>>Hide</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">News</label>
                            <div class="col-sm-4">
                                <select name="news_status" class="form-control">
                                    <option value="1" <?php if($menu['news_status'] == 1) {echo 'selected';} ?>>Show</option>
                                    <option value="0" <?php if($menu['news_status'] == 0) {echo 'selected';} ?>>Hide</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Contact</label>
                            <div class="col-sm-4">
                                <select name="contact_status" class="form-control">
                                    <option value="1" <?php if($menu['contact_status'] == 1) {echo 'selected';} ?>>Show</option>
                                    <option value="0" <?php if($menu['contact_status'] == 0) {echo 'selected';} ?>>Hide</option>
                                </select>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
				
		</div>
	</div>

</section>