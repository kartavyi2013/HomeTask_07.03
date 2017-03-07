<?php

$content_width = 990;
get_header(); ?>

		<div id="content-container" class="one-column">
			<div id="content" role="main">

			<?php
						 get_template_part( 'loop', 'page' );
			?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
