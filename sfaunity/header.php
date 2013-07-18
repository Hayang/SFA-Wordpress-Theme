<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<!-- Plus Wordpress -->
		<!-- edited by Vi on 06.07.2013 -->
		<link href="<?php bloginfo('template_directory');?>/css/bootstrap.css" rel="stylesheet" media="screen"> <!-- FINALIZED VERISON WILL LINK TO bootstrap.min.css--->
		<link href="<?php bloginfo('template_directory');?>/css/bootstrap-responsive.css" rel="stylesheet"> <!-- FINALIZED VERISON WILL LINK TO bootstrap-responsive.min.css--->
		<!-- SFA Web Team CSS
		<link href="style.css" rel="stylesheet" media="screen">
		 -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	
	</head>
	<body>
    <!-- UCONN HEADER --->
	<div class="row-fluid uconn_header">
		<a href="www.uconn.edu" >
			<!-- Placeholder Images -->
			<img id="uconn_logo" src="<?php bloginfo('template_directory');?>/img/assets/uconn_logo.png" />
			<img id="uconn_sidebuttons" src="<?php bloginfo('template_directory');?>/img/assets/uconn_sidebuttons.png" />
		</a>
	</div> 
	<!-- END UCONN HEADER --->
	
    <!-- DEPARTMENTAL HEADER --->
	<div class="row-fluid school_header">
		<div> <a href="<?php bloginfo( 'url' ); ?>"> 
			<h2 id="department_title">ART & ART HISTORY</h2>
			<h2 id="sfa_title">SCHOOL OF FINE ARTS</h2></a>
		</div>
	</div> 
	<!-- DEPARTMENTAL HEADER --->
	
	<!-- NAV BAR --->
		<div class="row-fluid">
		 <div class="navbar nav_bar">
      <div class="navbar-inner navbar_inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <div class="nav-collapse collapse">
					<?php 
		
						wp_nav_menu( array(
						'theme_location' => 'top_nav_menu',
						'container' => 'false',
						'depth' => 0,
						'menu_class' => 'nav'
						) );
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
		<!-- END NAV BAR --->
