</div>
<!-- Close Mainbody and start footer
  ================================================== -->
<div class="clear"></div>
<div id="footer">
    <div class="container clearfix">
    	<div class="eight columns">
        <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Left') ) ?></div>
        <div class="six columns"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Left Center') ) ?> </div>
        <div class="four columns"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Right Center') ) ?></div>         
        <div class="four columns"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Right') ) ?></div>
        <div class="clear"></div>
	</div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<!-- Theme Hook -->
<?php wp_footer(); ?>
</div>
<div class="container" style="text-align: center;">
    <img src="<?php echo get_template_directory_uri();?>/images/logos/secr_ibero_am.png">
    <img src="<?php echo get_template_directory_uri();?>/images/logos/argentina.jpg">
    <img src="<?php echo get_template_directory_uri();?>/images/logos/brasil-minc-2016.png">
    <img src="<?php echo get_template_directory_uri();?>/images/logos/chile.png">
    <img src="<?php echo get_template_directory_uri();?>/images/logos/red-cultura.png">
    <hr>
    <img src="<?php echo get_template_directory_uri();?>/images/logos/costarica.jpg">
    <img src="<?php echo get_template_directory_uri();?>/images/logos/ecuador.jpg">      
    <img style="margin-left: 20px;" src="<?php echo get_template_directory_uri();?>/images/logos/elsalvador.jpg">
    <img src="<?php echo get_template_directory_uri();?>/images/logos/espana.png">
    <hr>
    <img src="<?php echo get_template_directory_uri();?>/images/logos/guatemala.jpg">
    <img src="<?php echo get_template_directory_uri();?>/images/logos/sec-cultura-mx.jpg">
    <img src="<?php echo get_template_directory_uri();?>/images/logos/peru.png">
    <img src="<?php echo get_template_directory_uri();?>/images/logos/mec.png">
    <ul class="xoxo blogroll">
    </ul>
</div>
<!-- Close Site Container
  ================================================== -->
</body>
</html>
