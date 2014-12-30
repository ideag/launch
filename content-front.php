				<!-- Pre-Submission: This is what's displayed before the subscription form has been submitted. -->
				<div id="pre-subscribe" <?php post_class(); ?>>
					<div class="row" id="copy">
						<h1><?php echo launch::strong_filter( get_the_title() ); ?></h1>
						<?php the_content(); ?>
					</div>
<?php if ( get_theme_mod( 'mailchimp_user' ) && get_theme_mod( 'mailchimp_list' ) ) : ?>
					<div class="row" id="subscribe">
						<form action="<?php echo launch::mc_api_url( get_theme_mod( 'mailchimp_user' ), get_theme_mod( 'mailchimp_list' ) ); ?>" method="get">
							<input type="email" name="EMAIL" id="email">
							<button type="submit" class="button icon submit" name="subscribe"></button>
						</form>
					</div>
<?php endif; ?>
				</div>
<?php if ( get_theme_mod( 'mailchimp_user' ) && get_theme_mod( 'mailchimp_list' ) ) : ?>
				<!-- Post Subscription: This is what's displayed after the subscription form has been submitted.  -->
				<div id="post-subscribe">
					<div class="row" id="copy">
						<h1><?php echo get_theme_mod( 'mailchimp_after' ); ?></h1>
					</div>
				</div>
<?php endif; ?>
