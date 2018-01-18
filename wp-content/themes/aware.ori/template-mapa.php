<?php
/*
Template Name: Page - Mapa
*/
?>
<?php get_header(); ?>


<!-- Custom HEPTA / Lenon Leite 
==================================================-->


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
}*/ ?>

<div class="container clearfix" id="loadingcontainer">

	<div class="sixteen columns loadingcontainer">
		<div class='ajaxloading'></div>
	</div>
	<div class="clear"></div>
    
</div>
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
    <div>
    	<iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d63816866.012557544!2d-10.614154750000008!3d12.511360913447144!3m2!1i1024!2i768!4f13.1!2m1!1scompartilhar+google+maps!5e0!3m2!1spt-BR!2sbr!4v1434083492990" width="1000" height="600" frameborder="0" style="border:0"></iframe>
    </div>
    <div class="clear"></div>
</div>
<?php endwhile; endif;?>


<div class="clear"></div>
<br>
<?php get_footer(); ?>
