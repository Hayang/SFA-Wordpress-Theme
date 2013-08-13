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
<div id="wrapper">
<div id="sub_wrapper">
	
	<div id="top_header" >
    <!-- UCONN HEADER --->
	<div id="uc-header" >
		<div class="uc-container">
		<h1 id="uc-identity">
			<span id="uc-logo" title="University of Connecticut">
				<a href="http://uconn.edu"> 
					<span class="uc-header-fallback" id="uc-logo-fallback">
						<img src="<?php bloginfo('template_directory');?>/img/assets/uconn.png" alt="UCONN"/>
					</span>
				</a> 
			</span>
			<span id="uc-title">
				<a href="http://uconn.edu">
					<span id="uc-title-universityof"> 
						<span class="uc-header-fallback" id="uc-title-universityof-fallback">
							<img src="<?php bloginfo('template_directory');?>/img/assets/university-of.png" alt="University of"/>
						</span> 
					</span> 
					<span id="uc-title-connecticut"> 
						<span class="uc-header-fallback" id="uc-title-connecticut-fallback">
							<img src="<?php bloginfo('template_directory');?>/img/assets/connecticut.png" alt="Connecticut" />
						</span>
					</span> 
				</a>
			</span> 
		</h1>
			<div id="uc-utility">
			<ul id="uc-utility-list">
				
				<li class="uc-utility-item"> 
					<!--<div id="uc-search" style="visibility:hidden; opacity: 0.0;">-->
			<div id="uc-search">
					<form action="
					http://uconn.edu/search.php" method="get">
						<fieldset>
								<input name="cx"  type="hidden" value="004595925297557218349:65_t0nsuec8" />
								<input name="page_id" value="160" type="hidden"/>
								<input name="cof" type="hidden" value="FORID:10" />
								<input name="ie" type="hidden" value="UTF-8" />
							<input type="text" name="q" placeholder="Search..." id="uc-search-field" value="" />
							<input type="image" id="uc-search-button" alt="Search" src="<?php bloginfo('template_directory');?>/img/assets/search-icon.png" />
						</fieldset>
									</form>
					</div>
			<!--<div  style=" float:right;" class="uc-utility-btn" id="uc-utility-btn-search"><svg version="1.1" id="uc-utility-btn-search-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 width="17.267px" height="17.033px" viewBox="0 0 17.267 17.033" enable-background="new 0 0 17.267 17.033" xml:space="preserve">
					<path d="M17.267,14.742l-5.323-5.324c0.441-0.857,0.695-1.828,0.695-2.859c0-3.451-2.798-6.25-6.25-6.25
		s-6.25,2.799-6.25,6.25c0,3.453,2.798,6.25,6.25,6.25c1.213,0,2.341-0.35,3.3-0.949l5.229,5.23L17.267,14.742z M2.806,6.559
		c0-1.979,1.604-3.582,3.583-3.582S9.973,4.58,9.973,6.559c0,1.98-1.604,3.584-3.583,3.584S2.806,8.539,2.806,6.559z"/>
					</svg> </div>-->
				</li>
				<li class="uc-utility-item"><div class="uc-utility-btn-wrap"><a href="http://uconn.edu/azindex.php" class="uc-utility-btn" id="uc-utility-btn-az"><span  id="uc-utility-btn-az-fallback">A-Z</span> </a></div>
				</li>
				<!--
				<li class="uc-utility-item"> <a href="#" class="uc-utility-btn" id="uc-utility-btn-dash"><svg version="1.1" id="uc-utility-btn-dash-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 width="15px" height="13px" viewBox="0 0 15 13" enable-background="new 0 0 15 13" xml:space="preserve">
					<g>
						<rect  width="3" height="3"/>
						<rect x="6"  width="3" height="3"/>
						<rect x="12"  width="3" height="3"/>
						<rect y="5"  width="3" height="3"/>
						<rect x="6" y="5"  width="3" height="3"/>
						<rect x="12" y="5"  width="3" height="3"/>
						<rect y="10"  width="3" height="3"/>
						<rect x="6" y="10"  width="3" height="3"/>
						<rect x="12" y="10"  width="3" height="3"/>
					</g>
					</svg></a> </li>
				-->
			</ul>
		</div>
		</div>
	</div>
	<!-- end UCONN HEADER -->
	
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
		
		<!-- Mobile Navigation Button -->
		<button type="button" id="sfa_mobilenavbutton" class="hidden-desktop btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span>
			<img src="<?php bloginfo('template_directory');?>/img/assets/menuicon.png" />
		</span>
		</button>
		
	</div> <!-- end DEPARTMENTAL HEADER --->
	
	<!-- NAV BAR --->
	<div class="row-fluid">
		<div class="navbar nav_bar">
			<div class="navbar-inner navbar_inner">
			<div class="container">			  
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
					?>
			  </div><!--/.nav-collapse -->
			</div>
			</div>
		</div>
	</div> 
	</div><!-- end NAV BAR --->
