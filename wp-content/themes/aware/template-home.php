<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>


<!-- Custom HEPTA / Lenon Leite 
==================================================-->
<div class="container">
    <div id="featuredle"> 
        <!--<div class="content" style="">
            <h1>Orbit does content now.</h1>
            <h3>Highlight me...I'm text.</h3>
        </div>-->
        <?php 
            
            
            ?>
            
          <?php 
           $loopSlider = new WP_Query( array( 'post_type' => 'post', 'category_name'=>'destaque', 'posts_per_page' => 5 ) );  
            while ($loopSlider->have_posts()) : $loopSlider->the_post();
              //$term_list = array_merge($term_list, wp_get_post_terms($post->ID, 'sort', array("fields" => "ids")));
                 $img = get_the_post_thumbnail(get_the_ID(),'slider'); 
                    $re = "/<img\\s+[^>]*src=\"([^\"]*)\"[^>]*>/"; 

                    $src = preg_match($re, $img, $match);?>      
                <img src="<?php echo $match[1];?>" data-caption="#slider-image-<?php echo get_the_ID();?>" />
                <?php  
                //$match[1];
            endwhile; 
            ?>
            
            
    </div>
    <?php 
    while ($loopSlider->have_posts()) : $loopSlider->the_post();
    ?>
        <div class="orbit-caption" id="slider-image-<?php echo get_the_ID();?>" style="display:none;">
            <a href="<?php the_permalink(); ?>"><h2><?php the_title();?></h2></a>
        </div> 
    <?php
    endwhile; 
    ?>
</div>
<!-- Fim Custom HEPTA / Lenon Leite 
==================================================-->

<!-- Site Tagline
================================================== -->
<?php  /*if ($tagline = get_option('of_site_tagline')) { echo '
<div class="container clearfix">
    <div class="sixteen columns intro fadeInDown animated">
        <h2 class="aligncenter">'.$tagline.'</h2>
    </div>
</div>'; 
} */?>

<!--<div class="container clearfix" id="loadingcontainer">

	<div class="sixteen columns loadingcontainer">
		<div class='ajaxloading'></div>
	</div>
	<div class="clear"></div>
    
</div>-->
<!-- Load Container Post
================================================== -->
<div id="ajaxcontainer">
    <div class="container clearfix" id="ajaxouter">
        <div id="ajaxinner" data-url="<?php echo get_template_directory_uri() ?>/functions/ajax-open.php"></div>
    </div>
</div>
<!-- Primary Page Layout
================================================== -->

<!-- Home Content Area
================================================== -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="container clearfix homecontent">
    <div class="sixteen columns">
        <?php the_content(); ?>
    </div>
    <div class="clear"></div>
</div>
<?php endwhile; endif;?>

<div class="container clearfix homecontent">
   
    <div class="twelve columns newspost">
        <div class=" fadeInUp animated">

            <?php $filter = (get_option('of_filter_action')) ? get_option('of_filter_action') : 'Fade'; ?>

            <?php $homepagenumber = -1; ?>
            <?php $loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $homepagenumber ) ); $counter = 1; ?>

            <?php 
            $term_list = array();

            // Get only terms from these posts
            while ($loop->have_posts()) : $loop->the_post();
              $term_list = array_merge($term_list, wp_get_post_terms($post->ID, 'sort', array("fields" => "ids")));
            endwhile; 

            // Remove Duplicates and convert to string
            $term_list = implode(',', array_unique($term_list));
            ?>

                <!-- Filter Portfolio Items
            ================================================== -->
                <div class="container clearfix">
                    <div class="ten columns alpha-home">
                        <ul id="paises" class="filter <?php echo ($filter == 'Fade') ? 'filterfade' : 'filtershuffle'; ?>">
                            <li class="active">
                                <a href="/experiencias" class="filterall" data-value="*"> 
                                    <?php _e('<!--:es-->Todos<!--:--><!--:pb-->Todos<!--:-->', 'framework'); ?>
                                </a>
                            </li>
                            <?php wp_list_categories(
                                array(
                                    'include' => $term_list, 
                                    'title_li' => '', 
                                    'taxonomy' => 'sort', 
                                    'show_option_none'   => '',
                                    'orderby' => 'slug', 
                                    'walker' => new Walker_Portfolio_Filter()
                                )
                            ); ?>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- Filter Portfolio Items
            ================================================== -->
                <div class=" clearfix slideshow " data-value="3">
                <div class="slideshowpreload"></div>
                
                    
            <?php
                while ( $loop->have_posts() ) : $loop->the_post(); 
                          
                $post_url = get_permalink(); //Get Permalink for post
                $terms = get_the_terms( get_the_ID(), 'sort' );
                
                 $thumb = get_post_meta($post->ID,'_thumbnail_id',false); $thumb = wp_get_attachment_image_src($thumb[0], 'portfoliosmall', false);  // URL of Featured Full Image
                 $thumb2 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'second-slide', $post->ID); $thumb2 = wp_get_attachment_image_src($thumb2, 'portfoliosmall', false); // URL of Second Slide Full Image
                 $thumb3 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'third-slide', $post->ID); $thumb3 = wp_get_attachment_image_src($thumb3, 'portfoliosmall', false); // URL of Third Slide Full Image
                 $thumb4 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'fourth-slide', $post->ID); $thumb4 = wp_get_attachment_image_src($thumb4, 'portfoliosmall', false); // URL of Fourth Slide Full Image
                 $thumb5 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'fifth-slide', $post->ID); $thumb5 = wp_get_attachment_image_src($thumb5, 'portfoliosmall', false); // URL of Fifth Slide Full Image
                 $thumb6 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'sixth-slide', $post->ID); $thumb6 = wp_get_attachment_image_src($thumb6, 'portfoliosmall', false); // URL of Sixth Slide Full Image
            ?>
            <!-- Portfolio Item
            ================================================== -->
            <?php
                if($counter>6){
                    $displayDiv=" style='display:none;' ";
                }else{
                    $displayDiv=" ";
                }
            ?>
            <div class="three columns nopadding portfolioitem isobrick   <?php foreach ($terms as $term) { echo 'filter-' . $term->term_id . ' '; } ?>" <?php echo $displayDiv;?> id="project-<?php the_ID(); ?>">
                
                <?php if ($browser !== 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_1_3 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7E18 Safari/528.16') : ?>
                        <div class="flexslider">
                        <?php if ($thumbhover = get_option('of_thumb_hover')) : 
                            if($thumbhover == 'Title') : ?>
                                 <h3 class="thumbnailtitle" data-url="<?php the_ID(); ?>"><?php the_title();?></h3>
                            <?php endif; 
                        endif; ?>
                       
                            <ul class="slides">
                                <?php if(has_post_thumbnail()) { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb[0]; ?>" alt="" class="scale-with-grid" height='156.766px'/>
                                    </a></li>
                                <?php } ?>
                                <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'second-slide', NULL,  'portfoliosmall') != '') { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb2[0]; ?>" alt="" class="scale-with-grid" height='156.766px'/>
                                    </a></li>
                                <?php } ?>
                                <?php //if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'third-slide', NULL,  'portfoliosmall') != '') { ?>
                                <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'third-slide', NULL,  'portfoliosmall') != '') { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb3[0]; ?>" alt="" class="scale-with-grid" height='156.766px'/>
                                    </a></li>
                                <?php } ?>
                                <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'fourth-slide', NULL,  'portfoliosmall') != '') { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb4[0]; ?>" alt="" class="scale-with-grid" height='156.766px'/>
                                    </a></li>
                                <?php } ?>
                                <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'fifth-slide', NULL,  'portfoliosmall') != '') { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb5[0]; ?>" alt="" class="scale-with-grid" height='156.766px'/>
                                    </a></li>
                                <?php } ?>
                                <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'sixth-slide', NULL,  'portfoliosmall') != '') { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb6[0]; ?>" alt="" class="scale-with-grid" height='156.766px'/>
                                    </a></li>
                                <?php } ?>
                            </ul>
                        
             
                        </div>
                <?php else : ?>
                        <a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                          <img src="<?php  echo $thumb[0]; ?>" alt="" class="scale-with-grid"/>
                        </a>
                <?php endif; ?>        
                        
                        
                        <div class="disable <?php foreach ($terms as $term) { echo 'filter-' . $term->term_id . ' '; } ?>"></div>
                    </div>
                    <?php $counter++; ?>
                    <?php endwhile; ?>
                    <div class="clear"></div>
                    <div>
                        <br>
                        <a href="/experiencias">Ver todas</a>
                    </div>
                </div>

            </div>
    </div>
     <div class="four columns">
        <?php   /* Widget Area */   if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Homepage') ) ?>
        
    </div>
</div>
<?php  if ($newshome = get_option('of_home_news') !== 'Off') : ?>
<div class="container clearfix homecontent">
    <div class="four columns newspost">
        <h4><?php if ($newstitle = get_option('of_news_title')) { echo $newstitle; } else { echo 'Latest News'; }?></h4>
        <?php if ($newsdesc = get_option('of_news_desc')) { echo '<p>'.$newsdesc.'</p>'; } else { echo '<p>Check out the latest news and information from the blog.</p>'; }?> 
		<?php if ($newsbutton = get_option('of_news_button')) { ?>
        <?php echo '<p><a  class="button" href="'. get_permalink( get_option( 'page_for_posts' ) ).'" alt="'.__('Blog Posts', 'framework').'">'.$newsbutton.'</a></p>'; } ?>	
    </div>
    <?php 
	if ($newscat = get_option('of_news_category')) {
		$the_query = new WP_Query(array('category_name' => $newscat,'showposts' => 3));
	} else {
		$the_query = new WP_Query(array('showposts' => 3));
	}
    while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <div class="four columns widget news-widget-item">
    	<div class="homeblogitem">
        <div class="homeblogimage">
            <?php /* if the post has a WP 2.9+ Thumbnail */
					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
            <a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('blogsmall', array('class' => 'scale-with-grid')); /* post thumbnail settings configured in functions.php */ ?>
            </a>
            <?php endif; ?>
        </div>
        <h3 class="posttitle"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">
            <?php the_title(); ?>
            </a></h3>
            <h5><a href="<?php the_permalink(); ?>"><?php the_time('jS F Y') ?></a> <?php _e('<!--:es-->PorE<!--:--><!--:pb-->Por<!--:-->', 'framework'); ?> <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></h5><!--Misc Info-->
        <!--Blog Post Title-->
        <!--Blog Excerpt-->
        <?php
				global $more;    // Declare global $more (before the loop).
				$more = 0;       // Set (inside the loop) to display content above the more tag.
				the_content(__('<!--:es-->Lés Más<!--:--><!--:pb-->Leia mais<!--:-->...', 'framework')); ?>
    </div>
    </div>
    <?php endwhile;?>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<?php endif; ?>
<?php get_footer(); ?>
