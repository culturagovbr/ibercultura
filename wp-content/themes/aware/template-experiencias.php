<?php
/*
Template Name: Page - Experiências
*/
?>
<?php get_header(); 

?>


<!-- Page Title
  ================================================== -->
<div class="container clearfix">
    <div class="pagename sixteen columns fadeInUp animated">
        <h1><?php _e('<!--:es-->Experiencias<!--:--><!--:pb-->Experiências<!--:-->', 'framework'); ?></h1>
    </div>
</div>

<!-- Page Content
  ================================================== -->
<div class="container clearfix fadeInUp animated">
    <div class="sixteen columns blogwrap">
        <?php
            global $pp, $wp_query, $wp;
        
            $counter = 1;
            $paged = 0;
            // Construct the custom WP_Query instance
            $loop = new WP_Query( array( 'post_type' => 'portfolio', 'paged' => $paged ,'posts_per_page'=>-1) );
            ?>
               <!-- Filter Portfolio Items
            ================================================== -->
                <div class="container clearfix">
                    <div class="sixteen columns alpha">
                        <ul class="filter <?php echo ($filter == 'Fade') ? 'filterfade' : 'filtershuffle'; ?>">
                            <li class="active"><a href="#" class="filterall" data-value="*"> <?php _e('<!--:es-->Todos<!--:--><!--:pb-->Todos<!--:-->', 'framework'); ?></a></li>
                            <?php wp_list_categories(array('orderby' => 'slug', 'include' => $term_list, 'title_li' => '', 'taxonomy' => 'sort', 'show_option_none'   => '', 'walker' => new Walker_Portfolio_Filter())); ?>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- Filter Portfolio Items
            ================================================== -->
            <div class=" clearfix slideshow isotopecontainer isotope" data-value="3">
            <?php
                while ( $loop->have_posts() ) : $loop->the_post();   
                    $terms = get_the_terms( get_the_ID(), 'sort' );?>
                    <div class="portfolioitem isotope-item isobrick five columns nopadding projeto element-item <?php foreach ($terms as $term) { echo 'filter-' . $term->term_id . ' '; } ?> " id="project-<?php the_ID(); ?>" >
                        <div class="flexslider ">
                             <?php if ($thumbhover = get_option('of_thumb_hover')) : 
                            if($thumbhover == 'Title') : ?>
                                 <h3 class="thumbnailtitle" data-url="<?php the_ID(); ?>"><?php the_title();?></h3>
                            <?php endif; 
                        endif; ?>
                            <div class="slides">
                                <?php 
                                    $post_url = get_permalink();
                                ?>
                                    <?php //echo themewich_featured_output($loop->post); ?>
                                                                   
                                <?php //echo get_the_term_list( $post->ID, 'sort', '<div class="darkbubble"> <p class="smalldetails">', '<br />', ' </p></div>' ); ?>
                                <?php 
                                    $thumb = get_post_meta($post->ID,'_thumbnail_id',false); $thumb = wp_get_attachment_image_src($thumb[0], 'portfoliosmall', false);  // URL of Featured Full Image
                                     $thumb2 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'second-slide', $post->ID); $thumb2 = wp_get_attachment_image_src($thumb2, 'portfoliosmall', false); // URL of Second Slide Full Image
                                     $thumb3 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'third-slide', $post->ID); $thumb3 = wp_get_attachment_image_src($thumb3, 'portfoliosmall', false); // URL of Third Slide Full Image
                                     $thumb4 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'fourth-slide', $post->ID); $thumb4 = wp_get_attachment_image_src($thumb4, 'portfoliosmall', false); // URL of Fourth Slide Full Image
                                     $thumb5 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'fifth-slide', $post->ID); $thumb5 = wp_get_attachment_image_src($thumb5, 'portfoliosmall', false); // URL of Fifth Slide Full Image
                                     $thumb6 = MultiPostThumbnails::get_post_thumbnail_id('portfolio', 'sixth-slide', $post->ID); $thumb6 = wp_get_attachment_image_src($thumb6, 'portfoliosmall', false); // URL of Sixth Slide Full Image
                                
                                ?>
                                <?php if ($thumbhover = get_option('of_thumb_hover')) : 
                            if($thumbhover == 'Title') : ?>
                                 <h3 class="thumbnailtitle" data-url="<?php the_ID(); ?>"><?php the_title();?></h3>
                            <?php endif; 
                        endif; ?>
                       
                            <ul class="slides">
                                <?php if(has_post_thumbnail()) { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb[0]; ?>" alt="" class="scale-with-grid" height='233.484px'/>
                                    </a></li>
                                <?php } ?>
                                <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'second-slide', NULL,  'portfoliosmall') != '') { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb2[0]; ?>" alt="" class="scale-with-grid" height='233.484px'/>
                                    </a></li>
                                <?php } ?>
                                <?php //if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'third-slide', NULL,  'portfoliosmall') != '') { ?>
                                <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'third-slide', NULL,  'portfoliosmall') != '') { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb3[0]; ?>" alt="" class="scale-with-grid" height='233.484px'/>
                                    </a></li>
                                <?php } ?>
                                <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'fourth-slide', NULL,  'portfoliosmall') != '') { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb4[0]; ?>" alt="" class="scale-with-grid" height='233.484px'/>
                                    </a></li>
                                <?php } ?>
                                <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'fifth-slide', NULL,  'portfoliosmall') != '') { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb5[0]; ?>" alt="" class="scale-with-grid" height='233.484px'/>
                                    </a></li>
                                <?php } ?>
                                <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'sixth-slide', NULL,  'portfoliosmall') != '') { ?>
                                <li><a href="<?php echo $post_url; ?>" data-url="<?php the_ID(); ?>" class="ajax-portfolio">
                                    <img src="<?php  echo $thumb6[0]; ?>" alt="" class="scale-with-grid" height='233.484px'/>
                                    </a></li>
                                <?php } ?>
                            </ul>
                                
                                                           
                            </div>
                        </div>
                    </div>
                     <div class="disable <?php foreach ($terms as $term) { echo 'filter-' . $term->term_id . ' '; } ?>"></div>
                            
                                       
                <?php endwhile; ?>
            </div>
            
        
    
    <div class="clear"></div>
    
</div>
<?php get_footer(); ?>
