<?php get_header(); ?>

<!-- Page Title
  ================================================== -->
<div class="container clearfix">
    <div class="pagename sixteen columns fadeInUp animated">
        <h1>
            <?php _e('<!--:es-->Pagina não encontrada! =(E<!--:--><!--:pb-->Pagina não encontrada! =(<!--:-->', 'framework'); ?>
        </h1>
    </div>
</div>

<!-- Page Content
  ================================================== -->
<div class="container clearfix fadeInUp animated">
<div class="eleven columns content">
<div class="contentwrap">
			 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
             <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

            <?php endwhile; else :?>
            <!-- Else nothing found -->
            <h2><?php _e('<!--:es-->Error 404 - No encontrada<!--:--><!--:pb-->Erro 404 - Não encontrada<!--:-->.', 'framework'); ?></h2>
            <p><?php _e("<!--:es-->Disculpe, está procurando algo que no se encuentra aqui.<!--:--><!--:pb-->Desculpe, está procurando algo que não se encontra aqui<!--:-->.", 'framework'); ?></p>
            
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
