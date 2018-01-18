<?php get_header(); ?>
<!--Start Top Section -->
<!--
<div class="container">
    <div id="featured"> 
        <div class="content" style="">
            <h1>Orbit does content now.</h1>
            <h3>Highlight me...I'm text.</h3>
        </div>
        <a href=""><img src="dummy-images/overflow.jpg" /></a>
        <img src="dummy-images/captions.jpg" data-caption="#htmlCaption" />
        <img src="dummy-images/features.jpg"  />
    </div>
</div>
-->
<!-- Page Title
  ================================================== -->
<div class="container clearfix">
    <div class="pagename sixteen columns fadeInUp animated">
        <h3><?php if ($projecttitle = get_option('of_portfolio_title')) { echo $projecttitle; } else { echo 'Projects';} ?>
        </h3>
    </div>
</div>

<!-- Page Content
  ================================================== -->
<div class="container clearfix fadeInUp animated">
    <div class="eleven columns blogwrap">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="blogpost portfolio">
        <div class="featuredimage">
            <?php echo themewich_featured_output($post); ?>
        </div>
           <div class="clear"></div>
             <div class="one_fifth fulldetails"> 
                
                <?php echo get_the_term_list( $post->ID, 'sort', '<div class="darkbubble"> <p class="smalldetails">', '<br />', ' </p></div>' ); ?>
               
                <p class="smalldetails">
                <?php if ( comments_open() ) : ?>  
                <a href=" <?php comments_link(); ?> "><?php comments_number(  __('<!--:es-->Sin comentarios<!--:--><!--:pb-->Sem comentários<!--:-->', 'framework'), 
                            __('<!--:es-->Um comentárioE<!--:--><!--:pb-->Um comentário<!--:-->', 'framework'), 
                            __('<!--:es-->% comentáriosE<!--:--><!--:pb-->% comentários<!--:-->', 'framework') ); ?></a>  
                    <br />
                <?php endif; ?>
                    <?php _e('<!--:es-->Por<!--:--><!--:pb-->Por<!--:-->', 'framework'); ?>
                    <?php the_author_link(); ?>
                </p>
            </div>
            <div class="column-last">
              <div class="mobiledetails">
                     <p>
					 <?php _e('<!--:es-->En<!--:--><!--:pb-->Em<!--:--> ', 'framework'); the_time('d'); ?>, <?php the_time('M'); ?>  <?php the_time('Y'); ?><?php if ( comments_open() ) : ?> | <a href=" <?php comments_link(); ?> ">
                   	 <?php comments_number(  __('<!--:es-->Sin comentarios<!--:--><!--:pb-->Sem comentários<!--:-->', 'framework'), 
                            __('<!--:es-->Um comentárioE<!--:--><!--:pb-->Um comentário<!--:-->', 'framework'), 
                            __('<!--:es-->% comentáriosE<!--:--><!--:pb-->% comentários<!--:-->', 'framework') ); ?>
                     </a><?php endif; ?> |  <?php _e('<!--:es-->En<!--:--><!--:pb-->Em<!--:--> ', 'framework'); echo get_the_term_list( $post->ID, 'sort', '', ' ', '' ); ?> | <?php _e('<!--:es-->Por<!--:--><!--:pb-->Por<!--:--> ', 'framework'); the_author_link(); ?>
                     </p> 
             </div>
            <h1><?php the_title();?></h1>
                <?php the_content(__('<!--:es-->Leia maisE<!--:--><!--:pb-->Leia mais<!--:-->...', 'framework')); ?>
                <?php edit_post_link( __('Edit Post', 'framework'), '<div class="edit-post"><p>[', ']</p></div>' ); ?>
                <div class="clear"></div>
            </div>    
        </div>
        <div class="clear"></div>
        <?php endwhile; ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php comments_template('', true);?>
        <?php endwhile; else :?>
        <!-- Else nothing found -->
        <h2>
            <?php _e('<!--:es-->Erro 404 - Não encontradaE<!--:--><!--:pb-->Erro 404 - Não encontrada<!--:-->.', 'framework'); ?>
        </h2>
        <p>
            <?php _e("<!--:es-->Desculpe, mas você está procurando por algo que não está aqui.E<!--:--><!--:pb-->Desculpe, mas você está procurando por algo que não está aqui.<!--:-->.", 'framework'); ?>
        </p>
        <!--BEGIN .navigation .page-navigation -->
        <?php endif; endif; ?>
        <?php if ( function_exists('pp_has_pagination') ) : ?>
        <?php if (pp_has_pagination()) : ?>
        <ul id="pagination">
            <!-- the previous page -->
            <?php pp_the_pagination(); if (pp_has_previous_page()) : ?>
            <li class="previous"> <a href="<?php pp_the_previous_page_permalink(); ?>" class="prev">&laquo;
                <?php _e('<!--:es-->AnteriorE<!--:--><!--:pb-->Anterior<!--:-->', 'framework'); ?>
                </a></li>
            <?php else : ?>
            <li class="previous-off">&laquo;
                <?php _e('<!--:es-->AnteriorE<!--:--><!--:pb-->Anterior<!--:-->', 'framework'); ?>
            </li>
            <?php endif; pp_rewind_pagination(); ?>
            <!-- the page links -->
            <?php while(pp_has_pagination()) : pp_the_pagination(); ?>
            <?php if (pp_is_current_page()) : ?>
            <li class="active">
                <?php pp_the_page_num(); ?>
            </li>
            <?php else : ?>
            <li><a href="<?php pp_the_page_permalink(); ?>">
                <?php pp_the_page_num(); ?>
                </a></li>
            <?php endif; ?>
            <?php endwhile; pp_rewind_pagination(); ?>
            <!-- the next page -->
            <?php pp_the_pagination(); if (pp_has_next_page()) : ?>
            <li class="next"> <a href="<?php pp_the_next_page_permalink(); ?>">
                <?php _e('<!--:es-->PróximoE<!--:--><!--:pb-->Próximo<!--:-->', 'framework'); ?>
                &raquo;</a></li>
            <?php else : ?>
            <li class="next-off">
                <?php _e('<!--:es-->PróximoE<!--:--><!--:pb-->Próximo<!--:-->', 'framework'); ?>
                &raquo;</span>
                <?php endif; pp_rewind_pagination(); ?>
        </ul>
        <?php endif; else: paginate_links(); wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %');  endif;?>
    </div>
    <div class="four columns sidebar offset-by-one content">
        <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Portfolio Sidebar') ) ?>
    </div>
    <div class="clear"></div>
</div>
<?php get_footer(); ?>
