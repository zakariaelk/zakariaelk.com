<?php

/* 
    FUNCTIONS FILE
*/

/*-----------------------------------------------------------------------------------*/
/*  Declare External Function Files
/*-----------------------------------------------------------------------------------*/

// require get_template_directory() . '/ajax.php';


/*-----------------------------------------------------------------------------------*/
/*  Register CSS
/*-----------------------------------------------------------------------------------*/

function inravel_enqueue_styles() {
    wp_enqueue_style( 'zak-styles', get_stylesheet_directory_uri() . '/src/css/main.css' );    
}
add_action( 'wp_enqueue_scripts', 'inravel_enqueue_styles' );


/*-----------------------------------------------------------------------------------*/
/*  Register JS
/*-----------------------------------------------------------------------------------*/

function inravel_enqueue_scripts() {        
    // wp_enqueue_script( 'jQuery', get_stylesheet_directory_uri() . '/src/js/vendors/jquery-3.5.1.min.js', array(), false, true );
    // wp_enqueue_script( 'jQuery-ripple', get_stylesheet_directory_uri() . '/src/js/vendors/jquery.ripples-min.js', array(), false, true );    
    // wp_enqueue_script( 'anime', get_stylesheet_directory_uri() . '/src/js/vendors/anime.min.js', array(), false, true );
    // wp_enqueue_script( 'TweenMax', get_stylesheet_directory_uri() . '/src/js/vendors/TweenMax.min.js', array(), false, true );
    // wp_enqueue_script( 'THREE', get_stylesheet_directory_uri() . '/src/js/vendors/three.min.js', array(), false, true );    
    // wp_enqueue_script( 'hover-effect', get_stylesheet_directory_uri() . '/src/js/vendors/hover-effect.umd.js', array(), false, true );
    // wp_enqueue_script( 'app-js', get_stylesheet_directory_uri() . '/src/js/app.js', array(), false, true );
    
    
    wp_enqueue_script( 'app-js', get_stylesheet_directory_uri() . '/dist/bundle.min.js', array(), false, true );

}
add_action( 'wp_enqueue_scripts', 'inravel_enqueue_scripts' );




/*-----------------------------------------------------------------------------------*/
/*  Register NAV MENU
/*-----------------------------------------------------------------------------------*/


function inravel_register_menu() {
  register_nav_menus(
    array(
      'top-menu' => __( 'Top Menu' ),
      'primary-menu' => __( 'Primary Menu' ),              
      'secondary-menu' => __( 'Secondary Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'inravel_register_menu' );

/*-----------------------------------------------------------------------------------*/
/*  Register LANGUAGE MENU
/*-----------------------------------------------------------------------------------*/

function inravel_get_language_menu()
{
    if (class_exists('WPGlobus')) 
    {
        $arrLang = array();
        $enabled_languages = WPGlobus::Config()->enabled_languages;
        foreach ( $enabled_languages as $language )
        {
            $arrLang[$language]['url'] = WPGlobus_Utils::localize_current_url( $language );
            $arrLang[$language]['name'] = WPGlobus::Config()->language_name[ $language ];
            $arrLang[$language]['code'] = $language;
            $arrLang[$language]['locale'] = WPGlobus::Config()->locale[ $language ];
            $arrLang[$language]['flags_url'] = WPGlobus::Config()->flags_url;
            $arrLang[$language]['flag'] = WPGlobus::Config()->flag[ $language ];
            if ( $language == WPGlobus::Config()->language ) { $arrLang[$language]['active'] = 1; } else { $arrLang[$language]['active'] = 0; }
        }
    }
    else
    {
        $arrLang = 0;
    }
    return $arrLang;
}


/*-----------------------------------------------------------------------------------*/
/*  enable svg images in media uploader
/*-----------------------------------------------------------------------------------*/

function cc_mime_types( $mimes ){
$mimes['svg'] = 'image/svg+xml';
return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );


/*-----------------------------------------------------------------------------------*/
/*  display svg images on media uploader and feature images
/*-----------------------------------------------------------------------------------*/

function custom_admin_head() {
  $css = '';

  $css = 'td.media-icon img[src$=".svg"] { width: 100% !important; height: auto !important; }';

  // echo ''.$css.'';
}
add_action('admin_head', 'custom_admin_head');





/*-----------------------------------------------------------------------------------*/
/*  FEATURED IMAGE SUPPORT
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'post-thumbnails' );





/*-----------------------------------------------------------------------------------*/
/*  REMOVE WP EMOJI
/*-----------------------------------------------------------------------------------*/

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );



/*-----------------------------------------------------------------------------------*/
/*  REMOVE WP Editor
/*-----------------------------------------------------------------------------------*/

add_action('init', 'init_remove_support',100);
function init_remove_support(){
    $post_type = 'post';
    remove_post_type_support( $post_type, 'editor');
}


/*-----------------------------------------------------------------------------------*/
/*  RENAME DEFAULT POST TYPE
/*-----------------------------------------------------------------------------------*/

function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Projects';
    $submenu['edit.php'][5][0] = 'Projects';
    $submenu['edit.php'][10][0] = 'Add Projects';
    $submenu['edit.php'][16][0] = 'Projects Tags';
    echo '';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Projects';
    $labels->singular_name = 'Project';
    $labels->add_new = 'Add Project';
    $labels->add_new_item = 'Add Project';
    $labels->edit_item = 'Edit Project';
    $labels->new_item = 'Project';
    $labels->view_item = 'View Project';
    $labels->search_items = 'Search Project';
    $labels->not_found = 'No Projects found';
    $labels->not_found_in_trash = 'No Projects found in Trash';
    $labels->all_items = 'All Projects';
    $labels->menu_name = 'Projects';
    $labels->name_admin_bar = 'Projects';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );



/*-----------------------------------------------------------------------------------*/
/*  Get Attached Image
/*-----------------------------------------------------------------------------------*/


function pbb_get_attached_image($id, $size)
{
    $img = wp_prepare_attachment_for_js( get_post_thumbnail_id($id) );
    if(!empty($img) && !empty($img['sizes']))
    {
        if(!empty($img['sizes'][$size]))
        {
            $image = $img['sizes'][$size]['url'];
        }
        else if(!empty($img['sizes']['full']))
        {
            $image = $img['sizes']['full']['url'];
        }
        else if(!empty($img['sizes']['large']))
        {
            $image = $img['sizes']['large']['url'];
        }
        else if(!empty($img['sizes']['thumbnail']))
        {
            $image = $img['sizes']['thumbnail']['url'];
        }
        else if(!empty($img['sizes']['medium']))
        {
            $image = $img['sizes']['medium']['url'];
        }
    }
    else
    {
      $image = pbb_default_wine_pic();
    }

    return $image;
}



/*-----------------------------------------------------------------------------------*/
/*  Update 404 Title
/*-----------------------------------------------------------------------------------*/


function theme_slug_filter_wp_title( $title ) {
    if ( is_404() ) {
        $title = 'Whoops';
    }
    // You can do other filtering here, or
    // just return $title
    return $title;
}
// Hook into wp_title filter hook
add_filter( 'wp_title', 'theme_slug_filter_wp_title' );



/*-----------------------------------------------------------------------------------*/
/*  Extend Recent Posts Widget
/*-----------------------------------------------------------------------------------*/


Class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

    function widget($args, $instance) {
    
        extract( $args );
        
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
                
        if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 10;
                    
        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if( $r->have_posts() ) :
            
            echo $before_widget; ?>

            <?php if( $title ) echo $before_title . $title . $after_title; ?>

                <ul class="sidebar-separate-list">
                    <?php while( $r->have_posts() ) : $r->the_post(); ?>                
                    <li><span class="sidebar-post-date"><?php the_time( 'Y-m-d'); ?></span> <br /> <a class="gray" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a ></li>
                    <?php endwhile; ?>
                </ul>
                                    
            <?php
            echo $after_widget;
        
        wp_reset_postdata();
        
        endif;
    }
}
function my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');





/*-----------------------------------------------------------------------------------*/
/*  Register Sidebars
/*-----------------------------------------------------------------------------------*/


register_sidebar( array(
    'id'          => 'news-sidebar',
    'name'        => __( 'News Sidebar' ),
    'description' => __( 'PBB Sidebar for default archive page' )
) );




/*-----------------------------------------------------------------------------------*/
/*  Register Color Palette in WYSWYG Editor
/*-----------------------------------------------------------------------------------*/


function my_mce4_options($init) {

    $custom_colours = '
        "f9f7f7", "Light Gray",
        "4a4a4a", "Gray",
        "222222", "Black",
        "ffffff", "White",
        "193419", "Green",
        "2d8080", "Blue",
        "f4f8f8", "light Blue"
    ';



    // build colour grid default+custom colors
    $init['textcolor_map'] = '['.$custom_colours.']';

    // change the number of rows in the grid if the number of colors changes
    // 8 swatches per row
    $init['textcolor_rows'] = 4 ;

    return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');





/*-----------------------------------------------------------------------------------*/
/*  Apply styles to the visual editor
/*-----------------------------------------------------------------------------------*/


add_filter('mce_css', 'tuts_mcekit_editor_style');
function tuts_mcekit_editor_style($url) {
 
    if ( !empty($url) )
        $url .= ',';
 
    // Retrieves the plugin directory URL
    // Change the path here if using different directories
    $url .= trailingslashit( plugin_dir_url(__FILE__) ) . '/editor-styles.css';
 
    return $url;
}
 

/** Add "Styles" drop-down **/

add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );
 
function tuts_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
 


/** Add styles/classes to the "Styles" drop-down **/

add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
 
function tuts_mce_before_init( $settings ) {
 
    $style_formats = array(
        array(
            'title' => 'Dot Separator',
            'block' => 'div',
            'classes' => 'dot-separator',
            'wrapper' => true
        )
    );
 
    $settings['style_formats'] = json_encode( $style_formats );
 
    return $settings;
 
}
 
/* Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats */
 
/*
 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
 */
// add_action('wp_enqueue_scripts', 'tuts_mcekit_editor_enqueue');
 
/*
 * Enqueue stylesheet, if it exists.
 */
// function tuts_mcekit_editor_enqueue() {
//   $StyleUrl = get_site_url(null, '/wp-content/themes/3e/assets/css/style.css', 'http'); // Customstyle.css is relative to the current file
//   wp_enqueue_style( 'myCustomStyles', $StyleUrl );
// }



/*-----------------------------------------------------------------------------------*/
/*  Register Taxonomies
/*-----------------------------------------------------------------------------------*/


function create_taxonomies() {
    register_taxonomy('event-types', array('events'), array(
        'labels' => array(
            'name' => 'Category'
        ),
            'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => true,
        'rewrite' => array(
            'slug' => 'eventcat',
        ),
        'show_admin_column' => true,
        'query_var' => true
    ));
}
add_action('init', 'create_taxonomies');




/*-----------------------------------------------------------------------------------*/
/*  stop wp removing div tags
/*-----------------------------------------------------------------------------------*/


// stop wp removing div tags
function lovethemes_tinymce_fix( $init ) 
{
    // html elements being stripped
    $init['extended_valid_elements'] = 'div[*],article[*]';

    // don't remove line breaks
    $init['remove_linebreaks'] = false; 

    // convert newline characters to BR
    $init['convert_newlines_to_brs'] = true; 

    // don't remove redundant BR
    $init['remove_redundant_brs'] = false;

    // pass back to wordpress
    return $init;
}
add_filter('tiny_mce_before_init', 'lovethemes_tinymce_fix');


/*-----------------------------------------------------------------------------------*/
/*  Contact Form 7 Remove Wrapping Spans
/*-----------------------------------------------------------------------------------*/

add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});


/*-----------------------------------------------------------------------------------*/
/*  Custom Excerpt
/*-----------------------------------------------------------------------------------*/


function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);

      if (count($excerpt) >= $limit) {
          array_pop($excerpt);
          $excerpt = implode(" ", $excerpt) . '...';
      } else {
          $excerpt = implode(" ", $excerpt);
      }

      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

      return $excerpt;
}

function content($limit) {
    $content = explode(' ', get_the_content(), $limit);

    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(" ", $content) . '...';
    } else {
        $content = implode(" ", $content);
    }

    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content); 
    $content = str_replace(']]>', ']]&gt;', $content);

    return $content;
}



function rr_404_my_event() {
  global $post;
  if ( is_singular( 'event' ) && !rr_event_should_be_available( $post->ID ) ) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
  }
}
add_action( 'wp', 'rr_404_my_event' );


/*-----------------------------------------------------------------------------------*/
/*  Custom Event Sidebar
/*-----------------------------------------------------------------------------------*/

function events_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Events Sidebar', 'your-theme-domain' ),
            'id' => 'events-side-bar',
            'description' => __( 'Events Sidebar', 'your-theme-domain' ),
            'before_widget' => '<div class="widget-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'events_sidebar' );



/*-----------------------------------------------------------------------------------*/
/*  Custom Event Calendar Month Navigation
/*-----------------------------------------------------------------------------------*/

function tribe_events_the_mini_calendar_prev_link()
{
    $tribe_ecp = Tribe__Events__Main::instance();
    $args = tribe_events_get_mini_calendar_args();
    $html = '<a class="tribe-mini-calendar-nav-link prev-month" href="#" data-month="' . $tribe_ecp->previousMonth($args['eventDate']) . '-01" title="' . tribe_get_previous_month_text() . '"><span>&laquo;</span></a>';
    echo apply_filters('tribe_events_the_mini_calendar_prev_link', $html);
}


/*-----------------------------------------------------------------------------------*/
/*  Remove WP Editor From Post Types
/*-----------------------------------------------------------------------------------*/

add_action('init', 'my_remove_editor_from_post_type');
function my_remove_editor_from_post_type() {
    remove_post_type_support( 'page', 'editor' );
}



/*-----------------------------------------------------------------------------------*/
/*  Disable Big Images Threshold
/*-----------------------------------------------------------------------------------*/

add_filter( 'big_image_size_threshold', '__return_false' );



/*-----------------------------------------------------------------------------------*/
/*  Deregestir Scripts
/*-----------------------------------------------------------------------------------*/

function dequeue_scripts() {
    wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_enqueue_scripts', 'dequeue_scripts' );




/*-----------------------------------------------------------------------------------*/
/*  FUNCTIONS END
/*-----------------------------------------------------------------------------------*/

?>