<?php 

/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework is in a parent theme or child theme */

	define('OF_FILEPATH', TEMPLATEPATH);
	define('OF_DIRECTORY', get_template_directory_uri());


/* These files build out the options interface.  Likely won't need to edit these. */

require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
require_once (OF_FILEPATH . '/admin/theme-functions.php'); 	// Theme actions based on options settings

/*-----------------------------------------------------------------------------------*/
/* Add Theme Shortcodes
/*-----------------------------------------------------------------------------------*/
include("functions/shortcodes.php");


/*-----------------------------------------------------------------------------------*/
/* Add Multiple Thumbnail Support
/*-----------------------------------------------------------------------------------*/
include("multi-post-thumbnails.php");


/*-----------------------------------------------------------------------------------*/
/* Register Widget Sidebars
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	
		register_sidebar(array(
		'name' => 'Portfolio Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
		register_sidebar(array(
		'name' => 'Contact Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
		
	register_sidebar(array( //Footer
		'name' => 'Footer Left',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array( //Footer
		'name' => 'Footer Left Center',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array( //Footer
		'name' => 'Footer Right Center',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array( //Footer
		'name' => 'Footer Right',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array( //Homepage
		'name' => 'Homepage',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array( //Header Minc
		'name' => 'Header Minc',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
}

/*-----------------------------------------------------------------------------------*/
/*	Add Widget Shortcode Support
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

// Add the Project Thumbnail Custom Widget
include("functions/widget-project.php");
// Add the Project Thumbnail Custom Widget
include("functions/widget-recent-projects.php");
// Add the News Custom Widget
include("functions/widget-news.php");
// Add the Contact Custom Widget
include("functions/widget-contact.php");
// Add the Custom Fields for Video Posts
include("functions/customfields.php");

/*-----------------------------------------------------------------------------------*/
/*	Register and load common JS
/*-----------------------------------------------------------------------------------*/

function ag_register_js() {
	if (!is_admin()) {
		// register scripts
		wp_register_script('modernizer', get_template_directory_uri() . '/js/modernizr-transitions.js', 'jquery');
		wp_register_script('scrollto', get_template_directory_uri() . '/js/jquery.scrollTo-min.js', 'jquery');
		wp_register_script('validation', get_template_directory_uri() . '/js/jquery.validate.min.js', 'jquery');
		wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery');
		wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 'jquery');
		wp_register_script('easing', get_template_directory_uri() . '/js/jquery.easing.js', 'jquery');
		wp_register_script('tabs', get_template_directory_uri().'/js/tabs.js', 'jquery');
		wp_register_script('flex', get_template_directory_uri() . '/js/jquery.flexslider-min.js', 'jquery');
		wp_register_script('fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery');
		wp_register_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', 'jquery');
		wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', 'jquery', '1.5.25');
		wp_register_script('infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', 'jquery', '2.0b2.120519');
		wp_register_script('custom', get_template_directory_uri() . '/js/custom.js', 'jquery', '1.4', true);
		wp_register_script('orbit', get_template_directory_uri() . '/js/jquery.orbit.js', 'jquery');

		// Localize the ajax script
		$variables_array = array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ), 
			'get_template_directory_uri' => get_template_directory_uri(),
			'nonce' => wp_create_nonce('ajax-nonce') 
		);
		wp_localize_script('jquery', 'twAjax', $variables_array);
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizer');
		wp_enqueue_script('scrollto');
		wp_enqueue_script('superfish'); 
		wp_enqueue_script('easing'); 
		wp_enqueue_script('prettyPhoto');
     	wp_enqueue_script('validation'); 
		wp_enqueue_script('flex');
		wp_enqueue_script('bxslider');
	    wp_enqueue_script('tabs');
		wp_enqueue_script('fitvid');
		wp_enqueue_script('isotope');
		wp_enqueue_script('infinitescroll');
		wp_enqueue_script('custom');
		wp_enqueue_script('orbit');
	}
}
add_action('init', 'ag_register_js');

/*-----------------------------------------------------------------------------------*/
/*	Stylesheets
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'tw_register_theme_styles' ) ) :
	function tw_register_theme_styles() {
		if (!is_admin()) {

			global $wp_styles;

			$custom_css = themewich_custom_styles();
			$customcss = get_option('of_custom_css');
			$themeskin = get_option('of_theme_skin');

			// Load skin first to prevent flashing
			if ($themeskin && $themeskin == 'Dark') { 
				wp_enqueue_style( 'darkskin', get_template_directory_uri() . '/css/dark.css');
			} else {
				wp_enqueue_style( 'lightskin', get_template_directory_uri() . '/css/light.css');
			}
			
			wp_enqueue_style( 'style', get_stylesheet_uri() );
			wp_enqueue_style( 'skeleton', get_template_directory_uri() . '/css/skeleton.css');
			wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css');
			wp_enqueue_style(  "ie7",  get_template_directory_uri() . "/css/ie7.css", false, 'ie7', "all");
			wp_enqueue_style(  "ie8",  get_template_directory_uri() . "/css/ie8.css", false, 'ie8', "all");
			wp_enqueue_style( 'orbit', get_template_directory_uri() . '/css/orbit.css');
			$wp_styles->add_data( "ie7", 'conditional', 'IE 7' );
			$wp_styles->add_data( "ie8", 'conditional', 'IE 8' );

			// Add inline styles
			if ( wp_style_is( 'animate', 'enqueued' ) ) {
				wp_add_inline_style( 'animate', $custom_css );
				if ($customcss) { wp_add_inline_style( 'animate', '/* Custom CSS */ ' . $customcss); }
			} else if ( wp_style_is( 'skeleton', 'enqueued' ) ) {
				wp_add_inline_style( 'skeleton', $custom_css );
				if ($customcss) { wp_add_inline_style( 'skeleton', '/* Custom CSS */ ' . $customcss); }
			} else {
				wp_add_inline_style( 'style', $custom_css );
				if ($customcss) { wp_add_inline_style( 'style', '/* Custom CSS */ ' . $customcss); }
			}

		}
	}
	add_action('wp_enqueue_scripts', 'tw_register_theme_styles');
endif;

if ( ! function_exists( 'themewich_custom_styles' ) ) :
function themewich_custom_styles() {

	$styles = "/* Custom Styles */"; // initialize output


/***************Top Margin *******************/
$styles .= '.nav { '; 
	// Get padding
	if ( $contentpadding = get_option('of_content_padding') ) { 
		$styles .=  'padding-top:'.$contentpadding.'px;'; 
	} else { 
		$styles .=  'padding-top:10px;';
	} 
$styles .= '
}

.logo h1,
.logo h2 {';
	// Get padding
	if ( $logopadding = get_option('of_logo_padding') ) { 
		$styles .=  'padding-top:'.$logopadding.'px;'; 
	} else { 
		$styles .=  'padding-top:55px;';
	} 
$styles .= '	
}

.sf-menu a {';
	// Get padding
	if ( $navpadding = get_option('of_navbottom_padding') ) { 
		$styles .=  'padding-bottom:'.$navpadding.'px;'; 
	} else { 
		$styles .=  'padding-bottom:32px;';
	} 
$styles .= '
}

/*******************BG Image*******************/ 
.sitecontainer { ';
	if ( $backgroundimage = get_option('of_background_image') ) {  
		$styles .=  'background-image:url('.$backgroundimage.');';  
	} else { 
		if ($backgroundtexture = get_option('of_texture_bg') ) { 
			if($backgroundtexture != 'none') { 
				$styles .=  'background-image:url('.$backgroundtexture.');'; 
			} 
		} 
	} 
$styles .= '
    background-repeat:repeat; 
    background-position:center top; 
}

/****************Button Colors***********************/

.button:hover, 
a.button:hover, 
a.more-link:hover, 
#footer .button:hover, 
#footer a.button:hover, 
#footer a.more-link:hover, 
.cancel-reply p a:hover {';	   
	// Get Button Color
	if ( $buttonhover = get_option('of_button_hover_color') ) { 
		$styles .=  'background:'.$buttonhover.'!important;'; 
	}
$styles .= '
color:#fff;
}

.button, a.button, a.more-link, #footer .button, #footer a.button, #footer a.more-link, .cancel-reply p a {';
	// Get Button Color
	if ( $buttoncolor = get_option('of_button_color') ) { 
		$styles .=  'background:'.$buttoncolor.';'; 
	}
$styles .= '
color:#fff;
}

/****************Link Colors***********************/
p a, a {';
	// Get Link Color
	if ( $linkcolor = get_option('of_link_color') ) { 
		$styles .=  'color:'.$linkcolor.';'; 
	} 
$styles .= '
}

h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, p a:hover, 
#footer h1 a:hover, #footer h2 a:hover, #footer h3 a:hover, #footer h3 a:hover, 
#footer h4 a:hover, #footer h5 a:hover, a:hover, #footer a:hover, 
.blogpost h2 a:hover, .blogpost .smalldetails a:hover {';
	// Get Link Hover Color
	if ( $linkhover = get_option('of_link_hover_color') ) { 
		$styles .=  'color:'.$linkhover.';'; 
	} 
$styles .= '
}

/****************Selection Colors***********************/
::-moz-selection {';
	// Get heading font choices
	if ( $linkhover = get_option('of_link_hover_color') ) { 
		$styles .=  'background:'.$linkhover.'; color:#fff;'; 
	} 
$styles .= '
}

::selection {';
	// Get heading font choices
	if ( $linkhover = get_option('of_link_hover_color') ) { 
		$styles .=  'background:'.$linkhover.'; color:#fff;'; 
	} 
$styles .= '
}

::selection {';
	// Get heading font choices
	if ( $linkhover = get_option('of_link_hover_color') ) { 
		$styles .=  'background:'.$linkhover.'; color:#fff;'; 
	} 
$styles .= '
}

.recent-project:hover {';
	// Get heading font choices
	if ( $linkhover = get_option('of_link_hover_color') ) { 
		$styles .=  'border-color:'.$linkhover.' !important;'; 
	} 
$styles .= '	
}
/***************Typographic User Values *********************************/

h1, h2, h1 a, h2 a, .blogpost h2 a, h3, .ag_projects_widget h3, h3 a, .aj_projects_widget h3 a {';
	// Get heading font choices
	if ( $headingfont = get_option('of_heading_font') ) { 
		$styles .=  'font-family:"'.$headingfont.'", arial, sans-serif;'; 
	} 
$styles .= '
}

h5, h5 a, .widget h3, .widget h2, .widget h4  {';
	// Get tiny font option
	if ( $tinyfont = get_option('of_tiny_font') ) { 
		$styles .=  'font-family:"'.$tinyfont.'", arial, sans-serif;;'; 
	} 
$styles .= '
}

h4, h4 a, .footer .note h4, .footer h4.subheadline, .newspost h4  {';
	// Get subfont option
	if ($secondaryfont = get_option('of_secondary_font') ) { 
		$styles .=  'font-family:"'.$secondaryfont.'", arial, sans-serif;;'; 
	} 
$styles .= '
}

body, input, p, ul, ol, .button, .ui-tabs-vertical .ui-tabs-nav li a span.text,
.footer p, .footer ul, .footer ol, .footer.button, .credits p,
.credits ul, .credits ol, .credits.button, .footer textarea, .footer input, .testimonial p, 
.contactsubmit label, .contactsubmit input[type=text], .contactsubmit textarea {';
	// Get paragraph option
	if ($pfont = get_option('of_p_font')) { 
		$styles .=  'font-family:"'.$pfont.'", arial, sans-serif;'; 
	} 
$styles .= '}';

if ($thumbhover = get_option('of_thumb_hover')) { 
	if($thumbhover == 'Title') { 
		$styles .= '   
		.portfolioitem.darkbg {
			background:#f37021 url("' . get_template_directory_uri() . '/images/zoom.png") 95% 95% no-repeat;
		}';
	}
} 

if ($padding = get_option('of_thumb_padding')) { 
	if($padding == 'On') { 
		$styles .= '
		.container .three.columns.nopadding {
			width: 188px;
			padding: 0;
			margin: 2px;
		}

		@media only screen and (min-width: 768px) and (max-width: 959px) {
			.container .three.columns.nopadding { 
				width: 148px;  
				margin:2px; 
			}
		}


		@media only screen and (max-width: 767px) {
			.container .three.columns.nopadding { 
				width: 146px; 
				margin:2px;
			}
		}

		@media only screen and (min-width: 480px) and (max-width: 767px) {
			.container .three.columns.nopadding {
				width: 204px; 
				margin:2px;
				margin-bottom: 6px; 
			}
			.slideshowcontainer {
			    margin-left:8px;
			}
			.slideshowcontainer .container {
			    width:428px;
			}
		}
		/* Mobile Portrait Size to Mobile Landscape Size (devices and browsers) */
		@media only screen and (max-width: 479px) {
			ul.filter li {
				width: 137px;
			}
		}';
	} else {
	$styles .= '
		@media only screen and (max-width: 959px) and (min-width: 768px) {
		    .container.slideshow {
		        width:760px;
		    }
		}
		@media only screen and (max-width: 767px) and (min-width: 480px) {

		}';
    
	} 
}

	return $styles;
}
endif;

/*-----------------------------------------------------------------------------------*/
/* Register Navigation 
/*-----------------------------------------------------------------------------------*/

add_theme_support('menus');

if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
          'top_nav_menu' => 'Main Navigation Menu'
        )
    );
	
// remove menu container div
function my_wp_nav_menu_args( $args = '' )
{
    $args['container'] = false;
    return $args;
} // function
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
}

/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length
/*-----------------------------------------------------------------------------------*/

function ag_excerpt_length($length) {
return 15; }
add_filter('excerpt_length', 'ag_excerpt_length');

/*-----------------------------------------------------------------------------------*/
/*	Set Max Content Width (use in conjuction with ".blogpost .featuredimage img" css)
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) ) $content_width = 640;

/*-----------------------------------------------------------------------------------*/
/*	Automatic Feed Links
/*-----------------------------------------------------------------------------------*/

if(function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');
    //WP Auto Feed Links
}

/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

function ag_excerpt_more($excerpt) {
return str_replace('[...]', '...', $excerpt); }
add_filter('wp_trim_excerpt', 'ag_excerpt_more');

/*------------------------------------------------------------------------------*/
/*	Remove More Link Anchor
/*------------------------------------------------------------------------------*/

function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}

add_filter('the_content_more_link', 'remove_more_jump_link');


/*------------------------------------------------------------------------------*/
/*	Get Attachement ID from URL function
/*------------------------------------------------------------------------------*/

function get_attachment_id( $url ) {

    $dir = wp_upload_dir();
    $dir = trailingslashit($dir['baseurl']);

    if( false === strpos( $url, $dir ) )
        return false;

    $file = basename($url);

    $query = array(
        'post_type' => 'attachment',
        'fields' => 'ids',
        'meta_query' => array(
            array(
                'value' => $file,
                'compare' => 'LIKE',
            )
        )
    );

    $query['meta_query'][0]['key'] = '_wp_attached_file';
    $ids = get_posts( $query );

    foreach( $ids as $id )
        if( $url == array_shift( wp_get_attachment_image_src($id, 'full') ) )
            return $id;

    $query['meta_query'][0]['key'] = '_wp_attachment_metadata';
    $ids = get_posts( $query );

    foreach( $ids as $id ) {

        $meta = wp_get_attachment_metadata($id);

        foreach( $meta['sizes'] as $size => $values )
            if( $values['file'] == $file && $url == array_shift( wp_get_attachment_image_src($id, $size) ) ) {
				if(isset($id->attachment_size)){
                $id->attachment_size = $size;
				}
                return $id;
            }
    }

    return false;
}

/*-----------------------------------------------------------------------------------*/
/*	Add Browser Detection Body Class
/*-----------------------------------------------------------------------------------*/

add_filter('body_class','ag_browser_body_class');
function ag_browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	// autoplay option
	if (get_option('of_autoplay') == 'true') {
		$classes[] = 'mini-slideshows';
	}

	if($is_iphone) $classes[] = 'iphone';
	return $classes;

}

if ( ! function_exists('themewich_options_body_class') ) {
	function themewich_options_body_class($classes) {
		// mini-slideshow autoplay
    	$classes[] = get_option('of_autoplay') == 'true' ? 'mini-slideshows' : '';
    	$classes[] = get_option('of_slideshow_state') == 'Open' ? 'slideshow-open' : '';

		return $classes;
	}
	add_filter('body_class','themewich_options_body_class');
}

if ( ! function_exists( 'themewich_featured_output' ) ) :
	/**
	* Controls featured output for the page
	* @param int $id Post ID
	* @since Edition 1.4
	*/
	function themewich_featured_output($post){
		$video_url = get_post_meta($post->ID, 'ag_video_url', true);	
		$popup = get_option('of_slideshow_popup');
		$output = '';

		/**
		 * If there's something in the video URL box
		 */
		if ($video_url != '') { // if there's something in the video URL box
			$output .= '<div class="videocontainer">';
	    		if (filter_var($video_url, FILTER_VALIDATE_URL) === FALSE) {
				    $output .= do_shortcode( $video_url ); // do shortcode if something else is entered
				} else {
					$output .= apply_filters('the_content', $video_url); // run the content filter for the video url
				}
			$output .= '</div>';

		/**
		 * If it's just a regular slideshow
		 */
		} else {
			$crop 	= get_option('of_slide_crop');
			$popup 	= get_option('of_slideshow_popup');
			$autoplay = get_option('of_portfolio_autoplay');
			$autoplay_delay = get_option('of_project_autoplay_delay');

			if ( $thumbnum = get_option('of_thumbnail_number') ) { 
				$thumbnum = ($thumbnum + 1); 
			} else { 
				$thumbnum = 7;
			}

			if ($crop == 'No Crop') {
				$images = get_portfolio_info('portfoliolargenc', $post->ID, $thumbnum);
			} else {
				$images = get_portfolio_info('portfoliolarge', $post->ID, $thumbnum);
			}

			$output .= '<div class="info" ';

			if ($autoplay) {
				$output .= 'data-autoplay="' . $autoplay . '" ';
			}

			if ($autoplay_delay) {
				$output .= 'data-autoplay-delay="' . $autoplay_delay . '"';
			}

			$output .= '>';

			$output .= '<div class="themewich-slider projectslideshow"><span>';

			if ( get_option('of_slideshow_popup') == 'On' ) { 
				$output .= '<a href="' . $images['full'][0] . '" rel="prettyPhoto[pp_gal_' . $post->ID .']" title="';

				if ($images['alt']) { 
					$output .= str_replace('"', "", $images['alt']);  
				} else { 
					$output .= htmlspecialchars(get_the_title()); 
				}

				$output .= '">'; 
			}

			$output .= '<img src="' . $images['thumb'][0] . '" alt="';

			if ($images['alt']) { 
				$output .= str_replace('"', "", $images['alt']); 
			} else { 
				$output .= htmlspecialchars(get_the_title()); 
			}

			$output .= '" title="';

			if ($images['alt']) { 
				$output .= str_replace('"', "", $images['alt']); 
			} else { 
				$output .= htmlspecialchars(get_the_title()); 
			} 

			$output .= '" class="scale-with-grid"/>';

			if ($popup == 'On') { 
				$output .= '</a>';
			}

			$output .= '</span>';
								
			$counter = 2;
								
			while ( $counter < ($thumbnum) ) :
			
				if ( $images['thumb_' . $counter] ) : 
					$output .= '<span>';

					if ($popup == 'On') { 
						$output .= '<a href="' . $images['full_' . $counter][0] . '" rel="prettyPhoto[pp_gal_' . $post->ID .']" title="';

						if ($images['alt_' . $counter]) { 
							$output .= str_replace('"', "", $images['alt_' . $counter]); 
						} else { 
							$output .= htmlspecialchars(get_the_title()); 
						} 

						$output .= '">';
					}

					$output .= '<img src="' . $images['thumb_' . $counter][0] .'" alt="';

					if ($images['alt_' . $counter]) { 
						$output .= str_replace('"', "", $images['alt_' . $counter]); 
					} else { 
						$output .= htmlspecialchars(get_the_title()); 
					} 

					$output .= '" title="';

					if ($images['alt_' . $counter]) { 
						$output .= str_replace('"', "", $images['alt_' . $counter]); 
					} else { 
						$output .= htmlspecialchars(get_the_title()); 
					} 

					$output .= '" class="scale-with-grid"/>';

					if ($popup == 'On') { 
						$output .= '</a>';
					}
					$output .= '</span>';

				endif; $counter++;
				
			endwhile; 
		  
			$output .= '</div></div>';

		}

		return $output;
	}
endif;

if ( ! function_exists( 'themewich_load_home_post' ) ) :
	/**
	* Controls homepage ajax
	* @param int $id Post ID
	* @since Edition 1.4
	*/
	function themewich_load_home_post($id){
			// get the category ID we need to load from
			$postID      = $_POST['postID'];

			// get only the one portfolio post
			$args = array(
				'p' => $postID, 
				'post_type' => 'portfolio'
			);
			$the_query = new WP_Query($args);

			// start the loop
			if ( $the_query->have_posts() ) : 
				while ( $the_query->have_posts() ) :
					$the_query->the_post();

					// set up post classes string
					$postclasses = get_post_class(NULL, $postID); // get post classes
					$post_class_string = '';
					foreach ($postclasses as $key => $postclass) {
		    			$post_class_string .= ' ' . $postclass;
		    		}

		    		// set up content string
		    		global $more; $more = 0;
		            $content = apply_filters( 'the_content', get_the_content( __('<!--:es-->Leia maisE<!--:--><!--:pb-->Leia mais<!--:-->...', 'framework') ) );
					$content = str_replace( ']]>', ']]&gt;', $content );

					// Let's do all our templating here to make it editable by child themes
					$arr['output'] = 
						'<div class="ajaxinner">
		 					<a href="#" class="portfolio-close">Close</a> 
		 					<a id="next-port" href="#">Next</a> 
		 					<a id="prev-port" href="#">Previous</a> 
							<div class="clear"></div>

							<div class="eleven columns ajaxslider alpha">';

					// get featured output
					$arr['output'] .= themewich_featured_output($the_query->post); 

					$arr['output'] .= 
							'</div>';

					$arr['output'].= 
							'<div class="five columns ajaxcontent">
		    					<div class="' . $post_class_string . '" id="door-' . $postID . '">
				          			<span class="darkbubble left">
								        <h3 class="entry-title">
								            <a href="' . get_permalink() . '">' . get_the_title() . '</a>
								        </h3>
				                	</span>';

				    // Entry details          
		            $arr['output'] .= get_the_term_list( $postID, 'sort', '<p class="entry-details"><strong>' . __('In ', 'framework'), ', ', '</strong></p>' ); 

		            $arr['output'] .= '
				        			<div class="entry-content">' . $content . '</div>
					        		<!--END .hentry-->
					    		</div>
							</div>
						</div>
					<div class="clear"></div>';
				endwhile;
			endif;
			
			// then output in json format
			header("Content-Type: application/json");
			echo json_encode($arr);
			exit;
	}

	// Add our own handlers for the ajax request
	add_action('wp_ajax_nopriv_themewich_load_home_post', 'themewich_load_home_post');
	add_action('wp_ajax_themewich_load_home_post', 'themewich_load_home_post');

endif;

/*-----------------------------------------------------------------------------------*/
/*	Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 56, 56, true ); // Normal post thumbnails
	add_image_size( 'large', 960, '', true ); // Large thumbnails
	add_image_size( 'slider', 960, 400, true ); // Large thumbnails
	add_image_size( 'medium', 460, '310', true ); // Medium thumbnails
	add_image_size( 'small', 125, '', true ); // Small thumbnails
	add_image_size( 'blog', 529, 270, true ); // Blog thumbnail
	add_image_size( 'portfoliowidget', 56, 56, true ); // Portfolio widget thumbnail
	add_image_size( 'portfoliosmall', 301, 251, true ); // Portfolio Small thumbnail
	add_image_size( 'blogsmall', 420, 246, true ); // Portfolio Small thumbnail
	add_image_size( 'portfoliolarge', 529, 350, true ); // Portfolio Large thumbnail
	add_image_size( 'portfoliolargenc', 529, '', true ); // Portfolio Large thumbnail without crop
}

if (class_exists('MultiPostThumbnails')) { 

   if ( $thumbnum = get_option('of_thumbnail_number') ) { $thumbnum = ($thumbnum + 1); } else { $thumbnum = 7;}
   $counter1 = 2;

	while ($counter1 < ($thumbnum)) {
				
		if ($counter1 == 2) { $countername = 'second';
		} else
		if ($counter1 == 3) { $countername = 'third'; 
		} else
		if ($counter1 == 4) { $countername = 'fourth';
		} else
		if ($counter1 == 5) { $countername = 'fifth';
		} else
		if ($counter1 == 6) { $countername = 'sixth';
		} else {
		$countername = $counter1;	
		}
		
	new MultiPostThumbnails( 
		array( 
			'label' => 'Slide ' . $counter1, 
			'id' => $countername . '-slide', 
			'post_type' => 'portfolio' 
		));
	
	$counter1++;
	
	}
}



add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
	
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {

 if ( is_page_template('template-home.php') ) {
        $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    }
    return $html;
} 
/*
Check to see if the function exists
*/

if(function_exists('add_theme_support')) {
    /** Exists! So add the post-thumbnail */
    add_theme_support('post-thumbnails');
 
    /** Now Set some image sizes */
 
    /** #1 for our featured content slider */
    add_image_size( $name = 'itg_featured', $width = 500, $height = 300, $crop = true );
 
    /** #2 for post thumbnail */
    add_image_size( 'itg_post', 250, 250, true );
 
    /** #3 for widget thumbnail */
    add_image_size( 'itg_widget', 40, 40, true );
 
    /** Set default post thumbnail size */
    set_post_thumbnail_size($width = 50, $height = 50, $crop = true);
}

add_filter("manage_upload_columns", 'upload_columns');
add_action("manage_media_custom_column", 'media_custom_columns', 0, 2);

function upload_columns($columns) {

	unset($columns['parent']);
	$columns['better_parent'] = "Parent";

	return $columns;

}
 function media_custom_columns($column_name, $id) {

	$post = get_post($id);

	if($column_name != 'better_parent')
		return;

		if ( $post->post_parent > 0 ) {
			if ( get_post($post->post_parent) ) {
				$title =_draft_or_post_title($post->post_parent);
			}
			?>
			<strong><a href="<?php echo get_edit_post_link( $post->post_parent ); ?>"><?php echo $title ?></a></strong>, <?php echo get_the_time(__('Y/m/d', 'framework')); ?>
			<br />
			<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('<!--:es-->ReanexarE<!--:--><!--:pb-->Reanexar<!--:-->', 'framework'); ?></a>

			<?php
		} else {
			?>
			<?php _e('<!--:es-->(IndependenteE)<!--:--><!--:pb-->(Independente)<!--:-->', 'framework'); ?><br />
			<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('<!--:es-->AnexarE<!--:--><!--:pb-->Anexar<!--:-->', 'framework'); ?></a>
			<?php
		}

}


function mytheme_enqueue_comment_reply() {
    // on single blog post pages with comments open and threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
        // enqueue the javascript that performs in-link comment reply fanciness
        wp_enqueue_script( 'comment-reply' ); 
    }
}
// Hook into wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_comment_reply' );

/*------------------------------------------------------------------------------*/
/*	Comments Template
/*------------------------------------------------------------------------------*/

function ag_comment($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div id="comment-<?php comment_ID(); ?>" class="singlecomment">
      <p class="commentsmetadata"><cite>
            <?php comment_date('F j, Y'); ?>
            </cite></p>
    <div class="author">
            <div class="reply"><?php echo comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth'])); ?></div>
 
            <div class="name"><?php comment_author_link() ?></div>
        </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <p class="moderation"><?php _e('<!--:es-->Seu comentário está aguardando moderaçãoE<!--:--><!--:pb-->Seu comentário está aguardando moderação<!--:-->', 'framework') ?></p>
     
      <?php endif; ?>
      
        <div class="commenttext">
            <?php comment_text() ?>
        </div>
</div>
<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Add Custom Portfolio Post Type
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'create_portfolio_post_types' );

function create_portfolio_post_types() {
	register_post_type( 'portfolio',
		array(
			  'labels' => array(
			  'name' => __( 'Portfolio', 'framework'),
			  'singular_name' => __( 'Portfolio Item', 'framework'),
			  'add_new' => __( 'Add New', 'framework' ),
		   	  'add_new_item' => __( 'Add New Portfolio Item', 'framework'),
			  'edit' => __( 'Edit', 'framework' ),
	  		  'edit_item' => __( 'Edit Portfolio Item', 'framework'),
	          'new_item' => __( 'New Portfolio Item', 'framework'),
			  'view' => __( 'View Portfolio', 'framework'),
			  'view_item' => __( 'View Portfolio Item', 'framework'),
			  'search_items' => __( 'Search Portfolio Items', 'framework'),
	  		  'not_found' => __( 'No Portfolios found', 'framework'),
	  		  'not_found_in_trash' => __( 'No Portfolio Items found in Trash', 'framework'),
			  'parent' => __( 'Parent Portfolio', 'framework'),
			),
			'menu_icon' => 'dashicons-portfolio',
			'public' => true,
			'rewrite' => array( 'slug' => 'portfolio'), //  Change this to change the url of your "portfolio".
			'supports' => array( 
				'title', 
				'editor',  
				'thumbnail',
				'comments'),
		)
	);
}


//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'ag_create_taxonomies', 0 );

//create two taxonomies, genres and writers for the post type "book"
function ag_create_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Sort', 'taxonomy general name', 'framework'),
    'singular_name' => _x( 'Skill', 'taxonomy singular name', 'framework'),
    'search_items' =>  __( 'Search Skills', 'framework'),
    'all_items' => __( 'All Skills', 'framework'),
    'parent_item' => __( 'Parent Skill', 'framework'),
    'parent_item_colon' => __( 'Parent Skill:', 'framework'),
    'edit_item' => __( 'Edit Skill', 'framework'), 
    'update_item' => __( 'Update Skill', 'framework'),
    'add_new_item' => __( 'Add New Skill', 'framework'),
    'new_item_name' => __( 'New Skill Name', 'framework'),
    'menu_name' => __( 'Skills', 'framework'),
  ); 	

  register_taxonomy('sort',array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true, 
    'rewrite' => array( 'slug' => 'sort'), //  Change this to change the url of "sort".
  ));

}

function get_portfolio_info ($image_size='portfoliolarge', $id, $thumbnum) {
	
	    $counter = 2; //start counter at 2

		$images['full'] = get_post_meta($id,'_thumbnail_id',false); // Get Image ID 
		$images['alt'] 	= get_post_meta($images['full'], '_wp_attachment_image_alt', true); // Alt text of image
		$images['full'] = wp_get_attachment_image_src($images['full'][0], 'portfoliolarge', false);  // URL of Featured Full Image

		$images['thumb'] = get_post_meta($id,'_thumbnail_id',false); 

		$images['thumb'] = wp_get_attachment_image_src($images['thumb'][0], $image_size, false);  // URL of Featured first 
			  	
			while ($counter < ($thumbnum)) {

					switch ($counter) {
						case 2 :
							$countername = 'second';
							break;
						case 3 :
							$countername = 'third'; 
							break;
						case 4 :
							$countername = 'fourth'; 
							break;
						case 5 :
							$countername = 'fifth'; 
							break;
						case 6 :
							$countername = 'sixth'; 
							break;	
						default :
							$countername = $counter;					
					}
				
				
				$images["full_" . $counter] = MultiPostThumbnails::get_post_thumbnail_id('portfolio', $countername . '-slide', $id); // Get Image ID
				$images["alt_" . $counter] = get_post_meta($images["full_" . $counter] , '_wp_attachment_image_alt', true); // Alt text of image			 
				$images["full_" . $counter] = wp_get_attachment_image_src($images["full_" . $counter], false); // URL of Second Slide Full Image

				$images['thumb_' . $counter] = MultiPostThumbnails::get_post_thumbnail_id('portfolio',  $countername . '-slide', $id); 

				$images['thumb_' . $counter] = wp_get_attachment_image_src($images['thumb_' . $counter], $image_size, false);  // URL of Featured first 
			 
			 $counter++;
		}	

		return $images;
	 
	}

/*-----------------------------------------------------------------------------------*/
/*	Load Text Domain
/*-----------------------------------------------------------------------------------*/

function theme_init(){
    load_theme_textdomain('framework', get_template_directory() . '/lang');
}
add_action ('init', 'theme_init');

/*-----------------------------------------------------------------------------------*/
/*	Add Shortcode Buttons to WYSIWIG
/*-----------------------------------------------------------------------------------*/

add_action('init', 'add_ag_shortcodes');  

function add_ag_shortcodes() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
   
   	 //Add "button" button
     add_filter('mce_external_plugins', 'add_plugin_button');  
     add_filter('mce_buttons', 'register_button');  
	 
     //Add "divider" button
     add_filter('mce_external_plugins', 'add_plugin_divider');  
     add_filter('mce_buttons', 'register_divider'); 
     
	 //Add "tabs" button
     add_filter('mce_external_plugins', 'add_plugin_featuredfulltabs');  
     add_filter('mce_buttons', 'register_featuredfulltabs');   
	 
	 //Add "lightbox" button
     add_filter('mce_external_plugins', 'add_plugin_lightbox');  
     add_filter('mce_buttons', 'register_lightbox');  
	 
	 //Add "shortcodes" buttons - 3rd row
	 
	 add_filter('mce_external_plugins', 'add_plugin_onehalf');  
     add_filter('mce_buttons_3', 'register_onehalf'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onehalflast');  
     add_filter('mce_buttons_3', 'register_onehalflast'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onethird');  
     add_filter('mce_buttons_3', 'register_onethird'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onethirdlast');  
     add_filter('mce_buttons_3', 'register_onethirdlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_twothird');  
     add_filter('mce_buttons_3', 'register_twothird'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_twothirdlast');  
     add_filter('mce_buttons_3', 'register_twothirdlast'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onefourth');  
     add_filter('mce_buttons_3', 'register_onefourth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onefourthlast');  
     add_filter('mce_buttons_3', 'register_onefourthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_threefourth');  
     add_filter('mce_buttons_3', 'register_threefourth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_threefourthlast');  
     add_filter('mce_buttons_3', 'register_threefourthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_onefifth');  
     add_filter('mce_buttons_3', 'register_onefifth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onefifthlast');  
     add_filter('mce_buttons_3', 'register_onefifthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_twofifth');  
     add_filter('mce_buttons_3', 'register_twofifth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_twofifthlast');  
     add_filter('mce_buttons_3', 'register_twofifthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_threefifth');  
     add_filter('mce_buttons_3', 'register_threefifth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_threefifthlast');  
     add_filter('mce_buttons_3', 'register_threefifthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_fourfifth');  
     add_filter('mce_buttons_3', 'register_fourfifth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_fourfifthlast');  
     add_filter('mce_buttons_3', 'register_fourfifthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_onesixth');  
     add_filter('mce_buttons_3', 'register_onesixth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_onesixthlast');  
     add_filter('mce_buttons_3', 'register_onesixthlast');
	 
	 add_filter('mce_external_plugins', 'add_plugin_fivesixth');  
     add_filter('mce_buttons_3', 'register_fivesixth'); 
	 
	 add_filter('mce_external_plugins', 'add_plugin_fivesixthlast');  
     add_filter('mce_buttons_3', 'register_fivesixthlast');
	 
   }  
}  

function register_button($buttons) {  
   array_push($buttons, "button");  
   return $buttons;  
} 
function add_plugin_button($plugin_array) {  
   $plugin_array['button'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}  
function register_divider($buttons) {  
   array_push($buttons, "divider");  
   return $buttons;  
}
function add_plugin_divider($plugin_array) {  
   $plugin_array['divider'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}
function register_featuredfulltabs($buttons) {  
   array_push($buttons, "featuredfulltabs");  
   return $buttons;  
}
function add_plugin_featuredfulltabs($plugin_array) {  
   $plugin_array['featuredfulltabs'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}
function register_lightbox($buttons) {  
   array_push($buttons, "lightbox");  
   return $buttons;  
}
function add_plugin_lightbox($plugin_array) {  
   $plugin_array['lightbox'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onehalf($buttons) {  
   array_push($buttons, "onehalf");  
   return $buttons;  
}
function add_plugin_onehalf($plugin_array) {  
   $plugin_array['onehalf'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onehalflast($buttons) {  
   array_push($buttons, "onehalflast");  
   return $buttons;  
}
function add_plugin_onehalflast($plugin_array) {  
   $plugin_array['onehalflast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onethird($buttons) {  
   array_push($buttons, "onethird");  
   return $buttons;  
}
function add_plugin_onethird($plugin_array) {  
   $plugin_array['onethird'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onethirdlast($buttons) {  
   array_push($buttons, "onethirdlast");  
   return $buttons;  
}
function add_plugin_onethirdlast($plugin_array) {  
   $plugin_array['onethirdlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_twothird($buttons) {  
   array_push($buttons, "twothird");  
   return $buttons;  
}
function add_plugin_twothird($plugin_array) {  
   $plugin_array['twothird'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_twothirdlast($buttons) {  
   array_push($buttons, "twothirdlast");  
   return $buttons;  
}
function add_plugin_twothirdlast($plugin_array) {  
   $plugin_array['twothirdlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// one fourth buttons

function register_onefourth($buttons) {  
   array_push($buttons, "onefourth");  
   return $buttons;  
}
function add_plugin_onefourth($plugin_array) {  
   $plugin_array['onefourth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onefourthlast($buttons) {  
   array_push($buttons, "onefourthlast");  
   return $buttons;  
}
function add_plugin_onefourthlast($plugin_array) {  
   $plugin_array['onefourthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}


// three fourth buttons

function register_threefourth($buttons) {  
   array_push($buttons, "threefourth");  
   return $buttons;  
}
function add_plugin_threefourth($plugin_array) {  
   $plugin_array['threefourth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_threefourthlast($buttons) {  
   array_push($buttons, "threefourthlast");  
   return $buttons;  
}
function add_plugin_threefourthlast($plugin_array) {  
   $plugin_array['threefourthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// one fifth buttons

function register_onefifth($buttons) {  
   array_push($buttons, "onefifth");  
   return $buttons;  
}
function add_plugin_onefifth($plugin_array) {  
   $plugin_array['onefifth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onefifthlast($buttons) {  
   array_push($buttons, "onefifthlast");  
   return $buttons;  
}
function add_plugin_onefifthlast($plugin_array) {  
   $plugin_array['onefifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// two fifth buttons

function register_twofifth($buttons) {  
   array_push($buttons, "twofifth");  
   return $buttons;  
}
function add_plugin_twofifth($plugin_array) {  
   $plugin_array['twofifth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_twofifthlast($buttons) {  
   array_push($buttons, "twofifthlast");  
   return $buttons;  
}
function add_plugin_twofifthlast($plugin_array) {  
   $plugin_array['twofifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// three fifth buttons

function register_threefifth($buttons) {  
   array_push($buttons, "threefifth");  
   return $buttons;  
}
function add_plugin_threefifth($plugin_array) {  
   $plugin_array['threefifth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_threefifthlast($buttons) {  
   array_push($buttons, "threefifthlast");  
   return $buttons;  
}
function add_plugin_threefifthlast($plugin_array) {  
   $plugin_array['threefifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// four fifth buttons

function register_fourfifth($buttons) {  
   array_push($buttons, "fourfifth");  
   return $buttons;  
}
function add_plugin_fourfifth($plugin_array) {  
   $plugin_array['fourfifth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_fourfifthlast($buttons) {  
   array_push($buttons, "fourfifthlast");  
   return $buttons;  
}
function add_plugin_fourfifthlast($plugin_array) {  
   $plugin_array['fourfifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// one sixth buttons

function register_onesixth($buttons) {  
   array_push($buttons, "onesixth");  
   return $buttons;  
}
function add_plugin_onesixth($plugin_array) {  
   $plugin_array['onesixth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_onesixthlast($buttons) {  
   array_push($buttons, "onesixthlast");  
   return $buttons;  
}
function add_plugin_onesixthlast($plugin_array) {  
   $plugin_array['onesixthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

// five sixth buttons

function register_fivesixth($buttons) {  
   array_push($buttons, "fivesixth");  
   return $buttons;  
}
function add_plugin_fivesixth($plugin_array) {  
   $plugin_array['fivesixth'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}

function register_fivesixthlast($buttons) {  
   array_push($buttons, "fivesixthlast");  
   return $buttons;  
}
function add_plugin_fivesixthlast($plugin_array) {  
   $plugin_array['fivesixthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';    
   return $plugin_array;  
}


function parse_shortcode_content( $content ) {

    /* Parse nested shortcodes and add formatting. */
    $content = trim( wpautop( do_shortcode( $content ) ) );

    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );

    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );

    return $content;
}

function get_attachment_id_from_src ($image_src) {

		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id = $wpdb->get_var($query);
		return $id;

	}

function ag_is_default($font) {
  if ($font == 'Arial' || $font == 'Georgia' || $font == 'Tahoma' || $font == 'Verdana' || $font == 'Helvetica') {
    $font = 'Droid Sans';
  }
  return $font;
}

/**
 * Include Updater script
 */
include("functions/theme-updater.php");

/**
 * Get Username and API Key from Theme Options
 */
$username = get_option('of_tf_username');
$api = get_option('of_tf_api');

if ($username && $username != '') {
    define('THEMEFOREST_USERNAME',$username);
}
if ($api && $api != '') {
    define('THEMEFOREST_APIKEY', $api);
}

/**
 * Display calendar with days that have posts as links.
 *
 * The calendar is cached, which will be retrieved, if it exists. If there are
 * no posts for the month, then it will not be displayed.
 *
 * @since 1.0.0
 *
 * @param bool $initial Optional, default is true. Use initial calendar names.
 * @param bool $echo Optional, default is true. Set to false for return.
 * @return string|null String when retrieving, null when displaying.
 */
function get_calendar_minc($initial = true, $echo = true) {
	global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;

	$key = md5( $m . $monthnum . $year );
	if ( $cache = wp_cache_get( 'get_calendar', 'calendar' ) ) {
		if ( is_array($cache) && isset( $cache[ $key ] ) ) {
			if ( $echo ) {
				/** This filter is documented in wp-includes/general-template.php */
				echo apply_filters( 'get_calendar', $cache[$key] );
				return;
			} else {
				/** This filter is documented in wp-includes/general-template.php */
				return apply_filters( 'get_calendar', $cache[$key] );
			}
		}
	}

	if ( !is_array($cache) )
		$cache = array();

	// Quick check. If we have no posts at all, abort!
	if ( !$posts ) {
		$gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' LIMIT 1");
		if ( !$gotsome ) {
			$cache[ $key ] = '';
			wp_cache_set( 'get_calendar', $cache, 'calendar' );
			return;
		}
	}

	if ( isset($_GET['w']) )
		$w = ''.intval($_GET['w']);

	// week_begins = 0 stands for Sunday
	$week_begins = intval(get_option('start_of_week'));

	// Let's figure out when we are
	if ( !empty($monthnum) && !empty($year) ) {
		$thismonth = ''.zeroise(intval($monthnum), 2);
		$thisyear = ''.intval($year);
	} elseif ( !empty($w) ) {
		// We need to get the month from MySQL
		$thisyear = ''.intval(substr($m, 0, 4));
		$d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
		$thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
	} elseif ( !empty($m) ) {
		$thisyear = ''.intval(substr($m, 0, 4));
		if ( strlen($m) < 6 )
				$thismonth = '01';
		else
				$thismonth = ''.zeroise(intval(substr($m, 4, 2)), 2);
	} else {
		$thisyear = gmdate('Y', current_time('timestamp'));
		$thismonth = gmdate('m', current_time('timestamp'));
	}

	$unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);
	$last_day = date('t', $unixmonth);

	// Get the next and previous month and year with at least one post
	$previous = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date < '$thisyear-$thismonth-01'
		AND post_type = 'post' AND post_status = 'publish'
			ORDER BY post_date DESC
			LIMIT 1");
	$next = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
		AND post_type = 'post' AND post_status = 'publish'
			ORDER BY post_date ASC
			LIMIT 1");

	/* translators: Calendar caption: 1: month name, 2: 4-digit year */
	$calendar_caption = _x('%1$s %2$s', 'calendar caption');
	$calendar_output = '<table id="wp-calendar">
	<caption>' . sprintf($calendar_caption, $wp_locale->get_month($thismonth), date('Y', $unixmonth)) . '</caption>
	<thead>
	<tr>';

	$myweek = array();

	for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
		$myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
	}

	foreach ( $myweek as $wd ) {
		$day_name = (true == $initial) ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
		$wd = esc_attr($wd);
		$calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
	}

	$calendar_output .= '
	</tr>
	</thead>

	<tfoot>
	<tr>';

	if ( $previous ) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev"><a href="' . get_month_link($previous->year, $previous->month) . '">&laquo; ' . $wp_locale->get_month_abbrev($wp_locale->get_month($previous->month)) . '</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev" class="pad">&nbsp;</td>';
	}

	$calendar_output .= "\n\t\t".'<td class="pad">&nbsp;</td>';

	if ( $next ) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next"><a href="' . get_month_link($next->year, $next->month) . '">' . $wp_locale->get_month_abbrev($wp_locale->get_month($next->month)) . ' &raquo;</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next" class="pad">&nbsp;</td>';
	}

	$calendar_output .= '
	</tr>
	</tfoot>

	<tbody>
	<tr>';

	$daywithpost = array();

	// Get days with posts
	$dayswithposts = $wpdb->get_results("SELECT DISTINCT DAYOFMONTH(post_date)
		FROM $wpdb->posts WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00'
		AND post_type = 'post' AND post_status = 'publish'
		AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59'", ARRAY_N);
	if ( $dayswithposts ) {
		foreach ( (array) $dayswithposts as $daywith ) {
			$daywithpost[] = $daywith[0];
		}
	}

	if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'camino') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'safari') !== false)
		$ak_title_separator = "\n";
	else
		$ak_title_separator = ', ';

	$ak_titles_for_day = array();
	$ak_post_titles = $wpdb->get_results("SELECT ID, post_title, DAYOFMONTH(post_date) as dom "
		."FROM $wpdb->posts "
		."WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00' "
		."AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59' "
		."AND post_type = 'post' AND post_status = 'publish'"
	);
	if ( $ak_post_titles ) {
		foreach ( (array) $ak_post_titles as $ak_post_title ) {

				/** This filter is documented in wp-includes/post-template.php */
				$post_title = esc_attr( apply_filters( 'the_title', $ak_post_title->post_title, $ak_post_title->ID ) );

				if ( empty($ak_titles_for_day['day_'.$ak_post_title->dom]) )
					$ak_titles_for_day['day_'.$ak_post_title->dom] = '';
				if ( empty($ak_titles_for_day["$ak_post_title->dom"]) ) // first one
					$ak_titles_for_day["$ak_post_title->dom"] = $post_title;
				else
					$ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
		}
	}

	// See how much we should pad in the beginning
	$pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
	if ( 0 != $pad )
		$calendar_output .= "\n\t\t".'<td colspan="'. esc_attr($pad) .'" class="pad">&nbsp;</td>';

	$daysinmonth = intval(date('t', $unixmonth));
	for ( $day = 1; $day <= $daysinmonth; ++$day ) {
		if ( isset($newrow) && $newrow )
			$calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
		$newrow = false;

		if ( $day == gmdate('j', current_time('timestamp')) && $thismonth == gmdate('m', current_time('timestamp')) && $thisyear == gmdate('Y', current_time('timestamp')) )
			$calendar_output .= '<td id="today">';
		else
			$calendar_output .= '<td>';

		if ( in_array($day, $daywithpost) ) // any posts today?
				$calendar_output .= '<a href="' . get_day_link( $thisyear, $thismonth, $day ) . '" title="' . esc_attr( $ak_titles_for_day[ $day ] ) . "\">$day</a>";
		else
			$calendar_output .= $day;
		$calendar_output .= '</td>';

		if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
			$newrow = true;
	}

	$pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
	if ( $pad != 0 && $pad != 7 )
		$calendar_output .= "\n\t\t".'<td class="pad" colspan="'. esc_attr($pad) .'">&nbsp;</td>';

	$calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";

	$cache[ $key ] = $calendar_output;
	wp_cache_set( 'get_calendar', $cache, 'calendar' );

	if ( $echo ) {
		/**
		 * Filter the HTML calendar output.
		 *
		 * @since 3.0.0
		 *
		 * @param string $calendar_output HTML output of the calendar.
		 */
		echo apply_filters( 'get_calendar', $calendar_output );
	} else {
		/** This filter is documented in wp-includes/general-template.php */
		return apply_filters( 'get_calendar', $calendar_output );
	}

}
function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = $excerpt.' <a href="'.$permalink.'">[...]</a>';
  return $excerpt;
}

function wordpress_pagination($maxNumPage="") {

    global $wp_query;
    $big = 999999999;

    if($maxNumPage==""){
    	$maxNumPage=$wp_query->max_num_pages;
    }

     //echo paginate_links(  );
    echo paginate_links( array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '?paged=%#%',
          'current' => max( 1, get_query_var('paged') ),
          'total' => $maxNumPage
    ) );
}


?>