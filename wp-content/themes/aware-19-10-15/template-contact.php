<?php
/*
Template Name: Page - Contact
*/
?>
<?php
// Contact form processing

$name_error = '';
$email_error = '';
$subject_error = '';
$message_error = '';
$captcha_error = '';

$captcha = get_option('of_spam_question');

if (!isset($_REQUEST['c_submitted'])) 
{
//If not isset -> set with dumy value 
$_REQUEST['c_submitted'] = ""; 
$_REQUEST['c_name'] = "";
$_REQUEST['c_email'] = "";
$_REQUEST['c_message'] = "";
}

if($_REQUEST['c_submitted']){

	//check name
	if(trim($_REQUEST['c_name'] == "")){
		//it's empty
		$name_error = __('<!--:es-->Você esqueceu de preencher o seu nomeE<!--:--><!--:pb-->Você esqueceu de preencher o seu nome<!--:-->', 'framework');
		$error = true;
	}else{
		//its ok
		$c_name = trim($_REQUEST['c_name']);
	}

	//check email
	if(trim($_REQUEST['c_email'] === "")){
		//it's empty
		$email_error = __('<!--:es-->Você esqueceu de preencher o seu e-mailE<!--:--><!--:pb-->Você esqueceu de preencher o seu e-mail<!--:-->', 'framework');
		$error = true;
	}else if(!is_email( trim($_REQUEST['c_email'] ) )){
		//it's wrong format
		$email_error = __('<!--:es-->Formato e-mail erradoE<!--:--><!--:pb-->Formato e-mail errado<!--:-->', 'framework');
		$error = true;
	}else{
		//it's ok
		$c_email = trim($_REQUEST['c_email']);
	}
	
	//check captcha
	if ($captcha == 'on') {
		if(trim($_REQUEST['c_captcha'] !== "4")){
			//it's empty
			$captcha_error = __('<!--:es-->Por favor, tente responder a esta novamente.E<!--:--><!--:pb-->Por favor, tente responder a esta novamente.<!--:-->', 'framework');
			$error = true;
		}
	}


	//check name
	if(trim($_REQUEST['c_message'] === "")){
		//it's empty
		$message_error = __('<!--:es-->Você esqueceu de preencher a sua mensagemE<!--:--><!--:pb-->Você esqueceu de preencher a sua Mensagem<!--:-->', 'framework');
		$error = true;
	}else{
		//it's ok
		$c_message = trim($_REQUEST['c_message']);
	}

	//if no errors occured
	if($error != true) {

		$email_to = get_option('of_mail_address');
		if (!isset($email_to) || ($email_to == '') ){
			$email_to = get_option('admin_email');
		}
		$c_subject = __('<!--:es-->Contacte partir do seu siteE<!--:--><!--:pb-->Contacte partir do seu site<!--:-->', 'framework');
		$message_body = "Name: $c_name \n\nEmail: $c_email \n\nComments: $c_message";
		$headers = 'From: '.get_bloginfo('name').' <'.$c_email.'>';

		wp_mail($email_to, $c_subject, $message_body, $headers);

		$email_sent = true;
	}

}

?>
<?php get_header(); ?>
<!--Start Top Section -->
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
    <div class="contactcontent">
        <?php the_content(); ?>
        <?php endwhile; endif; ?>
        <?php if(isset($email_sent) && $email_sent == true){ ?>
        <h4>
            <?php if ($sentheading = get_option('of_sent_heading')) { echo $sentheading; } ?>
        </h4>
        <p>
            <?php if ($sentdescription = get_option('of_sent_description')) { echo $sentdescription; } ?>
        </p>
        <?php } ?>
		
		<?php if($error != '') { ?>
			<div class="emailfail">
				<h4><?php _e('There were errors in the form.', 'framework'); ?></h4>
				<p><?php _e('Please try again.', 'framework'); ?></p>
			</div>
		<?php } ?>
     </div>
     <div class="contactcontent">
        <div id="contact-form">
            <form action="<?php the_permalink(); ?>" id="contactform" method="post" class="contactsubmit">
                <div class="formrow">
                    <div class="one_half">
                        <label for="c_name">
                            <?php _e('<!--:es-->Nombre<!--:--><!--:pb-->Nome<!--:-->', 'framework'); ?>
                        </label>
                        <input type="text" name="c_name" id="c_name" size="22" tabindex="1" class="required" />
                        <?php if($name_error != '') { ?>
                        <p class="error"><?php echo $name_error;?></p>
                        <?php } ?>
                    </div>
                    <div class="one_half column-last">
                        <label for="c_email">
                            <?php _e('Email', 'framework');?>
                        </label>
                        <input type="text" name="c_email" id="c_email" size="22" tabindex="1" class="required email" />
                        <?php if($email_error != '') { ?>
                        <p class="error"><?php echo $email_error;?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="messagerow">
                    <label for="c_message">
                        <?php _e('<!--:es-->MensagemE<!--:--><!--:pb-->Mensagem<!--:-->', 'framework'); ?>
                    </label>
                    <textarea name="c_message" id="c_message" cols="100%" rows="8" tabindex="3" class="required"></textarea>
                    <?php if($message_error != '') { ?>
                    <p class="error"><?php echo $message_error;?></p>
                    <?php } ?>
                </div>
				
				<?php if ($captcha == 'on') : ?>
				<div class="one_half">
					<div class="messagerow">
						<label for="c_captcha">
								<?php _e('<!--:es-->Quanto é 5 - 1?E<!--:--><!--:pb-->Quanto é 5 - 1?<!--:-->', 'framework');?>
						</label>
						<input type="text" name="c_captcha" id="c_captcha" size="22" tabindex="4" class="required captcha" />
						<?php if($captcha_error != '') { ?>
							<p class="error"><?php echo $captcha_error;?></p>
						<?php } ?>
					</div>
				</div><div class="clear"></div>
				<?php endif; ?>
				
                <p>
                    <label for="c_submit"></label>
                    <input type="submit" name="c_submit" id="c_submit" class="button dark" value="<?php _e('<!--:es-->Enviar MensagemE<!--:--><!--:pb-->Enviar Mensagem<!--:-->', 'framework'); ?>"/>
                </p>
                <input type="hidden" name="c_submitted" id="c_submitted" value="true" />
            </form>
        </div>
        <div class="clear"></div>
    </div>
    </div>
    
    <div class="contactcontent">
    <div class="four columns sidebar offset-by-one content">
        <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Contact Sidebar') ) ?>
    </div>    
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<?php get_footer(); ?>
