<?php

// Register RoyalSlider Files
register_new_royalslider_files(1);

// When Admin Bar at top is not activated, don't insert a blank space
//~ function my_function_admin_bar(){ return false; }
//~ add_filter( 'show_admin_bar' , 'my_function_admin_bar');

register_nav_menus( array(
	'top_nav_menu' => 'Top Navigation Menu'
) );

// include jQuery
add_action( 'wp_enqueue_script', 'load_jquery' );
function load_jquery() {
    wp_enqueue_script( 'jquery' );
}
/**
 * Extended Walker class for use with the
 * Twitter Bootstrap toolkit Dropdown menus in Wordpress.
 * Edited to support n-levels submenu.
 * @author johnmegahan https://gist.github.com/1597994, Emanuele 'Tex' Tessore https://gist.github.com/3765640
 */
class BootstrapNavMenuWalker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth ) {

		$indent = str_repeat( "\t", $depth );
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output	   .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";

	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {


		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		// managing divider: add divider class to an element to get a divider before it.
		$divider_class_position = array_search('divider', $classes);
		if($divider_class_position !== false){
			$output .= "<li class=\"divider\"></li>\n";
			unset($classes[$divider_class_position]);
		}
		
		$classes[] = ($args->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;
		if($depth && $args->has_children){
			$classes[] = 'dropdown-submenu';
		}


		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="#"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($depth == 0 && $args->has_children) ? ' </a>' : '</a>';
		$item_output .= $args->after;


		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		//v($element);
		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) )
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);

	}

}

// THEME CUSTOMIZATION OPTIONS // EDIT BY BESARD

function sfa_theme_customizer_register($wp_customize) {
	$wp_customize-> add_section('nav_btn_colors', array (
	'title' => __('Main Nav Button Colors','uconn'),
	'priority'   => 30,
	'description' => 'Modify the Navigation button colors'
	
	));

	$wp_customize-> add_setting('button_2', array (
	'default' =>  '#F27200',
	));
	
	$wp_customize-> add_control( new WP_Customize_Color_Control($wp_customize,'button_2', array (
	'label' => __('Edit Button 2 Color', 'uconn'),
	'section' => 'nav_btn_colors',
	'settings' => 'button_2'
	) ));
	
	$wp_customize-> add_setting('button_1', array (
	'default' =>  '#E8AD45',
	));
	
	$wp_customize-> add_control( new WP_Customize_Color_Control($wp_customize,'button_1', array (
	'label' => __('Edit Button 1 Color', 'uconn'),
	'section' => 'nav_btn_colors',
	'settings' => 'button_1'
	) ));
	
	$wp_customize-> add_setting('button_3', array (
	'default' =>  '#761BA1',
	));
	
	$wp_customize-> add_control( new WP_Customize_Color_Control($wp_customize,'button_3', array (
	'label' => __('Edit Button 3 Color', 'uconn'),
	'section' => 'nav_btn_colors',
	'settings' => 'button_3'
	) ));
	
	$wp_customize-> add_setting('button_4', array (
	'default' =>  '#2FA50F',
	));
	
	$wp_customize-> add_control( new WP_Customize_Color_Control($wp_customize,'button_4', array (
	'label' => __('Edit Button 4 Color', 'uconn'),
	'section' => 'nav_btn_colors',
	'settings' => 'button_4'
	) ));
	
	$wp_customize-> add_setting('button_5', array (
	'default' =>  '#2AABE0',
	));
	
	$wp_customize-> add_control( new WP_Customize_Color_Control($wp_customize,'button_5', array (
	'label' => __('Edit Button 5 Color', 'uconn'),
	'section' => 'nav_btn_colors',
	'settings' => 'button_5'
	) ));
	
	$wp_customize-> add_setting('button_6', array (
	'default' =>  '#F25018',
	));
	
	$wp_customize-> add_control( new WP_Customize_Color_Control($wp_customize,'button_6', array (
	'label' => __('Edit Button 6 Color', 'uconn'),
	'section' => 'nav_btn_colors',
	'settings' => 'button_6'
	) ));
	
}

function sfa_css_customizer () {
	?>
	<style type="text/css">
	.li_1 { background-color: <?php echo get_theme_mod('button_1'); ?> ; }
	.li_2 { background-color: <?php echo get_theme_mod('button_2'); ?> ; }
	.li_3 { background-color: <?php echo get_theme_mod('button_3'); ?> ; }
	.li_4 { background-color: <?php echo get_theme_mod('button_4'); ?> ; }
	.li_5 { background-color: <?php echo get_theme_mod('button_5'); ?> ; }
	.li_6 { background-color: <?php echo get_theme_mod('button_6'); ?> ; }
	</style>
	<?php 

}
add_action('wp_head','sfa_css_customizer');
add_action('customize_register','sfa_theme_customizer_register' );
// END THEME CUSTOMIZATION OPTIONS // EDIT BY BESARD



// Main Sidebar Register

	register_sidebar (array(
		'name' => __('Main Sidebar'),
		'id' => 'sidebar',
		'description'   => __('DESCIPTION'),
        'class'         => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		
		));
		

// End Main Sidebar Register


// Changes the excerpt length so the home tri boxes stay the same size and consistent...Default was 55 and way to much
function custom_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Changes the default more links
function new_excerpt_more( $more ) {
	return ' . . .';
}
add_filter('excerpt_more', 'new_excerpt_more');

?>