<?php
	
	if ( ! is_active_sidebar( 'sidebar-4' )
		&& ! is_active_sidebar( 'sidebar-5' )
	)
		return;
	?>

			<div id="footer-widget-area" role="complementary">

<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
				<div id="first" class="widget-area">
					<ul class="xoxo sidebar-list">
						<?php dynamic_sidebar( 'sidebar-4' ); ?>
					</ul>
				</div><!-- #first .widget-area -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
				<div id="second" class="widget-area">
					<ul class="xoxo sidebar-list">
						<?php dynamic_sidebar( 'sidebar-5' ); ?>
					</ul>
				</div><!-- #second .widget-area -->
<?php endif; ?>

			</div><!-- #footer-widget-area -->
