<?php 
function trenza_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_image_size('home_news', 411, 180, true);
    add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
    
    register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'twentyfourteen' ),
	) );
    /*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
    add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
    
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_action( 'init', 'create_post_type' );
	function create_post_type() {
	    register_post_type( 'Stories',
	        array(
	            'labels' => array(
	                'name' => __( 'Stories' ),
	                'singular_name' => __( 'Custom_names' )
	            ),
	        'public' => true,
	        'has_archive' => true,
	        )
	    );
	}
}  
add_action( 'after_setup_theme', 'trenza_theme_setup' ); 

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function trenza_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'trenza' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'trenza' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'trenza' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'trenza' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'trenza' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'trenza' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'trenza_theme_widgets_init' );

function trenza_theme_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'trenza_theme_body_classes' );


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function trenza_theme_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'trenza_theme_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function trenza_theme_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'trenza_theme_post_thumbnail_sizes_attr', 10 , 3 );

require get_template_directory() . '/inc/customizer.php';

if ( ! function_exists( 'threza_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Twenty Sixteen 1.2
 */
function threza_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;
 
function save_product(){

    if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) ) {
    if ($_POST['action'] == "new_post" || $_POST['action'] == "update_post") {
    # Do some minor form validation to make sure there is content 
    if ($_POST['action'] == "new_post"){
    	echo $edit = 0;
    }

    if ($_POST['action'] == "update_post"){
    	echo $edit = 1;
    	$id = $_POST['post_id'];
    }


    if (isset ($_POST['p-type'])) {
        $p_type =  $_POST['p-type'];
    } 
    if (isset ($_POST['s-name'])) {
        $s_name =  $_POST['s-name'];
    }
    if (isset ($_POST['thc-csb'])) {
        $thc_csb =  $_POST['thc-csb'];
    }
    else {
       
    }
    if (isset ($_POST['indoor-outdoor'])) {
        $indoor_outdoor = $_POST['indoor-outdoor'];
    } else {
        
    }

    if (isset ($_POST['indica-sativa'])) {
        $indica_sativa =  $_POST['indica-sativa'];
    }
    else {
       
    }

    if ( !empty( $_POST['upload-image-id'] ) ) {
		   echo $image_id = $_POST['upload-image-id'];
	    }

    if ( !empty( $_POST['upload-test-id'] ) ) {
	    	$test_id = $_POST['upload-test-id'];
		}

    if (isset ($_POST['price-per-unit'])) {
        	$price_per_unit =  $_POST['price-per-unit'];
    }
    else {
       
    }
    if (isset ($_POST['ammount-of-units'])) {
        	$ammount_of_units =  $_POST['ammount-of-units'];
    }
    else {
       
    }

    /*$new_post = array(
    'post_title'               => $p_type,
    'status'             => true,
    'post_status'   => 'publish',           
    'post_type' => 'product',
    'catalog_visibility' => 'visible',
    'price'              => $price_per_unit,
    'regular_price'      => $price_per_unit,
    'sale_price'         => '',
    'manage_stock'       => true,
    'stock_quantity'     => $ammount_of_units,
    'stock_status'       => 'instock',
    /*
    'backorders'         => 'no',
    'downloadable'       => false,
    'downloads'          => array(),
    
    'image_id'           => '',
    'gallery_image_ids'  => array(),
);*/

	
    //save the new post
    if ($edit == 0) {
    	echo 'add';
    	$post = array(
        'post_title'    => $s_name,
        'post_content'  => '',
        'post_status'   => 'publish',           // Choose: publish,Pending, preview, future, draft, etc.
        'post_type' => 'product'  //'post',page' or use a custom post type if you want to
    	);
    	$pid = wp_insert_post($post); 
	}else if($edit == 1){
		echo 'update'.$id;
		$post = array(
			'ID' =>$id,
        'post_title'    => $s_name,
        'post_content'  => '',
        'post_status'   => 'publish',           // Choose: publish,Pending, preview, future, draft, etc.
        'post_type' => 'product'  //'post',page' or use a custom post type if you want to
    	);
		$pid = wp_update_post($post); 
	}

    update_post_meta( $pid, '_manage_stock', 'yes' );
    update_post_meta( $pid, '_stock', $ammount_of_units );
    update_post_meta( $pid, '_price', $price_per_unit );
    update_post_meta( $pid, '_regular_price', $price_per_unit );
    update_post_meta( $pid,'_thumbnail_id', $image_id );
    if ($edit == 0) {
    	if ($pid) {
    	add_post_meta($pid, 'Product_Type', $p_type);
	    add_post_meta($pid, 'Strait_Name', $s_name);
	    add_post_meta($pid, 'THC_CBD',$thc_csb);
	    add_post_meta($pid, 'I_O_GH',$indoor_outdoor);
	    add_post_meta($pid, 'I_S_H',$indica_sativa);
	    add_post_meta($pid, 'Test',$test_id);
	    add_post_meta($pid, 'Amount_Of_Units',$ammount_of_units);
	     echo 'Thank you for sharing your story.';
    }
    }else if($edit == 1){
    	if ($pid) {
    	update_post_meta($pid, 'Product_Type', $p_type);
	    update_post_meta($pid, 'Strait_Name', $s_name);
	    update_post_meta($pid, 'THC_CBD',$thc_csb);
	    update_post_meta($pid, 'I_O_GH',$indoor_outdoor);
	    update_post_meta($pid, 'I_S_H',$indica_sativa);
	    update_post_meta($pid, 'Test',$test_id);
	    update_post_meta($pid, 'Amount_Of_Units',$ammount_of_units);
	     echo 'Thank you for sharing your story.';
    }
    }
    
    die();
    //insert taxonomies
    }
}

     if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "delete") {
     	echo $post_id = $_POST['post_id'];
     	echo 'delete';
     	$delete = wp_delete_post($post_id,true);
     	if($delete){
     		echo 'successfully deleted.';
     	}
     }
     global $edit;

     
   
}

add_action( 'after_setup_theme', 'save_product' );

function enqueue_media_uploader()
{
    //this function enqueues all scripts required for media uploader to work
    wp_enqueue_media();
}

add_action("wp_enqueue_scripts", "enqueue_media_uploader");

?>