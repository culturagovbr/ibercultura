<?php get_header(); ?>

<!-- Page Title
  ================================================== -->


<div class="container clearfix">
    <div class="pagename sixteen columns fadeInUp animated">
        <h1>
            <?php wp_title("",true);
			if(!wp_title("",false)) { echo bloginfo( 'description');} ?>
        </h1>
    </div>
</div>
<div class="clear"></div>




<!-- Page Content
  ================================================== -->

<div class="container clearfix fadeInUp animated">
    <div class="eleven columns blogwrap">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="blogpost">
        <div class="clear"></div> <!-- for stupid ie7 -->
            <div class="one_sixth fulldetails"> 
            
            	<div class="darkbubble date">
                    <h3>
                        <?php the_time('d'); ?>
                    </h3>
                    <p>
                        <?php the_time('M'); ?>
                        <br />
                        <?php the_time('Y'); ?>
                    </p>
                   <div class="clear"></div>
                </div>
                
                <?php if ( comments_open() ) : ?>              
                <p class="smalldetails"> 
                	<a href=" <?php comments_link(); ?> ">
                   		 <?php comments_number(  __('<!--:es-->Sin comentarios<!--:--><!--:pb-->Sem comentários<!--:-->', 'framework'), 
                            __('<!--:es-->Um comentárioE<!--:--><!--:pb-->Um comentário<!--:-->', 'framework'), 
                            __('<!--:es-->% comentáriosE<!--:--><!--:pb-->% comentários<!--:-->', 'framework') ); ?>
                    </a> 
                </p>
                <?php endif; ?>
                
                <p class="smalldetails">
			   		<?php _e('<!--:es-->En<!--:--><!--:pb-->Em<!--:--> ', 'framework'); the_category('<br />'); ?>
                </p>
                   
                <p class="smalldetails">
					<?php _e('<!--:es-->Por<!--:--><!--:pb-->Por<!--:--> ', 'framework'); the_author_link(); ?>
                </p> 
            
            </div>
            <div class="five_sixth column-last">
                <h2 class="blogtitle">

               		<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">
						<?php the_title(); ?>
                    </a> 
                </h2>
                    
                <div class="mobiledetails">
                     <p>
					 <?php _e('<!--:es-->En<!--:--><!--:pb-->Em<!--:--> ', 'framework'); the_time('d'); ?>, <?php the_time('M'); ?>  <?php the_time('Y'); ?><?php if ( comments_open() ) : ?> | <a href=" <?php comments_link(); ?> ">
                   	 <?php comments_number( 
                        __('<!--:es-->Sin comentarios<!--:--><!--:pb-->Sem comentários<!--:-->', 'framework'), 
                        __('<!--:es-->Um comentárioE<!--:--><!--:pb-->Um comentário<!--:-->', 'framework'), 
                        __('<!--:es-->% comentáriosE<!--:--><!--:pb-->% comentários<!--:-->', 'framework') ); ?>
                     </a> <?php endif; ?> |  <?php _e('<!--:es-->En<!--:--><!--:pb-->Em<!--:--> ', 'framework'); the_category(', '); ?> | <?php _e('<!--:es-->Por<!--:--><!--:pb-->Por<!--:--> ', 'framework'); the_author_link(); ?>
                     </p> 
                </div>
                <?php 
                    if (is_category()){
                        echo "<p>".get_excerpt(300)."</p>";
                    }else{
                        the_content(__('<!--:es-->Leia maisE<!--:--><!--:pb-->Leia mais<!--:-->...', 'framework'));
                    }
                       
                ?>
                 

<!-- featured image--> 
                <div class="featuredimage">
                    <?php /* if the post has a WP 2.9+ Thumbnail */
					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
                    <a title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('blog', array('class' => 'scale-with-grid')); /* post thumbnail settings configured in functions.php */ ?>
                    </a>
                    <?php endif; ?>
                </div>
                
                     
                <p class="tags"><?php the_tags('Tags | ', ', ', '<br />'); ?></p>
                
                <?php edit_post_link( __('<!--:es-->EditarE<!--:--><!--:pb-->Editar<!--:--> Post', 'framework'), '<div class="edit-post"><p>[', ']</p></div>' ); ?>
                
                <div class="clear"></div>

            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <?php endwhile; else :?>
        <!-- Else nothing found -->
        <h2>
            <?php _e('<!--:es-->Erro 404 - Não encontradaE<!--:--><!--:pb-->Erro 404 - Não encontrada<!--:--> ', 'framework'); ?>
        </h2>
        <p>
            <?php _e("<!--:es-->Desculpe, mas você está procurando por algo que não está aqui.E<!--:--><!--:pb-->Desculpe, mas você está procurando por algo que não está aqui.<!--:-->.", 'framework'); ?>
        </p>
        <!--BEGIN .navigation .page-navigation -->
        <?php endif; ?>
        <?php if ( function_exists('pp_has_pagination') ) : ?>
        <?php if (pp_has_pagination()) : ?>
        <div class="pagination_container">
            <ul id="pagination">
                <!-- the previous page -->
                <?php pp_the_pagination(); if (pp_has_previous_page()) : ?>
                <li class="previous"> <a href="<?php pp_the_previous_page_permalink(); ?>" class="prev">&laquo;  <?php _e('<!--:es-->AnteriorE<!--:--><!--:pb-->Anterior<!--:-->', 'framework') ?></a></li>
                <?php else : ?>
                <li class="previous-off">&laquo; <?php _e('<!--:es-->AnteriorE<!--:--><!--:pb-->Anterior<!--:-->', 'framework') ?></li>
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
                <li class="next"> <a href="<?php pp_the_next_page_permalink(); ?>"><?php _e('<!--:es-->PróximoE<!--:--><!--:pb-->Próximo<!--:-->', 'framework') ?>  &raquo;</a></li>
                <?php else : ?>
                <li class="next-off"><?php _e('<!--:es-->PróximoE<!--:--><!--:pb-->Próximo<!--:-->', 'framework') ?> &raquo;</span>
                    <?php endif; pp_rewind_pagination(); ?>
            </ul>
        </div>
        <?php endif; else: ?>
            <!-- Pagination
            ================================================== -->        
            <div class="pagination">
                <?php
                    global $wp_query;

                    $big = 999999999; // need an unlikely integer

                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $wp_query->max_num_pages
                    ) );
                ?>   
                <div class="clear"></div>
            </div> <!-- End pagination --> 
        <?php endif;?>
	</div>
    <div class="four columns sidebar offset-by-one content">
        <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ) ?>
    </div>
    <div class="clear"></div>
</div>
<?php get_footer(); ?>
