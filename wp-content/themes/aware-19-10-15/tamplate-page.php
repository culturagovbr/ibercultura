<?php
/*
Template Name: Page - Original
*/
?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Page Title
  ================================================== -->
<div class="container clearfix">
    <div class="pagename sixteen columns fadeInUp animated">
        <h1>
            <?php the_title(); ?>
        </h1>
    </div>
</div>

<!-- Page Content
  ================================================== -->
<div class="container clearfix fadeInUp animated">
<div class="eleven columns content">
<div class="contentwrap">
            <?php the_content(); ?>
             <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

            <?php endwhile; else :?>
            <!-- Else nothing found -->
            <h2><?php _e('<!--:es-->Erro 404 - Não encontradaE<!--:--><!--:pb-->Erro 404 - Não encontrada<!--:-->.', 'framework'); ?></h2>
            <p><?php _e("<!--:es-->Desculpe, mas você está procurando por algo que não está aqui.E<!--:--><!--:pb-->Desculpe, mas você está procurando por algo que não está aqui.<!--:-->.", 'framework'); ?></p>
           <!--BEGIN .navigation .page-navigation -->
            <?php endif; ?>
            
            <div class="clear"></div>
</div>          
</div>
<div class="four columns sidebar offset-by-one content">
   <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar') ) ?>
</div>
<div class="clear"></div>
</div>
<?php get_footer(); ?>