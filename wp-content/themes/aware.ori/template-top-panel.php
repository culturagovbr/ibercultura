<?php
/*
Template Name: Top Panel
*/
?>

<?php 
/* Get Portfolio Page ID and URL
================================================== */     
$top_page = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-top-panel.php'
));
$thepageid = NULL;
foreach($top_page as $page){
	$thepageid = $page->ID;
} ?>

<?php  if ($thepageid) { $recent = new WP_Query(array('page_id' => ''. $thepageid .'')); while($recent->have_posts()) : $recent->the_post();?>
	<div class="topcontent">
		<?php the_content(); ?>
	</div>
<?php endwhile; } ?>