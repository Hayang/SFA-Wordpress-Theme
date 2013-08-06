<?php

// Add Faculty Custom Post Types
require('faculty_function.php');

// Add post thumbnail support
add_theme_support( 'post-thumbnails' ); 
add_image_size( 'featured_image_right_column', 455, 9999 );
add_image_size( 'listing_featured_image', 683, 260 );
add_image_size( 'listing_small_featured_image', 337, 179 );

// Add post thumbnail caption support
function the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo $thumbnail_image[0]->post_excerpt;
  }
}
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

// End NAV BAR DROP DOWN REGISTRATION

// Main Sidebar Register


if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar Page',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="widget_title">',
		'after_title' => '</h4><div class="widget_content">'
	));
	register_sidebar(array(
		'name' => 'Sidebar Post',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="widget_title">',
		'after_title' => '</h4><div class="widget_content">'
	));
}

// End Main Sidebar Register

// Title Excerpt
function string_limit_words($string, $word_limit)
{
$words = explode(' ', $string, ($word_limit + 1));
if(count($words) > $word_limit)
array_pop($words);
return implode(' ', $words);
}

// Changes the excerpt length so the home tri boxes stay the same size and consistent...Default was 55 and way to much
function custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


// Changes the default more links
function new_excerpt_more( $more ) {
	return ' . . .';
}
add_filter('excerpt_more', 'new_excerpt_more');


// Theme Customization for stylesheet change


// THEME CUSTOMIZATION OPTIONS // EDIT BY BESARD

function sfa_theme_customizer_register($wp_customize) {


	$wp_customize-> add_section('styling_colors', array (
	'title' => __('Main Site Styling','uconn'),
	'priority'   => 30,
	'description' => 'Modify the styling colors'
	));

	$wp_customize-> add_setting('styesheet_setting', array (
	'default' =>  'style.css',
	));
	
	$wp_customize-> add_control('sylesheet_select', array (
	'label' => __('Change the Stylesheet', 'uconn'),
	'section' => 'styling_colors',
	'settings' => 'styesheet_setting',
	'type' => 'radio',
	'choices'    => array(
            'style.css' => 'Main-Default',
            'style_csa.css' => 'CSA',
            'style_sfa.css' => 'SFA',
        ),
	));
	
		
}

function sfa_css_customizer () {
	?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory');?>/<?php echo get_theme_mod('styesheet_setting'); ?>" />
	<?php 

}
add_action('wp_head','sfa_css_customizer');
add_action('customize_register','sfa_theme_customizer_register' );
// END THEME CUSTOMIZATION OPTIONS // EDIT BY BESARD 

?>