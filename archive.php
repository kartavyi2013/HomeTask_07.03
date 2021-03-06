<?php

get_header(); ?>

		<div id="content-container">
			<div id="content" role="main">

<?php

	if ( have_posts() )
		the_post();
?>

			<h1 class="page-title archive-head">
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Архив по дням: <span>%s</span>', 'hometask' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Архив по месяцам: <span>%s</span>', 'hometask' ), get_the_date('F Y') ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Архив по годам: <span>%s</span>', 'hometask' ), get_the_date('Y') ); ?>
<?php else : ?>
				<?php _e( 'Архив сайта', 'hometask' ); ?>
<?php endif; ?>
			</h1>

<?php
	
	rewind_posts();

	
	 get_template_part( 'loop', 'archive' );
?>

			</div><!-- #content -->
		</div><!-- #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
