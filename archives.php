<?php


get_header(); ?>

		<div id="content-container">
			<div id="content" role="main">

				<?php the_post(); ?>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>

					<div class="entry entry-content">
						<h2><?php _e( 'Архив по датам:', 'hometask' ); ?></h2>
						<ul>
							<?php wp_get_archives('type=monthly'); ?>
						</ul>

						<h2><?php _e( 'Архив по рубрикам:', 'hometask' ); ?></h2>
						<ul>
							<?php wp_list_categories( 'title_li=' ); ?>
						</ul>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>					

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
