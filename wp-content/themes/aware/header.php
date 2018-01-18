<?php
/**
 * The Theme Header
 * @package WordPress
 * @subpackage Bookcase
 * @since Bookcase 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<?php
global $browser;
$browser = $_SERVER['HTTP_USER_AGENT'];
?>
<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php 
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
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
		echo ' | ' . sprintf( __( 'Page %s', 'ellipsis' ), max( $paged, $page ) );

	?>
</title>

<?php 
$cyrillic = get_option('of_cyrillic_chars');
if ($cyrillic == 'Yes') { $cyrillic_suffix = '::cyrillic,latin'; } else { $cyrillic_suffix = ''; }   ?> 

<!-- Embed Google Web Fonts Via API -->
<script type="text/javascript">
      WebFontConfig = {
        google: { families: [ 
            '<?php if ( $h1font = get_option('of_heading_font') ) { 
                echo (function_exists('ag_is_default')) ? ag_is_default($h1font) . $cyrillic_suffix : $h1font . $cyrillic_suffix;  
            } else { 
                echo 'Open Sans' . $cyrillic_suffix;  
            } ?>', 
            '<?php if ( $h2font = get_option('of_secondary_font') ) {
                echo (function_exists('ag_is_default')) ? ag_is_default($h2font) . $cyrillic_suffix : $h2font . $cyrillic_suffix;  
            } else { 
                echo 'Open Sans' . $cyrillic_suffix; 
            } ?>', 
            '<?php if ( $pfont = get_option('of_p_font') ) { 
                echo (function_exists('ag_is_default')) ? ag_is_default($pfont) . $cyrillic_suffix : $pfont . $cyrillic_suffix;  
            } else { 
                echo 'Open Sans' . $cyrillic_suffix; 
            } ?>', 
            '<?php if ( $tinyfont = get_option('of_tiny_font') ) { 
                echo (function_exists('ag_is_default')) ? ag_is_default($tinyfont) . $cyrillic_suffix : $tinyfont . $cyrillic_suffix;                  
            } else { 
                echo 'Droid Serif' . $cyrillic_suffix; 
            } ?>'] }
      };
      (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
       // wf.async = 'true'; // prevents flash of unstyled text
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })();
    </script>

<?php wp_head(); ?>

<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

</head>
<body <?php body_class(); ?> <?php echo ( $lightbox_skin = get_option('of_prettyphoto_skin') ) ? 'data-lightbox="' . $lightbox_skin . '"' : '';?>>
<div class="sitecontainer">
<noscript>
<div class="alert">
<p><?php _e('<!--:es-->Por favor, ative o javascript para visualizar o site.E<!--:--><!--:pb-->Por favor, ative o javascript para visualizar o site.<!--:-->', 'framework'); ?></p>
</div>
</noscript>

<!-- Preload Images
	================================================== -->
<div id="preloaded-images"> <img src="<?php echo get_template_directory_uri();?>/images/downarrow.png" width="1" height="1" alt="Image" />
<img src="<?php echo get_template_directory_uri();?>/images/loading.gif" width="1" height="1" alt="Image" />
<img src="<?php echo get_template_directory_uri();?>/images/horizontal-loading.gif" width="1" height="1" alt="Image" />
<img src="<?php echo get_template_directory_uri();?>/images/loading-dark.gif" width="1" height="1" alt="Image" />
<img src="<?php echo get_template_directory_uri();?>/images/horizontal-loading-dark.gif" width="1" height="1" alt="Image" />
</div>
<!-- Primary Page Layout
	================================================== -->

<?php //$topbar = get_option('of_top_bar');
//if($topbar == 'On') : ?>

<div id="top_panel">
    <div id="top_panel_content" class="container clearfix">
        <?php include (TEMPLATEPATH . '/template-top-panel.php'); ?>
        
        <div class="six columns">
            <div class="seven columns fadeInDown animated ">
                <?php echo is_front_page() ? '<h1>' : '<h2>'; ?>
                    <a href="<?php echo home_url(); ?>">
                        <?php if ( $logo = get_option('of_logo') ) { ?>
                        <img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
                        <?php } else { bloginfo( 'name' );} ?>
                    </a>
                <?php echo is_front_page() ? '</h1>' : '</h2>'; ?> 
            </div>
            
        </div>
        <div class="ten columns">
            <div class="">
                <div class="alignright" id="acessibilidade">
                    <a class="contraste" title="Aumentar fonte" href="#"> <img src="<?php echo get_template_directory_uri();?>/images/stock_contrast.png" width="16px"></a> /
                    <a class="inc-font" title="Aumentar fonte" href="#"> <img src="<?php echo get_template_directory_uri();?>/images/format-font-size-more.png" width="16px"></a> /
                    <!--<a class="res-font" title="Tamanho normal da fonte" href="#"> Tamanho original</a> /-->
                    <a class="dec-font" title="Diminuir fonte" href="#"> <img src="<?php echo get_template_directory_uri();?>/images/format-font-size-less.png" width="16px"></a>
                </div>
                <div class="alignright">
                    <?php   /* Widget Area */   if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Header Minc') ) ?>
                </div>

            </div>

            <div class="clear"></div>
            <div class="">
                <!--Searchbox-->
               
                <form method="get" id="searchbox" action="<?php echo home_url(); ?>">
                    <fieldset>
                        <input type="text" name="s" id="s" value="Pesquisar..." onfocus="if(this.value=='Pesquisar...')this.value='';" onblur="if(this.value=='')this.value='Buscar...';">
                        <ul id="lista-redes-sociais">
                           <li><a href="#" title="Youtube" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/youtube.png"></a></li>
                           <li><a href="#" title="Vimeo" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/vimeo.png"></a></li>
                           <li><a href="https://twitter.com/iberculturaviva" title="Twitter" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/twitter.png"></a></li>
                           <li><a href="https://facebook.com/iberculturaviva" title="Facebook" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/facebook.png"></a></li>          
                       </ul>   
                    </fieldset>
                </form>

                <!--Searchbox-->
            </div>    
        </div>
            

    

    <div class="">

        
        <div class="sixteen columns fadeInDown animated menu-combo-hepta">
            <!--Start Navigation-->
            <div class="nav">
                <?php if ( has_nav_menu( 'top_nav_menu' ) ) { /* if menu location 'Top Navigation Menu' exists then use custom menu */ ?>
                <?php wp_nav_menu( array('menu' => 'Top Navigation Menu', 'theme_location' => 'top_nav_menu', 'menu_class' => 'sf-menu' , 'link_after' => "  ")); ?>
                <?php } else { /* else use wp_list_pages */?>
                <ul class="sf-menu">
                    <?php wp_list_pages( array('title_li' => '','sort_column' => 'menu_order')); ?>
                </ul>
                <?php } ?>
            </div>
            <?php  // Mobile Version Dropdown Menu

                $menu_name = 'top_nav_menu';
            
                if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
                $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
            
                $menu_items = wp_get_nav_menu_items($menu->term_id);
            
                $menu_list = '<select id="' . $menu_name . '" class="dropdownmenu" onchange="if(this.options[this.selectedIndex].value != &#39;&#39;){window.top.location.href=this.options[this.selectedIndex].value}">';
                
                $menutext = get_option('of_menu_text');
                if ($menutext == ''){ $menutext = 'Navigation'; }
                
                $menu_list .= '<option>'. $menutext .'</option>';
                
                foreach ( (array) $menu_items as $key => $menu_item ) {
                    $title = $menu_item->title;
                    $url = $menu_item->url;
                    $menu_list .= '<option value="'. $url .'">' . $title . '</option>';
                }
                $menu_list .= '</select>';
                } else {
                $menu_list = '<select class="dropdownmenu"><option>Menu "' . $menu_name . '" not defined.</option></select>';
                }
         
                echo $menu_list;
            
             ?>
            <!--End Navigation-->
        </div>
    </div>
</div>
    <!--<div id="top_panel_button">
        <div id="toggle_button" class="uparrow"></div>
    </div>-->
    <div class="clear"></div>
</div>

<?php //endif; ?>

<div class="container clearfix navcontainer">

    <div class="sixteen columns" id="rede-sociais">

        <div class="five columns fadeInDown animated" style="float:right">
            <!--<ul id="lista-redes-sociais">
                <li><a href="#" title="Youtube" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/youtube-rosa.png"></a></li>
                <li><a href="#" title="Vimeo" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/vimeo-rosa.png"></a></li>
                <li><a href="#" title="Twitter" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/twitter-rosa.png"></a></li>
                <li><a href="#" title="Facebook" target="_blank"><img src="<?php echo get_template_directory_uri();?>/images/facebook-rosa.png"></a></li>
                
            </ul>-->    
            <div class="clear"></div>
            
        </div>
    </div>
    
    <!--<div class="clear"></div>
    <div class="sixteen columns">
        <div class="divider nomargin"></div>
    </div>
    <div class="clear"></div>-->
</div>
<div class="top"> <a href="#"><img src="<?php echo get_template_directory_uri();?>/images/scroll-top.png" alt="Scroll to Top"/></a>
    <div class="clear"></div>
    <div class="scroll">
        <p>
            <?php _e('<!--:es-->Para o Topo.E<!--:--><!--:pb-->Para o Topo<!--:-->', 'framework'); ?>
        </p>
    </div>
</div>
<!-- Start Mainbody
  ================================================== -->
<div class="mainbody">
