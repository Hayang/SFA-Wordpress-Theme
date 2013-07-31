<!DOCTYPE html>
<html>

<head>

	<title>
	<?php
	//Print the <title> tag based on what is being viewed.
		global $page, $paged;
		wp_title( '|', true, 'right' );
	// Add the blog name.
		bloginfo( 'name' );
	// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
	?>
	</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Bootstrap -->	
	<link href="<?php bloginfo('template_directory');?>/css/bootstrap.css" rel="stylesheet" media="screen"> 
		<!-- FINALIZED VERISON WILL LINK TO bootstrap.min.css--->
	<link href="<?php bloginfo('template_directory');?>/css/bootstrap-responsive.css" rel="stylesheet"> 
		<!-- FINALIZED VERISON WILL LINK TO bootstrap-responsive.min.css--->
	
	<!-- include jQuery -->
	<?php wp_enqueue_script("jquery"); ?>
	
	<!-- SFA Web Team CSS (style.css) And Custom Style -->
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php wp_head(); ?> 
	<!-- SFA Web Team CSS (style.css) And Custom Style -->
</head>
	
<body>
<div id="top_header" >
    <!-- UCONN HEADER --->
	<div class="row-fluid uconn_header">
		<a href="www.uconn.edu" >
			<!-- Placeholder Images -->
			<img id="uconn_logo" src="<?php bloginfo('template_directory');?>/img/assets/uconn_logo.png" />
			<img id="uconn_sidebuttons" src="<?php bloginfo('template_directory');?>/img/assets/uconn_sidebuttons.png" />
		</a>
	</div> <!-- end UCONN HEADER --->
	
    <!-- DEPARTMENTAL HEADER --->
	<div class="row-fluid school_header">
		<div> <a href="<?php bloginfo( 'url' ); ?>"> 
			<h2 id="department_title">
				<?php bloginfo('name'); ?> 
			</h2>
			<h2 id="sfa_title" class="hidden-phone">
				<?php bloginfo('description'); ?>
			</h2></a>
		</div>
	</div> <!-- end DEPARTMENTAL HEADER --->
	
	<!-- NAV BAR --->
	<div class="row-fluid">
		<div class="navbar nav_bar">
			<div class="navbar-inner navbar_inner">
			<div class="container">
			  <button type="button" id="sfa_mobilenavbutton" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  
			  <div class="nav-collapse collapse">
						<?php
					
					$args = array(
						'theme_location' => 'top_nav_menu',
						'depth'		 => 2,
						'container'	 => false,
						'menu_class'	 => 'nav',
						'walker'	 => new BootstrapNavMenuWalker()
					);

					wp_nav_menu($args);
				//~ <ul class="nav">
				  //~ <li id="li_1"><a href="#">OVERVIEW</a></li>
				  //~ <li id="li_2"><a href="#">PROGRAMS</a></li>
				  //~ <li id="li_3"><a href="#">APPLY</a></li>
				  //~ <li id="li_4"><a href="#">COMMUNITY</a></li>
				  //~ <li id="li_5"><a href="#">STUDENT WORK</a></li>
				  //~ <li class="dropdown"  id="li_6">
					//~ <a href="#" class="dropdown-toggle" data-toggle="dropdown">INFORMATION <b class="caret"></b></a>
					//~ <ul class="dropdown-menu">
					  //~ <li><a href="#">Action</a></li>
					  //~ <li><a href="#">Another action</a></li>
					  //~ <li><a href="#">Something else here</a></li>
					  //~ <li class="divider"></li>
					  //~ <li class="nav-header">Nav header</li>
					  //~ <li><a href="#">Separated link</a></li>
					  //~ <li><a href="#">One more separated link</a></li>
					//~ </ul>
					  ?>
				  </li>
				</ul>
			  </div><!--/.nav-collapse -->
			</div>
			</div>
		</div>
	</div> 
	</div><!-- end NAV BAR --->
