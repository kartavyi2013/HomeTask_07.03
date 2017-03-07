<?php
get_header(); ?>

		<div id="content-container">
			<div id="content" role="main">

<?php if ( have_posts() ) : ?>
				<h1 class="page-title archive-head"><?php printf( __( 'Результаты поиска: %s', 'hometask' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php
								 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Ничего не найдено', 'hometask' ); ?></h2>
					<div class="entry entry-content">
						<p><?php _e( 'Ничего не найдено. Попробуете по другому запросу?', 'hometask' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
			</div><!-- #content -->
		</div><!-- #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
