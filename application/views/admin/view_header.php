<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Panel</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/datepicker3.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/jquery.fancybox.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/summernote.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/style.css">
	


	<style>
		.skin-blue .wrapper,
		.skin-blue .main-header .logo,
		.skin-blue .main-header .navbar,
		.skin-blue .main-sidebar,
		.content-header .content-header-right a,
		.content .form-horizontal .btn-success {
			background-color: #4172a5!important;
		}

		.content-header .content-header-right a,
		.content .form-horizontal .btn-success {
			border-color: #4172a5!important;
		}
		
		.content-header>h1,
		.content-header .content-header-left h1,
		h3 {
			color: #4172a5!important;
		}

		.box.box-info {
			border-top-color: #4172a5!important;
		}

		.nav-tabs-custom>.nav-tabs>li.active {
			border-top-color: #f4f4f4!important;
		}

		.skin-blue .sidebar a {
			color: #fff!important;
		}

		.skin-blue .sidebar-menu>li>.treeview-menu {
			margin: 0!important;
		}
		.skin-blue .sidebar-menu>li>a {
			border-left: 0!important;
		}

		.nav-tabs-custom>.nav-tabs>li {
			border-top-width: 1px!important;
		}

	</style>



</head>

<body class="hold-transition fixed skin-blue sidebar-mini">

	<div class="wrapper">

		<header class="main-header">

			<a href="<?php echo base_url(); ?>admin/dashboard" class="logo">
				<span class="logo-lg">
					<img src="<?php echo base_url(); ?>public/uploads/<?php echo $setting['logo_admin']; ?>" alt="" style="max-width:100%;max-height:50px;padding:5px 0;">
				</span>
			</a>

			<nav class="navbar navbar-static-top">
				
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<span style="float:left;line-height:50px;color:#fff;padding-left:15px;font-size:18px;">Admin Panel</span>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li>
							<a href="<?php echo base_url(); ?>" target="_blank">Visit Website</a>
						</li>

						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<?php if($this->session->userdata('photo') == ''): ?>
									<img src="<?php echo base_url(); ?>public/img/no-photo.jpg" class="user-image" alt="user photo">
								<?php else: ?>
									<img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->session->userdata('photo'); ?>" class="user-image" alt="user photo">
								<?php endif; ?>
								
								<span class="hidden-xs"><?php echo $this->session->userdata('full_name'); ?></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-footer">
									<div>
										<a href="<?php echo base_url(); ?>admin/profile" class="btn btn-default btn-flat">Edit Profile</a>
									</div>
									<div>
										<a href="<?php echo base_url(); ?>admin/login/logout" class="btn btn-default btn-flat">Log out</a>
									</div>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>

			</nav>
		</header>

  		<?php
			$base_url = base_url();
			$full_url = base_url(uri_string());
			$final_url = str_replace($base_url, "", $full_url);
		?>

  		<aside class="main-sidebar">
    		<section class="sidebar">

    			<?php
	    			$final_url_other_arr = explode('/',$final_url);
	    			if(isset($final_url_other_arr[2])) {
	    				$final_url_other = $final_url_other_arr[0].'/'.$final_url_other_arr[1].'/'.$final_url_other_arr[2];
	    				
	    			} else {
	    				$final_url_other = $final_url_other_arr[0].'/'.$final_url_other_arr[1];
	    			}
	    		?>
      
      			<ul class="sidebar-menu">

			        <li class="treeview <?php if($final_url_other == 'admin/dashboard') {echo 'active';} ?>">
			          <a href="<?php echo base_url(); ?>admin/dashboard">
			            <i class="fa fa-laptop"></i> <span>Dashboard</span>
			          </a>
			        </li>


					<?php if( $this->session->userdata('role') == 'Admin' ): ?>
			        <li class="treeview <?php if( ($final_url_other == 'admin/setting') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url(); ?>admin/setting">
			            <i class="fa fa-cog"></i> <span>Settings</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($final_url_other == 'admin/menu') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url(); ?>admin/menu">
			            <i class="fa fa-retweet"></i> <span>Menu</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($final_url_other == 'admin/slider/add')||($final_url_other == 'admin/slider')||($final_url_other == 'admin/slider/edit') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url(); ?>admin/slider">
			            <i class="fa fa-picture-o"></i> <span>Slider</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($final_url_other == 'admin/service/add')||($final_url_other == 'admin/service')||($final_url_other == 'admin/service/edit') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url(); ?>admin/service">
			            <i class="fa fa-briefcase"></i> <span>Service</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($final_url_other == 'admin/faq/add')||($final_url_other == 'admin/faq')||($final_url_other == 'admin/faq/edit')||($final_url_other == 'admin/faq/main-photo') ) {echo 'active';} ?>">
						<a href="#">
							<i class="fa fa-random"></i>
							<span>FAQ</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url(); ?>admin/faq"><i class="fa fa-circle-o"></i>FAQ</a></li>
							<li><a href="<?php echo base_url(); ?>admin/faq/main-photo"><i class="fa fa-circle-o"></i> Main Photo</a></li>
						</ul>
					</li>

					<li class="treeview <?php if( ($final_url_other == 'admin/photo/add')||($final_url_other == 'admin/photo')||($final_url_other == 'admin/photo/edit') ) {echo 'active';} ?>">
						<a href="#">
							<i class="fa fa-camera"></i>
							<span>Photo Gallery</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url(); ?>admin/photo"><i class="fa fa-circle-o"></i>Photo</a></li>
						</ul>
					</li>

			        <li class="treeview <?php if( ($final_url_other == 'admin/portfolio/add')||($final_url_other == 'admin/portfolio')||($final_url_other == 'admin/portfolio/edit')||($final_url_other == 'admin/portfolio-category/add')||($final_url_other == 'admin/portfolio-category')||($final_url_other == 'admin/portfolio-category/edit') ) {echo 'active';} ?>">
						<a href="#">
							<i class="fa fa-bars"></i>
							<span>Portfolio</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url(); ?>admin/portfolio-category"><i class="fa fa-circle-o"></i> Portfolio Category</a></li>
							<li><a href="<?php echo base_url(); ?>admin/portfolio"><i class="fa fa-circle-o"></i> Portfolio</a></li>
						</ul>
					</li>

					<li class="treeview <?php if( ($final_url_other == 'admin/designation/add')||($final_url_other == 'admin/designation')||($final_url_other == 'admin/designation/edit')||($final_url_other == 'admin/team-member/add')||($final_url_other == 'admin/team-member')||($final_url_other == 'admin/team-member/edit') ) {echo 'active';} ?>">
						<a href="#">
							<i class="fa fa-users"></i>
							<span>Team Member</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url(); ?>admin/designation"><i class="fa fa-circle-o"></i> Designation</a></li>
							<li><a href="<?php echo base_url(); ?>admin/team-member"><i class="fa fa-circle-o"></i> Team Member</a></li>
						</ul>
					</li>


			        <li class="treeview <?php if( ($final_url_other == 'admin/testimonial/add')||($final_url_other == 'admin/testimonial')||($final_url_other == 'admin/testimonial/edit')||($final_url_other == 'admin/testimonial/main-photo') ) {echo 'active';} ?>">
						<a href="#">
							<i class="fa fa-user-plus"></i>
							<span>Testimonial</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url(); ?>admin/testimonial"><i class="fa fa-circle-o"></i>Testimonial</a></li>
							<li><a href="<?php echo base_url(); ?>admin/testimonial/main-photo"><i class="fa fa-circle-o"></i> Main Photo</a></li>
						</ul>
					</li>

			        <li class="treeview <?php if( ($final_url_other == 'admin/partner/add')||($final_url_other == 'admin/partner')||($final_url_other == 'admin/partner/edit') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url(); ?>admin/partner">
			            <i class="fa fa-bookmark"></i> <span>Partner</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($final_url_other == 'admin/why-choose/add')||($final_url_other == 'admin/why-choose')||($final_url_other == 'admin/why-choose/edit')||($final_url_other == 'admin/why-choose/main-photo')||($final_url_other == 'admin/why-choose/item-bg') ) {echo 'active';} ?>">
						<a href="#">
							<i class="fa fa-bolt"></i>
							<span>Why Choose Us</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url(); ?>admin/why-choose"><i class="fa fa-circle-o"></i> Why Choose</a></li>
							<li><a href="<?php echo base_url(); ?>admin/why-choose/main-photo"><i class="fa fa-circle-o"></i> Main Photo</a></li>
							<li><a href="<?php echo base_url(); ?>admin/why-choose/item-bg"><i class="fa fa-circle-o"></i> Items Background</a></li>
						</ul>
					</li>
			        			        

			        <li class="treeview <?php if( ($final_url_other == 'admin/page') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url(); ?>admin/page">
			            <i class="fa fa-file-text"></i> <span>Page</span>
			          </a>
			        </li>


					<li class="treeview <?php if( ($final_url_other == 'admin/news/add')||($final_url_other == 'admin/news')||($final_url_other == 'admin/news/edit')||($final_url_other == 'admin/news-category/add')||($final_url_other == 'admin/news-category')||($final_url_other == 'admin/news-category/edit') ) {echo 'active';} ?>">
						<a href="#">
							<i class="fa fa-newspaper-o"></i>
							<span>News Section</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?php echo base_url(); ?>admin/news-category"><i class="fa fa-circle-o"></i> News Category</a></li>
							<li><a href="<?php echo base_url(); ?>admin/news"><i class="fa fa-circle-o"></i> News</a></li>
						</ul>
					</li>

			        <li class="treeview <?php if( ($final_url_other == 'admin/comment') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url(); ?>admin/comment">
			            <i class="fa fa-comment"></i> <span>Comment</span>
			          </a>
			        </li>
			        
			        <li class="treeview <?php if( ($final_url_other == 'admin/language') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url(); ?>admin/language">
			            <i class="fa fa-language"></i> <span>language</span>
			          </a>
			        </li>
			        
			        <li class="treeview <?php if( ($final_url_other == 'admin/social-media') ) {echo 'active';} ?>">
			          <a href="<?php echo base_url(); ?>admin/social-media">
			            <i class="fa fa-address-book"></i> <span>Social Media</span>
			          </a>
			        </li>

			        <?php endif; ?>        
      			</ul>
    		</section>
  		</aside>

  		<div class="content-wrapper">