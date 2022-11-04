<?php 

// disable admin bar
show_admin_bar( false );

add_theme_support( 'title-tag' );

//Add thumbnail support
add_theme_support( 'post-thumbnails' );

//Add custom image sizes here:
# add_image_size( 'desktop-retina', 2280, 9999 );

function image_tag_class($class) {
    $class .= ' img-fluid content-image';
    return $class;
}
add_filter('get_image_tag_class', 'image_tag_class' );

// Videos in WordPress Responsive einbetten
add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
function my_embed_oembed_html($html, $url, $attr, $post_id) {
	return '<div class="ratio ratio-16x9 oembed-item">' . $html . '</div>';
}


// wpseo_opengraph_image_size
add_image_size( 'og', 1200, 627 );
add_filter( 'wpseo_opengraph_image_size', 'override_images_size');
function override_images_size() {
  return 'og';
}


function gutter(){
  $gutter = 4;
  echo $gutter;
}

// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
// register a new menu
register_nav_menu('main-menu', 'Main menu');



// Add default posts and comments RSS feed links to head.
	//add_theme_support( 'automatic-feed-links' );

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support( 'html5', array(
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
) );

// ENQUEUE STYLES AND CSS IN TO HEAD


function the_theme_js_css(){
  
  $modificated = date( 'YmdHi', filemtime( get_stylesheet_directory() . '/scss/style.scss' ) );
  
	// remove wordpress jquery
  wp_deregister_script('jquery');
  // register new jquery
  wp_register_script('jquery', get_template_directory_uri() . '/vendor/jquery-3.6.1.min.js');
  // enqueue it
  wp_enqueue_script('jquery');

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap-5/js/bootstrap.bundle.min.js', array('jquery'), '5.2.2', true );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap-5/css/bootstrap.min.css' );
    
    // lightbox
    //wp_enqueue_script( 'lightbox-js', get_template_directory_uri() . '/vendor/simplelightbox/dist/simple-lightbox.min.js', array('jquery'), '1.0.0', true );
    //wp_enqueue_style( 'lightbox-css', get_template_directory_uri() . '/vendor/simplelightbox/dist/simple-lightbox.css' );
    
    // animate css:
    //wp_enqueue_style( 'animated', get_template_directory_uri() . '/vendor/animate.min.css' );
    //wp_enqueue_script( 'wow', get_template_directory_uri() . '/vendor/WOW-master/dist/wow.min.js', array('jquery'), '1.0.0', true );
    
    // font awesome:
    //wp_enqueue_style( 'fa', get_template_directory_uri() . '/vendor/fontawesome-free-6/css/fontawesome.css' );
    //wp_enqueue_style( 'fa-solid', get_template_directory_uri() . '/vendor/fontawesome-free-6/css/solid.css' );
    //wp_enqueue_style( 'fa-brands', get_template_directory_uri() . '/vendor/fontawesome-free-6/css/brands.css' );
    
    // bootstrap icons:
    // https://icons.getbootstrap.com/
    wp_enqueue_style( 'bootstrap-icons', get_template_directory_uri() . '/vendor/bootstrap-icons/bootstrap-icons.css' );
    
    // slick slider:
    //wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/vendor/slick-master/slick/slick.min.js', array('jquery'), '1.0.0', true );
    //wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/vendor/slick-master/slick/slick.css' );
    //wp_enqueue_style( 'slick-theme-css', get_template_directory_uri() . '/vendor/slick-master/slick/slick-theme.css' );
    
    wp_enqueue_style( 'defaults', get_template_directory_uri() . '/css/defaults.css', array(), $modificated );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', array(), $modificated );
    
 
    wp_register_script('project',get_template_directory_uri().'/js/project.js',array(),$modificated,true);
    wp_enqueue_script('project');
    $dir_project = array( 'stylesheet_directory_uri' => get_template_directory_uri() );
    wp_localize_script( 'project', 'directory_uri', $dir_project );
 
}
add_action( 'wp_enqueue_scripts', 'the_theme_js_css' );


function fix_acf_landscape_img() {
  ?>
  <style type="text/css">
  .acf-gallery .acf-gallery-attachment .thumbnail img {
    max-width: 100%;
  }
  </style>
  <?php
}
add_action('acf/input/admin_head', 'fix_acf_landscape_img');


// GET ICON INLINE SVG

function getIcon($file) {
  if($file){
    get_template_part('images/'.$file);
  }
}


add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
    if( in_array('current_page_parent', $classes) ){
        $classes[] = 'active ';
    }
return $classes;
}


function add_current_nav_class($classes, $item) {

   // Getting the current post details
   global $post;

   // Get post ID, if nothing found set to NULL
   $id = ( isset( $post->ID ) ? get_the_ID() : NULL );

   // Checking if post ID exist...
   if (isset( $id )){

       // Getting the post type of the current post
       $current_post_type = get_post_type_object(get_post_type($post->ID));

       // Getting the rewrite slug containing the post type's ancestors
       $ancestor_slug = $current_post_type->rewrite ? $current_post_type->rewrite['slug'] : '';

       // Split the slug into an array of ancestors and then slice off the direct parent.
       $ancestors = explode('/',$ancestor_slug);
       $parent = array_pop($ancestors);

       // Getting the URL of the menu item
       $menu_slug = strtolower(trim($item->url));

       // Remove domain from menu slug
       $menu_slug = str_replace($_SERVER['SERVER_NAME'], "", $menu_slug);

       // If the menu item URL contains the post type's parent
       if (!empty($menu_slug) && !empty($parent) && strpos($menu_slug,$parent) !== false) {
           $classes[] = 'current-menu-item';
       }
       
       // If the menu item URL contains any of the post type's ancestors
       foreach ( $ancestors as $ancestor ) {
           if (!empty($menu_slug) && !empty($ancestor) && strpos($menu_slug,$ancestor) !== false) {
               $classes[] = 'current-page-ancestor';
           }
       }
   }
   // Return the corrected set of classes to be added to the menu item
   return $classes;

}
add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );

/* function to add classes to active menu entries */
function add_active_class_to_custom_posts($classes = array(), $menu_item = false){
    global $wp_query;
    $post_name = $menu_item->post_name;
    $post_type = get_post_type();

    /* Highlight the current menu item if the category-parent of the current posts' category equals to the menu name.
     * This is usually the case when you set a category as custom menu item and use wp_nav_menu() to display that */
    $query_var = get_query_var('cat');
    if ($query_var) {
        $current_category = get_category($query_var);
        $root_categoryObj = get_category($current_category->parent, false);
        $root_categoryName = strtolower(($root_categoryObj->name));
        if (strcasecmp($post_name, $root_categoryName) == 0) $classes[] = 'current-menu-item';    
    }
    
    /* assign 'current-menu-item' to regular posts; that's the default behaviour we just copy here */
    if(in_array('current-menu-item', $menu_item->classes)){
        $classes[] = 'current-menu-item';
    }
    else {
        /* assign the 'current-menu-item' class to all custom posts */
        if ($post_name == $post_type) {
            $classes[] = 'current-menu-item';
        }
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'add_active_class_to_custom_posts', 10, 2 );



// REMOVE IPS IN COMMENTS
function wpb_remove_commentsip( $comment_author_ip ) {
return '';
}
add_filter( 'pre_comment_user_ip', 'wpb_remove_commentsip' );


// SET YOAST TO NO-INDEX BY TEMPLATE

   function set_noindex_nofollow($post_id){
    if ( wp_is_post_revision( $post_id ) ) return;


    if ( strpos(get_page_template_slug($post_id),'page-redirect') !== false){ 

        add_action( 'wpseo_saved_postdata', function() use ( $post_id ) { 
            update_post_meta( $post_id, '_yoast_wpseo_meta-robots-noindex',      '1' );
            update_post_meta( $post_id, '_yoast_wpseo_meta-robots-nofollow', '1' );
        }, 999 );
    }else{
        return;
    }
}       
add_action( 'save_post', 'set_noindex_nofollow' );


/**
 * Disable the emoji's
 */
function disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );	
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  
  // Remove from TinyMCE
  add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

?>