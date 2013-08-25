<?php

/* Faculty Custom Posts */
//Add meta boxes to post types

add_action( 'init', 'create_my_taxonomies', 0 );

function create_my_taxonomies() {
    register_taxonomy(
        'areafield_selection',
        'areafield',
        array(
            'labels' => array(
                'name' => 'Area / Field Category',
                'add_new_item' => 'Add Area / Field Category',
                'new_item_name' => "New Area / Field Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
function plib_add_box() {
    global $meta_box;
    
    foreach($meta_box as $post_type => $value) {
        add_meta_box($value['id'], $value['title'], 'plib_format_box', $post_type, $value['context'], $value['priority']);
    }
}
add_filter('title_save_pre', 'save_title');
function save_title($my_post_title) {
        if ($_POST['post_type'] == 'faculty') :
		  $first_name = $_POST['fac_first_name'];
		  $last_name = $_POST['fac_last_name'] ;
          $new_title = $last_name .", ".$first_name;
          $my_post_title = $new_title;
        endif;
        return $my_post_title;
}

add_filter('name_save_pre', 'save_name');
function save_name($my_post_name) {
        if ($_POST['post_type'] == 'faculty') :
		  $first_name = $_POST['fac_first_name'];
		  $last_name = $_POST['fac_last_name'] ;
          $new_title = $last_name .", ".$first_name;
          $my_post_name = $new_name;
        endif;
        return $my_post_name;
}

function add_faculty_custom_post() {
	$labels = array(
		'name' => 'Faculty / Staff',
		'singular_name' => 'Faculty / Staff',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Faculty / Staff Listing',
		'edit_item' => 'Edit Faculty / Staff Listing',
		'new_item' => 'New Faculty / Staff',
		'all_items' => 'All Faculty / Staff',
		'view_item' => 'View Faculty / Staff',
		'search_items' => 'Search Faculty / Staff',
		'not_found' =>  'No Faculty / Staff Listings found.',
		'not_found_in_trash' => 'No Faculties found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Faculty / Staff'
	);

	$args = array( 
		'taxonomies' => array('areafield_selection'), 
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'faculty' ),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		//~ 'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		'supports' => array( 'page-attributes', 'author', 'thumbnail', 'editor',)
	); 

	register_post_type( 'faculty', $args );
}
add_action( 'init', 'add_faculty_custom_post' );

$meta_box['faculty'] = array(
    'id' => 'faculty-meta-details',
    'title' => 'Faculty / Staff Details',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'First Name',
            'desc' => '',
            'id' => 'fac_first_name',
            'type' => 'text',
            'default' => ''
        ),
        array(
            'name' => 'Last Name',
            'desc' => '',
            'id' => 'fac_last_name',
            'type' => 'text',
            'default' => ''
        ),
        array(
            'name' => 'Job Title',
            'desc' => '',
            'id' => 'job_title',
            'type' => 'text',
            'default' => ''
        ),
        /*
		array(
            'name' => 'Biography',
            'desc' => 'A biography of the Faculty / Staff member.',
            'id' => 'fac_biography',
            'type' => 'textarea',
            'default' => ''
        ),
		*/
        array(
            'name' => 'Email',
            'desc' => '',
            'id' => 'fac_email',
            'type' => 'text',
            'default' => ''
        ),
        array(
            'name' => 'Website',
            'desc' => '',
            'id' => 'fac_website',
            'type' => 'text',
            'default' => ''
        ),
        array(
            'name' => 'Phone Number',
            'desc' => '',
            'id' => 'fac_phone_number',
            'type' => 'text',
            'default' => ''
        ),
        array(
            'name' => 'Fax Number',
            'desc' => '',
            'id' => 'fac_fax_number',
            'type' => 'text',
            'default' => ''
        ),
	)
);

add_action('admin_menu', 'plib_add_box');

//Format meta boxes
function plib_format_box() {
  global $meta_box, $post;
 
  // Use nonce for verification
  echo '<input type="hidden" name="plib_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
  echo '<table class="form-table">';
 
  foreach ($meta_box[$post->post_type]['fields'] as $field) {
      // get current post meta data
      $meta = get_post_meta($post->ID, $field['id'], true);
 
      echo '<tr>'.
              '<th style="width:20%"><label for="'. $field['id'] .'">'. $field['name']. '</label></th>'.
              '<td>';
      switch ($field['type']) {
          case 'text':
              echo '<input type="text" name="'. $field['id']. '" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['default']) . '" size="30" style="width:97%" />'. '<br />'. $field['desc'];
              break;
          case 'textarea':
              echo '<textarea name="'. $field['id']. '" id="'. $field['id']. '" cols="60" rows="4" style="width:97%">'. ($meta ? $meta : $field['default']) . '</textarea>'. '<br />'. $field['desc'];
              break;
          case 'select':
              echo '<select name="'. $field['id'] . '" id="'. $field['id'] . '">';
              foreach ($field['options'] as $option) {
                  echo '<option '. ( $meta == $option ? ' selected="selected"' : '' ) . '>'. $option . '</option>';
              }
              echo '</select>';
              break;
          case 'radio':
              foreach ($field['options'] as $option) {
                  echo '<input type="radio" name="' . $field['id'] . '" value="' . $option['value'] . '"' . ( $meta == $option['value'] ? ' checked="checked"' : '' ) . ' />' . $option['name'];
              }
              break;
          case 'checkbox':
              echo '<input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '"' . ( $meta ? ' checked="checked"' : '' ) . ' />';
              break;
      }
      echo     '<td>'.'</tr>';
  }
 
  echo '</table>';
 
}

// Save data from meta box
function plib_save_data($post_id) {
    global $meta_box,  $post;
    
    //Verify nonce
    if (!wp_verify_nonce($_POST['plib_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }
 
    //Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
 
    //Check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    foreach ($meta_box[$post->post_type]['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
 
add_action('save_post', 'plib_save_data');



?>
