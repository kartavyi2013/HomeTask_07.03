<?php

?>
			</div>

			<div id="footer" role="contentinfo">
				<div id="colophon">

		<?php
			
			get_sidebar( 'footer' );
		?>

					<div id="site-info">
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> &middot; <?php bloginfo( 'description' ); ?>
					</div><!-- #site-info -->

					<div id="site-generator">
						 <a href="http://wp-templates.ru/">Шаблоны WordPress</a>
					</div><!-- #site-generator -->

				</div><!-- #colophon -->
			</div><!-- #footer -->

		</div><!-- #page .blog -->
</div><!-- #container -->

<?php do_action( 'hometask_after' ); ?>

<?php
	

	wp_footer();
?>
</body>
</html>
