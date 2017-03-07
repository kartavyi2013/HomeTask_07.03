<?php


$content_width = 990;
get_header(); ?>

		<div id="content-container" class="image-attachment">
			<div id="content" role="main">

			<?php
						get_template_part( 'loop', 'image' );
			?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
